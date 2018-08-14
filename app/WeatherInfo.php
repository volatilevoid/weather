<?php

class WeatherInfo
{
    private $currentTime;
    private $gpsCoordinates = array();  // [lat lon]    nepotrebno?
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
        $this->currentTime = $date;
        var_dump($date);
    }

    private function xmlToArray($xmlObject, $out = array()) {
        foreach((array)$xmlObject as $index => $node)
            $out[$index] = (is_object($node)) ? $this->xmlToArray($node) : $node;
        return $out;
    }

    private function getWeatherData() {
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
    public function getCurrentWeather() {
        $allWeatherData = $this->getWeatherData();
        $forecast = (array)($allWeatherData['product']);
        $currentDay = substr($this->currentTime, 8, 2);
        $currentHours = substr($this->currentTime, 16, 2);
        $out = array();

        foreach($forecast as $index => $data) {
            foreach((array)$data as $atributes => $atrData) {  
                if(!empty($atrData['from'])) {
                    if(strcmp($atrData['from'], $atrData['to']) == 0 && 
                        $currentHours == substr($atrData['to'], 11, 2) &&
                        $currentDay == substr($atrData['to'], 8, 2)) {
                        $out[] = $atrData;
                    }
                }
            }
        }        
        var_dump($out);
        return $allWeatherData;
    }

}