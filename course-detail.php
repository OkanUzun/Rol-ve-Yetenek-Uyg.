<?php
  include "header.php";
  include "dbsettings.php";

  if (isset($_GET["course_id"])) {
    $course_id = $_GET["course_id"];
    $sql       = '
      SELECT T_EDUCATOR.EDUCATOR_NAME,T_EDUCATION.EDUCATION_SUBJECT,T_EDUCATION.EDUCATION_CONTENT,T_EDUCATION.PLANNED_DATE,T_EDUCATION.COMPLETE_DATE
      FROM T_EDUCATION,T_EDUCATOR
      WHERE T_EDUCATION.PK = '.$course_id.' AND T_EDUCATION.EDUCATOR_FK = T_EDUCATOR.PK';
    $stmt      = oci_parse($conn, $sql);
    $r         = oci_execute($stmt);
    $row       = oci_fetch_assoc($stmt);

    $educator_name     = $row["EDUCATOR_NAME"];
    $education_subject = $row["EDUCATION_SUBJECT"];
    $education_content = $row["EDUCATION_CONTENT"];

    $started   = $row["PLANNED_DATE"];
    $completed = $row["COMPLETE_DATE"];

    $date         = DateTime::createFromFormat("d#M#y", $row["PLANNED_DATE"]);
    $started_date = $date->format('d/m/Y');

    $date          = DateTime::createFromFormat("d#M#y", $row["COMPLETE_DATE"]);
    $complete_date = $date->format('d/m/Y');

    $sql  = 'SELECT SYSDATE AS NOW FROM DUAL';
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
            <div class="tab-pane fade in active" id="info">
              <form method="post">
                <div class="row">
                  <div class="col-xs-12">
                    <div class="card-title">Eğitim Bilgileri
                      <button type="submit" class="btn btn-success">Kaydet</button>
                    </div>
                  </div>
                  <div class="col-xs-12 col-md-6">
                    <div class="form-group">
                      <input type="text" class="form-control" value=<?php echo $education_subject ?> name="education_name" placeholder="Eğitim Adı">
                    </div>
                  </div>
                  <div class="col-xs-12 col-md-6">
                    <div class="form-group">
                      <input type="text" class="form-control" value="<?php echo $educator_name ?>" name="educator_name" placeholder="Eğitmen">
                    </div>
                  </div>
                  <div class="col-xs-12 col-md-6">
                    <div class="form-group">
                      <input type="text" data-provide="datepicker" value=<?php echo $started_date ?> name="started_date" class="form-control datepicker" placeholder="Başlangıç Tarihi">
                    </div>
                  </div>
                  <div class="col-xs-12 col-md-6">
                    <div class="form-group">
                      <input type="text" data-provide="datepicker" value=<?php echo $complete_date ?> name="complete_date" class="form-control datepicker" placeholder="Bitiş Tarihi">
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
            <div class="tab-pane fade" id="topic">
              <form method="post">
                <div class="row">
                  <div class="col-xs-12">
                    <div class="card-title">Eğitim Konuları
                      <button type="submit" class="btn btn-success" disabled>Kaydet</button>
                    </div>
                  </div>
                  <div class="col-xs-12 col-xl-6">
                    <div class="table-responsive">
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
                            echo '<td>'.$row["ABLY_NAME"].'<a href="javascript:void(0)" onclick="changeSide()" class="btn btn-danger float-xs-right">Sil</a></td>';
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
                          <th>Tüm Konular</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                          <td class="select-level">
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
                            <a href="javascript:void(0)" onclick="changeSide()" class="btn btn-success float-xs-right">Ekle</a>
                          </td>
                        </tr>
                        <?php
                          /*                          $sql  = 'SELECT T_ABILITY.PK,T_ABILITY.ABILITY_NAME AS ABLY_NAME FROM T_ABILITY
                                                    WHERE T_ABILITY.PK
                                                    NOT IN (SELECT ABILITY_FK FROM T_EDUCATION_ABILITY_REL WHERE EDUCATION_FK = '.$course_id.')
                                                    ORDER BY ABLY_NAME';
                                                    $stmt = oci_parse($conn, $sql);
                                                    $r    = oci_execute($stmt);
                                                    while ($row = oci_fetch_array($stmt, OCI_RETURN_NULLS + OCI_ASSOC)) {
                                                      echo '<tr>';
                                                      echo '<td>'.$row["ABLY_NAME"].'<a href="javascript:void(0)" onclick="changeSide()" class="btn btn-success float-xs-right">Ekle</a></td>';
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
            <div class="tab-pane fade" id="user">
              <form method="post">
                <div class="row">
                  <div class="col-xs-12">
                    <div class="card-title">Eğitimdeki Kullanıcılar
                      <button type="submit" class="btn btn-success" disabled>Kaydet</button>
                    </div>
                  </div>
                  <div class="col-xs-12 col-xl-6">
                    <div class="table-responsive">
                      <table class="table table-specific">
                        <thead>
                        <tr>
                          <th>Kayıtlı Kullanıcılar</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                          $sql  = 'SELECT INITCAP(T_USER.FIRST_NAME) AS F_NAME,INITCAP(T_USER.LAST_NAME) AS L_NAME,INITCAP(T_ROLE.ROLE_NAME) AS RLE_NAME FROM T_EDUCATION_USER_REL,T_USER
                          LEFT JOIN T_ROLE ON T_USER.ROLE_FK = T_ROLE.PK
                          WHERE T_EDUCATION_USER_REL.EDUCATION_FK = '.$course_id.' AND T_EDUCATION_USER_REL.USER_FK = T_USER.PK
                          ORDER BY F_NAME,L_NAME';
                          $stmt = oci_parse($conn, $sql);
                          $r    = oci_execute($stmt);
                          while ($row = oci_fetch_array($stmt, OCI_RETURN_NULLS + OCI_ASSOC)) {
                            echo '<tr>';
                            echo '<td>'.$row["F_NAME"].' '.$row["L_NAME"].'</td>';
                            echo '<td>'.$row["RLE_NAME"].'<a href="javascript:void(0)" onclick="changeSide()" class="btn btn-danger float-xs-right">Sil</a></td>';
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
                          <th>Tüm Kullanıcılar</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                          <td class="select-level">
                            <select class="form-control selectpicker" data-container="body" data-live-search="true" data-size="5">
                              <option value="Okan Uzun | Java Developer">Okan Uzun | Java Developer</option>
                              <option value="Deniz Güzel | Java Developer">Deniz Güzel | Java Developer</option>
                              <option value="Ali Kemal Öcalan | Android Developer">Ali Kemal Öcalan | Android Developer</option>
                              <option value="Burak Ermeydan | Php Developer">Burak Ermeydan | Php Developer</option>
                            </select>
                            <a href="javascript:void(0)" onclick="changeSide()" class="btn btn-success float-xs-right">Ekle</a>
                          </td>
                        </tr>
                        <?php
                          /*                          $sql  = "SELECT T_USER.FIRST_NAME AS F_NAME,T_USER.LAST_NAME AS L_NAME,T_ROLE.ROLE_NAME AS RLE_NAME FROM T_USER
                                                    LEFT JOIN T_ROLE ON T_USER.ROLE_FK = T_ROLE.PK
                                                    WHERE T_USER.PK NOT IN (SELECT USER_FK FROM T_EDUCATION_USER_REL WHERE T_EDUCATION_USER_REL.EDUCATION_FK = '.$course_id.') ORDER BY F_NAME,L_NAME";
                                                    $stmt = oci_parse($conn, $sql);
                                                    $r    = oci_execute($stmt);
                                                    while ($row = oci_fetch_array($stmt, OCI_RETURN_NULLS + OCI_ASSOC)) {
                                                      echo '<tr>';
                                                      echo '<td>'.$row["F_NAME"].' '.$row["L_NAME"].'</td>';
                                                      echo '<td>'.$row["RLE_NAME"].'<a href="javascript:void(0)" onclick="changeSide()" class="btn btn-success float-xs-right">Ekle</a></td>';
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
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php include "footer.php"; ?>
