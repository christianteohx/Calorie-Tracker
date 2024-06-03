<?php
    session_start();

    $_SESSION['prev_page'] = $_SERVER['REQUEST_URI'];

    // if (isset($_SESSION['username'])) {
    //     // echo "<script>alert('You are logged in already');</script>";
    //     // header("Location: index.php");
    //     $delay = 0;
    //     echo "<script>
    //         alert('You are logged in already');
    //         setTimeout(function() {
    //             window.location.href = 'index.php';
    //         }, " . ($delay * 1000) . ");
    //       </script>";
    //     exit();
    // }

    include 'user_reset.php';

    if (isset($_POST["submit"])) {
        $old_pw = $_POST["userPassword"];
        $new_pw = $_POST["confirmpassword"];
        $email = $_POST["useremail"];

        $errors = array();

        if (empty($username) OR  empty($pw) OR empty($confirm_pw) OR empty($phone) OR empty($email)) {
            array_push($errors, "ALL Fields Are Required");
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            array_push($errors, "Email is not valid");
        }
        else {
            $result = user_reset($email, $old_pw, $new_pw);
            echo $result;
            echo "<script>alert('$result');</script>";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>reset</title>
    <style type="text/css">
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
        .xiao-container {
            width: 100%;
        }
        .xiao-register-box {
            position: relative;
            width: 800px;
            height: 530px;
            top: 50px;
            margin: 0 auto;
            z-index: 99999;
            background-color: white;
            border: 7px solid gray;
        }
        .xiao-title-box {
            position: absolute;
            width: 300px;
            height: 300px;
            margin-left: 0px;
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
            margin-left: 230px;
            margin-top: 100px;
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
            /* position: absolute;
            width: 480px;
            height: 40px;
            line-height: 40px;
            margin-left: 230px;
            margin-top: 200px;
            font-weight: 700; */
            position: absolute;
            width: 480px;
            height: 40px;
            line-height: 40px;
            margin-left: 230px;
            margin-top: 100px;
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
            /* position: absolute;
            width: 480px;
            height: 40px;
            line-height: 40px;
            margin-left: 230px;
            margin-top: 300px;
            font-weight: 700; */
            position: absolute;
            width: 480px;
            height: 40px;
            line-height: 40px;
            margin-left: 230px;
            margin-top: 200px;
            font-weight: 700;
        }
        .xiao-confirmpassword-input {
            display: block;
            margin-left: 10px;
        }
        #confirmpassword {
            height: 35px;
            width: 290px;
            border: 2px solid #ccc;
            border-radius: 5px;
        }
        .xiao-userPhone-box {
            position: absolute;
            width: 480px;
            height: 40px;
            line-height: 40px;
            margin-left: 230px;
            margin-top: 400px;
            font-weight: 700;
        }
        .xiao-userPhone-input {
            display: block;
            margin-left: 10px;
        }
        #userPhone {
            height: 35px;
            width: 290px;
            border: 2px solid #ccc;
            border-radius: 5px;
        }
        .xiao-useremail-box {
            /* position: absolute;
            width: 480px;
            height: 40px;
            line-height: 40px;
            margin-left: 230px;
            margin-top: 500px;
            font-weight: 700; */
            position: absolute;
            width: 480px;
            height: 40px;
            line-height: 40px;
            margin-left: 230px;
            margin-top: 300px;
            font-weight: 700;
        }
        .xiao-useremail-input {
            display: block;
            margin-left: 10px;   
        }
        #useremail {
            height: 35px;
            width: 290px;
            border: 2px solid #ccc;
            border-radius: 5px;
        }
        .xiao-submit-box {
            position: absolute;
            width: 100px;
            height: 40px;
            line-height: 40px;
            margin-left: 350px;
            margin-top: 450px;
            background: gray;
            border-radius: 5px;
            overflow: hidden;
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
        @media screen and (max-width: 600px) {
            .xiao-container {
                width: 95%;
            }
            .xiao-register-box {
                width: 100%;
                /* position: relative;
                width: 560px;
                height: 800px;
                top: 100px;
                left: 30px;
                margin: 0 auto;
                z-index: 99999;
                background-color: white;
                border: 7px solid gray; */
            }
            .xiao-title-box {
                /* position: absolute;
                width: 300px;
                height: 300px; */
                width: 100%;
                margin-left: -110px;
                margin-top: 20px;
                text-align: center;
                font-size: 28px;
                color: black;
                font-weight: 800;
                font-weight: 50px;
            }
            .xiao-username-box {
                /* position: absolute;
                width: 480px;
                height: 40px; */
                width: 100%;
                line-height: 40px;
                margin-left: 40px;
                margin-top: 100px;
                font-weight: 700;
            }
            .xiao-userPassword-box {
                /* position: absolute;
                width: 480px;
                height: 40px; */
                width: 100%;
                line-height: 40px;
                margin-left: 40px;
                margin-top: 200px;
                font-weight: 700;
            }
            .xiao-confirmpassword-box {
                /* position: absolute;
                width: 480px;
                height: 40px; */
                width: 100%;
                line-height: 40px;
                margin-left: 40px;
                margin-top: 300px;
                font-weight: 700;
            }
            .xiao-userPhone-box {
                /* position: absolute;
                width: 480px;
                height: 40px; */
                width: 100%;
                line-height: 40px;
                margin-left: 40px;
                margin-top: 400px;
                font-weight: 700;
            }
            .xiao-useremail-box {
                /* position: absolute;
                width: 480px;
                height: 40px; */
                width: 100%;
                line-height: 40px;
                margin-left: 40px;
                margin-top: 500px;
                font-weight: 700;
            }
            .xiao-submit-box {
                position: absolute;
                width: 100px;
                height: 40px;
                line-height: 40px;
                margin-left: 140px;
                margin-top: 650px;
                background: gray;
                border-radius: 5px;
            }
            /* #navToggle {
                position: absolute;
                top: 20px;
                left: 20px;
                background: #333;
                color: white;
                border: 2px solid gray;
                padding: 10px 20px;
                cursor: pointer;
                z-index: 999;
            }
            #verticalNavbar {
                display: none;
                background-color: #333; 
                padding: 80px 20px;
                background: #444343;
                width: 160%;
                height: 14%;
            }
            #verticalNavbar a {
                display: block;
                text-decoration: none;
                color: #fff;
                padding: 10px 15px; 
                transition: background-color 0.3s; 
            }
            #verticalNavbar a:hover {
                background-color: #555;
            }
            #btn {
                margin-left: 50%;
                transform: translateX(-50%);
            } */
            header {
                width: 100%;
                /* min-width: 200px;
                width: 650px;
                background-color: #000000;
                padding: 20px 0;
                text-align: center; */
            }
            #verticalNavbar {
                display: none;
                background-color: #333;
                padding: 10px;
            }
            #verticalNavbar a {
                display: block;
                text-decoration: none;
                color: #fff;
                padding: 10px 15px;
                transition: background-color 0.3s;
            }
            #verticalNavbar a:hover {
                background-color: #555;
            }
        }
    </style>
