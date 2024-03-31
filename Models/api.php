<?php
require_once 'configdb.php';
class ModelApiMovies
{
    var $db;
    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }
    public function updateMoviesUrlFromApi()
    {
        $sql = "SELECT movies.total_episodes,movies.id,movies.slug,episodes.url
            FROM movies,episodes
            WHERE movies.id=episodes.movie_id and episodes.url IS NOT NULL and total_episodes = 1";
        $result = mysqli_query($this->db, $sql);

        if ($result->num_rows > 0) {
            // Lặp qua mỗi slug từ cơ sở dữ liệu
            while ($row = $result->fetch_assoc()) {
                $movieSlugFromDB = $row["slug"];
                $m_id = $row["id"];
                $totalEpisode = $row["total_episodes"];
                $urlFromDb = $row["url"];

                // Kiểm tra nếu total_episode lớn hơn 1
                if ($totalEpisode > 1) {
                } else {
                    $apiUrl = "https://ophim1.com/phim/" . $movieSlugFromDB;
                    // Gửi yêu cầu đến API
                    $jsonData = @file_get_contents($apiUrl);
                    if ($jsonData === false) {
                        echo "không tìm thấy slug từ id này: " . $m_id . "<br>";
                        continue;
                    }
                    $data = json_decode($jsonData, true);

                    // Kiểm tra xem dữ liệu trả về từ API có hợp lệ không
                    if ($data && isset($data['status']) && $data['status'] === true) {
                        // Lấy URL từ episode của API
                        $urlFromAPI = $data['episodes'][0]['server_data'][0]['link_embed'];

                        if ($urlFromDb != $urlFromAPI) {
                            // Cập nhật URL trong bảng episodes
                            $sqlUpdate = "UPDATE episodes SET url='$urlFromAPI' WHERE movie_id='$m_id'";
                            if ($this->db->query($sqlUpdate) === TRUE) {
                            } else {
                                echo "Lỗi khi update URL: " . $this->db->error . "<br>";
                            }
                        } else {
                            echo "URL trong db không cần thay đổi: " . $movieSlugFromDB . "<br>";
                        }
                    } else {
                        echo "Không có dữ liêu được tìm thấy với slug: " . $movieSlugFromDB . "<br>";
                    }
                }
            }
        } else {
            echo "Không có kết quả.";
        }
    }

    public function updateEpisodesUrlFromApi()
    {
        // Thực hiện truy vấn để lấy thông tin từ cơ sở dữ liệu
        $sql = "SELECT movies.total_episodes,movies.id,movies.slug,episodes.url,episodes.episode
        FROM movies,episodes
        WHERE movies.id=episodes.movie_id and episodes.url IS NOT NULL and total_episodes > 1";

        $result = mysqli_query($this->db, $sql);

        if ($result->num_rows > 0) {
            // Lặp qua từng dòng kết quả
            while ($row = $result->fetch_assoc()) {
                $movieId = $row["id"];
                $movieSlugFromDB = $row["slug"];
                $totalEpisode = $row['total_episodes'];

                $episodeNumber = $row["episode"];
                $urlFromDb = $row["url"];
                // echo "Giá trị  \$episodeNumber- 1 là: " . ($episodeNumber - 1) . "<br>";

                if ($totalEpisode > 1) {
                    // Lấy thông tin từ API
                    $apiUrl = "https://ophim1.com/phim/" . $movieSlugFromDB;
                    $jsonData = @file_get_contents($apiUrl);
                    if ($jsonData === false) {
                        echo "Không thể lấy dữ liệu từ API cho phim có ID " . $movieId . "<br>";
                        continue;
                    }

                    // Giải mã dữ liệu JSON
                    $data = json_decode($jsonData, true);
                    // echo "------------------->>>>tong so tap trong api là: " . (count($data['episodes'][0]['server_data'])) . "<br>";
                    if ($episodeNumber - 1 < count($data['episodes'][0]['server_data'])) {
                        // Kiểm tra xem dữ liệu từ API có hợp lệ không
                        if ($data && isset($data['status']) && $data['status'] === true) {

                            $urlFromAPI = $data['episodes'][0]['server_data'][$episodeNumber - 1]['link_embed'];

                            // Kiểm tra xem URL từ API có khác với URL từ cơ sở dữ liệu không
                            if ($urlFromDb != $urlFromAPI) {
                                // Cập nhật URL trong cơ sở dữ liệu
                                $sqlUpdate = "UPDATE episodes SET url='$urlFromAPI' WHERE movie_id='$movieId' AND episode='$episodeNumber'";
                                if ($this->db->query($sqlUpdate) === TRUE) {
                                    echo "Đã cập nhật URL cho tập " . $episodeNumber . " của phim có ID " . $movieId . "<br>";
                                } else {
                                    echo "Lỗi khi cập nhật URL: " . $this->db->error . "<br>";
                                }
                            } else {
                                echo "URL cho tập " . $episodeNumber . " của phim có ID " . $movieId . " không cần thay đổi.<br>";
                            }
                        } else {
                            echo "Số tập phim từ API không khớp với số tập phim từ cơ sở dữ liệu cho phim có ID " . $movieId . "<br>";
                        }
                    } else {
                        echo "Không có thông tin về tập số $episodeNumber cho phim có ID $movieId";
                    }
                } else {
                    echo "Không có dữ liệu hợp lệ từ API cho phim có ID " . $movieId . "<br>";
                    // }
                    // } else {
                    //     echo "Không có dữ liệu hợp lệ từ API cho phim có ID " . $movieId . "<br>";
                    // }
                }
            }
        } else {
            echo "Không có kết quả trả về từ truy vấn.";
        }

    }
}
