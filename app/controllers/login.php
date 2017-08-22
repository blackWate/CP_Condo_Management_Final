<?php

class Login extends Controller{

	
  public function noMethod()
{
	$user=$this->model('User');
	
	if($user->isLoggedIn())
     

        //noticeboard
        
        // print_r($noticeboard);
		$this->view('/home');
	if(Input::exists()){
	// $validate=new Validate();
	// $validation=$validate->check($_POST,array(
	// 		    'unitno'=>array(
	// 		    	'required'=>true,
	// 		    	'min'=>3,
	// 		    	'justnumber'=>true
	// 		    	// 'unique'=>'user'
	// 		    	),
	// 		    	'password'=>array(
	// 		    	'required'=>true,
	// 		    	'min'=>4,
	// 		    	)
	// 			));
	// if($validation->passed()){
						  		
			  		// $user=$this->model('User');
			  			
			  		$login=$user->login(Input::get('unitno'),Input::get('password'));
			  		if($login){

			  			$notify=$this->model('Notify');
	                    $noticeboard=$notify->getNotifications('active');
	                    Session::put('notiBoard',$noticeboard);
			  			Session::put('user_icon','<span class="glyphicon glyphicon-user" style="font-size: 18px;">&nbsp;</span>');

			  			//set timezone
			  			// $user->setGTimezone();



			  			//save ipaddresses to the user table
			  			$remadd=$_SERVER['REMOTE_ADDR'];
			  			$remaddF=$_SERVER['HTTP_X_FORWARDED_FOR'];
			  			$fields=['ipaddress'=>$remadd,'ipaddressf'=>$remaddF];
			  			$updateip=$user->update(Input::get('unitno'),$fields);
			  			



			  			if($user->isAdmin())
			  				$this->view('/dashboard');
			  			else
			  				$this->view('/home');




			  			

			  			

			  		}else{
			  			
			  			// $this->view('/login',['error'=>'Wrong Username Or Password','username'=>Input::get(Session::get(Config::get('session/user_name')))]);
			  			$this->view('/login',['error'=>'Wrong Username Or Password']);
			  		}
			  	// }
			// else{
			//   			echo '<br>validation failed<br>';
			//   			foreach ($validation->errors() as $error) {
			//   				echo $error,'<br>';
			// 		}
	
   	
	 }
	 else {
	 	$this->view('/login');
	 }
	
	
}

}