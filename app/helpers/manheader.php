<?php
$user=$this->model('User');
$notify=$this->model('Notify');
	                    $noticeboard=$notify->getNotifications('active');
	                    Session::put('notiBoard',$noticeboard);
	echo '
	<body>
	   <div id="loading"></div>
		<header>
		<style></style>
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
							<input type="hidden"  id="message" value="'.Session::get('message').'">'; 
							// echo 'message'.Session::get('message');
						echo'<a href="home" class="navbar-brand">21 CLAIRTRELL</a>
						</div>
						<div class="collapse navbar-collapse" id="collapsemenu">
							<ul class=" nav navbar-nav">';
							if(isset($data['highlightmr']))
							echo '<li class="'.$data['highlightmr'].'"><a href="manresidents">Residents</a></li>';
						    else 	
							echo '<li ><a href="manresidents">Residents</a></li>';
						  
				   		   if(isSet($data['highlightmrsrv']))	
							echo '<li class="'.$data['highlightmrsrv'].'" ><a href="manreservgroom">Reservation</a></li>';
 							else 
					    	echo '<li><a href="manreservgroom">Reservations</a></li>';

							if(isSet($data['highlightsrv']))
							echo '<li class="'.$data['highlightsrv'].'"><a href="manservices">Services</a></li>';
						    else 	
							echo '<li ><a href="manservices">Services</a></li>';

							if(isSet($data['highlightnm']))
							echo '<li class="'.$data['highlightnm'].'"><a href="notificationmon">Notifications</a></li>';
						    else 
					    	echo '<li><a href="notificationmon">Notifications</a></li>';
						
							// if(isSet($data['highlightc']))
							// echo '<li class="'.$data['highlightc'].'""><a href="contact">Contact</a></li>';
						 //    else 	
							// echo '<li ><a href="contact">Contact</a></li>';
                       
             	      
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
				
				<div class="btn-group" role="group" aria-label="Controls" style="display: initial;">
				<button type="button" class="btn btn-primary btn-sm toggle-sidebar" style="left: -31px; top: 14px;"><span class="glyphicon glyphicon-chevron-left"></span></button>
				</div>	
		';
		}	
		?>