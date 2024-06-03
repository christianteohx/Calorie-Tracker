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
    <title>Calorie Tracker</title>
    <link rel="stylesheet" href="calorie-tracker.css">
  </head>

  <body>
    <header>
      <!-- Content for the header goes here -->  
      <nav id="verticalNavbar">
        <a href="index.php">Home</a>
        <a href="static/ai_chat.php">AI Coach</a>
        <a href="calorie-tracker.php" class="highlight-link">Calorie Tracker</a>
        <a href="daily.php">Goals Tracker</a>
        <a href="recipeRecommendation.php">Recipes</a>
        <a href="faq.php">FAQ</a>
        <!-- <a href="login.php">Login</a> -->
        <!-- <a href="register.php">Register</a> -->
        <!-- <a href="user_logout.php">Log out</a> -->
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

    <div class="main-container">

      <section class="box" id="nutrient-section">
        <div class="nutrient-box" id="protein">
          Protein
          <br>
          <div id="protein-amount">0</div>
        </div>

        <div class="nutrient-box" id="carbs">
          Carbohydrate
          <br>
          <div id="carbs-amount">0</div>
        </div>

        <div class="nutrient-box" id="fat">
          Fat
          <br>
          <div id="fat-amount">0</div>
        </div>

        <div class="nutrient-box" id="fiber">
          Fiber
          <br>
          <div id="fiber-amount">0</div>
        </div>
      </section>

      <section class="box" id="total-calorie-section">
          <div class="total-calorie-box" id="total-calorie-label">
          <?php if (isset($username)) : ?>
          <?php echo $username; ?>'s Calorie Limit
          <?php else : ?>
            Calorie Limit
          <?php endif; ?>
            <!-- Total Budget -->
          </div>

          <div class="total-calorie-box" id="total-calorie-entry">

            <h2 id="totalCalorieText">Calorie Budget: 2700</h2>
            <h3 id="changeCalorieLabel">Change Calorie Budget</h3>
          </div>
          
          <div class="total-calorie-box" id="circle">
            <div class="percentage" data-percent="50"></div>
          </div>

          <div class="total-calorie-box" id="total-calorie-left">
            <div id="total-calorie-left-label">Left</div>
            <div id="total-calorie-left-text">2700</div>
          </div>
        

      </section>

      <section class="box" id="meal-section">
        <div class="meal-box" id="breakfast">
          <b>Add Breakfast</b>
          <br>
          <div id="breakfast-calories">0</div>
        </div>
        
        <div class="meal-box" id="lunch">
          <b>Add Lunch</b>
          <br>
          <div id="lunch-calories">0</div>
        </div>
        
        <div class="meal-box" id="dinner">
          <b>Add Dinner</b>
          <br>
          <div id="dinner-calories">0</div>
        </div>
        
        <div class="meal-box" id="snacks">
          <b>Add Snacks</b>
          <br>
          <div id="snacks-calories">0</div>
        </div>
      </section>
    </div>

    <footer>
      <!-- Content for the footer goes here -->
    </footer>

    <div class="popup" id="mealPopup">
      <div class="popup-content" id="popup-window">
        <span class="close-button" id="mealPopupCloseButton">x</span>
        <input type="text" id="searchInput" placeholder="Search..."">

        <div id="searchResults"></div>
      </div>
    </div>

    <div class="popup" id="calorieBudgetPopup">
      <div class="popup-content">
          <span class="close-button" id="calorieBudgetPopupCloseButton">x</span>
          <h2>Set Calorie Budget</h2>
          <input type="number" id="calorieBudgetInput" placeholder="Enter new calorie budget">
          <button id="updateCalorieBudgetButton">Update</button>
      </div>
    </div>
    
  </body>

  <script src="calorie-tracker.js"></script>

</html>