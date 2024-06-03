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
  <title>FAQ Page</title>
  <link rel="stylesheet" href="faq.css">
</head>

<body>
<header>
    <!-- Content for the header goes here -->
  
    <nav id="verticalNavbar">
      <a href="index.php">Home</a>
      <a href="static/ai_chat.php">AI Coach</a>
      <a href="calorie-tracker.php">Calorie Tracker</a>
      <a href="daily.php">Goals Tracker</a>
      <a href="recipeRecommendation.php">Recipes</a>
      <a href="faq.php" class="highlight-link">FAQ</a>
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

<h1>MOST FREQUENTLY ASKED QUESTIONS ABOUT WORKING OUT</h1>

<h2><hr><em>1. How do you stay motivated?</em></h2>

<div class=answer>You've got to have goals that are measurable and 
    time-bound. And motivation must come within, not from someone or 
    something else. To get help tracking good workout goals use the link
    below to go to our goal tracker page.
    <a href="daily.php">Goal Tracker</a>
<hr></div>

<h2><hr><em>2. How do I get back into working out after taking time away?</em></h2>

<div class=answer>Don't get caught up talking about restarting, 
    just restart, but build up slowly.<hr></div>

<h2><hr><em>3. I haven't worked out in years — how do I get strong and lean?</em></h2>

<div class=answer>Similar to the above, find a program, start slow, 
    and get into a consistent schedule. Good news about restarting after 
    a long time off, you'll see results fairly quickly. Similar to question 1
    you can use our goal tracking feature to get you in a routine.
    <a href="daily.php">Goal Tracker</a><hr></div>

<h2><hr><em>4. How long does it take to see results from a workout plan?</em></h2>

<div class=answer>Depends on the goal, your adherence, nutrition, 
    and mindset, but you generally speaking, you can start to see 
    noticeable improvements in body composition and performance around 
    a month.<hr></div>

<h2><hr><em>5. What are the best exercises to get abs?</em></h2>

<div class=answer>Too many to list, but the most important factor is 
    making sure you're hitting them from every angle.<hr></div>

<h2><hr><em>6. Are bodyweight workouts enough to get fit?</em></h2>

<div class=answer>Yes, but if you want to pack on muscle and build 
    actual strength and not just muscular endurance, you'll need to 
    start throwing around some weights.<hr></div>

<h2><hr><em>7. How often can I have a cheat meal?</em></h2>

<div class=answer>Depends on how well you know how your body reacts 
    to food. You can also use our calorie tracking feature to help with
    balancing your meals and having a cheat responsibly.
    <a href="calorie-tracker.php">Calorie Tracker</a><hr></div>

<h2><hr><em>8. Is cardio the best way to lose weight?</em></h2>

<div class=answer>Nope. Strength training will make it a whole lot 
    easier.<hr></div>

<h2><hr><em>9. Why does my low back ache?</em></h2>

<div class=answer>It could a million things, but it's highly possible 
    it's a weak core. That's very fixable.<hr></div>

<h2><hr><em>10. What supplements should I be taking?</em></h2>

<div class=answer>You're going to see the most results from consistent 
    exercise and a healthy diet. That's not to say supplements can't 
    help, but it's a very small percentage.<hr></div>

<h2><hr><em>11. I think I eat healthy, but why can't I lose weight?</em></h2>

<div class=answer>“Healthy” is different than conducive for weight 
    loss. For example, avocados are incredibly healthy, but they are 
    high in fat and if you're eating 100 avocados in a day, you're 
    eating too much fat. Same applies for anything else. Portion 
    control is key. Our own recipe recomendations can help you
    keep a health diet with a lot to choose from.
    <a href="recipeRecommendation.php">Recipes</a><hr></div>

<h2><hr><em>12. How much do I need to warm up before a workout?</em></h2>

<div class=answer>Five to 10 minutes or so. Just enough to loosen up. 
    Make sure to move dynamically and save the static stretching for 
    the end of your workouts.<hr></div>

  <footer>
    <a href="#top">scroll to top</a>
  </footer>

  </body>

  <script src="faq.js"></script>

</html>  