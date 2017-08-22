<?php

ini_set('display_errors', 'On');

session_start();
$GLOBALS['config']=array(

	'mysql' => array(
		// 'host' =>'localhost' , 
		// 'username' =>'id885806_admin',
		// 'password' =>'t127T127',
		// 'dbname' =>'id885806_clairtrell',
		'host' =>'localhost' , 
		'username' =>'root',
		'password' =>'root',
		'dbname' =>'id885806_condotcss2316',
		),
	 'remember' =>array(
		'cookie_name' =>'hash' , 
		'cookie_expiry' =>684800,
		),
	 'uploadfile' =>array(
		'notification_dir' =>'../app/files/notifications/' ,
		'max_filesize' =>4194304 ,
		'file_types' =>array('pdf','doc','docx','txt'),  
		),
	 'filepath' =>array(
		'photos_residents' =>'photos/residents/',
		'photos_residents3' =>'photos/residents300/',
		'photos_owners' =>'photos/owners/',  
		),
	 'timezone' =>array(
		'timezone_name' =>'America/Toronto' ,
		'timezone_date_format' =>'%Y-%m-%d' ,
		'timezone_time_format' =>'%h:%i %p' , 
		),
	 'session' =>array(
		'session_name' =>'user' ,
		'token_name'=>'token',
		'token_name1'=>'token1',
		'token_name2'=>'token2',
		'token_name3'=>'token3',
		'user_name'=>'name',
		'user_id'=>'userid',
		'user_role'=>'role',
		'user_photo'=>'photo', 
		),
	 'website'=>array(
	 	'website_address'=>'https://clairtrell.000webhostapp.com/',
	 	'website_name'=>'TSCC2316 Condo Management'
	 	),
	 'reservation'=>array(
	 	'pending_limit'=>24,
	 	'cancel_limit'=>48,
	 	),
	 'admin'=>array(
	 	'admin_default'=>9007,
	 	)
	);
	spl_autoload_register(function($class){
		require_once 'helpers/'.$class.'.php';
	});

require_once 'functions/sanitize.php';  
require_once 'core/App.php';
require_once 'core/Controller.php';
// date_default_timezone_set(Config::get('timezone/timezone_name'));
