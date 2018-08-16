<?php
/**
 * Due to Google Places API limitation, 
 */
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

    // Check if input is a geolocation
    private function isGpsFormat(string $inputString) {
        // First - latitude, second - longitude
        $input = explode(" ", $inputString);

        if( count($input) === 2 && abs(floatval($input[0])*100) <= 9000 && abs(floatval($input[1]) * 100) <= 18000 )
            return true;
        return false;
    }


    /**
     * API request for location coordinates
     * Returns array of location candidates
     */
    public function findLocation(string $locationName) {
        $locationsClean = array();
        $BingMapsKey = 'AmMWG2GT57hxAy8jQhqObLEklhqUgF5kI4WQx3F7Hp93CYELYAoPcXIsz-sL45b4';
        $locationQuery = rawurlencode($locationName);
        $maxResults = 10;
        $includeNeighborhood = 1;

        $apiCallUrl = "http://dev.virtualearth.net/REST/v1/Locations?query={$locationQuery}&includeNeighborhood={$includeNeighborhood}&maxResults={$maxResults}&key={$BingMapsKey}";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $apiCallUrl);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);
        $rawData = curl_exec($ch);
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
