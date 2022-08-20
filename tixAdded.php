<?php
// Initialize the session
session_start();

// If not login, redirect to login
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}

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

// Include config file
//require_once __DIR__ . "/php/config/config.php";

// Define variables and initialize with empty values
$tixAmt = 0;
$venmo = false;
$username = "";
$username = $_SESSION["username"];

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] = "POST") {

    $tixAmt = $_POST['tixAmt']; // you should really do some more logic to see if it's set first
    $venmo = $_POST['venmo'];

    echo "<div>tixAmt : [" . $tixAmt . "] venmo: [" . $venmo . "] </div>";
}

// Prepare a select statement
// $sql = "SELECT id, username, password FROM users WHERE username = ?";
$sql = "SELECT id, username, password FROM users WHERE username = \"" . $input_username . "\"";

$sql = "INSERT INTO addTix (amtTix, User, venmo ) VALUES (" . $tixAmt . "," . $username . "," . $venmo . ")";
echo "<div>SQL query : " . $sql . "</div>";

$result = $conn->query($sql);
echo "Result num_rows : " . $result;

if ($result == 1) {
    header("location: ./html/tixAdded.html");
} else {
    $error = "Internal Error";
    header("HTTP/1.1 500 Internal Server Error");
    exit;
}

// Close connection
$conn->close();
