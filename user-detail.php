<?php
  include "header.php";
  include "dbsettings.php";

  if (isset($_GET["user_id"])) {
    $user_id = $_GET["user_id"];
    $sql     = '
    SELECT T_USER.FIRST_NAME,T_USER.LAST_NAME,T_USER.U_ID,T_USER.DATE_OF_BIRTH,T_USER.EMAIL,T_USER.PHONE_NUMBER,T_USER.ADDRESS
    FROM T_USER
    WHERE PK = '.$user_id.'';
    $stmt    = oci_parse($conn, $sql);
    $r       = oci_execute($stmt);
    $row     = oci_fetch_assoc($stmt);

    $f_name = $row["FIRST_NAME"];
    $l_name = $row["LAST_NAME"];
    $u_id   = $row["U_ID"];

    $date          = DateTime::createFromFormat("d#M#y", $row["DATE_OF_BIRTH"]);
    $date_of_birth = $date->format('d/m/Y');

    $email   = $row["EMAIL"];
    $address = $row["ADDRESS"];
    $phone   = $row["PHONE_NUMBER"];
    //$cr_time = $row["CREATION_TIME"];
    //$md_time = $row["MODIFIED_TIME"];
  }

  else if (isset($_POST["update-user"])) {
    //
  }

  else if (isset($_POST['update-abilities'])) {

    echo "ahmet";
    $user_id = $_GET["user_id"];
    $sql     = 'BEGIN SP_ASSIGN_ABILITIES_TO_USER(:usr_id,:ablty_ids,:level_ids,:is_valid); END;';
    $stmt    = oci_parse($conn, $sql);


    oci_bind_by_name($stmt, ':usr_id', $user_id);
    oci_bind_by_name($stmt, ':ablty_ids', $ability_ids);
    oci_bind_by_name($stmt, ':level_ids', $level_ids);
    oci_bind_by_name($stmt, ':is_valid', $message);

    $contents = $_POST['contents'];

    $ability_ids = array();
    $level_ids   = array();

    for ($i = 0; $i < sizeof($contents); $i++) {
      array_push($ability_ids, $contents[ $i ][0]);
      array_push($level_ids, $contents[ $i ][1]);
    }

    oci_execute($stmt);
    echo "$message\n";
  }
