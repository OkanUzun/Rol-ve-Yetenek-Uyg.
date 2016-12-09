<?php
  include "header.php";
  include "dbsettings.php";

  if (isset($_POST["create-unit"])) {
    $sql  = 'BEGIN SP_CREATE_UNIT(:unt_name,:dep_id,:is_valid); END;';
    $stmt = oci_parse($conn, $sql);

    oci_bind_by_name($stmt, ':unt_name', $unit_name);
    oci_bind_by_name($stmt, ':dep_id', $dep_id);
    oci_bind_by_name($stmt, ':is_valid', $message);

    $unit_name = $_POST["unit_name"];
    $dep_id    = $_POST["dep_id"];

    oci_execute($stmt);
    //echo "$message\n";
  }
  else if (isset($_POST["update-unit"])) {
    $sql  = 'BEGIN SP_UPDATE_UNIT(:unt_id,:unt_name,:dep_id,:is_valid); END;';
    $stmt = oci_parse($conn, $sql);

    oci_bind_by_name($stmt, ':unt_id', $unit_id);
    oci_bind_by_name($stmt, ':unt_name', $unit_name);
    oci_bind_by_name($stmt, ':dep_id', $dep_id);
    oci_bind_by_name($stmt, ':is_valid', $message);

    $unit_id   = $_POST["unit_id"];
    $unit_name = $_POST["unit_name"];
    $dep_id    = $_POST["dep_id"];

    oci_execute($stmt);
    //echo "$message\n";
  }
  else if (isset($_POST["delete-unit"])) {
    $sql  = 'BEGIN SP_REMOVE_UNIT(:unt_id,:is_valid); END;';
    $stmt = oci_parse($conn, $sql);

    oci_bind_by_name($stmt, ':unt_id', $unit_id);
    oci_bind_by_name($stmt, ':is_valid', $message);

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
            <a href="javascript:void(0);" class="btn btn-info create"><i class="mdi mdi-library-books"></i>Birim Oluştur</a>
            <form id="formValidate2" class="form-create form-inline hidden" method="post">
              <div class="form-group">
                <input type="text" class="form-control" placeholder="Birim Adı Giriniz" name="unit_name">
              </div>
              <div class="form-group">
                <select class="form-control selectpicker" data-live-search="true" data-size="5" title="Birim Yöneticisi Seçiniz">
                  <option value="Okan Uzun">Okan Uzun</option>
                  <option value="Okan Uzun">Okan Uzun</option>
                  <option value="Okan Uzun">Okan Uzun</option>
                </select>
              </div>
              <!--              <div class="form-group">
                <?php
                /*                  include "dbsettings.php";
                                  $sql  = 'SELECT PK,INITCAP(DEPARTMENT_NAME) AS DEP_NAME FROM T_DEPARTMENT ORDER BY DEP_NAME';
                                  $stmt = oci_parse($conn, $sql);
                                  $r    = oci_execute($stmt);
                                  echo '<select name="dep_id" class="form-control selectpicker" data-live-search="true" data-size="5" data-width="auto" title="Bağlı Olduğu Departmanı Seçiniz">';
                                  while ($row = oci_fetch_array($stmt, OCI_RETURN_NULLS + OCI_ASSOC)) {
                                    echo '<option value ="'.$row["PK"].'">'.$row["DEP_NAME"].'</option>';
                                  }
                                  echo '</select>';
                                */ ?>
              </div>-->
              <button type="submit" class="btn btn-success" name="create-unit">Kaydet</button>
              <button type="button" class="btn btn-danger">İptal</button>
            </form>
          </div>
          <div class="card-block">
            <form method="post">
              <table class="table" id="dataTable-unit">
                <thead>
                <tr>
                  <th>Birim Adı</th>
                  <th>Bağlı Olduğu Departman</th>
                  <th>Çalışan Sayısı</th>
                  <th>İşlemler</th>
                </tr>
                </thead>
                <tbody>
                <?php
                  include "dbsettings.php";
                  $sql  = 'SELECT T_UNIT.PK AS PK,INITCAP(T_UNIT.UNIT_NAME) AS UNT_NAME,INITCAP(T_DEPARTMENT.DEPARTMENT_NAME) AS DEP_NAME,(SELECT COUNT(T_USER.PK)
                  FROM T_USER,T_ROLE WHERE T_USER.ROLE_FK = T_ROLE.PK AND T_ROLE.UNIT_FK = T_UNIT.PK ) AS X FROM T_UNIT,T_DEPARTMENT
                  WHERE T_UNIT.DEPARTMENT_FK = T_DEPARTMENT.PK
                  ORDER BY DEP_NAME,UNT_NAME';
                  $stmt = oci_parse($conn, $sql);
                  $r    = oci_execute($stmt);
                  while ($row = oci_fetch_array($stmt, OCI_RETURN_NULLS + OCI_ASSOC)) {
                    echo '<tr>';
                    echo '<td>'.$row['UNT_NAME'].'</td>';
                    echo '<td>'.$row['DEP_NAME'].'</td>';
                    echo '<td>'.$row['X'].'</td>';
                    echo '
                     <td class="text-xs-center">
                      <a href="#updateModal" class="btn btn-table" rel="tooltip" title="Güncelle" data-toggle="modal" data-id="'.$row['PK'].'" data-name="'.$row['UNT_NAME'].'" data-user="Okan Uzun"><i class="mdi mdi-autorenew"></i></a>
                      <a href="#deleteModal" class="btn btn-table" rel="tooltip" title="Sil" data-toggle="modal" data-id="'.$row['PK'].'"><i class="mdi mdi-delete"></i></a>
                      <a href="unit-detail.php?unit_id='.$row['PK'].'" class="btn btn-table" rel="tooltip"><i class="mdi mdi-magnify"></i></a>
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
          <h4 class="modal-title" id="updateModalLabel">Birim Güncelle</h4>
        </div>
        <form method="post">
          <div class="modal-body">
            <div class="form-group">
              <label for="updateName" class="form-control-label">Birim Adı:</label>
              <input type="text" class="form-control" id="updateName" name="unit_name">
              <input type="hidden" name="unit_id" id="unit_id">
            </div>
            <div class="form-group">
              <label for="updateUserSelect" class="form-control-label">Birim Yöneticisi:</label>
              <select id="updateUserSelect" class="form-control selectpicker" data-live-search="true" data-size="5" title="Birim Yöneticisi Seçiniz">
                <option value="Okan Uzun">Okan Uzun</option>
                <option value="Okan Uzun">Okan Uzun</option>
                <option value="Okan Uzun">Okan Uzun</option>
              </select>
              <!--              --><?php
                /*                include "dbsettings.php";
                                $sql  = 'SELECT PK,INITCAP(DEPARTMENT_NAME) AS DEP_NAME FROM T_DEPARTMENT';
                                $stmt = oci_parse($conn, $sql);
                                $r    = oci_execute($stmt);
                                echo '<select id="updateDepartmentSelect" name="dep_id" class="form-control selectpicker" data-live-search="true" data-size="5">';
                                while ($row = oci_fetch_array($stmt, OCI_RETURN_NULLS + OCI_ASSOC))
                                  echo '<option value ="'.$row["PK"].'">'.$row["DEP_NAME"].'</option>';
                                echo '</select>';
                              */ ?>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Kapat</button>
            <button type="submit" class="btn btn-success" name="update-unit">Güncelle</button>
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
            <input type="hidden" name="unit_id" id="unit_id">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Kapat</button>
            <button type="submit" class="btn btn-danger" name="delete-unit">Sil</button>
          </div>
        </form>
      </div>
    </div>
  </div>

<?php include "footer.php"; ?>