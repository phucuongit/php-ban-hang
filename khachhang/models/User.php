<?php
class User {
    private $id;
    private $username;
    private $password;
    private $fullname;
    private $is_admin = 0;

    public function __construct(array $user){
        foreach($user as $key => $val){
            $this->$key = $val;
        }
    }

    public static function all(){
        $db = DB::getInstance();
        try{
            $req = $db->prepare('select * from user where is_deleted = 0');
            $req->execute();
            return $req->fetchAll();
        }catch (Exception $e){
            return $e->getMessage();
        }
    }
    public static function findById(int $id){
        $db = DB::getInstance();

        $req = $db->prepare('SELECT * from user where is_deleted = 0 and id = :id');
        $req->bindParam(':id', $id);
        $req->setFetchMode(PDO::FETCH_OBJ);
        $req->execute();

        return $req->fetch();
    }
    public static function lastInserted(){
        $db = DB::getInstance();
        $req = $db->prepare('SELECT LAST_INSERT_ID() as "user"');
        $req->execute(); 

        if (!$req->rowCount()){
            return null;
        }

        return $req->fetch();
    }
    public function save(){
        $db = DB::getInstance();
        try{
            $req = $db->prepare('insert into user (username, password, fullname, is_admin) values (:username, :password, :fullname, :is_admin)');
            $req->bindParam(':username', $this->username);
            $req->bindParam(':fullname', $this->fullname);
            $req->bindParam(':password', $this->password);
            $req->bindParam(':is_admin', $this->is_admin);
            
            $req->execute();
    
            return true;
        }catch (Exception $e){
            echo $e->getMessage();
            return false;
        }
        return false;
    }
    static function checkExist($username){
        $db = DB::getInstance();
        $req = $db->prepare('select * from user where username = :username and is_deleted = 0');
        $req->bindParam(':username', $username);
        $req->execute();
        if(!$req->rowCount()){
            return false;
        }

        return true;
        
    }
    static function loginUser($username, $password){
        $db = DB::getInstance();
        $req = $db->prepare('select * from user where username = :username and password = :password and is_deleted = 0');
        
        $req->bindParam(':username', $username);
        $req->bindParam(':password', $password);

        $req->setFetchMode(PDO::FETCH_OBJ);
        $req->execute();

        return $req->fetch();
    }
    public static function delete($id){
        $db = DB::getInstance();
        $req = $db->prepare('UPDATE user set is_deleted = 1 where id = :id');   
        $req->bindParam(':id', $id);
        $req->execute();

        return $req->fetch();
    }

    public static function updateUser(array $user){
        $db = DB::getInstance();
        $req = $db->prepare('UPDATE user set fullname = :fullname, password = :password, is_admin = :is_admin where id = :id');   
       
        $req->bindParam(':id', $user['id']);
        $req->bindParam(':fullname', $user['fullname']);
        $req->bindParam(':password', $user['password']);
        $req->bindParam(':is_admin', $user['is_admin']);
        $req->execute();

        return $req->fetch();
    }
}