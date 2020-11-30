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
            <div class="col-md-12">
                <div class="order_details_iner">
                    <h3>Chi tiết đơn hàng #<?= $orderId ?></h3>
                    <p style="font-weight: bold; ">Tình trạng: <span
                            style="color: <?= ($status == 2) ? 'green' : 'red'?>"><?= $this->orderRepository->statusOrder($status) ?></span>
                    </p>
                    <p>Thông tin giao hàng</p>

                    <div class="row ship_info">
                        <div class="col-6">
                            <span>Họ và tên:</span>
                            <b><?= $order->fullname ?></b>
                        </div>
                        <div class="col-6">
                            <span>Email:</span>
                            <b><?= isset($order->email) && !empty($order->email) ? $order->email : '<em>(Trống)</em>' ?></b>
                        </div>
                        <div class="col-6">
                            <span>Số điện thoại:</span>
                            <b><?= $order->phone_number ?></b>
                        </div>
                        <div class="col-6">
                            <span>Địa chỉ:</span>
                            <b><?= $order->address ?></b>
                        </div>
                        <div class="col-6">
                            <span>Ghi chú:</span>
                            <b><?=  isset($order->note) && !empty($order->note) ? $order->note : '<em>(Trống)</em>' ?></b>
                        </div>

                    </div>
                    <div class="row ship_info">
                        <div class="col-12">
                            <p>Phương thức thanh toán: <b
                                    class="text-primary"><?= $this->orderRepository->methodShip($order->payment_method) ?></b>
                            </p>
                        </div>
                    </div>

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