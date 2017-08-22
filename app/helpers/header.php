<?php
// echo '<br>Date&Time: '.date('m/d/Y h:i:s a', time()).'<br>';
$user=$this->model('User');
$notify=$this->model('Notify');
	                    $noticeboard=$notify->getNotifications('active');
	                    Session::put('notiBoard',$noticeboard);
// $users=$user->systemUsers();
// print_r($users);
// echo $users[0]->host;
	echo '
	<body>
	   <div id="loading"></div>
		<header>
			<section class="row" id="Viola">
				<nav class="navbar navbar-default" id="nav">
					<div class="container">
						<div class="navbar-header">
							<button type="button" 
								class="navbar-toggle collapsed" 
								data-toggle="collapse" 
								data-target="#collapsemenu"
								aria-expanded="false">
								<span class="sr-only">Toggle navigation</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
							<input type="hidden"  id="message" value="">'; 
							// echo Session::get('message');
						echo'	<a href="home" class="navbar-brand">21 CLAIRTRELL</a>
						</div>
						<div class="collapse navbar-collapse" id="collapsemenu">
							<ul class=" nav navbar-nav">';
						if(Session::get(Config::get('session/user_role'))=='manager')
							echo '<li class=""><a href="dashboard">Dashboard</a></li>';
						   
						if(isSet($data['highlighth']))
							echo '<li class="'.$data['highlighth'].'"><a href="home">Home</a></li>';
						    else 
					    	echo '<li><a href="home">Home</a></li>';
						  
						   if(isSet($data['highlightr']))	
							echo '<li class="'.$data['highlightr'].'" ><a href="reservation">Reservation</a></li>';
 							else 
					    	echo '<li><a href="reservation">Reservation</a></li>';
					    	
					    	if(isSet($data['highlights']))
							echo '<li class="'.$data['highlights'].'" ><a href="service">Service</a></li>';
							else
							echo '<li><a href="service">Service</a></li>';

							
						if(isSet($data['highlighta']))
							echo '<li class="'.$data['highlighta'].'"><a href="about">About</a></li>';
						    else 	
							echo '<li ><a href="about">About</a></li>';
						if(isSet($data['highlightc']))
							echo '<li class="'.$data['highlightc'].'"><a href="contact">Contact</a></li>';
						    else 	
							echo '<li ><a href="contact">Contact</a></li>';
                       
                        if(Session::get(Config::get('session/user_name'))){
                        	
        echo '
             <li class="login"><a class="loginBtn" id="button_login" href="logout">Logout</a></li>
<li><h5 style="margin-left:60px; margin-top:19px;">'.Session::get('user_icon').'Welcome '.Session::get(Config::get('session/user_name')).'&nbsp;&nbsp;</h5></li>';
          						}
		                    else{

        echo '<li class="login"><a class="loginBtn" id="button_login" href="login">Login</a></li>';}
		echo
		'
							</ul>
						</div>
					</div>
				</nav>	
			</section>
		</header>

  <div class="container-fluid">';
if($user->isLoggedIn()){
require( '../app/helpers/noticesidebar.php');

echo'		<div class="col-md-12" id="content" >
				
				<div class="btn-group" role="group" aria-label="Controls">
				<button type="button" class="btn btn-primary btn-sm toggle-sidebar" style="left: -31px; top: 14px;"><span class="glyphicon glyphicon-chevron-left"></span></button>
				</div>	
		';
	}
		