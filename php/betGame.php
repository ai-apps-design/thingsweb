<?php

// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) || !$_SESSION["loggedin"]) {
  // $login_path = "../login.php";
  // echo "rediretc to $login_path";
  // header("location: $login_path");
  header("location: ../login.php");
  exit;
}

print "Selected Game : " . $selectedGame;
$select_game_id = 0;
// Better:
if (isset($_POST) && array_key_exists('setgame', $_POST)) { // check if $_POST exists AND if it holds a key `foo`
  $select_game_id = $_POST['setgame'];
}
print "Selected select_game_id : " . $select_game_id;

$selected_teams = [0, 1];

// $selected_color = 0;
// if (!$pick_color = filter_input(INPUT_POST, 'color', FILTER_SANITIZE_ENCODED)) {
//   $selected_color = $pick_color;
//   print "selected color: " . $selected_color;
// }

// $select_game_id = 0;
// if (!$picked_game = filter_input(INPUT_POST, 'elect-game', FILTER_SANITIZE_ENCODED)) {
//   $select_game_id = $picked_game;
//   print "selected game: " . $select_game_id;
// }

?>
<?php
function getMembersByTeamID($conn, $team_id)
{
  // select `Team ID`, member1, member2, member3, member4, member5 from Teams;
  $sql = "select `Team ID`, member1, member2, member3, member4, member5 from Teams where `Team ID` = " . $team_id . "";
  print "Query team " . $sql;
  $result = $conn->query($sql);
  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      //echo "id: " . $row["id"]. " - Username: " . $row["name"]. " password: " . $row["password"] . " balance: " . $row["balance"] . "<br>";
      $team_id = ['Team ID'];
      $team_member1 = $row['member1'];
      $team_member2 = $row['member2'];
      $team_member3 = $row['member3'];
      $team_member4 = $row['member4'];
      $team_member5 = $row['member5'];
      echo '  <h4> Team' . $team_id . '</h4>';
      echo '  <p> ' . $team_member1 . ' </p>';
      echo '  <p> ' . $team_member2 . ' </p>';
      echo '  <p> ' . $team_member3 . ' </p>';
      echo '  <p> ' . $team_member4 . ' </p>';
      echo '  <p> ' . $team_member5 . ' </p>';
      echo '</div>';
    }
  }
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
  <!-- <link rel="stylesheet" href="../css/styles.css"> -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
  <style>
    .game {
      text-align: center;
      padding: 10px;
    }
  </style>
</head>

