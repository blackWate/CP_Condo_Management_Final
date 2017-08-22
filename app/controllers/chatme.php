<?php
class Chatme extends Controller{

	
  public function noMethod()
{
   $db=DB::getInstance();
  
   if(Input::get('message'))
   {
     $sentunitno=intval(Input::get('senderunitno'));
     $receiveunitno=intval(Input::get('receiverunitno'));
     $reserveid=intval(Input::get('reserveid'));
     $message=Input::get('message');
     $reservetype=Input::get('reservetype');
     $chat=$this->model('Chat');
     $chatid=$chat->checkChat($reserveid,$reservetype);
     if(count($chatid)==0){ 	
     $db->insert('chat',['reserveid'=>$reserveid,'reservetype'=>$reservetype]);
      $chatid=$chat->checkChat($reserveid,$reservetype)[0]->chatid;
      }else{
      	$chatid=$chat->checkChat($reserveid,$reservetype)[0]->chatid;
      }
      $fields=[
      'chatid'=>$chatid,
      'sentunitno'=>$sentunitno,
      'receiveunitno'=>$receiveunitno,
      'message'=>$message];
      $insert=$db->insert('messages',$fields);
      // if($insert)
      //   echo "message inserted successfully ".$receiveuserid;
      // else
      //   echo "message is not inserted ".$receiveuserid;
   }
	

   	
}
}