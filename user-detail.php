<?php
  include "header.php";
  include "dbsettings.php";

  $user_id = $_GET["user_id"];

  if (isset($_POST["update-user"])) {
    $sql  = 'BEGIN SP_UPDATE_USER(:usr_id,:e_mail,:fname,:lname,:dte_of_birth,:phne_num,:addrss,:is_valid,:rle_id,:unt_id,:dep_id,:u_name); END;';
    $stmt = oci_parse($conn, $sql);

    oci_bind_by_name($stmt, ':usr_id', $user_id);
    oci_bind_by_name($stmt, ':e_mail', $_POST["e_mail"]);
    oci_bind_by_name($stmt, ':fname', $_POST["f_name"]);
    oci_bind_by_name($stmt, ':lname', $_POST["l_name"]);
    oci_bind_by_name($stmt, ':dte_of_birth', $_POST["date_of_birth"]);
    oci_bind_by_name($stmt, ':phne_num', $_POST["phone_number"]);
    oci_bind_by_name($stmt, ':addrss', $_POST["address"]);
    oci_bind_by_name($stmt, ':is_valid', $message);
    oci_bind_by_name($stmt, ':rle_id', $_POST["role_id"]);
    oci_bind_by_name($stmt, ':unt_id', $_POST["unit_id"]);
    oci_bind_by_name($stmt, ':dep_id', $_POST["dep_id"]);
    oci_bind_by_name($stmt, ':u_name', $_POST["u_name"]);
    

    if (isset($_POST["role_id"])) {
      $role_id = $_POST["role_id"];
    }
    if (isset($_POST["unit_id"])) {
      $unit_id = $_POST["unit_id"];
    }
    if (isset($_POST["dep_id"])) {
      $dep_id = $_POST["dep_id"];
    }

    oci_execute($stmt);
    if ($message == 1) {

    }
  }

  if (isset($_GET["user_id"])) {
    
    $sql     = '
    SELECT T_USER.FIRST_NAME,T_USER.LAST_NAME,T_USER.U_ID,T_USER.DATE_OF_BIRTH,T_USER.EMAIL,T_USER.PHONE_NUMBER,T_USER.ADDRESS,
    T_USER.ROLE_FK,T_USER.DEPARTMENT_FK,T_USER.UNIT_FK
    FROM T_USER
    WHERE PK = '.$user_id.'';

    $stmt = oci_parse($conn, $sql);
    $r    = oci_execute($stmt);
    $row  = oci_fetch_assoc($stmt);

    $f_name = $row["FIRST_NAME"];
    $l_name = $row["LAST_NAME"];
    $u_id   = $row["U_ID"];
    $role_id   = $row["ROLE_FK"];
    $dep_id   = $row["DEPARTMENT_FK"];
    $unit_id   = $row["UNIT_FK"];

    $date          = DateTime::createFromFormat("d#M#y", $row["DATE_OF_BIRTH"]);
    $date_of_birth = $date->format('d-m-Y');

    $email   = $row["EMAIL"];
    $address = $row["ADDRESS"];
    $phone   = $row["PHONE_NUMBER"];
    //$cr_time = $row["CREATION_TIME"];
    //$md_time = $row["MODIFIED_TIME"];
  }

  if (isset($_POST["insert-user-ability"])) {

    $sql  = 'BEGIN SP_ASSIGN_ABILITY_TO_USER(:usr_id,:ablyt_id,:lvl_id,:is_valid); END;';
    $stmt = oci_parse($conn, $sql);

    oci_bind_by_name($stmt, ':usr_id', $user_id);
    oci_bind_by_name($stmt, ':ablyt_id', $ability_id);
    oci_bind_by_name($stmt, ':lvl_id', $level_id);
    oci_bind_by_name($stmt, ':is_valid', $message);

    $user_id    = $_GET["user_id"];
    $ability_id = $_POST["ability_id"];
    $level_id   = $_POST["level_id"];

    oci_execute($stmt);

    /*echo '
      <script type="text/javascript">
        $(document).ready(function() {
            if (location.hash) {
                $("a[href=\'" + location.hash + "\']").tab("show");
            }
            $(document.body).on("click", "a[data-toggle]", function() {
                location.hash = this.getAttribute("href");
            });
        });
        $(window).on("popstate", function() {
            var anchor = location.hash || $("a[data-toggle=\'tab\']").first().attr("href");
            $("a[href=\'" + anchor + "\']").tab("show");
        });
       </script>';*/
  }
  else if (isset($_POST["update-user-ability"])) {

    $sql  = 'BEGIN SP_UPDATE_ABILITY_ON_USER(:usr_id,:ablyt_id,:lvl_id,:is_valid); END;';
    $stmt = oci_parse($conn, $sql);

    oci_bind_by_name($stmt, ':usr_id', $user_id);
    oci_bind_by_name($stmt, ':ablyt_id', $ability_id);
    oci_bind_by_name($stmt, ':lvl_id', $level_id);
    oci_bind_by_name($stmt, ':is_valid', $message);

    $user_id    = $_GET["user_id"];
    $ability_id = $_POST["ability_id"];
    $level_id   = $_POST["level_id"];

    oci_execute($stmt);

    /*echo '
    /*<script type="text/javascript">
      $(document).ready(function() {
          if (location.hash) {
              $("a[href=\'" + location.hash + "\']").tab("show");
          }
          $(document.body).on("click", "a[data-toggle]", function() {
              location.hash = this.getAttribute("href");
          });
      });
      $(window).on("popstate", function() {
          var anchor = location.hash || $("a[data-toggle=\'tab\']").first().attr("href");
          $("a[href=\'" + anchor + "\']").tab("show");
      });
     </script>';*/
  }
  else if (isset($_POST["delete-user-ability"])) {
    $sql  = 'BEGIN SP_DELETE_ABILITY_FROM_USER(:usr_id,:ablyt_id,:is_valid); END;';
    $stmt = oci_parse($conn, $sql);

    oci_bind_by_name($stmt, ':usr_id', $user_id);
    oci_bind_by_name($stmt, ':ablyt_id', $ability_id);
    oci_bind_by_name($stmt, ':is_valid', $message);

    $user_id    = $_GET["user_id"];
    $ability_id = $_POST["ability_id"];

    oci_execute($stmt);

    /*echo '
    <script type="text/javascript">
      $(document).ready(function() {
          if (location.hash) {
              $("a[href=\'" + location.hash + "\']").tab("show");
          }
          $(document.body).on("click", "a[data-toggle]", function() {
              location.hash = this.getAttribute("href");
          });
      });
      $(window).on("popstate", function() {
          var anchor = location.hash || $("a[data-toggle=\'tab\']").first().attr("href");
          $("a[href=\'" + anchor + "\']").tab("show");
      });
     </script>';*/
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
              <div class="tab-pane active" id="info">
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
                              $sql  = 'SELECT * FROM V_DEPARTMENTS';
                              $stmt = oci_parse($conn, $sql);
                              $r    = oci_execute($stmt);
                              echo '<select id="userDepartment" name="dep_id" class="form-control selectpicker" data-live-search="true" data-size="5" title="Departman Seçiniz">';
                              echo '<option value="Seçiniz">Seçiniz</option>';
                              while ($row = oci_fetch_array($stmt, OCI_RETURN_NULLS + OCI_ASSOC)) {
                                echo '<option value ="'.$row["PK"].'" '.($row["PK"] == $dep_id ? 'selected="selected"' : "").'>'.$row["DEP_NAME"].'</option>';
                              }
                              echo '</select>';
                            ?>
                          </div>
                        </div>
                        <div class="col-xs-12 col-xl-6">
                          <div class="form-group">
                            <?php
                              $sql  = 'SELECT * FROM V_UNITS';
                              $stmt = oci_parse($conn, $sql);
                              $r    = oci_execute($stmt);
                              echo '<select id="userUnit" name="unit_id" class="form-control selectpicker" data-live-search="true" data-size="5" title="Birim Seçiniz">';
                              echo '<option value="Seçiniz">Seçiniz</option>';
                              while ($row = oci_fetch_array($stmt, OCI_RETURN_NULLS + OCI_ASSOC)) {
                                echo '<option value ="'.$row["PK"].'" '.($row["PK"] == $unit_id ? 'selected="selected"' : "").'>'.$row["UNT_NAME"].'</option>';
                              }
                              echo '</select>';
                            ?>
                          </div>
                        </div>
                        <div class="col-xs-12 col-xl-6">
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
                      </div>
                    </div>
                    <div class="col-xs-12 col-md-12 col-lg-6 mb-1">
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                            <input type="text" class="form-control" name="f_name" value="<?php echo $f_name ?>" placeholder="İsim">
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <input type="text" class="form-control" name="l_name" value="<?php echo $l_name ?>" placeholder="Soyisim">
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <input type="text" class="form-control" name="u_name" value="<?php echo $u_id ?>" placeholder="Kullanıcı Adı">
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <input type="text" data-provide="datepicker" name="date_of_birth" class="form-control datepicker" value="<?php echo $date_of_birth ?>" placeholder="Doğum Tarihi">
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-xs-12 col-md-12 col-lg-6 mb-1">
                      <div class="row">
                        <div class="col-sm-12 col-md-6">
                          <div class="form-group">
                            <input type="email" class="form-control" name="e_mail" placeholder="E-mail" value="<?php echo $email ?>" name="stepEmail" id="stepEmail">
                          </div>
                        </div>
                        <div class="col-sm-12 col-md-6">
                          <div class="form-group">
                            <input type="number" class="form-control" name="phone_number" placeholder="Mobil Telefon No" value="<?php echo $phone ?>" name="stepTel" id="stepTel">
                          </div>
                        </div>
                        <div class="col-md-12">
                          <div class="form-group">
                            <textarea rows="5" class="form-control" placeholder="Adres..." name="address" id="stepAddress"><?php echo $address ?></textarea>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
              <div class="tab-pane" id="skill">
                <div class="row">
                  <div class="col-xs-12">
                    <div class="card-title">Yetenekler</div>
                  </div>
                  <div class="col-xs-12 col-xl-6">
                    <div class="table-responsive">
                      <form method="post" action="user-detail.php?user_id=<?php echo $user_id ?>#skill">
                        <table class="table table-specific">
                          <thead>
                          <tr>
                            <th>Kayıtlı Yetenekler</th>
                            <th>Seviye</th>
                          </tr>
                          </thead>
                          <tbody>
                          <?php
                            $sql1 = 'SELECT T_ABILITY.PK AS AB_PK,T_ABILITY.ABILITY_NAME AS AN,T_ABILITY_LEVEL.PK AS LE_PK,T_ABILITY_LEVEL.LEVEL_NAME AS LN
                            FROM T_USER_ABILITY_REL,T_ABILITY,T_ABILITY_LEVEL WHERE
                            T_USER_ABILITY_REL.ABILITY_FK = T_ABILITY.PK AND
                            T_USER_ABILITY_REL.ABILITY_LEVEL_FK = T_ABILITY_LEVEL.PK AND
                            T_USER_ABILITY_REL.USER_FK = '.$user_id.'
                            ORDER BY AN';

                            $stmt1 = oci_parse($conn, $sql1);
                            $r1    = oci_execute($stmt1);
                            while ($row1 = oci_fetch_array($stmt1, OCI_RETURN_NULLS + OCI_ASSOC)) {
                              echo '<form method="post" action="user-detail.php?user_id='.$user_id.'#skill">';
                              echo '<tr>';
                              echo '<td>'.$row1["AN"].'</td>';
                              echo '<input type="hidden" value='.$row1["AB_PK"].' name="ability_id"/>';
                              echo '<td class="select-level">';
                              $sql2  = 'SELECT PK,LEVEL_NAME FROM T_ABILITY_LEVEL ORDER BY LEVEL_ORDER';
                              $stmt2 = oci_parse($conn, $sql2);
                              $r2    = oci_execute($stmt2);
                              echo '<select name="level_id" class="form-control selectpicker" data-container="body">';
                              while ($row2 = oci_fetch_array($stmt2, OCI_RETURN_NULLS + OCI_ASSOC)) {
                                echo '<option value="'.$row2["PK"].'" '.($row2["PK"] == $row1["LE_PK"] ? 'selected="selected"' : "").'>'.$row2["LEVEL_NAME"].'</option>';
                              }
                              echo '</select>';
                              
                              echo '<button type="submit" name="update-user-ability" class="btn btn-success">Güncelle</button>';
                              echo '<button type="submit" name="delete-user-ability" class="btn btn-danger">Sil</button>';
                              echo '</td>';
                              echo '</tr>';
                              echo '</form>';
                            }
                          ?>
                          </tbody>
                        </table>
                      
                    </div>
                  </div>
                  <div class="col-xs-12 col-xl-6">
                    <div class="table-responsive">
                      <form method="post" action="user-detail.php?user_id=<?php echo $user_id ?>#skill">
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
                              <?php
                                $sql  = 'SELECT T_ABILITY.PK,T_ABILITY.ABILITY_NAME FROM T_ABILITY WHERE T_ABILITY.PK
                            NOT IN (SELECT T_USER_ABILITY_REL.ABILITY_FK FROM T_USER_ABILITY_REL WHERE T_USER_ABILITY_REL.USER_FK = '.$user_id.')
                            ORDER BY ABILITY_NAME';
                                $stmt = oci_parse($conn, $sql);
                                $r    = oci_execute($stmt);
                                echo '<select name="ability_id" class="form-control selectpicker" data-container="body" data-live-search="true" data-size="5" title="Yetenek Seçiniz">';
                                while ($row = oci_fetch_array($stmt, OCI_RETURN_NULLS + OCI_ASSOC)) {
                                  echo '<option value ="'.$row["PK"].'">'.$row["ABILITY_NAME"].'</option>';
                                }
                                echo '</select>';
                              ?>
                            </td>
                            <td class="select-level">
                              <?php
                                $sql  = 'SELECT PK,LEVEL_NAME FROM T_ABILITY_LEVEL ORDER BY LEVEL_ORDER';
                                $stmt = oci_parse($conn, $sql);
                                $r    = oci_execute($stmt);
                                echo '<select name="level_id" class="form-control selectpicker" data-container="body" data-live-search="true" data-size="5" title="Seviye Seçiniz">';
                                while ($row = oci_fetch_array($stmt, OCI_RETURN_NULLS + OCI_ASSOC)) {
                                  echo '<option value ="'.$row["PK"].'">'.$row["LEVEL_NAME"].'</option>';
                                }
                                echo '</select>';
                              ?>
                              <button type="submit" name="insert-user-ability" class="btn btn-success">Ekle</button>
                            </td>
                          </tr>
                          </tbody>
                        </table>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
              <div class="tab-pane" id="course">
                <div class="table-responsive">
                  <table class="table">
                    <thead>
                    <tr>
                      <th>Eğitim Adı</th>
                      <th>Eğitmen</th>
                      <th>Eğitim Salonu</th>
                      <th>Başlangıç Tarihi</th>
                      <th>Bitiş Tarihi</th>
                      <th>Durum</th>
                      <th>İşlemler</th>
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
                        $date          = DateTime::createFromFormat("d#M#y H#i#s*A", $row["PLND_DTE"]);
                        $started_date  = $date->format('d/m/Y - H:i');
                        $date          = DateTime::createFromFormat("d#M#y H#i#s*A", $row["CMPLT_DTE"]);
                        $complete_date = $date->format('d/m/Y - H:i');
                        echo '<tr>';
                        echo '<td>'.$row['SUBJECT'].'</td>';
                        echo '<td>'.$row['EDCTR_NAME'].'</td>';
                        echo '<td>Salon A</td>';
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