<?php include "header.php"; ?>

  <div class="wrapper">
    <?php include "sidebar.php"; ?>
    <div class="page-content">
      <?php include "navbar.php"; ?>
      <div class="container-fluid">
        <div class="card">
          <div class="card-header">
            <a href="javascript:void(0);" class="btn btn-info instructor"><i class="mdi mdi-account-switch"></i>Eğitmen Oluştur</a>
            <form class="form-create form-inline hidden" method="post">
              <div class="instructor-status">
                <div class="form-check">
                  <input type="radio" id="companyIn" name="instStatus">
                  <label for="companyIn">Şirket İçi</label>
                </div>
                <div class="form-check">
                  <input type="radio" id="companyOut" name="instStatus">
                  <label for="companyOut">Şirket Dışı</label>
                </div>
              </div>
              <div class="company-in hidden">
                <div class="form-group">
                  <select class="form-control selectpicker" data-live-search="true" data-size="5" data-width="auto" title="Eğitmen Seçiniz">
                    <option>Deniz Güzel</option>
                    <option>Okan Uzun</option>
                  </select>
                </div>
                <button type="submit" class="btn btn-success">Kaydet</button>
                <button type="button" class="btn btn-danger">İptal</button>
              </div>
              <div class="company-out hidden">
                <div class="form-group">
                  <input type="text" class="form-control" placeholder="Eğitmen Adı ve Soyadı">
                </div>
                <button type="submit" class="btn btn-success">Kaydet</button>
                <button type="button" class="btn btn-danger">İptal</button>
              </div>
            </form>
          </div>
          <div class="card-block">
            <table class="table" id="dataTable-role">
              <thead>
              <tr>
                <th>Eğitmen Adı</th>
                <th>Eğitmen Soyadı</th>
                <th>Durum</th>
                <th>İşlemler</th>
              </tr>
              </thead>
              <tbody>
              <tr>
                <td>Deniz</td>
                <td>Güzel</td>
                <td>Şirket İçi Çalışan</td>
                <td class="text-xs-center">
                  <a href="#" class="table-icon" rel="tooltip" title="Güncelle" data-toggle="modal" data-target="#updateModal" data-name="Deniz" data-surname="Güzel"><i class="mdi mdi-autorenew"></i></a>
                  <a href="#" class="table-icon" rel="tooltip" title="Sil" data-toggle="modal" data-target="#deleteModal"><i class="mdi mdi-delete"></i></a>
                </td>
              </tr>
              <tr>
                <td>Deniz</td>
                <td>Güzel</td>
                <td>Şirket Dışı Eğitmen</td>
                <td class="text-xs-center">
                  <a href="#" class="table-icon" rel="tooltip" title="Güncelle" data-toggle="modal" data-target="#updateModal" data-name="Deniz" data-surname="Güzel"><i class="mdi mdi-autorenew"></i></a>
                  <a href="#" class="table-icon" rel="tooltip" title="Sil" data-toggle="modal" data-target="#deleteModal"><i class="mdi mdi-delete"></i></a>
                </td>
              </tr>
              </tbody>
            </table>
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
          <h4 class="modal-title" id="updateModalLabel">Rol Güncelle</h4>
        </div>
        <div class="modal-body">
          <form method="post">
            <div class="form-group">
              <label for="updateName" class="form-control-label">Eğitmen Adı:</label>
              <input type="text" class="form-control" id="updateName">
            </div>
            <div class="form-group">
              <label for="updateSurname" class="form-control-label">Eğitmen Soyadı:</label>
              <input type="text" class="form-control" id="updateSurname">
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

  <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <i class="mdi mdi-close"></i>
          </button>
          <h4 class="modal-title" id="deleteModalLabel">Silme Onayı</h4>
        </div>
        <div class="modal-body">
          <p>Silmek istediğinize emin misiniz?</p>
        </div>
        <div class="modal-footer">
          <form method="post">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Kapat</button>
            <button type="submit" class="btn btn-danger">Sil</button>
          </form>
        </div>
      </div>
    </div>
  </div>

<?php include "footer.php"; ?>