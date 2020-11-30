<?php
namespace KH\Models;
class Order {
    private $id;
    private $user_id;
    private $status = 0;
    private $total = 0;
    private $is_deleted = 0;
    private $created_at;
    private $fullName;
    private $email = null;
    private $phoneNumber;
    private $address;
    private $note = null;
    private $paymentMethod;
    
    public function __construct($newOrder) {
        foreach($newOrder as $key => $val){
            $this->$key = $val;
        }
    }

    public static function all(){
        $db = \DB::getInstance();
        try{
            $req = $db->prepare('select p.id, p.user_id, p.status, p.total, p.created_at, u.fullname from order_item as p join user as u on p.user_id = u.id where p.is_deleted = 0');
            $req->execute();
            return $req->fetchAll();
        }catch (Exception $e){
            return $e->getMessage();
        }
    }

    public static function totalOrder()
    {
        $db = \DB::getInstance();
        $req = $db->prepare('select count(*) from order_item as p join user as u on p.user_id = u.id where p.is_deleted = 0');
        $req->execute();
        return $req->fetch();
    }

    public static function paginate($current, $limit, $userId = null)
    {
        $db = \DB::getInstance();

        try{
            $offset = ($current -1 ) * $limit;
            if(isset($userId)){
                $req = $db->prepare('select p.id, p.user_id, p.status, p.total, p.created_at, u.fullname from order_item as p join user as u on p.user_id = u.id where p.user_id = :userId and p.is_deleted = 0 order by p.created_at desc  LIMIT ' . $limit . ' OFFSET ' .$offset);
                $req->bindParam(':userId', $userId);
              
            }else{
                $req = $db->prepare('select p.id, p.user_id, p.status, p.total, p.created_at, u.fullname from order_item as p join user as u on p.user_id = u.id where p.is_deleted = 0 order by p.created_at desc LIMIT ' . $limit . ' OFFSET ' .$offset);
            }
          
            $req->execute();
            return $req->fetchAll();
        }catch (Exception $e){
            return $e->getMessage();
        }
    }
    public static function myOrder($userId){
        $db = \DB::getInstance();
        try{
            $req = $db->prepare('select p.id, p.user_id, p.status, p.total, p.created_at, u.fullname from order_item as p join user as u on p.user_id = u.id where p.user_id = :userId and p.is_deleted = 0 order by p.created_at desc');
            $req->bindParam(':userId', $userId);
            $req->execute();
            return $req->fetchAll();
        }catch (Exception $e){
            return $e->getMessage();
        }
    }

    public static function totalOrderByUser($userId)
    { 
        $db = \DB::getInstance();
        try{
            $req = $db->prepare('select count(*) from order_item as p join user as u on p.user_id = u.id where p.user_id = :userId and p.is_deleted = 0 order by p.created_at desc');
            $req->bindParam(':userId', $userId);
            $req->execute();
            return $req->fetch();
        }catch (Exception $e){
            return $e->getMessage();
        }

    }
    public static function findById(int $id){
        $db = \DB::getInstance();

        $req = $db->prepare('SELECT p.id, p.user_id, p.status, p.total, p.created_at, p.fullname, p.phone_number, p.email, p.address, p.note, p.payment_method
        from order_item as p join user as u on p.user_id = u.id 
        where p.is_deleted = 0 and p.id = :id and p.is_deleted = 0');
        $req->bindParam(':id', $id);
        $req->setFetchMode(\PDO::FETCH_OBJ);
        $req->execute();

        return $req->fetch();
    }
    public static function ManyToMany($id): array{
        $db = \DB::getInstance();

        $req = $db->prepare('SELECT * FROM order_prod as orp join product as p on p.id = orp.product_id where orp.order_id = :id');
        $req->bindParam(':id', $id);
        $req->setFetchMode(\PDO::FETCH_OBJ);
        $req->execute();

        return $req->fetchAll();
    }
    public static function updateOne($id, $status){
        $db = \DB::getInstance();

        $req = $db->prepare('UPDATE order_item as prd SET prd.status = :status where prd.id = :id');
        $req->bindParam(':id', $id);
        $req->bindParam(':status', $status);
        $req->execute();

        return true;
    }
    public static function delete($id){
        $order = Order::findById($id);
        if(!$order){
            return false;
        }
        $db = \DB::getInstance();

        $req = $db->prepare('update order_item as p set is_deleted = 1  where p.id = :id and p.is_deleted = 0');
        $req->bindParam(':id', $id);
        $req->execute();

        return true;
    }
    public function save(){
        $db = \DB::getInstance();
        try{
            $req = $db->prepare('insert into order_item (user_id, status, total, is_deleted, fullName, email, phone_number, address, note, payment_method) 
                                                values (:user_id, :status, :total, :is_deleted, :fullName, :email, :phoneNumber, :address, :note, :paymentMethod)');
            $req->bindParam(':user_id', $this->user_id);
            $req->bindParam(':status', $this->status);
            $req->bindParam(':total', $this->total);
            $req->bindParam(':is_deleted', $this->is_deleted);
            $req->bindParam(':fullName', $this->fullName);
            $req->bindParam(':email', $this->email);
            $req->bindParam(':phoneNumber', $this->phoneNumber);
            $req->bindParam(':address', $this->address);
            $req->bindParam(':note', $this->note);
            $req->bindParam(':paymentMethod', $this->paymentMethod);
            $req->execute();
    
            return true;
        }catch (Exception $e){
            echo $e->getMessage();
            return false;
        }
        return false;
    }
    public function lastInserted(){
        $db = \DB::getInstance();
        $req = $db->prepare('select LAST_INSERT_ID() as "order_id"');
        $req->execute(); 

        if (!$req->rowCount()){
            return null;
        }

        return $req->fetch();
    }
    public function saveManyProduct($products, $order_id){
        $db = \DB::getInstance();
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
        $db = \DB::getInstance();
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