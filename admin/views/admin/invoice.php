<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="invoice p-3 mb-3">

                    <div class="row">
                        <div class="col-12">
                            <h4>
                                <i class="fas fa-globe"></i> Cuong Le, Inc.

                            </h4>
                        </div>

                    </div>

                    <div class="row invoice-info">
                        <div class="col-sm-4 invoice-col">
                            Từ
                            <address>
                                <strong>Cuong Le, Inc.</strong><br>
                                B1805744<br>
                                Đại học Cần Thơ<br>
                                Số điện thoại: <em>0349265776</em><br>
                                Email: lpcuong21062000@gmail.com
                            </address>
                        </div>

                        <div class="col-sm-4 invoice-col">
                            Đến
                            <address>

                                <strong><?= (isset($order->fullname) && !empty($order->fullname) )? $order->fullname : '<em>(Trống)</em>' ?></strong><br>
                                Email:
                                <?= isset($order->email) && !empty($order->email) ? $order->email : '<em>(Trống)</em>' ?><br>
                                Địa chỉ giao hàng:
                                <?= isset($order->address) && !empty($order->address) ? $order->address : '<em>(Trống)</em>' ?><br>
                                Số điện thoại:
                                <?= isset($order->phone_number) && !empty($order->phone_number) ? $order->phone_number : '<em>(Trống)</em>' ?><br>
                                Ghi chú:
                                <?= isset($order->note) && !empty($order->note) ? $order->note : '<em>(Trống)</em>' ?><br>
                                Phương thức thanh toán:
                                <b
                                    class="text-primary"><?= isset($order->payment_method) ? $this->orderRepository->methodShip($order->payment_method) : '(Trống)' ?></b><br>
                            </address>
                            <p>Trạng thái đơn hàng:
                                <b class="show_status"><?= $this->orderRepository->statusOrder($order->status) ?></b>
                            </p>
                            <?php if(isAdmin()) {?>
                            <div class="form-group update_status">
                                <label>Chọn</label>
                                <select class="form-control" name="update_status">
                                    <option value="0">Đợi xác nhận</option>
                                    <option value="1">Đang vận chuyển</option>
                                    <option value="2">Đã giao hàng</option>
                                </select>
                            </div>
                            <button class="btn btn-primary updateStatus" style="margin-bottom: 30px;">Cập nhật trạng
                                thái đơn hàng</button>
                            <?php }?>
                        </div>

                        <div class="col-sm-4 invoice-col">
                            <b>ID đơn hàng: #<?= $order->id ?></b><br>
                            <br>
                            <b>Ngày tạo: </b><?= formatDate($order->created_at) ?><br>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>Tên sản phẩm</th>
                                        <th>Số lượng</th>
                                        <th>Thành tiền</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php $id=1; foreach($products as $product ){?>
                                    <tr>

                                        <td><?= $id ?></td>
                                        <td><?= $product['title'] ?></td>
                                        <td><?= $product['quality'] ?></td>
                                        <td><?= $product['price']  ?> VND</td>
                                    </tr>
                                    <?php 
                                        $id++;
                                    } ?>
                                </tbody>
                            </table>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-6">
                            <img src="<?= BASE_ADMIN_URL ?>assets/img/credit/visa.png" alt="Visa">
                            <img src="<?= BASE_ADMIN_URL ?>assets/img/credit/mastercard.png" alt="Mastercard">
                            <img src="<?= BASE_ADMIN_URL ?>assets/img/credit/american-express.png"
                                alt="American Express">
                            <img src="<?= BASE_ADMIN_URL ?>assets/img/credit/paypal2.png" alt="Paypal">

                            <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
                                Cám ơn bạn đã đặt hàng bên chúng tôi
                            </p>
                        </div>
                        <!-- /.col -->
                        <div class="col-6">
                            <div class="table-responsive">
                                <table class="table">
                                    <tr>
                                        <th>Tổng thành tiền:</th>
                                        <td><?= $order->total ?> VND</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="row no-print">
                        <div class="col-12">
                            <a target="_blank" class="btn btn-default" onClick="window.print()"><i
                                    class="fas fa-print"></i> In hóa đơn</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>