<?php
namespace KH\Controllers;

use KH\Controllers\BaseController;

use KH\Repositories\OrderRepository;

use KH\Models\Product;
use KH\Models\Order;

require_once('baseController.php');
require_once('models/Product.php');
require_once('models/Order.php');
require_once('repositories/OrderRepository.php');

class OrderController extends BaseController{

    protected $orderRepository;
    protected $router;

    public function __construct()
    {
        parent::__construct();
        if(!isLogin()){
            return $this->redirect('dang-nhap');
        }
        $this->setOrderRepository(new OrderRepository());

        $routerString = $_SERVER['REQUEST_URI'];
        $this->router = explode('/', $routerString);
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
      
        $userId = $_SESSION['userLogin']['id'];
      
        $listCart = $this->getOrderRepository()->getListOrderByUser($userId);

        $data = array( 'title' => 'Danh sách đơn hàng - Cường Lê', 'products' => $listCart);

        $this->render('order', $data);
    }

    public function orderDetail()
    {
      
        $pattern = "/(\d+)\?action/";
        preg_match($pattern, $this->router[count($this->router) -1], $matches);

        $orderId    = $matches[1] ?? null;
        $total      = $this->getOrderRepository()->getTotalOrder($orderId);
        $listOrder  = $this->getOrderRepository()->getDetailOrder($orderId);

        if($listOrder['status'] === 'OK' && $total['status'] === 'OK'){

            $data = [
                'title'     => 'Danh sách sản phẩm đơn hàng #'.$orderId.' - Cường Lê', 
                'orderId'   => $orderId,
                'products'  => $listOrder['data'],
                'total'     => $total['data']->total,
                'status'    => $total['data']->status,
            ];
            $this->render('order-detail', $data);
        }

        $this->render('error');
      
    }
}