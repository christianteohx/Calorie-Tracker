<?php
      $host = "oceanus.cse.buffalo.edu"; //hostname
      $username =  'tylerkre'; //databse username
      $password =  '50352047'; //database password
      $database = 'cse442_2023_fall_team_z_db'; //database name
  
      $conn = mysqli_connect($host, $username, $password, $database);
  
  session_start();

  $_SESSION['prev_page'] = $_SERVER['REQUEST_URI'];


  if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
  }

  ?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Completed Tracker</title>
  <link rel="stylesheet" href="goal-tracker.css">
</head>

<body>
<header>
    <!-- Content for the header goes here -->
  
    <nav id="verticalNavbar">
    <a href="index.php">Home</a>
      <a href="static/ai_chat.php">AI Coach</a>
      <a href="calorie-tracker.php">Calorie Tracker</a>
      <a href="daily.php" class="highlight-link">Goals Tracker</a>
      <a href="recipeRecommendation.php">Recipes</a>
      <a href="faq.php">FAQ</a>
      <?php
        if (isset($_SESSION['username'])) {
          // User is logged in, display logout link
          $username = $_SESSION['username'];
          echo '<a href="profile.php">Profile</a>';
          echo '<a href="user_logout.php">Log Out</a>';
          echo '<h1 hiddent=true display=none id="username">' . $username . '</h1>';

      } else {
          // User is not logged in, display login link
          echo '<a href="login.php">Log in</a>';
          echo '<a href="register.php">Register</a>';
          echo '<h1 hidden=true id="username">Guest</h1>';
      }
      ?>
    </nav>
  </header>

  
  <div id="in17ax" class="row">
    <div id="ir5xuk" class="column">
      <div id="i8pfxy" class="row">
        <div id="i75gls" class="column">
          <h1 id="tracker_title">
            <!-- Completed Goals -->
            <?php echo "Completed Goals" ?>
          </h1>
        </div>
      </div>
    </div>
    <div id="i0z73b" class="column">
      <div title="" id="iolj9u" class="link"><a href="./daily.php" id="iboitz" class="link">Daily Goals</a>
      </div>
      <hr><hr>
      <div id="in7k6h"><a href="./monthly.php" id="i47dpy" class="link">Monthly Goals</a></div>
      <hr><hr>
      <div id="iua29r"><a href="./yearly.php" id="ivkdu2" class="link">Yearly Goals</a></div>
      <hr><hr>
      <div id="ibcvus"><a href="./completed.php" id="i5bowj" class="link">Completed Goals</a></div>
      <hr><hr>
    </div>
  </div>
  
</body>

<script src="goal-tracker.js"></script>

</html>
