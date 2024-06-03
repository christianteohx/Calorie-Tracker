<?php
    $host = "oceanus.cse.buffalo.edu"; 
    $username =  'saiwangx'; 
    $password =  '50355193'; 
    $database = 'cse442_2023_fall_team_z_db'; 

    $conn = mysqli_connect($host, $username, $password, $database);

    if(!$conn) {
        die('Could not Connect MySQL Server:' .mysqli_connect_errno());
    }

?>