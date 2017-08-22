<?php


class App{

   protected $controller='home';
   protected $method='noMethod';
   protected $params=[];
   public function  __construct()
   {
   		$url=$this->parseUrl();
   		// echo "parsed url : ";
        // print_r($url);
   		if(file_exists('../app/controllers/'.$url[0].'.php')){
   			$this->controller=$url[0];
   			// echo '<br/>homestring: '. $url[0];
   			//remove from array
   			unset($url[0]);
            // echo("controller file exists<br>");
            // echo("Controller:".$this->controller."<br>");
   		}

   		require_once '../app/controllers/'.$this->controller.'.php';
   		$this->controller=new $this->controller;
         // echo "php file not exist Controller:<br>";
         // var_dump($this->controller);
		   if (isset($url[1])) {
   			if (method_exists($this->controller, $url[1])) {
   				$this->method=$url[1];
   				// echo '<br/> methodstring: '. $url[1];
   				//remove from array
      				unset($url[1]);
                  // echo("<br>method exist<br>");
   			}
              else{
               // echo("method not exist<br>");
               $url=array();
               // echo getcwd()."<br>";
               // print_r($this->controller);
               // echo "<br>";
               // echo "method:".$this->method."<br>";
               $this->controller='fileNotFound';
               require_once '../app/controllers/'.$this->controller.'.php';
               $this->controller=new $this->controller;
               $this->params=null;

              }
           }
            
   		$this->params=$url ? array_values($url):[]; 
   		// echo " params :";
     //     echo "<br>url<br>";
   		// print_r($url);
     //     echo "<br>";
     //     echo "this->controller<br>";
     //     print_r($this->controller); 
     //     echo "<br>";
     //     echo "<br>cmethod:".$this->method."<br>";
     //     echo "params<br>";
     //     print_r($this->params);
     //     echo "<br>";
   		call_user_func_array([$this->controller,$this->method], $this->params);

   
}
   //parse the url
   public function parseUrl()
	{ 
		// check whether url set
		if (isset($_GET['url'])) {
         // echo("parse url function<br>");
			//return array of the url
			return $url=explode('/', filter_var(rtrim($_GET['url'],'/'),FILTER_SANITIZE_URL));
		}
	}
}