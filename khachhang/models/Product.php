<?php
namespace KH\Models;

class Product {
    private $id;
    private $title;
    private $short_des;
    private $description;
    private $price;
    private $category_id;
    private $in_stock;
    private $image_url;
    private $slug;
    private $is_deleted = 0;

    public function __construct($product){
        if (is_array($product)){
            foreach($product as $k=>$v){
                $this->$k = $v;
            }
         }
    }

    function save(){
        $db = \DB::getInstance();
        $req = $db->prepare('insert into product  (title, short_des, description, price, category_id, in_stock,image_url, slug, is_deleted) values (:title, :short_des, :description, :price, :category_id, :in_stock, :image_url, :slug, :is_deleted)');
       
        $vars = array_keys(get_class_vars(get_class($this)));
    
        foreach($vars as $v){ 
            if($v != 'id'){
                $req->bindParam(':'.$v, $this->$v);
            }
        }
      
        $req->execute();

        if($req->errorCode() == 0) {
            header('Location: /admin/san-pham');
        }
    }
    static function updateProductByStock($id, $stock){
        $db = \DB::getInstance();
        $req = $db->prepare('update product set in_stock=:in_stock where id = :id');
       
       
        $req->bindParam(':id', $id);
        $req->bindParam(':in_stock', $stock);
      
      
        $req->execute();

        if($req->errorCode() == 0) {
            header('Location: /admin/san-pham');
        }
    }
    static function all(){
        $list = [];
        $db = \DB::getInstance();

        $req = $db->prepare('select * from product where is_deleted = false');

        $req->setFetchMode(\PDO::FETCH_OBJ);

        $req->execute();

        foreach($req->fetchAll() as $item){
            array_push($list, $item);
        }
        return $list;
    }
    static function allFeature($limit){
        $list = [];
        $db = \DB::getInstance();

        $req = $db->prepare('SELECT * from product where is_deleted = false ORDER BY created_at DESC limit ' . $limit);

        $req->setFetchMode(\PDO::FETCH_OBJ);

        $req->execute();

        foreach($req->fetchAll() as $item){
            array_push($list, $item);
        }
        return $list;
    }
    static function numProdByCate($slug){
        $db = \DB::getInstance();

        $req = $db->prepare('SELECT c.total_product from category as cate join (
            select p.category_id, count(c.id) as "total_product" from product as p join category as c on p.category_id = c.id where p.is_deleted = 0 group by p.category_id
        ) as c on cate.id = c.category_id where cate.slug = :slug and cate.is_deleted = 0');
        $req->bindParam(':slug', $slug);
        $req->execute();

        return $req->fetch();
    }
    static function allProdCate(){
        $list = [];
        $db = \DB::getInstance();

        $req = $db->prepare('SELECT * from category as cate join (
            select p.category_id, count(c.id) as "total_product" from product as p join category as c on p.category_id = c.id where p.is_deleted = 0 group by p.category_id
        ) as c on cate.id = c.category_id and cate.is_deleted = 0;');
        $req->setFetchMode(\PDO::FETCH_OBJ);

        $req->execute();

        foreach($req->fetchAll() as $item){
            array_push($list, $item);
        }
        return $list;
    }
    public static function paginate($current, $limit, $cateName = 'full'){
        $db = \DB::getInstance();
        $offset = ($current -1 ) * $limit;
        try{
            if($cateName == 'full'){
                $req = $db->prepare('SELECT * from product where is_deleted = 0 LIMIT ' . $limit . ' OFFSET ' .$offset);
    
            }else{          
                $cate = Category::findBySlug($cateName);
                if($cate){
                    $id = $cate->id;
                    $req = $db->prepare('SELECT * from product where is_deleted = 0 and category_id = :id LIMIT ' . $limit . ' OFFSET ' .$offset);
                    $req->bindParam(':id', $id);
                }else{
                    return [];
                }
                     
            }
            $req->setFetchMode(\PDO::FETCH_OBJ);
            $req->execute();
            $list = [];
            foreach($req->fetchAll() as $item){
                array_push($list, $item);
            }
            return $list;
     
        }catch (Exception $e){
            echo $e->getMessage();
            return false;
        }
        
    }
    static function findBySlug($slug){
        $db = \DB::getInstance();

        $req = $db->prepare('select p.id, 
        p.title, p.description, p.price, 
        p.in_stock, p.slug, p.image_url, 
        p.short_des, c.name, c.description as des_cate
        from product as p join category as c 
        on  p.category_id = c.id 
        where p.slug = :slug and p.is_deleted = false');
        $req->bindParam(':slug', $slug);
        $req->setFetchMode(\PDO::FETCH_OBJ);

        $req->execute();

        return $req->fetch();
    }

    static function findById($id){
        $db = \DB::getInstance();

        $req = $db->prepare('select p.id, 
        p.title, p.description, p.price, 
        p.in_stock, p.slug, p.image_url,
        p.category_id,
        p.short_des, c.name, c.description as des_cate
        from product as p join category as c 
        on  p.category_id = c.id 
        where p.id = :id and p.is_deleted = false');
        $req->bindParam(':id', $id);
        $req->setFetchMode(\PDO::FETCH_OBJ);
        $req->execute();

        return $req->fetch();
    }

    public function delete($id){
        $db = \DB::getInstance();
        try{
            $req = $db->prepare('update product set is_deleted = true where id = :id');
            $req->bindParam(':id', $id);
            $req->setFetchMode(\PDO::FETCH_OBJ);
            $req->execute();
            return true;
        }catch (Exception $e){
            echo $e->getMessages();
            return false;
        }
    }
    public static function updateProduct(array $product){
        $db = \DB::getInstance();
        $req = $db->prepare('UPDATE product  set title = :title, short_des = :short_des, description = :description, price = :price, category_id=:category_id, in_stock=:in_stock,image_url=:image_url where id =:id');
      
 
        $req->bindParam(':id', $product['id']);
        $req->bindParam(':title', $product['title']);
        $req->bindParam(':description', $product['description']);
        $req->bindParam(':price', $product['price']);
        $req->bindParam(':category_id', $product['category_id']);
        $req->bindParam(':in_stock', $product['in_stock']);
        $req->bindParam(':image_url', $product['image_url']);
        $req->bindParam(':short_des', $product['short_des']);

        $req->execute();
   
        if($req->errorCode() == 0) {
            header('Location: /admin/san-pham');
        }
    }
}