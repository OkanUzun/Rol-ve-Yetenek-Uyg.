<?php
  include "header.php";
  include "dbsettings.php";

  if (isset($_POST["create-role"])) {
    $sql  = 'BEGIN SP_CREATE_ROLE(:rle_name,:unt_id,:dep_id,:is_valid); END;';
    $stmt = oci_parse($conn, $sql);


    oci_bind_by_name($stmt, ':rle_name', $role_name);
    oci_bind_by_name($stmt, ':unt_id', $unit_id);
    oci_bind_by_name($stmt, ':dep_id', $dep_id);
    oci_bind_by_name($stmt, ':is_valid', $message);


    if (isset($_POST["unit_id"])) {
      $unit_id = $_POST["unit_id"];
    }

    if (isset($_POST["dep_id"])) {
      $dep_id = $_POST["dep_id"];
    }

    $role_name = $_POST["role_name"];

    oci_execute($stmt);
    //echo "$message\n";
  }
  else if (isset($_POST["update-role"])) {
    $sql  = 'BEGIN SP_UPDATE_ROLE(:rle_id,:rle_name,:unt_id,:dep_id,:is_valid); END;';
    $stmt = oci_parse($conn, $sql);

    oci_bind_by_name($stmt, ':rle_id', $role_id);
    oci_bind_by_name($stmt, ':rle_name', $role_name);
    oci_bind_by_name($stmt, ':unt_id', $unit_id);
    oci_bind_by_name($stmt, ':dep_id', $dep_id);
    oci_bind_by_name($stmt, ':is_valid', $message);

    $role_id   = $_POST["role_id"];
    $role_name = $_POST["role_name"];
    $unit_id   = $_POST["unit_id"];
    $dep_id    = $_POST["dep_id"];

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
              <div class="alert">
                <strong>Uyarı!</strong> Lütfen rol oluştururken <u>departman</u> veya <u>birim</u> bilgilerinden sadece bir tanesini giriniz.
              </div>
              <div class="form-group">
                <input type="text" class="form-control" placeholder="Rol Adı Giriniz" name="role_name">
              </div>
              <div class="form-group">
                <?php
                  include "dbsettings.php";
                  $sql  = 'SELECT PK,INITCAP(DEPARTMENT_NAME) AS DEP_NAME 
                  FROM T_DEPARTMENT
                  ORDER BY DEP_NAME';
                  $stmt = oci_parse($conn, $sql);
                  $r    = oci_execute($stmt);
                  echo '<select id="roleDepartment" name="dep_id" class="form-control selectpicker" data-live-search="true" data-size="5" data-width="auto" title="Bağlı Olduğu Departmanı Seçiniz">';
                  echo '<option>Seçiniz</option>';
                  while ($row = oci_fetch_array($stmt, OCI_RETURN_NULLS + OCI_ASSOC))
                    echo '<option value ="'.$row["PK"].'">'.$row["DEP_NAME"].'</option>';
                  echo '</select>';
                ?>
              </div>
              <div class="form-group">
                <?php
                  include "dbsettings.php";
                  $sql  = 'SELECT T_UNIT.PK,INITCAP(T_UNIT.UNIT_NAME) AS UNT_NAME,INITCAP(T_DEPARTMENT.DEPARTMENT_NAME) AS DEP_NAME 
                  FROM T_UNIT,T_DEPARTMENT 
                  WHERE T_UNIT.DEPARTMENT_FK = T_DEPARTMENT.PK
                  ORDER BY UNT_NAME';
                  $stmt = oci_parse($conn, $sql);
                  $r    = oci_execute($stmt);
                  echo '<select id="roleUnit" name="unit_id" class="form-control selectpicker" data-live-search="true" data-size="5" data-width="auto" title="Bağlı Olduğu Birimi Seçiniz">';
                  echo '<option>Seçiniz</option>';
                  while ($row = oci_fetch_array($stmt, OCI_RETURN_NULLS + OCI_ASSOC))
                    echo '<option value ="'.$row["PK"].'">'.$row["UNT_NAME"].' | '.$row["DEP_NAME"].'</option>';
                  echo '</select>';
                ?>
              </div>
              <button type="submit" class="btn btn-success" name="create-role">Kaydet</button>
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
              <?php
                include "dbsettings.php";
                $sql  = 'SELECT T_ROLE.PK,INITCAP(T_ROLE.ROLE_NAME) AS RLE_NAME,T_DEPARTMENT.DEPARTMENT_NAME AS DEP_NAME,T_UNIT.UNIT_NAME AS U_NAME,
              (SELECT COUNT(T_USER.PK) FROM T_USER
              WHERE T_USER.ROLE_FK = T_ROLE.PK) AS X,T_UNIT.PK AS U_PK,T_DEPARTMENT.PK AS DEP_PK FROM T_ROLE
              LEFT JOIN T_UNIT ON T_ROLE.UNIT_FK = T_UNIT.PK
              LEFT JOIN T_DEPARTMENT ON T_ROLE.DEPARTMENT_FK = T_DEPARTMENT.PK
              ORDER BY RLE_NAME';
                $stmt = oci_parse($conn, $sql);
                $r    = oci_execute($stmt);
                while ($row = oci_fetch_array($stmt, OCI_RETURN_NULLS + OCI_ASSOC)) {
                  echo '<tr>';
                  echo '<td>'.$row['RLE_NAME'].'</td>';
                  echo '<td>'.$row['X'].'</td>';
                  echo '
                     <td class="text-xs-center">
                      <a href="#updateModal" class="table-icon" rel="tooltip" title="Güncelle" data-toggle="modal" data-id="'.$row['PK'].'" data-name="'.$row['RLE_NAME'].'" data-unit="'.$row['U_NAME'].'" data-department="'.$row['DEP_NAME'].'"><i class="mdi mdi-autorenew"></i></a>
                      <a href="#deleteModal" class="table-icon" rel="tooltip" title="Sil" data-toggle="modal" data-id="'.$row['PK'].'"><i class="mdi mdi-delete"></i></a>
                     </td>';
                  echo '<tr>';
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
              <label for="updateName" class="form-control-label">Rol Adı:</label>
              <input type="text" class="form-control" id="updateName" name="role_name">
              <input type="hidden" name="role_id" id="role_id">
            </div>
            <div class="form-group">
              <label for="updateDepartmentSelect" class="form-control-label">Departman:</label>
              <?php
                include "dbsettings.php";
                $sql  = 'SELECT PK,INITCAP(DEPARTMENT_NAME) AS DEP_NAME FROM T_DEPARTMENT ORDER BY DEP_NAME';
                $stmt = oci_parse($conn, $sql);
                $r    = oci_execute($stmt);
                echo '<select id="updateDepartmentSelect" name="dep_id" class="form-control selectpicker" data-live-search="true" data-size="5">';
                while ($row = oci_fetch_array($stmt, OCI_RETURN_NULLS + OCI_ASSOC))
                  echo '<option value ="'.$row["PK"].'">'.$row["DEP_NAME"].'</option>';
                echo '</select>';
              ?>
            </div>
            <div class="form-group">
              <label for="updateUnitSelect" class="form-control-label">Birim:</label>
              <?php
                include "dbsettings.php";
                $sql  = 'SELECT PK,INITCAP(UNIT_NAME) AS UNT_NAME FROM T_UNIT ORDER BY UNT_NAME';
                $stmt = oci_parse($conn, $sql);
                $r    = oci_execute($stmt);
                echo '<select id="updateUnitSelect" name="unit_id" class="form-control selectpicker" data-live-search="true" data-size="5">';
                while ($row = oci_fetch_array($stmt, OCI_RETURN_NULLS + OCI_ASSOC))
                  echo '<option value ="'.$row["PK"].'">'.$row["UNT_NAME"].'</option>';
                echo '</select>';
              ?>
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