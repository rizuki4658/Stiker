<?php
Class Dashboard_Transaction{
	private $_db;

	public function __construct(){
		$this->_db = Database::getInstance();
	}

	public function insert($fields = array()){
		if ( $this->_db->insert('transaction', $fields) ) return true; else return false;
	}

	public function update($fields = array(), $id ){
		if ( $this->_db->update('transaction',$fields, $id) ) return true; else return false;
	}

	public function update1($fields = array(), $id ){
		if ( $this->_db->update1('transaction',$fields, $id) ) return true; else return false;
	}

	public function delete( $id ){
		if ( $this->_db->delete('transaction', $id) ) return true; else return false;
	}

	public function get_trans_admin(){
		$host		='localhost';
		$username	='root';
		$password	='';
		$database	='db_nine_production';
		$link		=mysqli_connect($host, $username, $password, $database) or die(mysqli_error());
		$query	="SELECT * FROM transaction ORDER BY date DESC";
		$result	=mysqli_query($link, $query);
		
		return $result; 
	}

	public function get_trans_admin_id($id){
		$host		='localhost';
		$username	='root';
		$password	='';
		$database	='db_nine_production';
		$link		=mysqli_connect($host, $username, $password, $database) or die(mysqli_error());
		$query	="SELECT * FROM transaction WHERE id=$id ";
		$result	=mysqli_query($link, $query);
		
		return $result; 
	}

	public function get_badges_admin(){
		$host		='localhost';
		$username	='root';
		$password	='';
		$database	='db_nine_production';
		$link		=mysqli_connect($host, $username, $password, $database) or die(mysqli_error());
		$query		="SELECT * FROM transaction WHERE read_admin=0 ORDER BY date DESC";
		$result		=mysqli_query($link, $query);
		
		return $result; 
	}
}
?>