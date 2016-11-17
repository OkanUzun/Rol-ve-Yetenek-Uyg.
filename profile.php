<?php include "header.php"; ?>

  <div class="wrapper">
    <?php include "sidebar.php"; ?>
    <div class="page-content">
      <?php include "navbar.php"; ?>
      <div class="container-fluid">
        <div class="card">
          <form method="post">
            <div class="card-header">
              <div class="card-title">Profil Bilgileri</div>
              <button type="submit" class="btn btn-success">Kaydet</button>
            </div>
            <div class="card-block">
              <div class="row">
                <div class="col-xs-12 col-xl-6 mb-1">
                  <div class="row">
                    <div class="col-xs-12">
                      <div class="card-title">Kişisel Bilgiler<a href="#" class="btn btn-primary" data-toggle="modal" data-target="#passwordModal">Şifremi Değiştir</a></div>
                    </div>
                    <div class="col-xs-12 col-md-6">
                      <div class="form-group">
                        <input type="text" class="form-control" placeholder="İsim" name="stepName" id="stepName" required>
                      </div>
                    </div>
                    <div class="col-xs-12 col-md-6">
                      <div class="form-group">
                        <input type="text" class="form-control" placeholder="Soyisim" name="stepSurname" id="stepSurname" required>
                      </div>
                    </div>
                    <div class="col-xs-12 col-md-6">
                      <div class="form-group">
                        <input type="text" class="form-control" placeholder="Kullanıcı Adı" name="stepUsername" id="stepUsername" required>
                      </div>
                    </div>
                    <div class="col-xs-12 col-md-6">
                      <div class="form-group">
                        <input type="text" data-provide="datepicker" class="form-control datepicker" placeholder="Doğum Tarihi" name="stepBirthdate" id="stepBirthdate" required>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-xs-12 col-xl-6 mb-1">
                  <div class="row">
                    <div class="col-xs-12">
                      <div class="card-title">İletişim Bilgileri</div>
                    </div>
                    <div class="col-xs-12 col-md-6">
                      <div class="form-group">
                        <input type="email" class="form-control" placeholder="E-mail" name="stepEmail" id="stepEmail" required>
                      </div>
                    </div>
                    <div class="col-xs-12 col-md-6">
                      <div class="form-group">
                        <input type="number" class="form-control" placeholder="Mobil Telefon No" name="stepTel" id="stepTel" required>
                      </div>
                    </div>
                    <div class="col-xs-12">
                      <div class="form-group">
                        <textarea rows="5" class="form-control" placeholder="Adres..." name="stepAddress" id="stepAddress"></textarea>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="passwordModal" tabindex="-1" role="dialog" aria-labelledby="passwordModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <i class="mdi mdi-close"></i>
          </button>
          <h4 class="modal-title" id="passwordModalLabel">Şifremi Değiştir</h4>
        </div>
        <form method="post">
          <div class="modal-body">
            <div class="form-group">
              <input type="password" class="form-control" id="new_password" placeholder="Yeni Şifreniz">
            </div>
            <div class="form-group">
              <input type="password" class="form-control" id="new_password_again" placeholder="Yeni Şifreniz Tekrar">
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Kapat</button>
            <button type="submit" class="btn btn-success">Değiştir</button>
          </div>
        </form>
      </div>
    </div>
  </div>

<?php include "footer.php"; ?>