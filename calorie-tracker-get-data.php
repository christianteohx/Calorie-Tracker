<?php
include 'calorie-tracker-db.php';
global $conn;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = isset($_POST['username']) ? trim($_POST['username']) : 'Guest';
    $date = isset($_POST['date']) ? trim($_POST['date']) : null;

    // Validate the date format if necessary (e.g., Y-m-d)
    // if ($date && !preg_match('/^\d{4}-\d{2}-\d{2}$/', $date)) {
    //     echo json_encode(['status' => 'error', 'message' => 'Invalid date format']);
    //     exit;
    // }

    $stmt = $conn->prepare("SELECT * FROM meal_tracker WHERE username = ? AND date = ?");
    if (!$stmt) {
        echo json_encode(['status' => 'error', 'message' => "Prepare failed: (" . $conn->errno . ") " . $conn->error]);
        exit;
    }

    $stmt->bind_param('ss', $username, $date);
    if ($stmt->execute()) {
        $result = $stmt->get_result();
        if ($row = $result->fetch_assoc()) {
            // Check each list and assign an empty object if null
            $data = [
                'breakfastList' => $row['breakfastList'] != null ? $row['breakfastList'] : new stdClass(),
                'lunchList' => $row['lunchList'] != null ? $row['lunchList'] : new stdClass(),
                'dinnerList' => $row['dinnerList'] != null ? $row['dinnerList'] : new stdClass(),
                'snackList' => $row['snackList'] != null ? $row['snackList'] : new stdClass(),
                'date' => $row['date']
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
