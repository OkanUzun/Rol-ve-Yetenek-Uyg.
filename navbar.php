<nav class="navbar">
  <div class="container-fluid">
    <div class="navbar-collapse collapse in">
      <div class="navbar-left">
        <button class="sidebar-toggle" type="button"><i class="mdi mdi-menu"></i></button>
        <div class="dropdown">
          <button class="dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <?php echo $_SESSION["username"]; ?>
            <i class="mdi mdi-arrow-down-drop-circle-outline"></i>
          </button>
          <div class="dropdown-menu">
            <a class="dropdown-item" href="profile.php">Profil</a>
          </div>
        </div>
      </div>
      <div class="navbar-right">
        <a href="exit.php" class="exit" data-toggle="tooltip" data-placement="bottom" title="Çıkış Yap"><i class="mdi mdi-exit-to-app"></i></a>
      </div>
    </div>
  </div>
</nav>
