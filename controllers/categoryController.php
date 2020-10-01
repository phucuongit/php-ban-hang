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
            $data = array('title' => 'Quản lý danh mục - Cường Lê','categories' => $categories);

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
    public function detail($id){
        $regex = "/id=(\d+)/";
        preg_match($regex, $id[0], $match);
        if(!isset($match[1])){
            return "Loi";
        }
        $id = $match[1];
        $category = Category::findById($id);

        $data = array('category' => convertArray($category), 'categories' => Category::all());
        
        $this->render('category-add', $data, 'adminLayout');  
    }
    public function edit(){
        $data = array();
        $id = $_POST['id'];
    
        $name = htmlspecialchars($_POST['name']);
        $description = htmlspecialchars($_POST['description']);
       
        $error = '';
     
        if(empty($id)){
            $error .= 'Không tìm thấy id<br>';
            $data = array();
            $categories = convertObjectToArray(Category::all());
            $data = array('error' => $error, 'categories' => $categories);
            return $this->render('category', $data, 'adminLayout');   
            
        }
        if(empty($name)){
            $error .= 'Vui lòng nhập tên<br>';
        }
        if(empty($description)){
            $error .= 'Vui lòng nhập mô tả<br>';
        }
    
        if($error != ''){
            $category = Category::findById($id);
            $data = array('error' => $error, 'category' => convertArray($category));
  
            return $this->render('category-add', $data, 'adminLayout');  
        }
  
        $cateInfo = array(
            'id'    => $id,
            'name'  => $name,
            'description' => $description,
        );
    
        Category::updateCategory($cateInfo);
        $categories = convertObjectToArray(Category::all());
        $data = array('categories' => $categories);
        $this->render('category', $data, 'adminLayout');   
    }
}