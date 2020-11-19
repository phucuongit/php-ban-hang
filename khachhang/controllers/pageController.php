<?php
namespace KH\Controllers;

use KH\Models\Product;

use KH\Controllers\baseController;

require_once('baseController.php');
require_once('models/Product.php');

class PageController extends baseController{

    public function index(){
        $products = Product::all();
        $data = array('title' => 'Liên hệ - Cường Lê Shop','products' => $products);
        $this->render('page', $data, 'page-layout');
    }

    public function error(){
      $this->render('error');
    }
}