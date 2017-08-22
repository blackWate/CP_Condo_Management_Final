<?php
class Service extends Controller{

	
  public function noMethod()
{
  
  $user=$this->model('User');
		
    if(!$user->isLoggedIn()){
    	$this->view('/login',['error'=>'Please Login for Service Page :)']);
    exit();}
		$service=$this->model('Services');
		
		if(Input::exists()){
			 if(Token::check(Input::get('token'))){
			$userid=Session::get(Config::get('session/user_id'));
			$fields=['userid'=>$userid,'subject'=>Input::get('subject'),'servicetype'=>Input::get('servicetype'),'description'=>Input::get('context')];
			$insertService=$user->insert('services',$fields);
		}
		if(Input::get('delete')=='delete'){
           	// echo('<br>delete button pressed<br>');
           	$serviceid=Input::get('serviceid');
           	$service->deleteRecord($serviceid);
           }
      if(Input::get('chat')=='chat'){
                        $chat=$this->model('Chat');

            $reserveid= Input::get('reserveid');
            
                      $showchat=true;
                      $chatParams=$chat->getChatParams($reserveid,'services',$user);
                      
                      // print_r($chat->getChat($reserveid,'reservations'));
                      // print_r($chatParams);                       
          }else
            $showchat=false;
            
	
     }
     $unitno=Session::get(Config::get('session/session_name'));
     $servicesA=$service->getServices($unitno,'Awaiting');
     $servicesO=$service->getServices($unitno,'Ongoing');
     $servicesC=$service->getServices($unitno,'Resolved');
   	 $this->view('/service',['servicesA'=>$servicesA,'servicesO'=>$servicesO,'servicesC'=>$servicesC,'showchat'=>$showchat,'chatParams'=>$chatParams,'type'=>'services']);
  
   	 
}

}