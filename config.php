<?php
$servername = "45.33.106.65";
$dbusername = "dbuser";
$dbuser_password = "keeper123";
$dbname = "thingsweb_db";

// Create connection
$conn = new mysqli($servername, $dbusername, $dbuser_password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
