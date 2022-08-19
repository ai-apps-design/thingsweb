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
  <style>
      .wrapper {
          width: 360px;
          padding: 20px;
          
          
      }
      
      div {
        
        padding: 10px;


      }
      
      
    </style>
  
  
  
</head>

<body>
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

  
  
  <div class="d-flex justify-content-center">
  <div class ="wrapper">
  <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <div class="mb-3">
      <label for="inputTix" class="form-label">Number of Tickets:</label>
      <input type="number" name="tixAmt" class="form-control" id="replyNumber" min="0" data-bind="value:replyNumber" aria-describedby="tixNumber">
      
    </div>
    <div class="mb-3 form-check">
      <input type="checkbox" name="venmo" class="form-check-input" id="exampleCheck1">
      <label class="form-check-label" for="check1">I have already Venmo'd @Edward-Sheu-GSW</label>
    </div>
    <button type="submit" href = "../tixAdded.php" class="btn btn-primary">Submit</button>
  </form>
  </div>
  </div>
  
  
  
  
  
  <script src="/js/myscript.js"> </script>
</body>

</html>
