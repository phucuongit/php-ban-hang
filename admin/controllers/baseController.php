<?php
namespace Admin\Controllers;

class BaseController{
    
    protected $folder;
    protected $router;

    function __construct(){
        $this->folder = 'admin';
        if(!isAdminLogin()){
            return $this->redirect('dang-nhap');
        }
    }

    public function render($file, $data = array(), $customLayout = 'application')
    {

        $viewFile = 'views/'. $this->folder . '/' . $file . '.php';
        if(is_file($viewFile)){
            extract($data);
            ob_start();
            
            require_once($viewFile);
            $content = ob_get_clean();
            require_once('views/layouts/'.$customLayout.'.php');
        } else {
            $this->redirect('error');
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
        $this->render('404', []);
    }
}
?>