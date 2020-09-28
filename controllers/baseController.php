<?php
    class BaseController{
        
        protected $folder;
        protected $router;

        function __construct($router){
            $this->router = $router;
            if($router[1] === 'admin'){
                $this->folder = 'admin';
            }else{
                $this->folder = 'pages';
            }
        }

        public function render($file, $data = array(), $customLayout = 'application'){

            $request =  $_SERVER['REQUEST_URI'];
            // check request all cac trang khac /dang-nhap /dang-ky dieu huong ve dang nhap (tru /admin.+)
            $regexAdmin = "/admin(\/.+)?/";
            if(!isset($_SESSION['userLogin']) && 
            $request != '/dang-nhap' && 
            $request != '/dang-nhap?action=login' && 
            $request != '/dang-ky' &&
            // !preg_match($regexAdmin, $request) &&
            $request != '/dang-ky?action=register' ){
                header('Location: /dang-nhap');
                return;
            }
            // var_dump(preg_match($regexAdmin, $request), $request);
            
            //check /admin phai co quyen admin
            // if(preg_match($regexAdmin, $request) && !isAdmin()){
            //     header('Location: /error');
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
                header('Location: /index.php?error');
            }
        }
    }