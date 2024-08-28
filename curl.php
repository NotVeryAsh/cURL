<?php

$request = curl_init("localhost/index.php");
if(!$request) {
    echo "Could not initiate curl";
    exit;
}

if(!curl_setopt_array($request, [
    CURLOPT_POST => true,
    CURLOPT_POSTFIELDS => [
        'name' => 'Ash',
        'example' => 'test'
    ],
    CURLOPT_HTTPHEADER => [
        "Accept: application/json"
    ],
    CURLOPT_RETURNTRANSFER => true
])) {
    echo curl_error($request);
    exit;
}

$response = curl_exec($request);

if(!$response) {
    echo curl_error($request);
    exit;
}

$response = json_decode($response, true);
if(curl_getinfo($request, CURLINFO_HTTP_CODE) === 422) {
    echo $response['message'];
    exit;
}

foreach ($response['data'] as $key => $value) {
    echo "$value,\n";
}