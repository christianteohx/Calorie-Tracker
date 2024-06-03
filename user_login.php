<?php
    include 'DB_connect.php';

    function user_login($username, $password){
        global $conn;
    

        $sql = "SELECT id, username, password FROM user WHERE username LIKE (?) ";
        $prep = mysqli_prepare($conn, $sql);

        if (!$prep){
            return " Error in SQL prep: " . mysqli_error($conn);
        }

        mysqli_stmt_bind_param($prep, "s", $username);

        if (!mysqli_stmt_execute($prep)) {
            return " Error in SQL query execution: " . mysqli_error($conn);
        }

        mysqli_stmt_bind_result($prep, $id, $username, $stored_pw);

        if (mysqli_stmt_fetch($prep)) {
            mysqli_stmt_close($prep);

            if (password_verify($password, $stored_pw)) {
                return 1;
            } 
            else {
                return 0;
            }
        } 
        else {
            mysqli_stmt_close($prep);
            return " User not found.";
        }
    }
?>