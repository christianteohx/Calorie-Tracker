<?php
  session_start();
  include 'user_profile.php';
  $_SESSION['prev_page'] = $_SERVER['REQUEST_URI'];

  if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    // echo "<script>alert('Welcome, $username!');</script>";
    $userProfile = user_profile($username);
    $email = $userProfile['email'];
    $phone = $userProfile['phone_number'];
    $result = search_profile($username);
    $birthday = $result['birthday'];
    $description = $result['description'];
    // $birthday = isset($_SESSION['birthday']) ? $_SESSION['birthday'] : ''; // Check if birthday is set
    // $description = isset($_SESSION['description']) ? $_SESSION['description'] : '';
  }


if (isset($_POST['save-1'])) {
    $newUsername = $_POST['new-username'];
    $newPassword = $_POST['new-password'];
    $newEmail = $_POST['new-email'];
    $newPhone = $_POST['new-phone'];

    $hashed_password = password_hash($newPassword, PASSWORD_DEFAULT);

    $checkUsernameQuery = "SELECT username FROM user WHERE username = ?";
    $checkStmt = mysqli_prepare($conn, $checkUsernameQuery);

    if ($checkStmt) {
        mysqli_stmt_bind_param($checkStmt, "s", $newUsername);
        mysqli_stmt_execute($checkStmt);
        mysqli_stmt_store_result($checkStmt);

        if (mysqli_stmt_num_rows($checkStmt) > 0) {
            // Username already exists, display an alert
            // echo '<script>alert("Username already exists. Please choose a different username.");</script>';
            die(("Username already exists. Please choose a different username."));
        } else {
            // Update username, password, email, and phone in the user table
            $updateQuery = "UPDATE user SET username = ?, password = ?, phone = ?, email = ? WHERE username = ?";
            $stmt = mysqli_prepare($conn, $updateQuery);

            if ($stmt) {
                mysqli_stmt_bind_param($stmt, "sssss", $newUsername, $hashed_password, $newPhone, $newEmail, $_SESSION['username']);
                
                if (mysqli_stmt_execute($stmt)) {
                    // Update successful
                    $_SESSION['username'] = $newUsername; // Update the session username
                    header("Location: index.php"); // Redirect back to the profile page
                    exit();
                } else {
                    // Error executing query
                    die("Error updating data: " . mysqli_error($conn));
                }

                mysqli_stmt_close($stmt);
            } else {
                // Error preparing the statement
                die("Error preparing statement: " . mysqli_error($conn));
            }
        }

        mysqli_stmt_close($checkStmt);
    } else {
        // Error preparing the statement
        die("Error preparing statement: " . mysqli_error($conn));
    }

    // Update username, password, email, and phone in the user table
    // $updateQuery = "UPDATE user SET username = ?, password = ?, phone = ?, email = ? WHERE username = ?";
    // $stmt = mysqli_prepare($conn, $updateQuery);

    // if ($stmt) {
    //     mysqli_stmt_bind_param($stmt, "sssss", $newUsername, $hashed_password, $newPhone, $newEmail, $_SESSION['username']);
        
    //     // echo($stmt);

    //     if (mysqli_stmt_execute($stmt)) {
    //         // Update successful
    //         $_SESSION['username'] = $newUsername; // Update the session username
    //         header("Location: index.php"); // Redirect back to the profile page
    //         exit();
    //     } else {
    //         // Error executing query
    //         die("Error updating data: " . mysqli_error($conn));
    //     }

    //     mysqli_stmt_close($stmt);
    // } else {
    //     // Error preparing the statement
    //     die("Error preparing statement: " . mysqli_error($conn));
    // }
}

  if (isset($_POST['save-2'])) {
    // Retrieve and validate form data
    $newBirthday = $_POST['Birthday'];
    $newDescription = $_POST['description'];

    $_SESSION['birthday'] = $newBirthday;
    $_SESSION['description'] = $newDescription;

    // Insert data into the user_profile table
    $insertQuery = "INSERT INTO user_profile (username, birthday, description) VALUES (?, ?, ?)";
    $stmt = mysqli_prepare($conn, $insertQuery);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "sss", $username, $newBirthday, $newDescription);

        if (mysqli_stmt_execute($stmt)) {
            // Insertion successful
            header("Location: profile.php"); // Redirect back to the profile page
            exit();
        } else {
            // Error executing query
            echo "Error inserting data: " . mysqli_error($conn);
        }

        mysqli_stmt_close($stmt);
    } else {
        // Error preparing the statement
        echo "Error preparing statement: " . mysqli_error($conn);
    }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <style>
        body {
            font:16px Arial, sans-serif;
            background-color: #333;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #000000; 
            text-align: center;
            padding: 30px 0;
        }


        #verticalNavbar {
            display: flex;
            justify-content: center;
            padding: 0;
            margin: 0;
            list-style-type: none;
        }

        #verticalNavbar a {
            display: block;
            text-decoration: none;
            color: gray;
            padding: 10px 15px;
            margin: 0 10px;
            transition: color 0.3s;
            font-size: 16px;
        }

        #verticalNavbar a:hover {
            color: white;
        }

        #verticalNavbar a.highlight-link {
            color: white;
            font-size: 20px;
        }

        .container {
            position: relative;
            width: 800px;
            height: 500px;
            top: 20px;
            margin: 0 auto;
            z-index: 99999;
            background-color: white;
            border: 7px solid gray;
        }

        .profile-header {
            text-align: center;
            padding: 20px 0;
        }

        .profile-picture {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
        }

        .profile-name {
            font-size: 24px;
            font-weight: bold;
            margin-top: 10px;
        }

        .profile-content {
            display: flex; /* Using flexbox */
            justify-content: space-around; /* Distributes space around items */
            align-items: flex-start; /* Aligns items to the start of the flex container */
        }

        /* .profile-info {
            margin-top: 50px;
            margin-left: 50px;
        } */

        .profile-info,
        .profile-info2 {
            padding: 20px 80px;
            flex-basis: 50%; 
        }

        .profile-info h2 {
            font-size: 20px;
        }

        .profile-info p {
            font-size: 16px;
            line-height: 1.5;
        }
        /* .profile-info2 {
            margin-top: 50px;
            margin-left: 150px;
        } */
        /* Add more styling as needed */
        @media screen and (max-width: 600px) {

            #verticalNavbar {
                display: flex;
                flex-wrap: wrap; 
                justify-content: center; 
                align-items: center; 
            }

            #verticalNavbar a {
                padding: 5px 10px;
                font-size: 14px;
                margin: 5px;
            }
            .container {
                width: 95%;
                height: 120%;
            }
            .profile-content {
                display: block; /* Stacks children vertically on mobile screens */
            }

            .profile-info,
            .profile-info2 {
                /* On mobile, each section takes full width and adjusted margins if needed */
                flex-basis: 100%;
                margin: 10px 20px; /* Adjusted margin for mobile view */
            }
        }
    </style>
