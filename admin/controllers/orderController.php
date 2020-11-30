<?php
namespace Admin\Controllers;

use Admin\Controllers\BaseController;

use Admin\Repositories\OrderRepository;

use KH\Models\Pagination;

require_once('baseController.php');

require_once(__DIR__ . '\..\repositories\OrderRepository.php');

require_once('../khachhang/models/Pagination.php');

class OrderController extends BaseController{

    use Pagination;
    
    protected $orderRepository;

    public function __construct()
    {
        parent::__construct();
        if(!isAdminLogin()){
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

    // public function index()
    // {
    //     if(!isAdminLogin()){
    //         return $this->redirect('dang-nhap');
    //     }
     
    //     $this->setOrderRepository(new OrderRepository());

    //     $userId = $_SESSION['userLogin']['id'];
      
       
    //     $config = [
    //         'total' => count($listCart), 
    //         'limit' => 5,
    //         'full' => false,
    //         'querystring' => 'trang' 
    //     ];
  
    //     $this->setPagination($config);
    //     $currentPage = $this->getCurrentPage();

    //     $listCart = $this->getOrderRepository()->getListOrder($currentPage, $config['limit']);
        
    //     $data = [
    //         'title' => 'Danh sách đơn hàng - Cường Lê', 
    //         'products' => $listCart,
    //         'page'  => $this->getPagination(),
    //         'total' => $config['total']
    //     ];

    //     $this->render('order', $data);
    // }

}