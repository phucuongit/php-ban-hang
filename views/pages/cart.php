<section class="cart_area section_padding">
    <div class="container">
    <div class="error_message">
    <?= @$error ?>
    </div>
        <div class="cart_inner">
       
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Sản phẩm</th>
                            <th scope="col">Giá</th>
                            <th scope="col">Số lượng</th>
                            <th scope="col">Tổng</th>
                            <th scope="col">Xoa</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php if(isset($products)) { ?>
                        <?php if(count($products) ===0) { ?>
                            <tr>
                                <td colspan="4" style="text-align: center;">
                                    Giỏ hàng trống
                                </td>
                            </tr>
                        <?php }else { ?>
                        <form action="/gio-hang?action=update" method="post">
                        <?php foreach($products as $product) {?>
                            <tr>
                                <td style="width: 40%">
                                    <div class="media" style="flex-direction: column;">
                                        <div class="d-flex">
                                
                                            <img src="<?= $product['image_url'] ?>" alt="" onerror="this.onerror=null;this.src='/assets/img/default.png';"/>
                                        </div>
                                        <div class="media-body">
                                            <p><?= $product['title'] ?></p>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <h5><?= number_format( $product['price'] , 0, ".", ",")  ?> đ</h5>
                                </td>
                                <td>
                                    <div class="product_count">
                                        <span class="input-number-decrement"> <i class="ti-angle-down"></i></span>
                                        <input class="input-number" type="text" name="quality[<?= $product['id'] ?>]" value="<?= $product['quality'] ?>" min="0" />
                                        <input type="hidden" name="product_id[<?= $product['id'] ?>]" value="<?= $product['id'] ?>">
                                        <span class="input-number-increment"> <i class="ti-angle-up"></i></span>
                                    </div>
                                </td>
                                <td>
                                    <h5><?= number_format( $product['price'] * $product['quality'] , 0, ".", ",")  ?> đ</h5>
                                </td>
                                <td>
                                    <button class="del-cart">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                            <?php } ?>
                            <tr class="bottom_button">
                                <td>
                                    <button style="border: none;"class="btn_1" type="submit">Cập nhật giỏ hàng</button>
                                </td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td>
                                    <h5>Tổng tiền</h5>
                                </td>
                                <td>
                                    <h5><?= number_format( $total , 0, ".", ",")  ?> đ</h5>
                                </td>
                            </tr>
                        </form>
                        <?php } ?>
                    <?php } else { ?>
                        <tr>
                                <td colspan="4" style="text-align: center;">
                                    Giỏ hàng trống
                                </td>
                            </tr>
                    <?php } ?>
                    </tbody>
                </table>
                <div class="checkout_btn_inner float-right">
                    <a class="btn_1" href="/cua-hang">Tiếp tục mua hàng</a>
                    <a class="btn_1 checkout_btn_1" href="/gio-hang?action=confirm">Đặt hàng</a>
                </div>
            </div>
        </div>
    </div>
</section>
