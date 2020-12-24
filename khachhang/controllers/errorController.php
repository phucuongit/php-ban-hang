<?php
namespace KH\Controllers;

use KH\Models\Product;

use KH\Controllers\BaseController;

require_once('baseController.php');
require_once('models/Product.php');

class ErrorController extends BaseController{

    public function index(){
        $data = array( 'title' => '404 - Cường Lê');
        $this->render('404', $data);
    }

}