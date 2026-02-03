<?php
$input = json_decode(file_get_contents('php://input'), true) ?? [];

function inputContact(array $input, mysqli $database): void {
    if (
        empty($input['name']) ||
        empty($input['email']) ||
        empty($input['message'])
    ) {
        http_response_code(400);
        echo json_encode([
            'erreur' => 'Champs obligatoires manquants'
        ]);
        exit;
    }

    $database = new mysqli("db", "burger_api_user", "root", "burger_api");
    $stmt = $database->prepare("INSERT INTO contacts (nom, email, message, date_envoi) VALUES (?, ?, ?, NOW())");
    $stmt->bind_param("sss", $input['name'], $input['email'], $input['message']);

    if (!$stmt->execute()) {
        http_response_code(500);
        echo json_encode([
            'erreur' => 'Message non enregistré'
        ]);
        exit;
    }

    echo json_encode([
        'message' => 'Message enregistré'
    ]);
}

function inputNewsletter(array $input, mysqli $database): void {
    if (
        empty($input['email']) ||
        empty($input['isSubscribed'])
    ) {
        http_response_code(400);
        echo json_encode([
            'erreur' => 'Champs obligatoires manquants'
        ]);
        exit;
    }

    $database = new mysqli("db", "burger_api_user", "root", "burger_api");
    $stmt = $database->prepare("INSERT INTO newsletter (email, isSubscribed) VALUES (?, ?)");
    $stmt->bind_param("ss", $input['email'], $input['isSubscribed']);

    if (!$stmt->execute()) {
        http_response_code(500);
        echo json_encode([
            'erreur' => 'Non enregistré à la newsletter'
        ]);
        exit;
    }

    echo json_encode([
        'message' => 'Mail enregistré à la newsletter'
    ]);
}