<?php
namespace Admin\Controllers;

class BaseController{
    
    protected $folder;
    protected $router;

    function __construct(){
        $this->folder = 'admin';
    }

    public function render($file, $data = array(), $customLayout = 'application'){

        $request =  $_SERVER['REQUEST_URI'];
        // check request all cac trang khac /dang-nhap /dang-ky dieu huong ve dang nhap (tru /admin.+)
        $regexAdmin = "/admin(\/.+)?/";
        // if(!isset($_SESSION['userLogin']) && 
        // $request != '/dang-nhap' && 
        // $request != '/dang-nhap?action=login' && 
        // $request != '/dang-ky' &&
        // $request != '/dang-ky?action=register' ){
        //     header('Location: /dang-nhap');
        //     return;
        // }
        $viewFile = 'views/'. $this->folder . '/' . $file . '.php';
        if(is_file($viewFile)){
            extract($data);
            ob_start();
            
            require_once($viewFile);
            $content = ob_get_clean();
            require_once('views/layouts/'.$customLayout.'.php');
        } else {
            $this->redirect('?error');
        }
    }

    /**
     * @param $url
     * @return string
     */
    public function redirect($url = null): string{
     
        if(!isset($url)){
            return header('location: '. BASE_ADMIN_URL);
        }
        return header('location: '. BASE_ADMIN_URL . $url);
    }

    public function error(){
        $this->render('error');
    }
}
?>