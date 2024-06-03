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
    $user = "SELECT username FROM goal_tracker WHERE username=$username";
    $user = mysqli_query($conn, $user);
    $row = mysqli_fetch_array($user);
    if ($row["username"] === $username) {

    }else{
      $sql = "INSERT INTO goal_tracker (username, month1, month2, month3, month4, 
    year1, year2, year3, year4) VALUES ('$username', '0', '0',
   '0', '0', '0', '0',
   '0', '0')";

    if ($conn->query($sql) === TRUE) {

    }else{
      echo "Error: " . $sql . "<br>" . $conn->error;
    }
  }
  }else{
    $sql = "UPDATE goal_tracker SET month1='0', month2='0', month3='0', 
    month4='0', year1='0', year2='0', year3='0', year4='0' WHERE 1";

    if ($conn->query($sql) === TRUE) {

    }else{
      echo "Error: " . $sql . "<br>" . $conn->error;
    }

  }


?>

<!DOCTYPE html>
<html lang="en">


<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Daily Tracker</title>
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
            <!-- Daily Goals -->
            <?php echo "Daily Goals" ?>
          </h1>
          <h2 id="progress">Mark As Done</h2>
          <form method="post">
            <input type="text" name="check[]">How many push ups did you do today?<br><hr><br></input>
            <input type="text" name="check[]">How many sit ups did you do today?<br><hr><br></input>
            <input type="text" name="check[]">How many jumping jacks did you do today?<br><hr><br></input>
            <input type="text" name="check[]">How many miles did you jog today?<br><hr><br></input>
            <input type="submit" name="submit"/>
          </form>
        </div>
           <?php
            $list = $_POST['check'];
              if (isset($_SESSION['username'])) {
                $username = $_SESSION['username'];
                  $val = "SELECT month1 FROM goal_tracker WHERE username='$username'";
                  $val1 = mysqli_query($conn, $val);
                  $row1 = mysqli_fetch_array($val1);
                  $tot1 = (int)$list[0] + (int)$row1["month1"];
                  $val2 = "SELECT year1 FROM goal_tracker WHERE username='$username'";
                  $val3 = mysqli_query($conn, $val2);
                  $row2 = mysqli_fetch_array($val3);
                  $tot2 = (int)$list[0] + (int)$row2["year1"];
                  $fin1 = (string)$tot1;
                  $fin2 = (string)$tot2;
                  $sql = "UPDATE goal_tracker SET month1=$fin1, year1=$fin2 WHERE username='$username'";
  
                  if ($conn->query($sql) === TRUE) {
  
                  }else{
                    echo "Error: " . $sql . "<br>" . $conn->error;
                  }
                  $val = "SELECT month2 FROM goal_tracker WHERE username='$username'";
                  $val1 = mysqli_query($conn, $val);
                  $row1 = mysqli_fetch_array($val1);
                  $tot1 = (int)$list[1] + (int)$row1["month2"];
                  $val2 = "SELECT year2 FROM goal_tracker WHERE username='$username'";
                  $val3 = mysqli_query($conn, $val2);
                  $row2 = mysqli_fetch_array($val3);
                  $tot2 = (int)$list[1] + (int)$row2["year2"];
                  $fin1 = (string)$tot1;
                  $fin2 = (string)$tot2;
                  $sql = "UPDATE goal_tracker SET month2=$fin1, year2=$fin2 WHERE username='$username'";
  
                  if ($conn->query($sql) === TRUE) {
  
                  }else{
                    echo "Error: " . $sql . "<br>" . $conn->error;
                  }
                  $val = "SELECT month3 FROM goal_tracker WHERE username='$username'";
                  $val1 = mysqli_query($conn, $val);
                  $row1 = mysqli_fetch_array($val1);
                  $tot1 = (int)$list[2] + (int)$row1["month3"];
                  $val2 = "SELECT year3 FROM goal_tracker WHERE username='$username'";
                  $val3 = mysqli_query($conn, $val2);
                  $row2 = mysqli_fetch_array($val3);
                  $tot2 = (int)$list[2] + (int)$row2["year3"];
                  $fin1 = (string)$tot1;
                  $fin2 = (string)$tot2;
                  $sql = "UPDATE goal_tracker SET month3=$fin1, year3=$fin2 WHERE username='$username'";
  
                  if ($conn->query($sql) === TRUE) {
  
                  }else{
                    echo "Error: " . $sql . "<br>" . $conn->error;
                  }
                  $val = "SELECT month4 FROM goal_tracker WHERE username='$username'";
                  $val1 = mysqli_query($conn, $val);
                  $row1 = mysqli_fetch_array($val1);
                  $tot1 = (int)$list[3] + (int)$row1["month4"];
                  $val2 = "SELECT year4 FROM goal_tracker WHERE username='$username'";
                  $val3 = mysqli_query($conn, $val2);
                  $row2 = mysqli_fetch_array($val3);
                  $tot2 = (int)$list[3] + (int)$row2["year4"];
                  $fin1 = (string)$tot1;
                  $fin2 = (string)$tot2;
                  $sql = "UPDATE goal_tracker SET month4=$fin1, year4=$fin2 WHERE username='$username'";
  
                  if ($conn->query($sql) === TRUE) {
  
                  }else{
                    echo "Error: " . $sql . "<br>" . $conn->error;
                  }
                if(isset($_POST['submit'])){
                  echo 'Daily goal amounts marked, well done!</br>';
                }
              }else{
                  $val = "SELECT month1 FROM goal_tracker WHERE username='$username'";
                  $val1 = mysqli_query($conn, $val);
                  $row1 = mysqli_fetch_array($val1);
                  $tot1 = (int)$list[0] + (int)$row1["month1"];
                  $val2 = "SELECT year1 FROM goal_tracker WHERE username='$username'";
                  $val3 = mysqli_query($conn, $val2);
                  $row2 = mysqli_fetch_array($val3);
                  $tot2 = (int)$list[0] + (int)$row2["year1"];
                  $fin1 = (string)$tot1;
                  $fin2 = (string)$tot2;
                  $sql = "UPDATE goal_tracker SET month1=$fin1, year1=$fin2 WHERE username='guest'";
  
                  if ($conn->query($sql) === TRUE) {
  
                  }else{
                    echo "Error: " . $sql . "<br>" . $conn->error;
                  }
                  $val = "SELECT month2 FROM goal_tracker WHERE username='$username'";
                  $val1 = mysqli_query($conn, $val);
                  $row1 = mysqli_fetch_array($val1);
                  $tot1 = (int)$list[1] + (int)$row1["month2"];
                  $val2 = "SELECT year2 FROM goal_tracker WHERE username='$username'";
                  $val3 = mysqli_query($conn, $val2);
                  $row2 = mysqli_fetch_array($val3);
                  $tot2 = (int)$list[1] + (int)$row2["year2"];
                  $fin1 = (string)$tot1;
                  $fin2 = (string)$tot2;
                  $sql = "UPDATE goal_tracker SET month2=$fin1, year2=$fin2 WHERE username='guest'";
  
                  if ($conn->query($sql) === TRUE) {
  
                  }else{
                    echo "Error: " . $sql . "<br>" . $conn->error;
                  }
                  $val = "SELECT month3 FROM goal_tracker WHERE username='$username'";
                  $val1 = mysqli_query($conn, $val);
                  $row1 = mysqli_fetch_array($val1);
                  $tot1 = (int)$list[2] + (int)$row1["month3"];
                  $val2 = "SELECT year3 FROM goal_tracker WHERE username='$username'";
                  $val3 = mysqli_query($conn, $val2);
                  $row2 = mysqli_fetch_array($val3);
                  $tot2 = (int)$list[2] + (int)$row2["year3"];
                  $fin1 = (string)$tot1;
                  $fin2 = (string)$tot2;
                  $sql = "UPDATE goal_tracker SET month3=$fin1, year3=$fin2 WHERE username='guest'";
  
                  if ($conn->query($sql) === TRUE) {
  
                  }else{
                    echo "Error: " . $sql . "<br>" . $conn->error;
                  }
                  $val = "SELECT month4 FROM goal_tracker WHERE username='$username'";
                  $val1 = mysqli_query($conn, $val);
                  $row1 = mysqli_fetch_array($val1);
                  $tot1 = (int)$list[3] + (int)$row1["month4"];
                  $val2 = "SELECT year4 FROM goal_tracker WHERE username='$username'";
                  $val3 = mysqli_query($conn, $val2);
                  $row2 = mysqli_fetch_array($val3);
                  $tot2 = (int)$list[3] + (int)$row2["year4"];
                  $fin1 = (string)$tot1;
                  $fin2 = (string)$tot2;
                  $sql = "UPDATE goal_tracker SET month4=$fin1, year4=$fin2 WHERE username='guest'";
  
                  if ($conn->query($sql) === TRUE) {
  
                  }else{
                    echo "Error: " . $sql . "<br>" . $conn->error;
                  }
                }
                if(isset($_POST['submit'])){
                  echo 'Daily goal amounts marked, well done!</br>';
                }
          ?>
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
