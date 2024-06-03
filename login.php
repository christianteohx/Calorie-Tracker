<?php 
    session_start();

    $_SESSION['referrer'] = $_SERVER['HTTP_REFERER'];

    if (isset($_SESSION['username'])) {
        // echo "<script>alert('You are logged in already');</script>";
        // header("Location: index.php");
        $delay = 0;
        echo "<script>
            alert('You are logged in already');
            setTimeout(function() {
                window.location.href = 'index.php';
            }, " . ($delay * 1000) . ");
          </script>";
        exit();
    }

    include 'user_login.php';
    if (isset($_POST["submit"])) {
        $username = $_POST["username"];
        $pw = $_POST["userPassword"];

        $errors = array();

        if (empty($username) OR  empty($pw)) {
            array_push($errors, "ALL Fields Are Required");
        }
        else {
            $result = user_login($username, $pw);
            if ($result == 1){// success log in
                $_SESSION['username'] = $username;
                $test_username = $_SESSION['username'];
                if (isset($_SESSION['prev_page'])) {
                    // Redirect the user back to the referrer page
                    // if ($_SESSION['prev_page'] == '/cse442/project/register.php'){
                    //     header("Location: daily.php");
                    // }
                    if (strpos($_SESSION['prev_page'], 'register.php') !== false) {
                        header("Location: index.php");
                    }
                    if (strpos($_SESSION['prev_page'], 'reset.php') !== false) {
                        header("Location: index.php");
                    }
                    else {
                        header("Location: " . $_SESSION['prev_page']);
                        exit();
                    }
                } 
                else {
                    // Redirect to a default page if there's no referrer
                    header("Location: index.php"); // Replace with your desired default page
                    exit();
                }
            }
            else{
                echo " username or password is incorrect";
            }
        }
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style type="text/css">
        body {
            font:16px Arial, sans-serif;
            background-color: #333;
            margin: 0;
            padding: 0;
        }
        .xiao-container {
            width: 100%;
        }
        .xiao-register-box {
            position: relative;
            width: 600px;
            height: 400px;
            top: 130px;
            margin: 0 auto;
            z-index: 99999;
            background-color: white;
            border: 7px solid gray;
        }
        .xiao-title-box {
            position: absolute;
            width: 300px;
            height: 300px;
            margin-left: -50px;
            margin-top: 40px;
            text-align: center;
            font-size: 28px;
            color: black;
            font-weight: 800;
            font-weight: 50px;
        }
        .xiao-username-box {
            position: absolute;
            width: 480px;
            height: 40px;
            line-height: 40px;
            margin-left: 150px;
            margin-top: 80px;
            font-weight: 700;
        }
        .xiao-username-input {
            display: block;
            margin-left: 10px;
        }
        #username {
            height: 35px;
            width: 290px;
            border: 2px solid #ccc;
            border-radius: 5px;
        }
        .xiao-userPassword-box {
            position: absolute;
            width: 480px;
            height: 40px;
            line-height: 40px;
            margin-left: 150px;
            margin-top: 180px;
            font-weight: 700;
        }
        .xiao-userPassword-input {
            display: block;
            margin-left: 10px;
        }
        #userPassword {
            height: 35px;
            width: 290px;
            border: 2px solid #ccc;
            border-radius: 5px;
        }
        .xiao-confirmpassword-box {
            position: absolute;
            width: 480px;
            height: 40px;
            line-height: 40px;
            margin-left: 162px;
            margin-top: 270px;
            font-weight: 700;
        }
        .xiao-reset-box {
            position: absolute;
            width: 480px;
            height: 40px;
            line-height: 40px;
            margin-left: 420px;
            margin-top: 270px;
            font-weight: 700;
        }
        .xiao-submit-box {
            position: absolute;
            width: 100px;
            height: 40px;
            line-height: 40px;
            margin-left: 250px;
            margin-top: 330px;
            background: gray;
            border-radius: 5px;
        }
        .xiao-submit-input {
            width: 100%;
            height: 100%;
        }
        .btn-primary {
            width: 100%; /* Make the button width fill the container */
            height: 100%; /* Make the button height fill the container */
            border: none; /* Remove the button border */
            border-radius: 0; /* Remove the button's border-radius */
            background: gray; /* Set the button's background to gray */
            color: white; /* Set the button text color to white */
        }
        #btn {
            display: inline-block;
            width: 100px;
            height: 40px;
            background: gray;
            border-radius: 5px;
        }
        .xiao-require {
            color: red;
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
        @media (max-width: 768px) {
            .xiao-container {
                width: 95%;
            }
            .xiao-register-box {
                /* position: relative; */
                width: 100%;
                /* max-width: 400px; */
                /* height: 400px;
                top: 100px;
                left: 100px; */
                /* margin: 0 auto;
                z-index: 99999;
                background-color: white;
                border: 7px solid gray; */
            }
            .xiao-title-box {
                width: 100%;
                margin-left: -110px;
                margin-top: 20px;
                text-align: center;
                font-size: 28px;
                color: black;
                font-weight: 800;
                font-weight: 50px;
                /* position: absolute;
                width: 300px;
                height: 300px;
                margin-left: -90px;
                margin-top: 20px;
                text-align: center;
                font-size: 28px;
                color: black;
                font-weight: 800;
                font-weight: 50px; */
            }
            .xiao-username-box {
                width: 100%;
                line-height: 40px;
                margin-left: 30px;
                margin-top: 80px;
                font-weight: 700;
                /* position: absolute;
                width: 480px;
                height: 40px;
                line-height: 40px;
                margin-left: 80px;
                margin-top: 80px;
                font-weight: 700; */
            }
            .xiao-userPassword-box {
                width: 100%;
                line-height: 40px;
                margin-left: 30px;
                margin-top: 180px;
                font-weight: 700;
                /* position: absolute;
                width: 480px;
                height: 40px;
                line-height: 40px;
                margin-left: 80px;
                margin-top: 180px;
                font-weight: 700; */
            }
            .xiao-confirmpassword-box {
                width: 100%;
                line-height: 40px;
                margin-left: 42px;
                margin-top: 270px;
                font-weight: 700;
                /* position: absolute;
                width: 480px;
                height: 40px;
                line-height: 40px;
                margin-left: 92px;
                margin-top: 270px;
                font-weight: 700; */
            }
            .xiao-submit-box {
                position: absolute;
                width: 100px;
                height: 40px;
                line-height: 40px;
                margin-left: 140px;
                margin-top: 330px;
                background: gray;
                border-radius: 5px;
            }
            header {
                font-size: 14px; 
            }

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
        }
    </style>
</head>
<header>
    <!-- <button id="navToggle">Menu</button> -->
    <nav id="verticalNavbar">
        <a href="index.php">Home</a>
        <a href="static/ai_chat.php">AI Couch</a>
        <a href="calorie-tracker.php">Calorie Tracker</a>
        <a href="daily.php">Goals Tracker</a>
        <a href="recipeRecommendation.php">Recipes</a>
        <a href="faq.php">FAQ</a>
        <a href="login.php" class="highlight-link">Log in</a>
        <a href="register.php">Register</a>
      <!-- <a href="user_logout.php">Log out</a> -->
    </nav>
</header>
<body>
    <div class="xiao-container">
        <div class="xiao-register-box">
            <?php
                // include 'user_login.php';
                // if (isset($_POST["submit"])) {
                //     $username = $_POST["username"];
                //     $pw = $_POST["userPassword"];

                //     $errors = array();

                //     if (empty($username) OR  empty($pw)) {
                //         array_push($errors, "ALL Fields Are Required");
                //     }
                //     else {
                //         $result = user_login($username, $pw);
                //         if ($result == 1){// success log in
                //             $_SESSION['username'] = $username;
                //             $test_username = $_SESSION['username'];
                //             // header("Location: register.php");
                //         }
                //         else{
                //             echo " username or password is incorrect";
                //         }
                //     }
                // }
                // Check if the user is logged in
                // if (isset($_SESSION['username'])) {
                //     $test_username = $_SESSION['username'];
                //     echo " Welcome, $test_username!";
                // } else {
                //     echo " Welcome, stranger!";
                // }
            ?>
            <div class="xiao-title-box">
                <span>Login</span>
            </div>
            <form action="login.php" method="post">
                <div class="xiao-username-box">
                    <span class="xiao-require">*</span>
                    <label for="username">Username</label>
                    <div class="xiao-username-input">
                        <input type="text" name="username" id="username" placeholder="Please enter username"/>
                    </div>
                </div>
                    
                <div class="xiao-userPassword-box">
                    <span class="xiao-require">*</span>
                    <label for="userPassword">Password</label>
                    <div class="xiao-userPassword-input">
                        <input type="password" name="userPassword" id="userPassword" placeholder="Please enter password"/>
                    </div>
                </div>
                    
                <div class="xiao-confirmpassword-box">
                    <!-- <label for="confirmpassword">Register</label> -->
                    <a href="register.php">Register</a>
                </div>
                <div class="xiao-reset-box">
                    <!-- <label for="confirmpassword">Register</label> -->
                    <a href="reset.php">Reset</a>
                </div>

                <div class="xiao-submit-box">
                    <!-- <button type="button" id="btn" onclick="threeFn()">Login</button> -->
                    <!-- <button type="submit" id="btn">Login</button> -->
                    <div class="xiao-submit-input">
                        <input type="submit" class="btn btn-primary" value="Login" name="submit">
                    </div>
                </div>
                
            </form>
        </div>
    </div>
</body>

<script>
    function threeFn(){
        username = document.getElementById("username").value
        password = document.getElementById("userPassword").value
        // console.log(username);
        // console.log(password);
        // alert("Username: " + username + "\nPassword: " + password)
        // fetch("http://localhost:8080/login", {
        //     method: "POST",
        //     body: JSON.stringify({username_s: username, password_s: password}),
        //     headers:{
        //         "Content-Type": "application/json; charset=UTF-8"
        //     }
        // })
    }
    // var success_message = "{{ success_message }}"
    // if (success_message) {
    //     alert(success_message);
    //     setTimeout(function() {
    //         window.location.href = "/register_page";
    //     }, 0)
    // }

    navToggle.addEventListener('click', () => {
        if (verticalNavbar.style.display === 'block') {
            verticalNavbar.style.display = 'none';
        } else {
            verticalNavbar.style.display = 'block';
        }
    });
</script>


</html>