<body>

  <div class="game">
    <!-- Dennis add href to "/" -->
    <a href="/" class="btn btn-primary btn-large">
      Home
    </a>
  </div>
  <div class="game">
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
    // select * from Games order by `Game ID`
    $sql = "select `Game ID`, `Team 1`, `Team 2`, Outcome from Games order by `Game ID`;";
    $result = $conn->query($sql);
    $games = [];
    if ($result->num_rows > 0) {
      // output data of each row
      while ($row = $result->fetch_assoc()) {
        $games_data['Game ID'] = $row['Game ID'];
        $games_data['Team 1'] = $row['Team 1'];
        $games_data['Team 2'] = $row['Team 2'];
        $games_data['Outcome'] =  $row['Outcome'];
        $games[$row['Game ID']] = $games_data;

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

    <div class="game row">
      <?php
      if (!empty($select_game_id)) {
        //echo "Game $select_game_id";
        echo "<h3>Game " . $select_game_id . "</h3>";
        echo "<h3>Game data " . $$games[$select_game_id] . "</h3>";
        echo "<h3>Game team 1 " . $$games[$select_game_id]['Team 1'] . "</h3>";
        echo "<h3>Game team 2 " . $$games[$select_game_id]['Team 2'] . "</h3>";

        getMembersByTeamID($conn, $games[$select_game_id]['Team 1']);
        getMembersByTeamID($conn, $games[$select_game_id]['Team 2']);
        // // select `Team ID`, member1, member2, member3, member4, member5 from Teams;
        // $sql = "select `Team ID`, member1, member2, member3, member4, member5 from Teams where `Team ID` = " . $select_team1_id . "";
        // print "Query team " . $sql;
        // $result = $conn->query($sql);
        // if ($result->num_rows > 0) {
        //   $team1_id = ['Team ID'];
        //   $team1_member1 = ['member1'];
        //   $team1_member2 = ['member2'];
        //   $team1_member3 = ['member3'];
        //   $team1_member4 = ['member4'];
        //   $team1_member5 = ['member5'];
        //   echo '  <h4> Team' . $team1_id . '</h4>';
        //   echo '  <p> ' . $team1_member1 . ' </p>';
        //   echo '  <p> ' . $team1_member2 . ' </p>';
        //   echo '  <p> ' . $team1_member3 . ' </p>';
        //   echo '  <p> ' . $team1_member4 . ' </p>';
        //   echo '  <p> ' . $team1_member5 . ' </p>';
        //   echo '</div>';
        // }

        // // select `Team ID`, member1, member2, member3, member4, member5 from Teams;
        // $sql = "select `Team ID`, member1, member2, member3, member4, member5 from Teams where `Team ID` = $select_team2_id";
        // $result = $conn->query($sql);
        // if ($result->num_rows > 0) {
        //   $team2_id = ['Team ID'];
        //   $team2_member1 = ['member1'];
        //   $team2_member2 = ['member2'];
        //   $team2_member3 = ['member3'];
        //   $team2_member4 = ['member4'];
        //   $team2_member5 = ['member5'];
        //   echo '<div class="col">';
        //   echo '  <h4> Team' . $team2_id . '</h4>';
        //   echo '  <p> ' . $team2_member1 . ' </p>';
        //   echo '  <p> ' . $team2_member2 . ' </p>';
        //   echo '  <p> ' . $team2_member3 . ' </p>';
        //   echo '  <p> ' . $team2_member4 . ' </p>';
        //   echo '  <p> ' . $team2_member5 . ' </p>';
        //   echo '</div>';
        // }
      } else {
        echo "<h3>No Game Selected</h3>";
      }
      ?>
    </div>
  </div>
  <div class="game">
    <h6>Number of Tickets to Bet:</h6>
    <input type="number" id="replyNumber" min="0" data-bind="value:replyNumber" />
    <?php
    // foreach ($games as $game) {
    //   print "<div>loop 2 :" . $game['Game ID'] . " " . $game['Team 1'] .  " " . $game['Team 2'] . " " . $game['Outcome'] . "</div>";
    // };

    // print '<select name="print-game" id="print-game" class="form-select" aria-label="Game select example">';

    // foreach ($games as $game) {
    //   print '<option value=\"' . $game['Game ID'] . ' ';
    //   print $game["Game ID"] == $select_game_id ? 'selected' : '' . '>';
    //   print 'Game ' . $game['Game ID'] . "</option>";
    // };
    // print '</select>';
    ?>
  </div>
  <div class="row justify-content-md-center">
    <div class="dropdown" style="width: 480px">
      <?php
      $a = ''; // default value
      // if(!(empty($_POST['foo']))) {

      // Better:
      if (isset($_POST) && array_key_exists('setgame', $_POST)) { // check if $_POST exists AND if it holds a key `foo`
        $a = $_POST['setgame'];
      }
      ?>
      <h1><?php echo "Hello " . $a ?></h1>
      <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
        <div class="row">
          <div class="col">
            <label for="setgame" class="btn" class="label">Game List</label>
          </div>
          <div class="col-5">
            <select name="setgame" id="setgame" class="form-select" aria-label="Game select">
              <option value="">Choose a game</option>
              <?php
              foreach ($games as $game) {
                echo '<option value="' . $game['Game ID'] . '" ';
                echo $game["Game ID"] == $selectedGame ? 'selected' : '' . '>';
                echo 'Game ' . $game['Game ID'] . "</option>";
              }
              ?>
            </select>
          </div>
          <div class="col">
            <button type="submit" name="selGameButton" class="btn btn-primary">Select</button>
          </div>
        </div>
    </div>
    </form>
  </div>
  <?php
  if (isset($_POST['selGameButton'])) {
    echo "This is Select Game ";
    $selectedGame = (int)filter_input(INPUT_POST, 'setgame', FILTER_SANITIZE_ENCODED);
    print "Submit selected Game : " .  $selectedGame;
    $_SESSION["selectedGame"] =  $selectedGame;
    $select_game_id = $selectedGame;
  }
  ?>
  <?php
  $game = (int)filter_input(INPUT_POST, 'setgame', FILTER_SANITIZE_ENCODED);
  ?>
  <?php if ($ga) : ?>
    <p>You selected <?php echo (int)$selectedGame ?></span></p>
  <?php else : ?>
    <p>You did not select any game</p>
  <?php endif ?>

  <div class="container" style="width: 240px">
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
      <div>
        <label for="color" class="label">Background Color:</label>
        <select class="form-select" aria-label="Color select example" name="color" id="color">
          <option value="">--- Choose a color ---</option>
          <option value="red">Red</option>
          <option value="green" selected>Green</option>
          <option value="blue">Blue</option>
        </select>
      </div>
      <div>
        <button type="submit" name="placebtn">Select</button>
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


  <?php
  $places = [[5, "Place 5"], [6, "Place 6"], [7, "Place 7"]];
  foreach ($places as $place) {
    print "Place: " . $place[0] . " " . $place[1];
  }
  if (isset($_POST['pickplacebtn'])) {
    echo "This is Place Pick Button that is selected";
  }
  ?>
  <div class="container" style="width: 240px">
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
      <div>
        <label for="place" class="label">Places:</label>
        <select class="form-select" aria-label="Place select example" name="place" id="place">
          <option value="">--- Choose a place ---</option>
          <option value="1">Place 1</option>
          <option value="2">Place 2</option>
          <option value="3">Place 3</option>
          <?php
          foreach ($places as $place) {
            echo '<option value=\"' . $place[0];
            echo $place[0] == $selected_place ? 'selected' : '' . '>';
            echo $game[1] . "</option>";
          }
          ?>
        </select>
      </div>
      <div>
        <button type="submit" value="pickplacebtn">Select</button>
      </div>
    </form>
  </div>
  <?php
  $pick_place = filter_input(INPUT_POST, 'place', FILTER_SANITIZE_ENCODED);
  ?>
  <?php if ($pick_place) : ?>
    <p>You selected <?php echo $pick_place ?></p>
  <?php else : ?>
    <p>You did not select any color</p>
  <?php endif ?>

  <div>
    <a href="/php/betPlaced.php" class="btn btn-primary btn-large">
      Place Bet
    </a>
  </div>
  <?php
  $conn->close();
  ?>
  <!-- script src="/js/myscript.js"> </!-->
</body>

</html>