<!DOCTYPE html>
<html lang="en">
<?php require_once "Controllers/Admin.php";

?>

<head>

    <link href="Templates/bootstrap/bootstrap.css" rel="stylesheet">
    <script src="Templates/bootstrap/bootstrap.bundle.js"></script>
    <script src="Templates/bootstrap/bootstrap.js"></script>
    <link rel="stylesheet" href="Templates/Css/css.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">


</head>


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
    <div style="margin: 104px 10px 30px 10px;">


        <div class="row mt-3" style="min-height: 300px;">
            <div class="col-lg-2">

                <h1 style="text-align: center;">Quản lý</h1>
                <div style="text-align: center;" class="list-group">
                    <a class="list-group-item menu list-group-item-action" href="index.php?task=pagemanager">Quản lý thành viên</a>
                    <a class="list-group-item menu list-group-item-action" href="index.php?task=pagemovieforadmin">Quản lý phim</a>
                    <form class=" list-group-item menu " action="" method="post">
                        <button class="form-btn" type="submit" name="update_url">Cập nhật link phim lẻ tự động </button>
                    </form>
                    <form class=" list-group-item menu " action="" method="post">
                        <button class="form-btn" type="submit" name="update_url_e">Cập nhật link phim bộ tự động </button>
                    </form>
                </div>
            </div>
            <div style="margin:80px" class="col-lg-8">
                <form method="POST" action="" enctype="multipart/form-data">
                    <div class="form-group">
                        <?php foreach ($result as $movie) : ?>
                            <input name="m_id" value="<?php echo $movie['id'] ?>" name="m_id" type="text" hidden>
                            <h4>Tên Phim : <?php echo $movie['name_movie']; ?></h4>
                        <?php endforeach; ?>
                    </div>

                    <div class="form-group">
                        <label for="">Thêm Tập Phim:</label>
                        <select name="episode_add" class="form-control">
                            <?php foreach ($missingEpisodes as $episode) : ?>
                                <option value="<?php echo $episode; ?>">Episode <?php echo $episode; ?></option>
                            <?php endforeach; ?>

                        </select>
                    </div>
                    <div id="episodeInputs">
                        <div class="form-group">

                            <label for="">URL tập phim </label>
                            <input class="form-control episode-input" type="text" name="urlx" required="">
                        </div>
                    </div>


                    <div class="form-group">
                        <input class="btn btn-primary" type="submit" name="add_episode_ok" value="Thêm mới phim">
                    </div>
                </form>
            </div>
        </div>
    </div>





    <script src="Templates/bootstrap/jquery-3.3.1.min.js"></script>
    <script src="Templates/bootstrap/popper.min.js"></script>
    <script src="Templates/bootstrap/bootstrap.min.js"></script>
</body>

</html>