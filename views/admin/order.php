<section class="content">

<div class="card">
  <div class="card-header">
    <h3 class="card-title">Danh sách đơn hàng</h3>
  </div>
  <div class="card-body p-0">
    <table class="table table-striped projects">
        <thead>
            <tr>
                <th style="width: 10%">
                    Đơn hàng
                </th>
                <th style="width: 20%">
                    Người đặt hàng
                </th>
                <th style="width: 20%">
                    Tổng tiền
                </th>
                <th style="width: 20%" class="text-center">
                    Ngày đặt hàng
                </th>
                <th style="width: 10%" class="text-center">
                    Trạng thái
                </th>
                <th style="width: 20%">
                    Hành động
                </th>
            </tr>
        </thead>
        <tbody>
            <?php 
                if(count($orders) === 0){ ?>
                    <tr><td colspan="6" style="text-align: center">Không tìm thấy sản phẩm</td></tr>
                <?php } ?>
            <?php foreach($orders as $order) {?>
                <tr>
                
                        <td>
                            <?= $order['id'] ?>
                        </td>
                        <td>
                            <p><?= $order['fullname'] ?></p>
                        </td>
                        <td>
                            <p><?= $order['total'] ?> VND</p>
                        </td>
                        <td>
                            <p><?= $order['created_at'] ?></p>
                        </td>
                        <td>
                            <p><?= getStatusOrder($order['status']) ?></p>
                        </td>
             
                        <td class="project-actions text-right">
                            <a class="btn btn-primary btn-sm" target="_blank" href="/admin/don-hang?action=detail&id=<?= $order['id'] ?>">
                                <i class="fas fa-folder">
                                </i>
                                Xem
                            </a>
                          
              
                            <a class="btn btn-danger btn-sm order-del" style="color: white">
                                <i class="fas fa-trash">
                                </i>
                                <input type="hidden" name="id" value="<?= $order['id'] ?>"/>
                                Xóa
                            </a>
    
                           
                        </td>
                </tr>
            <?php } ?>
            <p><?= @$error ?></p>
        </tbody>
    </table>
  </div>
</div>
</section>