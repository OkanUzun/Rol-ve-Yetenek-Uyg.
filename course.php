<?php include "header.php"; ?>

  <div class="wrapper">
    <?php include "sidebar.php"; ?>
    <div class="page-content">
      <?php include "navbar.php"; ?>
      <div class="container-fluid">
        <div class="card">
          <div class="card-header">
            <a href="course-create.php" class="btn btn-info"><i class="mdi mdi-plus"></i>Eğitim Oluştur</a>
          </div>
          <div class="card-block">
            <table class="table" id="dataTable">
              <thead>
              <tr>
                <th>Eğitim Adı</th>
                <th>Eğitim İçeriği</th>
                <th>Eğitmen</th>
                <th>Eğitim Başlangıç Tarihi</th>
                <th>Eğitim Bitiş Tarihi</th>
                <th>Durum</th>
                <th>Eğitim Detayı</th>
              </tr>
              </thead>
              <tbody>
              <tr>
                <td>Java Eğitimi</td>
                <td>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</td>
                <td>Deniz Güzel</td>
                <td>02/02/2016</td>
                <td>04/02/2016</td>
                <td class="text-xs-center">
                  <div class="course-status">
                    <span class="wait hidden">Beklemede<i class="mdi mdi-timer"></i></span>
                    <span class="on hidden">Devam Ediyor<i class="mdi mdi-timer-sand"></i></span>
                    <span class="off hidden">Sona Erdi<i class="mdi mdi-check"></i></span>
                    <span class="cancel">İptal Edildi<i class="mdi mdi-timer-off"></i></span>
                  </div>
                </td>
                <td class="table-icon"><a href="course-detail.php" rel="tooltip" title="Detay"><i class="mdi mdi-magnify"></i></a></td>
              </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>

<?php include "footer.php"; ?>