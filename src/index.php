<?php

require_once __DIR__ . '/preflight.php';
// connexion oui / non => erreur
require_once 'authentication.php';
require_once 'errors.php';

try {
    authenticationRequired();

    // $database = new mysqli("db", "burger_api_user", "root", "burger_api");
    // $result = $database->execute_query("SELECT NOW() as time")->fetch_assoc();

    // echo json_encode($result);

    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        require 'get.php';
    } elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
        require 'post.php';
    } else {
        Error(405, 'Méthode non autorisée');
    }
    
} catch (Exception $e) {
  echo json_encode(['error' => 'Token invalide']);
  http_response_code(403);
  exit;
    }
