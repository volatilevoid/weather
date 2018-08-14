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


//$departure = $_GET['departure'];
//$destination = $_GET['destination'];
$time = $_GET['timestamp'];

var_dump($_GET);
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
    <div id="form">
        <form id="locationData" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="GET">
            Departure: <input id="departure" type="text" name="departure">
            Destination: <input id="destination" type="text" name="destination"><br>
            <input type="hidden" id="timestamp" name="timestamp" value="">
            <input type="submit" value="submit">
        </form>
    </div>
        <div>
        <?php
        
        $location = new Location($locationDetails);
        $weather = new WeatherInfo($location, $time);
        $x = $weather->getCurrentWeather();
        //var_dump($x['product']['time']);

/*
        foreach($y as $key => $val) {
            echo "<br>*****************key**************************<br>";
            print_r($key);
            echo "<br>*****************val**************************<br>";
            print_r($val);
            echo "<br>**********************************************<br>";            
            foreach($val as $key2 => $val2) {
                echo "<br>****************key2**************************<br>";
                print_r($key2);
                echo "<br>****************val2**************************<br>";
                print_r($val2);
                echo "<br>**********************************************<br>";
            }
        }*/

        ?>
    </div>
    <script src="js/main.js"></script>
</body>
</html>