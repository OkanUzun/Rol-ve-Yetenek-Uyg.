<?php
  include 'header.php';
  include "dbsettings.php";

  function count_of_entity($table_name,$conn){
    $sql              = 'SELECT COUNT(*) AS X FROM '.$table_name.'';
    $stmt             = oci_parse($conn, $sql);
    $r                = oci_execute($stmt);
    $row              = oci_fetch_assoc($stmt);
    return $row["X"];
  }

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
                    <div class="value text-green"><?php echo count_of_entity("T_USER",$conn) ?></div>
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
                    <div class="value text-purple"><?php echo count_of_entity("T_DEPARTMENT",$conn) ?></div>
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
                    <div class="value text-pink"><?php echo count_of_entity("T_UNIT",$conn) ?></div>
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
                    <div class="value text-deep-purple"><?php echo count_of_entity("T_ROLE",$conn) ?></div>
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
                    <div class="value text-indigo"><?php echo count_of_entity("T_ABILITY",$conn) ?></div>
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
                    <div class="value text-blue"><?php echo count_of_entity("T_EDUCATION",$conn) ?></div>
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