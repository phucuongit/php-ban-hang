<section class="cart_area section_padding">
    <div class="container">
        <div class="error_message">
            <?= @$error ?>
        </div>

        <div class="cart_inner row">
            <div class="col-md-8">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Sản phẩm</th>
                                <th scope="col">Giá</th>
                                <th scope="col">Số lượng</th>
                                <th scope="col">Tổng</th>
                                <th scope="col">Xóa sản phẩm</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(isset($products)) { ?>
                            <?php if(count($products) ===0) { ?>
                            <tr>
                                <td colspan="5" style="text-align: center;">
                                    Giỏ hàng trống
                                </td>
                            </tr>
                            <?php }else { ?>
                            <form action="<?= BASE_URL . 'gio-hang?action=update'?>" method="post">
                                <?php foreach($products as $product) {?>
                                <tr>
                                    <td style="width: auto">

                                        <p><?= $product['title'] ?></p>

                                    </td>
                                    <td>
                                        <h5><?= formatCurrency( $product['price'])  ?></h5>
                                    </td>
                                    <td style="width: 15%">
                                        <div class="product_count">
                                            <span class="input-number-decrement"> <i class="ti-angle-down"></i></span>
                                            <input class="input-number" type="text"
                                                name="quality[<?= $product['id'] ?>]" value="<?= $product['quality'] ?>"
                                                min="0" />
                                            <input type="hidden" name="product_id[<?= $product['id'] ?>]"
                                                value="<?= $product['id'] ?>">
                                            <span class="input-number-increment"> <i class="ti-angle-up"></i></span>
                                        </div>
                                    </td>
                                    <td style="width: 20%">
                                        <h5><?= formatCurrency( $product['price'] * $product['quality'])  ?></h5>
                                    </td>
                                    <td>
                                        <button class="del-cart">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                                <?php } ?>

                                <tr>
                                    <td colspan="2">
                                        <button style="border: none;" class="btn_1" type="submit">Cập nhật giỏ
                                            hàng</button>
                                    </td>
                                    <td>
                                        <h5>Tổng tiền</h5>
                                    </td>
                                    <td colspan="2">
                                        <h5><?= formatCurrency( $total )  ?></h5>
                                    </td>
                                </tr>

                                <?php } ?>
                                <?php } else { ?>
                                <tr>
                                    <td colspan="5" style="text-align: center;">
                                        Giỏ hàng trống
                                    </td>
                                </tr>
                                <?php } ?>
                            </form>
                        </tbody>
                    </table>
                    <div class="checkout_btn_inner float-right">
                        <a class="btn_1" href="<?= BASE_URL ?>cua-hang">Tiếp tục mua hàng</a>

                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <form action="<?= BASE_URL . 'gio-hang?action=confirm' ?>" method="POST">
                    <p>Thông tin giao hàng</p>

                    <div class="row ship_info">
                        <div class="col-12">
                            <span>Họ và tên: <b class="error_message">*</b></span>
                            <input type="text" class="form-control" name="fullname" placeholder="Họ và tên">
                        </div>
                        <div class="col-6">
                            <span>Email:</span>
                            <input type="email" class="form-control" placeholder="Email" name="email" />
                        </div>
                        <div class="col-6">
                            <span>Số điện thoại: <b class="error_message">*</b></span>
                            <input type="text" class="form-control" name="phone_number" placeholder="Số điện thoại" />
                        </div>
                        <div class="col-12">
                            <span>Địa chỉ: <b class="error_message">*</b></span>
                            <input type="text" class="form-control" name="address" placeholder="Địa chỉ" />
                        </div>
                        <div class="col-12">
                            <span>Ghi chú:</span>
                            <textarea type="text" class="form-control" name="note"
                                placeholder="Ghi chú VD: Vui lòng giao trước 7h"></textarea>
                        </div>

                    </div>

                    <p>Phương thức thanh toán: <b class="error_message">*</b></p>

                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="payment_method" id="cod" value="1" checked>
                        <label class="form-check-label" for="cod">
                            Thanh toán khi nhận hàng
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="payment_method" id="transfer" value="0">
                        <label class="form-check-label" for="transfer">
                            Chuyển khoản
                        </label>
                    </div>
                    <div class="error_message">
                        <?= @$errorCart ?>
                    </div>
                    <button type="submit" class="btn_1 checkout_btn_1" style="margin-top: 10px">Đặt hàng</button>
                </form>
            </div>
        </div>
    </div>

</section>