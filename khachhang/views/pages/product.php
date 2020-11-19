<section>
    <div class="product_image_area section_padding">
        <div class="container">
            <div class="row s_product_inner justify-content-between">
                <div class="col-lg-7 col-xl-7">
                    <div class="product_slider_img">
                        <div class="lSSlideOuter vertical" style="text-align: center;">
                            <div class="lSSlideWrapper usingCss" style="height: 450px;">
                                <div id="vertical" class="lightSlider lsGrab lSSlide" >
                                    <div class="lslide active" style="height: 450px; margin-bottom: 0px;">
                                        <img src="<?= BASE_URL . $product->image_url ?>" alt="image_thumb" onerror="this.onerror=null;this.src='<?= BASE_URL . 'assets/img/placeholder.png' ?>';"/>
                                    </div>
                      
                                </div>
                                <div class="lSAction"><a class="lSPrev"></a><a class="lSNext"></a></div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-lg-5 col-xl-4">
                    <form action="/san-pham/<?=$product->slug?>?action=addToCart" method="post">
                        <div class="s_product_text">
                            <h3><?= $product->title ?></h3>
                            <h2><?= formatCurrency($product->price) ?></h2>
                            <ul class="list list_info">
                                <li>
                                    <a class="active" href="#"> <span>Category:</span><?= $product->name ?></a>
                                </li>
                                <li>
                                    <span>Kho: </span><em style="color: <?= ($product->in_stock > 0) ? 'green' : 'red'?>"><?= ($product->in_stock > 0) ? 'Còn '.$product->in_stock.' sản phẩm' : 'Hết hàng'?></em>
                                </li>
                            </ul>
                            <p>
                            <?= $product->short_des ?>
                            </p>
                            <?php if($product->in_stock > 0){ ?>
                                <div class="card_area d-flex justify-content-between align-items-center">
                            
                                    <div class="product_count">
                                        <span class="inumber-decrement"> <i class="ti-minus"></i></span>
                                        <input class="input-number" name="quality" type="text" value="1" min="0" max="<?= $product->in_stock ?>"/>
                                        <span class="number-increment"> <i class="ti-plus"></i></span>
                                    </div>
                                    
                                    <input type="hidden" name="product_id" value="<?= $product->id ?>">
                                    <a style="cursor: pointer" type="submit" class="btn_3 add_cart">Mua hàng</a>
                            
                                </div>
                            <?php } ?>
                        </div>
                    </form>
                 
                </div>
            </div>
        </div>
    </div>
</section>
<section class="product_description_area">
    <div class="container">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="home-tab" >Mô tả</a>
            </li>
        </ul>

        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade active show" id="home" role="tabpanel" aria-labelledby="home-tab">
                <?= $product->description ?>
            </div>
        </div>
    </div>
</section>