</head>
<header>
    <!-- <button id="navToggle">Menu</button> -->
    <nav id="verticalNavbar">
        <a href="index.php">Home</a>
        <a href="static/ai_chat.php">AI Chat</a>
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
            <!-- <?php
                // include 'user_regi.php';
                // if (isset($_POST["submit"])) {
                //     $username = $_POST["username"];
                //     $pw = $_POST["userPassword"];
                //     $confirm_pw = $_POST["confirmpassword"];
                //     $phone = $_POST["userPhone"];
                //     $email = $_POST["useremail"];

                //     $errors = array();

                //     if (empty($username) OR  empty($pw) OR empty($confirm_pw) OR empty($phone) OR empty($email)) {
                //         array_push($errors, "ALL Fields Are Required");
                //     }
                //     if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                //         array_push($errors, "Email is not valid");
                //     }
                //     else {
                //         $result = user_regi($username, $pw, $confirm_pw, $phone, $email);
                //         echo $result;
                //     }
                // }
            ?> -->
            <div class="xiao-title-box">
                <span>Reset</span>
            </div>
            <form action="reset.php" method="post">
                <!-- <div class="xiao-username-box">
                    <span class="xiao-require">*</span>
                    <label for="username">Username</label>
                    <div class="xiao-username-input">
                        <input type="text" name="username" id="username" placeholder="Please enter username"/>
                    </div>
                </div> -->
                    
                <div class="xiao-userPassword-box">
                    <span class="xiao-require">*</span>
                    <label for="userPassword">Old Password</label>
                    <div class="xiao-userPassword-input">
                        <input type="password" name="userPassword" id="userPassword" placeholder="Please enter password"/>
                    </div>
                </div>
                    
                <div class="xiao-confirmpassword-box">
                    <span class="xiao-require">*</span>
                    <label for="confirmpassword">New Passowrd</label>
                    <div class="xiao-confirmpassword-input">
                        <input type="password" name="confirmpassword" id="confirmpassword" placeholder="Please confirm your username"/>
                    </div>
                </div>
                    
                <!-- <div class="xiao-userPhone-box">
                    <span class="xiao-require">*</span>
                    <label for="userPhone">Phone Number</label>
                    <div class="xiao-userPhone-input">
                        <input type="tel" name="userPhone" id="userPhone" placeholder="Please enter phone Number"/><br />
                        <span id="phoneError" style="color: red;"></span>
                    </div>
                </div> -->
                    
                <div class="xiao-useremail-box">
                    <span class="xiao-require">*</span>
                    <label for="useremail">Email Address</label>
                    <div class="xiao-useremail-input">
                        <input type="email" name="useremail" id="useremail" placeholder="Please enter email address" required/><br />
                        <span id="emailError" style="color: red;"></span>
                    </div>
                </div>

                <div class="xiao-submit-box">
                    <!-- <button type="button" id="btn" onclick="threeFn()">Register</button> -->
                    <!-- <button type="submit" id="btn">Register</button> -->
                    <div class="xiao-submit-input">
                        <input type="submit" class="btn btn-primary" value="Reset" name="submit">
                    </div>
                </div>
                
            </form>
        </div>
    </div>
</body>

<script>
    // var success_message = "{{ success_message }}"
    // if (success_message) {
    //     alert(success_message);
    //     setTimeout(function() {
    //         window.location.href = "/login_page";
    //     }, 0)
    // }

    const navToggle = document.getElementById('navToggle');
    const verticalNavbar = document.getElementById('verticalNavbar');

    navToggle.addEventListener('click', () => {
        if (verticalNavbar.style.display === 'block') {
            verticalNavbar.style.display = 'none';
        } else {
            verticalNavbar.style.display = 'block';
        }
    });
</script>

</html>