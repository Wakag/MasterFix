<?php

define("SERVER", "is3-dev.ict.ru.ac.za");
define("USERNAME", "TheMasters");
define("PASSWORD","Q8vrS8M8");
define("DATABASE", "themasters");
$mysqli = new mysqli($host, $username, $password, $database);

// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}
?>