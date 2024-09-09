<?php

define("SERVER", "is3-dev.ict.ru.ac.za");
define("USERNAME", "TheMasters");
define("PASSWORD","Q8vrS8M8");
define("DATABASE", "themasters");
$conn = new mysqli(SERVER, USERNAME, PASSWORD, DATABASE);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error );
}
?>