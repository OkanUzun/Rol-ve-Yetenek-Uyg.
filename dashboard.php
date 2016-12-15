<?php
  include 'header.php';
  include "dbsettings.php";

  //if (isset($_POST["user_login"])) {
  $sql              = '
    SELECT COUNT(*) AS X FROM T_USER';
  $stmt             = oci_parse($conn, $sql);
  $r                = oci_execute($stmt);
  $row              = oci_fetch_assoc($stmt);
  $number_of_person = $row["X"];

  $sql                  = '
    SELECT COUNT(*) AS X FROM T_DEPARTMENT';
  $stmt                 = oci_parse($conn, $sql);
  $r                    = oci_execute($stmt);
  $row                  = oci_fetch_assoc($stmt);
  $number_of_department = $row["X"];

  $sql            = '
    SELECT COUNT(*) AS X FROM T_UNIT';
  $stmt           = oci_parse($conn, $sql);
  $r              = oci_execute($stmt);
  $row            = oci_fetch_assoc($stmt);
  $number_of_unit = $row["X"];

  $sql            = '
    SELECT COUNT(*) AS X FROM T_ROLE';
  $stmt           = oci_parse($conn, $sql);
  $r              = oci_execute($stmt);
  $row            = oci_fetch_assoc($stmt);
  $number_of_role = $row["X"];

  $sql               = '
    SELECT COUNT(*) AS X FROM T_ABILITY';
  $stmt              = oci_parse($conn, $sql);
  $r                 = oci_execute($stmt);
  $row               = oci_fetch_assoc($stmt);
  $number_of_ability = $row["X"];

  $sql                 = '
    SELECT COUNT(*) AS X FROM T_EDUCATION';
  $stmt                = oci_parse($conn, $sql);
  $r                   = oci_execute($stmt);
  $row                 = oci_fetch_assoc($stmt);
  $number_of_education = $row["X"];
  //}  
?>
  <div class="wrapper">
    <?php include "sidebar.php"; ?>
    <div class="page-content">
      <?php include "navbar.php"; ?>
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-6 col-lg-4 col-xl-4">
            <a href="user.php" class="card card-green">
              <div class="card-block no-padding">
                <div class="card-body">
                  <i class="mdi mdi-account-multiple text-green"></i>
                  <div class="content">
                    <div class="title">Personel Sayısı</div>
                    <div class="value text-green"><?php echo $number_of_person ?></div>
                  </div>
                </div>
              </div>
            </a>
          </div>
          <div class="col-md-6 col-lg-4 col-xl-4">
            <a href="department-create.php" class="card card-purple">
              <div class="card-block no-padding">
                <div class="card-body">
                  <i class="mdi mdi-library text-purple"></i>
                  <div class="content">
                    <div class="title">Departmanlar</div>
                    <div class="value text-purple"><?php echo $number_of_department ?></div>
                  </div>
                </div>
              </div>
            </a>
          </div>
          <div class="col-md-6 col-lg-4 col-xl-4">
            <a href="unit-create.php" class="card card-pink">
              <div class="card-block no-padding">
                <div class="card-body">
                  <i class="mdi mdi-library-books text-pink"></i>
                  <div class="content">
                    <div class="title">Birimler</div>
                    <div class="value text-pink"><?php echo $number_of_unit ?></div>
                  </div>
                </div>
              </div>
            </a>
          </div>
          <div class="col-md-6 col-lg-4 col-xl-4">
            <a href="role-create.php" class="card card-deep-purple">
              <div class="card-block no-padding">
                <div class="card-body">
                  <i class="mdi mdi-account-check text-deep-purple"></i>
                  <div class="content">
                    <div class="title">Roller</div>
                    <div class="value text-deep-purple"><?php echo $number_of_role ?></div>
                  </div>
                </div>
              </div>
            </a>
          </div>
          <div class="col-md-6 col-lg-4 col-xl-4">
            <a href="ability-create.php" class="card card-indigo">
              <div class="card-block no-padding">
                <div class="card-body">
                  <i class="mdi mdi-account-star-variant text-indigo"></i>
                  <div class="content">
                    <div class="title">Yetenekler</div>
                    <div class="value text-indigo"><?php echo $number_of_ability ?></div>
                  </div>
                </div>
              </div>
            </a>
          </div>
          <div class="col-md-6 col-lg-4 col-xl-4">
            <a href="course.php" class="card card-blue">
              <div class="card-block no-padding">
                <div class="card-body">
                  <i class="mdi mdi-book-open-page-variant text-blue"></i>
                  <div class="content">
                    <div class="title">Eğitimler</div>
                    <div class="value text-blue"><?php echo $number_of_education ?></div>
                  </div>
                </div>
              </div>
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php include 'footer.php' ?>