<?php

class Manreservproom extends Controller{


	  public function noMethod()
	{
$user=$this->model('User');
		
    

    if(Input::exists()){
      $reservation=$this->model('Reserve');
       //if delete button pressed 
           if(Input::get('delete')=='delete'){
            // echo('<br>delete button pressed<br>');
            $reserveid=Input::get('groomid');
            $reservation->deleteRecord($reserveid);
           }
           
           if(Input::get('chat')=='chat'){
                        $chat=$this->model('Chat');

            $reserveid= Input::get('reserveid');
            
                      $showchat=true;
                      $chatParams=$chat->getChatParams($reserveid,'reservations',$user);
                      
                      // print_r($chat->getChat($reserveid,'reservations'));
                      // print_r($chatParams);                       
          }else
            $showchat=false;

           //if update button pressed 
           if(Input::get('update')=='update'){
            // echo('<br>update button pressed<br>');
            $reserveid=Input::get('groomid');
            // echo('<br>fee:'.$isFeePaid.'<br>');
            $isDepoPaid=Input::get('depoIsPaid');
            $isFeePaid=Input::get('feeIsPaid');
            // echo('<br>fee:'.$isDepoPaid.'<br>');
              if($isFeePaid==='paid'&&$isDepoPaid==='paid')
             $reservation->updateStatus($user);
              if($reservation){
                $reservCon=$user->getDataResId($reserveid)->results()[0];
                // print_r($reservCon);
                // echo '<br> email:'.$reservCon->email.'<br>';
                if($reservCon)
                Email::sendReservCon($reservCon->email,$reservCon->firstname,$reservCon->facilityname,$reserveid,$reservCon->reservationdate,$reservCon->startdate,$reservCon->starttime.'-'.$reservCon->endtime,$reservCon->fee,$reservCon->deposit,$reservCon->status);
              }


           }
          

        
    }



     $mangroomp=$user->getGRoom('All','pending',2)->results();
     $mangroomc=$user->getGRoom('All','confirmed',2)->results();
     $mangroomcp=$user->getGRoom('All','completed',2)->results();
      if(!$user->isAdmin()){
       if($user->isLoggedIn())
        $this->view('/logout',['error'=>'First,you need to logout<br>Then, Sign In with a manager account<br>to see the requested page']);
      else
     $this->view('/login',['error'=>'Sorry,but only Managers can see<br> the requested page<br>Please Sign In with<br>a manager account.']);
    }
    else
      $this->view('/manreservproom',['manGRoomp'=>$mangroomp,'manGRoomc'=>$mangroomc,'manGRoomcp'=>$mangroomcp,'highlightmrsrv'=>'active']);



	}



}