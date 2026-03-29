<?php
    $host = getenv('DB_HOST') ?: 'localhost';
    $username = getenv('DB_USER') ?: 'root';
    $password = getenv('DB_PASS') ?: '';
    $database = getenv('DB_NAME') ?: 'cse442_2023_fall_team_z_db';

    $conn = mysqli_connect($host, $username, $password, $database);

    if(!$conn) {
        die('<span style="color: white;">Could not Connect MySQL Server: </span>'.mysqli_connect_errno());
    }
?>
