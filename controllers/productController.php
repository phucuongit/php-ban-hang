<?php
require_once('baseController.php');
require_once('models/Product.php');
require_once('ICartController.php');

class ProductController extends baseController implements ICartController{

    public function index($arguments){
        $product = Product::findBySlug($arguments[0]);

        if(!$product){
            $this->error();
            return;
        }

        $data = array('product' => $product);
        $this->render('product', $data);
    }

    
    public function addToCart(){
        $id = $_POST['product_id'];
        $quality = $_POST['quality'];

        $product = Product::findById($id);
        if(!$product){
            header('Location: /error');
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
        header('Location: /san-pham/' . $product->slug);
    }

    // admin 
    public function indexAdmin(){
        $data = array();
        if($this->router[3] === 'them-moi'){
            $this->render('product-add', $data, 'adminLayout');
        }else{
            $products = Product::all();
            $data = array('products' => $products);
            $this->render('product', $data, 'adminLayout');
        }
    }
    public function error(){
      $this->render('error');
    }
    public function prod_del(){
        $id = $_POST['id'];
        $product = Product::findById($id);
        $product = new Product(json_decode(json_encode($product), true));
        
        if($product->delete($id)){
            header('Location: /admin/san-pham/');
        }else{
            $data = array('error' => 'Loi xoa san pham');
            $this->render('product', $data, 'adminLayout');  
        }
    }
    public function add(){
        $productInfo = array(
            'title' =>  $_POST['title'],
            'description'   =>     $_POST['description'],
            'price' => $_POST['price'],
            'category_id'   => $_POST['category_id'],
            'in_stock' => $_POST['in_stock'],
            'image_url' =>  $_POST['image_url'],
            'slug'  => str_slug($_POST['title']),
            'short_des' => $_POST['short_des']
        );
        $product = new Product($productInfo);

        echo '<pre>';
        var_dump($product);
        return;
    }
}