<!DOCTYPE html>
<html lang="en">
<?php require_once "Controllers/Admin.php" ?>

<head>

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>


  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

  <!-- <link href="Templates/bootstrap/bootstrap.css" rel="stylesheet">
  <script src="Templates/bootstrap/bootstrap.bundle.js"></script>
  <script src="Templates/bootstrap/bootstrap.js"></script> -->
  <link rel="stylesheet" href="Templates/Css/css.css">
<<<<<<< HEAD
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
  

=======
>>>>>>> 6736f380c0428d1560f0fdd5def1bb74a3b0c6df
</head>
<script>
  function showLoadingMessage() {
    document.getElementById('loadingMessage').style.display = 'block';
  }
</script>


<body>
  <style>
    .form-btn {
      width: 100%;
      display: inline-block;
      font-size: inherit;
      line-height: inherit;
      text-decoration: none;
      color: inherit;
      border: none;
      background-color: transparent;
      cursor: pointer;
    }
  </style>

  <nav>

    <div id="loadingMessage" style="display: none;">Đang cập nhật URL. Vui lòng đợi...</div>

    <div style="display: flex; justify-content:space-around;padding-top: 30px;">
      <div><a href="index.php?task=pagemanager" class="btn btn-outline-light menu">Trang chủ</a></div>
      <div>
        <?php if (isset($_SESSION['name'])) {
          if ($_SESSION['level'] == 2) { ?>
            <a href="index.php?task=pagemanager" class="btn btn-outline-light menu"><?php echo $_SESSION['name'] ?></a>
            <a href="index.php?task=logout" class="btn btn-outline-light menu">Đăng xuất</a>
          <?php } elseif ($_SESSION['level'] == 1) { ?>
            <a href="" class="btn btn-outline-light menu"><?php echo $_SESSION['name'] ?></a>
            <a href="index.php?task=logout" class="btn btn-outline-light menu">Đăng xuất</a>
          <?php } ?>
        <?php } else { ?>
          <a href="index.php?task=pagelogin" class="btn btn-outline-light menu"> <i class="fas fa-user"></i>Tài khoản </a>
        <?php } ?>
      </div>
    </div>
  </nav>


  <div class="">
    <div style="margin: 104px 10px 30px 10px;">

      <div class="row mt-3" style="min-height: 300px;">
        <div class="col-lg-2">

          <h1 style="text-align: center;">Quản lý</h1>
          <div style="text-align: center;" class="list-group">
            <a class="list-group-item menu list-group-item-action" href="index.php?task=pagemanager">Quản lý thành viên</a>
            <a class="list-group-item menu list-group-item-action" href="index.php?task=pagemovieforadmin">Quản lý phim</a>
            <form class=" list-group-item menu " action="" method="post" onsubmit="showLoadingMessage()">
              <button class="form-btn" type="submit" name="update_url">Cập nhật link phim lẻ tự động </button>
            </form>
            <form class=" list-group-item menu " action="" method="post" onsubmit="showLoadingMessage()">
              <button class="form-btn" type="submit" name="update_url_e">Cập nhật link phim bộ tự động </button>
            </form>
          </div>
        </div>
        <div class="col-lg-10">
          <div>
            <ul class="nav nav-tabs" role="tablist">
              <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#listuser">Danh sách thành viên</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#addmember">Thêm thành viên</a>
              </li>
            </ul>
          </div>
          <div class="tab-content">
            <div id="listuser" class="container tab-pane active">
              <!--Danh sach thanh vien-->
              <h3 class="text-center">Danh sách thành viên</h3>
              <div class="text-center">
                <table class="table text-center w-100">
                  <tr>
                    <th>ID</th>
                    <th>Họ tên</th>
                    <th>Email</th>
                    <th>Mật khẩu</th>
                    <th>Ngày tạo tài khoản</th>
                    <th>Xóa</th>
                  </tr>
                  <?php
                  while ($row = mysqli_fetch_assoc($listUser)) { ?>
                    <tr>
                      <td><?php echo $row['user_id'] ?></td>
                      <td><?php echo $row['name'] ?></td>
                      <td><?php echo $row['email'] ?></td>
                      <td><?php echo $row['password'] ?></td>
                      <td><?php echo $row['createdAt'] ?></td>
                      <td><a class="text-danger" href="index.php?task=deleteuser&user_id=<?php echo $row['user_id'] ?>"><i class="far fa-trash-alt"></i></a></td>
                    </tr>
                  <?php }; ?>
                </table>
              </div>
            </div>
            <div id="addmember" class="container tab-pane fade">
              <!--Them thanh vien-->
              <h3 class="text-center">Thêm thành viên</h3>
              <form method="POST" action="">
                <div class="form-group">
                  <label for="">Tên Người Dùng</label>
                  <input class="form-control" type="text" name="name" placeholder="Tên người dùng">
                </div>
                <div class="form-group">
                  <label for="">Email</label>
                  <input class="form-control" type="email" name="email" placeholder="Email">
                </div>
                <div class="form-group">
                  <label for="">Mật khẩu</label>
                  <input class="form-control" type="password" name="password" placeholder="Mật khẩu">
                </div>

                <div><input type="submit" class="btn btn-primary" name="register" value="Thêm thành viên"></div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>



</body>

</html>