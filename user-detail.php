<?php
  include "header.php";
  include "dbsettings.php";

  if (isset($_GET["user_id"])) {
    $user_id = $_GET["user_id"];
    $sql = '
    SELECT T_USER.FIRST_NAME,T_USER.LAST_NAME,T_USER.U_ID,T_USER.DATE_OF_BIRTH,T_USER.EMAIL,T_USER.PHONE_NUMBER,T_USER.ADDRESS
    FROM T_USER
    WHERE PK = '.$user_id.'';
    $stmt = oci_parse($conn, $sql);
    $r = oci_execute($stmt);
    $row = oci_fetch_assoc($stmt);

    $f_name = $row["FIRST_NAME"];
    $l_name = $row["LAST_NAME"];
    $u_id   = $row["U_ID"];

    $date = DateTime::createFromFormat("d#M#y", $row["DATE_OF_BIRTH"]);
    $date_of_birth = $date->format('d/m/Y');

    $email   = $row["EMAIL"];
    $address = $row["ADDRESS"];
    $phone   = $row["PHONE_NUMBER"];
    //$cr_time = $row["CREATION_TIME"];
    //$md_time = $row["MODIFIED_TIME"];
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
                <a class="nav-link" data-toggle="tab" href="#info">Bilgiler</a>
              </li>
              <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#skill">Yetenekler</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#course">Eğitimler</a>
              </li>
            </ul>

            <div class="tab-content">
              <div class="tab-pane fade" id="info">
                <form method="post">
                  <div class="row">
                    <div class="col-xs-12">
                      <div class="card-title">Kullanıcı Bilgileri
                        <button type="submit" class="btn btn-success">Kaydet</button>
                      </div>
                    </div>
                    <div class="col-xs-12 col-md-12 col-lg-6 mb-1">
                      <div class="row">
                        <div class="col-xs-12 col-xl-6">
                          <div class="form-group">
                            <select class="form-control selectpicker" data-live-search="true" data-size="5" title="Departman Seçiniz">
                              <option value="Bilişim Departmanı">Bilişim Departmanı</option>
                            </select>
                          </div>
                        </div>
                        <div class="col-xs-12 col-xl-6">
                          <div class="form-group">
                            <select class="form-control selectpicker" data-live-search="true" data-size="5" title="Birim Seçiniz">
                              <option value="Yazılım Birimi">Yazılım Birimi</option>
                            </select>
                          </div>
                        </div>
                        <div class="col-xs-12 col-xl-6">
                          <div class="form-group">
                            <select class="form-control selectpicker" data-live-search="true" data-size="5" title="Rol Seçiniz">
                              <option value="Android Developer">Android Developer</option>
                            </select>
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
              <div class="tab-pane fade in active" id="skill">
                <form method="post">
                  <div class="row">
                    <div class="col-xs-12">
                      <div class="card-title">Yetenekler
                        <button type="submit" class="btn btn-success" disabled>Kaydet</button>
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
                          <tr>
                            <td>Java</td>
                            <td>Orta<a href="javascript:void(0)" onclick="changeSide()" class="btn btn-danger float-xs-right">Sil</a></td>
                          </tr>
                          <tr>
                            <td>PHP</td>
                            <td>İyi<a href="javascript:void(0)" onclick="changeSide()" class="btn btn-danger float-xs-right">Sil</a></td>
                          </tr>
                          <tr>
                            <td>Javascript</td>
                            <td>Kötü<a href="javascript:void(0)" onclick="changeSide()" class="btn btn-danger float-xs-right">Sil</a></td>
                          </tr>

                          <?php
                            /*include "dbsettings.php";
                            $sql  = 'SELECT T_ABILITY.ABILITY_NAME AS AN,T_ABILITY_LEVEL.LEVEL_NAME AS LN
                        FROM T_USER_ABILITY_REL,T_ABILITY,T_ABILITY_LEVEL
                        WHERE
                        T_USER_ABILITY_REL.ABILITY_FK = T_ABILITY.PK
                        AND
                        T_USER_ABILITY_REL.ABILITY_LEVEL_FK = T_ABILITY_LEVEL.PK AND
                        T_USER_ABILITY_REL.USER_FK = '.$user_id.'';
                            $stmt = oci_parse($conn, $sql);
                            $r    = oci_execute($stmt);
                            while ($row = oci_fetch_array($stmt, OCI_RETURN_NULLS + OCI_ASSOC)) {
                              echo '<tr>';
                              echo '<td>'.$row['AN'].'</td>';
                              echo '<td>'.$row['LN'].'</td>';
                              echo '</tr>';
                            }*/
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
                            <td>Javascript</td>
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
                          <tr>
                            <td>Mysql</td>
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
                          <tr>
                            <td>Ios</td>
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
                          <tr>
                            <td>Android</td>
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
                          <tr>
                            <td>Ajax</td>
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
                    <tr>
                      <td>Java Eğitimi</td>
                      <td>Okan Uzun</td>
                      <td>17/12/2016</td>
                      <td>21/12/2016</td>
                      <td>Planlandı</td>
                    </tr>
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