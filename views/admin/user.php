<section class="content">

<div class="card">
  <div class="card-header">
    <h3 class="card-title">Danh sách người dùng</h3>
  </div>
  <div class="card-body p-0">
    <table class="table table-striped projects">
        <thead>
            <tr>
                <th style="width: 10%">
                    ID
                </th>
                <th style="width: 20%">
                    Người dùng
                </th>
                <th style="width: 20%">
                    Họ tên
                </th>
                <th style="width: 20%">
                    Hành động
                </th>
            </tr>
        </thead>
        <tbody>
            <?php 
                if(count($users) === 0){ ?>
                    <tr><td colspan="6" style="text-align: center">Không có bất kì user nào</td></tr>
                <?php } ?>
            <?php foreach($users as $user) {?>
                <tr>
                
                        <td>
                            <?= $user['id'] ?>
                        </td>
                        <td>
                            <p><?= $user['username'] ?> VND</p>
                        </td>
                        <td>
                            <p><?= $user['fullname'] ?></p>
                        </td>
                        <td class="project-actions text-right">
                            <a class="btn btn-primary btn-sm" target="_blank" href="/admin/don-hang?action=detail&id=<?= $order['id'] ?>">
                                <i class="fas fa-folder">
                                </i>
                                Sửa
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