?>

  <div class="wrapper">
    <?php include "sidebar.php"; ?>
    <div class="page-content">
      <?php include "navbar.php"; ?>
      <div class="container-fluid">
        <div class="card">
          <div class="card-header">
            <div class="card-title">Kullanıcı Detay</div>
          </div>
          <div class="card-block">
            <ul class="nav nav-tabs">
              <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#info">Bilgiler</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#skill">Yetenekler</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#course">Eğitimler</a>
              </li>
            </ul>

            <div class="tab-content">
              <div class="tab-pane fade in active" id="info">
                <form method="post">
                  <div class="row">
                    <div class="col-xs-12">
                      <div class="card-title">Kullanıcı Bilgileri
                        <button type="submit" class="btn btn-success" name="update-user">Kaydet</button>
                      </div>
                    </div>
                    <div class="col-xs-12 col-md-12 col-lg-6 mb-1">
                      <div class="row">
                        <div class="col-xs-12 col-xl-6">
                          <div class="form-group">
                            <?php
                              $sql  = 'SELECT PK,DEPARTMENT_NAME FROM T_DEPARTMENT ORDER BY DEPARTMENT_NAME';
                              $stmt = oci_parse($conn, $sql);
                              $r    = oci_execute($stmt);
                              echo '<select id="userDepartment" name="dep_id" class="form-control selectpicker" data-live-search="true" data-size="5" title="Departman Seçiniz">';
                              echo '<option value="Seçiniz">Seçiniz</option>';
                              while ($row = oci_fetch_array($stmt, OCI_RETURN_NULLS + OCI_ASSOC)) {
                                echo '<option value ="'.$row["PK"].'">'.$row["DEPARTMENT_NAME"].'</option>';
                              }
                              echo '</select>';
                            ?>
                          </div>
                        </div>
                        <div class="col-xs-12 col-xl-6">
                          <div class="form-group">
                            <?php
                              $sql  = 'SELECT PK,UNIT_NAME FROM T_UNIT ORDER BY UNIT_NAME';
                              $stmt = oci_parse($conn, $sql);
                              $r    = oci_execute($stmt);
                              echo '<select id="userUnit" name="unit_id" class="form-control selectpicker" data-live-search="true" data-size="5" title="Birim Seçiniz">';
                              echo '<option value="Seçiniz">Seçiniz</option>';
                              while ($row = oci_fetch_array($stmt, OCI_RETURN_NULLS + OCI_ASSOC)) {
                                echo '<option value ="'.$row["PK"].'">'.$row["UNIT_NAME"].'</option>';
                              }
                              echo '</select>';
                            ?>
                          </div>
                        </div>
                        <div class="col-xs-12 col-xl-6">
                          <div class="form-group">
                            <?php
                              $sql  = 'SELECT PK,ROLE_NAME FROM T_ROLE ORDER BY ROLE_NAME';
                              $stmt = oci_parse($conn, $sql);
                              $r    = oci_execute($stmt);
                              echo '<select name="role_id" class="form-control selectpicker" data-live-search="true" data-size="5" title="Rol Seçiniz">';
                              while ($row = oci_fetch_array($stmt, OCI_RETURN_NULLS + OCI_ASSOC)) {
                                echo '<option value ="'.$row["PK"].'">'.$row["ROLE_NAME"].'</option>';
                              }
                              echo '</select>';
                            ?>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-xs-12 col-md-12 col-lg-6 mb-1">
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                            <input type="text" class="form-control" value=<?php echo $f_name ?> placeholder="İsim" required>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <input type="text" class="form-control" value=<?php echo $l_name ?> placeholder="Soyisim" required>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <input type="text" class="form-control" value=<?php echo $u_id ?> placeholder="Kullanıcı Adı" required>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <input type="text" data-provide="datepicker" class="form-control datepicker" value=<?php echo $date_of_birth ?> placeholder="Doğum Tarihi" required>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-xs-12 col-md-12 col-lg-6 mb-1">
                      <div class="row">
                        <div class="col-sm-12 col-md-6">
                          <div class="form-group">
                            <input type="email" class="form-control" placeholder="E-mail" value=<?php echo $email ?> name="stepEmail" id="stepEmail" required>
                          </div>
                        </div>
                        <div class="col-sm-12 col-md-6">
                          <div class="form-group">
                            <input type="number" class="form-control" placeholder="Mobil Telefon No" value=<?php echo $phone ?> name="stepTel" id="stepTel" required>
                          </div>
                        </div>
                        <div class="col-md-12">
                          <div class="form-group">
                            <textarea rows="5" class="form-control" placeholder="Adres..." name="stepAddress" id="stepAddress"><?php echo $address ?></textarea>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
              <div class="tab-pane fade" id="skill">
                <form method="post">
                  <div class="row">
                    <div class="col-xs-12">
                      <div class="card-title">Yetenekler
                        <button type="submit" name="update-abilities" class="btn btn-success" disabled>Kaydet</button>
                      </div>
                    </div>
                    <div class="col-xs-12 col-xl-6">
                      <div class="table-responsive">
                        <table class="table table-specific">
                          <thead>
                          <tr>
                            <th>Kayıtlı Yetenekler</th>
                            <th>Seviye</th>
                          </tr>
                          </thead>
                          <tbody>
                          <?php
                            $sql  = 'SELECT T_ABILITY.PK AS AB_PK,T_ABILITY.ABILITY_NAME AS AN,T_ABILITY_LEVEL.PK AS LE_PK,T_ABILITY_LEVEL.LEVEL_NAME AS LN
                            FROM T_USER_ABILITY_REL,T_ABILITY,T_ABILITY_LEVEL WHERE
                            T_USER_ABILITY_REL.ABILITY_FK = T_ABILITY.PK AND
                            T_USER_ABILITY_REL.ABILITY_LEVEL_FK = T_ABILITY_LEVEL.PK AND
                            T_USER_ABILITY_REL.USER_FK = '.$user_id.'
                            ORDER BY AN';
                            $stmt = oci_parse($conn, $sql);
                            $r    = oci_execute($stmt);
                            $i    = 0;
                            while ($row = oci_fetch_array($stmt, OCI_RETURN_NULLS + OCI_ASSOC)) {
                              echo '<tr>';
                              echo '<input type="hidden" value="'.$row["AB_PK"].'" name="contents['.$i.'][0]"/>';
                              echo '<input type="hidden" value="'.$row["LE_PK"].'" name="contents['.$i.'][1]"/>';
                              echo '<td>'.$row['AN'].'</td>';
                              echo '<td>'.$row['LN'].'<a href="javascript:void(0)" onclick="changeSide()" class="btn btn-danger float-xs-right">Sil</a></td>';
                              echo '</tr>';
                            }
                          ?>
                          </tbody>
                        </table>
                      </div>
                    </div>
                    <div class="col-xs-12 col-xl-6">
                      <div class="table-responsive">
                        <table class="table table-all">
                          <thead>
                          <tr>
                            <th>Tüm Yetenekler</th>
                            <th>Seviye</th>
                          </tr>
                          </thead>
                          <tbody>
                          <tr>
                            <td>
                              <select class="form-control selectpicker" data-container="body" data-live-search="true" data-size="5">
                                <option value="Java">Java</option>
                                <option value="Php">Php</option>
                                <option value="Ajax">Ajax</option>
                                <option value="Android">Android</option>
                                <option value="Android">Android</option>
                                <option value="Android">Android</option>
                                <option value="Android">Android</option>
                                <option value="Android">Android</option>
                                <option value="Android">Android</option>
                                <option value="Android">Android</option>
                                <option value="Android">Android</option>
                                <option value="Android">Android</option>
                                <option value="Android">Android</option>
                              </select>
                            </td>
                            <td class="select-level">
                              <select class="form-control selectpicker" data-container="body">
                                <option value="Çok Kötü">Çok Kötü</option>
                                <option value="Kötü">Kötü</option>
                                <option value="Orta">Orta</option>
                                <option value="İyi">İyi</option>
                                <option value="Çok İyi">Çok İyi</option>
                              </select>
                              <a href="javascript:void(0)" onclick="changeSide()" class="btn btn-success">Ekle</a>
                            </td>
                          </tr>
                          <?php
                            /*$sql1  = 'SELECT T_ABILITY.PK,T_ABILITY.ABILITY_NAME FROM T_ABILITY WHERE T_ABILITY.PK
                            NOT IN (SELECT T_USER_ABILITY_REL.ABILITY_FK FROM T_USER_ABILITY_REL WHERE T_USER_ABILITY_REL.USER_FK = '.$user_id.')
                            ORDER BY ABILITY_NAME';
                            $stmt1 = oci_parse($conn, $sql1);
                            $r1    = oci_execute($stmt1);
                            while ($row1 = oci_fetch_array($stmt1, OCI_RETURN_NULLS + OCI_ASSOC)) {
                              echo '<tr>';
                              echo '<td>'.$row1["ABILITY_NAME"].'</td>';
                              echo '<td class="select-level">';
                              $sql2  = 'SELECT PK,LEVEL_NAME FROM T_ABILITY_LEVEL ORDER BY LEVEL_ORDER';
                              $stmt2 = oci_parse($conn, $sql2);
                              $r2    = oci_execute($stmt2);
                              echo '<select name="level_id" class="form-control selectpicker" data-container="body">';
                              while ($row2 = oci_fetch_array($stmt2, OCI_RETURN_NULLS + OCI_ASSOC)) {
                                echo '<option value ="'.$row2["PK"].'">'.$row2["LEVEL_NAME"].'</option>';
                              }
                              echo '</select>';
                              echo '<a href="javascript:void(0)" onclick="changeSide()" class="btn btn-success">Ekle</a>';
                              echo '</td>';

                              echo '</tr>';
                            }*/
                          ?>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
              <div class="tab-pane fade" id="course">
                <div class="table-responsive">
                  <table class="table">
                    <thead>
                    <tr>
                      <th>Eğitim Adı</th>
                      <th>Eğitmen</th>
                      <th>Başlangıç Tarihi</th>
                      <th>Bitiş Tarihi</th>
                      <th>Durum</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                      include "dbsettings.php";
                      $sql  = 'SELECT T_EDUCATION.PK,T_EDUCATION.EDUCATION_SUBJECT AS SUBJECT,T_EDUCATOR.EDUCATOR_NAME AS EDCTR_NAME,T_EDUCATION.PLANNED_DATE AS PLND_DTE,T_EDUCATION.COMPLETE_DATE AS CMPLT_DTE,INITCAP(T_EDUCATION.CURRENT_STATE) AS CRR_STT
                    FROM T_EDUCATION_USER_REL,T_USER,T_EDUCATION
                    LEFT JOIN T_EDUCATOR ON T_EDUCATION.EDUCATOR_FK = T_EDUCATOR.PK
                    WHERE T_EDUCATION.PK = T_EDUCATION_USER_REL.EDUCATION_FK AND T_EDUCATION_USER_REL.USER_FK = '.$user_id.'';
                      $stmt = oci_parse($conn, $sql);
                      $r    = oci_execute($stmt);
                      while ($row = oci_fetch_array($stmt, OCI_RETURN_NULLS + OCI_ASSOC)) {
                        $date          = DateTime::createFromFormat("d#M#y", $row["PLND_DTE"]);
                        $started_date  = $date->format('d/m/Y');
                        $date          = DateTime::createFromFormat("d#M#y", $row["CMPLT_DTE"]);
                        $complete_date = $date->format('d/m/Y');
                        echo '<tr>';
                        echo '<td>'.$row['SUBJECT'].'</td>';
                        echo '<td>'.$row['EDCTR_NAME'].'</td>';
                        echo '<td>'.$started_date.'</td>';
                        echo '<td>'.$complete_date.'</td>';
                        echo '<td>'.$row['CRR_STT'].'</td>';
                        echo '
                          <td class="text-xs-center">
                            <a href="course-detail.php?course_id='.$row['PK'].'" class="btn btn-table" rel="tooltip"><i class="mdi mdi-magnify"></i></a>
                          </td>';
                        echo '</tr>';
                      }
                    ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

<?php include "footer.php"; ?>