<?php
namespace Admin\Controllers;

use KH\Models\Product;
use KH\Models\Category;

use Admin\Controllers\BaseController;

use Admin\Repositories\ProductRepository;

require_once('baseController.php');

require_once('../khachhang/models/Product.php');
require_once('../khachhang/models/Category.php');

require_once('repositories/ProductRepository.php');

class ProductController extends BaseController{

    protected $productRepository;

    public function __construct()
    {
        parent::__construct();
        if(!isAdminLogin()){
            return $this->redirect('dang-nhap');
        }
        $this->setProductRepository();
    }

    public function getProductRepository(): ProductRepository{
        return $this->productRepository;
    }
    public function setProductRepository(){
        return $this->productRepository = new ProductRepository();
    }

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

    public function prodDel(){
        $id = $_POST['id'];
        $product = Product::findById($id);
        $productDel = new Product(convertArray($product), true);
 
        if($productDel->delete($id)){
            echo json_encode([
                'status'    => "OK",
                "message"   => "Xóa thành công sản phẩm"
            ]);
        }else{
            echo json_encode([
                'status'    => "ERROR",
                "code"      => "prodDel.failed.data_not_found",
                "message"   => "Không thể xóa sản phẩm do còn có đơn đặt hàng sản phẩm này"
            ]);
        }
        return;
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
            'image_url' =>  $target_dir.$name,
            'slug'  => str_slug($title),
            'short_des' => $shortDes
        );

        $product = new Product($productInfo);
    
        $response = $product->save();

        $products = Product::all();
        $data = array('products' => $products, 'error' => $response['message']);
        $this->render('product', $data, 'adminLayout');   
    }

    public function detail($id)
    {
        $id = $_GET['id'];
      
        $product = Product::findById($id);
  
        if(!$product){
            return $this->redirect('error');
        }
        
        $data = array('title' => $product->title . 'Cường Lê Shop','product' => convertArray($product), 'categories' => Category::all());
        
        $this->render('product-add', $data, 'adminLayout');  
    }

    public function edit()
    {
        $data = [];
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

        $nameSave = $this->getProductRepository()->handleUpload($_FILES, $error);
     
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
            'image_url' =>  $nameSave,
            'short_des' => $shortDes
        );

        Product::updateProduct($productInfo);

        $this->redirect('san-pham');   
    }
}