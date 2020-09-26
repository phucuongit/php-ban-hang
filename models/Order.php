<?php
class Order {
    private $id;
    private $user_id;
    private $created_at;

    public function __construct($user_id) {
        $this->user_id = $user_id;
    }

    public static function all(){
        $db = DB::getInstance();
        try{
            $req = $db->prepare('select * from order_item');
            $req->execute();
            return $req->fetchAll();
        }catch (Exception $e){
            return $e->getMessage();
        }
    }
    public function save(){
        $db = DB::getInstance();
        try{
            $req = $db->prepare('insert into order_item (user_id) values (:user_id) ');
            $req->bindParam(':user_id', $this->user_id);
  
            $req->execute();
    
            return true;
        }catch (Exception $e){
            echo $e->getMessage();
            return false;
        }
        return false;
    }
    public function lastInserted(){
        $db = DB::getInstance();
        $req = $db->prepare('select LAST_INSERT_ID() as "order_id"');
        $req->execute(); 

        if (!$req->rowCount()){
            return null;
        }

        return $req->fetch();
    }
    public function saveManyProduct($products, $order_id){
        $db = DB::getInstance();
        try{
            foreach($products as $product){
                $req = $db->prepare('insert into order_prod (order_id, product_id, quality) values (:order_id, :product_id, :quality)');
                $req->bindParam(':order_id', $order_id);
                $req->bindParam(':product_id', $product['id']);
                $req->bindParam(':quality', $product['quality']);

                $req->execute();    
            }
            return true;
        }catch (Exception $e){
            echo $e->getMessage();
            return false;
        }
        return false;
    }
    public function updateQuality($product_id, $order_id, $quality){
        $db = DB::getInstance();
        try{
                $req = $db->prepare('update order_prod set quality = :quality where product_id = :product_id and order_id = :order_id');
                $req->bindParam(':quality', $quality);
                $req->bindParam(':product_id', $product_id);
                $req->bindParam(':order_id', $order_id);

                $req->execute();    
            return true;
        }catch (Exception $e){
            echo $e->getMessage();
            return false;
        }
        return;
    }
}