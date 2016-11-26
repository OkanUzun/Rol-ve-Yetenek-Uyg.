<?php include 'header.php' ?>

  <div class="wrapper">
    <?php include "sidebar.php"; ?>
    <div class="page-content">
      <?php include "navbar.php"; ?>
      <div class="container-fluid">
        <div class="card mb-0">
          <div class="card-header">
            <a href="user-create.php" class="btn btn-info"><i class="mdi mdi-account-multiple"></i>Kullanıcı Oluştur</a>
          </div>
          <div class="card-block">
            <table class="table" id="dataTable-user">
              <thead>
              <tr>
                <th>Ad</th>
                <th>Soyad</th>
                <th>Rol</th>
                <th>Birim</th>
                <th>Departman</th>
                <th>Detay</th>
              </tr>
              </thead>
              <tbody>
              <tr>
                <td>Okan</td>
                <td>Uzun</td>
                <td>Bilgisayar Mühendisi</td>
                <td>Yazılım Birimi</td>
                <td>Bilişim Departmanı</td>
                <td class="text-xs-center">
                  <a href="" class="table-icon" data-toggle="tooltip" data-placement="bottom" title="Görüntüle"><i class="mdi mdi-magnify"></i></a>
                </td>
              </tr>
              <tr>
                <td>Okan</td>
                <td>Uzun</td>
                <td>Bilgisayar Mühendisi</td>
                <td>Yazılım Birimi</td>
                <td>Bilişim Departmanı</td>
                <td class="text-xs-center">
                  <a href="" class="table-icon" data-toggle="tooltip" data-placement="bottom" title="Görüntüle"><i class="mdi mdi-magnify"></i></a>
                </td>
              </tr>
              <tr>
                <td>Okan</td>
                <td>Uzun</td>
                <td>Bilgisayar Mühendisi</td>
                <td>Yazılım Birimi</td>
                <td>Bilişim Departmanı</td>
                <td class="text-xs-center">
                  <a href="" class="table-icon" data-toggle="tooltip" data-placement="bottom" title="Görüntüle"><i class="mdi mdi-magnify"></i></a>
                </td>
              </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>

<?php include 'footer.php' ?>