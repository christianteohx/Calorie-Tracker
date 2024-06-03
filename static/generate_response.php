<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $path = file_get_contents(".env");
    $OPENAI_API_KEY = explode("=", $path)[1];
    
    $userInput = $_POST['message'];

    // header('Content-Type: application/json');
    // echo json_encode($result);
    // exit();

    
    $api_url = 'https://api.openai.com/v1/chat/completions';

    $data = [
        'model' => 'gpt-3.5-turbo',
        'messages' => [
            ['role' => 'system', 'content' => "you are a helpful Coach to help user to achieve their goal"],
            ['role' => 'user', 'content' => $userInput],
            ['role' => 'assistant', 'content' => 'here is my advice...']
        ]
    ];

    $chat = curl_init($api_url);

    curl_setopt($chat, CURLOPT_URL, $api_url);
    curl_setopt($chat, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($chat, CURLOPT_POST, true);
    curl_setopt($chat, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($chat,CURLOPT_HTTPHEADER,[
        'Content-Type: application/json',
        'Authorization: Bearer ' . $OPENAI_API_KEY
    ]);

    $result = curl_exec($chat);

    curl_close($chat);

    $data = json_decode($result, true);
    echo $result;


}
?>
