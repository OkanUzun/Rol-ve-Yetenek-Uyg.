<?php include "header.php"; ?>

  <div class="wrapper">
    <?php include "sidebar.php"; ?>
    <div class="page-content">
      <?php include "navbar.php"; ?>
      <div class="container-fluid">
        <div class="card">
          <div class="card-header">
            <div class="card-title">
              <div class="name">Ağ Birimi</div>
              <div class="date">
                <span><strong>Oluşturulma Tarihi:</strong> 21/11/2016</span>
                <span><strong>Düzenleme Tarihi:</strong> 22/11/2016</span>
              </div>
            </div>
          </div>
          <div class="card-block">
            <table class="table">
              <thead>
              <tr>
                <th>Kayıtlı Roller</th>
                <th>Çalışan Sayısı</th>
                <th>Detay</th>
              </tr>
              </thead>
              <tbody>
              <tr>
                <td>Android Developer</td>
                <td>4</td>
                <td class="text-xs-center"><a href="role-detail.php" class="table-icon" rel="tooltip" title="Detay"><i class="mdi mdi-magnify"></i></a></td>
              </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>

<?php include "footer.php"; ?>