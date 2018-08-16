<?php

class Location
{
    private $latitude;
    private $longitude;
    
    public function __construct(FindLocation $locationDetails) {
        $this->latitude = $locationDetails->getLatitude();
        $this->longitude = $locationDetails->getLongitude();
    }

    public function getLatitude() {
        return $this->latitude;
    }
    public function getLongitude() {
        return $this->longitude;
    }
}
