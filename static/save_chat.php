<?php
include 'db.php';
global $conn;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user = $_POST['user'];
    $date = $_POST['date'];
    $response = isset($_POST['response']) ? $_POST['response'] : null; 
    $message = isset($_POST['message']) ? $_POST['message'] : null;

    $stmt = $conn->prepare("INSERT INTO chat_history (user, date, response, message) VALUES (?, ?, ?, ?)");
    if (!$stmt) {
        echo json_encode(['status' => 'error', 'message' => "Prepare failed: (" . $conn->errno . ") " . $conn->error]);
        exit;
    }

    $stmt->bind_param('ssss', $user, $date, $response, $message); 

    if ($stmt->execute()) {
        echo json_encode(['status' => 'success', 'message' => 'Message saved successfully']);
    } else {
        echo json_encode(['status' => 'error', 'message' => "Error saving message: (" . $stmt->errno . ") " . $stmt->error]);
    }

    $stmt->close();
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
}



?>
