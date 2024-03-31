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
      <div
        class="column is-half-tablet is-offset-one-quarter-tablet is-one-third-widescreen is-offset-one-third-widescreen">
        <h1 class="title has-text-grey marbt">Đăng nhập</h1>
        <div class="has-text-grey box">
          <form method="POST">
            <div class="field marbt">
              <div class="control inp"><input type="email" class="input is-large inp" name="email" placeholder="Email" value=""
                  required="">
              </div>
            </div>
            <div class="field marbt">
              <div class="control inp"><input type="password" class="input is-large inp" name="password" placeholder="Mật khẩu"
                  value="" required=""></div>
            </div>
        </div><button type="submit" name="login" class="button is-block is-info is-large is-fullwidth">Đăng
          nhập</button>
        </form>
      </div>
      <div style="text-align: center;"><a href="index.php?task=pageregister">Đăng ký</a></div>
    </div>
  </section>
</body>

</html>