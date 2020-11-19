<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?= @$title ?></title>
        <link rel="stylesheet" href="<?= BASE_URL . 'assets/css/style.css' ?>" />
        <link rel="stylesheet" href="<?= BASE_URL . 'assets/css/all.css' ?>" />
        <link rel="stylesheet" href="<?= BASE_URL . 'assets/css/my.css' ?>" />
       <link rel="stylesheet" href="<?= BASE_URL . 'assets/css/icon.css' ?>">
       <link rel="stylesheet" href="<?= BASE_URL . 'assets/css/css2.css' ?>">
    </head>
    <body>
        <?php require_once('header.php') ?>
        <?= @$content ?>
        <footer>
            <div class="copyright_part">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="copyright_text">
                                <p style="margin: 0">
                                  Bản quyền ©CuongLe B1805744 <i class="ti-heart" aria-hidden="true"></i>
                                </p>
                            </div>
                        </div>
                        <div class="col-lg-4 footer_social">
                            <div class="footer_icon social_icon">
                                <ul class="list-unstyled">
                                    <li>
                                        <a href="https://www.facebook.com/phucuong2106/" target="_blank" class="single_social_icon" rel="noopener noreferrer"><i class="fab fa-facebook-f"></i></a>
                                    </li>
                                    <li>
                                        <a href="https://twitter.com/lpcuong2106" target="_blank" class="single_social_icon" rel="noopener noreferrer"><i class="fab fa-twitter"></i></a>
                                    </li>
                                 
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <script src="<?= BASE_URL . 'assets/js/app.js' ?>"></script>
    </body>
</html>
