<?php

require_once "Controllers/ControllerMovies.php";

session_start();

// controller
$ControllerMovies = new ControllerMovies();
$task = isset($_GET['task']) ? $_GET['task'] : null;



if (isset($_POST['update_url'])) {
    $ControllerMovies->updateMoviesUrlFromApi();
    echo "Episodes updated successfully!";
}
if (isset($_POST['update_url_e'])) {
    $ControllerMovies->updateEpisodesUrlFromApi();
    echo "Episodes updated successfully!";
}
//user
$name = isset($_POST['name']) ? $_POST['name'] : null;
$email = isset($_POST['email']) ? $_POST['email'] : null;
$password = isset($_POST['password']) ? $_POST['password'] : null;
$createdAt = date("Y.m.d");


//phim
$name_movie = isset($_POST['name_movie']) ? $_POST['name_movie'] : null;
$origin_name = isset($_POST['origin_name']) ? $_POST['origin_name'] : null;
$slug = isset($_POST['slug']) ? $_POST['slug'] : null;
$description = isset($_POST['description']) ? $_POST['description'] : null;
$image = isset($_POST['image']) ? $_POST['image'] : null;
$category_id = isset($_POST['category_id']) ? $_POST['category_id'] : null;
$total_episodes = isset($_POST['total_episodes']) ? $_POST['total_episodes'] : null;
$year = isset($_POST['year']) ? $_POST['year'] : null;

// $urls = array();
$urls = [];
$i = 1;
while (isset($_POST['url' . $i])) {
    $url = $_POST['url' . $i];
    $i++;
    array_push($urls, $url);
}
// var_dump($urls);
// print_r($urls);



// dang nhap
if (isset($_POST['login'])) {
    if (empty($email) ||  empty($password)) {
        $message = "Không được để trống !";
        echo "<script type='text/javascript'>alert('$message');</script>";
    } elseif (isset($email) && isset($password)) {
        $ControllerMovies->doLogin();
    }
}
// dang ky
if (isset($_POST['register'])) {
    if (empty($name) || empty($email) ||  empty($password)) {
        $message = "Không được để trống !";
        echo "<script type='text/javascript'>alert('$message');</script>";
    } elseif (isset($name) && isset($email) && isset($password)) {
        $ControllerMovies->doRegister($name, $email, $password, $createdAt);
    }
}

// tim kiem phim




if (isset($_POST['search'])) {
    $ControllerMovies->doSearch();
}

// sua phim
if (isset($_POST['update_movie'])) {
    $ControllerMovies->doUpdateMovie();
}
if (isset($_POST['update_episode'])) {
    var_dump($_POST['episode']);
    $ControllerMovies->doUpdateEpisode();
}

// them phim
if (isset($_POST['add_movie'])) {
    $ControllerMovies->doAddMovie($name_movie, $origin_name, $slug, $description, $image, $total_episodes, $category_id, $urls, $year, $createdAt);
}


$movie_id = isset($_POST['m_id']) ? $_POST['m_id'] : null;
$episode = isset($_POST['episode_add']) ? $_POST['episode_add'] : null;
$url = isset($_POST['urlx']) ? $_POST['urlx'] : null;
if (isset($_POST['add_episode_ok'])) {
    $ControllerMovies->doAddEpisode1($movie_id, $episode, $url);
}




switch ($task) {

        // giay
    case 'pagehome':
        $ControllerMovies->getPageHome();
        break;
    case 'detailphim':
        $ControllerMovies->getDetailPagePhim($_GET['id']);
        break;

    case 'pagemovie':
        $ControllerMovies->getPageMovie($_GET['category']);
        break;

    case 'pagelogin':
        $ControllerMovies->getPageLogin();
        break;
    case 'pageregister':
        $ControllerMovies->getPageRegister();
        break;
    case 'logout':
        session_destroy();
        header("location:index.php?task=pagehome");
        break;
    case 'pagemanager':
        $ControllerMovies->getPageUser();
        break;
    case 'deleteuser':
        $ControllerMovies->deleteUser();
        break;

    case 'pagecontact':
        $ControllerMovies->getPageContact();
        break;
    case 'pagemovieforadmin':
        $ControllerMovies->getPageMovieForAdmin();
        break;

    case 'editmovie':
        $ControllerMovies->getPageEditMovie();
        break;
    case 'pageaddep':
        $ControllerMovies->getPageAddEp();
        break;
    case 'deletemovie':
        $ControllerMovies->delMovie();
        break;
    case 'delepisode':
        $ControllerMovies->delEpisode();
        break;

    default:
        $ControllerMovies->getPageHome();
        break;
}
