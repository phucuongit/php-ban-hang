<section>
    <?php //echo '<pre>'; var_dump($product) ?>
    <div class="product_image_area section_padding">
        <div class="container">
            <div class="row s_product_inner justify-content-between">
                <div class="col-lg-7 col-xl-7">
                    <div class="product_slider_img">
                        <div class="lSSlideOuter vertical" style="padding-right: 105px;">
                            <div class="lSSlideWrapper usingCss" style="height: 450px;">
                                <div id="vertical" class="lightSlider lsGrab lSSlide" style="height: 1800px; transform: translate3d(0px, 0px, 0px);">
                                    <div class="lslide active" style="height: 450px; margin-bottom: 0px;">
                                        <img src="<?= $product->image_url ?>" alt="image_thumb"/>
                                    </div>
                      
                                </div>
                                <div class="lSAction"><a class="lSPrev"></a><a class="lSNext"></a></div>
                            </div>
                            <!-- <ul class="lSPager lSGallery" style="margin-left: 5px; width: 100px; transition-duration: 600ms; height: 607.167px; transform: translate3d(0px, 0px, 0px);">
                                <li style="width: 100%; height: 146.66666666666666px; margin-bottom: 5px;" class="active">
                                    <a href="#"><img src="/assets/img/product/single-product/product_1.png" /></a>
                                </li>
                                <li style="width: 100%; height: 146.66666666666666px; margin-bottom: 5px;">
                                    <a href="#"><img src="/assets/img/product/single-product/product_1.png" /></a>
                                </li>
                                <li style="width: 100%; height: 146.66666666666666px; margin-bottom: 5px;">
                                    <a href="#"><img src="/assets/img/product/single-product/product_1.png" /></a>
                                </li>
                                <li style="width: 100%; height: 146.66666666666666px; margin-bottom: 5px;">
                                    <a href="#"><img src="/assets/img/product/single-product/product_1.png" /></a>
                                </li>
                            </ul> -->
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 col-xl-4">
                    <form action="/san-pham/<?=$product->slug?>?action=addToCart" method="post">
                        <div class="s_product_text">
                            <h3><?= $product->title ?></h3>
                            <h2><?= $product->price ?> đ</h2>
                            <ul class="list list_info">
                                <li>
                                    <a class="active" href="#"> <span>Category:</span><?= $product->name ?></a>
                                </li>
                                <li>
                                    <span>Kho: </span><em style="color: green">Còn hàng</em>
                                </li>
                            </ul>
                            <p>
                            <?= $product->short_des ?>
                            </p>
                            <div class="card_area d-flex justify-content-between align-items-center">
                                <div class="product_count">
                                    <span class="inumber-decrement"> <i class="ti-minus"></i></span>
                                    <input class="input-number" name="quality" type="text" value="1" min="0" />
                                    <span class="number-increment"> <i class="ti-plus"></i></span>
                                </div>
                                <input type="hidden" name="product_id" value="<?= $product->id ?>">
                                <a style="cursor: pointer" type="submit" class="btn_3 add_cart">Mua hàng</a>
                            </div>
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
                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Mô tả</a>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade active show" id="home" role="tabpanel" aria-labelledby="home-tab">
                <?= $product->description ?>
            </div>
        </div>
    </div>
</section>
<section class="product_list best_seller">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="section_tittle text-center">
                    <h5 style="font-size: 30px">Sản phẩm liên quan</h5>
                </div>
            </div>
        </div>
        <!-- <div class="row align-items-center justify-content-between">
            <div class="col-lg-12">
            <div class="owl-item cloned" style="width: 262.5px; margin-right: 30px;">
                    <div class="single_product_item">
                        <img src="img/product/product_2.png" alt="" />
                        <div class="single_product_text">
                            <h4>Quartz Belt Watch</h4>
                            <h3>$150.00</h3>
                        </div>
                    </div>
            </div>
        </div> -->
    </div>
</section>
