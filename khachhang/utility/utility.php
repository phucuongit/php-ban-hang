<?php 
    function isHome(){
        if($_SERVER['REQUEST_URI'] == '/'){
            return true;
        }
        return false;
    }

    function isLogin(){
        if(!isset($_SESSION['userLogin'])){
            return false;
        }
        return true;
    }
    function isCurrentPage($uri){
        if($_SERVER['REQUEST_URI'] === $uri){
            return true;
        }
        return false;
    }
    function isAdmin(){
        if(isset($_SESSION['userLogin']) && $_SESSION['userLogin']['is_admin']){
            return true;
        }
        return false;
    }
    function str_slug($text)
    {
        $text = preg_replace("/[^\w]/","", $text);
        $text = preg_replace('/\s/', '-', trim($text));

        $text = strtolower($text);

        return $text;
    }
    function getStatusOrder($status): string{
        $result = "";
        switch($status){
            case 0:
                $result = "Đang chờ thanh toán";
                break;
            case 1:
                $result = "Đang giao hàng";
                break;
            case 2:
                $result = "Hoàn thành";
                break;
            default:
                $result=  "Đang chờ thanh toán";
                break;
        }
        return $result;
      
    }
    function convertObjectToArray(array $object): array{
        $array = array();
        foreach($object as $obj){
            array_push($array,json_decode(json_encode($obj), true) );
        }
        return $array;
    }
    function convertArray(object $object): array{
        return json_decode(json_encode($object), true);
    }
?>