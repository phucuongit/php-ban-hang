<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Đăng nhập quản trị</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="<?= BASE_URL ?>assets/css/ionicons.min.css">
  <link rel="stylesheet" href="<?= BASE_URL ?>assets/css/all.css"  />
  <link rel="stylesheet" href="<?= BASE_URL ?>assets/css/adminlte.css">
  <link rel="stylesheet" href="<?= BASE_URL ?>assets/css/admin.css">
  <link rel="stylesheet" href="<?= BASE_URL ?>assets/css/font.css">
  <link rel="icon" type="image/png"  href="<?= BASE_ADMIN_URL ?>assets/img/favicon.png">

</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="<?= BASE_ADMIN_URL ?>"><b>Quản trị bán hàng</b></a>
  </div>

  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Vui lòng đăng nhập</p>

      <form action="<?= BASE_ADMIN_URL ?>dang-nhap?action=login" method="post">
        <div class="input-group mb-3">
          <input type="text" name="username" class="form-control" placeholder="Tài khoản">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" name="password" placeholder="Mật khẩu">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
       
          <div class="col-12">
            <p class="errorMessage"><?= @$error ?></p>
            <button type="submit" class="btn btn-primary btn-block">Đăng nhập</button>
          </div>
   
        </div>
      </form>
    </div>
 
  </div>
</div>

<script src="<?= BASE_URL ?>plugins/jquery/jquery.min.js"></script>
<script src="<?= BASE_URL ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?= BASE_URL ?>assets/js/admin.js"></script>

</body>
</html>
