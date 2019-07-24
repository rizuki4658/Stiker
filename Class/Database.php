<?php

class Database{
	private static $INSTANCE=NULL;
	private $mysqli,
			$HOST		='localhost',
			$USER		='root',
			$PASSWORD	='',
			$DBNAME		='db_nine_production';
	
	public function __construct(){
		$this->mysqli = new mysqli( $this->HOST, $this->USER, $this->PASSWORD, $this->DBNAME);
	
		if ( mysqli_connect_error() ) {
			die('Connection is deny!');
		}
	}
	
	public static function getInstance(){
		if ( !isset( self::$INSTANCE) ) {
			self::$INSTANCE = new Database();
		}

		return self::$INSTANCE;
	}

	public function run_query($query, $msg){
		if ($this->mysqli->query($query) ) return true; else die($msg);
	}

	public function escape($name){
		return $this->mysqli->real_escape_string($name);
	}

	public function get_info($tabel, $column='', $value=''){
		if ( !is_int($value)) $value = "'" . $value . "'";

			if ( $column != '') {
			$rowss=array();	
			$query = "SELECT * FROM $tabel WHERE $column = $value";
			//die($query);
			$result = $this->mysqli->query($query);
		
			while ( $row = $result->fetch_assoc() ) {
				$results[] = $row;
				$rowss[] = $results;
				return $row;
			}
		}else{

			$query = "SELECT * FROM $tabel";

			$result = $this->mysqli->query($query);
		
			while ( $row = $result->fetch_assoc() ) {
				$results[] = $row;
			}

			return $results;
		}
	}

	public function insert($table, $fields =array()){

		//mengambil kolom
		$column = implode(", ", array_keys($fields));

		//mengambil nilai
		$valuesArrays 	= array();
		$i 				= 0;

		foreach ($fields as $key=>$values) {
			if ( is_int($values) ) {
				$valuesArrays[$i] = $this->escape($values);
			}else{
				$valuesArrays[$i] = "'" . $this->escape($values) . "'";
			}
			$i++;
		}

		$values = implode(", ", $valuesArrays);

		$query = "INSERT INTO $table ($column) VALUES ($values)";
		//die($query);
		return $this->run_query($query, 'Error For INSERT');
	}

	public function update($table, $fields, $id){
		$valuesArrays 	= array();
		$i 				= 0;

		foreach ($fields as $key=>$values) {
			if ( is_int($values) ) {
				$valuesArrays[$i] = $key . "=".$this->escape($values);
			}else{
				$valuesArrays[$i] = $key . "='" . $this->escape($values) . "'";
			}
			$i++;
		}

		$values = implode(", ", $valuesArrays);

		$query = "UPDATE $table SET $values WHERE id = $id";
		//die($query);
		return $this->run_query($query, 'Error For UPDATE');
	}

	public function update1($table, $fields, $id){
		$valuesArrays 	= array();
		$i 				= 0;

		foreach ($fields as $key=>$values) {
			if ( is_int($values) ) {
				$valuesArrays[$i] = $key . "=".$this->escape($values);
			}else{
				$valuesArrays[$i] = $key . "='" . $this->escape($values) . "'";
			}
			$i++;
		}

		$values = implode(", ", $valuesArrays);

		$query = "UPDATE $table SET $values WHERE id = $id";
		//die($query);
		return $this->run_query($query, 'Error For UPDATE');
	}

	public function delete($table, $id){
		
		$id=$this->escape($id);
		
		$query = "DELETE FROM $table WHERE id = $id";
		//die($query);
		return $this->run_query($query, 'Error For UPDATE');
	}
}


?>