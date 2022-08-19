<html lang="en">

<head>
  <meta charset="utf-8">

  <title> CMN Pickup Tournament </title>
  <meta name="description" content="The HTML5 Herald">
  <meta name="author" content="SitePoint">

  <!-- Dennis add favicon -->
  <link rel="shortcut icon" type="image/x-icon" href="/favicon.ico">
  <!-- Dennis Replace with Bootstrap 5.0 CDN Bundle -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <!-- Dennis local styles is after loading Bootstrap -->
  <link rel="stylesheet" href="../css/styles.css">

</head>

<body>
    
    <?php
    $servername = "45.33.106.65";
    $username = "dbuser";
    $password = "keeper123";
    $dbname = "thingsweb_db";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }
    ?>

    <div class="mt-5 mb-3">
      <!-- Dennis add href to "/" -->
      <a href="/" class="btn btn-primary btn-large">
        Home
      </a>
    </div>
    <div>
      <h1>Send Tickets</h1>
      <div class="container">
        <div class="row justify-content-md-center">
          <div class="col-md-auto">
            Server IP: <?php echo "$servername" ?>
          </div>
          <div class="col-md-auto">
            Database: <?php echo "$dbname" ?>
          </div>
        </div>
      </div>

    </div class="mb-5">

    <?php
    $sql = "SELECT id, username FROM users";
    $result = $conn->query($sql);

    echo "<div class=\"container\">
    <table class=\"table\">
    <tr>
    <th scope=\"col\">id</th>
    <th scope=\"col\">Name</th>
    </tr>";

    if ($result->num_rows > 0) {
      // output data of each row
      while ($row = $result->fetch_assoc()) {
        //echo "id: " . $row["id"]. " - Username: " . $row["username"]. " password: " . $row["password"] . " balance: " . $row["balance"] . "<br>";

        echo "<tr>";
        echo "<td>" . $row['id'] . "</td>";
        echo "<td>" . $row['username'] . "</td>";
        echo "</tr>";
      }
    } else {
      echo "0 results";
    }
    echo "</table>
          </div>";

    $conn->close();
    ?>

  

  <div>
    <h1>Send Tickets</h1>
    <h3>Current Ticket Balance:</h3>
  </div>
  <script src="/js/myscript.js"> </script>
</body>

</html>
