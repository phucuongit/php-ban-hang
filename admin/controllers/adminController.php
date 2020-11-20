<?php
namespace Admin\Controllers;

use Admin\Controllers\BaseController;

use KH\Models\Product;
use KH\Models\User;
use KH\Models\Order;

require_once('baseController.php');
require_once(__DIR__ . '\..\..\khachhang\models\Product.php');
require_once(__DIR__ . '\..\..\khachhang\models\Order.php');
require_once(__DIR__ . '\..\..\khachhang\models\User.php');

class AdminController extends BaseController {

    public function indexAdmin(){
        $user = User::all();
        $order = Order::all();
        $data = array('title' => 'Dashboard - Cường Lê', 'totalUser' => count($user), 'totalOrder' => count($order));
        $this->render('index', $data, 'adminLayout');
    }

    public function error(){
        $this->render('error');
    }
}