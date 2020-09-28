<section class="confirmation_part section_padding">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="confirmation_tittle">
                    <span>Cám ơn. Bạn đã đặt hàng thành công.</span>
                </div>
            </div>
  
            <!-- <div class="col-lg-6 col-lx-4">
                <div class="single_confirmation_details">
                    <h4>Billing Address</h4>
                    <ul>
                        <li>
                            <p>Street</p>
                            <span>: 56/8</span>
                        </li>
                        <li>
                            <p>city</p>
                            <span>: Los Angeles</span>
                        </li>
                        <li>
                            <p>country</p>
                            <span>: United States</span>
                        </li>
                        <li>
                            <p>postcode</p>
                            <span>: 36952</span>
                        </li>
                    </ul>
                </div>
            </div>
  -->
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
                                    <th><span><?= $product['quality'] * $product['price'] ?></span></th>
                                </tr>
                            <?php } ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th scope="col">Tổng cộng: <?= $total ?></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
