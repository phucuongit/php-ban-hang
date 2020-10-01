<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?= isset($title) ? $title : "Web Ban Hang" ?></title>
        <link rel="stylesheet" href="/assets/css/style.css" />
        <link rel="stylesheet" href="/assets/css/all.css" />
        <link rel="stylesheet" href="/assets/css/my.css" />
        <link rel="stylesheet" href="/assets/css/icon.css">
        <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
        <link rel="icon" type="image/png"  href="/assets/img/favicon.png">
    </head>
    <body>
        <?php require_once('header.php') ?>
        <?php require_once('views/components/alert.php') ?>
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
        <script src="/assets/js/app.js"></script>
    </body>
</html>
