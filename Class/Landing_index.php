<?php

class Landing_index{
	public function get_slide(){
		$host		='localhost';
		$username	='root';
		$password	='';
		$database	='db_nine_production';
		$link		=mysqli_connect($host, $username, $password, $database) or die(mysqli_error());
		$query	="SELECT * FROM slide_shows ORDER BY id DESC";
		$result	=mysqli_query($link, $query);
		
		return $result; 
	}

	public function get_porto(){
		$host		='localhost';
		$username	='root';
		$password	='';
		$database	='db_nine_production';
		$link		=mysqli_connect($host, $username, $password, $database) or die(mysqli_error());
		$query	="SELECT * FROM portofolio ORDER BY id ASC";
		$result	=mysqli_query($link, $query);
		
		return $result; 
	}

	public function get_company(){
		$host		='localhost';
		$username	='root';
		$password	='';
		$database	='db_nine_production';
		$link		=mysqli_connect($host, $username, $password, $database) or die(mysqli_error());
		$query	="SELECT * FROM company_profile";
		$result	=mysqli_query($link, $query);
		
		return $result; 
	}
}

?>