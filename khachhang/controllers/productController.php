<?php
namespace KH\Controllers;

use KH\Models\Product;

use KH\Controllers\BaseController;

require_once('baseController.php');
require_once('models/Product.php');
require_once('models/Category.php');
require_once('ICartController.php');

class ProductController extends BaseController implements ICartController{

    public function index($arguments){
        $product = Product::findBySlug($arguments[2]);
  
        if(!$product){
            $this->error();
            return;
        }

        $data = array('title' => $product->title . ' - Cường Lê Shop','product' => $product);
        $this->render('product', $data);
    }

    
    public function addToCart(){
      
        $id = $_POST['product_id'];
        $quality = $_POST['quality'];
        
        $product = Product::findById($id);

        header("Content-Type: application/json");

        if(!$product){
            echo json_encode([
                'status'    => "ERROR",
                "code"      => "addToCart.failed.not_found_product_id",
                "message"   => "Không thể thêm vào giỏ hàng"
            ]);
            return;
        }
        $itemAdd = array('id' => $id, 'quality' => $quality);
        if(!isset($_SESSION['item'][$id])){
            $_SESSION['item'][$id] = array(
                'id' => $id, 
                'quality' => $quality
            );
        } else {
            $_SESSION['item'][$id]['quality'] += $quality;
        }
        echo json_encode([
            'status' => "OK",
            "message"   => "Thêm thành công sản phẩm ".$product->title." vào giỏ hàng"
        ]);
        return;
    }

  
}