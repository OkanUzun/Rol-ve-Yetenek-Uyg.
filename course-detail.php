<?php include "header.php"; ?>

<div class="wrapper">
  <?php include "sidebar.php"; ?>
  <div class="page-content">
    <?php include "navbar.php"; ?>
    <div class="container-fluid">
      <div class="card">
        <div class="card-header hidden-xs-down">
          <div class="card-title">Eğitim Detayları</div>
          <div class="card-buttons">
            <button type="submit" class="btn btn-danger">İptal Et</button>
            <button type="submit" class="btn btn-danger">Sonlandır</button>
          </div>
        </div>
        <div class="card-block">
          <div class="course-status">Eğitim Durumu:
            <span class="wait">Beklemede<i class="mdi mdi-timer"></i></span>
            <span class="on">Devam Ediyor<i class="mdi mdi-timer-sand"></i></span>
            <span class="off">Sona Erdi<i class="mdi mdi-check"></i></span>
            <span class="cancel">İptal Edildi<i class="mdi mdi-timer-off"></i></span>
          </div>
          <ul class="nav nav-tabs">
            <li class="nav-item">
              <a class="nav-link active" data-toggle="tab" href="#info">Bilgiler</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-toggle="tab" href="#topic">Konular</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-toggle="tab" href="#user">Kullanıcılar</a>
            </li>
          </ul>
          <div class="tab-content">
            <div class="tab-pane fade in active" id="info">
              <form method="post">
                <div class="row">
                  <div class="col-xs-12">
                    <div class="card-title">Eğitim Bilgileri
                      <button type="submit" class="btn btn-success">Kaydet</button>
                    </div>
                  </div>
                  <div class="col-xs-12 col-md-6">
                    <div class="form-group">
                      <input type="text" class="form-control" placeholder="Eğitim Adı">
                    </div>
                  </div>
                  <div class="col-xs-12 col-md-6">
                    <div class="form-group">
                      <input type="text" class="form-control" placeholder="Eğitmen">
                    </div>
                  </div>
                  <div class="col-xs-12 col-md-6">
                    <div class="form-group">
                      <input type="text" data-provide="datepicker" class="form-control datepicker" placeholder="Başlangıç Tarihi">
                    </div>
                  </div>
                  <div class="col-xs-12 col-md-6">
                    <div class="form-group">
                      <input type="text" data-provide="datepicker" class="form-control datepicker" placeholder="Bitiş Tarihi">
                    </div>
                  </div>
                  <div class="col-xs-12">
                    <div class="form-group">
                      <textarea rows="5" class="form-control" placeholder="Eğitim Detayları"></textarea>
                    </div>
                  </div>
                </div>
              </form>
            </div>
            <div class="tab-pane fade" id="topic">
              <form method="post">
                <div class="row">
                  <div class="col-xs-12">
                    <div class="card-title">Eğitim Konuları
                      <button type="submit" class="btn btn-success" disabled>Kaydet</button>
                    </div>
                  </div>
                  <div class="col-xs-12 col-xl-6">
                    <div class="table-responsive">
                      <table class="table table-specific">
                        <thead>
                        <tr>
                          <th>Kayıtlı Konular</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                          <td>HTML<a href="javascript:void(0)" onclick="changeSide()" class="btn btn-danger float-xs-right">Sil</a></td>
                        </tr>
                        <tr>
                          <td>PHP<a href="javascript:void(0)" onclick="changeSide()" class="btn btn-danger float-xs-right">Sil</a></td>
                        </tr>
                        <tr>
                          <td>Java<a href="javascript:void(0)" onclick="changeSide()" class="btn btn-danger float-xs-right">Sil</a></td>
                        </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                  <div class="col-xs-12 col-xl-6">
                    <div class="table-responsive">
                      <table class="table table-all">
                        <thead>
                        <tr>
                          <th>Tüm Konular</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                          <td>HTML<a href="javascript:void(0)" onclick="changeSide()" class="btn btn-success float-xs-right">Ekle</a></td>
                        </tr>
                        <tr>
                          <td>PHP<a href="javascript:void(0)" onclick="changeSide()" class="btn btn-success float-xs-right">Ekle</a></td>
                        </tr>
                        <tr>
                          <td>Android<a href="javascript:void(0)" onclick="changeSide()" class="btn btn-success float-xs-right">Ekle</a></td>
                        </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </form>
            </div>
            <div class="tab-pane fade" id="user">
              <form method="post">
                <div class="row">
                  <div class="col-xs-12">
                    <div class="card-title">Eğitimdeki Kullanıcılar
                      <button type="submit" class="btn btn-success" disabled>Kaydet</button>
                    </div>
                  </div>
                  <div class="col-xs-12 col-xl-6">
                    <div class="table-responsive">
                      <table class="table table-specific">
                        <thead>
                        <tr>
                          <th>Kayıtlı Kullanıcılar</th>
                          <th>Rolü</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                          <td>Okan Uzun</td>
                          <td>Java Developer<a href="javascript:void(0)" onclick="changeSide()" class="btn btn-danger float-xs-right">Sil</a></td>
                        </tr>
                        <tr>
                          <td>Ali Kemal Öcalan</td>
                          <td>Java Developer<a href="javascript:void(0)" onclick="changeSide()" class="btn btn-danger float-xs-right">Sil</a></td>
                        </tr>
                        <tr>
                          <td>Burak Ermeydan</td>
                          <td>PHP Developer<a href="javascript:void(0)" onclick="changeSide()" class="btn btn-danger float-xs-right">Sil</a></td>
                        </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                  <div class="col-xs-12 col-xl-6">
                    <div class="table-responsive">
                      <table class="table table-all">
                        <thead>
                        <tr>
                          <th>Tüm Kullanıcılar</th>
                          <th>Rolü</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                          <td>Deniz Güzel</td>
                          <td>Android Developer<a href="javascript:void(0)" onclick="changeSide()" class="btn btn-success float-xs-right">Ekle</a></td>
                        </tr>
                        <tr>
                          <td>Ali Kemal Öcalan</td>
                          <td>Java Developer<a href="javascript:void(0)" onclick="changeSide()" class="btn btn-success float-xs-right">Ekle</a></td>
                        </tr>
                        <tr>
                          <td>Burak Ermeydan</td>
                          <td>PHP Developer<a href="javascript:void(0)" onclick="changeSide()" class="btn btn-success float-xs-right">Ekle</a></td>
                        </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php include "footer.php"; ?>
