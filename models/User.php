<?php
class User {
    private $id;
    private $username;
    private $password;
    private $fullname;
    private $is_admin;

    public function __construct($username, $password, $fullname, $is_admin){
        $this->username = $username;
        $this->password = $password;
        $this->fullname = $fullname;
        $this->is_admin = $is_admin;
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
}