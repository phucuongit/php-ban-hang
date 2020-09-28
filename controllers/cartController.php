<?php
require_once('baseController.php');
require_once('models/Product.php');
require_once('models/Order.php');

class CartController extends baseController {
    
    public function index(){
        $list = [];
        $itemCart = $_SESSION['item'];
        $total = 0;
        foreach($itemCart as $key => $item){
            $prod = Product::findById($key);
            $total += ( $prod->price * $item['quality'] );
            $prod = json_decode(json_encode($prod), true);

            $prod = array_merge($prod, array('quality' => $item['quality']));
            
            array_push($list, $prod);
        }
        $data = array('products' => $list, 'total' => $total);
        $this->render('cart', $data);
    }

    public function update(){
        $itemCart = $_SESSION['item'];
        $total = 0;
        $list = [];
        foreach($itemCart as $key => $item){
            $_SESSION['item'][$key]['quality'] = $_POST['quality'][$key];
        }
        header('Location: /gio-hang');
    }

    public function confirm(){
        if(count($_SESSION['item']) > 0){
            
            $list = [];
            $itemCart = $_SESSION['item'];
            $total = 0;
            foreach($itemCart as $key => $item){
                $prod = Product::findById($key);
                $total += ( $prod->price * $item['quality'] );
                $prod = json_decode(json_encode($prod), true);

                $prod = array_merge($prod, array('quality' => $item['quality']));
                
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
                echo 'save don hang that bai';
                return;
            }

            $order->saveManyProduct($data['products'],$idInserted);
            $this->render('confirm', $data);
            $_SESSION['item'] = null;
            return null;
        }else {
            $data = array('error' => 'ban k co bat ki san pham nao trong gio');
            return $this->render('cart', $data);
        }
      
    }

    public function indexAdmin(){
        $data = array('orders' => Order::all());
        
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

    public function error(){
      $this->render('error');
    }
    

}