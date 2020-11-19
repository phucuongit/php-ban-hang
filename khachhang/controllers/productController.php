<?php
namespace KH\Controllers;

use KH\Models\Product;

use KH\Controllers\baseController;

require_once('baseController.php');
require_once('models/Product.php');
require_once('models/Category.php');
require_once('ICartController.php');

class ProductController extends baseController implements ICartController{

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
        if(isset($this->router[3]) && $this->router[3]  === 'them-moi'){
            $data = array(
                'categories' => Category::all(),
            );
            $this->render('product-add', $data, 'adminLayout');
        }else{
            $products = Product::all();
            $data = array('title' => 'Quản lý sản phẩm - Cường Lê', 'products' => $products);
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
        $data = array();
        $title = htmlspecialchars($_POST['title']);
        $shortDes = htmlspecialchars($_POST['short_des']);
        $inStock = (int)$_POST['in_stock'];
        $price = (int)$_POST['price'];
        $cateId = $_POST['category_id'] ?? NULL;
      
        $des = htmlspecialchars($_POST['description']);
        $error = '';
     
        if(empty($title)){
            $error .= 'Vui lòng nhập tiêu đề<br>';
        }

        if(empty($shortDes)){
            $error .= 'Vui lòng nhập mô tả ngắn<br>';
        }
        
        if(empty($des)){
            $error .= 'Vui lòng nhập mô tả dai<br>';
        }
        if(!isset($_FILES['image_url'])){
            $error .= 'Vui lòng upload hình ảnh<br>';
        }
        if(!isset($inStock)  || !is_int($inStock) || $inStock <= 0){
            $error .= 'Vui lòng nhập số lượng trong kho đúng định dạng<br>';
        }

        if(!isset($price) && !is_int($price) || $price <= 0){
            $error .= 'Vui lòng nhập đúng định dạng giá sản phẩm<br>';
        }
       
        if(!isset($cateId) && !is_int($cateId)){
            $error .= 'Vui lòng chọn danh mục sản phẩm<br>';
        }

        $name =  time() . '.' . $_FILES['image_url']['name'];
        $target_dir = "assets/img/upload/";
        $target_file = $target_dir . basename($name);
        
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

        $extensions_arr = array("jpg","jpeg","png","gif");
    
        if( !in_array($imageFileType,$extensions_arr) ){
            $error .= 'Vui lòng nhập đúng định dạng hình ảnh<br>';
        }else if($_FILES['image_url']['size'] > 2000000){
            $error .= 'Vui lòng upload hình ảnh nhỏ hơn 2M<br>';
        }else{
            move_uploaded_file($_FILES['image_url']['tmp_name'],$target_dir.$name);
        }

        if($error != ''){
            $data = array('error' => $error, 'categories' => Category::all());
            return $this->render('product-add', $data, 'adminLayout');  
        }
  
        $productInfo = array(
            'title' =>  $title,
            'description'   =>  $des,
            'price' => $price,
            'category_id'   => $cateId,
            'in_stock' => $inStock,
            'image_url' =>  "/".$target_dir.$name,
            'slug'  => str_slug($title),
            'short_des' => $shortDes
        );

        $product = new Product($productInfo);
    
        $response = $product->save();

        $products = Product::all();
        $data = array('products' => $products, 'error' => $response['message']);
        $this->render('product', $data, 'adminLayout');   
    }
    public function detail($id){
        $regex = "/id=(\d+)/";
        preg_match($regex, $id[0], $match);
        if(!isset($match[1])){
            return "Loi";
        }
        $id = $match[1];
        $product = Product::findById($id);

        $data = array('title' => $product->title . 'Cường Lê Shop','product' => convertArray($product), 'categories' => Category::all());
        
        $this->render('product-add', $data, 'adminLayout');  
    }
    public function edit(){
        $data = array();
        $title = htmlspecialchars($_POST['title']);
        $shortDes = htmlspecialchars($_POST['short_des']);
        $id = (int)$_POST['id'];
        $inStock = (int)$_POST['in_stock'];
        $price = (int)$_POST['price'];
        $cateId = $_POST['category_id'] ?? NULL;
      
        $des = htmlspecialchars($_POST['description']);
        $error = '';
     
        if(empty($title)){
            $error .= 'Vui lòng nhập tiêu đề<br>';
        }

        if(empty($shortDes)){
            $error .= 'Vui lòng nhập mô tả ngắn<br>';
        }
        
        if(empty($des)){
            $error .= 'Vui lòng nhập mô tả dai<br>';
        }
        if(!isset($_FILES['image_url'])){
            $error .= 'Vui lòng upload hình ảnh<br>';
        }
        if(!isset($inStock)  || !is_int($inStock) || $inStock < 0){
            $error .= 'Vui lòng nhập số lượng trong kho đúng định dạng<br>';
        }

        if(!isset($price) && !is_int($price) || $price <= 0){
            $error .= 'Vui lòng nhập đúng định dạng giá sản phẩm<br>';
        }
       
        if(!isset($cateId) && !is_int($cateId)){
            $error .= 'Vui lòng chọn danh mục sản phẩm<br>';
        }

        $name =  time() . '.' . $_FILES['image_url']['name'];
        $target_dir = "assets/img/upload/";
        $target_file = $target_dir . basename($name);
        
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

        $extensions_arr = array("jpg","jpeg","png","gif");

        if( !in_array($imageFileType,$extensions_arr) ){
            $error .= 'Vui lòng nhập đúng định dạng hình ảnh<br>';
        }else if($_FILES['image_url']['size'] > 2000000){
            $error .= 'Vui lòng upload hình ảnh nhỏ hơn 2M<br>';
        }else{
            move_uploaded_file($_FILES['image_url']['tmp_name'],$target_dir.$name);
        }

        if($error != ''){
            $product = Product::findById($id);
            $data = array('error' => $error, 'product' => convertArray($product), 'categories' => Category::all());
  
            return $this->render('product-add', $data, 'adminLayout');  
        }
  
        $productInfo = array(
            'id'    => $id,
            'title' =>  $title,
            'description'   =>  $des,
            'price' => $price,
            'category_id'   => $cateId,
            'in_stock' => $inStock,
            'image_url' =>  "/" .$target_dir.$name,
            'short_des' => $shortDes
        );

        Product::updateProduct($productInfo);
    

        $products = Product::all();
        $data = array('products' => $products, 'error' => $response['message']);
        $this->render('product', $data, 'adminLayout');   
    }
}