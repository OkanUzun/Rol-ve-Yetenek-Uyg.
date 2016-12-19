<?php 
  include "header.php";
  include "dbsettings.php";

    if (isset($_GET["course_id"])) {
    $course_id = $_GET["course_id"];
    $sql = '
    SELECT T_EDUCATOR.EDUCATOR_NAME,T_EDUCATION.EDUCATION_SUBJECT,T_EDUCATION.EDUCATION_CONTENT,T_EDUCATION.PLANNED_DATE,T_EDUCATION.COMPLETE_DATE
    FROM T_EDUCATION,T_EDUCATOR
    WHERE T_EDUCATION.PK = '.$course_id.' AND T_EDUCATION.EDUCATOR_FK = T_EDUCATOR.PK';
    $stmt = oci_parse($conn, $sql);
    $r = oci_execute($stmt);
    $row = oci_fetch_assoc($stmt);

    $educator_name = $row["EDUCATOR_NAME"];
    $education_subject   = $row["EDUCATION_SUBJECT"];
    $education_content   = $row["EDUCATION_CONTENT"];

    $started = $row["PLANNED_DATE"];
    $completed = $row["COMPLETE_DATE"];

    $date = DateTime::createFromFormat("d#M#y", $row["PLANNED_DATE"]);
    $started_date = $date->format('d/m/Y');

    $date = DateTime::createFromFormat("d#M#y", $row["COMPLETE_DATE"]);
    $complete_date = $date->format('d/m/Y');

    $sql = 'SELECT SYSDATE AS NOW FROM DUAL';
    $stmt = oci_parse($conn, $sql);
    $r = oci_execute($stmt);
    $row = oci_fetch_assoc($stmt);

    if ($row["NOW"] < $started){
      $text = "Planlandı";
      $span_class = "wait";
      $i_class = "mdi mdi-timer";
    }

    else if ($row["NOW"] == $started) {
      $text = "Başladı";
      $span_class = "on";
      $i_class = "mdi mdi-timer-sand";
    }
    else if ($row["NOW"] < $completed){
      $text = "Devam Ediyor";
      $span_class = "on";
      $i_class = "mdi mdi-timer-sand";
    }
    else if ($row["NOW"] == $completed){
      $text = "Bitmek Üzere";
      $span_class = "on";
      $i_class = "mdi mdi-timer-sand";
    }

    else{
      $text = "Sona Erdi";
      $span_class = "off";
      $i_class = "mdi mdi-check";      
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
            <?php echo '<span class="'.$span_class.'">'.$text.'<i class="'.$i_class.'"></i></span>';?>
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
                      <input type="text" class="form-control" value=<?php echo $education_subject?> name="education_name" placeholder="Eğitim Adı">
                    </div>
                  </div>
                  <div class="col-xs-12 col-md-6">
                    <div class="form-group">
                      <input type="text" class="form-control" value="<?php echo $educator_name?>" name="educator_name" placeholder="Eğitmen">
                    </div>
                  </div>
                  <div class="col-xs-12 col-md-6">
                    <div class="form-group">
                      <input type="text" data-provide="datepicker" value=<?php echo $started_date?> name="started_date" class="form-control datepicker" placeholder="Başlangıç Tarihi">
                    </div>
                  </div>
                  <div class="col-xs-12 col-md-6">
                    <div class="form-group">
                      <input type="text" data-provide="datepicker" value=<?php echo $complete_date?> name="complete_date" class="form-control datepicker" placeholder="Bitiş Tarihi">
                    </div>
                  </div>
                  <div class="col-xs-12">
                    <div class="form-group">
                      <textarea rows="5" class="form-control" name="education_detail" placeholder="Eğitim Detayları"><?php echo $education_content?></textarea>
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
                        <tr>
                          <td>HTML<a href="javascript:void(0)" onclick="changeSide()" class="btn btn-danger float-xs-right">Sil</a></td>
                        </tr>
                        <tr>
                          <td>PHP<a href="javascript:void(0)" onclick="changeSide()" class="btn btn-danger float-xs-right">Sil</a></td>
                        </tr>
                        <tr>
                          <td>Java<a href="javascript:void(0)" onclick="changeSide()" class="btn btn-danger float-xs-right">Sil</a></td>
                        </tr>
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
                          <td>HTML<a href="javascript:void(0)" onclick="changeSide()" class="btn btn-success float-xs-right">Ekle</a></td>
                        </tr>
                        <tr>
                          <td>PHP<a href="javascript:void(0)" onclick="changeSide()" class="btn btn-success float-xs-right">Ekle</a></td>
                        </tr>
                        <tr>
                          <td>Android<a href="javascript:void(0)" onclick="changeSide()" class="btn btn-success float-xs-right">Ekle</a></td>
                        </tr>
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
                          <th>Rolü</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                          <td>Okan Uzun</td>
                          <td>Java Developer<a href="javascript:void(0)" onclick="changeSide()" class="btn btn-danger float-xs-right">Sil</a></td>
                        </tr>
                        <tr>
                          <td>Ali Kemal Öcalan</td>
                          <td>Java Developer<a href="javascript:void(0)" onclick="changeSide()" class="btn btn-danger float-xs-right">Sil</a></td>
                        </tr>
                        <tr>
                          <td>Burak Ermeydan</td>
                          <td>PHP Developer<a href="javascript:void(0)" onclick="changeSide()" class="btn btn-danger float-xs-right">Sil</a></td>
                        </tr>
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
                          <th>Rolü</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                          <td>Deniz Güzel</td>
                          <td>Android Developer<a href="javascript:void(0)" onclick="changeSide()" class="btn btn-success float-xs-right">Ekle</a></td>
                        </tr>
                        <tr>
                          <td>Ali Kemal Öcalan</td>
                          <td>Java Developer<a href="javascript:void(0)" onclick="changeSide()" class="btn btn-success float-xs-right">Ekle</a></td>
                        </tr>
                        <tr>
                          <td>Burak Ermeydan</td>
                          <td>PHP Developer<a href="javascript:void(0)" onclick="changeSide()" class="btn btn-success float-xs-right">Ekle</a></td>
                        </tr>
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
