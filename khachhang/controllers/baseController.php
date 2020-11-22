<?php
namespace KH\Controllers;
class BaseController{
    
    protected $folder;
    protected $router;

    function __construct(){
        $this->folder = 'pages';
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
            $this->redirect('404');
        }
    }

    /**
     * @param $url
     * @return string
     */
    public function redirect($url = null): string{
     
        if(!isset($url)){
            return header('location: '. BASE_URL);
        }
        return header('location: '. BASE_URL . $url);
    }

    public function error(){
        $this->render('error');
    }
}
?>