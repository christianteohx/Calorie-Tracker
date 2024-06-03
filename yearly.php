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
  <title>Yearly Tracker</title>
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
            <!-- Yearly Goals -->
            <?php echo "Yearly Goals" ?>
          </h1>
          <h2 id="progress">Progress</h2>
          <?php
          if (isset($_SESSION['username'])) {
            $username = $_SESSION['username'];
            $val = "SELECT year1 FROM goal_tracker WHERE username='$username'";
            $val1 = mysqli_query($conn, $val);
            $row = mysqli_fetch_array($val1);
            echo str_repeat("&nbsp", 5);
            echo $row["year1"] . " / 2,400";
            echo str_repeat("&nbsp", 10);
            echo "Do 2,400 push ups</br></br>";
            $val = "SELECT year2 FROM goal_tracker WHERE username='$username'";
            $val1 = mysqli_query($conn, $val);
            $row = mysqli_fetch_array($val1);
            echo str_repeat("&nbsp", 5);
            echo $row["year2"] . " / 2,400";
            echo str_repeat("&nbsp", 10);
            echo "Do 2,400 sit ups</br></br>";
            $val = "SELECT year3 FROM goal_tracker WHERE username='$username'";
            $val1 = mysqli_query($conn, $val);
            $row = mysqli_fetch_array($val1);
            echo str_repeat("&nbsp", 5);
            echo $row["year3"] . " / 6,000";
            echo str_repeat("&nbsp", 10);
            echo "Do 6,000 jumping jacks</br></br>";
            $val = "SELECT year4 FROM goal_tracker WHERE username='$username'";
            $val1 = mysqli_query($conn, $val);
            $row = mysqli_fetch_array($val1);
            echo str_repeat("&nbsp", 5);
            echo $row["year4"] . " / 240";
            echo str_repeat("&nbsp", 13);
            echo "Jog for 240 miles</br></br>";
          }else{
            $val = "SELECT year1 FROM goal_tracker WHERE username='guest'";
            $val1 = mysqli_query($conn, $val);
            $row = mysqli_fetch_array($val1);
            echo str_repeat("&nbsp", 5);
            echo $row["year1"] . " / 2,400";
            echo str_repeat("&nbsp", 10);
            echo "Do 2,400 push ups</br></br>";
            $val = "SELECT year2 FROM goal_tracker WHERE username='guest'";
            $val1 = mysqli_query($conn, $val);
            $row = mysqli_fetch_array($val1);
            echo str_repeat("&nbsp", 5);
            echo $row["year2"] . " / 2,400";
            echo str_repeat("&nbsp", 10);
            echo "Do 2,400 sit ups</br></br>";
            $val = "SELECT year3 FROM goal_tracker WHERE username='guest'";
            $val1 = mysqli_query($conn, $val);
            $row = mysqli_fetch_array($val1);
            echo str_repeat("&nbsp", 5);
            echo $row["year3"] . " / 6,000";
            echo str_repeat("&nbsp", 10);
            echo "Do 6,000 jumping jacks</br></br>";
            $val = "SELECT year4 FROM goal_tracker WHERE username='guest'";
            $val1 = mysqli_query($conn, $val);
            $row = mysqli_fetch_array($val1);
            echo str_repeat("&nbsp", 5);
            echo $row["year4"] . " / 240";
            echo str_repeat("&nbsp", 13);
            echo "Jog for 240 miles</br></br>";
          }
          ?>
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
