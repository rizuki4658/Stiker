<?php

class Token{

	public static function generate(){
		return Session::set('token', md5(uniqid(rand(), true) ) );
	}

	public static function generate2(){
		return Session::set('token2', md5(uniqid(rand(), true) ) );
	}

	public static function generate3(){
		return Session::set('token3', md5(uniqid(rand(), true) ) );
	}

	public static function generate4(){
		return Session::set('token4', md5(uniqid(rand(), true) ) );
	}

	public static function check($token)
	{
		if ( $token === Session::get('token') ) return true; else return false;
	}

	public static function check2($token)
	{
		if ( $token === Session::get('token2') ) return true; else return false;
	}

	public static function check3($token)
	{
		if ( $token === Session::get('token3') ) return true; else return false;
	}

	public static function check4($token)
	{
		if ( $token === Session::get('token4') ) return true; else return false;
	}
}
?>