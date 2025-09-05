<?php
header('Content-Type: application/json');

$data = json_decode(file_get_contents('php://input'), true);

$response = [
    'status' => 'success',
    'message' => 'API is working!',
    'received' => $data
];

echo json_encode($response); 
