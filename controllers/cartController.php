<?php
require_once('baseController.php');
require_once('models/Product.php');
require_once('models/Order.php');

class CartController extends baseController {
    
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
            // foreach($itemCart as $key => $item){
            //     $prod = Product::findById($key);
            //     $total += ( $prod->price * $item['quality'] );
            //     $prod = json_decode(json_encode($prod), true);

            //     $prod = array_merge($prod, array('quality' => $item['quality']));
                
            //     array_push($list, $prod);
            // }
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
        if(isAdmin()){
            $data = array('orders' => Order::all());
        }else{
            $data = array('orders' => Order::myOrder($_SESSION['userLogin']['id']));
        }
        
        
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