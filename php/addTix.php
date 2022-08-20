<?php
// Initialize the session
session_start();
$tixAmt = $venmo = $username = "";
// If not login, redirect to login
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
  header("location: ../login.php");
  exit;
}
?>
<!-- $servername = "45.33.106.65";
$dbusername = "dbuser";
$dbuser_password = "keeper123";
$dbname = "thingsweb_db";

// Create connection
$conn = new mysqli($servername, $dbusername, $dbuser_password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

echo "<div>addTix session Start...</div>";

// Include config file
//require_once __DIR__ . "/php/config/config.php";

// Define variables and initialize with empty values
$tixAmt = 0;
$venmo = false;
$username = "";
if (isset($_SESSION['username'])) {
  // it does; output the message
  echo "<div> username from session " . $_SESSION['username'] . "</div>";
  $username = $_SESSION["username"];
}

echo "<div> current user " . $username . "</div>";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] = "POST") {

  if (isset($_POST['tixAmt'])) {
    $tixAmt = $_POST['tixAmt'];
  }
  if (isset($_POST['venmo'])) {
    $venmo = $_POST['venmo'];
  }
  echo "<div>tixAmt : [" . $tixAmt . "] venmo: [" . $venmo . "] </div>";
}

// Prepare a select statement
// $sql = "SELECT id, username, password FROM users WHERE username = ?";
//$sql = "SELECT id, username, password FROM users WHERE username = \"" . $input_username . "\"";
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
?> -->

<html lang="en">

<head>
  <meta charset="utf-8">
  <title> CMN Pickup Tournament </title>
  <!-- <meta name="description" content="The HTML5 Herald"> -->
  <!-- <meta name="author" content="SitePoint"> -->
  <!-- Dennis add favicon -->
  <link rel="shortcut icon" type="image/x-icon" href="/favicon.ico">
  <!-- Dennis Replace with Bootstrap 5.0 CDN Bundle -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <!-- Dennis local styles is after loading Bootstrap -->
  <!-- <link rel="stylesheet" href="../css/styles.css"> -->
  <style>
    .wrapper {
      width: 360px;
      padding: 20px;
    }
  </style>
</head>

<body>
  <div class="d-flex justify-content-center">
    <div class="wrapper">
      <div>
        <!-- Dennis add href to "/" -->
        <a href="/" class="btn btn-primary btn-large">
          Home
        </a>
      </div>
      <div>
        <h1>Add Tickets</h1>
        <h3>Current Ticket Balance:</h3>

        <h5>Tickets are $1/ticket. Please fill out how many tickets you want here, and please Venmo accordingly! Venmo is
          @Edward-Sheu-GSW, and should have label "CMN".</h5>

      </div>

      <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div class="mb-3">
          <label for="inputTix" class="form-label">Number of Tickets:</label>
          <input type="number" name="tixAmt" class="form-control" id="replyNumber" min="0" data-bind="value:replyNumber" aria-describedby="tixNumber">

        </div>
        <div class="mb-3 form-check">
          <input type="checkbox" name="venmo" class="form-check-input" id="exampleCheck1">
          <label class="form-check-label" for="check1">I have already Venmo'd @Edward-Sheu-GSW</label>
        </div>
        <button type="submit" name="addTix" href="../tixAdded.php" class="btn btn-primary">Submit</button>
      </form>
      <?php
      echo "addTix Here ..";
      if ($_SERVER["REQUEST_METHOD"] = "POST") {
        echo "<div>Submit</div>";

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

        echo "<div>addTix session Start...</div>";

        // Include config file
        //require_once __DIR__ . "/php/config/config.php";

        // Define variables and initialize with empty values
        if (isset($_SESSION['username'])) {
          // it does; output the message
          echo "<div> username from session " . $_SESSION['username'] . "</div>";
          $username = $_SESSION["username"];
        }

        echo "<div> current user " . $username . "</div>";

        // Processing form data when form is submitted
        if ($_SERVER["REQUEST_METHOD"] = "POST") {

          if (isset($_POST['tixAmt'])) {
            $tixAmt = $_POST['tixAmt'];
          }
          if (isset($_POST['venmo'])) {
            $venmo = $_POST['venmo'];
          }
          echo "<div>tixAmt : [" . $tixAmt . "] venmo: [" . $venmo . "] </div>";
        }

        // Prepare a select statement
        // $sql = "SELECT id, username, password FROM users WHERE username = ?";
        //$sql = "SELECT id, username, password FROM users WHERE username = \"" . $input_username . "\"";
        if ((!empty($tixAmt)) && (!empty($venmo))) {
          $sql = "INSERT INTO addTix (amtTix, User, venmo ) VALUES (" . $tixAmt . ",\"" . $username . "\"," . ($venmo ? "true" : "false") . ")";
          echo "<div>SQL query : " . $sql . "</div>";

          $result = $conn->query($sql);
          echo "Result num_rows : " . $result;

          if ($result == 1) {
            session_start();
            $_SESSION['tixAmt'] = $tixAmt;
            header("location: tixAdded.php");
            exit();
          } else {
            $error = "Internal Error";
            header("HTTP/1.1 500 Internal Server Error");
            exit();
          }
        }

        // Close connection
        $conn->close();
      }
      ?>
    </div>
  </div>

</body>

</html>