<?php
// Initialize the session
session_start();

$select_game_id = 0;
$selected_teams = [0, 1];

$selected_color = 0;
if (!$color = filter_input(INPUT_POST, 'color', FILTER_SANITIZE_STRING)) {
  $selected_color = $color;
}

$select_game_id = 0;
if (!$color = filter_input(INPUT_POST, 'color', FILTER_SANITIZE_STRING)) {
  $selected_color = $color;
}

$selected_color = 0;
if (!$color = filter_input(INPUT_POST, 'color', FILTER_SANITIZE_STRING)) {
  $selected_color = $color;
}

if (!empty($_POST['select_game'])) {
  print "Selected game " . $_POST['select_game'];
  $select_game_id = $_POST['select_game'];
};

// if (isset($_SESSION["loggedin"])) {
//   echo "<div>loggedin " . $_SESSION["loggedin"] ? "true" : "false" . "</div>";
// }
// if (isset($_SESSION["id"])) {
//   echo "<div>id " . $_SESSION["id"] . "</div>";
// }
// if (isset($_SESSION["username"])) {
//   echo "<div>username " . $_SESSION["username"] . "</div>";
// }

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


    $games = [];
    $inx = 0;
    if ($result->num_rows > 0) {
      // output data of each row
      while ($row = $result->fetch_assoc()) {
        $games_data['Game ID'] = $row['Game ID'];
        $games_data['Team 1'] = $row['Team 1'];
        $games_data['Team 2'] = $row['Team 2'];
        $games_data['Outcome'] =  $row['Outcome'];
        $games[$inx++] = $games_data;

        // echo "<div> Game ID " . $games['Game ID'] . "</div>";
        // echo "<div> games " . $games['Team 1'] . "</div>";
        // echo "<div> games" . $games['Team 2'] . "</div>";
        // echo "<div> games" . $games['Outcome'] . "</div>";
        // echo "<div>" . $row['Game ID'] . "</div>";
        // echo "<div>" . $row['Team 1'] . "</div>";
        // echo "<div>" . $row['Team 2'] . "</div>";
        // echo "<div>" . $row['Outcome'] . "</div>";
      }
    } else {
      echo "0 results";
    }

    foreach ($games as $game) {
      print "loop " . $game['Game ID'] . " " . $game['Team 1'] .  " " . $game['Team 2'] . " " . $game['Outcome'];
      //echo '<li><a class="dropdown-item">Game ' . $game . '</a></li>';
    };

    // // select `Team ID`, member1, member2, member3, member4, member5 from Teams;
    // $sql = "select `Team ID`, member1, member2, member3, member4, member5 from Teams";
    // $result = $conn->query($sql);
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
    ?>

    <div class="row">
      <?php
      if (!empty($select_game_id)) {
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
      } else {
        echo "<h3>No Game Selected</h3>";
      }
      ?>
    </div>
  </div>
  <div>
    <h6>Number of Tickets to Bet:</h6>
    <input type="number" id="replyNumber" min="0" data-bind="value:replyNumber" />
    <?php
    foreach ($games as $game) {
      print "<div>loop " . $game['Game ID'] . " " . $game['Team 1'] .  " " . $game['Team 2'] . " " . $game['Outcome'] . "</div>";
      //echo '<li><a class="dropdown-item">Game ' . $game . '</a></li>';
    };
    ?>
    <div class="row justify-content-md-center">
      <div class="dropdown" style="width: 480px">
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
          <div class="row">
            <div class="col">
              <label for="select-game" class="btn btn-secondary" class="label">Game List:</label>
            </div>
            <div class="col">
              <select name="select-game" id="select-game" class="form-select" aria-label="Color select example">
                <?php
                foreach ($games as $game) {
                  echo '<option value="' . $game['Game ID'] . " " . ($game['Game ID'] == $select_game_id) ? ' selected' : "" . '> Game ' . $game['Game ID'] . "</option>";
                }
                ?>
              </select>
            </div>
            <div class="col">
              <button type="submit" class="btn btn-primary">Select</button>
            </div>
          </div>
      </div>
      </form>
    </div>

  </div>
  <div class="dropdown">
    <!--
      <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
        Select Game
      </button>
      -->
    <!-- <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1"> -->
    <?php
    // foreach ($games as $game) {
    //   //print "loop " . $game['Game ID'];
    //   echo '<li><a class="dropdown-item">Game ' . $game['Game ID'] . '</a></li>';
    // }
    echo '<label for="gameid" class="btn btn-secondary dropdown-toggle" >Select Game:</label>';
    echo '<select name=\"gameid\" id=\"gameid\" class="dropdown-menu" aria-labelledby="dropdownMenuButton1" >';
    foreach ($games as $game) {
      echo "<option value=\"" . $game['Game ID'] . " " . ($game['Game ID'] == $select_game_id) ? ' selected="selected"' : "" . " class=\"dropdown-item\" </option>";
    }
    echo "</select>";
    ?>
    <!-- </ul> -->
  </div>
  <div class="dropdown">
    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
      Select Game
    </button>
    <?php
    echo '<label for="gameid">Select Game:</label>';
    echo "<select name=\"gameid\" id=\"gameid\">";
    foreach ($games as $game) {
      echo "<option value=\"" . $game['Game ID'] . " " . ($game['Game ID'] == $select_game_id) ? ' selected="selected"' : "" . "</option>";
    }
    echo "</select>";
    ?>
  </div>
  <div class="container" style="width: 240px">
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
      <div class="row">
        <div class="col">
          <div>
            <label for="select-game">Select Game:</label>
            <select name="select-game" id="select-game" class="form-select" aria-label="Color select example">
              <?php
              foreach ($games as $game) {
                echo "<option value=\"" . $game['Game ID'] . " " . ($game['Game ID'] == $select_game_id) ? ' selected' : "" . "</option>";
              }
              ?>
              <!-- <option value="1">Game 1</option>
                <option value="2" selected>Game 2</option>
                <option value="3">Game 3</option>
                -->
            </select>
          </div>
        </div>
        <div class="col">
          <div>
            <button type="submit">Select</button>
          </div>
        </div>
      </div>
    </form>
  </div>
  <div class="container" style="width: 240px">
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
      <div>
        <label for="color">Background Color:</label>
        <select class="form-select" aria-label="Color select example" name="color" id="color">
          <option value="">--- Choose a color ---</option>
          <option value="red">Red</option>
          <option value="green" selected>Green</option>
          <option value="blue">Blue</option>
        </select>
      </div>
      <div>
        <button type="submit">Select</button>
      </div>
    </form>
  </div>
  <?php

  $color = filter_input(INPUT_POST, 'color', FILTER_SANITIZE_ENCODED);

  ?>

  <?php if ($color) : ?>
    <p>You selected <span style="color:<?php echo $color ?>"><?php echo $color ?></span></p>
    <p><a href="index.php">Back to the form</a></p>
  <?php else : ?>
    <p>You did not select any color</p>
  <?php endif ?>
  <label for="color">Php Games</label>
  <select id="select_game" id="select_game">
    <?php
    foreach ($games as $game) {
      echo '<option value="' . $game['Game ID'] . ' ' . ($game['Game ID'] == $select_game_id) ? ' selected="selected" ' : '' . '</option>';
    }
    ?>
  </select>
  <?php
  print "Selected game " . $_POST['select_game'];
  ?>

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