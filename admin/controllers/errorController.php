<?php
namespace Admin\Controllers;

use KH\Models\Product;

use Admin\Controllers\BaseController;

require_once('baseController.php');
require_once(__DIR__ . '\..\..\khachhang\models\Product.php');

class ErrorController extends BaseController{

    public function index(){
        $data = array( 'title' => '404 - Cường Lê');
        $this->render('error', $data);
    }

    public function indexAdmin(){
        $data = array();
        $this->render('error', $data);
    }
}