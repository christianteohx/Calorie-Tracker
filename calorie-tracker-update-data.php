<?php
include 'calorie-tracker-db.php';
global $conn;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = isset($_POST['username']) ? $_POST['username'] : 'Guest';
    $date = isset($_POST['date']) ? $_POST['date'] : null;
    $breakfastList = isset($_POST['breakfastList']) ? $_POST['breakfastList'] : null;
    $lunchList = isset($_POST['lunchList']) ? $_POST['lunchList'] : null;
    $dinnerList = isset($_POST['dinnerList']) ? $_POST['dinnerList'] : null;
    $snackList = isset($_POST['snackList']) ? $_POST['snackList'] : null;

    $stmt = $conn->prepare("INSERT INTO meal_tracker (username, breakfastList, lunchList, dinnerList, snackList, date) VALUES (?, ?, ?, ?, ?, ?) ON DUPLICATE KEY UPDATE breakfastList = VALUES(breakfastList), lunchList = VALUES(lunchList), dinnerList = VALUES(dinnerList), snackList = VALUES(snackList), date = VALUES(date)");
    
    if (!$stmt) {
        echo json_encode(['status' => 'error', 'message' => "Prepare failed: (" . $conn->errno . ") " . $conn->error]);
        exit;
    }
    
    $stmt->bind_param('ssssss', $username, $breakfastList, $lunchList, $dinnerList, $snackList, $date);

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
