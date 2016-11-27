<!DOCTYPE html>
<html lang="tr">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">

  <title>Rol ve Yetenek Uygulaması</title>
  <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="css/materialdesignicons.min.css">
  <link rel="stylesheet" type="text/css" href="css/style.min.css">
</head>
<body class="login">
<div class="container">
  <div class="row">
    <div class="col-xs-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-xl-4 offset-xl-4">
      <form action="">
        <div class="card card-login">
          <div class="card-header"><span class="highlight">Roleaby</span> Giriş</div>
          <div class="card-block">
            <div class="form-group">
              <input type="text" class="form-control" placeholder="Kullanıcı Adı">
              <i class="mdi mdi-account"></i>
            </div>
            <div class="form-group">
              <input type="password" class="form-control" placeholder="********">
              <i class="mdi mdi-key"></i>
            </div>
            <div class="form-group">
              <button type="submit" class="btn btn-success">Giriş Yap</button>
            </div>
            <div class="form-group">
              <input id="remember" type="checkbox" class="form-control">
              <label for="remember">Beni Hatırla</label>
              <a href="#" class="forgot">Şifremi Unuttum</a>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
<?php include 'footer.php' ?>