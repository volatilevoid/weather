<?php
/*
require_once 'app/Location.php';
require_once 'app/FindLocation.php';
require_once 'app/WeatherInfo.php';

$departure = array();
if(!empty($_GET)) {
    $departure = explode(' ', $_GET['departure']);
    //$destination = $_GET['destination'];
    $time = $_GET['timestamp'];
}
$name = 'Dvorovi';
//$lat = 44.8040;
//$lon = 19.2621;
$locationDetails = array($name, $departure[0], $departure[1]);


var_dump($departure);*/
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
<div class="">
    <table>
        <tr>
            <td colspan="2"><div id="form">
        <form id="locationData" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="GET">
            <input id="departure" type="text" name="departure" value="44.8040 19.2621">
            <input id="destination" type="text" name="destination"><br>
            <input type="hidden" id="timestamp" name="timestamp" value="">
            <input type="submit" value="submit">
        </form>
    </div></td>
        </tr>
        <tr>
            <td>High clouds:
            <div class="sky">
                <div class="elipse with-circle with-bump"></div>
            </div>
            </td>
            <td>High clouds:
            <div class="sky">
                <div class="elipse with-circle with-bump"></div>
            </div>
            </td>
        </tr>
        <tr>
            <td>Medium clouds:
            <div class="sky">
                <div class="elipse with-circle with-bump"></div>
            </div>
            </td>
            <td>Medium clouds:
            <div class="sky">
                <div class="elipse with-circle with-bump"></div>
            </div>
            </td>
        </tr>
        <tr>
            <td>Low clouds:
            <div class="sky">
                <div class="elipse with-circle with-bump"></div>
            </div>
            </td>
            <td>Low clouds:
            <div class="sky">
                <div class="elipse with-circle with-bump"></div>
            </div>
            </td>
        </tr>
        <tr>
            <td>fog1</td>
            <td>fog2</td>
        </tr>
        <tr>
            <td>otherData1</td>
            <td>otherData2</td>
        </tr>
    </table>
 <!--   <div id="form">
        <form id="locationData" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="GET">
            Departure: <input id="departure" type="text" name="departure" value="44.8040 19.2621">
            <!--Destination: <input id="destination" type="text" name="destination"><br>
            <input type="hidden" id="timestamp" name="timestamp" value="">
            <input type="submit" value="submit">
        </form>
    </div>-->
        <div>
            <?php
        /*echo "<pre>";
        $location = new Location($locationDetails);
        $weather = new WeatherInfo($location, $time);
        $weather->getAllFields();
        //$allData = $weather->getCurrentWeather();
        //var_dump($allData);
        */
        ?>
    </div>
</div>
    <script src="js/main.js"></script>
</body>
</html>