</head>
<header>
    <nav id="verticalNavbar">
        <a href="index.php">Home</a>
        <a href="static/ai_chat.php">AI Coach</a>
        <a href="calorie-tracker.php">Calorie Tracker</a>
        <a href="daily.php">Goals Tracker</a>
        <a href="recipeRecommendation.php">Recipes</a> <!-- Highlighted link -->
        <a href="faq.php">FAQ</a>
        <a href="profile.php" class="highlight-link">Profile</a>
        <?php
            if (!isset($_SESSION['username'])) {
                echo '<a href="register.php">Register</a >';
            }
        ?>
        <?php
            if (!isset($_SESSION['username'])) {
                echo '<a href="login.php">Log in</a>'; 
            } else {
                // echo '<a href="profile.php" class="highlight-link">Profile</a>';
                echo '<a href="user_logout.php">Log Out</a>'; 
            }
        ?>
    </nav>
</header>
<body>
    <div class="container">
        <div class="profile-header">
            <!-- <div class="profile-name">John Doe</div> -->
            <?php if (isset($_SESSION['username'])) : ?>
                <div class="profile-name"><?php echo $username; ?></div>
            <?php else : ?>
                <div class="profile-name">Welcome, stranger!</div>
            <?php endif; ?>
        </div>
        
        <div class="profile-content">
            <div class="profile-info" id="view-mode-2">
                <h2>User Information</h2>
                <p><strong>Username:</strong> <?php echo $username; ?></p>
                <!-- <p><strong>First Name:</strong> John</p>
                <p><strong>Last Name:</strong> Doe</p> -->
                <p><strong>Email:</strong> <?php echo $email; ?></p>
                <p><strong>Phone Number:</strong> <?php echo $phone; ?></p>
                <button id="edit-button-1">Edit</button>
            </div>
    
            <div class="profile-info2" id="view-mode-1">
                <p><strong>Birthday:</strong> <?php echo $birthday; ?></p>
                <p><strong>Personal Descprition:</strong> <?php echo $description; ?></p>
                <button id="edit-button-2">Edit</button>
            </div>
        </div>

        <div class="profile-info2" id="edit-mode-1" style="display: none;">
            <!-- Display input fields for editing username and password -->
            <h2>Edit User Information</h2>
            <form method="POST" action="profile.php">
                <!-- Input fields for editing username and password -->
                <div style="margin-bottom: 20px;">
                    <label for="new-username">New Username:</label>
                    <input type="text" name="new-username" id="new-username" value="" required>
                    
                    <label for="new-password">New Password:</label>
                    <input type="password" name="new-password" id="new-password" value="" required>
                </div>
                
                <div style="margin-bottom: 20px;">
                    <label for="new-email">New Email:</label>
                    <input type="email" name="new-email" id="new-email" value="" required>

                    <label for="new-phone">New Phone:</label>
                    <input type="phone" name="new-phone" id="new-phone" value="" required>

                    <button type="submit" name="save-1">Save</button>
                    <button id="cancel-button-1">Cancel</button>
                </div>

                <!-- Add more input fields for other information -->
                
                <!-- <button type="submit" name="save">Save</button>
                <button id="cancel-button-1">Cancel</button> -->
            </form>
        </div>

        <div class="profile-info2" id="edit-mode-2" style="display: none;">
            <!-- Display input fields for editing in edit mode -->
            <h2>Edit User Information</h2>
            <form method="POST" action="profile.php">
                <!-- Input fields for editing -->
                <label for="birthday">Birthday:</label>
                <input type="text" name="Birthday" id="Birthday" value="" required>

                <label for="description">Personal Description:</label>
                <input type="text" name="description" id="description" value="" required>

                <!-- Add more input fields for other information -->
                
                <button type="submit" name="save-2">Save</button>
                <button id="cancel-button-2">Cancel</button>
            </form>
        </div>
    </div>
