<?php
include 'db.php';
global $conn;

$sql = "DELETE FROM chat_history WHERE date < DATE_SUB(NOW(), INTERVAL 7 DAY)";

if ($conn->query($sql) === TRUE) {
    echo "Chat history cleaned successfully";
} else {
    echo "Error cleaning chat history: " . $conn->error;
}


?>