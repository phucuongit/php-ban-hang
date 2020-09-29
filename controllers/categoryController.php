<?php
require_once('baseController.php');
require_once('models/Category.php');


class CategoryController extends baseController{

    // admin 
    public function indexAdmin(){
        $data = array();
        if(isset($this->router[3]) && $this->router[3]  === 'them-moi'){
            $data = array(
                'categories' => convertObjectToArray(Category::all()),
            );
            $this->render('category-add', $data, 'adminLayout');
        }else{
            $categories = convertObjectToArray(Category::all());
            $data = array('categories' => $categories);
            $this->render('category', $data, 'adminLayout');
        }
    }
    public function error(){
      $this->render('error');
    }
    public function cateDel(){
        $id = $_POST['id'];
        if(Category::delete($id)){
            header('Location: /admin/danh-muc/');
        }else{
            $data = array('error' => 'Loi xoa danh muc');
            $this->render('category', $data, 'adminLayout');  
        }
    }
    public function add(){
        $data = array();
        $name = htmlspecialchars($_POST['name']);
        $description = htmlspecialchars($_POST['description']);
        
        $cate = array(
            'slug'  => str_slug($name),
            'name'  => $name,
            'description' => $description,
        );
     
        $category = new Category($cate);
       
        $category->save();

        $categories = convertObjectToArray(Category::all());
        $data = array('categories' => $categories);
        $this->render('category', $data, 'adminLayout');   
    }
    // public function detail($id){
    //     $regex = "/id=(\d+)/";
    //     preg_match($regex, $id[0], $match);
    //     if(!isset($match[1])){
    //         return "Loi";
    //     }
    //     $id = $match[1];
    //     $product = Product::findById($id);

    //     $data = array('product' => convertArray($product), 'categories' => Category::all());
        
    //     $this->render('product-add', $data, 'adminLayout');  
    // }
    // public function edit(){
    //     $data = array();
    //     $title = htmlspecialchars($_POST['title']);
    //     $shortDes = htmlspecialchars($_POST['short_des']);
    //     $id = (int)$_POST['id'];
    //     $inStock = (int)$_POST['in_stock'];
    //     $price = (int)$_POST['price'];
    //     $cateId = $_POST['category_id'] ?? NULL;
      
    //     $des = htmlspecialchars($_POST['description']);
    //     $error = '';
     
    //     if(empty($title)){
    //         $error .= 'Vui lòng nhập tiêu đề<br>';
    //     }

    //     if(empty($shortDes)){
    //         $error .= 'Vui lòng nhập mô tả ngắn<br>';
    //     }
        
    //     if(empty($des)){
    //         $error .= 'Vui lòng nhập mô tả dai<br>';
    //     }
    //     if(!isset($_FILES['image_url'])){
    //         $error .= 'Vui lòng upload hình ảnh<br>';
    //     }
    //     if(!isset($inStock)  || !is_int($inStock) || $inStock <= 0){
    //         $error .= 'Vui lòng nhập số lượng trong kho đúng định dạng<br>';
    //     }

    //     if(!isset($price) && !is_int($price) || $price <= 0){
    //         $error .= 'Vui lòng nhập đúng định dạng giá sản phẩm<br>';
    //     }
       
    //     if(!isset($cateId) && !is_int($cateId)){
    //         $error .= 'Vui lòng chọn danh mục sản phẩm<br>';
    //     }

    //     $name =  time() . '.' . $_FILES['image_url']['name'];
    //     $target_dir = "assets/img/upload/";
    //     $target_file = $target_dir . basename($name);
        
    //     $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

    //     $extensions_arr = array("jpg","jpeg","png","gif");
    
    //     if( !in_array($imageFileType,$extensions_arr) ){
    //         $error .= 'Vui lòng nhập đúng định dạng hình ảnh<br>';
    //     }else {
    //         move_uploaded_file($_FILES['image_url']['tmp_name'],$target_dir.$name);
    //     }

    //     if($error != ''){
    //         $product = Product::findById($id);
    //         $data = array('error' => $error, 'product' => convertArray($product), 'categories' => Category::all());
  
    //         return $this->render('product-add', $data, 'adminLayout');  
    //     }
  
    //     $productInfo = array(
    //         'id'    => $id,
    //         'title' =>  $title,
    //         'description'   =>  $des,
    //         'price' => $price,
    //         'category_id'   => $cateId,
    //         'in_stock' => $inStock,
    //         'image_url' =>  "/" .$target_dir.$name,
    //         'short_des' => $shortDes
    //     );

    //     Product::updateProduct($productInfo);
    

    //     $products = Product::all();
    //     $data = array('products' => $products, 'error' => $response['message']);
    //     $this->render('product', $data, 'adminLayout');   
    // }
}