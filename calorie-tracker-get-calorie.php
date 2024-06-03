<?php
include 'calorie-tracker-db.php';
global $conn;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = isset($_POST['username']) ? trim($_POST['username']) : 'Guest';

    $stmt = $conn->prepare("SELECT * FROM user_calories WHERE username = ?");
    if (!$stmt) {
        echo json_encode(['status' => 'error', 'message' => "Prepare failed: (" . $conn->errno . ") " . $conn->error]);
        exit;
    }

    $stmt->bind_param('s', $username);
    if ($stmt->execute()) {
        $result = $stmt->get_result();
        if ($row = $result->fetch_assoc()) {
            // Check each list and assign an empty object if null
            $data = [
                'calories' => $row['calories'] != null ? $row['calories'] : null,
            ];
            echo json_encode($data);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'No records found']);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => "Error retrieving data: (" . $stmt->errno . ") " . $stmt->error]);
    }

    $stmt->close();
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
}
?>
