<?php
require_once('baseController.php');
require_once('models/Product.php');

class ErrorController extends baseController{

    public function index(){
        $data = array();
        $this->render('error', $data);
    }

    public function indexAdmin(){
        $data = array();
        $this->render('error', $data);
    }
}