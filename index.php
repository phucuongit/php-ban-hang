<?php

if(session_id() === ''){
    session_start();
} 

require_once('utility/connection.php');
require_once('routes.php');