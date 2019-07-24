<?php

session_start();
spl_autoload_register(function($class){
	require_once 'Class/'.$class.'.php';
});

$database 				= new Database();
$transaction 			= new Transaction();
$user 					= new User();
$dashboard_slide		= new Dashboard_Slide();
$dashboard_porto		= new Dashboard_Porto();
$dashboard_comp			= new Dashboard_Company();
$dashboard_trans		= new Dashboard_Transaction();
$report 				= new Dashboard_Report();
$landing 				= new Landing_index();		
?>