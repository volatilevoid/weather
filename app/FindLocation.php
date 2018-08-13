<?php

class FindLocation
{
    private $candidates = array();
            private $name;
            private $latitude;
            private $longitude;

    public function __construct(string $inputString) {
        if( $this->isGpsFormat($inputString) ) {
            $input = explode(" ", $inputString);
            $this->latitude = $input[0];
            $this->longitude = $input[1];
            $this->name = $this->findLocationName($input);
        }
        else {
            $gpsCoordinates = $this->findLocationCoordinates($inputString);
            $this->name = $inputString;
            $this->latitude = $gpsCoordinates[0];
            $this->longitude = $gpsCoordinates[1];
        }
    }

    // Check if input is a geolocation
    private function isGpsFormat(string $inputString) {
        // First - latitude, second - longitude
        $input = explode(" ", $inputString);
        if( count($input) === 2 && abs(floatval($input[0])) <= 90 && abs(floatval($input[1])) <= 180 )
            return true;
        return false;
    }

    // Find geolocation. Google places api
    private function findLocationCoordinates(string $locationName) {
        $apiKey = 'AIzaSyCxIE_PKGR8kJZ2jtMGx0J20Ug0WY3Kkfg';
        $input = rawurlencode($locationName);
        $inputType = 'textquery';
        $fields = 'geometry';
        $parameters = "input={$input}&inputtype={$inputType}&fields={$fields}&key={$apiKey}";
        $apiCallUrl = "https://maps.googleapis.com/maps/api/place/findplacefromtext/json?{$parameters}";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $apiCallUrl);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);
        $rawData = curl_exec($ch);
        curl_close($ch);
        var_dump($rawData);
    }

    // Find name of geolocation
    private function findLocationName(array $gpsCoordinates) {}
}