<?php
namespace KH\Controllers;

use KH\Controllers\BaseController;

use KH\Models\User;

require_once('baseController.php');
require_once('models/User.php');

class LoginController extends BaseController{

    public function index(){
        $data = array('title' => 'Đăng nhập - Cường Lê Shop');
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
        $this->redirect();
    }

    public function logout(){
        $_SESSION['userLogin'] = null;
        $this->redirect('dang-nhap');
    }
}