<?php include "header.php"; ?>

  <div class="wrapper">
    <?php include "sidebar.php"; ?>
    <div class="page-content">
      <?php include "navbar.php"; ?>
      <div class="container-fluid">
        <div class="card">
          <div class="card-header">
            <div class="card-title">
              Bilişim Departmanı
              <div class="manager"><strong>Departman Müdürü:</strong> Deniz Güzel</div>
              <div class="date"><strong>Oluşturulma Tarihi:</strong> 21/11/2016</div>
            </div>
          </div>
          <div class="card-block">
            <table class="table" id="dataTable-detail">
              <thead>
              <tr>
                <th>Kayıtlı Birimler</th>
                <th>Çalışan Sayısı</th>
              </tr>
              </thead>
              <tbody>
              <tr>
                <td>Ağ Birimi</td>
                <td>2</td>
              </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>

<?php include "footer.php"; ?>