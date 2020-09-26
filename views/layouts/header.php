<header class="main_menu home_menu">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-12">
                <nav class="navbar navbar-expand-lg navbar-light">
                    <a class="navbar-brand" href="/">
                        <img src="/assets/img/logo_web.png" alt="logo" style="max-width: 250px;" />
                    </a>
                    <div class="collapse navbar-collapse main-menu-item" id="navbarSupportedContent">
                        <ul class="navbar-nav <?= (!isHome() ? 'navbar-menu' : '')?>">
                            <li class="nav-item">
                                <a class="nav-link" href="/">Trang chủ</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="/cua-hang">
                                    Cửa hàng
                                </a>
                            </li>
                            <!-- <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="blog.html" id="navbarDropdown_3" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    pages
                                </a>
                                <div class="dropdown-menu" >
                                    <a class="dropdown-item" href="login.html"> login</a>
                                    <a class="dropdown-item" href="tracking.html">tracking</a>
                                    <a class="dropdown-item" href="checkout.html">product checkout</a>
                                    <a class="dropdown-item" href="cart.html">shopping cart</a>
                                    <a class="dropdown-item" href="confirmation.html">confirmation</a>
                                    <a class="dropdown-item" href="elements.html">elements</a>
                                </div>
                            </li> -->
                            <!-- <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="blog.html">
                                    Bài viết
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown_2">
                                    <a class="dropdown-item" href="blog.html"> blog</a>
                                    <a class="dropdown-item" href="single-blog.html">Single blog</a>
                                </div>
                            </li> -->
                            <li class="nav-item">
                                <a class="nav-link" href="/lien-he">Liên hệ</a>
                            </li>
                            <?php if(isLogin()){ ?>
                                <li class="nav-item">
                                    <a class="nav-link" href="/dang-nhap?action=logout">Đăng suất</a>
                                </li>
                            <?php }else{ ?>
                                <li class="nav-item">
                                    <a class="nav-link" href="/dang-nhap">Đăng nhập</a>
                                </li>
                            <?php } ?>
                            <?php if(isLogin() && isAdmin() ){  ?>
                                <li class="nav-item">
                                    <a class="nav-link" href="/admin">Quản trị</a>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                    <div class="hearer_icon d-flex">
                        <div class="dropdown cart">
                            <a class="dropdown-toggle" href="/gio-hang" id="navbarDropdown3" role="button">
                                <i class="fas fa-cart-plus"></i>
                            </a>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </div>
    <div class="search_input" id="search_input_box" style="display: none;">
        <div class="container">
            <form class="d-flex justify-content-between search-inner">
                <input type="text" class="form-control" id="search_input" placeholder="Search Here" />
                <button type="submit" class="btn"></button>
                <span class="ti-close" id="close_search" title="Close Search"></span>
            </form>
        </div>
    </div>
</header>
<?php if($_SERVER['REQUEST_URI'] == '/') { ?>
    <section class="banner_part">
        <div class="container">
            <div class="row banner_slider"></div>
        </div>
    </section>
<?php } ?>
<style>
    .main_menu .cart i:after{
        content: "<?= count((array)(isset($_SESSION['item']) ? $_SESSION['item'] : [])); ?>"!important
    }
</style>