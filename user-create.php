<?php include "header.php"; ?>

  <div class="wrapper">
    <?php include "sidebar.php"; ?>
    <div class="page-content">
      <?php include "navbar.php"; ?>
      <div class="container-fluid">
        <div class="card">
          <form method="post">
            <div class="card-header">
              <div class="card-title">Kullanıcı Tanımlama</div>
              <div class="card-buttons">
                <button type="submit" class="btn btn-success">Kaydet</button>
              </div>
            </div>
            <div class="card-block">
              <div class="row">
                <div class="col-xs-12 col-md-12 col-lg-6 mb-1">
                  <div class="row">
                    <div class="col-xs-12">
                      <div class="card-title">Meslek Bilgisi</div>
                    </div>
                    <div class="col-xs-12 col-xl-6">
                      <div class="form-group">
                        <select class="form-control selectpicker" data-live-search="true" data-size="5" title="Rol Seçiniz">
                          <option value="Android Developer">Android Developer</option>
                          <option value="IOS Developer">IOS Developer</option>
                          <option value="PHP Developer">PHP Developer</option>
                          <option value="Java Developer">Java Developer</option>
                          <option value="MySQL Developer">MySQL Developer</option>
                          <option value="Ruby Developer">Ruby Developer</option>
                        </select>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-xs-12 col-md-12 col-lg-6 mb-1">
                  <div class="row">
                    <div class="col-xs-12">
                      <div class="card-title">Kişisel Bilgiler</div>
                    </div>
                    <div class="col-xs-12 col-md-6">
                      <div class="form-group">
                        <input type="text" class="form-control" placeholder="İsim" required>
                      </div>
                    </div>
                    <div class="col-xs-12 col-md-6">
                      <div class="form-group">
                        <input type="text" class="form-control" placeholder="Soyisim" required>
                      </div>
                    </div>
                    <div class="col-xs-12 col-md-6">
                      <div class="form-group">
                        <input type="text" class="form-control" placeholder="Kullanıcı Adı" required>
                      </div>
                    </div>
                    <div class="col-xs-12 col-md-6">
                      <div class="form-group">
                        <input type="text" data-provide="datepicker" class="form-control datepicker" placeholder="Doğum Tarihi" required>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-xs-12 col-md-12 col-lg-12 col-xl-6">
                  <div class="row">
                    <div class="col-xs-12">
                      <div class="card-title">İletişim Bilgileri</div>
                    </div>
                    <div class="col-sm-12 col-md-6">
                      <div class="form-group">
                        <input type="email" class="form-control" placeholder="E-mail" required>
                      </div>
                    </div>
                    <div class="col-sm-12 col-md-6">
                      <div class="form-group">
                        <input type="number" class="form-control" placeholder="Mobil Telefon No" required>
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="form-group">
                        <textarea rows="5" class="form-control" placeholder="Adres..." ></textarea>
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

<?php include "footer.php"; ?>