<?php
/**
 * pomocne f-je
 */
require_once 'WeatherInfo.php';

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

function getSkyColor($timeStamp, WeatherInfo $weather) {
    $hours = substr($timeStamp, 16, 2);

    if (intval($hours) < 7 || intval($hours) > 19)  //debug inace = 20
        return '--sky-night';
    else
        return '--sky-day';
}
function getSunColor($timeStamp, WeatherInfo $weather) {
    $hours = substr($timeStamp, 16, 2);
    if (intval($hours) < 7 || intval($hours) > 19)
        return '--no-sun-night';
    else
        return '--sun-day';
}
function getDestinationTime($departureTime, $departureLatitude, $destinationLatitude) {
    // 15 - degrees = 1 hour

    $destinationTime = new DateTime($departureTime);
    $timeDifference = strval(intval(($destinationLatitude - $departureLatitude) / 15)).' hour';
    
    $destinationTime->modify($timeDifference);

   // $destinationTime->add(new DateInterval($timeDifference));
    
    echo "departure: ";
    var_dump($departureTime);
    echo "destination";
    var_dump($destinationTime->format('D M d Y H:i:s e'));
//Wed Aug 15 2018 18:24:21 GMT+0200
    return $destinationTime->format('D M d Y H:i:s e');
    
}

?>