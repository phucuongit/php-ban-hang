<section class="content">
<form action="<?= (isset($category) ? '/admin/danh-muc?action=edit' : '/admin/danh-muc/them-moi?action=add')  ?>" method="post" enctype="multipart/form-data">
    <div class="row">

    <div class="col-md-12">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Thông tin danh mục</h3>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label for="inputDescription">Tên danh mục</label>
                    <input type="text" name="name" class="form-control" placeholder="Nhập tên danh mục" value="<?= @$category['name'] ?>"/>
                </div>
                <div class="form-group">
                    <label for="inputDescription">Mô tả</label>
                    <input type="text" name="description" placeholder="Nhập mô tả" class="form-control" value="<?= @$category['description'] ?>"/>
                </div>
                <?php if(isset($category)){ ?>
                    <input type="hidden" name="id" class="form-control" value="<?= @$category['id'] ?>"/>
                <?php } ?>
            </div>
        </div>
    </div>

      
    </div>
    <?php if(isset($error)){ ?>
        <p class="bg-danger ui-draggable ui-draggable-handle" style="padding: 15px;"><?= @$error ?></p>
    <?php }?>
    <button type="submit" class="form-control submit_product btn-primary">Lưu</button>
    </form>
</section>
