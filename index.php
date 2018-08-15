<?php

require_once 'app/Location.php';
require_once 'app/FindLocation.php';
require_once 'app/WeatherInfo.php';
require_once 'app/misc.php';

if(!empty($_GET)) {
    $dep = explode(' ', $_GET['departure']);
    $des = explode(' ', $_GET['destination']);
    $departureTime = $_GET['timestamp'];
    
    $departureName = 'Dvorovi';
    $destinationName = 'Kandahar';
    $departureDetails = array($departureName, $dep[0], $dep[1]);
    $destinationDetails = array($destinationName, $des[0], $des[1]);
    
    /**
     * $departureDetailes  - [location name, latitude, longitude]
     */
    $departure = new Location($departureDetails);
    $destination = new Location($destinationDetails);
    
    $departureWeather = new WeatherInfo($departure, $departureTime);
    $destinationWeather = new WeatherInfo($destination, $departureTime);
    
    $allData = $destinationWeather->getCurrentWeather();

    echo "<pre>";
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Page Title</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="css/main.css" />
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('timestamp').setAttribute('value', new Date());
            console.log('fawsdf');
        }, false);
    </script>
</head>
<body>
<div class="container">
    <table style="--sky-color:var(<?php echo getSkyColor($departureTime, $departureWeather); ?>)">
        <tr>
            <td colspan="2"><div id="form">
        <form id="locationData" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="GET">
            <input id="departure" type="text" name="departure" value="44.8040 19.2621">
            <input id="destination" type="text" name="destination" value="44.787197 20.457273"><br>
            <input type="hidden" id="timestamp" name="timestamp" value="">
            <input id="button" type="submit" value="submit">
        </form>
    </div></td>
        </tr>
        <?php if (!empty($des) && !empty($dep)): ?>
        <tr>
            <td>High clouds: <?php echo $departureWeather->getHighClouds(); ?>
            <div class="sky" style="--sky-color: var(<?php echo getSkyColor($departureTime, $departureWeather); ?>)">
            <div class="elipse with-circle with-bump" style="--cloud-color: var(<?php echo getCloudColor($departureWeather->getHighClouds(), $departureTime); ?>)"></div>
            </div>
            </td>
            <td>High clouds: <?php echo $destinationWeather->getHighClouds(); ?>
            <div class="sky" style="--sky-color: var(<?php echo getSkyColor($departureTime, $destinationWeather); ?>)">
            <div class="elipse with-circle with-bump" style="--cloud-color: var(<?php echo getCloudColor($destinationWeather->getHighClouds(), $departureTime); ?>)"></div>
            </div>
            </td>
        </tr>
        <tr>
            <td>Medium clouds: <?php echo $departureWeather->getMediumClouds(); ?>
            <div class="sky" style="--sky-color: var(<?php echo getSkyColor($departureTime, $departureWeather); ?>)">
                <div class="elipse with-circle with-bump" style="--cloud-color: var(<?php echo getCloudColor($departureWeather->getMediumClouds(), $departureTime); ?>)"></div>
            </div>
            </td>
            <td>Medium clouds: <?php echo $destinationWeather->getMediumClouds(); ?>
            <div class="sky" style="--sky-color: var(<?php echo getSkyColor($departureTime, $destinationWeather); ?>)">
                <div class="elipse with-circle with-bump" style="--cloud-color: var(<?php echo getCloudColor($destinationWeather->getMediumClouds(), $departureTime); ?>)"></div>
            </div>
            </td>
        </tr>
        <tr>
            <td>Low clouds: <?php echo $departureWeather->getLowClouds(); ?>
            <div class="sky" style="--sky-color: var(<?php echo getSkyColor($departureTime, $departureWeather)?>)">
                <div class="elipse with-circle with-bump" style="--cloud-color: var(<?php echo getCloudColor($departureWeather->getLowClouds(), $departureTime); ?>)"></div>
            </div>
            </td>
            <td>Low clouds: <?php echo $destinationWeather->getLowClouds(); ?>
            <div class="sky" style="--sky-color: var(<?php echo getSkyColor($departureTime, $destinationWeather); ?>)">
                <div class="elipse with-circle with-bump" style="--cloud-color: var(<?php echo getCloudColor($destinationWeather->getLowClouds(), $departureTime); ?>)"></div>
            </div>
            </td>
        </tr>
        <tr>
            <td>Fog: <?php echo $departureWeather->getFog(); ?>
            <div class="sky" style="--sky-color: var(<?php echo getSkyColor($departureTime, $departureWeather); ?>)">
                <div class="sun" style="--sun-color: var(<?php echo getSunColor($departureTime, $departureWeather); ?>)"></div>
                <div class="elipse with-circle with-bump" style="--cloud-color: var(<?php echo getCloudColor($departureWeather->getCloudiness(), $departureTime); ?>)"></div>
            </div>
            </td>
            <td>Fog:<?php echo $destinationWeather->getFog(); ?>
            <div class="sky" style="--sky-color: var(<?php echo getSkyColor($departureTime, $destinationWeather); ?>)">
                <div class="sun" style="--sun-color: var(<?php echo getSunColor($departureTime, $destinationWeather); ?>)"></div>
                <div class="elipse with-circle with-bump" style="--cloud-color: var(<?php echo getCloudColor($destinationWeather->getCloudiness(), $departureTime); ?>)"></div>
            </div>
            </td>
        </tr>
        <tr>
            <td>
            <div>
                Departure details:
                <ul>
                <li>Name: <?php echo $departureWeather->getName()?></li>
                <li>Latitude: <?php echo $departureWeather->getCoordinates()['latitude']?></li>
                <li>Longitude: <?php echo $departureWeather->getCoordinates()['longitude']?></li>
                </ul>
            </div>
            <div>
                Departure weather:
                <ul>
                <li>Dew Point: <?php echo $departureWeather->getDewPoint()?></li>
                <li>Temperature: <?php echo $departureWeather->getTemperature()?></li>
                <li>Humidity: <?php echo $departureWeather->getHumidity()?></li>
                </ul>
            </div>
            </td>
            <td>
            <div>
                Destination details:
                <ul>
                <li>Name: <?php echo $destinationWeather->getName()?></li>
                <li>Latitude: <?php echo $destinationWeather->getCoordinates()['latitude']?></li>
                <li>Longitude: <?php echo $destinationWeather->getCoordinates()['longitude']?></li>
                </ul>
            </div>
            <div>
                Destination weather:
                <ul>
                <li>Dew Point: <?php echo $destinationWeather->getDewPoint()?></li>
                <li>Temperature: <?php echo $destinationWeather->getTemperature()?></li>
                <li>Humidity:<?php echo $destinationWeather->getHumidity()?></li>
                </ul>
            </div>
            </td>
        </tr>
<?php endif; ?>
    </table>
</div>
</body>
</html>