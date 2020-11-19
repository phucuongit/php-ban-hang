<?php
namespace Admin\Controllers;

use KH\Models\Product;

use Admin\Controllers\BaseController;

require_once('baseController.php');
require_once('../khachhang/models/Product.php');

class PageController extends BaseController{

    public function index(){
        $products = Product::all();
        $data = array('title' => 'Liên hệ - Cường Lê Shop','products' => $products);
        $this->render('page', $data, 'page-layout');
    }

    public function error(){
      $this->render('error');
    }
}