<?php
$servername = "10.0.0.36";
$username = "dbadmin";
$password = "g0gobig$";
$dbname = "users";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT id, username, email FROM users";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    echo "id: " . $row["id"]. " - Username: " . $row["username"]. " email: " . $row["email"]. "<br>";
  }
} else {
  echo "0 results";
}
$conn->close();
?>