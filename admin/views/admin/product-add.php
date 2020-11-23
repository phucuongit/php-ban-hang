<section class="content">
<form action="<?= BASE_ADMIN_URL . isset($product) ? 'san-pham/them-moi?action=edit' : 'san-pham/them-moi?action=add'?>" method="post" enctype="multipart/form-data">
    <div class="row">
      
            <div class="col-md-6">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Thông tin sản phẩm</h3>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="inputName">Tên sản phẩm</label>
                            <input type="text" placeholder="Nhập tên sản phẩm" name="title" class="form-control" value="<?= @$product['title'] ?>"/>
                        </div>
                        <div class="form-group">
                            <label for="inputDescription">Mô tả sản phẩm</label>
                            <textarea class="form-control"  placeholder="Nhập mô tả sản phẩm" name="description" rows="4" ><?= @$product['description'] ?></textarea>
                        </div>
                        <div class="form-group">
                            <label for="inputDescription">Mô tả ngắn</label>
                            <textarea class="form-control" placeholder="Nhập mô tả ngắn"  name="short_des" rows="4"><?= @$product['short_des'] ?></textarea>
                        </div>

                        <input type="hidden" name="id" class="form-control"value="<?= @$product['id'] ?>" />
                        <div class="form-group">
                            <label for="inputProjectLeader">Số lượng kho</label>
                            <input type="text" name="in_stock" placeholder="Nhập số lượng kho" class="form-control"value="<?= @$product['in_stock'] ?>" />
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Thông tin sản phẩm</h3>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="inputName">Danh sách danh mục</label>
                            <?php foreach($categories as $category) { ?>
                                <div class="custom-control custom-radio">
                                    <input class="custom-control-input" type="radio" <?= @($product['category_id'] == $category->id ? 'checked': '') ?> name="category_id" id="category<?= $category->id ?>" value="<?= $category->id ?>" />
                                    <label for="category<?= $category->id ?>" class="custom-control-label"><?= $category->name ?></label>
                                </div>
                            <?php } ?>
                        </div>
                        <div class="form-group">
                            <label for="inputClientCompany">Giá</label>
                            <input type="text" name="price" placeholder="Nhập giá" class="form-control" value="<?= @$product['price'] ?>"/>
                        </div>
                        <div class="form-group">
                            <label for="inputClientCompany">Hình ảnh</label>
                            <input type="file" name="image_url" class="form-control" accept="image/*"/>
                            <?php if(isset($product)) {?>
                                <img src="<?= @$product['image_url'] ?>" alt="image_product" style="max-width: 100%">
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <button type="submit" class="form-control submit_product btn-primary" style="margin-bottom: 1rem;">Lưu</button>
            </div>
          
    </div>
    <?php if(isset($error)){ ?>
        <p class="bg-danger ui-draggable ui-draggable-handle" style="padding: 15px;"><?= @$error ?></p>
    <?php }?>
   
    </form>
</section>
