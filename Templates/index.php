<html>

<head>
  <?php include_once 'Templates/link.php'; ?>
</head>

<body>
  <div>
    <div class="layout_hasNavbarFixedTop__3">
      <?php include_once 'Templates/navbar.php'; ?>

      <section style="margin: 0px 0px 30px 0px" class="section">
        <div class="container">
          <div class="title_homepage__3xhkI">
            <h2 style="margin: 10px 0px 20px 0px">
              <span style="margin: 10px 0px 10px 0px">Phim đề cử</span>
            </h2>
            <div class="title-list">
              <div class="grid columns is-mobile is-multiline is-variable is-2">

                <?php
                while ($row = mysqli_fetch_assoc($data['popular'])) { ?>
                  <div style="margin-bottom:30px;" class="column is-one-fifth-fullhd is-one-quarter-desktop is-one-third-tablet is-half-mobile">
                    <a class="cover" href="index.php?task=detailphim&id=<?php echo $row['id']; ?>">
                      <img src="<?php echo $row['image']; ?>" alt="Badland Hunters" title="<?php echo $row['name_movie']; ?>" />
                    </a>
                    <h3 class="name vi">
                      <a href="index.php?task=detailphim&id=<?php echo $row['id']; ?>"><?php echo $row['name_movie']; ?></a>
                    </h3>
                    <h3 class="name en">
                      <a href="index.php?task=detailphim&id=<?php echo $row['id']; ?>"><?php echo $row['origin_name']; ?></a>
                    </h3>
                  </div>
                <?php } ?>

              </div>

              <!-- Phin le -->


              <h2 style="margin: 20px 0px 20px 0px">
                <span style="margin: 10px 0px 10px 0px">Phim lẻ mới cập nhật</span>

                <a style="margin: 10px 20px 10px 0px" href="index.php?task=pagemovie&category=<?php $row = mysqli_fetch_assoc($data['movies']);
                                                                                              if ($row) {
                                                                                                echo $row['category_id'];
                                                                                              }
                                                                                              mysqli_data_seek($data['movies'], 0); ?>">
                  Xem tất cả
                </a>

              </h2>
              <div class="title-list">
                <div class="grid columns is-mobile is-multiline is-variable is-2">
                  <?php
                  while ($row = mysqli_fetch_assoc($data['movies'])) { ?>
                    <div style="margin-bottom:30px;" class="column is-one-fifth-fullhd is-one-quarter-desktop is-one-third-tablet is-half-mobile">
                      <a class="cover" href="index.php?task=detailphim&id=<?php echo $row['id']; ?>">
                        <img src="<?php echo $row['image']; ?>" />
                      </a>
                      <h3 class="name vi">
                        <a href="index.php?task=detailphim&id=<?php echo $row['id']; ?>"><?php echo $row['name_movie']; ?></a>
                      </h3>
                      <h3 class="name en">
                        <a href="index.php?task=detailphim&id=<?php echo $row['id']; ?>"><?php echo $row['origin_name']; ?></a>
                      </h3>
                    </div>
                  <?php } ?>
                </div>
              </div>

              <!-- phim bo -->
              <h2 style="margin: 20px 0px 20px 0px">
                <span style="margin: 10px 0px 10px 0px">Phim bộ mới cập nhật</span>
                <a style="margin: 10px 20px 10px 0px" href="index.php?task=pagemovie&category=<?php $row = mysqli_fetch_assoc($data['tvseries']);
                                                                                              if ($row) {
                                                                                                echo $row['category_id'];
                                                                                              }
                                                                                              mysqli_data_seek($data['tvseries'], 0); ?>">
                  Xem tất cả
                </a>
              </h2>
              <div class="title-list">
                <div class="grid columns is-mobile is-multiline is-variable is-2">
                  <?php
                  while ($row = mysqli_fetch_assoc($data['tvseries'])) { ?>
                    <div style="margin-bottom:30px;" class="column is-one-fifth-fullhd is-one-quarter-desktop is-one-third-tablet is-half-mobile">
                      <a class="cover" href="index.php?task=detailphim&id=<?php echo $row['id']; ?>">
                        <img src="<?php echo $row['image']; ?>" alt="" title="" />
                      </a>
                      <h3 class="name vi">
                        <a href="index.php?task=detailphim&id=<?php echo $row['id']; ?>"><?php echo $row['name_movie']; ?></a>
                      </h3>
                      <h3 class="name en">
                        <a href="index.php?task=detailphim&id=<?php echo $row['id']; ?>"><?php echo $row['origin_name']; ?></a>
                      </h3>
                    </div>
                  <?php } ?>
                </div>
              </div>
            </div>
          </div>
      </section>

     <?php require_once "Templates/footer.php"?>
    </div>
  </div>
</body>

</html>