<div class="col-lg-4 col-sm-6">
    <div class="single_product_item">
        <a href="<?= BASE_URL . 'san-pham/' . $product->slug ?>">
            <img src="<?= BASE_ADMIN_URL . $product->image_url ?>" alt=""
                onerror="this.onerror=null;this.src='<?= BASE_URL . 'assets/img/default.png' ?>';"
                style="width: 100%;  max-height: 250px;" />
            <div class="single_product_text">
                <h4><?= $product->title ?></h4>
                <h3><?=formatCurrency($product->price) ?></h3>
                <?php if($product->in_stock > 0) { ?>
                <input type="hidden" name="product_id" value="<?= $product->id ?>">
                <a href="<?= BASE_URL . 'san-pham/' . $product->slug ?>" class="add_cart">Thêm giỏ hàng</a>
                <?php }else {?>
                <a>Hết hàng</a>
                <?php }?>
            </div>
        </a>
    </div>
</div>