
<section class="product_list">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="section_tittle text-center">
                    <h2>Sản phẩm nổi bật</h2>
                </div>
            </div>
        </div>
	<div class="row align-items-center justify-content-between">
		<?php foreach($products as $product){
			require('views/components/production.php');
		} ?>
	</div>
</section>
