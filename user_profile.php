<?php
include 'DB_connect.php';

function user_profile($username) {
    global $conn;

    // Define the SQL query to fetch email and phone number for the given username
    $sql = "SELECT email, phone FROM user WHERE username LIKE (?)";
    
    // Prepare the SQL statement
    $stmt = mysqli_prepare($conn, $sql);

    if (!$stmt) {
        // Handle the prepare error
        die("Prepare failed: " . mysqli_error($conn));
    }

    // Bind the username parameter
    mysqli_stmt_bind_param($stmt, "s", $username);

    // Execute the prepared statement
    if (mysqli_stmt_execute($stmt)) {
        // Bind the result variables
        mysqli_stmt_bind_result($stmt, $email, $phone_number);

        // Fetch the results
        if (mysqli_stmt_fetch($stmt)) {
            // Create an associative array with email and phone_number
            $userProfile = [
                'email' => $email,
                'phone_number' => $phone_number
            ];
            
            // Close the statement
            mysqli_stmt_close($stmt);

            // Return the user profile data
            return $userProfile;
        }
    }

    // Close the statement
    mysqli_stmt_close($stmt);

    // Return null if user not found or an error occurred
    return null;
}

function search_profile($username){
    global $conn;

    $query = "SELECT birthday, description FROM user_profile WHERE username = ? ORDER BY id DESC LIMIT 1";

    $stmt = mysqli_prepare($conn, $query);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "s", $username);

        if (mysqli_stmt_execute($stmt)) {
            mysqli_stmt_bind_result($stmt, $latestBirthday, $latestDescription);

            if (mysqli_stmt_fetch($stmt)) {
                // Return both the latest birthday and description
                $result = array(
                    'birthday' => $latestBirthday,
                    'description' => $latestDescription
                );
                return $result;
                // You can use $result['birthday'] and $result['description'] as needed
                // echo "Latest Birthday: " . $result['birthday'] . "<br>";
                // echo "Latest Description: " . $result['description'] . "<br>";
            } else {
                // No matching records found
                die("No records found for this user.");
            }
        } else {
            // Error executing query
            die("Error executing query: " . mysqli_error($conn));
        }

        mysqli_stmt_close($stmt);
    } else {
        // Error preparing the statement
        die("Error preparing statement: " . mysqli_error($conn));
    }
}
