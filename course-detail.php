<?php
  include "header.php";
  include "dbsettings.php";

  if (isset($_GET["course_id"])) {
    $course_id = $_GET["course_id"];
    $sql       = '
      SELECT T_EDUCATOR.EDUCATOR_NAME,T_EDUCATION.EDUCATION_SUBJECT,T_EDUCATION.EDUCATION_CONTENT,T_EDUCATION.PLANNED_DATE,T_EDUCATION.COMPLETE_DATE
      FROM T_EDUCATION,T_EDUCATOR
      WHERE T_EDUCATION.PK = '.$course_id.' AND T_EDUCATION.EDUCATOR_FK = T_EDUCATOR.PK';

    $stmt = oci_parse($conn, $sql);
    $r    = oci_execute($stmt);
    $row  = oci_fetch_assoc($stmt);

    $educator_name     = $row["EDUCATOR_NAME"];
    $education_subject = $row["EDUCATION_SUBJECT"];
    $education_content = $row["EDUCATION_CONTENT"];

    $started   = $row["PLANNED_DATE"];
    $completed = $row["COMPLETE_DATE"];

    $date         = DateTime::createFromFormat("d#M#y H#i#s*A", $row["PLANNED_DATE"]);
    $started_date = $date->format('d/m/Y - H:i');

    $date          = DateTime::createFromFormat("d#M#y H#i#s*A", $row["COMPLETE_DATE"]);
    $complete_date = $date->format('d/m/Y - H:i');

    $sql  = 'select CURRENT_TIMESTAMP AS NOW from dual';
    $stmt = oci_parse($conn, $sql);
    $r    = oci_execute($stmt);
    $row  = oci_fetch_assoc($stmt);

    if ($row["NOW"] < $started) {
      $text       = "Planlandı";
      $span_class = "wait";
      $i_class    = "mdi mdi-timer";
    }

    else if ($row["NOW"] == $started) {
      $text       = "Başladı";
      $span_class = "on";
      $i_class    = "mdi mdi-timer-sand";
    }
    else if ($row["NOW"] < $completed) {
      $text       = "Devam Ediyor";
      $span_class = "on";
      $i_class    = "mdi mdi-timer-sand";
    }
    else if ($row["NOW"] == $completed) {
      $text       = "Bitmek Üzere";
      $span_class = "on";
      $i_class    = "mdi mdi-timer-sand";
    }

    else {
      $text       = "Sona Erdi";
      $span_class = "off";
      $i_class    = "mdi mdi-check";
    }
  }

  if (isset($_POST["insert-education-ability"])) {

    $sql  = 'BEGIN SP_ASSIGN_ABILITY_TO_EDUCATION(:edu_id,:ablyt_id,:is_valid); END;';
    $stmt = oci_parse($conn, $sql);

    oci_bind_by_name($stmt, ':edu_id', $course_id);
    oci_bind_by_name($stmt, ':ablyt_id', $ability_id);
    oci_bind_by_name($stmt, ':is_valid', $message);

    $course_id  = $_GET["course_id"];
    $ability_id = $_POST["ability_id"];

    oci_execute($stmt);

    echo '
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
     </script>';
  }
  else if (isset($_POST["delete-education-ability"])) {

    $sql  = 'BEGIN SP_DELETE_ABILITY_FROM_EDU(:edu_id,:ablyt_id,:is_valid); END;';
    $stmt = oci_parse($conn, $sql);

    oci_bind_by_name($stmt, ':edu_id', $course_id);
    oci_bind_by_name($stmt, ':ablyt_id', $ability_id);
    oci_bind_by_name($stmt, ':is_valid', $message);

    $course_id  = $_GET["course_id"];
    $ability_id = $_POST["ability_id"];

    oci_execute($stmt);

    echo '
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
     </script>';
  }
  else if (isset($_POST["insert-education-user"])) {

    $sql  = 'BEGIN SP_ASSIGN_USER_TO_EDUCATION(:edu_id,:usr_id,:is_valid); END;';
    $stmt = oci_parse($conn, $sql);

    oci_bind_by_name($stmt, ':edu_id', $course_id);
    oci_bind_by_name($stmt, ':usr_id', $user_id);
    oci_bind_by_name($stmt, ':is_valid', $message);

    $course_id = $_GET["course_id"];
    $user_id   = $_POST["user_id"];

    oci_execute($stmt);

    echo '
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
     </script>';
  }
  else if (isset($_POST["delete-education-user"])) {

    $sql  = 'BEGIN SP_DELETE_USER_FROM_EDUCATION(:edu_id,:usr_id,:is_valid); END;';
    $stmt = oci_parse($conn, $sql);

    oci_bind_by_name($stmt, ':edu_id', $course_id);
    oci_bind_by_name($stmt, ':usr_id', $user_id);
    oci_bind_by_name($stmt, ':is_valid', $message);

    $course_id = $_GET["course_id"];
    $user_id   = $_POST["user_id"];

    oci_execute($stmt);

    echo '
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
     </script>';
  }
