<?php include "header.php"; ?>

  <div class="wrapper">
    <?php include "sidebar.php"; ?>
    <div class="page-content">
      <?php include "navbar.php"; ?>
      <div class="container-fluid">
        <div class="card">
          <div class="card-header">
            <div class="card-title">
              <div class="name">Bilişim Departmanı<div class="manager"><strong>Departman Müdürü:</strong> Deniz Güzel</div></div>
              <div class="date">
                <span><strong>Oluşturulma Tarihi:</strong> 21/11/2016</span>
                <span><strong>Düzenleme Tarihi:</strong> 22/11/2016</span>
              </div>
            </div>
          </div>
          <div class="card-block">
            <div class="row">
              <div class="col-lg-6 col-xl-4">
                <ul class="list-group">
                  <li class="list-group-item">
                    <span class="tag tag-default float-xs-right">Çalışan Sayısı</span>
                    Kayıtlı Birimler
                  </li>
                  <li class="list-group-item">
                    <span class="tag tag-default tag-pill float-xs-right">14</span>
                    <a href="unit-detail.php" rel="tooltip" title="Detay">Ağ Birimi</a>
                  </li>
                  <li class="list-group-item">
                    <span class="tag tag-default tag-pill float-xs-right">2</span>
                    <a href="unit-detail.php" rel="tooltip" title="Detay">Yazılım Birimi</a>
                  </li>
                  <li class="list-group-item">
                    <span class="tag tag-default tag-pill float-xs-right">1</span>
                    <a href="unit-detail.php" rel="tooltip" title="Detay">Teknik Destek Birimi</a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

<?php include "footer.php"; ?>