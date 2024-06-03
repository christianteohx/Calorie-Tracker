<?php
    $host = "oceanus.cse.buffalo.edu"; //hostname
    $username =  'xqu2'; //databse username
    $password =  '50355119'; //database password
    $database = 'cse442_2023_fall_team_z_db'; //database name

    $conn = mysqli_connect($host, $username, $password, $database);

    if(!$conn) {
        // die('Could not Connect MySQL Server:' .mysqli_connect_errno());
        die('<span style="color: white;">Could not Connect MySQL Server: </span>'.mysqli_connect_errno());
    }
    // echo "Connected successfully";
    // echo '<span style="color: white;">Connected successfully</span>';

?>