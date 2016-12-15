<?php
  require 'PHPMailerAutoload.php';

  $mail = new PHPMailer;
  error_reporting(0);
  $mail->CharSet = 'utf-8';

  $mail->SMTPDebug = 0;                               // Enable verbose debug output

  $mail->isSMTP();                                      // Set mailer to use SMTP
  $mail->Host       = 'smtp.gmail.com';  // Specify main and backup SMTP servers
  $mail->SMTPAuth   = true;                               // Enable SMTP authentication
  $mail->Username   = 'roleaby@gmail.com';                 // SMTP username
  $mail->Password   = 'roleaby123';                           // SMTP password
  $mail->SMTPSecure = 'tsl';                            // Enable TLS encryption, `ssl` also accepted
  $mail->Port       = 587;                                    // TCP port to connect to

  $mail->setFrom('roleaby@gmail.com', 'ROLEABY AUTO MESSAGE');
  // Add a recipient
  //$mail->addAddress('ellen@example.com');               // Name is optional
  //$mail->addReplyTo('info@example.com', 'Information');
  //$mail->addCC('cc@example.com');
  //$mail->addBCC('bcc@example.com');

  //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
  //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
  $mail->isHTML(true);
  // Set email format to HTML


  //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';


?>