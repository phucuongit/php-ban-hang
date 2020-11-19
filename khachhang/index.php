<?php
namespace KH\App;
use KH\App\Router;
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

require_once("routers.php");
require_once("utility/config.php");
require_once('utility/connection.php');
date_default_timezone_set('Asia/Ho_Chi_Minh');

if(session_id() === ''){
    session_start();
} 

new Router();