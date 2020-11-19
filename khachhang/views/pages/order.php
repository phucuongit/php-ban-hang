<?php ?>
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
                            <th scope="col">Mã đơn hàng</th>
                            <th scope="col">Thời gian</th>
                            <th scope="col">Tổng tiền</th>
                            <th scope="col">Trạng thái</th>
                            <th scope="col">Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php if(isset($products)) { ?>
                        <?php if(count($products) ===0) { ?>
                            <tr>
                                <td colspan="5" style="text-align: center;">
                                    Đơn hàng trống
                                </td>
                            </tr>
                        <?php }else { ?>
                      
                        <?php foreach($products as $product) {?>
                            <tr>
                                <td style="width: 10%">
                       
                                    <p>#<?= $product['id'] ?></p>
                                     
                                </td>
                                <td>
                                    <h5><?=  formatDate($product['created_at'])  ?></h5>
                                </td>
                                <td  style="width: 15%">
                                   <h5><?= $product['total']  ?></h5>
                                </td>
                                <td  style="width: 20%">
                                    <h5 style="color:<?= $product['status'] == 2 ? 'green' : 'red'?>"><?= $this->getOrderRepository()->statusOrder($product['status'])  ?></h5>
                                </td>
                                <td>
                                    <a href="">Chi tiết</a>
                                </td>
                            </tr>

                        <?php }  } ?>
                    <?php } else { ?>
                        <tr>
                            <td colspan="5" style="text-align: center;">
                                Đơn hàng trống
                            </td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
               
            </div>
        </div>
    </div>
</section>
