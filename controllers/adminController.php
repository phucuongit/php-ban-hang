<?php
require_once('baseController.php');
require_once('models/Product.php');
require_once('models/Order.php');
require_once('models/User.php');

class AdminController extends baseController {

    public function indexAdmin(){
        $user = User::all();
        $order = Order::all();
        $data = array('totalUser' => count($user), 'totalOrder' => count($order));
        $this->render('index', $data, 'adminLayout');
    }

    public function error(){
        $this->render('error');
      }
}