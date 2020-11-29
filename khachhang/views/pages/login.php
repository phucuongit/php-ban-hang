<section class="login_part section_padding padding_top">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 col-md-6">
                <div class="login_part_text text-center">
                    <div class="login_part_text_iner">
                        <h2>Đăng ký tài khoản</h2>
                        <p>Vui lòng tạo đăng nhập/tài khoản đề đặt hàng</p>
                        <a href="<?= BASE_URL . 'dang-ky' ?>" class="btn_3">Tạo tài khoản</a>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 col-md-6">
                <div class="login_part_form">
                    <div class="login_part_form_iner">
                        <h3>
                            Chào mừng trở lại ! <br />
                        </h3>
                        <form class="row contact_form" action="<?= BASE_URL . 'dang-nhap?action=login' ?>"
                            method="post">
                            <div class="col-md-12 form-group p_star">
                                <input type="text" class="form-control" id="username" name="username" value=""
                                    placeholder="Tài khoản" />
                            </div>
                            <div class="col-md-12 form-group p_star">
                                <input type="password" class="form-control" id="password" name="password" value=""
                                    placeholder="Mật khẩu" />
                            </div>
                            <p class="error_message"><?= @$error ?></p>
                            <div class="col-md-12 form-group">
                                <button type="submit" value="submit" class="btn_3">
                                    Đăng nhập
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>