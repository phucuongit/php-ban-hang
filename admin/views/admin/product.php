<section class="content">

<div class="card">
  <div class="card-header">
    <h3 class="card-title">Danh sách sản phẩm</h3>

    <div class="card-tools">
      <a type="button" class="btn btn-primary" href="/admin/san-pham/them-moi">
        <i class="fas fa-plus-circle"></i>Thêm mới</a>
    </div>
  </div>
  <div class="card-body p-0 cart-list-item">
    <table class="table table-striped projects">
        <thead>
            <tr>
                <th style="width: 1%">
                    ID
                </th>
                <th style="width: 20%">
                    Hình ảnh
                </th>
                <th style="width: 30%">
                    Tên sản phẩm 
                </th>
                <th>
                    Còn lại trong kho
                </th>
                <th style="width: 8%" class="text-center">
                    Trạng thái
                </th>
                <th style="width: 20%">
                    Hành động
                </th>
            </tr>
        </thead>
        <tbody>
            <?php 
                if(count($products) === 0){ ?>
                    <tr><td colspan="6" style="text-align: center">Không tìm thấy sản phẩm</td></tr>
                <?php } ?>
            <?php foreach($products as $product) {?>
                <tr>
                
                        <td>
                            <?= $product->id ?>
                        </td>
                        <td>
                            <img src="<?= $product->image_url ?>" alt="" style="max-width: 100%"  onerror="this.onerror=null;this.src='<?= BASE_ADMIN_URL . 'assets/img/default-150x150.png' ?>';">
                        </td>
                
                        <td>
                            <?= $product->title ?>
                        </td>
                        <td class="project_progress">
                            <small>
                                <?= $product->in_stock . ' ' ?> sản phẩm
                            </small>
                        </td>
                        <td class="project-state">
                            <span class="badge <?= $product->in_stock === 0 ? 'badge-error' : 'badge-success'?>"><?= $product->in_stock === 0 ? 'Hết hàng': 'Đang bán' ?></span>
                        </td>
                        <td class="project-actions text-right">
                            <a class="btn btn-primary btn-sm" target="_blank" href="/san-pham/<?= $product->slug ?>">
                                <i class="fas fa-folder">
                                </i>
                                Xem
                            </a>
                            <a class="btn btn-info btn-sm" href="/admin/san-pham?action=detail&id=<?= $product->id ?>">
                                <i class="fas fa-pencil-alt">
                                </i>
                                Chỉnh sửa
                            </a>
                       
                            <a class="btn btn-danger btn-sm prod-del" style="color: white">
                                <i class="fas fa-trash">
                                </i>
                                <input type="hidden" name="id" value="<?= $product->id ?>"/>
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