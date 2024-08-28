<?php

header("Content-Type: application/json");
$response = [
    'message' => '',
    'data' => []
];

if (empty($_POST)) {
    header("HTTP/1.1 422 Unprocessable Entity");
    $response['message'] = "No POST data present";
    echo json_encode($response);
    exit;
}

$data = filter_input_array(INPUT_POST, FILTER_SANITIZE_ENCODED);
if(!$data) {
    header("HTTP/1.1 422 Unprocessable Entity");
    $response['message'] = "No safe POST data present";
    echo json_encode($response);
    exit;
}

header("HTTP/1.1 200 OK");
$response['message'] = "Data received";
$response['data'] = $data;
echo json_encode($response);