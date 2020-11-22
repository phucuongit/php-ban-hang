<?php
namespace Admin\Controllers;

use Admin\Controllers\BaseController;

use Admin\Repositories\OrderRepository;

use KH\Models\Product;
use KH\Models\Order;

require_once('baseController.php');
require_once(__DIR__ . '\..\..\khachhang\models\Product.php');
require_once(__DIR__ . '\..\..\khachhang\models\Order.php');
require_once(__DIR__ . '\..\..\khachhang\models\User.php');
require_once('repositories/OrderRepository.php');

class CartController extends BaseController {

    protected $orderRepository;

    public function __construct()
    {
        parent::__construct();
        if(!isAdminLogin()){
            return $this->redirect('dang-nhap');
        }
    }

    public function indexAdmin()
    {

        $this->orderRepository = new OrderRepository();

        $data = array('orders' => Order::all());
        $data = array_merge($data, array('title' => 'Đơn hàng - Cường Lê'));
    
        return $this->render('order', $data, 'adminLayout');
    }

    public function orderDel(){
        $id = $_POST['id'];

        if(Order::delete($id)){
            header('Location: /admin/don-hang/');
        }else{
            $data = array('orders' => Order::all(), 'error' => 'Loi xoa don hang');

            $this->render('order', $data, 'adminLayout');  
        }
    }
    public function detail(array $id){
       
        $regex = "/id=(\d+)/";
        preg_match($regex, $id[0], $match);
        if(!isset($match[1])){
            return "Loi";
        }
        $id = $match[1];
        $products = Order::ManyToMany($id);

        $data = array('order' => Order::findById($id), 'products' => convertObjectToArray($products));
        
        $this->render('invoice', $data, 'adminLayout');  

    }
    public function updateStatus(){
        $id = $_POST['id'];
        $status = $_POST['status'];

        Order::updateOne($id, $status);
    }
 
    

}