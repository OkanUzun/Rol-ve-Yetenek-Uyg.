<?php

  include "dbsettings.php";

  if (isset($_POST["forgot-password"])) {
    if (filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
      $email = $_POST["email"];
    }
    else {
      echo "email is not valid";
      exit;
    }

    $sql = "SELECT EMAIL,INITCAP(FIRST_NAME) AS F_NAME FROM T_USER WHERE EMAIL = '$email'";

    $stmt = oci_parse($conn, $sql);
    $r    = oci_execute($stmt);
    $row  = oci_fetch_assoc($stmt);


    if ($row["EMAIL"]) {
      $salt     = "498#2D83B631%3800EBD!801600D*7E3CC13";
      $password = hash('sha512', $salt.$row["EMAIL"]);
      $pwrurl   = 'localhost'.dirname($_SERVER['REQUEST_URI']).'/pass-change.php?q='.$password;

      $f_name = $row["F_NAME"];

      require 'mail-config.php';
      ob_start();
      require_once('email.php');


      $mail->addAddress($email);
      $mail->Subject = 'Şifre Sıfırlama Bağlantısı';
      /*$mail->Body    = "Dear user,\n\nIf this e-mail does not apply to you please ignore it. It appears that you have requested a password reset at our website www.yoursitehere.com\n\nTo reset your password, please click the link below. If you cannot click it, please paste it into your web browser's address bar.\n\n".$pwrurl."\n\nThanks,\nThe Administration";*/
      $mail->Body = ob_get_clean();

      if (!$mail->send()) {
        //echo 'Message could not be sent.';
        //echo 'Mailer Error: '.$mail->ErrorInfo;
        $header_text = "Başarısız!";
        $send_text = "gönderilemedi";
        header( "refresh:5;url=index.php" );        
      }
      else {
        $header_text = "Başarılı!";
        $send_text = "gönderildi";
        header( "refresh:5;url=index.php" );
      }
    }
  }
?>

<!DOCTYPE html>
<html lang="tr">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">

  <link rel="apple-touch-icon" sizes="57x57" href="img/favicon/apple-icon-57x57.png">
  <link rel="apple-touch-icon" sizes="60x60" href="img/favicon/apple-icon-60x60.png">
  <link rel="apple-touch-icon" sizes="72x72" href="img/favicon/apple-icon-72x72.png">
  <link rel="apple-touch-icon" sizes="76x76" href="img/favicon/apple-icon-76x76.png">
  <link rel="apple-touch-icon" sizes="114x114" href="img/favicon/apple-icon-114x114.png">
  <link rel="apple-touch-icon" sizes="120x120" href="img/favicon/apple-icon-120x120.png">
  <link rel="apple-touch-icon" sizes="144x144" href="img/favicon/apple-icon-144x144.png">
  <link rel="apple-touch-icon" sizes="152x152" href="img/favicon/apple-icon-152x152.png">
  <link rel="apple-touch-icon" sizes="180x180" href="img/favicon/apple-icon-180x180.png">
  <link rel="icon" type="image/png" sizes="192x192" href="img/favicon/android-icon-192x192.png">
  <link rel="icon" type="image/png" sizes="32x32" href="img/favicon/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="96x96" href="img/favicon/favicon-96x96.png">
  <link rel="icon" type="image/png" sizes="16x16" href="img/favicon/favicon-16x16.png">
  <link rel="manifest" href="img/favicon/manifest.json">
  <meta name="msapplication-TileColor" content="#ffffff">
  <meta name="msapplication-TileImage" content="img/favicon/ms-icon-144x144.png">
  <meta name="theme-color" content="#ffffff">

  <title>Rol ve Yetenek Uygulaması</title>
  <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="css/materialdesignicons.min.css">
  <link rel="stylesheet" type="text/css" href="css/style.min.css">
</head>
<body class="login">
<div class="container">
  <div class="row">
    <div class="col-xs-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-xl-4 offset-xl-4">
      <div class="card card-login">
        <div class="card-header"><?php echo $header_text ?></div>
        <div class="card-block card-email">
          <i class="mdi mdi-emoticon"></i>
          <p class="lead">Şifre sıfırlama bağlantısı <span class="text-success"><?php echo $email ?></span><br>adresine <?php echo $send_text ?></p>
          <p class="loading">Girişe yönlendiriliyorsunuz <span>.</span><span>.</span><span>.</span></p>
        </div>
      </div>
    </div>
  </div>
</div>