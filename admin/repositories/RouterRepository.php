<?php 
namespace Admin\Repositories;

use Admin\Controllers\HomeController;
use Admin\Controllers\ShopController;
use Admin\Controllers\ProductController;
use Admin\Controllers\PageController;
use Admin\Controllers\LoginController;
use Admin\Controllers\RegisterController;
use Admin\Controllers\CartController;
use Admin\Controllers\OrderController;
use Admin\Controllers\AdminController;
use Admin\Controllers\CategoryController;
use Admin\Controllers\ErrorController;

require_once('controllers/homeController.php');
require_once('controllers/shopController.php');
require_once('controllers/productController.php');
require_once('controllers/loginController.php');
require_once('controllers/cartController.php');
require_once('controllers/orderController.php');
require_once('controllers/adminController.php');
require_once('controllers/categoryController.php');
require_once('controllers/errorController.php');

class RouterRepository{

    const HOME_CONTROLLER = 'homeController';
    const SHOP_CONTROLLER = 'shopController';
    const PRODUCT_CONTROLLER = 'productController';
    const LOGIN_CONTROLLER = 'loginController';
    const CART_CONTROLLER = 'cartController';
    const ORDER_CONTROLLER = 'orderController';
    const ADMIN_CONTROLLER = 'adminController';
    const CATEGORY_CONTROLLER = 'categoryController';
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
            case self::LOGIN_CONTROLLER:
                return new LoginController();
            case self::CART_CONTROLLER:
                return new CartController();
            case self::ORDER_CONTROLLER:
                return new OrderController();
            case self::ADMIN_CONTROLLER:
                return new AdminController();
            case self::CATEGORY_CONTROLLER:
                return new CategoryController();
            case self::ERROR_CONTROLLER:
                return new ErrorController();
            default:
                break;
        }
    }
}  

?>