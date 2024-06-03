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
    <title>Recipe Recommendation</title>
    <link rel="stylesheet" href="recipeRecommendation.css">
</head>


<?php
    if (isset($_SESSION['username'])) {
        echo '<body onload=recipeHistory(\'' . htmlspecialchars($username, ENT_QUOTES) . '\')>'; 
    } else {
        echo '<body onload=recipeHistory(\'' . htmlspecialchars("Guest", ENT_QUOTES) . '\')>'; 
    }
?>

    <header>
        <div id="notification" class="notification"></div>
        <nav id="verticalNavbar">
            <a href="index.php">Home</a>
            <a href="static/ai_chat.php">AI Coach</a>
            <a href="calorie-tracker.php">Calorie Tracker</a>
            <a href="daily.php">Goals Tracker</a>
            <a href="recipeRecommendation.php" class="highlight-link">Recipes</a> <!-- Highlighted link -->
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

    
    <div class="menu">

        <div id="controlsWrapper">
            <div id="searchBar">
                <label for="searchInput">Search Recipes:</label>
                <input type="text" id="searchInput" onkeyup="filterRecipes()" placeholder="Enter text...">
            </div>
            <div id="welcome">
                <?php if (isset($username)) : ?>
                <?php endif; ?>
            </div>
            <div id="sortingDropdown">
                <label for="sortOptions">Sort Recipes:</label>
                <select id="sortOptions" onchange="sortRecipes(this.value)">
                    <option value="calories-asc">Calories Ascending</option>
                    <option value="calories-desc">Calories Descending</option>
                    <option value="text-asc">Text Ascending</option>
                    <option value="text-desc">Text Descending</option>
                </select>
            </div>

        </div>
        
        <section id="High-Protein">
            <h1>High-Protein</h1>
            <div class="recipeBox" style="background-color: #c9bfe6;">
                <div class="recipeItem" id="1727763">
                    <h2><a href="https://www.allrecipes.com/recipe/109297/cedar-planked-salmon/">Cedar-Planked Salmon</a></h2>
                    <h2 class="calories">678 Calories</h2>
                </div>
                <div class="recipeItem" id="930385">
                    <h2><a href="https://www.allrecipes.com/skillet-meatballs-recipe-8362352">Skillet Meatballs</a></h2>
                    <h2 class="calories">425 Calories</h2>
                </div>
                <div class="recipeItem" id="986605">
                    <h2><a href="https://www.allrecipes.com/ultimate-tomahawk-steak-recipe-7550363">Ultimate Tomahawk Steak</a></h2>
                    <h2 class="calories">1079 Calories</h2>
                </div>
                <div class="recipeItem" id="536064">
                    <h2><a href="https://www.allrecipes.com/key-west-chicken-and-shrimp-recipe-7972842">Key West Chicken and Shrimp</a></h2>
                    <h2 class="calories">489 Calories</h2>
                </div>
                <div class="recipeItem" id="87731">
                    <h2><a href="https://www.allrecipes.com/baked-asian-rockfish-recipe-7814108">Baked Asian Rockfish</a></h2>
                    <h2 class="calories">105 Calories</h2>
                </div>
                <div class="recipeItem" id="229743">
                    <h2><a href="https://www.allrecipes.com/recipe/8526329/sous-vide-tri-tip/">Sous Vide Tri Tip</a></h2>
                    <h2 class="calories">226 Calories</h2>
                </div>
            </div>
        </section>

        <section id="Low-Fat">
            <h1>Low-Fat</h1>
            <div class="recipeBox" style="background-color: #ADD8E6">
                <div class="recipeItem" id="590452">
                    <h2><a href="https://www.allrecipes.com/recipe/13107/miso-soup/">Miso Soup</a></h2>
                    <h2 class="calories">63 Calories</h2>
                </div>
                <div class="recipeItem" id="594783">
                    <h2><a href="https://www.allrecipes.com/recipe/80969/simple-turkey-chili/">Simple Turkey Chili</a></h2>
                    <h2 class="calories">185 Calories</h2>
                </div>
                <div class="recipeItem" id="484146">
                    <h2><a href="https://www.allrecipes.com/salmon-stir-fry-recipe-7644799">Salmon Stir-Fry</a></h2>
                    <h2 class="calories">372 Calories</h2>
                </div>
                <div class="recipeItem" id="1047051">
                    <h2><a href="https://www.allrecipes.com/recipe/228238/goat-stew/">Goat Stew</a></h2>
                    <h2 class="calories">272 Calories</h2>
                </div>
            </div>
        </section>
        
        <section id="Vegetarian">
            <h1>Vegetarian</h1>
            <div class="recipeBox" style="background-color: rgb(152, 205, 152)">
                <div class="recipeItem" id="723984">
                    <h2><a href="https://www.allrecipes.com/recipe/15084/vegetarian-chili/">Vegetarian Chili</a></h2>
                    <h2 class="calories">582 Calories</h2>
                </div>
                <div class="recipeItem" id="205843">
                    <h2><a href="https://www.allrecipes.com/recipe/25311/vegetarian-moussaka/">Vegetarian Moussaka</a></h2>
                    <h2 class="calories">240 Calories</h2>
                </div>
                <div class="recipeItem" id="537208">
                    <h2><a href="https://www.allrecipes.com/french-apple-cake-recipe-7963451">French Apple Cake</a></h2>
                    <h2 class="calories">287 Calories</h2>
                </div>
                <div class="recipeItem" id="584549">
                    <h2><a href="https://www.allrecipes.com/mango-daiquiri-recipe-7570310">Mango Daiquiri</a></h2>
                    <h2 class="calories">419 Calories</h2>
                </div>
                <div class="recipeItem" id="687289">
                    <h2><a href="https://www.allrecipes.com/pasta-alla-trapanese-sicilian-tomato-pesto-recipe-7571415">Pasta alla Trapanese</a></h2>
                    <h2 class="calories">312 Calories</h2>
                </div>
                <div class="recipeItem" id="740837">
                    <h2><a href="https://www.allrecipes.com/recipe/272896/kale-fiesta-salad/">Kale Fiesta Salad</a></h2>
                    <h2 class="calories">343 Calories</h2>
                </div>
            </div>
        </section>


        <section id="UserAddedRecipes">
            <?php
                if (isset($_SESSION['username'])) {
                echo '<h1>Custom Recipes for ' . $username . '!😀</h1>';

                } 
            ?>
            <div class="recipeBox" id="userRecipesContainer" style="background-color: #eee3a7; " >
            </div>
        </section>

        <section id="AddRecipe">
            <h1>Add Your Recipe</h1>
            <div id="recipeForm">
                <input type="text" id="recipeTitle" placeholder="Recipe Title" required><br>
                <textarea id="recipeIngredients" placeholder="Ingredients" required></textarea><br>
                <textarea id="recipeInstructions" placeholder="Instructions" required></textarea><br>
                <input type="number" id="recipeCalories" placeholder="Calories" required><br> 
            
                <?php
                if (isset($_SESSION['username'])) {
                    echo '<button type="submit" onclick="sendMessageToServer(\'' . htmlspecialchars($username, ENT_QUOTES) . '\')">Submit Recipe</button>';
                }else{
                    echo '<button type="submit" onclick="sendMessageToServer(\'Guest\')">Submit Recipe</button>';
                }
                ?>
            </div>
        </section>

    </div>



    <footer>
         <!-- Content for the footer goes here -->
    </footer>

</body>

<script src="recipeRecommendation.js"></script>

</html>