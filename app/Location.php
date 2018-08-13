<?php

class Location
{
    private $name;
    private $latitude;
    private $longitude;

    public function __construct() {}

    // Check if input is a geolocation
    private function isGpsFormat(string $inputString) {
        $input = explode(" ", $inputString);
        if( count($input) === 2 && abs(floatval($input[0])) <= 90 && abs(floatval($input[1])) <= 180 )
            return true;
        return false;
    }

    // Find gps coordinates of the place using google place search api
    private function findGeolocation() {}
}