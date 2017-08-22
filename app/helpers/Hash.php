<?php

class Hash{

	public static function hash($string)
	{
		return password_hash($string,PASSWORD_BCRYPT,array('cost'=>10));
	}
	public static function unhash($string)
	{
		return password_verify($string);
	}
}