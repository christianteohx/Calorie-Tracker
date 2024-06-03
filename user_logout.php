<?php

    session_start();

    // include 'DB_connect.php';

    $_SESSION = array();

    session_destroy();
    header("Location: login.php");
    exit();
?>