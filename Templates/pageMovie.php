<!DOCTYPE html>
<html>

<head>
  <?php include_once 'Templates/link.php'; ?>
</head>

<body>
  <div class="layout_hasNavbarFixedTop__3">
    <?php include_once 'Templates/navbar.php'; ?>

    <section style="margin: 30px 0px 30px 0px" class="section">
      <div class="container">
        <div class="title-list">

<?php $category_id = null; // Biến để lưu trữ giá trị category_id
while ($row = mysqli_fetch_assoc($data)) {
    $category_id = $row['category_id']; // Lưu giá trị category_id vào biến
    break;
    mysqli_data_seek($data, 0); 

}?>
          <?php
          $row = mysqli_fetch_assoc($data);
          if ($row) {
            echo '<h1 class="title is-3">' . $row['category_name_vn'] . '</h1>';
          }
          mysqli_data_seek($data, 0);
          ?>
          <div class="grid columns is-mobile is-multiline is-variable is-2">
            <?php
            while ($row = mysqli_fetch_assoc($data)) { ?>
              <div class="column is-one-fifth-fullhd is-one-quarter-desktop is-one-third-tablet is-half-mobile">
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
          <div>
          
            <?php foreach ($arr as $temp) {
              
              // nếu trang hiện tại lớn hơn 1 và tổng trang lớn hơn 1 mới hiển thị nút prev
            
              //
              echo '<nav class="pagination-container pagination undefined" role="navigation" aria-label="pagination">';
              echo '<ul class="pagination-list undefined">';

              for ($i = 1; $i <= $temp['total_page']; $i++) {
                echo '<li>';
                if ($i == $temp['current_page']) {
                  echo '<span class="pagination-link is-current" aria-label="Goto page ' . $i . '" aria-current="page">' . $i . '</span>';
                } else {
                  echo '<a class="pagination-link" href="index.php?task=pagemovie&category='.$category_id.'&page=' . $i . '" aria-label="Goto page ' . $i . '" aria-current="false">' . $i . '</a>';
                }
                echo '</li>';
              }

              echo '</ul>';
              if ($temp['current_page'] > 1 && $temp['total_page'] > 1) {
                echo '<a class="pagination-previous  nav undefined" href="index.php?task=pagemovie&category='.$category_id.'&page=' . ($temp['current_page'] - 1) . '">Prev</a>  ';
              }
              if ($temp['current_page'] < $temp['total_page'] && $temp['total_page'] > 1) {
                echo '<a class="pagination-next nav undefined" href="index.php?task=pagemovie&category='.$category_id.'&page=' . ($temp['current_page'] + 1) . '">Next</a>  ';
              }

              echo '</nav>';

              // nếu current_page < $total_page và total_page > 1 mới hiển thị nút next
              
             
            } ?>
           

          </div>
          
        </div> 
      </div>
    </section>

  </div>


</body>

</html>