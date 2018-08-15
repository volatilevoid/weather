<?php

class WeatherInfo
{
    // dodati jedinice za velicine
    private $currentTime;
    private $gpsCoordinates = array();  
    private $locationName;
    private $dewPoint;
    private $humidity;
    private $temperature;
    private $fog;
    private $cloudiness;
    private $lowClouds;
    private $mediumClouds;
    private $highClouds;

    public function __construct(Location $locationDetails, $date) {
        $this->gpsCoordinates['latitude'] = $locationDetails->getLatitude();
        $this->gpsCoordinates['longitude'] = $locationDetails->getLongitude(); 
        $this->locationName = $locationDetails->getName();
        $this->currentTime = $date;
        $this->setWeatherConditions();
    }
    /**
     * Convert objects from xml to arrays
     */
    private function xmlToArray($xmlObject, $out = array()) {
        foreach((array)$xmlObject as $index => $node)
            $out[$index] = (is_object($node)) ? $this->xmlToArray($node) : $node;
        return $out;
    }
    /**
     *  Api request for weather conditions
     */
    public function getWeatherData() {
        $apiUrl = "https://api.met.no/weatherapi/locationforecast/1.9/?lat={$this->gpsCoordinates['latitude']}&lon={$this->gpsCoordinates['longitude']}";
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $apiUrl);
        curl_setopt($ch, CURLOPT_FAILONERROR,1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION,1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 15);

        $rawData = curl_exec($ch);
        if( $rawData === false )
            die( "Error retreving weather info" );
        curl_close($ch);

        $data = simplexml_load_string(html_entity_decode($rawData), 'SimpleXMLElement', LIBXML_NOCDATA) 
                    or die( "can't turn in object" );
        return $this->xmlToArray($data);
    }

    /**
     * Filter only current time data
     */
    public function getCurrentWeather() {
        $allWeatherData = $this->getWeatherData();
        $forecast = (array)($allWeatherData['product']);
        $currentDay = substr($this->currentTime, 8, 2);
        $currentHours = substr($this->currentTime, 16, 2);
        $out = array();
        $temp = array();
        $forecastClear = array();

        foreach($forecast as $index => $data) {
            foreach((is_object($data) ? (array)$data : $data) as $atributes => $atrData) {  
                if(!empty($atrData['from'])) {
                    if(strcmp($atrData['from'], $atrData['to']) == 0 && 
                        $currentHours == substr($atrData['to'], 11, 2) &&
                        $currentDay == substr($atrData['to'], 8, 2)) {
                        $temp = $atrData;
                        //$forecastClear[] = $atrData;
                    }
                }
            }
        }        

        foreach($temp as $key =>$val) {
            foreach((is_object($val) ? (array)$val : $val) as $atrName => $atrValues) {
                $out[$atrName] = (is_object($atrValues) ? (array)$atrValues : $atrValues);
            }
        }

        return $out;
    }

    public function setWeatherConditions() {
        $allData = $this->getCurrentWeather();
        if(!empty($allData)) {
            //echo "<pre>";
            //var_dump($allData);
            //echo "<br>**************************************************************<br>";
            $this->dewPoint = $allData['dewpointTemperature']['@attributes']['value'];
            $this->humidity = $allData['humidity']['@attributes']['value'];
            $this->temperature = $allData['temperature']['@attributes']['value'];
            $this->fog = $allData['fog']['@attributes']['percent'];
            $this->cloudiness = $allData['cloudiness']['@attributes']['percent'];
            $this->lowClouds = $allData['lowClouds']['@attributes']["percent"];
            $this->mediumClouds = $allData['mediumClouds']['@attributes']["percent"];
            $this->highClouds = $allData['highClouds']['@attributes']["percent"];
        }
    }

    public function getName() {
        return $this->locationName;
    }
    public function getCoordinates() {
        return $this->gpsCoordinates;
    }
    public function getTemperature() {
        return $this->temperature;
    }
    public function getDewPoint() {
        return $this->dewPoint;
    }
    public function getHumidity() {
        return $this->humidity;
    }
    public function getFog() {
        return $this->fog;
    }
    public function getCloudiness() {
        return $this->cloudiness;
    }
    public function getLowClouds() {
        return $this->lowClouds;
    }
    public function getMediumClouds() {
        return $this->mediumClouds;
    }
    public function getHighClouds() {
        return $this->highClouds;
    }
    public function getCurrentTime() {
        return $this->currentTime;
    }
}
