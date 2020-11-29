<header class="main_menu home_menu">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-12">
                <nav class="navbar navbar-expand-lg navbar-light">
                    <a class="navbar-brand" href="<?= BASE_URL ?>">
                        <img src="<?= BASE_URL . 'assets/img/logo_web.png' ?>" alt="logo" style="max-width: 250px;" />
                    </a>
                    <div class="collapse navbar-collapse main-menu-item" id="navbarSupportedContent">
                        <ul class="navbar-nav <?= (!isHome() ? 'navbar-menu' : '')?>">
                            <li class="nav-item">
                                <a class="nav-link" href="<?= BASE_URL?>">Trang chủ</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?= BASE_URL . 'cua-hang' ?>">
                                    Cửa hàng
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?= BASE_URL . 'lien-he'?>">Liên hệ</a>
                            </li>
                            <?php if(isLogin()) {  ?>
                            <li class="nav-item">
                                <a class="nav-link" href="<?= BASE_URL . 'don-hang'?>">Đơn hàng</a>
                            </li>
                            <?php } ?>
                            <?php if(isAdmin()) {  ?>
                            <li class="nav-item">
                                <a class="nav-link" href="<?= BASE_DIR_URL . 'admin'?>">Quản trị</a>
                            </li>
                            <?php } ?>
                            <?php if(isLogin()){ ?>
                            <li class="nav-item">
                                <a class="nav-link" href="<?= BASE_URL . 'dang-nhap?action=logout' ?>">Đăng suất</a>
                            </li>
                            <?php }else{ ?>
                            <li class="nav-item">
                                <a class="nav-link" href="<?= BASE_URL . 'dang-nhap' ?>">Đăng nhập</a>
                            </li>
                            <?php } ?>
                        </ul>
                    </div>
                    <div class="hearer_icon d-flex">
                        <div class="dropdown cart">
                            <a class="dropdown-toggle" href="<?= BASE_URL . 'gio-hang' ?>" id="navbarDropdown3"
                                role="button">
                                <i class="fas fa-cart-plus"></i>
                            </a>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </div>

</header>

<?php if($_SERVER['REQUEST_URI'] == BASE_URL || $_SERVER['REQUEST_URI'] == BASE_ROOT) { ?>
<section class="banner_part" style="background-image: url(<?= BASE_URL .'assets/img/banner.jpg'?>);">
    <div class="container">
        <div class="row banner_slider"></div>
    </div>
</section>
<?php } ?>
<style>
.main_menu .cart i:after {
    content: "<?= count((array)(isset($_SESSION['item']) ? $_SESSION['item'] : [])); ?>" !important
}
</style>