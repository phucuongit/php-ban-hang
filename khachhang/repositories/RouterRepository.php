<?php 
namespace KH\Repositories;

use KH\Controllers\HomeController;
use KH\Controllers\ShopController;
use KH\Controllers\ProductController;
use KH\Controllers\PageController;
use KH\Controllers\LoginController;
use KH\Controllers\RegisterController;
use KH\Controllers\CartController;
use KH\Controllers\OrderController;
use KH\Controllers\ErrorController;

require_once('controllers/homeController.php');
require_once('controllers/shopController.php');
require_once('controllers/productController.php');
require_once('controllers/pageController.php');
require_once('controllers/loginController.php');
require_once('controllers/registerController.php');
require_once('controllers/cartController.php');
require_once('controllers/orderController.php');
require_once('controllers/errorController.php');

class RouterRepository{

    const HOME_CONTROLLER = 'homeController';
    const SHOP_CONTROLLER = 'shopController';
    const PRODUCT_CONTROLLER = 'productController';
    const PAGE_CONTROLLER = 'pageController';
    const LOGIN_CONTROLLER = 'loginController';
    const REGISTER_CONTROLLER = 'registerController';
    const CART_CONTROLLER = 'cartController';
    const ORDER_CONTROLLER = 'orderController';
    const ERROR_CONTROLLER = 'errorController';

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
            case self::CART_CONTROLLER:
                return new CartController();
            case self::ORDER_CONTROLLER:
                return new OrderController();
            case self::ERROR_CONTROLLER:
                return new ErrorController();
            default:
                break;
        }
    }
}  

?>