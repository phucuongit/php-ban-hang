<?php 
namespace KH\Repositories;

use KH\Controllers\HomeController;
use KH\Controllers\ShopController;
use KH\Controllers\ProductController;
use KH\Controllers\PageController;
use KH\Controllers\LoginController;
use KH\Controllers\RegisterController;

require_once('controllers/homeController.php');
require_once('controllers/shopController.php');
require_once('controllers/productController.php');
require_once('controllers/pageController.php');
require_once('controllers/loginController.php');
require_once('controllers/registerController.php');

class RouterRepository{

    const HOME_CONTROLLER = 'homeController';
    const SHOP_CONTROLLER = 'shopController';
    const PRODUCT_CONTROLLER = 'productController';
    const PAGE_CONTROLLER = 'pageController';
    const LOGIN_CONTROLLER = 'loginController';
    const REGISTER_CONTROLLER = 'registerController';


    public function switchController($nameController)
    {
        switch($nameController){
            case self::HOME_CONTROLLER:
                return new HomeController();
                break;
            case self::SHOP_CONTROLLER:
                return new ShopController();
            case self::PRODUCT_CONTROLLER:
                return new ProductController();
            case self::PAGE_CONTROLLER:
                return new PageController();
            case self::LOGIN_CONTROLLER:
                return new LoginController();
            case self::REGISTER_CONTROLLER:
                return new RegisterController();
            default:
                break;
        }
    }
}  

?>