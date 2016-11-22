<?php 
  include "header.php"; 
  include "dbsettings.php";

  if (isset($_POST["create-role"])){
    $sql = 'BEGIN SP_CREATE_UNIT(:unt_name,:dep_id,:is_valid); END;';
    $stmt = oci_parse($conn,$sql);


    oci_bind_by_name($stmt,':unt_name',$unit_name);
    oci_bind_by_name($stmt,':dep_id',$dep_id);
    oci_bind_by_name($stmt,':is_valid',$message);

    $unit_name = $_POST["unit_name"];
    $dep_id = $_POST["dep_id"];

    oci_execute($stmt);
    //echo "$message\n";
  }

  else if (isset($_POST["update-role"])){
    $sql = 'BEGIN SP_UPDATE_UNIT(:unt_id,:unt_name,:dep_id,:is_valid); END;';
    $stmt = oci_parse($conn,$sql);

    oci_bind_by_name($stmt,':unt_id',$unit_id);
    oci_bind_by_name($stmt,':unt_name',$unit_name);
    oci_bind_by_name($stmt,':dep_id',$dep_id);
    oci_bind_by_name($stmt,':is_valid',$message);

    $unit_id = $_POST["unit_id"];
    $unit_name = $_POST["unit_name"];
    $dep_id = $_POST["dep_id"];

    oci_execute($stmt);
    //echo "$message\n";
  }

  else if (isset($_POST["delete-role"])){
    $sql = 'BEGIN SP_REMOVE_UNIT(:unt_id,:is_valid); END;';
    $stmt = oci_parse($conn,$sql);

    oci_bind_by_name($stmt,':unt_id',$unit_id);
    oci_bind_by_name($stmt,':is_valid',$message);

    $unit_id = $_POST["unit_id"];

    oci_execute($stmt);
    //echo "$message\n";
  }
?>

  <div class="wrapper">
    <?php include "sidebar.php"; ?>
    <div class="page-content">
      <?php include "navbar.php"; ?>
      <div class="container-fluid">
        <div class="card">
          <div class="card-header">
            <a href="javascript:void(0);" class="btn btn-info create"><i class="mdi mdi-account-check"></i>Rol Oluştur</a>
            <form class="form-create form-inline hidden" method="post">
              <div class="form-group">
                <input type="text" class="form-control" placeholder="Rol Adı Giriniz">
              </div>
              <div class="form-group">
                <select class="form-control selectpicker" id="roleDepartment" data-live-search="true" data-size="5" data-width="auto" title="Bağlı Olduğu Departmanı Seçiniz">
                  <option>Seçiniz</option>
                  <option>A Departmanı</option>
                  <option>B Departmanı</option>
                  <option>C Departmanı</option>
                  <option>D Departmanı</option>
                </select>
              </div>
              <div class="form-group">
                <select class="form-control selectpicker" id="roleUnit" data-live-search="true" data-size="5" data-width="auto" title="Bağlı Olduğu Birimi Seçiniz">
                  <option>Seçiniz</option>
                  <option value="A Birimi">A Birimi</option>
                  <option value="B Birimi">B Birimi</option>
                  <option value="C Birimi">C Birimi</option>
                  <option value="D Birimi">D Birimi</option>
                </select>
              </div>
              <button type="submit" class="btn btn-success">Kaydet</button>
              <button type="button" class="btn btn-danger">İptal</button>
            </form>
          </div>
          <div class="card-block">
            <table class="table" id="dataTable-role">
              <thead>
              <tr>
                <th>Rol Adı</th>
                <th>Çalışan Sayısı</th>
                <th>İşlemler</th>
              </tr>
              </thead>
              <tbody>
              <tr>
                <td>Ağ Uzmanı</td>
                <td>2</td>
                <td class="text-xs-center">
                  <a href="#" class="table-icon" rel="tooltip" title="Güncelle" data-toggle="modal" data-target="#updateModal" data-name="Ağ Uzmanı"><i class="mdi mdi-autorenew"></i></a>
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
              <label for="updateName" class="form-control-label">Rol Adı:</label>
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