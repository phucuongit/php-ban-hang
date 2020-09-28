<?php
require_once('baseController.php');
require_once('models/User.php');

class LoginController extends baseController{

    public function index(){
        $data = array();
        $this->render('login', $data);
    }

    public function indexAdmin(){
        if(isset($this->router[3]) && $this->router[3]  === 'them-moi'){
            $data = array();
            $this->render('user-add', $data, 'adminLayout');
        }else{
            $data = array('users' => User::all());
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
        header('location: /');
    }

    public function logout(){
        $_SESSION['userLogin'] = null;
        header('Location: /dang-nhap');
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
        // var_dump($is_admin);
         if(User::checkExist($username)){
             $data = array('error' => 'Lỗi: username đã tồn tại');
             $this->render('register', $data);
             return;
         }
         $user = new User($username, md5($password), $fullname, $is_admin);
         $user->save();
        
         header('location: /admin/user');
    }
 
}