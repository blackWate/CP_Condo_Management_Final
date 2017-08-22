<?php

class Manreservelevator extends Controller{


	  public function noMethod()
	{
		$user=$this->model('User');
  //   $chat=$this->model('Chat');
		// $unread=$chat->getUnreadReserv();
    $showchat=false;
		if(Input::exists()){
			$reservation=$this->model('Reserve');
		   //if delete button pressed	
           if(Input::get('delete')=='delete'){
           	// echo('<br>delete button pressed<br>');
           	$reserveid=Input::get('groomid');
           	$reservation->deleteRecord($reserveid);
           }

            if(Input::get('chat')=='chat'){
                        

            $reserveid= Input::get('reserveid');
            $chat->markRead($reserveid,'reservations');
            // print_r($chat->markRead($reserveid,$reservetype));
                      $showchat=true;
                      $chatParams=$chat->getChatParams($reserveid,'reservations',$user);
                      
                      $chat->getChat($reserveid,'reservations');
                      // print_r($chatParams);                       
          }else
            $showchat=false;

           //if update button pressed	
           if(Input::get('update')=='update'){
           	// echo('<br>update button pressed<br>');
           	$reserveid=Input::get('groomid');
           	$isDepoPaid=Input::get('depoIsPaid');
           	// echo('<br>fee:'.$isDepoPaid.'<br>');
           	if($isDepoPaid==='paid')
             $reservation->updateStatus($user,true);
              if($reservation){
              	$reservCon=$user->getDataResId($reserveid)->results()[0];
              	// print_r($reservCon);
              	// echo '<br> email:'.$reservCon->email.'<br>';
              	if($reservCon)
              	Email::sendReservCon($reservCon->email,$reservCon->firstname,$reservCon->facilityname,$reserveid,$reservCon->reservationdate,$reservCon->startdate,$reservCon->starttime,$reservCon->fee*$reservCon->duration,$reservCon->deposit,$reservCon->status);
              }


           }
          

       	
		}



     $mangroomp=$user->getGRoom('All','pending',3)->results();
	   $mangroomc=$user->getGRoom('All','confirmed',3)->results();
	   $mangroomcp=$user->getGRoom('All','completed',3)->results();

      if(!$user->isAdmin()){
       if($user->isLoggedIn())
        $this->view('/logout',['error'=>'First,you need to logout<br>Then, Sign In with a manager account<br>to see the requested page']);
      else
     $this->view('/login',['error'=>'Sorry,but only Managers can see<br> the requested page<br>Please Sign In with<br>a manager account.']);
    }
     else
	    $this->view('/manreservelevator',['manGRoomp'=>$mangroomp,'manGRoomc'=>$mangroomc,'manGRoomcp'=>$mangroomcp,'highlightmrsrv'=>'active','showchat'=>$showchat,'adminid'=>$admin,'chatParams'=>$chatParams,'type'=>'reservations','unread'=>$unread]);




	}



}