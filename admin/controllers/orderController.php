<?php
namespace Admin\Controllers;

use Admin\Controllers\BaseController;

use Admin\Repositories\OrderRepository;

use KH\Models\Pagination;

require_once('baseController.php');

require_once(__DIR__ . '/../repositories/OrderRepository.php');

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

}