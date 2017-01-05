<?php
  include "header.php";
  include "dbsettings.php";

  if (isset($_GET["unit_id"])) {
    $unit_id = $_GET["unit_id"];
    $sql     = '
    SELECT T_USER.PK AS U_PK,INITCAP(T_UNIT.UNIT_NAME) AS UNT_NAME,
    INITCAP(T_USER.FIRST_NAME) AS F_NAME,
    UPPER(T_USER.LAST_NAME) AS L_NAME,
    T_UNIT.CREATION_TIME AS CR_TIME,
    T_UNIT.MODIFIED_TIME AS MD_TIME 
    FROM T_UNIT 
    LEFT JOIN T_USER 
    ON  T_UNIT.MANAGER_ID = T_USER.PK
    WHERE T_UNIT.PK = '.$unit_id.'';

    $stmt = oci_parse($conn, $sql);
    $r    = oci_execute($stmt);
    $row  = oci_fetch_assoc($stmt);

    $unit_name = $row["UNT_NAME"];
    $user_pk = $row["U_PK"];
    $f_name    = $row["F_NAME"];
    $l_name    = $row["L_NAME"];
    $date      = DateTime::createFromFormat("d#M#y H#i#s*A", $row["CR_TIME"]);
    $cr_time   = $date->format('d/m/y H:i:s');

    $date    = DateTime::createFromFormat("d#M#y H#i#s*A", $row["MD_TIME"]);
    $md_time = $date->format('d/m/y H:i:s');
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
              <div class="name"><?php echo $unit_name ?>
                <div class="manager"><strong>Birim Yöneticisi:</strong> <?php  ($user_pk == null ? print ('Henüz Atanmamış') : print($f_name.' '.$l_name)) ?></div>
              </div>
              <div class="date">
                <span><strong>Oluşturulma Tarihi:</strong> <?php echo $cr_time ?></span>
                <span><strong>Düzenleme Tarihi:</strong> <?php echo $md_time ?></span>
              </div>
            </div>
          </div>
          <div class="card-block">
            <div class="row">
              <div class="col-lg-6 col-xl-5">
                <form method="post">
                  <ul class="list-group">
                    <li class="list-group-item">
                      <span class="tag tag-default tag-pill float-xs-right">Rol</span>
                      Birimdeki Kullanıcılar
                    </li>
                    <?php
                      $sql  = '
                      SELECT T_USER.PK,T_USER.FIRST_NAME,T_USER.LAST_NAME,T_ROLE.ROLE_NAME
                      FROM T_USER
                      LEFT JOIN T_ROLE ON T_ROLE.PK = T_USER.ROLE_FK
                      WHERE T_USER.UNIT_FK = '.$unit_id.'
                      ORDER BY T_USER.FIRST_NAME,T_USER.LAST_NAME';
                      $stmt = oci_parse($conn, $sql);
                      $r    = oci_execute($stmt);
                      while ($row = oci_fetch_array($stmt, OCI_RETURN_NULLS + OCI_ASSOC)) {
                        echo '
                          <li class="list-group-item">
                            <span class="tag tag-default tag-pill tag-normal float-xs-right">'.$row["ROLE_NAME"].'</span>
                            <input type="hidden" name="unit_id" id="unit_id" value="'.$row['PK'].'">
                            <a href="user-detail.php?user_id='.$row['PK'].'" rel="tooltip" title="Detay">'.$row["FIRST_NAME"].' '.$row["LAST_NAME"].'</a>
                          </li>';
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