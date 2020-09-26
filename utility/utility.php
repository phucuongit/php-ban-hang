<?php 
    function isHome(){
        if($_SERVER['REQUEST_URI'] == '/'){
            return true;
        }
        return false;
    }

    function isLogin(){
        if(!$_SESSION['userLogin']){
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
?>