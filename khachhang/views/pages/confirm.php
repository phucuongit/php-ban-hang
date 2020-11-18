<section class="confirmation_part section_padding">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="confirmation_tittle">
                    <span>Cám ơn. Bạn đã đặt hàng thành công.</span>
                </div>
            </div>
  
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="order_details_iner">
                    <h3>Chi tiết đơn hàng</h3>
                    <table class="table table-borderless">
                        <thead>
                            <tr>
                                <th scope="col" colspan="2">Sản phẩm</th>
                                <th scope="col">Số lượng</th>
                                <th scope="col">Tổng cộng</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($products as $product) { ?>
                                <tr>
                                    <th colspan="2"><span><?= $product['title'] ?></span></th>
                                    <th>x<?= $product['quality'] ?></th>
                                    <th><span><?= number_format( $product['quality'] * $product['price'], 0, ".", ",")  ?></span></th>
                                </tr>
                            <?php } ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th scope="col">Tổng cộng: <?=number_format( $total , 0, ".", ",") ?> đ</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
