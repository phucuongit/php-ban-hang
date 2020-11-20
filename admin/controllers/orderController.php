<?php
namespace Admin\Controllers;

use Admin\Controllers\BaseController;

use Admin\Repositories\OrderRepository;

use KH\Models\Product;
use KH\Models\Order;

require_once('baseController.php');
require_once(__DIR__ . '\..\repositories\OrderRepository.php');

class OrderController extends BaseController{

    protected $orderRepository;

    public function __constructor()
    {
        if(!isLogin()){
            return $this->redirect('dang-nhap');
        }
    }

    public function getOrderRepository() :OrderRepository
    {
        return $this->orderRepository;
    }

    public function setOrderRepository(OrderRepository $orderRepository)
    {
        if(!isset($orderRepository)){
            $this->orderRepository = new OrderRepository();
        }

        $this->orderRepository = $orderRepository;
    }

    public function index()
    {
        if(!isLogin()){
            return $this->redirect('dang-nhap');
        }
        
        $this->setOrderRepository(new OrderRepository());

        $userId = $_SESSION['userLogin']['id'];
      
        $listCart = $this->getOrderRepository()->getListOrderByUser($userId);

        $data = array( 'title' => 'Danh sách đơn hàng - Cường Lê', 'products' => $listCart);

        $this->render('order', $data);
    }
}