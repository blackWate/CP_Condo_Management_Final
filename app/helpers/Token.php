<?php
 class Token 
 {
 	
 	public static function generate($num=null)
 	{
 		return Session::put(Config::get('session/token_name'.$num.''),md5(uniqid()));
 	}
 	public static function check($token,$num=null)
 	{
 		$tokenName=Config::get('session/token_name'.$num.'');
 		if (Session::exists($tokenName) && $token===Session::get($tokenName)){
 			Session::delete($tokenName);
 			return true;
 		}
 		return false;
	}

}
