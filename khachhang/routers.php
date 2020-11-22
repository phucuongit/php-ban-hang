<?php
namespace KH\App;

use KH\Repositories\RouterRepository;

require_once('repositories/RouterRepository.php');
require_once('controllers/homeController.php');
require_once('controllers/shopController.php');
require_once('controllers/productController.php');
require_once('controllers/pageController.php');
require_once('controllers/loginController.php');
require_once('controllers/registerController.php');
require_once('utility/utility.php');
class Router{
    
    protected $routerRepository;

    public function __construct()
    {
        //define router
        $controllers = array(
            ''     => 'home',
            'cua-hang' => 'shop',
            'san-pham' => 'product',
            'gio-hang' => 'cart',
            'lien-he' => 'page',
            'dang-nhap' => 'login',
            'dang-ky' => 'register',
            'don-hang'  => 'order'
        );
        // get router
        $routerString = $_SERVER['REQUEST_URI'];
        // get action to call
        $pattern = "/action=(\w+)/";
        preg_match($pattern, $routerString, $matches);
        if(isset($matches[1])){
            $action = $matches[1];
        }else{
            $action = 'index';
        }
    
        // check not exist controller return nameController error
        $router = explode('/', $routerString);
    
        if(!array_key_exists($router[3] ?? '', $controllers)){
            $nameController = 'error';
        }
    
        $nameController = $controllers[preg_replace("/\?(.+)/", '', $router[3] ?? '')];
        // var_dump($nameController);
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
        // var_dump($class, $action);
        $controller = $this->getRouterRepository()->switchController($class);

        $controller->$action($arguments);
    }

    public function getRouterRepository(): RouterRepository{
        return $this->routerRepository;
    }

    public function setRouterRepository(RouterRepository $routerRepository){
        if(!isset($routerRepository)){
            $this->routerRepository =  new RouterRepository();
        }

        $this->routerRepository = $routerRepository;
    }
}

   