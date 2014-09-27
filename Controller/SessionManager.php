<?php
class SessionManager {
	public static function set($key, $value){
		session_start();
		$_SESSION[$key] = serialize($value);
	}
	
	public static function get($key) {
		session_start();
		$value = unserialize($_SESSION[$key]);
		return $value;
	}
}