<?php
namespace Admin\App;

use Admin\Repositories\RouterRepository;

require_once('repositories/RouterRepository.php');
require_once('../khachhang/utility/utility.php');

class Router{
    
    protected $routerRepository;

    public function __construct()
    {
        //define router
        $controllers = array(
            ''          => 'admin',
            'san-pham'  => 'product',
            'dang-nhap' => 'login',
            'don-hang'  => 'cart',
            'user'      => 'login',
            'danh-muc'  => 'category',
            'error'     => 'error'
        );
        // get router
        $routerString = $_SERVER['REQUEST_URI'];
        // get action to call
        $pattern = "/action=(\w+)/";
        preg_match($pattern, $routerString, $matches);
       
        if(isset($matches[1])){
            $action = $matches[1];
        }else{
            $action = 'indexAdmin';
        }
    
        // check not exist controller return nameController error
        $router = explode('/', $routerString);
        // var_dump($router);
        if(!array_key_exists($router[3], $controllers)){
            $nameController = 'error';
        }
    

        $key  = preg_replace("/\?(.+)/", '', isset($router[3]) ? $router[3] : '');
        $nameController = array_key_exists($key,$controllers) ? $controllers[$key] : null;
 
        $arguments = array();
        foreach($router as $key => $val){
            if($key != 0 && $key != 1){
                $arguments[] = $val;
            }
        }

        if(!$nameController){
            $nameController = 'error';
        }
     
        $class = lcfirst($nameController) . 'Controller';
   
        $this->setRouterRepository(new RouterRepository());

        $controller = $this->getRouterRepository()->switchController($class);
  
        $controller->$action($arguments);
    }

    public function getRouterRepository(){
        return $this->routerRepository;
    }

    public function setRouterRepository(RouterRepository $routerRepository){
        if(!isset($routerRepository)){
            $this->routerRepository =  new RouterRepository();
        }

        $this->routerRepository = $routerRepository;
    }
}

   