<?php $user = $_SESSION['adminLogin'] ?>
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="<?= BASE_ADMIN_URL ?>" class="brand-link">
        <span class="brand-text font-weight-light">Shop CuongLe</span>
    </a>

    <div
        class="sidebar os-host os-theme-light os-host-overflow os-host-overflow-y os-host-resize-disabled os-host-scrollbar-horizontal-hidden os-host-transition">
        <div class="os-resize-observer-host observed">
            <div class="os-resize-observer" style="left: 0px; right: auto;"></div>
        </div>
        <div class="os-size-auto-observer observed" style="height: calc(100% + 1px); float: left;">
            <div class="os-resize-observer"></div>
        </div>
        <div class="os-padding">
            <div class="os-viewport os-viewport-native-scrollbars-invisible">
                <div class="os-content" style="padding: 0px 8px; height: 100%; width: 100%;">
                    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                        <div class="image">
                            <img src="<?= BASE_ADMIN_URL ?>assets/img/user.png" class="img-circle elevation-2"
                                alt="User Image" />
                        </div>
                        <div class="info">
                            <a href="#" class="d-block"><?= $user['fullname']?></a>
                        </div>
                    </div>

                    <nav class="mt-2">
                        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                            data-accordion="false">
                            <li class="nav-item has-treeview">
                                <a href="<?= BASE_ADMIN_URL ?>"
                                    class="nav-link <?= isCurrentPage(BASE_ADMIN_URL) ? 'active' : ''?>">
                                    <i class="fas fa-tachometer-alt"></i>
                                    <p>
                                        Dashboard
                                    </p>
                                </a>

                            </li>

                            <li class="nav-item">
                                <a href="<?= BASE_ADMIN_URL ?>don-hang"
                                    class="nav-link <?= isCurrentPage(BASE_ADMIN_URL . 'don-hang') ? 'active' : ''?>">
                                    <i class="far fa-chart-bar"></i>
                                    <p>
                                        Đơn hàng của tôi
                                    </p>
                                </a>
                            </li>

                            <li class="nav-header">Quản trị</li>
                            <li class="nav-item">
                                <a href="<?= BASE_ADMIN_URL ?>san-pham"
                                    class="nav-link <?= isCurrentPage( BASE_ADMIN_URL . 'san-pham') ? 'active' : ''?>">
                                    <i class="fas fa-cubes"></i>
                                    <p>
                                        Quản lý sản phẩm
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= BASE_ADMIN_URL ?>danh-muc"
                                    class="nav-link <?= isCurrentPage(BASE_ADMIN_URL .'danh-muc') ? 'active' : ''?>">
                                    <i class="fab fa-battle-net"></i>
                                    <p>
                                        Quản lý danh mục
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= BASE_ADMIN_URL ?>user"
                                    class="nav-link <?= isCurrentPage(BASE_ADMIN_URL .'user') ? 'active' : ''?>">
                                    <i class="fas fa-users"></i>
                                    <p>
                                        Quản lý người dùng
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= BASE_ADMIN_URL ?>dang-nhap?action=logout" class="nav-link">

                                    <p>
                                        Đăng suất
                                    </p>
                                </a>
                            </li>

                        </ul>
                    </nav>
                </div>
            </div>
        </div>
        <div class="os-scrollbar os-scrollbar-horizontal os-scrollbar-unusable os-scrollbar-auto-hidden">
            <div class="os-scrollbar-track">
                <div class="os-scrollbar-handle" style="width: 100%; transform: translate(0px, 0px);"></div>
            </div>
        </div>
        <div class="os-scrollbar os-scrollbar-vertical os-scrollbar-auto-hidden">
            <div class="os-scrollbar-track">
                <div class="os-scrollbar-handle" style="height: 67.965%; transform: translate(0px, 0px);"></div>
            </div>
        </div>
        <div class="os-scrollbar-corner"></div>
    </div>
</aside>