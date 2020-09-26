<?php
class User {
    private $id;
    private $username;
    private $password;
    private $fullname;

    public function __construct($username, $password, $fullname){
        $this->username = $username;
        $this->password = $password;
        $this->fullname = $fullname;
    }

    public function all(){
        $db = DB::getInstance();
        try{
            $req = $db->prepare('select * from user');
            $req->execute();
            return $req->fetchAll();
        }catch (Exception $e){
            return $e->getMessage();
        }
    }
    public function save(){
        $db = DB::getInstance();
        try{
            $req = $db->prepare('insert into user (username, password, fullname) values (:username, :password, :fullname)');
            $req->bindParam(':username', $this->username);
            $req->bindParam(':fullname', $this->fullname);
            $req->bindParam(':password', $this->password);
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
        $req = $db->prepare('select * from user where username = :username');
        $req->bindParam(':username', $username);
        $req->execute();
        if(!$req->rowCount()){
            return false;
        }

        return true;
        
    }
    static function loginUser($username, $password){
        $db = DB::getInstance();
        $req = $db->prepare('select * from user where username = :username and password = :password');
        
        $req->bindParam(':username', $username);
        $req->bindParam(':password', $password);

        $req->setFetchMode(PDO::FETCH_OBJ);
        $req->execute();

        return $req->fetch();
    }
}