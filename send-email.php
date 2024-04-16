<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

// Create a new PHPMailer instance
$mail = new PHPMailer();

// SMTP configuration
$mail->isSMTP();
$mail->Host = 'smtp.gmail.com';
$mail->SMTPAuth = true;
$mail->Username = 'mohammed.bencheikh.04@gmail.com'; 
$mail->Password = 'jjvqgcoawoajgqvo'; 
$mail->SMTPSecure = 'tls';
$mail->Port = 587;

// Sender and recipient settings
$mail->setFrom($_POST["email"], $_POST["fname"]); // Sender's email and name
$mail->addAddress('DeliveryWebsite@example.com', 'Mohamed bencheikh'); // Recipient's email and name
$mail->Subject = $_POST["number"];
$mail->Body = $_POST ["sujet"];

// Sending email
if ($mail->send()) {
   echo'Email sent successfully!';
    
} else {
    echo 'Error: ' . $mail->ErrorInfo;
}