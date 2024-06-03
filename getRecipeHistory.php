<?php
include 'recipeRecommendationDB.php'; 
global $conn;

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $user = $_POST['user'] ;

    $stmt = $conn->prepare("SELECT * FROM recipes WHERE user = ?");
    if (!$stmt) {
        echo json_encode(['status' => 'error', 'message' => "Prepare failed: (" . $conn->errno . ") " . $conn->error]);
        exit;
    }

    $stmt->bind_param('s', $user);
    if ($stmt->execute()) {
        $result = $stmt->get_result();
        $recipeHistory = [];

        while ($row = $result->fetch_assoc()) {
            $recipeHistory[] = [
                'recipeTitle' => $row['RecipeTitle'],
                'user' => $row['user'],
                'Instructions' => $row['Instructions'],
                'Ingredients' => $row['Ingredients'],
                'Calories' => $row['Calories']
            ];
        }

        echo json_encode($recipeHistory);
    } else {
        echo json_encode(['status' => 'error', 'message' => "Error retrieving recipes: (" . $stmt->errno . ") " . $stmt->error]);
    }

    $stmt->close();
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
}


?>
