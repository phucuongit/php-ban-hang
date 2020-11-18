<?php
define("HOST", "localhost");
define("DB_NAME", "banhang");
define("DB_USER", "root");
define("DB_PASSWORD", "");

class DB {
    private static $instance = NULL;
    public static function getInstance(){
        if(!isset(self::$instance)){
            try{
                self::$instance = new PDO('mysql:host='. HOST.';dbname='. DB_NAME, DB_USER, DB_PASSWORD);
                self::$instance->exec("SET NAMES 'utf8'");
               
            }catch (PDOException $ex){
               
                die($ex->getMessage());
            }
        }
        return self::$instance;
    }
}