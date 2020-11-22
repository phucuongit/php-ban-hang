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
        $this->orderRepository = new OrderRepository();
    }

    public function indexAdmin()
    {

        $data = array('orders' => Order::all());
        $data = array_merge($data, array('title' => 'Đơn hàng - Cường Lê'));
    
        return $this->render('order', $data, 'adminLayout');
    }

    public function orderDel()
    {
        $id = $_POST['id'];
        header("Content-Type: application/json");
        if(Order::delete($id)){
            echo json_encode( [
                'status'    => 'OK',
                'message'   => 'Xóa thành công đơn hàng đơn hàng #' . $id 
            ]);
        }else{
            echo json_encode( [
                'status'    => 'ERROR',
                'code'      => 'orderDel.failed.data_error' ,
                'message'   => 'Lỗi xóa đơn hàng'
            ]);
        }
    }
    public function detail(array $id)
    {
        $id = $_GET['id'];

        if(!isset($id)){
            return $this->redirect('error');
        }

        $products = Order::ManyToMany($id);
        if(count($products) <= 0){
            return $this->redirect('error');
        }
        $data = array('order' => Order::findById($id), 'products' => convertObjectToArray($products));
        
        $this->render('invoice', $data, 'adminLayout');  

    }

    public function updateStatus()
    {
        $id = $_POST['id'];
        $status = $_POST['status'];

        if(Order::updateOne($id, $status)){
            echo json_encode( [
                'status'    => 'OK',
                'message'   => 'Cập nhật thành công đơn hàng đơn hàng #' . $id 
            ]);
        }else{
            echo json_encode( [
                'status'    => 'ERROR',
                'code'      => 'updateStatus.failed.data_error' ,
                'message'   => 'Lỗi cập nhật trạng thái đơn hàng'
            ]);
        }
    }
 
}