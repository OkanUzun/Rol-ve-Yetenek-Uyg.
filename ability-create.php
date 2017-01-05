<?php
  include "header.php";
  include "dbsettings.php";

  if (isset($_POST["create-ability"])) {
    $sql  = 'BEGIN SP_CREATE_ABILITY(:ablty_name,:is_valid); END;';
    $stmt = oci_parse($conn, $sql);


    oci_bind_by_name($stmt, ':ablty_name', $ablty_name);
    oci_bind_by_name($stmt, ':is_valid', $message);

    $ablty_name = $_POST["ability_name"];

    oci_execute($stmt);
    if ($message == 1)
      echo '<script type="text/javascript">showtoast("Yetenek Oluşturuldu");</script>';
    else
      echo '<script type="text/javascript">showtoast("Yetenek Oluşturulamadı");</script>';
  }

  else if (isset($_POST["update-ability"])) {
    $sql  = 'BEGIN SP_UPDATE_ABILITY(:ablty_id,:ablty_name,:is_valid); END;';
    $stmt = oci_parse($conn, $sql);

    oci_bind_by_name($stmt, ':ablty_id', $ablty_id);
    oci_bind_by_name($stmt, ':ablty_name', $ablty_name);
    oci_bind_by_name($stmt, ':is_valid', $message);

    $ablty_id   = $_POST["ability_id"];
    $ablty_name = $_POST["ability_name"];

    oci_execute($stmt);
    if ($message == 1)
      echo '<script type="text/javascript">showtoast("Yetenek Güncellendi");</script>';
    else
      echo '<script type="text/javascript">showtoast("Yetenek Güncellenemedi");</script>';
  }

  else if (isset($_POST["delete-ability"])) {
    $sql  = 'BEGIN SP_REMOVE_ABILITY(:ablty_id,:is_valid); END;';
    $stmt = oci_parse($conn, $sql);


    oci_bind_by_name($stmt, ':ablty_id', $ablty_id);
    oci_bind_by_name($stmt, ':is_valid', $message);

    $ablty_id = $_POST["ability_id"];

    oci_execute($stmt);
    if ($message == 1)
      echo '<script type="text/javascript">showtoast("Yetenek Silindi");</script>';
    else
      echo '<script type="text/javascript">showtoast("Yetenek Silinemedi");</script>';
  }
?>

  <div class="wrapper">
    <?php include "sidebar.php"; ?>
    <div class="page-content">
      <?php include "navbar.php"; ?>
      <div class="container-fluid">
        <div class="card">
          <div class="card-header">
            <a href="javascript:void(0);" class="btn btn-info create"><i class="mdi mdi-account-star-variant"></i>Yetenek Oluştur</a>
            <form id="formValidate" class="form-create form-inline hidden" method="post">
              <div class="form-group">
                <input type="text" class="form-control" placeholder="Yetenek Adı Giriniz" name="ability_name">
              </div>
              <button type="submit" class="btn btn-success" name="create-ability">Kaydet</button>
              <button type="button" class="btn btn-danger">İptal</button>
            </form>
          </div>
          <div class="card-block">
            <table class="table" id="dataTable-ability">
              <thead>
              <tr>
                <th>Yetenek Adı</th>
                <th>Yetkin Kişi Sayısı</th>
                <th>İşlemler</th>
              </tr>
              </thead>
              <tbody>
              <?php
                include "dbsettings.php";
                $sql  = 'SELECT * FROM V_ABILITIES';
                $stmt = oci_parse($conn, $sql);
                $r    = oci_execute($stmt);
                while ($row = oci_fetch_array($stmt, OCI_RETURN_NULLS + OCI_ASSOC)) {
                  echo '<tr>';
                  echo '<td>'.$row['ABILITY_NAME'].'</td>';
                  echo '<td>'.$row['X'].'</td>';
                  echo '
                     <td class="text-xs-center">
                      <a href="#updateModal" class="btn btn-table" rel="tooltip" title="Güncelle" data-toggle="modal" data-id="'.$row['PK'].'" data-name="'.$row['ABILITY_NAME'].'"><i class="mdi mdi-autorenew"></i></a>
                      <a href="#deleteModal" class="btn btn-table" rel="tooltip" title="Sil" data-toggle="modal" data-id="'.$row['PK'].'"><i class="mdi mdi-delete"></i></a>
                     </td>';
                  echo '</tr>';
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
          <h4 class="modal-title" id="updateModalLabel">Yetenek Güncelle</h4>
        </div>
        <form method="post">
          <div class="modal-body">
            <div class="form-group">
              <label for="updateName" class="form-control-label">Yetenek Adı:</label>
              <input type="text" class="form-control" id="updateName" name="ability_name">
              <input type="hidden" name="ability_id" id="ability_id">
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Kapat</button>
            <button type="submit" class="btn btn-success" name="update-ability">Güncelle</button>
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
            <input type="hidden" name="ability_id" id="ability_id">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Kapat</button>
            <button type="submit" class="btn btn-danger" name="delete-ability">Sil</button>
          </div>
        </form>
      </div>
    </div>
  </div>

<?php include "footer.php"; ?>