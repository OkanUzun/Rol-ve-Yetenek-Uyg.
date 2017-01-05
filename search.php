<?php
  include 'header.php';
  include "dbsettings.php";
?>

  <div class="wrapper">
    <?php include "sidebar.php"; ?>
    <div class="page-content">
      <?php include "navbar.php"; ?>
      <div class="container-fluid">
        <div class="card mb-0">
          <div class="card-header">
            <div class="filter">
              <div class="filter-header">Filtreleme için seçim yapınız</div>
              <div class="row">
                <div class="col-md-6 col-lg-3">
                  <div class="form-group">
                    <?php
                      $sql  = 'SELECT * FROM V_DEPARTMENTS';
                      $stmt = oci_parse($conn, $sql);
                      $r    = oci_execute($stmt);
                      echo '<select name="dep_id" class="form-control selectpicker selectone" data-live-search="true" data-size="5" title="Departman Seçiniz">';
                      echo '<option value="Seçiniz">Seçiniz</option>';
                      while ($row = oci_fetch_array($stmt, OCI_RETURN_NULLS + OCI_ASSOC)) {
                        echo '<option value ="'.$row["PK"].'" '.($row["PK"] == $dep_id ? 'selected="selected"' : "").'>'.$row["DEP_NAME"].'</option>';
                      }
                      echo '</select>';
                    ?>
                  </div>
                </div>
                <div class="col-md-6 col-lg-3">
                  <div class="form-group">
                    <?php
                      $sql  = 'SELECT * FROM V_UNITS';
                      $stmt = oci_parse($conn, $sql);
                      $r    = oci_execute($stmt);
                      echo '<select name="unit_id" class="form-control selectpicker selectone" data-live-search="true" data-size="5" title="Birim Seçiniz">';
                      echo '<option value="Seçiniz">Seçiniz</option>';
                      while ($row = oci_fetch_array($stmt, OCI_RETURN_NULLS + OCI_ASSOC)) {
                        echo '<option value ="'.$row["PK"].'" '.($row["PK"] == $unit_id ? 'selected="selected"' : "").'>'.$row["UNT_NAME"].'</option>';
                      }
                      echo '</select>';
                    ?>
                  </div>
                </div>
                <div class="col-md-6 col-lg-3">
                  <div class="form-group">
                    <?php
                      $sql  = 'SELECT * FROM V_ROLES';
                      $stmt = oci_parse($conn, $sql);
                      $r    = oci_execute($stmt);
                      echo '<select name="role_id" class="form-control selectpicker" data-live-search="true" data-size="5" title="Rol Seçiniz">';
                      while ($row = oci_fetch_array($stmt, OCI_RETURN_NULLS + OCI_ASSOC)) {
                        echo '<option value ="'.$row["PK"].'" '.($row["PK"] == $role_id ? 'selected="selected"' : "").'>'.$row["RLE_NAME"].'</option>';
                      }
                      echo '</select>';
                    ?>
                  </div>
                </div>
                <div class="col-md-6 col-lg-3">
                  <div class="form-group">
                    <select class="form-control selectpicker" data-live-search="true" data-size="5" title="Yetenek Seçiniz" multiple>
                      <option value="PHP">PHP</option>
                      <option value="Java">Java</option>
                      <option value="Android">Android</option>
                    </select>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="card-block">
            <form method="post">
              <table class="table" id="dataTable-user">
                <thead>
                <tr>
                  <th>Adı</th>
                  <th>Soyadı</th>
                  <th>Detay</th>
                </tr>
                </thead>
                <tbody>
                <?php
                  $sql  = 'SELECT * FROM V_USERS';
                  $stmt = oci_parse($conn, $sql);
                  $r    = oci_execute($stmt);
                  while ($row = oci_fetch_array($stmt, OCI_RETURN_NULLS + OCI_ASSOC)) {
                    echo '<tr>';
                    echo '<td>'.$row['F_NAME'].'</td>';
                    echo '<td>'.$row['L_NAME'].'</td>';
                    echo '
                     <td class="text-xs-center">
                      <a href="user-detail.php?user_id='.$row['PK'].'" class="btn btn-table" rel="tooltip"><i class="mdi mdi-magnify"></i></a>
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

<?php include 'footer.php' ?>