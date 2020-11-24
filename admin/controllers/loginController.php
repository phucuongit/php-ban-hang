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
        $data = [];
        if(!isAdminLogin()){
          return $this->renderLogin($data);
        }
        
        $data = array('title' => 'Quản lý người dùng - Cường Lê','users' => User::all());
        $this->render('user', $data, 'adminLayout');
    }

    public function login()
    {
        if(isAdminLogin()){
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

    public function logout()
    {
        $_SESSION['userLogin'] = null;
        $this->redirect('dang-nhap');
    }

    public function userDel()
    {
        if(!isAdminLogin()){
            return $this->redirect('dang-nhap');
        }
        $id = intval($_POST['id']);

        if($_SESSION['adminLogin']['id'] == $id){
            echo json_encode([
                'status'    => "ERROR",
                "code"      => "userDel.failed.Not_permission_remove_my_user",
                "message"   => "Không thể xóa user chính bạn"
            ]);
            return;
        }
        
        User::delete($id);
        echo json_encode([
            'status'    => "OK",
            "message"   => "Xóa thành công tài khoản #" . $id
        ]);
        return;
    }

    public function addUser()
    {
        if(!isAdminLogin()){
            return $this->redirect('dang-nhap');
        }

        $data = [];
        
        return $this->render('user-add', $data, 'adminLayout');  
    }

    public function add()
    {
        if(!isAdminLogin()){
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
        
         return $this->redirect('user');
    }

    public function detail()
    {
        if(!isAdminLogin()){
            return $this->redirect('dang-nhap');
        }
        $id = $_GET['id'];
      
        $user = User::findById($id);

        $data = array('user' => convertArray($user));
        
        $this->render('user-add', $data, 'adminLayout');  
    }

    public function edit()
    {
        if(!isAdminLogin()){
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
        return $this->redirect('user');
    }
}