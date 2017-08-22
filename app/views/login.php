<?php

			// require_once '../app/init.php';
// require_once '../app/models/User.php';
			// $user=DB::getInstance()->get('user',array('unitno','=',101));
			// print_r($validation->errors());
   
	// if(Input::exists()){
	// echo '<br> Input::exists()<br>';
	// 			// var_dump(Input::exists());
	// 			// echo '<br>Token::check(Input::get("token")<br>';
	// 			// var_dump(Token::check(Input::get('token')));
	// 			// echo '<br>Config: '.Config::get('session/token_name');
	// 			//  var_dump(Token::check(Input::get('token')));
	// echo '<br>Session Token: '.Session::get('token');
	// echo '<br>Input Token: '.Input::get('token');
	// 	if ( Token::check(Input::get('token'))) {
	// 		echo '<br>I am in';	
			
	// 				  // echo '<br/>'.Input::get('password');
	// 	  $validate=new Validate();
	// 	  $validation=$validate->check($_POST,array(
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
	// 							    	// 'password2'=>array(
	// 							    	// 'required'=>true,
	// 							    	// 'matches'=>'password',
	// 							    	// )
	// 			));
	// 	  	if($validation->passed()){
	// 		  		echo "successfully";
	// 					  		// Session::flash('succes','You registered successfully!');
	// 					  		// header('Location:index.php')
	// 		  		$user= new User();
	// 		  		$login=$user->login(Input::get('unitno'),Input::get('password'));
	// 		  		if($login){
	// 		  			$this->view('login/loggedIn');
	// 		  			// Redirect::to('login/loggedIn');
	// 		  		}else{
	// 		  			echo 'login failed.';
	// 		  		}
	// 		  	}
	// 		else{
	// 		  			echo '<br>validation failed<br>';
	// 		  			foreach ($validation->errors() as $error) {
	// 		  				echo $error,'<br>';
	// 				}
	// 			}// print_r($validation->errors());
		  		
		  		
	// 	}
	// }

// $user=DB::getInstance()->insert('user',array(
// 	    'userid'=>NULL,
// 		'firstname'=>'Kim',
// 		'lastname'=>'Wang',
// 		'username'=>'kim.wang',
// 		'password'=>'2y$10$/FEFW7o3RW1jXe2NJSQExe9bx4mYccBdC3g9NXjw/exYnRT/mw70i',
// 		'tempassword'=>'temp',
// 		'role'=>'resident',
// 		'email'=>'kimwang@gmail.com',
// 		'phone'=>'4164143245',
// 		'unitno'=>'214',
// 		'userstatus'=>'n'
// 		));
// $userupdate=DB::getInstance()->update('user',12,array(
// 		'firstname'=>'John',
// 		'lastname'=>'Kim',
// 		'username'=>'john.kim',
// 		));

require_once( '../app/helpers/head.php');
require_once( '../app/helpers/header.php');

echo   '<div class="form">
      <div>
        <div id="home">   
          <h1  style="color:#d7caca" >Welcome Back!</h1>';
 
            // if(isSet($_GET['errorMessage'])&&$_GET['errorMessage']!="")
//                 echo '<h3 class="button button-block" style="text-align:center">'.$_GET
// ['errorMessage'].'</h3>';
          if (isSet($data['error'])) 
           echo '<h3 class="button button-block" style="text-align:center">'.$data['error'].'</h3>';
 
 echo '<form  method="post" action="login" >
            <div class="field-wrap">
            <label>
              Unit Number<span class="req">*</span>
            </label>
            <input style="color:white" type="id" name="unitno" required autocomplete="off"/>
          </div>
          
          <div class="field-wrap">
            <label>
              Password<span class="req">*</span>
            </label>
            <input style="color:white" type="password" name="password" required autocomplete="off"/>
          </div>
          
          <div><a href="resetpass" class="forgotPwd">Forgot Password?</a></div>'; 
          echo '<input type="submit" class="button button-block" name="btn-login" value="Log In"> 
          </form>
        </div> 
      </div>   
    </div> 
    <script src="https://code.jquery.com/jquery-2.1.3.min.js"
  integrity="sha256-ivk71nXhz9nsyFDoYoGf2sbjrR9ddh+XDkCcfZxjvcM="
  crossorigin="anonymous"></script>
    <script src="js/index.js"></script>
    </content>';
    require_once( '../app/helpers/footer.php');