<?php

class FindLocation
{
    private $latitude;
    private $longitude;

    public function __construct(string $inputString) {
        if( $this->isGpsFormat($inputString) ) {
            $input = explode(" ", $inputString);
            $this->latitude = $input[0];
            $this->longitude = $input[1];
        }
        else {
            $this->findLocation($inputString);
        }
    }

    // Check input
    private function isGpsFormat(string $inputString) {
        // $input[0] - latitude, $input[1] - longitude
        $input = explode(" ", $inputString);

        if( count($input) === 2 && ctype_digit($input[0]) && ctype_digit($input[0]) && abs(floatval($input[0])) <= 90 && abs(floatval($input[1])) <= 180 )
            return true;
        return false;
    }


    /**
     * API request for location coordinates
     */
    private function findLocation(string $locationName) {
        $locationsClean = array();
        $BingMapsKey = 'AmMWG2GT57hxAy8jQhqObLEklhqUgF5kI4WQx3F7Hp93CYELYAoPcXIsz-sL45b4';
        $locationQuery = urlencode(str_replace(' ', '', $locationName));
        $maxResults = 1;
        $includeNeighborhood = 1;

        $apiCallUrl = "http://dev.virtualearth.net/REST/v1/Locations?query={$locationQuery}&includeNeighborhood={$includeNeighborhood}&maxResults={$maxResults}&key={$BingMapsKey}";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $apiCallUrl);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);
        $rawData = curl_exec($ch);

        if ($rawData == false)
            die('Error finding location');
        curl_close($ch);
        $candidateLocations = json_decode($rawData, true)['resourceSets'][0]['resources'];

        $this->latitude = $candidateLocations[0]['bbox'][0];
        $this->longitude = $candidateLocations[0]['bbox'][1];
    }

    public function getLatitude() {
        return $this->latitude;
    }
    public function getLongitude() {
        return $this->longitude;
    }
}
