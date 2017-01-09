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
                    <form method="post">
                      <?php
                        $sql  = 'SELECT PK,INITCAP(DEPARTMENT_NAME) AS DEP_NAME FROM T_DEPARTMENT ORDER BY DEPARTMENT_NAME';
                        $stmt = oci_parse($conn, $sql);
                        $r    = oci_execute($stmt);
                        echo '<select name="dep_id" class="form-control selectpicker selectone" data-live-search="true" data-size="5" title="Departman Seçiniz" onchange="this.form.submit()">';
                        while ($row = oci_fetch_array($stmt, OCI_RETURN_NULLS + OCI_ASSOC)) {
                          echo '<option value ="'.$row["PK"].'" '.($row["PK"] == $_POST["dep_id"] ? 'selected="selected"' : "").'>'.$row["DEP_NAME"].'</option>';
                        }

                        echo '</select>';
                        if (isset($_POST["role_id"])) {
                          echo '<input type="hidden" name="role_id" value="'.$_POST["role_id"].'"/>';
                        }
                        if (isset($_POST["unit_id"])) {
                          echo '<input type="hidden" name="unit_id" value="'.$_POST["unit_id"].'"/>';
                        }
                        if (isset($_POST["ability_id"])) {
                          foreach ($_POST["ability_id"] as $ability_id) {
                            echo '<input type="hidden" name="ability_id[]" value="'.$ability_id.'">';
                          }
                        }
                      ?>
                    </form>
                  </div>
                </div>
                <div class="col-md-6 col-lg-3">
                  <div class="form-group">
                    <form method="post">
                      <?php
                        $sql = 'SELECT PK,INITCAP(UNIT_NAME) AS UNT_NAME FROM T_UNIT';
                        if (isset($_POST["dep_id"])) {
                          $sql .= " WHERE DEPARTMENT_FK = '{$_POST["dep_id"]}'";
                        }
                        $sql .= " ORDER BY T_UNIT.UNIT_NAME";
                        $stmt = oci_parse($conn, $sql);
                        $r    = oci_execute($stmt);
                        echo '<select name="unit_id" class="form-control selectpicker selectone" data-live-search="true" data-size="5" title="Birim Seçiniz" onchange="this.form.submit()">';
                        while ($row = oci_fetch_array($stmt, OCI_RETURN_NULLS + OCI_ASSOC)) {
                          echo '<option value ="'.$row["PK"].'" '.($row["PK"] == $_POST["unit_id"] ? 'selected="selected"' : "").'>'.$row["UNT_NAME"].'</option>';
                        }
                        echo '</select>';
                        if (isset($_POST["dep_id"])) {
                          echo '<input type="hidden" name="dep_id" value="'.$_POST["dep_id"].'"/>';
                        }
                        if (isset($_POST["role_id"])) {
                          echo '<input type="hidden" name="role_id" value="'.$_POST["role_id"].'"/>';
                        }
                        if (isset($_POST["ability_id"])) {
                          foreach ($_POST["ability_id"] as $ability_id) {
                            echo '<input type="hidden" name="ability_id[]" value="'.$ability_id.'">';
                          }
                        }

                      ?>
                    </form>
                  </div>
                </div>
                <div class="col-md-6 col-lg-3">
                  <div class="form-group">
                    <form method="post">
                      <?php
                        $sql  = 'SELECT PK,INITCAP(ROLE_NAME) AS RLE_NAME FROM T_ROLE ORDER BY ROLE_NAME';
                        $stmt = oci_parse($conn, $sql);
                        $r    = oci_execute($stmt);
                        echo '<select name="role_id" class="form-control selectpicker" data-live-search="true" data-size="5" title="Rol Seçiniz" onchange="this.form.submit()"">';
                        while ($row = oci_fetch_array($stmt, OCI_RETURN_NULLS + OCI_ASSOC)) {
                          echo '<option value ="'.$row["PK"].'" '.($row["PK"] == $_POST["role_id"] ? 'selected="selected"' : "").'>'.$row["RLE_NAME"].'</option>';
                        }
                        echo '</select>';
                        if (isset($_POST["dep_id"])) {
                          echo '<input type="hidden" name="dep_id" value="'.$_POST["dep_id"].'"/>';
                        }
                        if (isset($_POST["unit_id"])) {
                          echo '<input type="hidden" name="unit_id" value="'.$_POST["unit_id"].'"/>';
                        }
                        if (isset($_POST["ability_id"])) {
                          foreach ($_POST["ability_id"] as $ability_id) {
                            echo '<input type="hidden" name="ability_id[]" value="'.$ability_id.'">';
                          }
                        }
                      ?>
                    </form>
                  </div>
                </div>
                <div class="col-md-6 col-lg-3">
                  <div class="form-group">
                    <form method="post">
                      <?php
                        $sql  = 'SELECT PK,INITCAP(ABILITY_NAME) AS ABLYT_NAME FROM T_ABILITY ORDER BY ABILITY_NAME';
                        $stmt = oci_parse($conn, $sql);
                        $r    = oci_execute($stmt);
                        echo '<select name="ability_id[]" class="form-control selectpicker" data-actions-box="true" data-live-search="true" data-size="5" title="Yetenekleri Seçiniz" multiple onchange="this.form.submit()">';
                        while ($row = oci_fetch_array($stmt, OCI_RETURN_NULLS + OCI_ASSOC)) {
                          echo '<option value ="'.$row["PK"].'" '.(in_array($row["PK"], $_POST["ability_id"]) ? 'selected="selected"' : "").'>'.$row["ABLYT_NAME"].'</option>';
                        }
                        echo '</select>';

                        if (isset($_POST["dep_id"])) {
                          echo '<input type="hidden" name="dep_id" value="'.$_POST["dep_id"].'"/>';
                        }
                        if (isset($_POST["unit_id"])) {
                          echo '<input type="hidden" name="unit_id" value="'.$_POST["unit_id"].'"/>';
                        }
                        if (isset($_POST["role_id"])) {
                          echo '<input type="hidden" name="role_id" value="'.$_POST["role_id"].'"/>';
                        }
                      ?>
                    </form>
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
                  $sql   = 'SELECT T_USER.PK,INITCAP(T_USER.FIRST_NAME) AS F_NAME,UPPER(T_USER.LAST_NAME) AS L_NAME 
                  FROM T_USER';
                  $where = array();
                  if (isset($_POST["ability_id"])) {
                    $inner_join = ' INNER JOIN T_USER_ABILITY_REL ON T_USER.PK = T_USER_ABILITY_REL.USER_FK AND T_USER_ABILITY_REL.ABILITY_FK IN ('.implode(', ', $_POST["ability_id"]).')';

                    $sql .= $inner_join;
                  }

                  if (isset($_POST["dep_id"])) {
                    $where[] = "T_USER.DEPARTMENT_FK = '{$_POST["dep_id"]}'";
                  }
                  if (isset($_POST["unit_id"])) {
                    $where[] = "T_USER.UNIT_FK = '{$_POST["unit_id"]}'";
                  }
                  if (isset($_POST["role_id"])) {
                    $where[] = "T_USER.ROLE_FK = '{$_POST["role_id"]}'";
                  }
                  if (isset($_POST["ability_id"])) {
                    //$sql = $sql.''';
                  }

                  if (!empty($where)) {
                    $sql .= ' WHERE '.implode(' AND ', $where);
                  }

                  if (isset($_POST["ability_id"])) {
                    $group_by = ' GROUP BY T_USER.PK,T_USER.FIRST_NAME,T_USER.LAST_NAME
                    HAVING COUNT(*) = '.sizeof($_POST["ability_id"]).'';
                    $sql .= $group_by;
                  }
                  $sql .= " ORDER BY T_USER.FIRST_NAME,T_USER.LAST_NAME";
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