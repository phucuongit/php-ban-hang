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
        $req = $db->prepare('select * from category');
        $req->setFetchMode(PDO::FETCH_OBJ);
        $req->execute();
        $list = [];
        foreach($req->fetchAll() as $item){
            array_push($list, $item);
        }
        return $list;
    }    
}