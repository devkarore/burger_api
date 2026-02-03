<?php
$database = new mysqli("db", "burger_api_user", "root", "burger_api");
//
if ($database->connect_error) {
    throw new Exception('Erreur connexion BDD', 500);
}

$result = $database->execute_query("SELECT NOW() as time")->fetch_assoc();
echo json_encode($result);
