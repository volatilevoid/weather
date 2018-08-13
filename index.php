<?php

require_once 'app/Location.php';
require_once 'app/FindLocation.php';
require_once 'app/WeatherInfo.php';

echo "<pre>";
$name = 'Dvorovi';
$lat = 44.8040;
$lon = 19.2621;
$locationDetails = array($name, $lat, $lon);

?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Page Title</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
    <script src="main.js"></script>
</head>
<body>
    <form action="" method="GET">
        Departure: <input type="text" name="departure" ><br>
        Destination: <input type="text" name="destination"><br>
        <input type="submit">
    </form>
    <div>
        <?php
        
        $departure = new Location($locationDetails);
        $weather = new WeatherInfo($departure);

        ?>
    </div>
</body>
</html>