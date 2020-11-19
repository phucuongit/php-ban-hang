<?php
namespace Admin\Controllers;

use KH\Models\Product;
use KH\Models\Category;
use KH\Models\Pagination;

use Admin\Controllers\BaseController;

require_once('baseController.php');
require_once('../khachhang/models/Product.php');
require_once('../khachhang/models/Category.php');
require_once('../khachhang/models/Pagination.php');

class ShopController extends BaseController{

    use Pagination;

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

        $this->setPagination($config);
        $currentPage = $this->getCurrentPage();

        $products = Product::paginate($currentPage, $config['limit'],isset($_GET['name']) ? $name : 'full');

        $data = array(
            'title' => 'Cửa hàng - Cường Lê Shop',
            'products' => $products, 
            'categories' => $category,
            'page'  => $this->getPagination(),
            'total' => $config['total']
        );
        $this->render('shop', $data);
    }

    public function error(){
      $this->render('error');
    }
}