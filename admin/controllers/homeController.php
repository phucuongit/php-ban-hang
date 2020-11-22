<?php
namespace Admin\Controllers;

use Admin\Controllers\BaseController;

use KH\Models\Product;

require_once('baseController.php');
require_once('../khachhang/models/Product.php');

class HomeController extends BaseController{

    public function __construct()
    {
        parent::__construct();
        if(!isAdminLogin()){
            return $this->redirect('dang-nhap');
        }
    }
    
    public function index(){
        $products = Product::allFeature(8);
        $data = array('products' => $products, 'title' => 'Trang chủ - Cường Lê');
        $this->render('home', $data);
    }

}