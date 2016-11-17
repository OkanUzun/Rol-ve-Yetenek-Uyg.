<?php include "header.php"; ?>

  <div class="wrapper">
    <?php include "sidebar.php"; ?>
    <div class="page-content">
      <?php include "navbar.php"; ?>
      <div class="container-fluid">
        <div class="card">
          <div class="card-header">
            <div class="card-title">Yetenek Seviyeleri</div>
          </div>
          <div class="card-block">
            <div class="row">
              <div class="col-xs-12 col-xl-8">
                <div class="table-responsive">
                  <table class="table">
                    <thead>
                    <tr>
                      <th>Seviye Adı</th>
                      <th>İşlemler</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                      <td>Çok İyi</td>
                      <td class="text-xs-center">
                        <a href="" class="table-icon" rel="tooltip" title="Güncelle" data-toggle="modal" data-target="#updateModal" data-name="Çok İyi"><i class="mdi mdi-autorenew"></i></a>
                      </td>
                    </tr>
                    <tr>
                      <td>İyi</td>
                      <td class="text-xs-center">
                        <a href="" class="table-icon" rel="tooltip" title="Güncelle" data-toggle="modal" data-target="#updateModal" data-name="İyi"><i class="mdi mdi-autorenew"></i></a>
                      </td>
                    </tr>
                    <tr>
                      <td>Orta</td>
                      <td class="text-xs-center">
                        <a href="" class="table-icon" rel="tooltip" title="Güncelle" data-toggle="modal" data-target="#updateModal" data-name="Orta"><i class="mdi mdi-autorenew"></i></a>
                      </td>
                    </tr>
                    <tr>
                      <td>Kötü</td>
                      <td class="text-xs-center">
                        <a href="" class="table-icon" rel="tooltip" title="Güncelle" data-toggle="modal" data-target="#updateModal" data-name="Kötü"><i class="mdi mdi-autorenew"></i></a>
                      </td>
                    </tr>
                    <tr>
                      <td>Çok Kötü</td>
                      <td class="text-xs-center">
                        <a href="" class="table-icon" rel="tooltip" title="Güncelle" data-toggle="modal" data-target="#updateModal" data-name="Çok Kötü"><i class="mdi mdi-autorenew"></i></a>
                      </td>
                    </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="updateModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <i class="mdi mdi-close"></i>
          </button>
          <h4 class="modal-title" id="updateModalLabel">Seviye Adı Güncelle</h4>
        </div>
        <div class="modal-body">
          <form method="post">
            <div class="form-group">
              <label for="updateName" class="form-control-label">Seviye Adı:</label>
              <input type="text" class="form-control" id="updateName">
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Kapat</button>
          <button type="button" class="btn btn-success">Güncelle</button>
        </div>
      </div>
    </div>
  </div>

<?php include "footer.php"; ?>