<?php
  include "header.php";
  include "dbsettings.php";

  if (isset($_POST["create-educator"])) {
    $sql  = 'BEGIN SP_CREATE_EDUCATOR(:edctr_name,:is_inhuse,:usr_id,:is_valid); END;';
    $stmt = oci_parse($conn, $sql);


    oci_bind_by_name($stmt, ':edctr_name', $educator_name);
    oci_bind_by_name($stmt, ':is_inhuse', $is_inhouse);
    oci_bind_by_name($stmt, ':usr_id', $user_id);
    oci_bind_by_name($stmt, ':is_valid', $message);

    $educator_name = $_POST["educator_name"];
    $is_inhouse    = $_POST["is_inhouse"];
    $user_id       = $_POST["user_id"];

    oci_execute($stmt);
    if ($message == 1)
      echo '<script type="text/javascript">showtoast("Eğitimci Oluşturuldu");$(".toast").addClass("toast-success");</script>';
    else
      echo '<script type="text/javascript">showtoast("Eğitimci Oluşturulamadı");$(".toast").addClass("toast-error");</script>';

  }
  else if (isset($_POST["update-educator"])) {
    $sql  = 'BEGIN SP_UPDATE_EDUCATOR(:edctr_id,:edctr_name,:is_valid); END;';
    $stmt = oci_parse($conn, $sql);


    oci_bind_by_name($stmt, ':edctr_id', $educator_id);
    oci_bind_by_name($stmt, ':edctr_name', $educator_name);
    oci_bind_by_name($stmt, ':is_valid', $message);

    $educator_id   = $_POST["educator_id"];
    $educator_name = $_POST["educator_name"];

    oci_execute($stmt);
    if ($message == 1)
      echo '<script type="text/javascript">showtoast("Eğitimci Güncellendi");$(".toast").addClass("toast-success");</script>';
    else
      echo '<script type="text/javascript">showtoast("Eğitimci Güncellenemedi");$(".toast").addClass("toast-error");</script>';
  }
  else if (isset($_POST["delete-educator"])) {
    $sql  = 'BEGIN SP_REMOVE_EDUCATOR(:edctr_id,:is_valid); END;';
    $stmt = oci_parse($conn, $sql);


    oci_bind_by_name($stmt, ':edctr_id', $educator_id);
    oci_bind_by_name($stmt, ':is_valid', $message);

    $educator_id = $_POST["educator_id"];

    oci_execute($stmt);
    if ($message == 1)
      echo '<script type="text/javascript">showtoast("Eğitimci Silindi");$(".toast").addClass("toast-success");</script>';
    else
      echo '<script type="text/javascript">showtoast("Eğitimci Silinemedi");$(".toast").addClass("toast-error");</script>';
  }
?>

  <div class="wrapper">
    <?php include "sidebar.php"; ?>
    <div class="page-content">
      <?php include "navbar.php"; ?>
      <div class="container-fluid">
        <div class="card">
          <div class="card-header">
            <a href="javascript:void(0)" class="btn btn-info instructor"><i class="mdi mdi-account-switch"></i>Eğitmen Oluştur</a>
            <form id="formValidate" class="form-create form-inline hidden" method="post">
              <div class="instructor-status">
                <div class="form-check">
                  <input type="radio" id="companyIn" value="1" name="is_inhouse">
                  <label for="companyIn">Şirket İçi</label>
                </div>
                <div class="form-check">
                  <input type="radio" id="companyOut" value="0" name="is_inhouse">
                  <label for="companyOut">Şirket Dışı</label>
                </div>
              </div>
              <div class="company-in hidden">
                <div class="form-group">
                  <?php
                    include "dbsettings.php";
                    $sql  = 'SELECT * FROM V_USERS_WITH_ROLE';
                    $stmt = oci_parse($conn, $sql);
                    $r    = oci_execute($stmt);
                    echo '<select name="user_id" class="form-control selectpicker" data-live-search="true" data-size="5" data-width="200px" title="Eğitmen Seçiniz">';
                    while ($row = oci_fetch_array($stmt, OCI_RETURN_NULLS + OCI_ASSOC)) {
                      echo '<option value ="'.$row["PK"].'">'.$row["F_NAME"].' '.$row["L_NAME"].' | '.$row["RLE_NAME"].'</option>';
                    }
                    echo '</select>';
                  ?>
                </div>
                <button type="submit" class="btn btn-success" name="create-educator">Kaydet</button>
                <button type="button" class="btn btn-danger">İptal</button>
              </div>
              <div class="company-out hidden">
                <div class="form-group">
                  <input type="text" class="form-control" placeholder="Eğitmen Adı ve Soyadı" name="educator_name">
                </div>
                <button type="submit" class="btn btn-success" name="create-educator">Kaydet</button>
                <button type="button" class="btn btn-danger">İptal</button>
              </div>
            </form>
          </div>
          <div class="card-block">
            <table class="table" id="dataTable-instructor">
              <thead>
              <tr>
                <th>Eğitmen Adı-Soyadı</th>
                <th>Durum</th>
                <th>İşlemler</th>
              </tr>
              </thead>
              <tbody>
              <?php
                include "dbsettings.php";
                $sql  = 'SELECT * FROM V_EDUCATORS';
                $stmt = oci_parse($conn, $sql);
                $r    = oci_execute($stmt);
                while ($row = oci_fetch_array($stmt, OCI_RETURN_NULLS + OCI_ASSOC)) {
                  $a_tag_format = "";
                  echo '<tr>';
                  echo '<td>'.$row['EDUCATOR_NAME'].'</td>';
                  echo '<td>'.($row['IS_INHOUSE'] == '1' ? "Şirket içi" : "Şirket dışı").'</td>';
                  echo '<td class="text-xs-center">';
                  if ($row['IS_INHOUSE'] == '1') {
                    echo '<a href="javascript:void(0)" class="btn btn-table disabled"><i class="mdi mdi-autorenew"></i></a>';
                  }
                  else {
                    echo '<a href="#updateModal" class="btn btn-table" rel="tooltip" title="Güncelle" data-toggle="modal" data-id="'.$row['PK'].'" data-name="'.$row['EDUCATOR_NAME'].'"><i class="mdi mdi-autorenew"></i></a>';
                  }
                  echo '<a href="#deleteModal" class="btn btn-table" rel="tooltip" title="Sil" data-toggle="modal" data-id="'.$row['PK'].'"><i class="mdi mdi-delete"></i></a>';
                  echo '</td></tr>';
                }
              ?>
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
        <form method="post">
          <div class="modal-body">
            <div class="form-group">
              <label for="updateName" class="form-control-label">Eğitmen Adı:</label>
              <input type="text" class="form-control" id="updateName" name="educator_name">
              <input type="hidden" name="educator_id" id="educator_id">
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Kapat</button>
            <button type="submit" class="btn btn-success" name="update-educator">Güncelle</button>
          </div>
        </form>
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
        <form method="post">
          <div class="modal-body">
            <p>Silmek istediğinize emin misiniz?</p>
            <input type="hidden" name="educator_id" id="educator_id">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Kapat</button>
            <button type="submit" class="btn btn-danger" name="delete-educator">Sil</button>
          </div>
        </form>
      </div>
    </div>
  </div>

<?php include "footer.php"; ?>