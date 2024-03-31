<?php

require_once "Models/ModelMovies.php";
require_once "Models/api.php";
require_once "Views/ViewMovies.php";


class ControllerMovies
{
    var $model, $view, $modelApi;
    public function __construct()
    {
        $this->view = new ViewMovies();
        $this->model = new ModelMovies();
        $this->modelApi = new ModelApiMovies();
    }
    public function updateMoviesUrlFromApi()
    {
        $this->modelApi->updateMoviesUrlFromApi();
    }
    public function updateEpisodesUrlFromApi()
    {
        $this->modelApi->updateEpisodesUrlFromApi();
    }
    // trang chu
    public function getPageHome()
    {

        $data = $this->model->getDataHome();
        $this->view->getPageHome($data);
    }

    public function getDetailPagePhim($id)
    {
        $data = $this->model->getTotalEpisode($id);
        $row = mysqli_fetch_assoc($data);
        $total_episode = $row['total_episode'];
        // echo "Total  " . $total_episode;


        // echo "----Total Pages: " . $total_page;
        $current_episode = isset($_GET['episode']) ? $_GET['episode'] : 1;


        $movie = $this->model->getMovies($id);
        $episode_movie = $this->model->getEpisode($id, $current_episode);

        $arr = [];
        $temp = [];
        $temp['current_episode'] = $current_episode;
        $temp['total_episode'] = $total_episode;
        array_push($arr, $temp);

        $this->view->getDetailPagePhim($movie, $arr, $episode_movie);
    }


    public function getPageMovie($category)
    {

        $data = $this->model->pagination($category);
        $row = mysqli_fetch_assoc($data);
        $total_record = $row['total'];
        // echo "Total  " . $total_record;

        $limit = 15;
        // tổng trang
        $total_page = ceil($total_record / $limit);

        // echo "----Total Pages: " . $total_page;
        $current_page = isset($_GET['page']) ? $_GET['page'] : 1;
        if ($current_page > $total_page) {
            $current_page = $total_page;
        } else if ($current_page < 1) {
            $current_page = 1;
        }
        $start = ($current_page - 1) * $limit;

        $data = $this->model->getFullDataMovie($category, $start, $limit);

        $arr = [];
        $temp = [];
        $temp['current_page'] = $current_page;
        $temp['total_page'] = $total_page;
        array_push($arr, $temp);

        $this->view->getPageMovie($data, $arr);
    }

    //trang dang nhap
    public function getPageLogin()
    {
        $this->view->getPageLogin();
    }
    //trang dang ky
    public function getPageRegister()
    {
        $this->view->getPageRegister('');
    }
    public function doLogin()
    {
        $result = $this->model->doLogin();
        $_SESSION['user_id'] = $result['user_id'];
        $_SESSION['name'] = $result['name'];
        $_SESSION['email'] = $result['email'];
        $_SESSION['level'] = $result['level'];
        if ($result['level'] == 2) {
            header("location:index.php?task=pagemanager");
        } elseif ($result['level'] == 1) {
            header("location:index.php?task=pagehome");
        }
    }
    // dang ky
    public function doRegister($name, $email, $password, $createdAt)
    {
        $result =  $this->model->doRegister($name, $email, $password, $createdAt);
        $message = "Đăng ký thành công !";
        echo "<script type='text/javascript'>alert('$message');</script>";
        if ($_SESSION['level']  == 2) {
            header("location:index.php?task=pagemanager");
        }
        $this->view->getPageRegister();
    }

    public function getPageUser()
    {
        $listUser = $this->model->getDataUser();
        $this->view->getPageUser($listUser);
    }
    public function deleteUser()
    {
        $this->model->deleteUser();
        header("location:index.php?task=pagemanager");
    }
    public function getPageContact()
    {
        $this->view->getPageContact();
    }

    // Tìm kiếm
    public function doSearch()
    {
        // tìm kiếm
        $key = isset($_POST['text_search']) ? $_POST['text_search'] : null;

        $form_type = isset($_POST['form_type']) ? $_POST['form_type'] : null;
        $data = $this->model->paginationSearch($key);
        $row = mysqli_fetch_assoc($data);
        $total_record = $row['total'];
        // echo "Total  " . $total_record;

        $limit = 15;
        // tổng trang
        $total_page = ceil($total_record / $limit);

        // echo "----Total Pages: " . $total_page;
        $current_page = isset($_GET['page']) ? $_GET['page'] : 1;
        if ($current_page > $total_page) {
            $current_page = $total_page;
        } else if ($current_page < 1) {
            $current_page = 1;
        }
        $start = ($current_page - 1) * $limit;

        $arr = [];
        $temp = [];
        $temp['current_page'] = $current_page;
        $temp['total_page'] = $total_page;
        array_push($arr, $temp);

        $level = isset($_SESSION['level']) ? $_SESSION['level'] : null;


        $data = $this->model->doSearch($key, $start, $limit);

        if ($form_type === "admin_search") {
            $this->view->getPageMovieForAdmin($data, $arr);
        } elseif ($form_type === "user_search") {
            $this->view->getPageSearch($data, $arr);
        }
    }

