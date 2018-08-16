<?php

/**
 * changing clouds color
 */
 function getCloudColor($cloudPercentage, $timeStamp) {
    $hours = substr($timeStamp, 16, 2);     
    if (intval($hours < 7) || intval($hours) > 20) {
        if( floatval($cloudPercentage)  > 50 )
            return '--cloud-heavy-night';
        else if( floatval($cloudPercentage) > 20) 
            return '--cloud-light-night';
        else 
            return '--cloud-noclouds-night';
    }
    else {
        if( floatval($cloudPercentage)  > 50 )
            return '--cloud-heavy';
        else if( floatval($cloudPercentage) > 20) 
            return '--cloud-light';
        else 
            return '--cloud-noclouds';
    }
}

/**
 * Changing sky color
 */
function getSkyColor($timeStamp, WeatherInfo $weather) {
    $hours = substr($timeStamp, 16, 2);
    if (intval($hours) < 7 || intval($hours) > 19)  
        return '--sky-night';
    else
        return '--sky-day'; 
}

/**
 * Changing sun color
 */
function getSunColor($timeStamp, WeatherInfo $weather) {
    $hours = substr($timeStamp, 16, 2);
    if ($weather->getFog() > 50 && $weather->getCloudiness() > 50) {
        if (intval($hours) < 7 || intval($hours) > 19)
            return '--no-sun-night';
        else
            return '--sun-fog'; 
    }
    else {
        if (intval($hours) < 7 || intval($hours) > 19)
            return '--no-sun-night';
        else
            return '--sun-day';
    }
}

?>