<?php
namespace Admin\Controllers;

use KH\Models\Product;

use Admin\Controllers\BaseController;

require_once('baseController.php');
require_once(__DIR__ . '\..\..\khachhang\models\Product.php');

class ErrorController extends BaseController{

    public function indexAdmin(){
        $data = array( 'title' => '404 Không tìm thấy');
        $this->render('error', $data, 'adminLayout');
    }
    
}