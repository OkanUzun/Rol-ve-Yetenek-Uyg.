<?php 
  include "header.php";
  include "dbsettings.php";

  
    $sql = "
    SELECT T_USER.FIRST_NAME,T_USER.LAST_NAME,T_USER.U_ID,T_USER.DATE_OF_BIRTH,T_USER.EMAIL,T_USER.PHONE_NUMBER,T_USER.ADDRESS
    FROM T_USER
    WHERE T_USER.U_ID = '".$_SESSION['username']."'";

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
  
 

  if (isset($_POST["change-pw"])) {
    $sql  = 'BEGIN SP_UPDATE_PASSWORD(:usr_id,:new_pw,:is_valid); END;';
    $stmt = oci_parse($conn, $sql);

    oci_bind_by_name($stmt, ':usr_id', $user_id);
    oci_bind_by_name($stmt, ':new_pw', $new_pw);
    oci_bind_by_name($stmt, ':is_valid', $message);

    $user_id    = $_SESSION["username"];
    $new_pw  = md5($_POST["new_pw"]);

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
              <div class="card-title">Profil Bilgileri</div>
              <button type="submit" class="btn btn-success" name="update-information">Kaydet</button>
            </div>
            <div class="card-block">
              <div class="row">
                <div class="col-xs-12 col-xl-6 mb-1">
                  <div class="row">
                    <div class="col-xs-12">
                      <div class="card-title">Kişisel Bilgiler<a href="#" class="btn btn-primary" data-toggle="modal" data-target="#passwordModal">Şifremi Değiştir</a></div>
                    </div>
                    <div class="col-xs-12 col-md-6">
                      <div class="form-group">
                        <input type="text" value=<?php echo $f_name ?> class="form-control" placeholder="İsim" name="f_name" id="stepName" required>
                      </div>
                    </div>
                    <div class="col-xs-12 col-md-6">
                      <div class="form-group">
                        <input type="text" value=<?php echo $l_name ?> class="form-control" placeholder="Soyisim" name="l_name" id="stepSurname" required>
                      </div>
                    </div>
                    <div class="col-xs-12 col-md-6">
                      <div class="form-group">
                        <input type="text" value=<?php echo $u_id ?> class="form-control" placeholder="Kullanıcı Adı" name="u_name" id="stepUsername" required>
                      </div>
                    </div>
                    <div class="col-xs-12 col-md-6">
                      <div class="form-group">
                        <input type="text" value=<?php echo $date_of_birth ?> data-provide="datepicker" class="form-control datepicker" placeholder="Doğum Tarihi" name="date_of_birth" id="stepBirthdate" required>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-xs-12 col-xl-6 mb-1">
                  <div class="row">
                    <div class="col-xs-12">
                      <div class="card-title">İletişim Bilgileri</div>
                    </div>
                    <div class="col-xs-12 col-md-6">
                      <div class="form-group">
                        <input type="email" value=<?php echo $email ?> class="form-control" placeholder="E-mail" name="e_mail" id="stepEmail" required>
                      </div>
                    </div>
                    <div class="col-xs-12 col-md-6">
                      <div class="form-group">
                        <input type="number" value=<?php echo $phone ?> class="form-control" placeholder="Mobil Telefon No" name="phone_num" id="stepTel" required>
                      </div>
                    </div>
                    <div class="col-xs-12">
                      <div class="form-group">
                        <textarea rows="5" class="form-control" placeholder="Adres..." name="address" id="stepAddress"><?php echo $address ?></textarea>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="passwordModal" tabindex="-1" role="dialog" aria-labelledby="passwordModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <i class="mdi mdi-close"></i>
          </button>
          <h4 class="modal-title" id="passwordModalLabel">Şifremi Değiştir</h4>
        </div>
        <form method="post">
          <div class="modal-body">
            <div class="form-group">
              <input type="password" class="form-control" name="new_pw" id="new_password" placeholder="Yeni Şifreniz">
            </div>
            <div class="form-group">
              <input type="password" class="form-control" name="new_pw_again" id="new_password_again" placeholder="Yeni Şifreniz Tekrar">
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Kapat</button>
            <button type="submit" class="btn btn-success" name="change-pw">Değiştir</button>
          </div>
        </form>
      </div>
    </div>
  </div>

<?php include "footer.php"; ?>