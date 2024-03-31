<!DOCTYPE html>
<html lang="en">
<?php require_once "Controllers/Admin.php" ?>

<head>
  <link href="/Templates/bootstrap/bootstrap.css" rel="stylesheet">
  <script src="Templates/bootstrap/bootstrap.bundle.js"></script>
  <script src="Templates/bootstrap/bootstrap.js"></script>
  <link rel="stylesheet" href="Templates/Css/css.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

  <!-- <link href="Templates/bootstrap/bootstrap.css" rel="stylesheet">
  <script src="Templates/bootstrap/bootstrap.bundle.js"></script>
  <script src="Templates/bootstrap/bootstrap.js"></script> -->
  <link href="./bootstrap/bootstrap.css" rel="stylesheet">
  <script src="./bootstrap/bootstrap.bundle.js"></script>
  <script src="./bootstrap/bootstrap.js"></script>

  <link rel="stylesheet" href="/Templates/css/css.css">


</head>
<script>
  function showLoadingMessage() {
    document.getElementById('loadingMessage').style.display = 'block';
  }
</script>

<body>
  <style>
    button {
      cursor: pointer;
    }

    .table {
      width: 100%;
      border-collapse: collapse;
    }

    .table th,
    .table td {
      border: 1px solid #ddd;
      padding: 8px;
      text-align: center;

    }

    .url-column {
      word-break: break-all;
      min-width: 180px;
    }

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
  <div id="loadingMessage" style="display: none;">Đang cập nhật URL. Vui lòng đợi...</div>

  <nav>

    <div style="display: flex; justify-content:space-around;padding-top: 30px;">
      <div><a name="update_url" href="index.php?task=pagemovieforadmin" class="btn btn-outline-light menu">Trang chủ</a></div>
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

  <div>
    <div style="margin: 50px 10px 30px 10px;">
      <div style="display: flex; justify-content: flex-end;margin-top: 10px;">

        <form method="POST" action="" class="input-group col-lg-3">
          <div class="form-outline" data-mdb-input-init>
            <input type="search" name="text_search" class="form-control" placeholder="Tìm Kiếm ..." />
            <input type="hidden" name="form_type" value="admin_search">

          </div>
          <button name="search" type="submit" class="btn btn-primary" data-mdb-ripple-init>
            <i class="fas fa-search"></i>
          </button>
        </form>


      </div>
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
          <ul class="nav nav-tabs" role="tablist">
            <li class="nav-item">
              <a class="nav-link active" data-toggle="tab" href="#listmovie">Danh sách phim</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-toggle="tab" href="#addmovie">Thêm phim</a>
            </li>
            <li class="nav-item">
            </li>

          </ul>
          <div class="tab-content">
            <div id="listmovie" class="tab-pane active">
              <h3 class="text-center">Danh sách phim</h3>
              <!--Danh sach phim-->
              <div class="text-center">
                <table class="table text-center w-100">
                  <tr>
                    <th>ID</th>
                    <th>Tên phim</th>
                    <th>slug phim</th>
                    <th>Thông tin phim</th>
                    <th>Danh mục</th>

                    <!-- <th>URL</th> -->
                    <th>Năm phát hành</th>
                    <th>Ngày tạo</th>
                    <th>Ảnh</th>
                    <th>Số tập</th>
                    <th>Thêm tập </th>
                    <th>Sửa</th>
                    <th>Xóa</th>
                  </tr>
                  <?php foreach ($listMovies as $row) { ?>
                    <td><?php echo $row['id'] ?></td>
                    <td><?php echo $row['name_movie'] ?></td>
                    <td><?php echo $row['slug'] ?></td>
                    <td style="width: 30%;"><?php echo $row['description'] ?></td>
                    <td><?php echo $row['category_name_vn'] ?></td>
                    <td><?php echo $row['year'] ?></td>
                    <td><?php echo $row['createdAt'] ?></td>
                    <td><img width="75px" height="115px" src="<?php echo $row['image'] ?>" alt=""></td>
                    <td><?php echo $row['total_episodes'] ?></td>

                    <!-- <a class="nav-link" href="index.php?task=pageaddep">Thêm tập phim</a> -->

                    <td><a class="text-primary" href="index.php?task=pageaddep&id=<?php echo $row['id']; ?>"><i class="fa fa-fw fa-plus-circle" aria-hidden="true"></i></a></td>
                    <td><a class="text-success" href="index.php?task=editmovie&id=<?php echo $row['id']; ?>"><i class="far fa-edit"></i></a></td>
                    <td><a class="text-danger" href="index.php?task=deletemovie&id=<?php echo $row['id']; ?>"><i class="far fa-trash-alt"></i></a></td>
                    </tr>
                  <?php }; ?>
                </table>
                <div>

                  <?php foreach ($arr as $temp) {

                    // nếu trang hiện tại lớn hơn 1 và tổng trang lớn hơn 1 mới hiển thị nút prev

                    //
                    echo '<nav style="display:flex; gap:20px; height:38px" role="navigation" aria-label="pagination">';
                    echo '<ul style="display:flex;gap:10px;padding-right:8px">';

                    for ($i = 1; $i <= $temp['total_page']; $i++) {
                      echo '<li>';
                      if ($i == $temp['current_page']) {
                        echo '<span class="btn btn-primary"  aria-label="Goto page ' . $i . '" aria-current="page">' . $i . '</span>';
                      } else {
                        echo '<a  class="btn btn-outline-secondary"  href="index.php?task=pagemovieforadmin&page=' . $i . '" aria-label="Goto page ' . $i . '" aria-current="false">' . $i . '</a>';
                      }
                      echo '</li>';
                    }

                    echo '</ul>';
                    if ($temp['current_page'] > 1 && $temp['total_page'] > 1) {
                      echo '<a class="btn btn-outline-secondary"  href="index.php?task=pagemovieforadmin&page=' . ($temp['current_page'] - 1) . '">Trang trước</a>  ';
                    }
                    if ($temp['current_page'] < $temp['total_page'] && $temp['total_page'] > 1) {
                      echo '<a class="btn btn-outline-secondary"  href="index.php?task=pagemovieforadmin&page=' . ($temp['current_page'] + 1) . '">Trang sau</a>  ';
                    }

                    echo '</nav>';
                  } ?>


                </div>
              </div>
              <!--code database-->
            </div>
            <div id="addmovie" class="container tab-pane fade">
              <!--Thêm phim-->
              <h3 class="text-center">Thêm phim</h3>
              <form method="POST" action="" enctype="multipart/form-data">
                <div class="form-group">
                  <label for="">Tên phim</label>
                  <input class="form-control" type="text" name="name_movie">
                </div>
                <div class="form-group">
                  <label for="">Tên Gốc</label>
                  <input class="form-control" type="text" name="origin_name">
                </div>
                <div class="form-group">
                  <label for="">Slug Phim</label>
                  <input class="form-control" type="text" name="slug">
                </div>
                <div class="form-group">
                  <label for="">Thông tin phim</label>
                  <textarea class="form-control" type="text" name="description"></textarea>
                </div>
                <div class="form-group">
                  <label for="">Ảnh phim</label>
                  <input class="form-control" type="text" name="image">
                </div>
                <div class="form-group">
                  <label for="">Số tập</label>
                  <input class="form-control" type="number" id="total_episodes" name="total_episodes" value="1" onchange="toggleAddEpisodeButton()" required="">
                </div>
                <div class="form-group">
                  <label for="">Danh mục phim</label>
                  <select name="category_id" class="form-control">
                    <option value="1">porpular</option>
                    <option value="2">movies</option>
                    <option value="3">tvseries</option>
                  </select>
                </div>
                <div id="episodeInputs">
                  <div class="form-group">

                    <label for="">URL tập phim 1</label>
                    <input class="form-control episode-input" type="text" name="url1" required="">
                  </div>
                </div>

                <div class="form-group" id="add_episode_button" style="display:none;">
                  <button type="button" class="btn btn-primary" onclick="addEpisodeInput()">Thêm tập phim</button>
                </div>
                <div class="form-group">
                  <label for="">Năm</label>
                  <input class="form-control" type="number" name="year">
                </div>

                <div class="form-group">
                  <input class="btn btn-primary" type="submit" name="add_movie" value="Thêm mới phim">
                </div>
              </form>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>

  <script>
    function toggleAddEpisodeButton() {
      var totalEpisodes = parseInt(document.getElementById('total_episodes').value);
      var episodeInputsContainer = document.getElementById('episodeInputs');
      var currentInputsCount = episodeInputsContainer.querySelectorAll('.form-group').length;

      for (var i = currentInputsCount + 1; i <= totalEpisodes; i++) {
        var divFormGroup = document.createElement('div');
        divFormGroup.className = 'form-group';

        var label = document.createElement('label');
        label.textContent = 'URL tập phim ' + i;
        divFormGroup.appendChild(label);

        var input = document.createElement('input');
        input.className = 'form-control episode-input';
        input.type = 'text';
        input.name = 'url' + i;
        divFormGroup.appendChild(input);

        episodeInputsContainer.appendChild(divFormGroup);
      }
      if (currentInputsCount > totalEpisodes) {
        for (var i = currentInputsCount; i > totalEpisodes; i--) {
          episodeInputsContainer.removeChild(episodeInputsContainer.lastChild);
        }
      }

    }
  </script>
  <script src="Templates/bootstrap/jquery-3.3.1.min.js"></script>
  <script src="Templates/bootstrap/popper.min.js"></script>
  <script src="Templates/bootstrap/bootstrap.min.js"></script>
  <script src="./bootstrap/jquery-3.3.1.min.js"></script>
  <script src="./bootstrap/popper.min.js"></script>
  <script src="./bootstrap/bootstrap.min.js"></script>
</body>

</html>