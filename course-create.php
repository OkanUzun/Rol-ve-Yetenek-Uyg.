<?php 
  include "header.php"; 
  include "dbsettings.php";

  if (isset($_POST["create-course"])){
    $sql  = 'BEGIN SP_CREATE_EDUCATION(:edu_subject,:edu_content,:planned_dte,:complete_dte,:edctr_id,:lounge_id,:is_valid); END;';
    $stmt = oci_parse($conn, $sql);

    oci_bind_by_name($stmt, ':edu_subject', $edu_subject);
    oci_bind_by_name($stmt, ':edu_content', $edu_content);
    oci_bind_by_name($stmt, ':planned_dte', $planned_date);
    oci_bind_by_name($stmt, ':complete_dte', $complete_date);
    oci_bind_by_name($stmt, ':edctr_id', $educator_id);
    oci_bind_by_name($stmt, ':lounge_id', $lounge_id);
    oci_bind_by_name($stmt, ':is_valid', $message);

    $edu_subject   = $_POST["course_name"];
    $edu_content = $_POST["course_detail"];
    $planned_date   = $_POST["starting_date"];
    $complete_date = $_POST["complete_date"];
    $educator_id   = $_POST["educator_id"];
    $lounge_id   = $_POST["lounge_id"];

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
          <form method="post">
            <div class="card-header">
              <div class="card-title">Eğitim Tanımlama</div>
              <button type="submit" class="btn btn-success" name="create-course">Kaydet</button>
            </div>
            <div class="card-block">
              <div class="row">
                <div class="col-xs-12">
                  <div class="card-title">Eğitim Bilgileri</div>
                </div>
                <div class="col-lg-6 col-xl-3">
                  <div class="form-group">
                    <input type="text" class="form-control" placeholder="Eğitim Adı" name="course_name">
                  </div>
                </div>
                <div class="col-lg-6 col-xl-3">
                  <div class="form-group">
                  <?php
                    $sql  = 'SELECT T_EDUCATOR.PK,T_EDUCATOR.EDUCATOR_NAME,T_EDUCATOR.IS_INHOUSE,T_ROLE.ROLE_NAME
                    FROM T_EDUCATOR
                    LEFT JOIN T_USER ON T_USER.PK = T_EDUCATOR.USER_FK
                    LEFT JOIN T_ROLE ON T_USER.ROLE_FK = T_ROLE.PK
                    ORDER BY IS_INHOUSE DESC,EDUCATOR_NAME';
                    $stmt = oci_parse($conn, $sql);
                    $r    = oci_execute($stmt);
                    echo '<select name="educator_id" class="form-control selectpicker" data-live-search="true" data-size="5" title="Eğitmen Seçiniz">';
                    while ($row = oci_fetch_array($stmt, OCI_RETURN_NULLS + OCI_ASSOC)) {
                      echo '<option value ="'.$row["PK"].'">'.$row["EDUCATOR_NAME"].' | '.($row["IS_INHOUSE"]==1?"Şirket İçi":"Şirket Dışı").' | '.$row["ROLE_NAME"].'</option>';
                    }
                    echo '</select>';
                  ?>
                  </div>
                </div>
                <div class="col-lg-6 col-xl-2">
                  <div class="form-group">
                  <?php
                    $sql  = 'SELECT PK,LOUNGE_NAME FROM T_LOUNGE ORDER BY LOUNGE_NAME';
                    $stmt = oci_parse($conn, $sql);
                    $r    = oci_execute($stmt);
                    echo '<select name="lounge_id" class="form-control selectpicker" data-live-search="true" data-size="5" title="Salon Seçiniz">';
                    while ($row = oci_fetch_array($stmt, OCI_RETURN_NULLS + OCI_ASSOC)) {
                      echo '<option value ="'.$row["PK"].'">'.$row["LOUNGE_NAME"].'</option>';
                    }
                    echo '</select>';
                  ?>
                  </div>
                </div>
                <div class="col-lg-6 col-xl-2">
                  <div class="form-group">
                    <input type="text" data-provide="datepicker" class="form-control datepicker" placeholder="Başlangıç Tarihi" name="starting_date">
                  </div>
                </div>
                <div class="col-lg-6 col-xl-2">
                  <div class="form-group">
                    <input type="text" data-provide="datepicker" class="form-control datepicker" placeholder="Bitiş Tarihi" name="complete_date">
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <textarea rows="5" class="form-control" placeholder="Eğitim Detayları" name="course_detail"></textarea>
                  </div>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

<?php include "footer.php"; ?>