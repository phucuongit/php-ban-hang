<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
ini_set('upload_max_filesize', '10M');

date_default_timezone_set("America/New_York");
error_reporting(E_ALL);

if(session_id() === ''){
    session_start();
} 

require_once('utility/connection.php');
require_once('routes.php');