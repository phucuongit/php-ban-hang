<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?= isset($title) ? $title  : 'Trang quản trị'?></title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="<?= BASE_URL ?>assets/css/all.css"  />
  <link rel="stylesheet" href="<?= BASE_URL ?>assets/css/adminlte.css">
  <link rel="stylesheet" href="<?= BASE_URL ?>assets/css/admin.css">
  <link rel="stylesheet" href="<?= BASE_URL ?>assets/css/font.css">
  <link rel="icon" type="image/png"  href="<?= BASE_ADMIN_URL ?>assets/img/favicon.png">
  <script src="<?= BASE_ADMIN_URL ?>assets/js/ckeditor.js"></script>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
  <div class="alert alert-success alert-dismissible hidden">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <h5><i class="icon fas fa-check"></i> Thông báo!</h5>
  </div>
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
 
    <ul class="navbar-nav ml-auto">

      <li class="nav-item">
        <a class="nav-link menu-mobile" data-widget="control-sidebar" data-slide="true" href="#" role="button">
          <i class="fas fa-th-large"></i>
        </a>
      </li>
    </ul>
  </nav>
 

    <?php require_once('sidebarAdmin.php') ?>

  <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Dashboard</h1>
          </div>
        </div>
      </div>
    </div>

    <?= @$content ?>
  </div>
    <?php require_once('footerAdmin.php')?>
  <aside class="control-sidebar control-sidebar-dark">
  </aside>
</div>

<script src="<?= BASE_URL ?>assets/js/admin.js"></script>

</body>
</html>
