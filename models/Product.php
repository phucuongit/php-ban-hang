<?php
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

    public function __construct($product){
        if (is_array($product)){
            foreach($product as $k=>$v){
                $this->$k = $v;
            }
         }
        // $this->id = $data['id'];
        // $this->title = $data['title'];
        // $this->description = $data['description'];
        // $this->price = $data['price'];
        // $this->category_id = $data['category_id'];
        // $this->in_stock = $data['in_stock'];
        // $this->image_url = $data['image_url'];
        // $this->slug = $data['slug'];
        // $this->short_des = $data['short_des'];
    }

    static function all(){
        $list = [];
        $db = DB::getInstance();

        $req = $db->prepare('select * from product where is_deleted = false');

        $req->setFetchMode(PDO::FETCH_OBJ);

        $req->execute();

        foreach($req->fetchAll() as $item){
            array_push($list, $item);
        }
        return $list;
    }
    static function allProdCate(){
        $list = [];
        $db = DB::getInstance();

        $req = $db->prepare('select * from category as cate join (
            select p.category_id, count(c.id) as "total_product" from product as p join category as c on p.category_id = c.id group by p.category_id
        ) as c on cate.id = c.category_id;');
        $req->setFetchMode(PDO::FETCH_OBJ);

        $req->execute();

        foreach($req->fetchAll() as $item){
            array_push($list, $item);
        }
        return $list;
    }

    static function findBySlug($slug){
        $db = DB::getInstance();

        $req = $db->prepare('select p.id, 
        p.title, p.description, p.price, 
        p.in_stock, p.slug, p.image_url, 
        p.short_des, c.name, c.description
        from product as p join category as c 
        on  p.category_id = c.id 
        where p.slug = :slug and p.is_deleted = false');
        $req->bindParam(':slug', $slug);
        $req->setFetchMode(PDO::FETCH_OBJ);

        $req->execute();

        return $req->fetch();
    }

    static function findById($id){
        $db = DB::getInstance();

        $req = $db->prepare('select p.id, 
        p.title, p.description, p.price, 
        p.in_stock, p.slug, p.image_url, 
        p.short_des, c.name, c.description
        from product as p join category as c 
        on  p.category_id = c.id 
        where p.id = :id and p.is_deleted = false');
        $req->bindParam(':id', $id);
        $req->setFetchMode(PDO::FETCH_OBJ);
        $req->execute();

        return $req->fetch();
    }

    public function delete($id){
        $db = DB::getInstance();
        try{
            $req = $db->prepare('update product set is_deleted = true where id = :id');
            $req->bindParam(':id', $id);
            $req->setFetchMode(PDO::FETCH_OBJ);
            $req->execute();
            return true;
        }catch (Exception $e){
            echo $e->getMessages();
            return false;
        }
    }
}