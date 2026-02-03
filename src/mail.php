<?php
require_once __DIR__ . '/preflight.php';
require_once __DIR__ . '/vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
  

function isInputContact(array $input):void {
    $mail = new PHPMailer();
    $mail->CharSet = 'UTF-8';
    $mail->Encoding = 'base64';
        // Configuration MailPit
        $mail->Host       = 'mailpit';
        $mail->Port       = 1025;
        $mail->SMTPAuth   = false;
        $mail->SMTPSecure = '';
        
        // Qui envoie
        $mail->setFrom('noreply@monappli.com', 'Mon App');
        $mail->addAddress($input['email']);
        
        $mail->isHTML(true);

        // Contenu
        $mail->Subject = $input['name'] . " vous a envoyé un message : ";
        $message = "Voici le message de " . $input['name'] . ", <br> " . $input['message'];
        $mail->Body = $message;
        
        // Envoyer
        if ($mail->send()) {    
            echo json_encode(['status' => 'success', 'message' => 'Email envoyé']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Votre e-mail n\'est pas parti']);
        }
        
    
}

?>