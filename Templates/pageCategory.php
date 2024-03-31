<!DOCTYPE html>
<html lang="en">

<link href="Templates/bootstrap/bootstrap.css" rel="stylesheet">
<script src="Templates/bootstrap/bootstrap.bundle.js"></script>
<script src="Templates/bootstrap/bootstrap.js"></script>
<link rel="stylesheet" href="Templates/Css/css.css">
<link rel="stylesheet" href="Templates/fontawesome/css/all.css">
<link rel="stylesheet" href="slick/slick-1.8.1/slick/slick.css">
<link rel="stylesheet" href="slick/slick-1.8.1/slick/slick-theme.css">


<body>
<style>
  .table {
    width: 100%;
    border-collapse: collapse; /* Loại bỏ khoảng trắng giữa các ô */
  }

  .table th, .table td {
    border: 1px solid #ddd; /* Định dạng đường viền cho các ô */
    padding: 8px; /* Khoảng cách bên trong các ô */
    text-align: center; /* Căn giữa nội dung trong các ô */
    white-space: pre-wrap; /* Đảm bảo xuống dòng khi nội dung quá dài */
    word-wrap: break-word; /* Đảm bảo nội dung bị cắt khi quá dài */
  }


  
</style>
  <nav>
    <div style="display: flex; justify-content:space-around;padding-top: 30px;">
      <div><a href="index.php?task=pagemanager" class="btn btn-outline-light menu">Trang chủ</a></div>
      <div>
        <?php if (isset($_SESSION['name'])){
                        if ($_SESSION['level'] ==2){ ?>
        <a href="index.php?task=pagemanager" class="btn btn-outline-light menu"><?php echo $_SESSION['name']?></a>
        <a href="index.php?task=logout" class="btn btn-outline-light menu">Đăng xuất</a>
        <?php }elseif ($_SESSION['level']==1){ ?>
        <a href="" class="btn btn-outline-light menu"><?php echo $_SESSION['name']?></a>
        <a href="index.php?task=logout" class="btn btn-outline-light menu">Đăng xuất</a>
        <?php }?>
        <?php }else{ ?>
        <a href="index.php?task=pagelogin" class="btn btn-outline-light menu"> <i class="fas fa-user"></i>Tài khoản </a>
        <?php } ?>
      </div>
    </div>
  </nav>

  <div>
    <div style="margin: 10px;">
      <div class="row mt-3" style="min-height: 300px;">
        <div class="col-lg-2">
          <h1>Quản lý</h1>
          <div class="list-group">
            <a class="list-group-item" href="index.php?task=pagemanager">Quản lý thành viên</a>
            <a class="list-group-item" href="index.php?task=pagemovieforadmin">Quản lý phim</a>
            <a class="list-group-item" href="index.php?task=pagecategory">Quản lý danh mục</a>
          </div>
        </div>
        <div class="col-lg-10">
          <ul class="nav nav-tabs" role="tablist">
            <li class="nav-item">
              <a class="nav-link active" data-toggle="tab" href="#listmovie">Danh Danh Mục</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-toggle="tab" href="#addmovie">Thêm Danh Mục</a>
            </li>
          </ul>
          <div class="tab-content">
            <div id="listmovie" class="tab-pane active">
              <h3 class="text-center">Danh sách Danh Mục</h3>
              <!--Danh sach san pham-->
              <div class="text-center">
                <table class="table text-center w-100">
                  <tr>
                    <th>ID</th>
                    <th>Tên Danh Mục</th>
                   
                  </tr>
                  <?php foreach($listMovies as $row){ ?>
                  <td><?php echo $row['category_id']?></td>
                  <td><?php echo $row['category_name'] ?></td>
                  <td><img width="90px" height="90px" src="<?php echo $row['image']?>" alt=""></td>
                  <td><a class="text-success" href="index.php?task=editmovie&id=<?php echo $row['id']; ?>"><i
                        class="far fa-edit"></i></a></td>
                  <td><a class="text-danger" href="index.php?task=deletemovie&id=<?php echo $row['id'];?>"><i
                        class="far fa-trash-alt"></i></a></td>
                  </tr>
                  <?php }; ?>
                </table>
              </div>
              <!--code database-->
            </div>
            <div id="addmovie" class="container tab-pane fade">
              <!--Thêm sản phẩm-->
              <h3 class="text-center">Thêm danh mục</h3>
              <form method="POST" action="" enctype="multipart/form-data">
            <div class="form-group">
                <label for="">Tên danh mục</label>
                <input class="form-control" type="text" name="name_movie" >
            </div>
            
            <div class="form-group">
                <input class="btn btn-primary" type="submit" name = "add_category" value="Thêm mới danh mục">
            </div>
        </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
 
  <script src="Templates/bootstrap/jquery-3.3.1.min.js"></script>
  <script src="Templates/bootstrap/popper.min.js"></script>
  <script src="Templates/bootstrap/bootstrap.min.js"></script>
</body>

</html>