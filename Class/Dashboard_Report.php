<?php

class Dashboard_Report{
	public function get_report($date1, $date2){
		$host		='localhost';
		$username	='root';
		$password	='';
		$database	='db_nine_production';
		$link		=mysqli_connect($host, $username, $password, $database) or die(mysqli_error());
		$query		="SELECT * FROM transaction WHERE status!='Cancel' AND date>= '$date1' AND date<= '$date2' ORDER BY date ASC";
		//die($query);
		$result		=mysqli_query($link, $query);
		
		return $result; 
	}
}

?>