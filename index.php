<?php
  session_start();

  $_SESSION['prev_page'] = $_SERVER['REQUEST_URI'];

  if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    // echo "<script>alert('Welcome, $username!');</script>";
  }

?>

<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Something Fitness</title>
    <link rel="stylesheet" href="index.css">
  </head>

<body>
  <header>
    <!-- Content for the header goes here -->
    <nav id="verticalNavbar">
      <a href="index.php" class="highlight-link">Home</a>
      <a href="static/ai_chat.php">AI Coach</a>
      <a href="calorie-tracker.php">Calorie Tracker</a>
      <a href="daily.php">Goals Tracker</a>
      <a href="recipeRecommendation.php">Recipes</a>
      <a href="faq.php">FAQ</a>
      <!-- <a href="login.php">Login</a> -->
      <!-- <a href="register.php">Register</a> -->
      <!-- <a href="user_logout.php">Log out</a> -->
      <?php
        if (isset($_SESSION['username'])) {
            // User is logged in, display logout link
            echo '<a href="profile.php">Profile</a>';
            echo '<a href="user_logout.php">Log Out</a>';
  
        } else {
            // User is not logged in, display login link
            echo '<a href="login.php">Log in</a>';
            echo '<a href="register.php">Register</a>';
        }
      ?>
    </nav>
  </header>

    <div class="main-body">
      <div class="top-body">
        <?php if (isset($username)) : ?>
            <h1 class="title">Welcome, <?php echo $username; ?>, to Something Fitness!</h1>
        <?php else : ?>
            <h1 class="title">Welcome to Something Fitness!</h1>
        <?php endif; ?>
        <!-- <h1 class="title">Welcome to Something Fitness!</h1> -->
        <h3 class="description">Your first step to a healthier lifestyle</h3>
      </div>

      <div class="middle-body">
        <div class="features" id="ai-chat">
          <a href="static/ai_chat.php" class="feature-link">
            <img src="images/ai-chat.png" alt="AI Chat" class="feature-image">
            <div class="feature-text">
              <h1 class="feature-title">AI Coach</h1>
              <h3 class="feature-description">Meet your AI Coach, a blend of technology and personal touch, designed to revolutionize your health journey. This digital guru offers more than advice; it's a window into a healthier lifestyle. Based on your habits and preferences, it nudges you, educates you, and keeps you accountable. Whether you need motivation, clarity, or expert insights, your AI Coach is at your service. It's like having a personal trainer, nutritionist, and wellness guide, all rolled into one intelligent, interactive feature.</h3>
            </div>            
          </a>
        </div>

        <div class="features" id="calorie-tracker">
          <a href="calorie-tracker.php" class="feature-link">
            <img src="images/calorie-tracker.png" alt="Calorie Tracker" class="feature-image">
            <div class="feature-text">
              <h1 class="feature-title">Calorie Tracker</h1>
              <h3 class="feature-description">Imagine having a friendly nutritionist in your pocket, and that's our Calorie Tracker. Log every bite, track every meal, and stay in tune with your body like never before. This feature is your secret weapon in the world of smart eating. Whether dining out or cooking at home, our extensive food database provides instant calorie counts, keeping you informed and in control. Say goodbye to guesswork and hello to a healthier, happier you.</h3>
            </div>
          </a>
        </div>

        <div class="features" id="goal-tracker">
          <a href="daily.php" class="feature-link">
            <img src="images/goal-tracker.png" alt="Goal Tracker" class="feature-image">
            <div class="feature-text">
              <h1 class="feature-title">Goals Tracker</h1>
              <h3 class="feature-description">Embark on a transformative journey with our Goal Tracker. This is not just a feature; it's your personal roadmap to success. Set ambitious yet achievable health targets, whether it's shedding pounds, gaining muscle, or mastering mindful eating. Watch your progress unfold in vivid charts and graphics, turning your aspirations into tangible triumphs. Every step you take is a step closer to your dream health profile. The Goal Tracker doesn't just track; it inspires and propels you towards your ultimate wellness.</h3>
            </div>
          </a>
        </div>
        
        <div class="features" id="recipe-recommendation">
          <a href="recipeRecommendation.php" class="feature-link">
            <img src="images/recipe-recommendation.png" alt="Recipe Recommendation" class="feature-image">
            <div class="feature-text">
              <h1 class="feature-title">Recipe Recommendation</h1>
              <h3 class="feature-description">Get ready to spice up your meal routine with our Recipe Recommendation tool! Tailored to your taste and nutritional needs, our suggestions bring excitement back to your kitchen. From comfort foods to exotic dishes, low-calorie delights to protein-packed power meals – we have it all. Each recipe is a blend of nutrition, taste, and simplicity, ensuring you're never out of options. Let us be your culinary muse, transforming your diet goals into delicious, daily realities.</h3>
            </div>
          </a>
        </div>

      </div>

    </div>

    <footer>
      <!-- Content for the footer goes here -->
    </footer>

  </body>

</html>