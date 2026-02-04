<?php
require_once __DIR__ . '/preflight.php';

$database = new mysqli("db", "burger_api_user", "root", "burger_api");
//
if ($database->connect_error) {
    throw new Exception('Erreur connexion BDD', 500);
}

// $result = $database->execute_query("SELECT NOW() as time")->fetch_assoc();
// echo json_encode($result);


$header = $_GET['get'] ?? '';

switch ($header) {
    case 'header':
        $sql = "SELECT id, sousTitre, photoURL, libelle_lien, href_lien FROM articles WHERE id = 1";
        $result = $database->execute_query($sql)->fetch_assoc();
        echo json_encode($result);
        break;
    case 'aboutUs':
        $sql = "SELECT id, titre, sousTitre, photoURL, contenu FROM articles WHERE id = 2";
        $result = $database->execute_query($sql)->fetch_assoc();
        echo json_encode($result);
        break;
    case 'hotDeal':
        $sql = "SELECT id, titre, sousTitre, photoURL, contenu FROM articles WHERE id = 3";
        $result = $database->execute_query($sql)->fetch_assoc();
        echo json_encode($result);
        break;
    case 'ourMenu':
        $sql = "SELECT id, titre, sousTitre, libelle_lien, href_lien FROM articles WHERE id = 4";
        $result = $database->execute_query($sql)->fetch_assoc();
        echo json_encode($result);
        break;
    case 'reviews':
        $sql = "SELECT id, titre, sousTitre FROM articles WHERE id = 5";
        $result = $database->execute_query($sql)->fetch_assoc();
        echo json_encode($result);
        break;
    case 'contact':
        $sql = "SELECT id, titre, sousTitre, contenu, libelle_lien, href_lien FROM articles WHERE id = 6";
        $result = $database->execute_query($sql)->fetch_assoc();
        echo json_encode($result);
        break;
    case 'tweetsWidget':
        $sql = "SELECT id, titre, photoURL, contenu, libelle_lien, href_lien FROM articles WHERE id = 7";
        $result = $database->execute_query($sql)->fetch_assoc();
        echo json_encode($result);
        break;
    case 'newsletter':
        $sql = "SELECT id, titre, contenu FROM articles WHERE id = 8";
        $result = $database->execute_query($sql)->fetch_assoc();
        echo json_encode($result);
        break;

    default:
        http_response_code(400);
        echo json_encode(['error' => 'Mauvaise requête']);
        break;
}
