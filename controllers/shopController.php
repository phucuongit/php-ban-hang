<?php
require_once('baseController.php');
require_once('models/Product.php');
require_once('models/Category.php');
require_once('models/Pagination.php');

class ShopController extends baseController{

    public function index(){

        $category = Product::allProdCate();
        $config = [
            'total' => 0, 
            'limit' => 5,
            'full' => false, //bỏ qua nếu không muốn hiển thị full page
            'querystring' => 'trang' //bỏ qua nếu GET của bạn là page
        ];
 
        if(isset($_GET['name'])){
            $name = $_GET['name'];
            $name = preg_replace("/\?". $config['querystring'] ."(.+)/", '', $name);
            $numProd = Product::numProdByCate($name);
            $config['total'] = $numProd['total_product'];
        }else{
            $products = Product::all();
            $config['total'] = count($products);
        }
      
        $page = new Pagination($config);
        $currentPage = $page->getCurrentPage();
        $products = Product::paginate($currentPage, $config['limit'],isset($_GET['name']) ? $name : 'full');

        $data = array(
            'title' => 'Cửa hàng - Cường Lê Shop',
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