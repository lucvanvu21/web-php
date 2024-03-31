<nav style="background-color: rgba(6, 18, 30, 0.7); padding: 8px 0px 8px 0px;" class="layout_navbarWidescreen__DSXBH navbar is-fixed-top layout_navbar__1COmD" role="navigation" aria-label="Desktop navigation">
  <div class="container">
    <div class="navbar-brand">
      <a class="navbar-item" href="index.php?task=pagehome">
        <div class="layout_logoText__3aVvH">Phim Xưa</div>
      </a>
    </div>
    <div class="navbar-menu">
      <div class="navbar-start">

        <div class="navbar-item has-dropdown faq">
          <a class="navbar-link is-arrowless" href="index.php?task=pagemovie&category=1">Phim Hot</a>
        </div>
        <div class="navbar-item has-dropdown faq">
          <a class="navbar-link is-arrowless" href="index.php?task=pagemovie&category=2">Phim Lẻ</a>
        </div>
        <div class="navbar-item has-dropdown faq">
          <a class="navbar-link is-arrowless" href="index.php?task=pagemovie&category=3">Phim Bộ</a>
        </div>
        <div class="navbar-item has-dropdown faq">
          <a class="navbar-link is-arrowless" href="index.php?task=pagecontact">Liên Hệ</a>
        </div>
        <div class="navbar-item has-dropdown ">
          <div style="display: flex; align-items: center; padding-left:10px;">
            <form style="margin: 0px;" method="POST">
            <input type="hidden" name="form_type" value="user_search">

              <input required=""style="min-width: 250px; min-height: 35px; border-radius: 14px;" type="search" name="text_search" placeholder="   Tìm kiếm phim" aria-label="Search">
              <button style="cursor: pointer; min-height: 35px; border-radius: 14px; margin-left:10px" type="submit" name="search" value="user_search"><i class="fas fa-search"></i> Tìm
                kiếm</button>
            </form>
          </div>
        </div>
      </div>
      <div class="navbar-end">
        <div class=" navbar-link is-arrowless">
          <?php if (isset($_SESSION['name'])) {
            if ($_SESSION['level'] == 2) { ?>
              <a href="index.php?task=pagemanager" class="btn btn-outline-light menu"><?php echo $_SESSION['name'] ?></a>
              <a href="index.php?task=logout" class="btn btn-outline-light menu">Đăng xuất</a>
            <?php } elseif ($_SESSION['level'] == 1) { ?>
              <a href="" class="btn btn-outline-light menu"><?php echo $_SESSION['name'] ?></a>
              <a href="index.php?task=logout" class="btn btn-outline-light menu">Đăng xuất</a>
            <?php } ?>
          <?php } else { ?>
            <a href="index.php?task=pagelogin" class="btn btn-outline-light menu"> <i class="fas fa-user"></i>Tài khoản
            </a>
          <?php } ?>
        </div>
      </div>
    </div>
  </div>
</nav>