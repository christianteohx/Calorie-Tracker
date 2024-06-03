<?php
    include 'DB_connect.php';

    function user_reset($email, $old_pw, $new_pw){
        global $conn;

        $email = $conn->real_escape_string($email);
        $query = "SELECT * FROM user WHERE email = '$email'";
        $result = $conn->query($query);

        if ($result->num_rows === 0) {
            $msg = "email does not exist";
            return $msg;
        }

        $user = $result->fetch_assoc();
        // print_r($user);
        $hashed_old_pw = $user['password'];
        if (!password_verify($old_pw, $hashed_old_pw)) {
            // Old password doesn't match
            $msg = "Old password doesn't match";
            return $msg;
        }

        $hashed_new_pw = password_hash($new_pw, PASSWORD_DEFAULT);
        $user_id = $user['id'];


        $update_query = "UPDATE user SET password = '$hashed_new_pw' WHERE id = $user_id";
        if ($conn->query($update_query) === TRUE) {
            // Password reset successful
            $msg = "Password reset successful";
            return $msg;
        } else {
            // Password reset failed
            $msg = "Password reset failed";
            // echo "Password reset failed: " . $conn->error . "\n";
            return $msg;
        }

        // Close the database connection
        $conn->close();
        }
?>