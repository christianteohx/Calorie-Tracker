<?php
    include 'DB_connect.php';

    function user_regi($username, $password, $confirm_pw, $phone, $email){
        global $conn;

        if ($password !== $confirm_pw) {
            return " Passwords do not match.";
        }

        $check_sql = "SELECT id, username, password FROM user WHERE username LIKE (?) ";
        $check_prep = mysqli_prepare($conn, $check_sql);

        if (!$check_prep){
            return " Error in SQL prep: " . mysqli_error($conn);
        }

        mysqli_stmt_bind_param($check_prep, "s", $username);

        if (!mysqli_stmt_execute($check_prep)) {
            return " Error in SQL query execution: " . mysqli_error($conn);
        }

        mysqli_stmt_store_result($check_prep);

        if (mysqli_stmt_num_rows($check_prep) > 0) {
            mysqli_stmt_close($check_prep);
            return " Username is already taken.";
        }
        mysqli_stmt_close($check_prep);

        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO user (username, password, phone, email) VALUES (?, ?, ?, ?)";
        $prep = mysqli_prepare($conn, $sql);

        if (!$prep){
            return " Error in SQL prep: " . mysqli_error($conn);
        }

        mysqli_stmt_bind_param($prep, "ssss", $username, $hashed_password, $phone, $email);

        if (!mysqli_stmt_execute($prep)) {
            return " Error in SQL query execution: " . mysqli_error($conn);
        }
    
        mysqli_stmt_close($prep);
    
        return 1;
    }
?>