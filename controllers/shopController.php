<?php
require_once('baseController.php');
require_once('models/Product.php');
require_once('models/Category.php');
require_once('models/Pagination.php');

class ShopController extends baseController{

    public function index(){
        
        $products = Product::all();
        
        $category = Product::allProdCate();
       
       
        $config = [
            'total' => count($products), 
            'limit' => 5,
            'full' => false, //bỏ qua nếu không muốn hiển thị full page
            'querystring' => 'trang' //bỏ qua nếu GET của bạn là page
        ];
        $page = new Pagination($config);
        $currentPage = $page->getCurrentPage();

        $products = Product::paginate($currentPage, $config['limit']);
    
        $data = array(
            'products' => $products, 
            'categories' => $category,
            'page'  => $page->getPagination()
        );
        $this->render('shop', $data);
    }

    public function error(){
      $this->render('error');
    }
}