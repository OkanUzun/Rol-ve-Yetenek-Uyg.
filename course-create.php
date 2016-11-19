<?php include "header.php"; ?>

  <div class="wrapper">
    <?php include "sidebar.php"; ?>
    <div class="page-content">
      <?php include "navbar.php"; ?>
      <div class="container-fluid">
        <div class="card">
          <form method="post">
            <div class="card-header">
              <div class="card-title">Eğitim Tanımlama</div>
              <button type="submit" class="btn btn-success">Kaydet</button>
            </div>
            <div class="card-block">
              <div class="row">
                <div class="col-xs-12">
                  <div class="card-title">Eğitim Bilgileri</div>
                </div>
                <div class="col-lg-6 col-xl-3">
                  <div class="form-group">
                    <input type="text" class="form-control" placeholder="Eğitim Adı">
                  </div>
                </div>
                <div class="col-lg-6 col-xl-3">
                  <div class="form-group">
                    <select class="form-control selectpicker" data-live-search="true" data-size="5" title="Eğitmen Seçiniz">
                      <option value="Deniz Güzel">Deniz Güzel</option>
                      <option value="Okan Uzun">Okan Uzun</option>
                      <option value="Ali Kemal Öcalan">Ali Kemal Öcalan</option>
                      <option value="Burak Ermeydan">Burak Ermeydan</option>
                    </select>
                  </div>
                </div>
                <div class="col-lg-6 col-xl-3">
                  <div class="form-group">
                    <input type="text" data-provide="datepicker" class="form-control datepicker" placeholder="Başlangıç Tarihi">
                  </div>
                </div>
                <div class="col-lg-6 col-xl-3">
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
          </form>
        </div>
      </div>
    </div>
  </div>

<?php include "footer.php"; ?>