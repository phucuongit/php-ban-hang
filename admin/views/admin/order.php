<section class="content">

<div class="card">
  <div class="card-header">
    <h3 class="card-title">Danh sách đơn hàng</h3>
  </div>
  <div class="card-body p-0 cart-list-item">
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
                    <tr><td colspan="6" style="text-align: center">Không tìm thấy đơn hàng</td></tr>
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
                            <p><?=  number_format($order['total'], 0, ".", ",") ?> VND</p>
                        </td>
                        <td>
                            <p><?= formatDate($order['created_at']) ?></p>
                        </td>
                        <td>
                            <p><span class="badge badge-<?=  ($order['status'] == 2) ? "success" : "danger" ?>"> <?=  $this->orderRepository->statusOrder($order['status']) ?></span></p>
                        </td>
             
                        <td class="project-actions text-right">
                            <a class="btn btn-primary btn-sm" target="_blank" href="<?= BASE_ADMIN_URL ?>don-hang?action=detail&id=<?= $order['id'] ?>">
                                <i class="fas fa-folder">
                                </i>
                                Xem
                            </a>
                          
                            <?php if(isAdmin()) {?>
                            <a class="btn btn-danger btn-sm order-del" style="color: white">
                                <i class="fas fa-trash">
                                </i>
                                <input type="hidden" name="id" value="<?= $order['id'] ?>"/>
                                Xóa
                            </a>
                            <?php } ?>
                           
                        </td>
                </tr>
            <?php } ?>
            <p><?= @$error ?></p>
        </tbody>
    </table>
  </div>
</div>
</section>