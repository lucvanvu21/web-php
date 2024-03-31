<!DOCTYPE html>
<html lang="en">

<head>
  <?php include_once "Templates/link.php";?>

</head>

<body>
<style>
    .inp{
      height: 60px;
    }
    .marbt{
      padding-bottom: 20px;
    }
  </style>
  <nav>
    <?php include_once "Templates/navbar.php";?>
  </nav>
  <section style="margin-top:150px;" class="section">
    <div class="container">
      <form method="POST">
        <div
          class="column is-half-tablet is-offset-one-quarter-tablet is-one-third-widescreen is-offset-one-third-widescreen">
          <h1 class="title has-text-grey marbt">Đăng ký</h1>
          <div class="box">
            <div class="field marbt">
              <div class="control"><input type="email" class="input is-large inp" name="email" placeholder="Email"
                  required="" value=""></div>
            </div>
            <div class="field marbt">
              <div class="control"><input class="input is-large inp" name="name" placeholder="Tên bạn" required="" value="">
              </div>
            </div>
            <div class="field marbt">
              <div class="control"><input type="password" class="input is-large inp" name="password" placeholder="Mật khẩu"
                  required="" value=""></div>
            </div><button name="register" type=" submit" class="button is-block is-info is-large is-fullwidth">Đăng
              ký</button>
          </div>
          <p class="has-text-grey has-text-right"><a href="index.php?task=pagelogin">Đăng nhập</a></p>
        </div>
      </form>
    </div>
  </section>
</body>

</html>