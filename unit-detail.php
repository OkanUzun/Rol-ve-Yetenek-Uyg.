<?php include "header.php"; ?>

  <div class="wrapper">
    <?php include "sidebar.php"; ?>
    <div class="page-content">
      <?php include "navbar.php"; ?>
      <div class="container-fluid">
        <div class="card">
          <div class="card-header">
            <div class="card-title">
              <div class="name">Ağ Birimi<div class="manager"><strong>Birim Yöneticisi:</strong> Deniz Güzel</div></div>
              <div class="date">
                <span><strong>Oluşturulma Tarihi:</strong> 21/11/2016</span>
                <span><strong>Düzenleme Tarihi:</strong> 22/11/2016</span>
              </div>
            </div>
          </div>
          <div class="card-block">
            <div class="row">
              <div class="col-lg-6 col-xl-4">
                <form method="post">
                  <ul class="list-group">
                    <li class="list-group-item">
                      <span class="tag tag-default float-xs-right">Çalışan Sayısı</span>
                      Kayıtlı Roller
                    </li>
                    <li class="list-group-item">
                      <span class="tag tag-default tag-pill float-xs-right">14</span>
                      <button type="submit" rel="tooltip" title="Detay">Android Developer</button>
                    </li>
                    <li class="list-group-item">
                      <span class="tag tag-default tag-pill float-xs-right">2</span>
                      <button type="submit" rel="tooltip" title="Detay">Java Developer</button>
                    </li>
                    <li class="list-group-item">
                      <span class="tag tag-default tag-pill float-xs-right">1</span>
                      <button type="submit" rel="tooltip" title="Detay">Php Developer</button>
                    </li>
                  </ul>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

<?php include "footer.php"; ?>