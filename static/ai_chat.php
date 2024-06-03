<?php
  session_start();

  $_SESSION['prev_page'] = $_SERVER['REQUEST_URI'];

  if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    // echo "<script>alert('Welcome, $username!');</script>";
  }

?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, height=device-height">
  <title>AI Chat</title>
  <link rel="stylesheet" href="ai_chat_style.css" />
  
</head>


<header >

  <div class="icon_window" id="history_window" >
    <div class="date_history" id="date_history" style="display: block;">
      <img src="image/expand.png" class="expand_button_inside" id="expand_icon_h" onclick="close_history()">

      <div class="date_chat" id="date_chat">
      </div>

    </div>
  </div>

  <h2>
  
    <nav id="Navbar" class="horizontalNavbar">
            <a href="../index.php">Home</a>
            <a href="ai_chat.php" class="highlight-link">AI Coach</a>
            <a href="../calorie-tracker.php">Calorie Tracker</a>
            <a href="../daily.php">Goals Tracker</a>
            <a href="../recipeRecommendation.php" >Recipes</a> <!-- Highlighted link -->
            <a href="../faq.php">FAQ</a>
            <?php
                if (isset($_SESSION['username'])) {
                  // User is logged in, display logout link
                  echo '<a href="../profile.php">Profile</a>';
                  echo '<a href="../user_logout.php">Log Out</a>';
              } else {
                  // User is not logged in, display login link
                  echo '<a href="../login.php">Log in</a>';
                  echo '<a href="../register.php">Register</a>';
                  echo '<h1 hidden=true id="username">Guest</h1>';
              }
            ?>
        </nav>
    <img src="image/expand.png" class="expand_button_outside" id="expand_icon" onclick="display_history()">
    
  </h2>

  
</header>


<body onload="init()"> 
  
  <?php
    if (isset($_SESSION['username'])) {
      echo '<h1>Conversation for ' . $username . '!😀</h1>';
    } else {
      echo '<h1>Conversation </h1>';
    }
  ?>

  <div id="chat" class="chat-box">
  </div>

  <div class="hover-element">Common questions you may have
    <div class="popup-box">
      <p id="boxQuestion" onclick="directMessage('How many calories should I eat?')">How many calories should I eat?</p>
      <p id="boxQuestion" onclick="directMessage('Recommend me a healthy meal?')">Recommend me a healthy meal?</p>
      <p id="boxQuestion" onclick="directMessage('What exercise is best for lose weight?')">What exercise is best for lose weight?</p>
      <p id="boxQuestion" onclick="directMessage('What exercise is best for gain muscle?')">What exercise is best for gain muscle?</p>
    </div>
  </div>

  <div class="input">
    <textarea type="text" id="userInput" placeholder="Please type the question you have..." oninput="adjustHeight(this)"></textarea>
    <button id="send-button" onclick="sendMessage()">Send</button>
    <div id="username" style="display:none;">
      <?php 
        if (isset($_SESSION['username'])){
          echo htmlspecialchars($username, ENT_QUOTES, 'UTF-8');
        }else{
          echo "Guest";
        }
        ?>
    </div>
  </div>

  <div class="icon_window" id="icon_window">
    <div class="popup">
      <h4>Please choose/upload the image for the AI</h4>

      <div class="icon-options">
        <img src="image/ai_img/ai_img1.jpg" class="icon-option" onclick="document.getElementById('icon_window').style.display='none'">
        <img src="image/ai_img/ai_img2.jpg" class="icon-option" onclick="document.getElementById('icon_window').style.display='none'">
        <img src="image/ai_img/ai_img.jpg" class="icon-option" onclick="document.getElementById('icon_window').style.display='none'">
      </div>

      <label class="upload-btn">
        <img src="image/ai_img/upload_icon.png" alt="Upload">
      </label>

      <input type="file" id="avatar-upload" accept="image/*" style="display: none;">
      <span class="close-btn" id="close-btn" onclick="close_popup()">X</span>

    </div>
  </div>

</body>

<script src="ai_chat.js"></script>
<script src="ai_chat_webstyle.js"></script>


</html>