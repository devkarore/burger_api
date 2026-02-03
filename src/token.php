<?php
require_once __DIR__ . '/preflight.php';
require_once __DIR__ . '/vendor/autoload.php';

use Firebase\JWT\JWT;

$secret = 'JNNqOhTloXrShYEONCZbKNeXnHLJRnGyjqSfcvVMugJguZpJcm';

$payload = [
  'iss' => 'burger_api2',
  'aud' => 'burger_api2',
  'iat' => time(),
  'exp' => time() + 3600
];

$token = JWT::encode($payload, $secret, 'HS256');

echo json_encode(['token' => $token]);
?>