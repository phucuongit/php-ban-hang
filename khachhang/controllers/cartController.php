<?php
namespace KH\Controllers;

use KH\Controllers\BaseController;

use KH\Models\Product;
use KH\Models\Order;

require_once('baseController.php');
require_once('models/Product.php');
require_once('models/Order.php');

class CartController extends BaseController {
    
    public function index(){
        $list = [];
        $itemCart = isset($_SESSION['item']) ? $_SESSION['item'] : [];
        $total = 0;

        if(empty($itemCart)){
            $data = array('products' => [], 'total' => 0);
            return $this->render('cart', $data);
        }
        foreach($itemCart as $key => $item){
            $prod = Product::findById($key);
            $total += ( $prod->price * $item['quality'] );
            $prod = json_decode(json_encode($prod), true);

            $prod = array_merge($prod, array('quality' => $item['quality']));
            
            array_push($list, $prod);
        }
        $data = array( 'title' => 'Giỏ hàng - Cường Lê', 'products' => $list, 'total' => $total);
        $this->render('cart', $data);
    }

    public function update(){
        $itemCart = $_SESSION['item'];
        $total = 0;
        $list = [];
        foreach($itemCart as $key => $item){
            $_SESSION['item'][$key]['quality'] = $_POST['quality'][$key];
        }
        $this->redirect('gio-hang');
    }

    public function delCart($id){
        unset($_SESSION['item'][$id[0]]);
        $this->redirect('gio-hang');
    }

    public function confirm(){
        if(isset($_SESSION['item']) && count($_SESSION['item']) > 0){
            $itemCart = $_SESSION['item'];
            $total = 0;
            $totalBackup=0;
            $listBakup = [];
            foreach($itemCart as $key => $item){
                $prod = Product::findById($key);
                $totalBackup += ( $prod->price * $item['quality'] );
                $prod = json_decode(json_encode($prod), true);
    
                $prod = array_merge($prod, array('quality' => $item['quality']));
                
                array_push($listBakup, $prod);
            }
            $list = [];
            foreach($itemCart as $key => $item){
                $prod = Product::findById($key);
                $quality =  $item['quality'];
                if($prod->in_stock - $quality < 0){
                    $result =   array('products' => $listBakup,'total' => $totalBackup,'error' => 'Lỗi sản phẩm '.$prod->title.' chỉ còn ' .$prod->in_stock.' sản phẩm, vui lòng mua nhỏ hơn số lượng sản phẩm có trong kho');
                    return $this->render('cart', $result);
                }
                $total += ( $prod->price * $quality);
                $prod = json_decode(json_encode($prod), true);

                $prod = array_merge($prod, array('quality' => $quality));
                
                array_push($list, $prod);
            }
            $data = array('products' => $list, 'total' => $total);
        
            $newOrder = array(
                'user_id' => $_SESSION['userLogin']['id'],
                'total' => $total
            );
            $order = new Order($newOrder);

            $order->save();
         
            $idInserted =  $order->lastInserted()['order_id'];
            if(!$idInserted){
                $result =  array('products' => $listBakup,'error' => 'Mua hàng không thành công do 1 số lỗi');
                return $this->render('cart', $result);
            }
            foreach($itemCart as $key => $item){
                $prod = Product::findById($key);
                $quality =  $item['quality'];
                $prod->in_stock -= $quality;
                Product::updateProductByStock($prod->id,$prod->in_stock);
            }
            $order->saveManyProduct($data['products'],$idInserted);
            $this->render('confirm', $data);
            $_SESSION['item'] = null;
            return null;
        }else {
            $data = array();
            return $this->render('cart', $data);
        }
      
    }

    public function indexAdmin(){
        if(isAdmin()){
            $data = array('orders' => Order::all());
        }else{
            $data = array('orders' => Order::myOrder($_SESSION['userLogin']['id']));
        }
        
        $data = array_merge($data, array('title' => 'Đơn hàng - Cường Lê'));
    
        return $this->render('order', $data, 'adminLayout');
    }

    public function orderDel(){
        $id = $_POST['id'];

        if(Order::delete($id)){
            header('Location: /admin/don-hang/');
        }else{
            $data = array('orders' => Order::all(), 'error' => 'Loi xoa don hang');

            $this->render('order', $data, 'adminLayout');  
        }
    }
    public function detail(array $id){
       
        $regex = "/id=(\d+)/";
        preg_match($regex, $id[0], $match);
        if(!isset($match[1])){
            return "Loi";
        }
        $id = $match[1];
        $products = Order::ManyToMany($id);

        $data = array('order' => Order::findById($id), 'products' => convertObjectToArray($products));
        
        $this->render('invoice', $data, 'adminLayout');  

    }
    public function updateStatus(){
        $id = $_POST['id'];
        $status = $_POST['status'];

        Order::updateOne($id, $status);
    }
    public function error(){
      $this->render('error');
    }
    

}