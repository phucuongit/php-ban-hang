<?php
namespace KH\Controllers;

use KH\Controllers\BaseController;

use KH\Models\Product;
use KH\Models\Order;

use KH\Repositories\OrderRepository;

require_once('baseController.php');
require_once('models/Product.php');
require_once('models/Order.php');
require_once('repositories/OrderRepository.php');

class CartController extends BaseController {
    
    private $orderRepository;
    
    public function __construct(){
        parent::__construct();
        $this->orderRepository = new OrderRepository();
    }

    public function getOrderRepository() :OrderRepository
    {
        return $this->orderRepository;
    }
    
    public function index(){

        $result = $this->getOrderRepository()->getListOrderItem();
     
        $data = array( 'title' => 'Giỏ hàng - Cường Lê', 'products' => $result['products'], 'total' => $result['total']);
        
        $this->render('cart', $data);
    }

    public function update(){
        $itemCart = $_SESSION['item'];
        $list = [];
        foreach($itemCart as $key => $item){
            if($_POST['quality'][$key] > 0){
                $_SESSION['item'][$key]['quality'] = $_POST['quality'][$key];
            }
        }
        $this->redirect('gio-hang');
    }

    public function delCart(){
        header("Content-Type: application/json");
        try{
            $id = $_POST['item_id'];
            unset($_SESSION['item'][$id]);
            $result = $this->getOrderRepository()->getListOrderItem();
            echo json_encode([
                'status'    => "OK",
                "message"   => "Xóa thành xông sản phẩm khỏi giỏ hàng",
                "total"     => formatCurrency($result['total'])
            ]);
        }catch(Exception $error){
            echo json_encode([
                'status'    => "ERROR",
                "code"      => "addToCart.failed.not_found_product_id",
                "message"   => "Không thể xóa sản phẩm này khỏi giỏ hàng"
            ]);
        }
        return;
    }

    public function confirm(){
        if(isset($_SESSION['item']) && count($_SESSION['item']) > 0){
            if(!isLogin()){
                $this->redirect('dang-nhap');
                return;
            }

            $fullName = $_POST['fullname'];
            $email = $_POST['email'];
            $phoneNumber = $_POST['phone_number'];
            $address = $_POST['address'];
            $note = $_POST['note'];
            $paymentMethod = $_POST['payment_method'];
          
            $resultCheck = $this->validateSubmit([
                'fullname'  => 'Vui lòng nhập họ và tên',
                'phone_number'  => 'Vui lòng nhập số điện thoại',
                'address'       => 'Vui lòng nhập địa chỉ giao hàng',
            ]);
            if(strlen($phoneNumber) != 10 && strlen($phoneNumber) != 11){
                $resultCheck = [
                    'status'    => 'ERROR',
                    'message'   => 'Vui lòng nhập số điện thoại 10 hoặc 11 số'
                ];
            }
            $result = $this->getOrderRepository()->getListOrderItem();
            
            if($resultCheck['status'] == 'OK'){
                
                $newOrder = array(
                    'user_id'       => $_SESSION['userLogin']['id'],
                    'total'         => $result['total'],
                    'fullName'      => $fullName,
                    'email'         => $email,
                    'phoneNumber'  => $phoneNumber,
                    'address'       => $address,
                    'note'          => $note,
                    'paymentMethod'=> $paymentMethod
                );
                
                $order = new Order($newOrder);
    
                $resultSave = $order->save();
           
                $idInserted =  $order->lastInserted()['order_id'];
                if(!$idInserted){
                    $result =  array('products' => $result['products'], 'total' => $result['total'], 'error' => 'Mua hàng không thành công do 1 số lỗi');
                    return $this->render('cart', $result);
                }
                $itemCart = $_SESSION['item'];
                foreach($itemCart as $key => $item){
                    $prod = Product::findById($key);
                    $quality =  $item['quality'];
                    $prod->in_stock -= $quality;
                    Product::updateProductByStock($prod->id,$prod->in_stock);
                }
                $order->saveManyProduct($itemCart,$idInserted);
                $_SESSION['item'] = null;
           
                $data = [ 
                    'title'     => 'Mua thành công sản phẩm - Cường Lê', 
                    'products'  => $result['products'], 
                    'total'     => $result['total'],
                ];
                $this->render('confirm', $data);
                
            }else{
         
                $data = [ 
                    'title'     => 'Giỏ hàng - Cường Lê', 
                    'products'  => $result['products'], 
                    'total'     => $result['total'],
                    'errorCart'     => $resultCheck['message']
                ];
                 
                $this->render('cart', $data);
            }

        }else {
            return $this->redirect('gio-hang');
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