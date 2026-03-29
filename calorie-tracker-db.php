<?php
$host = getenv('DB_HOST') ?: 'localhost';
$username = getenv('DB_USER') ?: 'root';
$password = getenv('DB_PASS') ?: '';
$database = getenv('DB_NAME') ?: 'cse442_2023_fall_team_z_db';

$conn = mysqli_connect($host, $username, $password, $database);

if(!$database) {
    die('Could not Connect MySQL Server:' .mysqli_connect_errno());
}
?>
