<?php

require_once __DIR__.'/app/Location.php';
require_once __DIR__.'/app/FindLocation.php';
require_once __DIR__.'/app/WeatherInfo.php';
require_once __DIR__.'/app/misc.php';

if(!empty($_GET)) {
    $departureTime = $_GET['timestamp'];
    
    $departure = new Location(new FindLocation($_GET['departure']));
    $destination = new Location(new FindLocation($_GET['destination']));
    
    $departureWeather = new WeatherInfo($departure, $departureTime);
    $destinationWeather = new WeatherInfo($destination, $departureTime);
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
    <table style="--sky-color:var(<?php if(!empty($_GET)) echo getSkyColor($departureTime); ?>)">
        <tr>
            <td colspan="2"><div id="form">
        <form id="locationData" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="GET">
            <input id="departure" type="text" placeholder="Departure" name="departure" value="<?php if(!empty($_GET)) echo $_GET['departure']; ?>">
            <input id="destination" type="text" placeholder="Destination" name="destination" value="<?php if(!empty($_GET)) echo $_GET['destination']; ?>"><br>
            <input type="hidden" id="timestamp" name="timestamp" value="">
            <input id="button" type="submit" value="submit">
        </form>
    </div></td>
        </tr>
        <?php if(!empty($_GET)): ?>
        <tr>
            <td>High clouds: <?php echo $departureWeather->getHighClouds(); ?>&percnt;
            <div class="sky" style="--sky-color: var(<?php echo getSkyColor($departureTime); ?>)">
            <div class="elipse with-circle with-bump" style="--cloud-color: var(<?php echo getCloudColor($departureWeather->getHighClouds(), $departureTime); ?>)"></div>
            </div>
            </td>
            <td>High clouds: <?php echo $destinationWeather->getHighClouds(); ?>&percnt;
            <div class="sky" style="--sky-color: var(<?php echo getSkyColor($departureTime); ?>)">
            <div class="elipse with-circle with-bump" style="--cloud-color: var(<?php echo getCloudColor($destinationWeather->getHighClouds(), $departureTime); ?>)"></div>
            </div>
            </td>
        </tr>
        <tr>
            <td>Medium clouds: <?php echo $departureWeather->getMediumClouds(); ?>&percnt;
            <div class="sky" style="--sky-color: var(<?php echo getSkyColor($departureTime); ?>)">
                <div class="elipse with-circle with-bump" style="--cloud-color: var(<?php echo getCloudColor($departureWeather->getMediumClouds(), $departureTime); ?>)"></div>
            </div>
            </td>
            <td>Medium clouds: <?php echo $destinationWeather->getMediumClouds(); ?>&percnt;
            <div class="sky" style="--sky-color: var(<?php echo getSkyColor($departureTime); ?>)">
                <div class="elipse with-circle with-bump" style="--cloud-color: var(<?php echo getCloudColor($destinationWeather->getMediumClouds(), $departureTime); ?>)"></div>
            </div>
            </td>
        </tr>
        <tr>
            <td>Low clouds: <?php echo $departureWeather->getLowClouds(); ?>&percnt;
            <div class="sky" style="--sky-color: var(<?php echo getSkyColor($departureTime)?>)">
                <div class="elipse with-circle with-bump" style="--cloud-color: var(<?php echo getCloudColor($departureWeather->getLowClouds(), $departureTime); ?>)"></div>
            </div>
            </td>
            <td>Low clouds: <?php echo $destinationWeather->getLowClouds(); ?>&percnt;
            <div class="sky" style="--sky-color: var(<?php echo getSkyColor($departureTime); ?>)">
                <div class="elipse with-circle with-bump" style="--cloud-color: var(<?php echo getCloudColor($destinationWeather->getLowClouds(), $departureTime); ?>)"></div>
            </div>
            </td>
        </tr>
        <tr>
            <td>Fog: <?php echo $departureWeather->getFog(); ?>&percnt;
            <div class="sky" style="--sky-color: var(<?php echo getSkyColor($departureTime); ?>)">
                <div class="sun" style="--sun-color: var(<?php echo getSunColor($departureTime, $departureWeather); ?>)"></div>
                <div class="elipse with-circle with-bump" style="--cloud-color: var(<?php echo getCloudColor($departureWeather->getCloudiness(), $departureTime); ?>)"></div>
            </div>
            </td>
            <td>Fog:<?php echo $destinationWeather->getFog(); ?>&percnt;
            <div class="sky" style="--sky-color: var(<?php echo getSkyColor($departureTime); ?>)">
                <div class="sun" style="--sun-color: var(<?php echo getSunColor($departureTime, $destinationWeather); ?>)"></div>
                <div class="elipse with-circle with-bump" style="--cloud-color: var(<?php echo getCloudColor($destinationWeather->getCloudiness(), $departureTime); ?>)"></div>
            </div>
            </td>
        </tr>
        <tr>
            <td>
            <div>
                Destination weather:
                <ul>
                <li>Dew Point: <?php echo $departureWeather->getDewPoint()?>&deg;</li>
                <li>Temperature: <?php echo $departureWeather->getTemperature()?>&#8451;</li>
                <li>Humidity: <?php echo $departureWeather->getHumidity()?>&percnt;</li>
                </ul>
            </div>
            </td>
            <td>
            <div>
                Destination weather:
                <ul>
                <li>Dew Point: <?php echo $destinationWeather->getDewPoint()?>&deg;</li>
                <li>Temperature: <?php echo $destinationWeather->getTemperature()?>&#8451;</li>
                <li>Humidity:<?php echo $destinationWeather->getHumidity()?>&percnt;</li>
                </ul>
            </div>
            </td>
        </tr>
        <?php endif; ?>
    </table>
</div>
</body>
</html>