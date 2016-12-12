<?php 
  include "header.php"; 
  include "dbsettings.php";

  if (isset($_GET["role_id"])) {
    $role_id = $_GET["role_id"];

    $sql  = '
    SELECT INITCAP(T_ROLE.ROLE_NAME) AS RLE_NAME,
    T_ROLE.CREATION_TIME AS CR_TIME,
    T_ROLE.MODIFIED_TIME AS MD_TIME 
    FROM T_ROLE WHERE T_ROLE.PK = '.$role_id.'';
    $stmt = oci_parse($conn, $sql);
    $r = oci_execute($stmt);
    $row = oci_fetch_assoc($stmt);

    $role_name = $row["RLE_NAME"];
    $cr_time = $row["CR_TIME"];
    $md_time = $row["MD_TIME"];
  }
?>

  <div class="wrapper">
    <?php include "sidebar.php"; ?>
    <div class="page-content">
      <?php include "navbar.php"; ?>
      <div class="container-fluid">
        <div class="card">
          <div class="card-header">
            <div class="card-title">
              <div class="name"><?php echo $role_name ?></div>
              <div class="date">
                <span><strong>Oluşturulma Tarihi:</strong> <?php echo $cr_time ?></span>
                <span><strong>Düzenleme Tarihi:</strong> <?php echo $md_time ?></span>
              </div>
            </div>
          </div>
          <div class="card-block">
            <div class="row">
              <div class="col-lg-6 col-xl-4">
                <form method="post">
                  <ul class="list-group">
                    <li class="list-group-item">
                      <span class="tag tag-default float-xs-right">Birim / Departman</span>
                      Kayıtlı Kullanıcılar
                    </li>

                    <?php
                    $sql  = '
                      SELECT T_USER.PK,INITCAP(T_USER.FIRST_NAME) AS F_NAME,UPPER(T_USER.LAST_NAME) AS L_NAME,T_UNIT.UNIT_NAME,T_DEPARTMENT.DEPARTMENT_NAME
                      FROM T_USER
                      LEFT JOIN T_UNIT ON T_UNIT.PK = T_USER.UNIT_FK
                      LEFT JOIN T_DEPARTMENT ON T_DEPARTMENT.PK = T_USER.DEPARTMENT_FK
                      WHERE T_USER.ROLE_FK = '.$role_id.'';
                    $stmt = oci_parse($conn, $sql);
                    $r    = oci_execute($stmt);
                    while ($row = oci_fetch_array($stmt, OCI_RETURN_NULLS + OCI_ASSOC)) {
                      $format = ""; 
                      echo '
                      <li class="list-group-item">
                        <span class="tag tag-default tag-pill float-xs-right">'.$row["UNIT_NAME"].' / '.$row["DEPARTMENT_NAME"].'</span>
                        <a href="user-detail.php?user_id='.$row['PK'].'" rel="tooltip">'.$row["F_NAME"].' '.$row["L_NAME"].'</a>
                      </li>
                        ';
                    }
                  ?>
                  </ul>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

<?php include "footer.php"; ?>