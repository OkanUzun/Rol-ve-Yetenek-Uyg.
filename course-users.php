<?php include "header.php"; ?>

<div class="wrapper">
  <?php include "sidebar.php"; ?>
  <div class="page-content">
    <?php include "navbar.php"; ?>
    <div class="container-fluid">
      <div class="card">
        <div class="card-header">
          <div class="card-title">Eğitim Katılımcıları</div>
          <a href="javascript:void(0)" id="courseAddUserButton" class="btn btn-success">Katılımcı Ekle</a>
        </div>
        <form method="post">
          <div class="card-block">
            <div class="card-title">Kayıtlı Katılımcılar</div>
            <table class="table" id="dataTable-courseusers">
              <thead>
              <tr>
                <th>Çalışan</th>
                <th>Yetenek</th>
                <th>Seviye</th>
                <th>İşlemler</th>
              </tr>
              </thead>
              <tbody>
              <tr>
                <td>Okan Uzun</td>
                <td>Java</td>
                <td>Kötü</td>
                <td class="text-xs-center">
                  <button type="submit" class="btn btn-danger">Çıkar</button>
                </td>
              </tr>
              </tbody>
            </table>
            <div id="courseAddUser" class="hidden"></div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<?php include "footer.php"; ?>
