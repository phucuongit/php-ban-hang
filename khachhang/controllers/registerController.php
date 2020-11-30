<?php
namespace KH\Controllers;

use KH\Controllers\BaseController;

use KH\Models\User;

require_once('baseController.php');
require_once('models/User.php');

class RegisterController extends BaseController{

    // private $user;

    public function index(){
        $data = array('title' => 'Đăng ký - Cường Lê Shop');
        $this->render('register', $data);
    }

    public function register(){
       
       $username = $_POST['username'];
       $fullname = $_POST['fullname'];
       $password = $_POST['password'];
       $user = [ 'username' =>  $username, 'fullname' => $fullname,'password' => md5($password) ];
       $re_password = ($_POST['re_password']);
       if($re_password == $password){
        if(strlen($password) < 8){
            $data = array('error' => 'Lỗi: Mật khẩu vui lòng ít nhất 8 kí tự');
            $this->render('register', $data);
            return;
        }
        if(User::checkExist($username)){
            $data = array('error' => 'Lỗi: username đã tồn tại');
            $this->render('register', $data);
            return;
        }
        $user = new User($user);
        $user->save();
        $newId = User::lastInserted();
   
        $_SESSION['userLogin'] = convertArray(User::findById($newId['user']));
   
        $this->redirect();
       }else{
        $data = array('error' => 'Lỗi: mật khẩu và nhập lại mật khẩu không đúng');
        $this->render('register', $data);
       }
    }
}