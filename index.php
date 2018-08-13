<?php

require_once 'app/Location.php';
require_once 'app/FindLocation.php';
require_once 'app/WeatherInfo.php';
// za potrebe frontenda
$name = 'Dvorovi';
$lat = 44.8040;
$lon = 19.2621;
$locationDetails = array($name, $lat, $lon);
$dewPoint;
$humidity;
$temperature;
$fog;
$cloudiness;
$lowClouds;
$mediumClouds;
$highClouds;
?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Page Title</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="css/main.css" />
</head>
<body>
    <div id="formContainter">
        <form id="locationData" action="" method="GET">
            Departure: <input type="text" name="departure">
            Destination: <input type="text" name="destination"><br>
            <button>Get Weather</button>
        </form>
    </div>
        <div>
            <?php
        
        $departure = new Location($locationDetails);
        $weather = new WeatherInfo($departure);
        
        ?>
    </div>
    <script src="js/main.js"></script>
</body>
</html>