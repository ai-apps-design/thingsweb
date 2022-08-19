<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title> CMN Pickup Tournament </title>
    <meta name="description" content="CMN Pickup Tournament">
    <meta name="author" content="SitePoint">
    <!-- Dennis add favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="/favicon.ico">
    <!-- Dennis Replace with Bootstrap 5.0 CDN Bundle -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- Dennis: use ./ path -->
    <!-- <link rel="stylesheet" href="/css/styles.css"> -->
    <style>
        body {
            font: 14px sans-serif;
            text-align: center;
        }

        div {
            text-align: center;
            padding: 10px;
        }
    </style>
</head>

<body>
    <h1 class="my-5">Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. <br>Welcome to CMN Pickup Basketball Fundraiser.</h1>
    <div>
        <!-- <h1>CMN Pickup Basketball Fundraiser</h1> -->
        <!-- <h2><?php echo htmlspecialchars($_SESSION["username"]); ?></h2> -->
        <h3> TICKET BAL HERE </h3>
        <img src="">
    </div>
    <div class="hero-unit">
        <!-- Dennis: add href to addTix -->
        <a href="/html/addTix.html" class="btn btn-primary btn-large">
            Add Tickets
        </a>
    </div>
    <div class="hero-unit">
        <!-- Dennis: add href to betGames -->
        <a href="/php/betGame.php" class="btn btn-primary btn-large">
            Bet on Games
        </a>
    </div>
    <div class="hero-unit">
        <!-- Dennis: add href to sendTix -->
        <a href="/html/sendTix.html" class="btn btn-primary btn-large">
            Send Tickets
        </a>
    </div>
    <div class="hero-unit">
        <a onclick="alert('Not implement!')" class="btn btn-primary btn-large">
            Transactions
        </a>
    </div>
    <p>
        <a href="reset-password.php" class="btn btn-warning">Reset Your Password</a>
        <a href="logout.php" class="btn btn-danger ml-3">Sign Out of Your Account</a>
    </p>
</body>

</html>