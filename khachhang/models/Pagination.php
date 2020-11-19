<?php 

namespace KH\Models;
trait Pagination {
    private $config = [
        'total' => 0,
        'limit' => 0,
        'full'  => true,
        'querystring' => 'page'
    ];

    /**
     * khởi tạo
     *
     * @param array $config
     */
    public function setPagination(array $config = []){
        if(isset($config['limit']) && $config['limit'] < 0 ||  isset($config['total']) && $config['total'] < 0){
            // nếu không thì dừng chương trình và hiển thị thông báo.
            die('limit và total không được nhỏ hơn 0');
        }

        if(!isset($config['querystring'])){
            $config['querystring']  = 'page';
        }
        $this->config = $config;
    }

    /**
     * Lay ra tong so trang
     * @return int
     */

        public function getTotalPage(){
            return (int)ceil($this->config['total'] / $this->config['limit']);
        }

        public function getCurrentPage(){
            if(isset($_GET[$this->config['querystring']]) && (int)$_GET[$this->config['querystring']] >= 1){
            // Nếu có kiểm tra tiếp xem nó có lớn hơn tổn số trang không.
            
            if((int) $_GET[$this->config['querystring']] > $this->getTotalPage()){
                return $this->getTotalPage();
            }else{
                return (int)$_GET[$this->config['querystring']];
            }
            
        }else{
                return 1;
            }
    }
    /**
     * Danh sach paginate
     * @return string
     */
    public function getPagination(){
        
        $data = '';
        if (isset($this->config['full']) && $this->config['full'] === false) {
            // nếu không thì
            $request = preg_replace("/[?&]" . $this->config['querystring'] . "=(\d)/", '' , $_SERVER['REQUEST_URI']);
            
            $current = $this->getCurrentPage();
            $data .= ($current - 3) > 1 ? '<li>...</li>' : '';
            for($i = ($current - 3) > 0 ? ($current  - 3) : 1; $i <= (($current + 3) > $this->getTotalPage() ? $this->getTotalPage() : ($this->getCurrentPage() + 3)); $i++){
                if ($i === $current) {
                    $data .= '<li class="page-item active"><a class="page-link" href="#" >' . $i . '</a> </li>';
                } else {
                    $data .= '<li class="page-item"><a class="page-link" href="' .  $request . (preg_match("/\?name/", $request) ? '&' : '?') . $this->config['querystring'] . '=' . $i . '" >' . $i . '</a> </li>';
                }
            }

            $data .= ($current + 3) < $this->getTotalPage() ? '<li>...</li>' : '';
        } else {
            // nếu có thì
            for ($i = 1; $i <= $this->getTotalPage(); $i++) {
                if ($i === $this->getCurrentPage()) {
                    $data .= '<li class="page-item active"><a class="page-link" href="#" >' . $i . '</a></li>';
                } else {
                    $data .= '<li class="page-item"><a class="page-link" href="' . $request . (preg_match("/\?name/", $request) ? '&' : '?') . $this->config['querystring'] . '=' . $i . '" >' . $i . '</a></li>';
                }
            }
        }

        return  $data ;
    }

}
?>