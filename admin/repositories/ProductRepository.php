<?php 
namespace Admin\Repositories;

use KH\Models\Order;
use KH\Models\User;
use KH\Models\Product;

require_once(__DIR__ .'/../../khachhang/models/Product.php');
require_once(__DIR__ .'/../../khachhang/models/Order.php');

class ProductRepository{

    const TARGET_DIR =  "assets/img/upload/";
    const EXTENSION_ALLOW = ["jpg","jpeg","png","gif"];
    
    public function handleUpload($file, &$error)
    {
        $name =  time() . '.' . $file['image_url']['name'];
 
        $nameSave = self::TARGET_DIR .$name;
        $targetFile = self::TARGET_DIR . basename($name);
        
        $imageFileType = strtolower(pathinfo($targetFile,PATHINFO_EXTENSION));

        if( !in_array($imageFileType, self::EXTENSION_ALLOW) ){
            $error .= 'Vui lòng nhập đúng định dạng hình ảnh<br>';
        }else if($file['image_url']['size'] > 2000000){
            $error .= 'Vui lòng upload hình ảnh nhỏ hơn 2M<br>';
        }else{
            move_uploaded_file($file['image_url']['tmp_name'], $nameSave);
        }
        return $nameSave;
    }

}  

?>