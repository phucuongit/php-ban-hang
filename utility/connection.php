<?php

class DB {
    private static $instance = NULL;
    public static function getInstance(){
        if(!isset(self::$instance)){
            try{
                self::$instance = new PDO('mysql:host=mydb;dbname=banhang', 'root','cuongdeptrai');
                self::$instance->exec("SET NAMES 'utf8'");
            }catch (PDOException $ex){
                die($ex->getMessage());
            }
        }
        return self::$instance;
    }
}