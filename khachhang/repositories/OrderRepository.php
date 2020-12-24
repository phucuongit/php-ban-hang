<?php 
namespace KH\Repositories;

use KH\Models\Order;
use KH\Models\User;
use KH\Models\Product;

require_once('models/Order.php');
require_once('models/User.php');
require_once('models/Product.php');

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

    public function getOrder($orderId){
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
    public function methodShip($method)
    {
        switch($method){
            case 0:
                return self::TRANSFER;
        
            case 1:
                return self::COD;
        }
    }
    
    public function getListOrder($current, $limit, $user = null)
    {
        return Order::paginate($current, $limit, $user);
    }
    
    public function totalOrderByUser($user)
    {
        return Order::totalOrderByUser($user);
    }
    
    public function getListOrderItem()
    {
        $list = [];
        $itemCart = isset($_SESSION['item']) ? $_SESSION['item'] : [];
        $total = 0;

        if(empty($itemCart)){
            return [
                'products' => [], 
                'total' => 0
            ];
        }
        
        foreach($itemCart as $key => $item){
            $prod = Product::findById($key);
            if($prod){
                $total += ( $prod->price * $item['quality'] );
                $prod = json_decode(json_encode($prod), true);
    
                $prod = array_merge($prod, array('quality' => $item['quality']));
                
                array_push($list, $prod);
            }else{
                unset($_SESSION['item'][$key]);
            }
        }
        
        return [
            'products' => $list, 
            'total' => $total
        ];
    }
}  

?>