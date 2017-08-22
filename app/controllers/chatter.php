<?php
class Chatter extends Controller{

	
  public function noMethod()
{
   
  
   if(Input::get('reserveid'))
   {
     $reserveid=intval(Input::get('reserveid'));
     $reservetype=Input::get('reservetype');
     $chat=$this->model('Chat');
     
     $messages=$chat->getChat($reserveid,$reservetype);
     if(count($messages)>0)
     	echo json_encode($messages);


   }
    
   
}

}