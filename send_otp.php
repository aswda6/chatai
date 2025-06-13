<?php
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'mail/PHPMailer.php';
require 'mail/SMTP.php';
require 'mail/Exception.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $otp = rand(100000, 999999);
    $_SESSION['otp'] = $otp;

    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'wargame00101@gmail.com';
        $mail->Password   = 'yspx sftz rhod nweg';
        $mail->SMTPSecure = 'tls';
        $mail->Port       = 587;

        $mail->setFrom('wargame00101@gmail.com', 'Kako Signup');
        $mail->addAddress($email);

        $mail->isHTML(true);
        $mail->Subject = 'Your OTP Code';
        $mail->Body    = "<h3>Your OTP code is: $otp</h3>";

        $mail->send();
        header("Location: verify.html");
        exit;
    } catch (Exception $e) {
        echo "Mailer Error: {$mail->ErrorInfo}";
    }
}
?>
