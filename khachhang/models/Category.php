<?php
namespace KH\Models;
class Category {
    private $id;
    private $name;
    private $description;
    private $slug;
    private $is_deleted = 0;


    public function __construct($cate){

        foreach($cate as $key => $val){
           
            $this->$key = $val;
        }
    }

    public static function all(){
        $db = \DB::getInstance();
        $req = $db->prepare('SELECT * from category  where is_deleted = 0');
        $req->setFetchMode(\PDO::FETCH_OBJ);
        $req->execute();
        $list = [];
        foreach($req->fetchAll() as $item){
            array_push($list, $item);
        }
        return $list;
    }    
    public static function paginate($current, $limit){
        $db = \DB::getInstance();
        $req = $db->prepare('SELECT * from category  where is_deleted = 0 limit :offset, :limit');
        $req->bindParam(':offset', ($current -1 ) * $limit);
        $req->bindParam(':limit', $limit);
        $req->setFetchMode(\PDO::FETCH_OBJ);
        $req->execute();
        $list = [];
        foreach($req->fetchAll() as $item){
            array_push($list, $item);
        }
        return $list;
    }
    public static function findBySlug($name){
        $db = \DB::getInstance();
        $req = $db->prepare('SELECT * from category where is_deleted = 0 and slug = :slug');
        $req->bindParam(':slug', $name);
        $req->setFetchMode(\PDO::FETCH_OBJ);
        $req->execute();

        return $req->fetch();
    }
    public static function findById(int $id){
        $db = \DB::getInstance();

        $req = $db->prepare('SELECT * from category where is_deleted = 0 and id = :id');
        $req->bindParam(':id', $id);
        $req->setFetchMode(\PDO::FETCH_OBJ);
        $req->execute();

        return $req->fetch();
    }
    public static function delete(int $id){
        $db = \DB::getInstance();
        try{
            $req = $db->prepare('update category set is_deleted = 1 where id = :id');
            $req->bindParam(':id', $id);
            $req->setFetchMode(\PDO::FETCH_OBJ);
            $req->execute();
            return true;
        }catch (Exception $e){
            echo $e->getMessages();
            return false;
        }
    }
    public function save(){
        $db = \DB::getInstance();
        try{
            $req = $db->prepare('INSERT into category (name, description, slug, is_deleted) values (:name, :description, :slug, :is_deleted) ');
            $req->bindParam(':name', $this->name);
            $req->bindParam(':description', $this->description);
            $req->bindParam(':slug', $this->slug);
            $req->bindParam(':is_deleted', $this->is_deleted);
            $req->execute();
            return true;
        }catch (Exception $e){
            echo $e->getMessage();
            return false;
        }
    }
    public static function updateCategory(array $category){
        $db = \DB::getInstance();
        try{
            $req = $db->prepare('UPDATE category set name = :name, description= :description where id= :id');
            $req->bindParam(':id', $category['id']);
            $req->bindParam(':name', $category['name']);
            $req->bindParam(':description', $category['description']);
            $req->execute();
            return true;
        }catch (Exception $e){
            echo $e->getMessage();
            return false;
        }
    }
}