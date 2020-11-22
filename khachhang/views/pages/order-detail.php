<section class="confirmation_part section_padding">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="goBack">
                   <a href="<?= BASE_URL ?>don-hang"><i class="fas fa-angle-left"></i>Trở về danh sách đơn đặt hàng</a>
                </div>
            </div>
           
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="order_details_iner">
                    <h3>Chi tiết đơn hàng #<?= $orderId ?></h3>
                    <p style="font-weight: bold; ">Tình trạng: <span style="color: <?= ($status == 2) ? 'green' : 'red'?>"><?= $this->orderRepository->statusOrder($status) ?></span></p>
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
                                    <th colspan="2"><span><?= $product->title ?></span></th>
                                    <th>x<?= $product->quality ?></th>
                                    <th><span><?= formatCurrency( $product->quality * $product->price)  ?></span></th>
                                </tr>
                            <?php } ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th scope="col">Tổng cộng: <?=formatCurrency($total) ?></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
