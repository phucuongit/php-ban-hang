<?php
require_once('baseController.php');
require_once('models/User.php');

class RegisterController extends baseController{

    // private $user;

    public function index(){
        $data = array();
        $this->render('register', $data);
    }

    public function register(){
       $username = $_POST['username'];
       $fullname = $_POST['fullname'];
       $password = $_POST['password'];
       $re_password = ($_POST['re_password']);
       if($re_password == $password){
        if(User::checkExist($username)){
            $data = array('error' => 'Lỗi: username đã tồn tại');
            $this->render('register', $data);
            return;
        }
        $user = new User($username, md5($password), $fullname);
        $user->save();
        $_SESSION['userLogin'] = $user;
        header('location: /');
       }else{
        $data = array('error' => 'Lỗi: mật khẩu và nhập lại mật khẩu không đúng');
        $this->render('register', $data);
       }
    }

    public function error(){
      $this->render('error');
    }
}