<?php 
namespace KH\Repositories;

use KH\Models\Order;
use KH\Models\User;

require_once('models/Order.php');
require_once('models/User.php');

class OrderRepository{

    const WAITING = 'Đợi xác nhận';
    const DELIVER = "Đang vận chuyển";
    const SUCCESS = "Đã giao hàng";

    public function getListOrderByUser($userId)
    {
        $user = User::findById($userId);

        if(!$user) return [];

        return Order::myOrder($userId);

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
}  

?>