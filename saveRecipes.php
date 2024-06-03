<?php
include 'recipeRecommendationDB.php';
global $conn;



if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $user = $_POST['user'] ;
    $recipeTitle = isset($_POST['recipeTitle']) ? $_POST['recipeTitle'] : null;
    $recipeIngredients = isset($_POST['recipeIngredients']) ? $_POST['recipeIngredients'] : null; 
    $recipeInstructions = isset($_POST['recipeInstructions']) ? $_POST['recipeInstructions'] : null;
    $recipeCalories = isset($_POST['recipeCalories']) ? $_POST['recipeCalories'] : null;

    $checkStmt = $conn->prepare("SELECT COUNT(*) FROM recipes WHERE user = ? AND RecipeTitle = ?");
    $checkStmt->bind_param('ss', $user, $recipeTitle);
    $checkStmt->execute();
    $checkStmt->bind_result($count);
    $checkStmt->fetch();
    $checkStmt->close();

    if ($count > 0) {
        echo json_encode(['status' => 'error', 'message' => 'This recipe title already exists.']);
    } else {
        $stmt = $conn->prepare("INSERT INTO recipes (user, RecipeTitle, Ingredients, Instructions, Calories) VALUES (?, ?, ?, ?, ?)");
        if (!$stmt) {
            echo json_encode(['status' => 'error', 'message' => "Prepare failed: (" . $conn->errno . ") " . $conn->error]);
            exit;
        }

        $stmt->bind_param('ssssi', $user, $recipeTitle, $recipeIngredients, $recipeInstructions, $recipeCalories);

        if ($stmt->execute()) {
            echo json_encode(['status' => 'success', 'message' => 'Recipe saved successfully']);
        } else {
            echo json_encode(['status' => 'error', 'message' => "Error saving recipe: (" . $stmt->errno . ") " . $stmt->error]);
        }

        $stmt->close();
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
}

?>