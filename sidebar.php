<?php
  function contain_page($page_link)
  {
    if ((strpos($_SERVER['REQUEST_URI'], $page_link)) !== false) {
      return "active";
    }
    else
      return "";
  }

?>
<div class="side-navigation mCustomScrollbar">
  <div class="sidebar-header">
    <a class="sidebar-brand" href="dashboard.php" title="Ana Sayfa"><span class="highlight">Roleaby v1</span></a>
    <button type="button" class="close"><i class="mdi mdi-close"></i></button>
  </div>
  <div class="sidebar-menu">
    <ul>
      <li class="search">
        <form method="post">
          <input type="text" class="form-control" placeholder="Arama Yapın">
          <button type="submit"><i class="mdi mdi-magnify"></i></button>
        </form>
      </li>
      <li class="<?php print(contain_page('dashboard.php')) ?>">
        <a href="dashboard.php">
          <div class="icon"><i class="mdi mdi-view-dashboard"></i></div>
          <div class="title">Ana Sayfa</div>
        </a>
      </li>
      <li class="<?php print(contain_page('user.php')) ?>">
        <a href="user.php">
          <div class="icon"><i class="mdi mdi-account-multiple"></i></div>
          <div class="title">Kullanıcılar</div>
        </a>
      </li>
      <li class="<?php print(contain_page('department-create.php')) ?>">
        <a href="department-create.php">
          <div class="icon"><i class="mdi mdi-library"></i></div>
          <div class="title">Departmanlar</div>
        </a>
      </li>
      <li class="<?php print(contain_page('unit-create.php')) ?>">
        <a href="unit-create.php">
          <div class="icon"><i class="mdi mdi-library-books"></i></div>
          <div class="title">Birimler</div>
        </a>
      </li>
      <li class="<?php print(contain_page('role-create')) ?>">
        <a href="role-create.php">
          <div class="icon"><i class="mdi mdi-account-check"></i></div>
          <div class="title">Roller</div>
        </a>
      </li>
      <li class="<?php print(contain_page('ability-create')) ?>">
        <a href="ability-create.php">
          <div class="icon"><i class="mdi mdi-account-star-variant"></i></div>
          <div class="title">Yetenekler</div>
        </a>
      </li>
      <li class="<?php print(contain_page('course.php')) ?>">
        <a href="course.php">
          <div class="icon"><i class="mdi mdi-book-open-page-variant"></i></div>
          <div class="title">Eğitimler</div>
        </a>
      </li>
      <li class="<?php print(contain_page('course-instructor.php')) ?>">
        <a href="course-instructor.php">
          <div class="icon"><i class="mdi mdi-account-switch"></i></div>
          <div class="title">Eğitmenler</div>
        </a>
      </li>
      <li class="<?php print(contain_page('search.php')) ?>">
        <a href="search.php">
          <div class="icon"><i class="mdi mdi-account-search"></i></div>
          <div class="title">Arama</div>
        </a>
      </li>
      <li class="<?php print(contain_page('statistics.php')) ?>">
        <a href="statistics.php">
          <div class="icon"><i class="mdi mdi-chart-bar"></i></div>
          <div class="title">İstatistikler</div>
        </a>
      </li>
      <li class="exit">
        <a href="exit.php">
          <div class="icon"><i class="mdi mdi-exit-to-app"></i></div>
          <div class="title">Çıkış Yap</div>
        </a>
      </li>
    </ul>
  </div>
</div>
