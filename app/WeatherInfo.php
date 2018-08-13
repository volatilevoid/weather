<?php

class WeatherInfo
{
    private $gpsCoordinates = array();  // [lat lon]    nepotrebno?
    private $dewPoint;
    private $humidity;
    private $temperature;
    private $fog;
    private $cloudiness;
    private $lowClouds;
    private $mediumClouds;
    private $highClouds;

    public function __construct(Location $locationDetails) {
        $this->gpsCoordinates[] = $locationDetails->getLatitude();
        $this->gpsCoordinates[] = $locationDetails->getLongitude();

        $this->getWeatherData($locationDetails->getLatitude(), $locationDetails->getLongitude());
    }

    private function getWeatherData($latitude, $longitude) {
        $apiUrl = "https://api.met.no/weatherapi/locationforecast/1.9/?lat={$latitude}&lon={$longitude}";
        
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
       // $data = new SimpleXMLElement($rawData);
        echo "<pre>";
        var_dump($data);
    }
}