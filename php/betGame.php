<?php
// Initialize the session
session_start();

if (isset($_SESSION["loggedin"])) {
  echo "<div>loggedin " . $_SESSION["loggedin"] ? "true" : "false" . "</div>";
}
if (isset($_SESSION["id"])) {
  echo "<div>id " . $_SESSION["id"] . "</div>";
}
if (isset($_SESSION["username"])) {
  echo "<div>username " . $_SESSION["username"] . "</div>";
}

// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) || !$_SESSION["loggedin"]) {
  // $login_path = "../login.php";
  // echo "rediretc to $login_path";
  // header("location: $login_path");
  header("location: ../login.php");
  exit;
}
?>

<html lang="en">

<head>
  <meta charset="utf-8">

  <title> CMN Pickup Tournament </title>
  <meta name="description" content="The HTML5 Herald">
  <meta name="author" content="SitePoint">

  <!-- Dennis add favicon -->
  <link rel="shortcut icon" type="image/x-icon" href="/favicon.ico">
  <!-- Dennis Replace with Bootstrap 5.0 CDN Bundle -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <!-- Dennis local styles is after loading Bootstrap -->
  <link rel="stylesheet" href="../css/styles.css">
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
</head>

<body>

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

  // $sql = "SELECT id, name, password, balance FROM users";
  // $result = $conn->query($sql);

  // echo "<div class=\"container\">
  // <table class=\"table\">
  // <tr>
  // <th scope=\"col\">id</th>
  // <th scope=\"col\">Name</th>
  // <th scope=\"col\">Password</th>
  // <th scope=\"col\">Balance</th>
  // </tr>";

  // if ($result->num_rows > 0) {
  //   // output data of each row
  //   while ($row = $result->fetch_assoc()) {
  //     //echo "id: " . $row["id"]. " - Username: " . $row["name"]. " password: " . $row["password"] . " balance: " . $row["balance"] . "<br>";

  //     echo "<tr>";
  //     echo "<td>" . $row['id'] . "</td>";
  //     echo "<td>" . $row['name'] . "</td>";
  //     echo "<td>" . $row['password'] . "</td>";
  //     echo "<td>" . $row['balance'] . "</td>";
  //     echo "</tr>";
  //   }
  // } else {
  //   echo "0 results";
  // }
  // echo "</table>
  //       </div>";
  ?>

  <div class="container">
    <?php
    //Query games
    $sql = "select `Game ID`, `Team 1`, `Team 2`, Outcome from Games;";
    $result = $conn->query($sql);

    $select_game_id = $select_team1_id = $select_team2_id = "";

    $games = [];
    if ($result->num_rows > 0) {
      // output data of each row
      while ($row = $result->fetch_assoc()) {
        $games_data['Game ID'] = $row['Game ID'];
        $games_data['Team 1'] = $row['Team 1'];
        $games_data['Team 2'] = $row['Team 2'];
        $games_data['Outcome'] =  $row['Outcome'];
        $games[$row['Game ID']] = $games_data;

        echo "<div> Game ID " . $games['Game ID'] . "</div>";
        echo "<div> games " . $games['Team 1'] . "</div>";
        echo "<div> games" . $games['Team 2'] . "</div>";
        echo "<div> games" . $games['Outcome'] . "</div>";
        echo "<div>" . $row['Game ID'] . "</div>";
        echo "<div>" . $row['Team 1'] . "</div>";
        echo "<div>" . $row['Team 2'] . "</div>";
        echo "<div>" . $row['Outcome'] . "</div>";
      }
    } else {
      echo "0 results";
    }

    // select `Team ID`, member1, member2, member3, member4, member5 from Teams;
    $sql = "select `Team ID`, member1, member2, member3, member4, member5 from Teams";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
      // output data of each row
      while ($row = $result->fetch_assoc()) {
        //echo "id: " . $row["id"]. " - Username: " . $row["name"]. " password: " . $row["password"] . " balance: " . $row["balance"] . "<br>";

        echo "<tr>";
        echo "<td>" . $row['id'] . "</td>";
        echo "<td>" . $row['name'] . "</td>";
        echo "<td>" . $row['password'] . "</td>";
        echo "<td>" . $row['balance'] . "</td>";
        echo "</tr>";
      }
    } else {
      echo "0 results";
    }
    ?>

    <div class="row">
      <?php if (!empty($select_game_id)) {
        echo "Game $games[$select_game_id]";
        echo "<h3>Game $games[$select_game_id]</h3>";

        // select `Team ID`, member1, member2, member3, member4, member5 from Teams;
        $sql = "select `Team ID`, member1, member2, member3, member4, member5 from Teams where `Team ID` = $select_team1_id";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
          $team1_id = ['Team ID'];
          $team1_member1 = ['member1'];
          $team1_member2 = ['member2'];
          $team1_member3 = ['member3'];
          $team1_member4 = ['member4'];
          $team1_member5 = ['member5'];
          echo '  <h4> Team' . $team1_id . '</h4>';
          echo '  <p> ' . $team1_member1 . ' </p>';
          echo '  <p> ' . $team1_member2 . ' </p>';
          echo '  <p> ' . $team1_member3 . ' </p>';
          echo '  <p> ' . $team1_member4 . ' </p>';
          echo '  <p> ' . $team1_member5 . ' </p>';
          echo '</div>';
        }

        // select `Team ID`, member1, member2, member3, member4, member5 from Teams;
        $sql = "select `Team ID`, member1, member2, member3, member4, member5 from Teams where `Team ID` = $select_team2_id";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
          $team2_id = ['Team ID'];
          $team2_member1 = ['member1'];
          $team2_member2 = ['member2'];
          $team2_member3 = ['member3'];
          $team2_member4 = ['member4'];
          $team2_member5 = ['member5'];
          echo '<div class="col">';
          echo '  <h4> Team' . $team2_id . '</h4>';
          echo '  <p> ' . $team2_member1 . ' </p>';
          echo '  <p> ' . $team2_member2 . ' </p>';
          echo '  <p> ' . $team2_member3 . ' </p>';
          echo '  <p> ' . $team2_member4 . ' </p>';
          echo '  <p> ' . $team2_member5 . ' </p>';
          echo '</div>';
        }
      } ?>
    </div>
  </div>
  <div>
    <h6>Number of Tickets to Bet:</h6>
    <input type="number" id="replyNumber" min="0" data-bind="value:replyNumber" />
    <div class="dropdown">
      <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
        Select Game
      </button>
      <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
        <?php if (!empty($select_game_id)) {
          // $games[$row['Game ID']] = $games_data;
          foreach ($games as $game) {
            //print $game;
            echo '<li><a class="dropdown-item">Game ' . $game . '</a></li>';
          }
        } ?>
      </ul>
    </div>
    <div class="dropdown">
      <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
        Select Team
      </button>
      <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
        <li><a class="dropdown-item" href="#">Team 1</a></li>
        <li><a class="dropdown-item" href="#">Team 2</a></li>

      </ul>
    </div>
  </div>

  <div>
    <a href="/php/betPlaced.php" class="btn btn-primary btn-large">
      Place Bet
    </a>
  </div>
  <?php
  $conn->close();
  ?>
  <script src="/js/myscript.js"> </script>
</body>

</html>