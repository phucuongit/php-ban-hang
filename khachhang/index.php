<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

require_once("utility/config.php");

if(session_id() === ''){
    session_start();
} 

require_once('utility/connection.php');
require_once('routes.php');