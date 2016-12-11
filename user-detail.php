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

    $f_name  = $row["FIRST_NAME"];
    $l_name  = $row["LAST_NAME"];
    $u_id    = $row["U_ID"];
    $date_of_birth = $row["DATE_OF_BIRTH"];
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
          <form method="post">
            <div class="card-header">
              <div class="card-title">Kullanıcı Detay</div>
              <div class="card-buttons">
                <button type="submit" class="btn btn-success">Kaydet</button>
              </div>
            </div>
            <div class="card-block">
              <div class="row">
                <div class="col-xs-12 col-md-12 col-lg-6 mb-1">
                  <div class="row">
                    <div class="col-xs-12">
                      <div class="card-title">Departman Bilgileri</div>
                    </div>
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
                    <div class="col-xs-12">
                      <div class="card-title">Kişisel Bilgiler</div>
                    </div>
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
                    <div class="col-xs-12">
                      <div class="card-title">İletişim Bilgileri</div>
                    </div>
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
                <div class="col-xs-12 col-md-12 col-lg-6 mb-1">
                  <div class="card-title">
                    <span>Kayıtlı Yetenekler</span>
                    <div class="card-buttons">
                      <a href="javascript:void(0)" id="abilityShow" class="btn btn-primary">Yetenekleri Düzenle</a>
                    </div>
                  </div>
                  <div class="table-responsive">
                    <table class="table">
                      <thead>
                      <tr>
                        <th>Yetenek Adı</th>
                        <th>Seviye</th>
                        <th>Yetenek Adı</th>
                        <th>Seviye</th>
                      </tr>
                      </thead>
                      <tbody>
                      <tr>
                        <td>Java</td>
                        <td>İyi</td>
                        <td>PHP</td>
                        <td>İyi</td>
                      </tr>
                      <tr>
                        <td>Java</td>
                        <td>İyi</td>
                        <td>PHP</td>
                        <td>İyi</td>
                      </tr>
                      <tr>
                        <td>Java</td>
                        <td>İyi</td>
                        <td>PHP</td>
                        <td>İyi</td>
                      </tr>
                      <tr>
                        <td>Java</td>
                        <td>İyi</td>
                        <td>PHP</td>
                        <td>İyi</td>
                      </tr>
                      <tr>
                        <td>Java</td>
                        <td>İyi</td>
                        <td>PHP</td>
                        <td>İyi</td>
                      </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
                <div id="ability-container" class="col-xs-12 hidden"></div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

<?php include "footer.php"; ?>