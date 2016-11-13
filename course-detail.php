<?php include "header.php"; ?>

<div class="wrapper">
  <?php include "sidebar.php"; ?>
  <div class="page-content">
    <?php include "navbar.php"; ?>
    <div class="container-fluid">
      <div class="card">
        <form method="post">
          <div class="card-header hidden-xs-down">
            <div class="card-title">Eğitim Detayları</div>
            <button type="submit" class="btn btn-danger">İptal Et</button>
            <button type="submit" class="btn btn-danger">Sonlandır</button>
            <button type="submit" class="btn btn-success">Güncelle</button>
          </div>
          <div class="card-block">
            <div class="row">
              <div class="col-xs-12">
                <div class="course-status">Eğitim Durumu:
                  <span class="wait">Beklemede<i class="mdi mdi-timer"></i></span>
                  <span class="on">Devam Ediyor<i class="mdi mdi-timer-sand"></i></span>
                  <span class="off">Sona Erdi<i class="mdi mdi-check"></i></span>
                  <span class="cancel">İptal Edildi<i class="mdi mdi-timer-off"></i></span>
                </div>
              </div>
              <div class="col-xs-12 col-xl-6">
                <div class="row">
                  <div class="col-xs-12">
                    <div class="card-title">Eğitim Bilgileri<a href="course-users.php" class="btn btn-primary">Katılımcı Ekle</a></div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <input type="text" class="form-control" placeholder="Eğitim Adı">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <input type="text" class="form-control" placeholder="Eğitmen">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <input type="text" data-provide="datepicker" class="form-control datepicker" placeholder="Başlangıç Tarihi">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <input type="text" data-provide="datepicker" class="form-control datepicker" placeholder="Bitiş Tarihi">
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <textarea rows="5" class="form-control" placeholder="Eğitim Detayları"></textarea>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-xs-12 col-xl-6">
                <div class="card-title">Eğitim Konuları<a href="#" class="btn btn-primary">Konuları Düzenle</a></div>
                <div class="table-responsive">
                  <table class="table">
                    <thead>
                    <tr>
                      <th>Konu</th>
                      <th>Seviye</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                      <td>HTML</td>
                      <td>Başlangıç Seviyesi</td>
                    </tr>
                    <tr>
                      <td>PHP</td>
                      <td>Orta Seviye</td>
                    </tr>
                    <tr>
                      <td>Java</td>
                      <td>İleri Seviye</td>
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
