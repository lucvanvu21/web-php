<?php
require_once 'configdb.php';
class ModelMovies
{
    private $db;
    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }

    // lay du lieu trang chu
    public function getDataHome()
    {
        $query = "SELECT *
                  FROM movies,categories where movies.category_id = categories.category_id and categories.category_name= 'popular' ORDER BY movies.id DESC LIMIT 5";

        $query_movies = "SELECT * FROM movies 
        INNER JOIN categories ON movies.category_id = categories.category_id 
        WHERE categories.category_name = 'movies' ORDER BY movies.id DESC
        LIMIT 10";

        // Truy vấn lấy 10 phim bộ
        $query_tvseries = "SELECT * FROM movies 
        INNER JOIN categories ON movies.category_id = categories.category_id 
        WHERE categories.category_name = 'tvseries' ORDER BY movies.id DESC
        LIMIT 10";

        // Thực hiện các truy vấn
        $result_popular = mysqli_query($this->db, $query);
        $result_movies = mysqli_query($this->db, $query_movies);
        $result_tvseries = mysqli_query($this->db, $query_tvseries);

        // Kiểm tra và trả về kết quả
        if ($result_popular && $result_movies && $result_tvseries) {
            return array(
                'popular' => $result_popular,
                'movies' => $result_movies,
                'tvseries' => $result_tvseries
            );
        } else {
            return false;
        }
    }
    public function getTotalEpisode($id)
    {
        $result = mysqli_query($this->db, "SELECT count(episode) as total_episode FROM episodes where movie_id='{$id}'");
        return $result;
    }
    public function getEpisode($id, $current_episode)
    {
        $result = mysqli_query($this->db, "SELECT * FROM episodes where movie_id='{$id}' and episode = '{$current_episode}' ");
        return $result;
    }
    public function getMovies($id)
    {
        $query = "SELECT movies.*
                  FROM movies where id={$id}";
        $movie = mysqli_query($this->db, $query);
        return $movie;
    }



    public function pagination($category)
    {

        // tìm số bản ghi
        $result = mysqli_query($this->db, "SELECT count(id) as total FROM movies where category_id='{$category}'");
        return $result;
    }
    public function paginationAll()
    {

        // tìm số bản ghi
        $result = mysqli_query($this->db, "SELECT count(id) as total FROM movies");
        return $result;
    }
    public function paginationSearch($key)
    {

        $query = "SELECT COUNT(*) AS total FROM movies WHERE name_movie LIKE '%$key%' OR origin_name LIKE '%$key%'";
        $countResult = mysqli_query($this->db, $query);
        return $countResult;
    }
    public function getFullDataMovie($category, $start, $limit)
    {

        $query = "SELECT * FROM movies,categories where movies.category_id = categories.category_id and movies.category_id='{$category}' ORDER BY movies.id DESC LIMIT $start, $limit";



        $result = mysqli_query($this->db, $query);
        return $result;
    }



    public function doLogin()
    {
        $query = "SELECT * 
                  FROM users 
                  WHERE email = '" . $_POST['email'] . "' AND password = '" . $_POST['password'] . "'";
        $result = mysqli_query($this->db, $query);
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            return $row;
        }
        return false;
    }
    // đăng kí
    public function doRegister($name, $email, $password, $createdAt)
    {
        // Kiểm tra xem email đã tồn tại trong cơ sở dữ liệu hay chưa
        $checkQuery = "SELECT * FROM users WHERE email = '" . $email . "'";
        $checkResult = mysqli_query($this->db, $checkQuery);

        // Nếu tồn tại một bản ghi có cùng email trong cơ sở dữ liệu
        if (mysqli_num_rows($checkResult) > 0) {
            // Trả về thông báo rằng email đã tồn tại
            return "Email đã tồn tại trong hệ thống";
        } else {

            $query = "INSERT INTO users (name, email, password, level, createdAt)
                  VALUES ('" . $name . "','" . $email . "', '" . $password . "', '1', '" . $createdAt . "')";
            $result = mysqli_query($this->db, $query);
            return $result;
        }
    }
    public function getDataUser()
    {
        $query = "SELECT * 
                  FROM users
                  WHERE level = '1'";
        $listUser = mysqli_query($this->db, $query);
        return $listUser;
    }
    public function deleteUser()
    {
        $query = "DELETE FROM users
                  WHERE user_id = '{$_GET['user_id']}'";
        $result = mysqli_query($this->db, $query);
        return $result;
    }

    // tìm kiếm 
    public function doSearch(string $key, $start, $limit)
    {
        $query = "SELECT movies.*,categories.category_name_vn
                        FROM movies,categories
                      WHERE movies.category_id = categories.category_id
                      AND (name_movie LIKE '%$key%' OR origin_name LIKE '%$key%') ORDER BY movies.id DESC LIMIT $start, $limit";
        $result = mysqli_query($this->db, $query);
        return $result;
    }
    // lay du lieu san pham
    public function getDataMovie($start, $limit)
    {
        $query = "SELECT movies.*,categories.category_name_vn
                  FROM movies,categories
                  WHERE movies.category_id = categories.category_id ORDER BY movies.id DESC LIMIT $start,$limit";

        $list = mysqli_query($this->db, $query);
        return $list;
    }

    // lấy dữ liệu trang sửa sản phẩm
    public function getPageEditMovie()
    {

        $movie_id = $_GET['id'];
        $query = "SELECT movies.*, episodes.*
        FROM movies
        -- INNER JOIN categories ON movies.category_id = categories.category_id
        LEFT JOIN episodes ON movies.id = episodes.movie_id
        WHERE movies.id = '$movie_id'";

        $result = mysqli_query($this->db, $query);
        return $result->fetch_assoc();
    }
    public function getPageAddEpisodes()
    {
        $id = $_GET["id"];
        $query = "SELECT movies.id,movies.name_movie,movies.total_episodes
        FROM movies where id='{$id}'";
        $result = mysqli_query($this->db, $query);
        return $result;
    }
    public function getEp()
    {
        $id = $_GET["id"];
        // var_dump($getMovieId);
        $query = "SELECT episodes.episode
        FROM episodes where movie_id='$id'";
        $result = mysqli_query($this->db, $query);
        //  return $result->fetch_assoc();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    public function getEpisodesUrl($movie_id)
    {
        $query = "SELECT *
        FROM episodes
        WHERE movie_id = '{$movie_id}'";

        $list = mysqli_query($this->db, $query);
        return $list;
    }
    public function doEditMovie1()
    {

        try {
            // var_dump($_POST);
            // Cập nhật thông tin trong bảng movies
            $id = $_POST['id'];
            $nameMovie = $_POST['name_movie'];
            $originName = $_POST['origin_name'];
            $slug = $_POST['slug'];
            $total_episodes = $_POST['total_episodes'];
            $image = $_POST['image'];
            $description = $_POST['description'];
            $categoryId = $_POST['category_id'];
            $year = $_POST['year'];


            $updateMoviesQuery = $this->db->prepare("UPDATE movies 
            SET name_movie = ?,
                origin_name = ?,
                slug =? , 
                total_episodes = ?,
                description = ?,
                image = ?,
                category_id = ?,
                year = ?
            WHERE id = ?");
            $updateMoviesQuery->bind_param("ssssssiii", $nameMovie, $originName, $slug, $total_episodes, $description, $image, $categoryId, $year, $id);
            $updateMoviesQuery->execute();

            // Cập nhật URL trong bảng episodes
            $episodeUrl = $_POST['url'];
            $updateEpisodesQuery = "UPDATE episodes 
                            SET url = '{$episodeUrl}'
                            WHERE movie_id = '{$id}'";
            mysqli_query($this->db, $updateEpisodesQuery);

            return true;
        } catch (Exception $e) {
            mysqli_rollback($this->db);
            echo "Cập nhật thất bại cho movie: " . $e->getMessage();
            return false;
        }
    }
    public function doUpdateEpisode()
    {

        try {


            // Cập nhật thông tin trong bảng movies
            $id = $_POST['id'];
            $nameMovie = $_POST['name_movie'];
            $originName = $_POST['origin_name'];
            $slug = $_POST['slug'];
            $total_episodes = $_POST['total_episodes'];
            $image = $_POST['image'];
            $description = $_POST['description'];
            $categoryId = $_POST['category_id'];
            $year = $_POST['year'];

            $updateMoviesQuery = $this->db->prepare("UPDATE movies 
            SET name_movie = ?,
                origin_name = ?,
                slug = ?,
                total_episodes = ?,
                description = ?,
                image = ?,
                category_id = ?,
                year = ?
            WHERE id = ?");
            $updateMoviesQuery->bind_param("ssssssiii", $nameMovie, $originName, $slug, $total_episodes, $description, $image, $categoryId, $year, $id);
            $updateMoviesQuery->execute();
            // mysqli_query($this->db, $updateMoviesQuery);


            // Cập nhật URL trong bảng episodes
            foreach ($_POST['episode'] as $episode) {
                // Lấy URL của tập phim từ biến $_POST dựa trên key tương ứng
                $url_key = 'url' . $episode;
                $episodeUrl = $_POST[$url_key];

                // Cập nhật URL của tập phim có ID là $episode_id
                $updateEpisodesQuery = "UPDATE episodes 
                                        SET url = '{$episodeUrl}'
                                        WHERE episode = '{$episode}'";
                mysqli_query($this->db, $updateEpisodesQuery);
            }
            return true;
        } catch (Exception $e) {
            mysqli_rollback($this->db);
            echo "Cập nhật thất bại cho episode: " . $e->getMessage();
            return false;
        }
    }

    public function addMovie($name_movie, $origin_name, $slug, $description, $image, $total_episodes, $category_id, $urls, $year, $createdAt)
    {
        $query = "INSERT INTO movies(name_movie, origin_name, slug, description, image, total_episodes, category_id, year, createdAt) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($this->db, $query);
        mysqli_stmt_bind_param($stmt, 'sssssssss', $name_movie, $origin_name, $slug, $description, $image, $total_episodes, $category_id, $year, $createdAt);
        $result = mysqli_stmt_execute($stmt);
        if ($result) {
            $movie_id = mysqli_insert_id($this->db);



            if ($movie_id) {
                // Nếu là phim bộ, thêm các tập phim vào bảng episodes
                if ($category_id == 3 && count($urls) > 0 || $category_id == 1 && count($urls) > 0) {
                    for ($i = 1; $i <= $total_episodes; $i++) {
                        $url = isset($urls[$i - 1]) ? $urls[$i - 1] : ''; // Lấy URL của tập phim từ mảng urls
                        $this->addEpisode($movie_id, $i, $url);
                    }
                } else if ($category_id == 2 && count($urls) > 0 || $category_id == 1 && count($urls) > 0) { // Nếu là phim lẻ, thêm chỉ một URL
                    $this->addEpisode($movie_id, "1", $urls[0]);
                }
            }
            return $movie_id;
        }
    }
    public function addEpisode($movie_id, $episode, $url)
    {
        if ($url === '') {
            $url = '';
        }
        $query = "INSERT INTO episodes (movie_id, episode, url) VALUES ('" . $movie_id . "', '" . $episode . "', '" . $url . "')";
        $result = mysqli_query($this->db, $query);
        return $result;
    }

    // xóa sản phẩm
    public function delEpisode()
    {
        $query = "DELETE FROM episodes
                  WHERE episodes.episode_id = '{$_GET['episode_id']}'";
        if (mysqli_query($this->db, $query)) {
            return true;
        };
        return false;
    }
    public function delAllEpisodes()
    {
        $query = "DELETE FROM episodes
                  WHERE episodes.movie_id = '{$_GET['id']}'";
        if (mysqli_query($this->db, $query)) {
            return mysqli_insert_id($this->db);
        };
        return false;
    }


    public function delMovie()
    {
        $id = $this->delAllEpisodes();
        if (isset($id)) {
            $query = "DELETE FROM movies
                      WHERE id = '{$_GET['id']}'";
            $result = mysqli_query($this->db, $query);
            return $result;
        };
        return false;
    }
}