</body>
</html>
<script>
    // JavaScript code to toggle between view and edit modes
    // document.getElementById("edit-button-1").addEventListener("click", function() {
    //     document.getElementById("view-mode").style.display = "none";
    //     document.getElementById("edit-mode").style.display = "block";
    // });

    // document.getElementById("edit-button-2").addEventListener("click", function() {
    //     document.getElementById("view-mode").style.display = "none";
    //     document.getElementById("edit-mode").style.display = "block";
    // });

    // document.getElementById("cancel-button-1").addEventListener("click", function() {
    //     event.preventDefault(); // Prevent form submission
    //     document.getElementById("view-mode").style.display = "block";
    //     document.getElementById("edit-mode").style.display = "none";
    // });

    document.getElementById("edit-button-1").addEventListener("click", function() {
        document.getElementById("view-mode-1").style.display = "none";
        document.getElementById("edit-mode-1").style.display = "block";
    });

    document.getElementById("edit-button-2").addEventListener("click", function() {
        document.getElementById("view-mode-2").style.display = "none";
        document.getElementById("edit-mode-2").style.display = "block";
    });

    document.getElementById("cancel-button-1").addEventListener("click", function() {
        event.preventDefault(); // Prevent form submission
        document.getElementById("view-mode-1").style.display = "block";
        document.getElementById("edit-mode-1").style.display = "none";
    });

    document.getElementById("cancel-button-2").addEventListener("click", function() {
        event.preventDefault(); // Prevent form submission
        document.getElementById("view-mode-2").style.display = "block";
        document.getElementById("edit-mode-2").style.display = "none";
    });
</script>