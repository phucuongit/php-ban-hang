<?php
class Category {
    private $id;
    private $name;
    private $description;
    private $picture;
    private $slug;

    public function __constructor($id, $name, $description, $picture, $slug){
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->picture = $picture;
        $this->slug = $slug;
    }

    public static function all(){
        $db = DB::getInstance();
        $req = $db->prepare('SELECT * from category  where is_deleted = 0');
        $req->setFetchMode(PDO::FETCH_OBJ);
        $req->execute();
        $list = [];
        foreach($req->fetchAll() as $item){
            array_push($list, $item);
        }
        return $list;
    }    
    public static function findById(int $id){
        $db = DB::getInstance();

        $req = $db->prepare('SELECT * from category where is_deleted = 0 and id = :id');
        $req->bindParam(':id', $id);
        $req->setFetchMode(PDO::FETCH_OBJ);
        $req->execute();

        return $req->fetch();
    }
    public static function delete(int $id){
        $db = DB::getInstance();
        try{
            $req = $db->prepare('update category set is_deleted = 1 where id = :id');
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