<?php
  include "header.php";
  include "dbsettings.php";

  function randomPassword()
  {
    $alphabet    = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
    $pass        = array();
    $alphaLength = strlen($alphabet) - 1;
    for ($i = 0; $i < 8; $i++) {
      $n      = rand(0, $alphaLength);
      $pass[] = $alphabet[ $n ];
    }
    return implode($pass);
  }

  if (isset($_POST["create-user"])) {
    $sql  = 'BEGIN SP_CREATE_USER(:usr_id,:usr_pw,:e_mail,:fname,:lname,:dte_of_birth,:phne_num,:addrss,:rle_id,:unt_id,:dep_id,:is_valid); END;';
    $stmt = oci_parse($conn, $sql);


    oci_bind_by_name($stmt, ':usr_id', $user_id);
    oci_bind_by_name($stmt, ':usr_pw', $user_pw);
    oci_bind_by_name($stmt, ':e_mail', $e_mail);
    oci_bind_by_name($stmt, ':fname', $f_name);
    oci_bind_by_name($stmt, ':lname', $l_name);
    oci_bind_by_name($stmt, ':dte_of_birth', $date_of_birth);
    oci_bind_by_name($stmt, ':phne_num', $phone_number);
    oci_bind_by_name($stmt, ':addrss', $address);
    oci_bind_by_name($stmt, ':rle_id', $role_id);
    oci_bind_by_name($stmt, ':unt_id', $unit_id);
    oci_bind_by_name($stmt, ':dep_id', $dep_id);
    oci_bind_by_name($stmt, ':is_valid', $message);


    $r_pw = randomPassword();

    $user_id       = $_POST["u_name"];
    $user_pw       = md5($r_pw);
    $e_mail        = $_POST["e_mail"];
    $f_name        = $_POST["f_name"];
    $l_name        = $_POST["l_name"];
    $date_of_birth = $_POST["date_of_birth"];
    $phone_number  = $_POST["phone_number"];
    $address       = $_POST["address"];
    $role_id       = $_POST["role_id"];
    $unit_id       = $_POST["unit_id"];
    $dep_id        = $_POST["dep_id"];


    oci_execute($stmt);
    if ($message == 1){
      require 'mail-config.php';
      ob_start();
      require_once('email.php');
      $mail->addAddress($e_mail, $f_name.' '.$l_name);
      $mail->Subject = 'ROLEABY KULLANICI ŞİFRESİ';
      $mail->Body    = ob_get_clean();

      if(!$mail->send()) {
        //echo 'Message could not be sent.';
        //echo 'Mailer Error: ' . $mail->ErrorInfo;
      } else {
        //echo 'Message has been sent';
      }
    }

    
  }
?>

  <div class="wrapper">
    <?php include "sidebar.php"; ?>
    <div class="page-content">
      <?php include "navbar.php"; ?>
      <div class="container-fluid">
        <div class="card">
          <form id="formValidate" method="post">
            <div class="card-header">
              <div class="card-title">Kullanıcı Tanımlama</div>
              <div class="card-buttons">
                <button type="submit" class="btn btn-success" name="create-user">Kaydet</button>
              </div>
            </div>
            <div class="card-block">
              <div class="row">
                <div class="col-xs-12 col-md-12 col-lg-6 mb-1">
                  <div class="row">
                    <div class="col-xs-12">
                      <div class="card-title">Meslek Bilgisi</div>
                    </div>
                    <div class="col-xs-12 col-xl-6">
                      <div class="form-group">
                        <?php
                          include "dbsettings.php";
                          $sql  = 'SELECT PK,DEPARTMENT_NAME FROM T_DEPARTMENT';
                          $stmt = oci_parse($conn, $sql);
                          $r    = oci_execute($stmt);
                          echo '<select name="dep_id" class="form-control selectpicker" data-live-search="true" data-size="5" title="Departman Seçiniz">';
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
                          include "dbsettings.php";
                          $sql  = 'SELECT PK,UNIT_NAME FROM T_UNIT';
                          $stmt = oci_parse($conn, $sql);
                          $r    = oci_execute($stmt);
                          echo '<select name="unit_id" class="form-control selectpicker" data-live-search="true" data-size="5" title="Birim Seçiniz">';
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
                          include "dbsettings.php";
                          $sql  = 'SELECT PK,ROLE_NAME FROM T_ROLE';
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
                    <div class="col-xs-12">
                      <div class="card-title">Kişisel Bilgiler</div>
                    </div>
                    <div class="col-xs-12 col-md-6">
                      <div class="form-group">
                        <input type="text" class="form-control" placeholder="İsim" name="f_name" required>
                      </div>
                    </div>
                    <div class="col-xs-12 col-md-6">
                      <div class="form-group">
                        <input type="text" class="form-control" placeholder="Soyisim" name="l_name" required>
                      </div>
                    </div>
                    <div class="col-xs-12 col-md-6">
                      <div class="form-group">
                        <input type="text" class="form-control" placeholder="Kullanıcı Adı" name="u_name" required>
                      </div>
                    </div>
                    <div class="col-xs-12 col-md-6">
                      <div class="form-group">
                        <input type="text" data-provide="datepicker" class="form-control datepicker" placeholder="Doğum Tarihi" name="date_of_birth" required>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-xs-12 col-md-12 col-lg-12 col-xl-6">
                  <div class="row">
                    <div class="col-xs-12">
                      <div class="card-title">İletişim Bilgileri</div>
                    </div>
                    <div class="col-sm-12 col-md-6">
                      <div class="form-group">
                        <input type="email" class="form-control" placeholder="E-mail" name="e_mail" required>
                      </div>
                    </div>
                    <div class="col-sm-12 col-md-6">
                      <div class="form-group">
                        <input type="number" class="form-control" placeholder="Mobil Telefon No" name="phone_number" required>
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="form-group">
                        <textarea rows="5" class="form-control" placeholder="Adres..." name="address" required></textarea>
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

<?php include "footer.php"; ?>