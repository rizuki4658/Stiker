<?php
Class Dashboard_Slide{
	private $_db;

	public function __construct(){
		$this->_db = Database::getInstance();
	}

	public function get_rows_slide(){
		$host		='localhost';
		$username	='root';
		$password	='';
		$database	='db_nine_production';
		$link		=mysqli_connect($host, $username, $password, $database) or die(mysqli_error());
		$query		="SELECT * FROM slide_shows ORDER BY name ASC";
		$result		=mysqli_query($link, $query);
		
		return $result; 
	}

	public function get_rows_slide_id($id){
		$host		='localhost';
		$username	='root';
		$password	='';
		$database	='db_nine_production';
		$link		=mysqli_connect($host, $username, $password, $database) or die(mysqli_error());
		$query		="SELECT * FROM slide_shows WHERE id=$id ORDER BY name ASC";

		//die($query);
		$result		=mysqli_query($link, $query);
		
		return $result; 
	}

	public function insert($fields = array()){
		if ( $this->_db->insert('slide_shows', $fields) ) return true; else return false;
	}

	public function update($fields = array(), $id ){
		if ( $this->_db->update('slide_shows',$fields, $id) ) return true; else return false;
	}

	public function delete( $id ){
		if ( $this->_db->delete('slide_shows', $id) ) return true; else return false;
	}
}

?>