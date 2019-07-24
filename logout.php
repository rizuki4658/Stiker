<?php
require_once 'Core/init.php';
if(Input::get('submit_logout')=='yes'){
	session_destroy();
    Redirect::to('login');
}else{
    Redirect::to('index');	
}
?>