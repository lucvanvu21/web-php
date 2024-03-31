<html>

<head>
  <?php include_once 'Templates/link.php'; ?>


</head>

<body>
  <style>
    .play {
      margin-top: 80px;
      text-align: center;
    }

    .play .playn {
      background-color: #000000;
    }

    .play iframe {
      /* background-color: aquamarine; */
      /* margin-top: 30px; */

      width: 90%;
      height: 80%;
      /* max-height: 400px; */
    }
  </style>
  <?php include_once 'Templates/navbar.php'; ?>
  <?php $category_id = null; // Biến để lưu trữ giá trị category_id
  while ($row = mysqli_fetch_assoc($movie)) {
    $id = $row['id']; // Lưu giá trị category_id vào biến
    break;
  } ?>

  <?php $episodeUrl = null; // Biến để lưu trữ giá trị category_id
  while ($row = mysqli_fetch_assoc($episode_movie)) {
    $episodeUrl = $row['url']; // Lưu giá trị category_id vào biến
    break;
  } ?>

  <?php foreach ($movie as $moviedetail) { ?>
    <div class="linkplay">
      <div class="play">
        <iframe style="margin-top:8px" src="<?= $episodeUrl ?>" frameborder="0" scrolling="0" allowfullscreen>
        </iframe>
      </div>
    </div>

    <div class="layout_hasNavbarFixedTop__3">


      <section class="">
        <div class="">
          <div class="title-watch">

            <section class="section">
              <div class="container">
                <div class="columns">
                  <div class="column is-two-thirds-tablet">
                    <h1 class="title is-3"><?php echo $moviedetail['name_movie'] ?></h1>
                    <h2 class="subtitle is-5"><?php echo $moviedetail['origin_name'] ?> (<a href="/year/2024"><?php echo $moviedetail['year'] ?></a>)</h2>
                    <div style="margin:20px" class="buttons are-small">
                      <a style="display: flex; align-items: center;" href="#" class="fb-share button is-link mr-3" target="_blank"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                          <path d="M448 80v352c0 26.5-21.5 48-48 48h-85.3V302.8h60.6l8.7-67.6h-69.3V192c0-19.6 5.4-32.9 33.5-32.9H384V98.7c-6.2-.8-27.4-2.7-52.2-2.7-51.6 0-87 31.5-87 89.4v49.9H184v67.6h60.9V480H48c-26.5 0-48-21.5-48-48V80c0-26.5 21.5-48 48-48h352c26.5 0 48 21.5 48 48z"></path>
                        </svg>
                        Chia sẻ</a>
                      <div class="dropdown is-hoverable">
                        <div class="dropdown-trigger">
                          <button style="display: flex; align-items: center;" class="collection-btn button is-info is-outlined unadded">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512">
                              <path d="M368 224H224V80c0-8.84-7.16-16-16-16h-32c-8.84 0-16 7.16-16 16v144H16c-8.84 0-16 7.16-16 16v32c0 8.84 7.16 16 16 16h144v144c0 8.84 7.16 16 16 16h32c8.84 0 16-7.16 16-16V288h144c8.84 0 16-7.16 16-16v-32c0-8.84-7.16-16-16-16z"></path>
                            </svg>
                            Bộ sưu tập
                          </button>
                        </div>
                        <div class="dropdown-menu" id="dropdown-menu" role="menu">
                          <div class="dropdown-content has-text-left">
                            <a href="#" class="dropdown-item">Thêm vào danh sách phim <strong>Đã Xem</strong></a><a href="#" class="dropdown-item">Thêm vào danh sách phim <strong>Muốn xem</strong></a>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                </div>



                <?php

                foreach ($arr as $temp) {
                  if ($temp['total_episode'] <= 1) {
                    continue;
                  }
                  echo '<div class="buttons" style="max-height: 250px; overflow: auto;">';

                  for ($i = 1; $i <= $temp['total_episode']; $i++) {
                    if ($i == $temp['current_episode']) {
                      echo '<a style="width:80px; height:40px; border-radius:8px;"class="button is-success" disabled="" aria-label="Goto page ' . $i . '" aria-current="page">' . $i . '</a>';
                    } else {
                      echo '<a style="width:80px; height:40px; border-radius:8px;" class="button is-success" href="index.php?task=detailphim&id=' . $id . '&episode=' . $i . '" aria-label="Goto page ' . $i . '" aria-current="false">' . $i . '</a>';
                    }
                  }

                  echo '</div>';
                } ?>
                <div>
                  <p class="subtitle-list-intro">
                    <?php echo $moviedetail['description'] ?>
                  </p>
                  <br />
                </div>

            </section>
          </div>
        </div>
      </section>
      <div id="modal-root"></div>

    </div>
  <?php } ?>

  <?php require_once "Templates/footer.php" ?>
</body>

</html>