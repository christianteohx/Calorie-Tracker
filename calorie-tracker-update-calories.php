<?php
include 'calorie-tracker-db.php';
global $conn;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = isset($_POST['username']) ? $_POST['username'] : 'Guest';
    $calories = isset($_POST['calories']) ? $_POST['calories'] : null;

    $stmt = $conn->prepare("INSERT INTO user_calories (username, calories) VALUES (?, ?) ON DUPLICATE KEY UPDATE calories = VALUES(calories)");
    
    if (!$stmt) {
        echo json_encode(['status' => 'error', 'message' => "Prepare failed: (" . $conn->errno . ") " . $conn->error]);
        exit;
    }
    
    $stmt->bind_param('ss', $username, $calories);

    if ($stmt->execute()) {
        echo json_encode(['status' => 'success', 'message' => 'Data saved successfully']);
    } else {
        echo json_encode(['status' => 'error', 'message' => "Error saving data: (" . $stmt->errno . ") " . $stmt->error]); // Here you had $stmt->errno twice, changed the second to $stmt->error to show the error message
    }

    $stmt->close();

} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
}
?>