?>

<div class="wrapper">
  <?php include "sidebar.php"; ?>
  <div class="page-content">
    <?php include "navbar.php"; ?>
    <div class="container-fluid">
      <div class="card">
        <div class="card-header hidden-xs-down">
          <div class="card-title">Eğitim Detayları</div>
          <div class="card-buttons">
            <button type="submit" class="btn btn-danger">İptal Et</button>
            <button type="submit" class="btn btn-danger">Sonlandır</button>
          </div>
        </div>
        <div class="card-block">
          <div class="course-status">Eğitim Durumu:
            <?php echo '<span class="'.$span_class.'">'.$text.'<i class="'.$i_class.'"></i></span>'; ?>
          </div>
          <ul class="nav nav-tabs">
            <li class="nav-item">
              <a class="nav-link active" data-toggle="tab" href="#info">Bilgiler</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-toggle="tab" href="#topic">Konular</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-toggle="tab" href="#user">Kullanıcılar</a>
            </li>
          </ul>
          <div class="tab-content">
            <div class="tab-pane active" id="info">
              <form method="post">
                <div class="row">
                  <div class="col-xs-12">
                    <div class="card-title">Eğitim Bilgileri
                      <button type="submit" class="btn btn-success">Kaydet</button>
                    </div>
                  </div>
                  <div class="col-xs-12 col-md-4">
                    <div class="form-group">
                      <input type="text" class="form-control" value=<?php echo $education_subject ?> name="education_name" placeholder="Eğitim Adı">
                    </div>
                  </div>
                  <div class="col-xs-12 col-md-4">
                    <div class="form-group">
                      <input type="text" class="form-control" value="<?php echo $educator_name ?>" name="educator_name" placeholder="Eğitmen">
                    </div>
                  </div>
                  <div class="col-xs-12 col-md-4">
                    <div class="form-group">
                      <select class="form-control selectpicker" title="Eğitim Salonu">
                        <option value="Salon A">Salon A</option>
                        <option value="Salon B">Salon B</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-xs-12 col-md-6">
                    <div class="form-group">
                      <input type="text" name="started_date" class="form-control datetimepicker" placeholder="Başlangıç Zamanı">
                    </div>
                  </div>
                  <div class="col-xs-12 col-md-6">
                    <div class="form-group">
                      <input type="text" name="complete_date" class="form-control datetimepicker2" placeholder="Bitiş Zamanı">
                    </div>
                  </div>
                  <div class="col-xs-12">
                    <div class="form-group">
                      <textarea rows="5" class="form-control" name="education_detail" placeholder="Eğitim Detayları"><?php echo $education_content ?></textarea>
                    </div>
                  </div>
                </div>
              </form>
            </div>
            <div class="tab-pane" id="topic">
              <div class="row">
                <div class="col-xs-12">
                  <div class="card-title">Eğitim Konuları</div>
                </div>
                <div class="col-xs-12 col-xl-6">
                  <div class="table-responsive">
                    <form method="post" action="course-detail.php?course_id=<?php echo $course_id ?>#topic">
                      <table class="table table-specific">
                        <thead>
                        <tr>
                          <th>Kayıtlı Konular</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                          $sql  = 'SELECT T_ABILITY.PK,T_ABILITY.ABILITY_NAME AS ABLY_NAME FROM T_EDUCATION,T_ABILITY,T_EDUCATION_ABILITY_REL
                          WHERE T_EDUCATION_ABILITY_REL.ABILITY_FK = T_ABILITY.PK AND T_EDUCATION_ABILITY_REL.EDUCATION_FK = '.$course_id.'
                          ORDER BY ABLY_NAME';
                          $stmt = oci_parse($conn, $sql);
                          $r    = oci_execute($stmt);
                          while ($row = oci_fetch_array($stmt, OCI_RETURN_NULLS + OCI_ASSOC)) {
                            echo '<tr>';
                            echo '<input type="hidden" value='.$row["PK"].' name="ability_id"/>';
                            echo '<td>'.$row["ABLY_NAME"].'<button type="submit" name="delete-education-ability" class="btn btn-danger float-xs-right">Sil</button>';
                            echo '</td>';
                            echo '</tr>';
                          }
                        ?>
                        </tbody>
                      </table>
                    </form>
                  </div>
                </div>
                <div class="col-xs-12 col-xl-6">
                  <div class="table-responsive">
                    <form method="post" action="course-detail.php?course_id=<?php echo $course_id ?>#topic">
                      <table class="table table-all">
                        <thead>
                        <tr>
                          <th>Tüm Konular</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                          <td class="select-level">
                            <?php
                              $sql  = 'SELECT T_ABILITY.PK,T_ABILITY.ABILITY_NAME AS ABLY_NAME FROM T_ABILITY
                              WHERE T_ABILITY.PK
                              NOT IN (SELECT ABILITY_FK FROM T_EDUCATION_ABILITY_REL WHERE EDUCATION_FK = '.$course_id.')
                              ORDER BY ABLY_NAME';
                              $stmt = oci_parse($conn, $sql);
                              $r    = oci_execute($stmt);
                              echo '<select name="ability_id" class="form-control selectpicker" data-container="body" data-live-search="true" data-size="5" title="Yetenek Seçiniz">';
                              while ($row = oci_fetch_array($stmt, OCI_RETURN_NULLS + OCI_ASSOC)) {
                                echo '<option value ="'.$row["PK"].'">'.$row["ABLY_NAME"].'</option>';
                              }
                              echo '</select>';
                            ?>
                            <button type="submit" name="insert-education-ability" class="btn btn-success float-xs-right">Ekle</button>
                          </td>
                        </tr>
                        </tbody>
                      </table>
                    </form>
                  </div>
                </div>
              </div>
            </div>
            <div class="tab-pane" id="user">
              <div class="row">
                <div class="col-xs-12">
                  <div class="card-title">Eğitimdeki Kullanıcılar</div>
                </div>
                <div class="col-xs-12 col-xl-6">
                  <div class="table-responsive">
                    <form method="post" action="course-detail.php?course_id=<?php echo $course_id ?>#user">
                      <table class="table table-specific">
                        <thead>
                          <th>Eğitimdeki Kullanıcılar</th>
                          <th>Rol</th>
                        </thead>
                        <tbody>
                        <?php
                          $sql  = 'SELECT T_USER.PK AS US_PK,INITCAP(T_USER.FIRST_NAME) AS F_NAME,INITCAP(T_USER.LAST_NAME) AS L_NAME,INITCAP(T_ROLE.ROLE_NAME) AS RLE_NAME FROM T_EDUCATION_USER_REL,T_USER
                          LEFT JOIN T_ROLE ON T_USER.ROLE_FK = T_ROLE.PK
                          WHERE T_EDUCATION_USER_REL.EDUCATION_FK = '.$course_id.' AND T_EDUCATION_USER_REL.USER_FK = T_USER.PK
                          ORDER BY F_NAME,L_NAME';
                          $stmt = oci_parse($conn, $sql);
                          $r    = oci_execute($stmt);
                          while ($row = oci_fetch_array($stmt, OCI_RETURN_NULLS + OCI_ASSOC)) {
                            echo '<tr>';
                            echo '<input type="hidden" value='.$row["US_PK"].' name="user_id"/>';
                            echo '<td>'.$row["F_NAME"].' '.$row["L_NAME"].'</td>';
                            echo '<td>'.$row["RLE_NAME"].'<button type="submit" name="delete-education-user" class="btn btn-danger float-xs-right">Sil</button></td>';
                            echo '</tr>';
                          }
                        ?>
                        </tbody>
                      </table>
                    </form>
                  </div>
                </div>
                <div class="col-xs-12 col-xl-6">
                  <div class="table-responsive">
                    <form method="post" action="course-detail.php?course_id=<?php echo $course_id ?>#user">
                      <table class="table table-all">
                        <thead>
                        <tr>
                          <th>Tüm Kullanıcılar</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                          <td class="select-level">
                            <?php
                              $sql  = 'SELECT T_USER.PK,T_USER.FIRST_NAME AS F_NAME,T_USER.LAST_NAME AS L_NAME,T_ROLE.ROLE_NAME AS RLE_NAME FROM T_USER
                          LEFT JOIN T_ROLE ON T_USER.ROLE_FK = T_ROLE.PK
                          WHERE T_USER.PK NOT IN (SELECT USER_FK FROM T_EDUCATION_USER_REL WHERE T_EDUCATION_USER_REL.EDUCATION_FK = '.$course_id.') ORDER BY F_NAME,L_NAME';
                              $stmt = oci_parse($conn, $sql);
                              $r    = oci_execute($stmt);
                              echo '<select name="user_id" class="form-control selectpicker" data-container="body" data-live-search="true" data-size="5" title="Katılımcı Seçiniz">';
                              while ($row = oci_fetch_array($stmt, OCI_RETURN_NULLS + OCI_ASSOC)) {
                                echo '<option value="'.$row["PK"].'">'.$row["F_NAME"].' '.$row["L_NAME"].' | '.$row["RLE_NAME"].'
                            </option>';
                              }
                              echo '</select>';
                            ?>
                            <button type="submit" name="insert-education-user" class="btn btn-success">Ekle</button>
                          </td>
                        </tr>
                        </tbody>
                      </table>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">

  var start_date = "<?php echo $started_date; ?>";
  var complete_date = "<?php echo $complete_date; ?>";

  $(".datetimepicker").val(start_date);
  $(".datetimepicker2").val(complete_date);

</script>

<?php include "footer.php"; ?>
