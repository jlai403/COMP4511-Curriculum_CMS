<?php

class SecurityManager {
	public static function validateAndEncrpytPassword($password) {
		self::assertPasswordIsValid($password);
		return hash('sha256', $password);
	}
	
	private static function assertPasswordIsValid($password) {
		$passwordLength = strlen($password);
		if ($passwordLength < 6) {
			throw new MyException("Password does not have at least 6 characters.");
		}
	}
}