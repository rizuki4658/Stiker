<?php
Class Dashboard_Company{
	private $_db;

	public function __construct(){
		$this->_db = Database::getInstance();
	}

	public function get_rows_comp(){
		$host		='localhost';
		$username	='root';
		$password	='';
		$database	='db_nine_production';
		$link		=mysqli_connect($host, $username, $password, $database) or die(mysqli_error());
		$query		="SELECT * FROM company_profile ORDER BY name ASC";
		$result		=mysqli_query($link, $query);
		
		return $result; 
	}

	public function get_rows_comp_id($id){
		$host		='localhost';
		$username	='root';
		$password	='';
		$database	='db_nine_production';
		$link		=mysqli_connect($host, $username, $password, $database) or die(mysqli_error());
		$query		="SELECT * FROM company_profile WHERE id=$id ORDER BY name ASC";

		//die($query);
		$result		=mysqli_query($link, $query);
		
		return $result;
	}

	public function update($fields = array(), $id ){
		if ( $this->_db->update('company_profile',$fields, $id) ) return true; else return false;
	}
}
?>