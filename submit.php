<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// require 'vendor/autoload.php'; // if installed with Composer
require 'phpmailer/src/PHPMailer.php'; require 'phpmailer/src/Exception.php'; require 'phpmailer/src/SMTP.php';

$name  = trim($_POST['name'] ?? '');
$phone = trim($_POST['phone'] ?? '');

if ($name === '' || $phone === '') {
    http_response_code(400);
    echo "Missing fields";
    exit;
}

$mail = new PHPMailer(true);
try {
    // SMTP settings
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'suradavaishnavi1727@gmail.com'; // your Gmail
    $mail->Password = 'oqxvcrznrfnirvha';   // 16-char App Password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;

    // Recipients
    $mail->setFrom('cybermail@gmail.com', 'Cyber Crime Portal');
    $mail->addAddress('suradavaishnavi1727@gmail.com', 'You'); // where you want to receive

    // Content
    $mail->isHTML(false);
    $mail->Subject = 'New Submission';
    $mail->Body    = "Name: $name\nPhone: $phone\nIP: " . ($_SERVER['REMOTE_ADDR'] ?? 'n/a');

    $mail->send();
    header("Location: thankyou.html");
    exit;
} catch (Exception $e) {
    echo "Mailer Error: {$mail->ErrorInfo}";
}
