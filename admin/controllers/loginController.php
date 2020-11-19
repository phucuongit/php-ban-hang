<?php
namespace Admin\Controllers;

use Admin\Controllers\BaseController;

use KH\Models\User;

require_once('baseController.php');
require_once('../khachhang/models/User.php');

class LoginController extends BaseController{

    public function index(){
        $data = array('title' => 'Đăng nhập - Cường Lê Shop');
        $this->render('login', $data);
    }

    public function indexAdmin(){
        if(isset($this->router[3]) && $this->router[3]  === 'them-moi'){
            $data = array();
            $this->render('user-add', $data, 'adminLayout');
        }else{
            $data = array('title' => 'Quản lý người dùng - Cường Lê','users' => User::all());
            $this->render('user', $data, 'adminLayout');
        }
 
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

    public function error(){
      $this->render('error');
    }

    public function userDel(){
        $id = $_POST['id'];
        User::delete($id);
    }

    public function add(){
        $username = $_POST['username'];
        $fullname = $_POST['fullname'];
        $password = $_POST['password'];
        $is_admin = $_POST['permission'];
        $newUser = array(
            'username' => $username,
            'fullname'  => $fullname,
            'password'  => md5($password),
            'is_admin'  => $is_admin,
        );
         if(User::checkExist($username)){
             $data = array('error' => 'Lỗi: username đã tồn tại');
             $this->render('register', $data);
             return;
         }
         $user = new User($newUser);
         $user->save();
        
         header('location: /admin/user');
    }

    public function detail(array $id){
      
        $regex = "/id=(\d+)/";
        preg_match($regex, $id[0], $match);
        if(!isset($match[1])){
            return "Loi";
        }
        $id = $match[1];
        $user = User::findById($id);

        $data = array('user' => convertArray($user));
        
        $this->render('user-add', $data, 'adminLayout');  
    }
    // itemprop="thumbnailUrl"
    public function edit(){
        $id = intval($_POST['id']);
        $fullname = $_POST['fullname'];
        $password = $_POST['password'];
        $is_admin = $_POST['permission'];
        $user = User::findById($id);
        if(strlen($password) < 8){
            $data = array('user' => convertArray($user), 'error' => 'Lỗi: Mật khẩu vui lòng ít nhất 8 kí tự');
            $this->render('user-add', $data, 'adminLayout'); 
            return;
        }
        $newUser = array(
            'id'    => $id,
            'fullname'  => $fullname,
            'password'  => md5($password),
            'is_admin'  => $is_admin,
        );
        
        User::updateUser($newUser);
        header('location: /admin/user');
    }
}