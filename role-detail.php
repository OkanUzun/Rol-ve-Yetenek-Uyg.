<?php include "header.php"; ?>

  <div class="wrapper">
    <?php include "sidebar.php"; ?>
    <div class="page-content">
      <?php include "navbar.php"; ?>
      <div class="container-fluid">
        <div class="card">
          <div class="card-header">
            <div class="card-title">
              <div class="name">Android Developer</div>
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
                    <span class="tag tag-default float-xs-right">Birim / Departman</span>
                    Kayıtlı Kullanıcılar
                  </li>
                  <li class="list-group-item">
                    <span class="tag tag-default tag-pill float-xs-right">Yazılım Birimi / Bilişim Departmanı</span>
                    <a href="user-detail.php" rel="tooltip" title="Detay">Okan Uzun</a>
                  </li>
                  <li class="list-group-item">
                    <span class="tag tag-default tag-pill float-xs-right">Yazılım Birimi / Bilişim Departmanı</span>
                    <a href="user-detail.php" rel="tooltip" title="Detay">Deniz Güzel</a>
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