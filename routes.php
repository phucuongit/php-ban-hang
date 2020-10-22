<?php
    //define router
    $controllers = array(
        ''     => 'home',
        'cua-hang' => 'shop',
        'san-pham' => 'product',
        'gio-hang' => 'cart',
        'lien-he' => 'page',
        'dang-nhap' => 'login',
        'gio-hang' => 'cart',
        'dang-ky' => 'register',
        'admin' => ['product', 'cart'],
   
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

    if(!array_key_exists($router[1], $controllers)){
        $nameController = 'error';
    }

    $nameController = $controllers[preg_replace("/\?(.+)/", '', $router[1] ?? '')];

    $arguments = array();
    foreach($router as $key => $val){
        if($key != 0 && $key != 1){
            $arguments[] = $val;
        }
    }

   
    if(!$nameController){
        $nameController = 'error';
    }

    require_once('utility/utility.php');
    if($router[1] === 'admin'){
        $controllerAdmin = array(
            ''     => 'admin',
            'san-pham' => 'product',
            'dang-nhap' => 'login',
            'don-hang'  => 'cart',
            'user'  => 'login',
            'danh-muc'  => 'category'
        );
        //none admin can access
        $protectCanAccess = array('' => 'admin','don-hang'  => 'cart');

        $removeAction = preg_replace("/\?(.+)/", '', $router[2] ?? '');
        $nameController = $controllerAdmin[$removeAction];
        if(!array_key_exists($removeAction, $controllerAdmin) || (!isAdmin() && !array_key_exists($removeAction, $protectCanAccess)) ){
            $nameController = 'error';
        }
        // get action to call
        $pattern = "/action=(\w+)/";
        preg_match($pattern, $routerString, $matches);
        if(isset($matches[1])){
            $action = $matches[1];
        }else{
            $action = 'indexAdmin';
        }
    }
  
    include_once('controllers/' . $nameController . 'Controller.php');
    $class = ucwords($nameController) . 'Controller';
    $classController = new $class($router);
    // var_dump($arguments);
    $classController->$action($arguments);

   