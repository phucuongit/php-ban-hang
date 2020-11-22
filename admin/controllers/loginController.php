<?php
namespace Admin\Controllers;

use Admin\Controllers\BaseController;

use KH\Models\User;

require_once('baseController.php');
require_once('../khachhang/models/User.php');

class LoginController extends BaseController{

    function __construct()
    {
        $this->folder = 'admin';
    }

    public function renderLogin($data)
    {
        extract($data);
        $viewFile = 'views/admin/login.php';
        ob_start();
        require_once($viewFile);
        $content = ob_get_clean();
        echo $content;
    }

    public function indexAdmin()
    {
        if(!isAdmin()){
          return $this->renderLogin();
        }
        return  $this->redirect();
    }

    public function login(){
        if(isAdmin()){
            return $this->redirect();
        }

       $username = $_POST['username'];
       $password = md5($_POST['password']);

       $user = json_decode(json_encode(User::loginAdmin($username, $password)), true);
       $data = array('error' => 'Tài khoản hoặc mật khẩu không đúng'); 
       if(!$user){
            return $this->renderLogin($data);
        }
        $_SESSION['adminLogin'] = $user;
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
        if(!isAdmin()){
            return $this->redirect('dang-nhap');
        }
        $id = $_POST['id'];
        User::delete($id);
    }

    public function add(){
        if(!isAdmin()){
            return $this->redirect('dang-nhap');
        }
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
        if(!isAdmin()){
            return $this->redirect('dang-nhap');
        }
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
        if(!isAdmin()){
            return $this->redirect('dang-nhap');
        }
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