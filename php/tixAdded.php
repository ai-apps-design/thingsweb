<html lang="en">
<?php
session_start();

$ticket_added =  $_SESSION['tixAmt'];
//echo "<h3>Ticket added! " . $ticket_added .  "</h3>";
?>

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

</head>

<body>

  <div>
    <?php
    echo "<h3>Thank you! " . $ticket_added . " Tickets have been added. Your new balance is " . $balance . "</h3>";
    ?>

  </div>

  <div>
    <a href="../welcome.php" class="btn btn-primary btn-large">
      Home
    </a>
  </div>
  <!-- <script src="/js/myscript.js"> </script> -->
</body>

</html>