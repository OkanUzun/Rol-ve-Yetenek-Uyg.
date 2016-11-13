<?php include "header.php"; ?>

<div class="wrapper">
  <?php include "sidebar.php"; ?>
  <div class="page-content">
    <?php include "navbar.php"; ?>
    <div class="container-fluid">
      <div class="card">
        <form method="post">
          <div class="card-header hidden-sm-down">
            <div class="card-title">Kullanıcı Detay</div>
            <button type="submit" class="btn btn-success">Kaydet</button>
          </div>
          <div class="card-block">
            <div class="row">
              <div class="col-lg-12 col-xl-6 mb-1">
                <div class="row">
                  <div class="col-xs-12">
                    <div class="card-title">Departman Bilgileri</div>
                  </div>
                  <div class="col-sm-12 col-md-6">
                    <div class="form-group">
                      <select class="form-control">
                        <option>Rol Seçiniz</option>
                        <option value="Android Developer">Android Developer</option>
                      </select>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-12 col-xl-6 mb-1">
                <div class="row">
                  <div class="col-xs-12">
                    <div class="card-title">Kişisel Bilgiler</div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <input type="text" class="form-control" placeholder="İsim" name="stepName" id="stepName" required>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <input type="text" class="form-control" placeholder="Soyisim" name="stepSurname" id="stepSurname" required>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <input type="text" class="form-control" placeholder="Kullanıcı Adı" name="stepUsername" id="stepUsername" required>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <input type="text" data-provide="datepicker" class="form-control datepicker" placeholder="Doğum Tarihi" name="stepBirthdate" id="stepBirthdate" required>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-12 col-xl-6 mb-1">
                <div class="row">
                  <div class="col-xs-12">
                    <div class="card-title">İletişim Bilgileri</div>
                  </div>
                  <div class="col-sm-12 col-md-6">
                    <div class="form-group">
                      <input type="email" class="form-control" placeholder="E-mail" name="stepEmail" id="stepEmail" required>
                    </div>
                  </div>
                  <div class="col-sm-12 col-md-6">
                    <div class="form-group">
                      <input type="number" class="form-control" placeholder="Mobil Telefon No" name="stepTel" id="stepTel" required>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <textarea rows="5" class="form-control" placeholder="Adres..." name="stepAddress" id="stepAddress"></textarea>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-12 col-xl-6 mb-1">
                <div class="card-title">Kayıtlı Yetenekler<a href="#" class="btn btn-primary">Yetenekleri Düzenle</a></div>
                <div class="table-responsive">
                  <table class="table">
                    <thead>
                    <tr>
                      <th>Yetenek</th>
                      <th>Seviye</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                      <td>HTML</td>
                      <td>Orta</td>
                    </tr>
                    <tr>
                      <td>PHP</td>
                      <td>İyi</td>
                    </tr>
                    <tr>
                      <td>HTML</td>
                      <td>Orta</td>
                    </tr>
                    <tr>
                      <td>PHP</td>
                      <td>İyi</td>
                    </tr>
                    <tr>
                      <td>HTML</td>
                      <td>Orta</td>
                    </tr>
                    <tr>
                      <td>PHP</td>
                      <td>İyi</td>
                    </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<?php include "footer.php"; ?>
