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
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js"
    integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT"
    crossorigin="anonymous"></script>
</head>

<body>

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
  ?>

  <div>
    <!-- Dennis add href to "/" -->
    <a href="/" class="btn btn-primary btn-large">
      Home
    </a>
  </div>
  <div>
    <h1>Bet on Games</h1>
  </div>
  <?php
  $sql = "SELECT id, username, email FROM users";
  $result = $conn->query($sql);
  
  echo "<div class=\"container\">
  <table class=\"table\">
  <tr>
  <th scope=\"col\">id</th>
  <th scope=\"col\">username</th>
  <th scope=\"col\">email</th>
  </tr>";

  if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
      //echo "id: " . $row["id"]. " - Username: " . $row["username"]. " email: " . $row["email"]. "<br>";

      echo "<tr>";
      echo "<td>" . $row['id'] . "</td>";
      echo "<td>" . $row['username'] . "</td>";
      echo "<td>" . $row['email'] . "</td>";
      echo "</tr>";    
    }
  } else {
    echo "0 results";
  }
  echo "</table>
        </div>";
  ?>
  
  <div class="container">
    <div class="row">
      <h3>Game 1</h3>
      <div class="col">
        <h4> Team 1 </h4>
        <p> Boaty Mc BoatFace </p>
        <p> Boaty Mc BoatFace </p>
        <p> Boaty Mc BoatFace </p>
        <p> Boaty Mc BoatFace </p>
        <p> Boaty Mc BoatFace </p>
      </div>
      <div class="col">
        <h4> Team 2 </h4>
        <p> Steph McFlurry </p>
        <p> Steph McFlurry </p>
        <p> Steph McFlurry </p>
        <p> Steph McFlurry </p>
        <p> Steph McFlurry </p>
      </div>

    </div>
  </div>
  <div>
    <h6>Number of Tickets to Bet:</h6>
    <input type="number" id="replyNumber" min="0" data-bind="value:replyNumber" />
    <div class="dropdown">
      <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown"
        aria-expanded="false">
        Select Game
      </button>
      <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
        <li><a class="dropdown-item" href="#">Game 1</a></li>
        <li><a class="dropdown-item" href="#">Game 2</a></li>
        <li><a class="dropdown-item" href="#">Game 3</a></li>
      </ul>
    </div>
    <div class="dropdown">
      <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown"
        aria-expanded="false">
        Select Team
      </button>
      <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
        <li><a class="dropdown-item" href="#">Team 1</a></li>
        <li><a class="dropdown-item" href="#">Team 2</a></li>

      </ul>
    </div>
  </div>

  <div>
    <a class="btn btn-primary btn-large">
      Place Bet
    </a>

  </div>
  <?php
  $conn->close();
  ?>
  <script src="/js/myscript.js"> </script>
</body>

</html>