<?php
  require 'PHPMailerAutoload.php';
  $mail            = new PHPMailer;
  $mail->SMTPDebug = 3; // Enable verbose debug output
  $mail->isSMTP(); // Set mailer to use SMTP  // Specify main and backup SMTP servers
  $mail->SMTPAuth   = true; // Enable SMTP authentication
  $mail->Username   = 'roleaby@gmail.com'; // SMTP username
  $mail->Password   = 'roleaby123'; // SMTP password
  $mail->SMTPSecure = 'tls'; // Enable TLS encryption, `ssl` also accepted
  $mail->Port       = 587; // TCP port to connect to
  $mail->setFrom('roleaby@gmail.com'); // Add a recipient
  $mail->isHTML(true); // Set email format to HTML
?>