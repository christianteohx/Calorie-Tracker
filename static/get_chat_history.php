<?php
include 'db.php'; 
global $conn;

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user = $_POST['user'];
    $date = $_POST['date'];

    $stmt = $conn->prepare("SELECT * FROM chat_history WHERE user = ? AND date = ? ORDER BY id ASC");
    if (!$stmt) {
        echo json_encode(['status' => 'error', 'message' => "Prepare failed: (" . $conn->errno . ") " . $conn->error]);
        exit;
    }

    $stmt->bind_param('ss', $user, $date);
    if ($stmt->execute()) {
        $result = $stmt->get_result();
        $chatHistory = [];

        while ($row = $result->fetch_assoc()) {
            $chatHistory[] = [
                'date' => $row['date'],
                'name' => $row['user'],
                'message' => $row['message'],
                'response' => $row['response']
            ];
        }

        echo json_encode($chatHistory);
    } else {
        echo json_encode(['status' => 'error', 'message' => "Error retrieving messages: (" . $stmt->errno . ") " . $stmt->error]);
    }

    $stmt->close();
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
}


?>
