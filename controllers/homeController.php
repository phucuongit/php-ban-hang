<?php
require_once('baseController.php');
require_once('models/Product.php');

class HomeController extends baseController{

    public function index(){
        $products = Product::all();
        $data = array('products' => $products, 'title' => 'Trang chủ - Cường Lê');
        $this->render('home', $data);
    }

    public function error(){
      $this->render('error');
    }
}