<div class="col-lg-3 col-sm-6 col-6">
    <a href="/san-pham/<?= $product->slug ?>">
        <div class="single_product_item">
            <img src="/assets/img/product/product_1.png" alt="" />
            <div class="single_product_text">
                <h4><?= $product->title ?></h4>
                <h3><?= $product->price ?></h3>
                <input type="hidden" name="product_id" value="<?= $product->id ?>">
                <a href="/san-pham/<?= $product->slug ?>" class="add_cart">Thêm giỏ hàng</a>
            </div>
        </div>
    </a>
</div>