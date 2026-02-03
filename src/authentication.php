<?php

require_once __DIR__ . '/preflight.php';
require_once __DIR__ . '/vendor/autoload.php';

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

function authenticationRequired(): array {
    $secret = 'JNNqOhTloXrShYEONCZbKNeXnHLJRnGyjqSfcvVMugJguZpJcm';

    $headers = getallheaders();
    $auth = $headers['Authorization'] ?? '';

    if ($auth === '') {
        http_response_code(401);
        echo json_encode(['error' => 'Token manquant']);
        exit;
    }

    if (!str_starts_with($auth, 'Bearer ')) {
        http_response_code(401);
        echo json_encode(['error' => 'Format du token invalide']);
        exit;
    }

    $token = trim(substr($auth, 7));
    if ($token === '') {
        http_response_code(401);
        echo json_encode(['error' => 'Token vide']);
        exit;
    }
    try {
        $decoded = JWT::decode($token, new Key($secret, 'HS256'));

        if (($decoded->aud ?? '') !== 'burger_api2') {
            http_response_code(403);
            echo json_encode(['error' => 'Audience invalide']);
            exit;
        }

        return (array) $decoded;
    } catch (Exception $e) {
        http_response_code(403);
        echo json_encode(['error' => 'Token invalide']);
        exit;
    }
}
?>