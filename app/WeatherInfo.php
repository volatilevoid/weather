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

    private function xmlToArray($xmlObject, $out = array()) {
        foreach((array)$xmlObject as $index => $node)
            $out[$index] = (is_object($node)) ? $this->xmlToArray($node) : $node;
        return $out;
    }
    // fetch all weather data for given location
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
        //echo "<pre>";
        //var_dump($data);
        return $this->xmlToArray($data);
    }
    // filter only current time data
    public function getCurrentWeather() {
        $allWeatherData = $this->getWeatherData();
        $forecast = (array)($allWeatherData['product']);
        $currentDay = substr($this->currentTime, 8, 2);
        $currentHours = substr($this->currentTime, 16, 2);
        $out = array();
        $temp = array();
        $forecastClear = array();

        foreach($forecast as $index => $data) {
            foreach((array)$data as $atributes => $atrData) {  
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
            foreach((array)$val as $atrName => $atrValues) {
                $out[$atrName] = (array)$atrValues;
            }
        }

        return $out;
    }

    public function setWeatherConditions() {
        $allData = $this->getCurrentWeather();
        $this->dewPoint = $allData['dewpointTemperature']['@attributes']['value'];
        $this->humidity = $allData['humidity']['@attributes']['value'];
        $this->temperature = $allData['temperature']['@attributes']['value'];
        $this->fog = $allData['fog']['@attributes']['percent'];
        $this->cloudiness = $allData['cloudiness']['@attributes']['percent'];
        $this->lowClouds = $allData['lowClouds']['@attributes']["percent"];
        $this->mediumClouds = $allData['mediumClouds']['@attributes']["percent"];
        $this->highClouds = $allData['highClouds']['@attributes']["percent"];
    }
    public function getAllFields() {
        echo "location ".$this->locationName;
        echo "<br>";
        echo "coordinates ";
        print_r($this->gpsCoordinates);
        echo "<br>";
        echo "temperature ".$this->temperature;
        echo "<br>";
        echo 'dewPoint: '.$this->dewPoint;
        echo "<br>";
        echo 'humidity '.$this->humidity;
        echo "<br>";
        echo 'fog '.$this->fog;
        echo "<br>";
        echo 'cloudiness '.$this->cloudiness;
        echo "<br>";
        echo 'lowClouds '.$this->lowClouds;
        echo "<br>";
        echo 'mediumClouds '.$this->mediumClouds;
        echo "<br>";
        echo 'highClouds '.$this->highClouds;
        echo "<br>";
    }
}
