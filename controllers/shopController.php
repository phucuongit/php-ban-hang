<?php
require_once('baseController.php');
require_once('models/Product.php');
require_once('models/Category.php');

class ShopController extends baseController{

    public function index(){
        $products = Product::all();
        
        $category = Product::allProdCate();
        $data = array(
            'products' => $products, 
            'categories' => $category
        );
        // echo '<pre>';
        // var_dump($category);
        $this->render('shop', $data);
    }

    public function error(){
      $this->render('error');
    }
}