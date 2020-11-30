<?php 
namespace Admin\Repositories;

use KH\Models\Order;
use KH\Models\User;
use KH\Models\Product;

require_once(__DIR__ .'\..\..\khachhang\models\Product.php');
require_once(__DIR__ .'\..\..\khachhang\models\Order.php');

class OrderRepository{

    const WAITING = 'Đợi xác nhận';
    const DELIVER = "Đang vận chuyển";
    const SUCCESS = "Đã giao hàng";

    const TRANSFER  = "Chuyển khoản";
    const COD       = "Thanh toán khi nhận hàng"; 
    
    public function getListOrderByUser($userId)
    {
        $user = User::findById($userId);

        if(!$user) return [];

        return Order::myOrder($userId);

    }

    public function getListOrder($current, $limit)
    {
        return Order::paginate($current, $limit);
    }
    public function statusOrder($statusCode)
    {
        switch($statusCode){
            case 0:
                return self::WAITING;
        
            case 1:
                return self::DELIVER;
           
            case 2:
                return self::SUCCESS;
           
        }

    }

    public function methodShip($method)
    {
        switch($method){
            case 0:
                return self::TRANSFER;
        
            case 1:
                return self::COD;
        }
    }
}  

?>