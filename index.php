<?php

require_once 'app/Location.php';
echo "<pre>";
$departure = new Location("dvorovi");

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
</body>
</html>