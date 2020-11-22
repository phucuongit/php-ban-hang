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

    public function getDetailOrder($orderId)
    {
        try{
            $order = Order::ManyToMany($orderId);
            return [
                'status'   => 'OK',
                'data'     => $order
            ];
        }catch (Exception $error){
            return [
                'status'    => 'ERROR',
                'code'      => 'getDetailOrder.failed.data_error' 
            ];
        }
    }

    public function getTotalOrder($orderId){
        try{
            $order = Order::findById($orderId);
            return [
                'status'   => 'OK',
                'data'     => $order
            ];
        }catch (Exception $error){
            return [
                'status'    => 'ERROR',
                'code'      => 'getTotalOrder.failed.data_error' 
            ];
        }
    }
}  

?>