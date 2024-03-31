<!DOCTYPE html>

<?php require_once "Controllers/Admin.php";

?>
<html lang="en">

<link href="Templates/bootstrap/bootstrap.css" rel="stylesheet">
<script src="Templates/bootstrap/bootstrap.bundle.js"></script>
<script src="Templates/bootstrap/bootstrap.js"></script>
<link rel="stylesheet" href="Templates/Css/css.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">


<body>
    <nav>
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
    <div>
        <div class="container">
            <form method="POST" action="" enctype="multipart/form-data">
                <h4 class="rounded" style="border-bottom: solid 3px #F18620; color: #E8E8E8;">
                    <div class="mt-2 p-1 bg-main rounded" style="width: 325px;">SỬA THÔNG TIN PHIM</div>
                </h4>
                <div class="form-group">
                    <label for="">Tên phim</label>
                    <input type="hidden" name="id" value="<?= $result['id'] ?>">
                    <input class="form-control" type="text" name="name_movie" value="<?= $result['name_movie'] ?>">
                </div>
                <div class="form-group">
                    <label for="">Tên Gốc</label>
                    <input class="form-control" type="text" name="origin_name" value="<?= $result['origin_name'] ?>">
                </div>
                <div class="form-group">
                    <label for="">Slug</label>
                    <input class="form-control" type="text" name="slug" value="<?= $result['slug'] ?>">
                </div>
                <div class="form-group">
                    <label for="">Tổng số tập</label>
                    <input class="form-control" type="text" name="total_episodes" value="<?= $result['total_episodes'] ?>">
                </div>
                <div class="form-group">
                    <label for="">Thông tin phim</label>
                    <textarea class="form-control" name="description" style="min-height: 100px;"><?= $result['description'] ?></textarea>
                </div>
                <div class="form-group">
                    <label for="">Ảnh phim</label>
                    <input class="form-control" type="text" name="image" value="<?= $result['image'] ?>">
                </div>

                <div class="form-group">
                    <label for="">URL</label>
                    <input class="form-control" type="text" name="url" value="<?= $result['url'] ?>">
                </div>

                <div class="form-group">
                    <label for="">Danh mục phim</label>
                    <select name="category_id" class="form-control">
                        <option value="1">porpular</option>
                        <option value="2">movies</option>
                        <option value="3">tvseries</option>

                    </select>
                </div>
                <div class="form-group">
                    <label for="">Year</label>
                    <input class="form-control" type="number" name="year" value="<?= $result['year'] ?>">
                </div>

                <div class="form-group">
                    <input class="btn btn-primary" type="submit" name="update_movie" value="Cập nhật phim">
                </div>
            </form>
        </div>
    </div>

</body>

</html>