<?php
    $host = "oceanus.cse.buffalo.edu"; 
    $username =  'jingdu'; 
    $password =  '50355475'; 
    $database = 'cse442_2023_fall_team_z_db'; 

    $conn = mysqli_connect($host, $username, $password, $database);

    if(!$conn) {
        die('Could not Connect MySQL Server:' .mysqli_connect_errno());
        
    }
    

?>