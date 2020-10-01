<section class="cat_product_area section_padding">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="left_sidebar_area">
                    <aside class="left_widgets p_filter_widgets" aria-label="filter-sp">
                        <div class="l_w_title">
                            <h3>Danh sách danh mục</h3>
                        </div>
                        <div class="widgets_inner">
                            <ul class="list">
                                <?php foreach($categories as $category){ ?>
                                    <li>
                                        <a href="/cua-hang?name=<?= $category->slug ?>"><?= $category->name ?></a>
                                        <span><?= $category->total_product ?></span>
                                    </li>
                                <?php } ?>
                            </ul>
                        </div>
                    </aside>
                </div>
            </div>
            <div class="col-lg-9">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="product_top_bar d-flex justify-content-between align-items-center">
                            <div class="single_product_menu">
                                <p><span><?= count($products) ?> </span> sản phẩm</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row align-items-center latest_product_inner">
                <?php 
                    foreach($products as $product){ 
                        require('views/components/productShop.php');
                    } 
                ?>
           
                  <div class="col-lg-12">
                        <div class="pageination">
                            <nav aria-label="Page navigation example">
                                <ul class="pagination justify-content-center">
                                   <?= $page ?>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
