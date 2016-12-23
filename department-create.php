<?php

  include "header.php";
  include "dbsettings.php";

  if (isset($_POST["create-dep"])) {
    $sql  = 'BEGIN SP_CREATE_DEPARTMENT(:dep_name,:mngr_id,:is_valid); END;';
    $stmt = oci_parse($conn, $sql);

    oci_bind_by_name($stmt, ':dep_name', $dep_name);
    oci_bind_by_name($stmt, ':mngr_id', $manager_id);
    oci_bind_by_name($stmt, ':is_valid', $message);

    $dep_name   = $_POST["dep_name"];
    $manager_id = $_POST["manager_id"];

    oci_execute($stmt);
    //echo "$message\n";
  }
  else if (isset($_POST["update-dep"])) {
    $sql  = 'BEGIN SP_UPDATE_DEPARTMENT(:dep_id,:dep_name,:mngr_id,:is_valid); END;';
    $stmt = oci_parse($conn, $sql);

    oci_bind_by_name($stmt, ':dep_id', $dep_id);
    oci_bind_by_name($stmt, ':dep_name', $dep_name);
    oci_bind_by_name($stmt, ':mngr_id', $manager_id);
    oci_bind_by_name($stmt, ':is_valid', $message);

    $dep_name   = $_POST["dep_name"];
    $manager_id = $_POST["manager_id"];
    $dep_id     = $_POST["dep_id"];

    oci_execute($stmt);

    //echo "$message\n";
  }
  else if (isset($_POST["delete-dep"])) {
    $sql  = 'BEGIN SP_REMOVE_DEPARTMENT(:dep_id,:is_valid); END;';
    $stmt = oci_parse($conn, $sql);

    oci_bind_by_name($stmt, ':dep_id', $dep_id);
    oci_bind_by_name($stmt, ':is_valid', $message);

    $dep_id = $_POST["dep_id"];

    oci_execute($stmt);
  }

?>
<div class="wrapper">
  <?php include "sidebar.php"; ?>
  <div class="page-content">
    <?php include "navbar.php"; ?>
    <div class="container-fluid">
      <div class="card">
        <div class="card-header">
          <a href="javascript:void(0);" class="btn btn-info create"><i class="mdi mdi-library"></i>Departman Oluştur</a>
          <form id="formValidate" class="form-create form-inline hidden" method="post">
            <div class="form-group">
              <input type="text" class="form-control" placeholder="Departman Adı Giriniz" name="dep_name">
            </div>
            <div class="form-group">
              <?php
                include "dbsettings.php";
                $sql  = 'SELECT USR.PK,USR.FIRST_NAME,USR.LAST_NAME
                  FROM T_USER USR';
                $stmt = oci_parse($conn, $sql);
                $r    = oci_execute($stmt);
                echo '<select name="manager_id" class="form-control selectpicker" data-live-search="true" data-size="5" data-width="auto" title="Departman Müdürü Seçiniz">';
                while ($row = oci_fetch_array($stmt, OCI_RETURN_NULLS + OCI_ASSOC)) {
                  echo '<option value ="'.$row["PK"].'">'.$row["FIRST_NAME"].' '.$row["LAST_NAME"].'</option>';
                }
                echo '</select>';
              ?>
            </div>
            <button type="submit" class="btn btn-success" name="create-dep">Kaydet</button>
            <button type="button" class="btn btn-danger">İptal</button>
          </form>
        </div>
        <div class="card-block">
          <form method="post">
            <table class="table" id="dataTable-department">
              <thead>
              <tr>
                <th>Departman Adı</th>
                <th>Çalışan Sayısı</th>
                <th>İşlemler</th>
              </tr>
              </thead>
              <tbody>
              <?php
                include "dbsettings.php";
                $sql  = 'SELECT T_DEPARTMENT.PK, INITCAP(T_DEPARTMENT.DEPARTMENT_NAME) AS DEP_NAME,COUNT(T_USER.PK) AS X
                FROM T_DEPARTMENT
                LEFT JOIN T_USER ON T_USER.DEPARTMENT_FK = T_DEPARTMENT.PK
                GROUP BY T_DEPARTMENT.PK,T_DEPARTMENT.DEPARTMENT_NAME';
                $stmt = oci_parse($conn, $sql);
                $r    = oci_execute($stmt);
                while ($row = oci_fetch_array($stmt, OCI_RETURN_NULLS + OCI_ASSOC)) {
                  echo '<tr>';
                  echo '<td>'.$row['DEP_NAME'].'</td>';
                  echo '<td>'.$row['X'].'</td>';
                  echo '
                     <td class="text-xs-center">
                      <a href="#updateModal" class="btn btn-table" rel="tooltip" title="Güncelle" data-toggle="modal" data-id="'.$row['PK'].'" data-name="'.$row['DEP_NAME'].'" data-user="Okan UZUN"><i class="mdi mdi-autorenew"></i></a>
                      <a href="#deleteModal" class="btn btn-table" rel="tooltip" title="Sil" data-toggle="modal" data-id="'.$row['PK'].'"><i class="mdi mdi-delete"></i></a>
                      <a href="department-detail.php?dep_id='.$row['PK'].'" class="btn btn-table" rel="tooltip"><i class="mdi mdi-magnify"></i></a>
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
        <h4 class="modal-title" id="updateModalLabel">Departman Güncelle</h4>
      </div>
      <form method="post">
        <div class="modal-body">
          <div class="form-group">
            <input type="hidden" name="dep_id" id="dep_id">
            <label for="updateName" class="form-control-label">Departman Adı:</label>
            <input type="text" class="form-control" id="updateName" name="dep_name">
          </div>
          <div class="form-group">
            <label for="updateUserSelect" class="form-control-label">Departman Müdürü:</label>
            <?php
              include "dbsettings.php";
              $sql  = 'SELECT PK,INITCAP(FIRST_NAME) AS F_NAME,UPPER(LAST_NAME) AS L_NAME
                    FROM T_USER';
              $stmt = oci_parse($conn, $sql);
              $r    = oci_execute($stmt);
              echo '<select id="updateUserSelect" name="manager_id" class="form-control selectpicker" data-live-search="true" data-size="5" title="Departman Müdürü Seçiniz">';
              while ($row = oci_fetch_array($stmt, OCI_RETURN_NULLS + OCI_ASSOC)) {
                echo '<option value ="'.$row["PK"].'">'.$row["F_NAME"].' '.$row["L_NAME"].'</option>';
              }
              echo '</select>';
            ?>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Kapat</button>
          <button type="submit" class="btn btn-success" name="update-dep">Güncelle</button>
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
          <input type="hidden" name="dep_id" id="dep_id">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Kapat</button>
          <button type="submit" class="btn btn-danger" name="delete-dep">Sil</button>
        </div>
      </form>
    </div>
  </div>
</div>


<?php include "footer.php"; ?>
