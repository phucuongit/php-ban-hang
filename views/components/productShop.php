
    <div class="col-lg-4 col-sm-6">
            <div class="single_product_item">
            <a href="/san-pham/<?= $product->slug ?>">
                <img src="<?= $product->image_url ?>" alt="" />
                <div class="single_product_text">
                    <h4><?= $product->title ?></h4>
                    <h3><?= $product->price ?> VND</h3>
                    <input type="hidden" name="product_id" value="<?= $product->id ?>">
                    <a href="/san-pham/<?= $product->slug ?>" class="add_cart">Thêm giỏ hàng</a>
                </div>
             </a>
            </div>
    </div>
