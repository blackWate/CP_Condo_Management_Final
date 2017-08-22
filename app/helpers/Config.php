<?php

 class Config{
   public static function get($path=null){
     if($path){
     	$config=$GLOBALS['config'];//get config array 
     	$path=explode('/', $path);//create array of path 
     	foreach ($path as $bit ) {// 
     		if(isset($config[$bit])){
     			$config=$config[$bit];
     		}
     	}
     	return $config;
        // print_r($config);
     }
     return false;

   }

 }