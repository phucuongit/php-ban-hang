<?php
namespace KH\Controllers;

use KH\Controllers\BaseController;

use KH\Repositories\OrderRepository;

use KH\Models\Product;
use KH\Models\Order;
use KH\Models\Pagination;

require_once('baseController.php');
require_once('models/Product.php');
require_once('models/Order.php');
require_once('models/Pagination.php');
require_once('repositories/OrderRepository.php');

class OrderController extends BaseController{

    protected $orderRepository;
    protected $router;

    use Pagination;
    
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
        
        $config = [
            'total' => 0, 
            'limit' => 5,
            'full' => false,
            'querystring' => 'trang' 
        ];
        
        $totalOrderUser = $this->getOrderRepository()->totalOrderByUser($userId);
        $config['total'] =  $totalOrderUser[0];
        $this->setPagination($config);
        $currentPage = $this->getCurrentPage();

        $listCart = $this->getOrderRepository()->getListOrder($currentPage, 5, $userId);

        $data = [
            'title' => 'Danh sách đơn hàng - Cường Lê', 
            'products' => $listCart,
            'page'  => $this->getPagination(),
            'total' => $totalOrderUser[0]
        ];
        
        $this->render('order', $data);
    }

    public function orderDetail()
    {
      
        $pattern = "/(\d+)\?action/";
        preg_match($pattern, $this->router[count($this->router) -1], $matches);

        $orderId    = $matches[1] ?? null;
        $order      = $this->getOrderRepository()->getOrder($orderId);
        $listOrder  = $this->getOrderRepository()->getDetailOrder($orderId);

        if($listOrder['status'] === 'OK' && $order['status'] === 'OK'){

            $data = [
                'title'     => 'Danh sách sản phẩm đơn hàng #'.$orderId.' - Cường Lê', 
                'orderId'   => $orderId,
                'products'  => $listOrder['data'],
                'total'     => $order['data']->total,
                'status'    => $order['data']->status,
                'order'     => $order['data']
            ];
            $this->render('order-detail', $data);
        }

        $this->render('error');
      
    }
}