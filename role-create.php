<?php
  include "header.php";
  include "dbsettings.php";

  if (isset($_POST["create-role"])) {
    $sql  = 'BEGIN SP_CREATE_ROLE(:rle_name,:is_valid); END;';
    $stmt = oci_parse($conn, $sql);


    oci_bind_by_name($stmt, ':rle_name', $role_name);
    oci_bind_by_name($stmt, ':is_valid', $message);

    $role_name = $_POST["role_name"];

    oci_execute($stmt);
    //echo "$message\n";
  }
  else if (isset($_POST["update-role"])) {
    $sql  = 'BEGIN SP_UPDATE_ROLE(:rle_id,:rle_name,:is_valid); END;';
    $stmt = oci_parse($conn, $sql);

    oci_bind_by_name($stmt, ':rle_id', $role_id);
    oci_bind_by_name($stmt, ':rle_name', $role_name);
    oci_bind_by_name($stmt, ':is_valid', $message);

    $role_id   = $_POST["role_id"];
    $role_name = $_POST["role_name"];

    oci_execute($stmt);
    //echo "$message\n";
  }
  else if (isset($_POST["delete-role"])) {
    $sql  = 'BEGIN SP_REMOVE_ROLE(:rle_id,:is_valid); END;';
    $stmt = oci_parse($conn, $sql);

    oci_bind_by_name($stmt, ':rle_id', $role_id);
    oci_bind_by_name($stmt, ':is_valid', $message);

    $role_id = $_POST["role_id"];

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
            <form id="formValidate" class="form-create form-inline hidden" method="post">
              <div class="form-group">
                <input type="text" class="form-control" placeholder="Rol Adı Giriniz" name="role_name">
              </div>
              <button type="submit" class="btn btn-success" name="create-role">Kaydet</button>
              <button type="button" class="btn btn-danger">İptal</button>
            </form>
          </div>
          <div class="card-block">
            <form method="post">
              <table class="table" id="dataTable-role">
                <thead>
                <tr>
                  <th>Rol Adı</th>
                  <th>Çalışan Sayısı</th>
                  <th>İşlemler</th>
                </tr>
                </thead>
                <tbody>
                <?php
                  include "dbsettings.php";
                  $sql  = 'SELECT T_ROLE.PK,T_ROLE.ROLE_NAME AS RLE_NAME,COUNT(T_USER.PK) AS X
                  FROM T_ROLE
                  LEFT JOIN T_USER ON T_USER.ROLE_FK = T_ROLE.PK
                  GROUP BY T_ROLE.PK,T_ROLE.ROLE_NAME
                  ORDER BY T_ROLE.ROLE_NAME';
                  $stmt = oci_parse($conn, $sql);
                  $r    = oci_execute($stmt);
                  while ($row = oci_fetch_array($stmt, OCI_RETURN_NULLS + OCI_ASSOC)) {
                    echo '<tr>';
                    echo '<td>'.$row['RLE_NAME'].'</td>';
                    echo '<td>'.$row['X'].'</td>';
                    echo '
                     <td class="text-xs-center">
                      <a href="#updateModal" class="btn btn-table" rel="tooltip" title="Güncelle" data-toggle="modal" data-id="'.$row['PK'].'" data-name="'.$row['RLE_NAME'].'"><i class="mdi mdi-autorenew"></i></a>
                      <a href="#deleteModal" class="btn btn-table" rel="tooltip" title="Sil" data-toggle="modal" data-id="'.$row['PK'].'"><i class="mdi mdi-delete"></i></a>
                      <button type="submit" class="btn btn-table" rel="tooltip" title="Detay"><i class="mdi mdi-magnify"></i></a>
                     </td>';
                    echo '</tr>';
                  }
                ?>
                </tbody>
              </table>
            </form>
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
              <label for="updateName" class="form-control-label">Rol Adı:</label>
              <input type="text" class="form-control" id="updateName" name="role_name">
              <input type="hidden" name="role_id" id="role_id">
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Kapat</button>
            <button type="submit" class="btn btn-success" name="update-role">Güncelle</button>
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
            <input type="hidden" name="role_id" id="role_id">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Kapat</button>
            <button type="submit" class="btn btn-danger" name="delete-role">Sil</button>
          </div>
        </form>
      </div>
    </div>
  </div>

<?php include "footer.php"; ?>