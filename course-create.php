<?php include "header.php"; ?>

  <div class="wrapper">
    <?php include "sidebar.php"; ?>
    <div class="page-content">
      <?php include "navbar.php"; ?>
      <div class="container-fluid">
        <div class="card">
          <form method="post" novalidate>
            <div class="card-header">
              <div class="card-title">Eğitim Tanımlama</div>
              <button type="submit" class="btn btn-success">Kaydet</button>
            </div>
            <div class="card-block">
              <div class="row">
                <div class="col-md-12 col-lg-6">
                  <div class="row">
                    <div class="col-xs-12">
                      <div class="card-title">Eğitim Bilgileri</div>
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
                <div class="col-md-12 col-lg-6">
                  <div class="card-title">Eğitim Konuları<a href="javascript:void(0)" id="courseAbilityChange" class="btn btn-primary">Konu Ekle</a></div>
                  <div class="table-responsive">
                    <table class="table">
                      <thead>
                      <tr>
                        <th>Konu</th>
                      </tr>
                      </thead>
                      <tbody>
                      <tr>
                        <td>HTML</td>
                      </tr>
                      <tr>
                        <td>PHP</td>
                      </tr>
                      <tr>
                        <td>Java</td>
                      </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
                <div id="ability-container" class="col-xs-12 hidden"></div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

<?php include "footer.php"; ?>