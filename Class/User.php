<?php
class User{
	private $_db;

	public function __construct(){
		$this->_db = Database::getInstance();
	}

	public function Logging(){
		if ( Session::exists('user_email') ) return true; else return false;
	}

	public function Login_User($email, $password){
		$data = $this->_db->get_info('users', 'email', $email);
		if ( password_verify($password, $data['password']) ) return true; else return false;
	} 

	public function cek_email($email){
		$data = $this->_db->get_info('users', 'email', $email);
		if ( empty($data) ) return false; else return true;
	}

	public function cek_id($id){
		$data = $this->_db->get_info('users', 'id', $id);
		if ( empty($data) ) return false; else return true;
	}

	public function get_data($email){
		if ( $this->cek_email($email) )
			return $data = $this->_db->get_info('users', 'email', $email);
		else
			return false;

	}

	public function get_data_id($id){
		if ( $this->cek_id($id) )
			return $data = $this->_db->get_info('users', 'id', $id);
		else
			return false;

	}

	public function User_Status($email){
		$data = $this->_db->get_info('users', 'email', $username);
		if ( $data['status'] == 'Admin') return true; else return false;	
	}

	public function register_user($fields = array()){
		if ( $this->_db->insert('users', $fields) ) return true; else return false;
	}

	public function update_user($fields = array(), $id ){
		if ( $this->_db->update('users',$fields, $id) ) return true; else return false;
	}

	public function get_users(){
		$host		='localhost';
		$username	='root';
		$password	='';
		$database	='db_nine_production';
		$link		=mysqli_connect($host, $username, $password, $database) or die(mysqli_error());
		$query	="SELECT * FROM users ORDER BY id ASC";
		$result	=mysqli_query($link, $query);
		
		return $result; 
	}

	public function get_users_id($id){
		$host		='localhost';
		$username	='root';
		$password	='';
		$database	='db_nine_production';
		$link		=mysqli_connect($host, $username, $password, $database) or die(mysqli_error());
		$query	="SELECT * FROM users WHERE id=$id";
		//die($query);
		$result	=mysqli_query($link, $query);
		
		return $result; 
	}

	public function delete( $id ){
		if ( $this->_db->delete('users', $id) ) return true; else return false;
	}
}

?>