    // quản lý phim
    public function getPageMovieForAdmin()
    {

        $data = $this->model->paginationAll();
        $row = mysqli_fetch_assoc($data);
        $total_record = $row['total'];
        // echo "Total  " . $total_record;

        $limit = 10;
        // tổng trang
        $total_page = ceil($total_record / $limit);

        // echo "----Total Pages: " . $total_page;
        $current_page = isset($_GET['page']) ? $_GET['page'] : 1;
        if ($current_page > $total_page) {
            $current_page = $total_page;
        } else if ($current_page < 1) {
            $current_page = 1;
        }
        $start = ($current_page - 1) * $limit;
        $listMovies = $this->model->getDataMovie($start, $limit);

        $movies = [];
        while ($row = mysqli_fetch_assoc($listMovies)) {
            $temp = [];
            $temp['id'] = $row['id'];
            $temp['name_movie'] = $row['name_movie'];
            $temp['slug'] = $row['slug'];
            $temp['description'] = $row['description'];
            $temp['category_name_vn'] = $row['category_name_vn'];
            $temp['total_episodes'] = $row['total_episodes'];
            $temp['image'] = $row['image'];
            $temp['year'] = $row['year'];
            $temp['createdAt'] = $row['createdAt'];
            array_push($movies, $temp);
        }
        $arr = [];
        $temp1 = [];
        $temp1['current_page'] = $current_page;
        $temp1['total_page'] = $total_page;
        array_push($arr, $temp1);
        $this->view->getPageMovieForAdmin($movies, $arr);
    }
    public function getPageEditMovie()
    {
        $result = $this->model->getPageEditMovie();

        $episodesUrl = $this->model->getEpisodesUrl($result['movie_id']);

        // 
        if ($result['total_episodes'] > 1) {
            // Hiển thị trang khi total_episodes lớn hơn 1
            $this->view->getPageEditEpisode($result, $episodesUrl);
        } else {
            // Hiển thị trang khi total_episodes bằng 1 hoặc không có dữ liệu
            $this->view->getPageEditMovie($result); // Giả sử bạn có một phương thức showPage2() trong view
        }
    }
    public function getPageAddEp()
    {
        $result = $this->model->getPageAddEpisodes();
        $row = mysqli_fetch_assoc($result);


        $listEp = $this->model->getEp();


        $existingEpisodes = array_column($listEp, 'episode');
        $totalEpisodes = $row['total_episodes'];

        $missingEpisodes = array();
        if (!empty($existingEpisodes)) {
            for ($i = 1; $i <= $totalEpisodes; $i++) {
                if (!in_array($i, $existingEpisodes)) {
                    $missingEpisodes[] = $i;
                }
            }
        } else {
            $missingEpisodes = range(1, $totalEpisodes);
        }
 


        $this->view->getPageAddEp($result, $missingEpisodes);
    }

    public function doUpdateMovie()
    {
        $result = $this->model->doEditMovie1();
        if ($result === true) {
            echo "<script type='text/javascript'>alert('Cập nhật thành công!'); window.location.href = 'index.php?task=pagemovieforadmin';</script>";
        } else {
            var_dump($result);
        }
    }
    public function doUpdateEpisode()
    {

        $result = $this->model->doUpdateEpisode();
        if ($result === true) {
            echo "<script type='text/javascript'>alert('Cập nhật thành công!'); window.location.href = 'index.php?task=pagemovieforadmin';</script>";
        } else {
            var_dump($result);
        }
    }
    public function doAddMovie($name_movie, $origin_name, $slug, $description, $image, $total_episodes, $category_id, $urls, $year, $createdAt)
    {

        if (empty($name_movie) || empty($origin_name) || empty($slug) || empty($description) || empty($image) || empty($urls) || empty($category_id) || empty($year)) {

            header("location:" . $_SERVER['REQUEST_URI'] . "");
        } else {
            $insert_id = $this->model->addMovie($name_movie, $origin_name, $slug, $description, $image, $total_episodes, $category_id, $urls, $year, $createdAt);
            if ($insert_id) {
                header("location:index.php?task=pagemovieforadmin");
            } else {
                echo "<div class='container mt-4' style='width: 380px;'><div class='alert alert-success text-center'>Thêm thất bại</div></div>";
            }
        }
    }
    public function doAddEpisode1($movie_id, $episode, $url)
    {

        if (empty($movie_id) || empty($episode) || empty($url)) {

            header("location:" . $_SERVER['REQUEST_URI'] . "");
        } else {
            $insert_id = $this->model->addEpisode($movie_id, $episode, $url);
            if ($insert_id) {
                echo "<div class='container mt-4' style='width: 380px;'><div class='alert alert-success text-center'>Thêm mới thành công!</div></div>";
            } else {
                echo "<div class='container mt-4' style='width: 380px;'><div class='alert alert-success text-center'>them moi that bai!</div></div>";
            }
        }
    }


    public function delMovie()
    {
        $result = $this->model->delMovie();
        if ($result == true) {
            header("location:index.php?task=pagemovieforadmin");
        } else {
            var_dump($result);
        }
    }
    public function delEpisode()
    {
        $result = $this->model->delEpisode();
        if ($result == true) {
            echo 'xoa thanh cong';
            $id = $_GET['movie_id']; 


            header("location:index.php?task=editmovie&id=" . $id);
        } else {
            echo 'xoa loi';
        }
    }
}
