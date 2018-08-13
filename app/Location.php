<?php

class Location
{
    private $name;
    private $latitude;
    private $longitude;
    // 
    public function __construct(array $locationDetails) {
        $this->name = $locationDetails[0];
        $this->latitude = $locationDetails[1];
        $this->longitude = $locationDetails[2];
    }
    public function getName() {
        return $this->name;
    }
    public function getLatitude() {
        return $this->latitude;
    }
    public function getLongitude() {
        return $this->longitude;
    }
}