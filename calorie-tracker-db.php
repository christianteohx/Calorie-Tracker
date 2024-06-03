<?php
$host = "oceanus.cse.buffalo.edu";
$username = "cteo3";
$password = "50357114";
$database = "cse442_2023_fall_team_z_db";

$conn = mysqli_connect($host, $username, $password, $database);

    if(!$database) {
        die('Could not Connect MySQL Server:' .mysqli_connect_errno());
    }

?>