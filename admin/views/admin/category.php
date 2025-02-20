<section class="content">

<div class="card">
  <div class="card-header">
    <h3 class="card-title">Danh sách danh mục</h3>

    <div class="card-tools">
      <a type="button" class="btn btn-primary" href="<?= BASE_ADMIN_URL . 'danh-muc/them-moi?action=addCate' ?>">
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
                    Tên danh mục
                </th>
                <th style="width: 20%">
                    Mô tả danh mục
                </th>
                <th style="width: 20%">
                    Hành động
                </th>
            </tr>
        </thead>
        <tbody>
            <?php 
                if(count($categories) === 0){ ?>
                    <tr><td colspan="6" style="text-align: center">Không có danh mục</td></tr>
                <?php } ?>
            <?php foreach($categories as $category) {?>
                <tr>
                
                        <td>
                            <?= $category['id'] ?>
                        </td>
                        <td>
                            <?= $category['name'] ?>
                        </td>
                        <td>
                            <?= $category['description'] ?>
                        </td>
                        <td class="project-actions text-right">
                            <a class="btn btn-info btn-sm" href="<?= BASE_ADMIN_URL . 'danh-muc?action=detail&id=' . $category['id'] ?>">
                                <i class="fas fa-pencil-alt">
                                </i>
                                Chỉnh sửa
                            </a>
                       
                            <a class="btn btn-danger btn-sm cate-del" style="color: white">
                                <i class="fas fa-trash">
                                </i>
                                <input type="hidden" name="id" value="<?= $category['id'] ?>"/>
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