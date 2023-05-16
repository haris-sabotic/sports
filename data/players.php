<?php

require_once '../config.php';

$ch = curl_init();

// return response as string
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
// set url
curl_setopt($ch, CURLOPT_URL, API_BASE_URL . '/teams/' . $_GET["team_id"]);
// set api token
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'X-Auth-Token: ' . API_KEY,
]);

$response = curl_exec($ch);
curl_close($ch);

echo json_encode(json_decode($response)->squad);
