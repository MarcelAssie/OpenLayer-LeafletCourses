<?php
$nom = htmlspecialchars($_POST['name']); // Sécurisation des entrées
$email = htmlspecialchars($_POST['email']);
$messageContent = htmlspecialchars($_POST['message']);

// Importation de PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

// Création d'une instance de PHPMailer
$mail = new PHPMailer(true);

try {
    // Configuration du serveur SMTP
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'marceldevtest@gmail.com';
    $mail->Password   = 'fszomdfgibjvkjya';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    $mail->Port       = 465;

    // Destinataire
    $mail->setFrom($email, $nom); // Adresse de l'expéditeur
    $mail->addAddress('marceldevtest@gmail.com'); // Adresse du destinataire

    // Contenu du mail
    $mail->isHTML(true);
    $mail->Subject = "Nouveau message de $nom";

    // Structure de l'email
    $mail->Body = "
    <html>
    <head>
        <style>
            body { font-family: Arial, sans-serif; color: #333; }
            h2 { color: #2E86C1; }
            p { margin: 0 0 10px 0; }
            blockquote { border-left: 4px solid #2E86C1; padding-left: 10px; margin: 10px 0; }
            .footer { font-size: 12px; color: #777; }
        </style>
    </head>
    <body>
        <h2>Vous avez reçu un nouveau message</h2>
        <p><strong>Nom:</strong> $nom</p>
        <p><strong>Email:</strong> $email</p>
        <p><strong>Message:</strong></p>
        <blockquote>$messageContent</blockquote>
        <p class='footer'>Ce message vous a été envoyé depuis le formulaire de contact de MarcelWiki.</p>
    </body>
    </html>
    ";
    $mail->AltBody = "Nom: $nom\nEmail: $email\nMessage: $messageContent";

    // Envoi du mail
    $mail->send();
    // Redirection vers la page d'accueil'
    header('Location: /confirmation_email');
    exit;
} catch (Exception $e) {
    echo "Message non envoyé. Erreur: {$mail->ErrorInfo}";
}
