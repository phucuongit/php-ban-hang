<?php
require_once('baseController.php');
require_once('models/User.php');

class LoginController extends baseController{

    public function index(){
        $data = array();
        $this->render('login', $data);
    }

    public function login(){
       $username = $_POST['username'];
       $password = md5($_POST['password']);

       $user = json_decode(json_encode(User::loginUser($username, $password)), true);
       $data = array('error' => 'Tài khoản hoặc mật khẩu không đúng'); 
       if(!$user){
            return $this->render('login', $data);
        }
        $_SESSION['userLogin'] = $user;
        // var_dump($_SESSION);
        header('location: /');
    }

    public function logout(){
        $_SESSION['userLogin'] = null;
        header('Location: /dang-nhap');
    }

    public function error(){
      $this->render('error');
    }
}