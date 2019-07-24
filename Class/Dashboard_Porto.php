<?php
Class Dashboard_Porto{
	private $_db;

	public function __construct(){
		$this->_db = Database::getInstance();
	}

	public function get_rows_porto(){
		$host		='localhost';
		$username	='root';
		$password	='';
		$database	='db_nine_production';
		$link		=mysqli_connect($host, $username, $password, $database) or die(mysqli_error());
		$query		="SELECT * FROM portofolio ORDER BY name ASC";
		$result		=mysqli_query($link, $query);
		
		return $result; 
	}

	public function get_rows_porto_id($id){
		$host		='localhost';
		$username	='root';
		$password	='';
		$database	='db_nine_production';
		$link		=mysqli_connect($host, $username, $password, $database) or die(mysqli_error());
		$query		="SELECT * FROM portofolio WHERE id=$id ORDER BY name ASC";

		//die($query);
		$result		=mysqli_query($link, $query);
		
		return $result;
	}

	public function insert($fields = array()){
		if ( $this->_db->insert('portofolio', $fields) ) return true; else return false;
	}

	public function update($fields = array(), $id ){
		if ( $this->_db->update('portofolio',$fields, $id) ) return true; else return false;
	}

	public function delete( $id ){
		if ( $this->_db->delete('portofolio', $id) ) return true; else return false;
	}
}