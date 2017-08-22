<?php
class Reservation extends Controller{
		 protected	$activeg,
					$activep,
		 			$activee;
	     
		  public function noMethod()
		{         
			     if ($_COOKIE['active']==='p') {
						$activep='active';
						$active='p';
						$activeg='';
					} else if($_COOKIE['active']==='e'){
						$activee='active';
						$active='e';
						$activeg='';
					}
					else  $activeg='active'; 

       			
       			$user=$this->model('User');
				
				
				if($user->isLoggedIn())
				{
				$userid=Session::get(Config::get('session/user_id'));
				$reservation=$this->model('Reserve');
				 $showchat=false;

				  //delete record
				  $active=$reservation->deleteRecord();
				  if ($active==='p') {
				  	    $active='p';
						$activep='active';
						$activeg='';
					} else if($active==='e'){
						$activee='active';
						$active='e';
						$activeg='';
					}

				//insert record
				if(Input::exists()){

					if(Input::get('chat')=='chat'){
                        $chat=$this->model('Chat');

						$reserveid= Input::get('reserveid');
						// $admin=Config::get('admin/admin_userid');
                     	$showchat=true;
                     	$chatParams=$chat->getChatParams($reserveid,'reservations',$user);
                     	// echo $chatParams[0]->unitno."<br>";
                     	// print_r($chat->getChat($reserveid,'reservations'));
                     	// print_r($chatParams);                       
					}else{
						$showchat=false;
					$active=$reservation->insertRecord($user,$userid);
					if ($active==='p') {
						$activep='active';
						$active='p';
						$activeg='';
					} else if($active==='e'){
						$activee='active';
						$active='e';
						$activeg='';
					}
				}
					
					
				}
					$unitno=Session::get(Config::get('session/session_name'));
				    $gr=$user->getGRoom($unitno)->results();
		  			$grBDays=json_encode($user->busyGR());

		  			$pr=$user->getPRoom($unitno)->results();
		  			$prBDays=json_encode($user->busyPR());

		  			$el=$user->getEl($unitno)->results();
		  			$elBDays=json_encode($user->busyEL());
				   
                    // print_r($elBDays); 
				    $_COOKIE['active']=$active;
		  			$this->view('/reservation',['grData'=>$gr,'prData'=>$pr,'elData'=>$el,'highlightr'=>'active','busyGRDays'=>$grBDays,'busyPRDays'=>$prBDays,'busyELDays'=>$elBDays,'activep'=>$activep,'activeg'=>$activeg,'activee'=>$activee,'showchat'=>$showchat,'adminid'=>$admin,'chatParams'=>$chatParams,'type'=>'reservations']);
				
   
				
				}
				else
				    $this->view('/login',['error'=>'Please Login for Reservation Page :)']);



		}
		
}

