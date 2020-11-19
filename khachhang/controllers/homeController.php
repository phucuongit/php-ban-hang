<?php
namespace KH\Controllers;

use KH\Controllers\BaseController;

use KH\Models\Product;

require_once('baseController.php');
require_once('models/Product.php');

class HomeController extends BaseController{

    public function index(){
        $products = Product::allFeature(8);
        $data = array('products' => $products, 'title' => 'Trang chủ - Cường Lê');
        $this->render('home', $data);
    }

    public function error(){
      $this->render('error');
    }
}