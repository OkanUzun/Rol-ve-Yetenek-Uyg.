<?php 
  include "header.php"; 
  include "dbsettings.php";

  if (isset($_GET["dep_id"])){
    $dep_id = $_GET["dep_id"];

    $sql  = '
    SELECT INITCAP(T_DEPARTMENT.DEPARTMENT_NAME) AS DEP_NAME,
    INITCAP(T_USER.FIRST_NAME) AS F_NAME,
    UPPER(T_USER.LAST_NAME) AS L_NAME,
    T_DEPARTMENT.CREATION_TIME AS CR_TIME,
    T_DEPARTMENT.MODIFIED_TIME AS MD_TIME 
    FROM T_DEPARTMENT 
    LEFT JOIN T_USER 
    ON  T_DEPARTMENT.MANAGER_ID = T_USER.PK
    WHERE T_DEPARTMENT.PK = '.$dep_id.'';
    $stmt = oci_parse($conn, $sql);
    $r = oci_execute($stmt);
    $row = oci_fetch_assoc($stmt);

    $dep_name = $row["DEP_NAME"];
    $f_name = $row["F_NAME"];   
    $l_name = $row["L_NAME"]; 
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
              <div class="name"><?php echo $dep_name?><div class="manager"><strong>Departman Müdürü:</strong> <?php echo $f_name.' '.$l_name?></div></div>
              <div class="date">
                <span><strong>Oluşturulma Tarihi:</strong> <?php echo $cr_time?></span>
                <span><strong>Düzenleme Tarihi:</strong> <?php echo $md_time?></span>
              </div>
            </div>
          </div>
          <div class="card-block">
            <div class="row">
              <div class="col-lg-6 col-xl-4">
                <form method="post" action="unit-detail.php">
                  <ul class="list-group">
                    <li class="list-group-item">
                      <span class="tag tag-default float-xs-right">Çalışan Sayısı</span>
                      Kayıtlı Birimler
                    </li>
                    <?php 
                      $sql  = '
                      SELECT T_UNIT.PK,INITCAP(T_UNIT.UNIT_NAME) AS UNT_NAME,COUNT(T_USER.PK) AS X FROM T_UNIT
                      INNER JOIN T_ROLE ON T_UNIT.PK = T_ROLE.UNIT_FK
                      LEFT JOIN T_USER ON T_USER.ROLE_FK = T_ROLE.PK
                      WHERE T_UNIT.DEPARTMENT_FK = '.$dep_id.'
                      GROUP BY T_UNIT.PK,T_UNIT.UNIT_NAME';
                      $stmt = oci_parse($conn, $sql);
                      $r    = oci_execute($stmt);
                      while ($row = oci_fetch_array($stmt, OCI_RETURN_NULLS + OCI_ASSOC)) {
                        echo '
                          <li class="list-group-item">
                            <span class="tag tag-default tag-pill float-xs-right">'.$row["X"].'</span>
                            <input type="hidden" name="unit_id" id="unit_id" value="'.$row['PK'].'">
                            <a href="unit-detail.php?unit_id='.$row['PK'].'" rel="tooltip" title="Detay">'.$row["UNT_NAME"].'</a>
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
