<?php

class Manservices extends Controller{

  public function noMethod()
{  
	$user=$this->model('User');
     if(!$user->isAdmin()){
       if($user->isLoggedIn())
        $this->view('/logout',['error'=>'First,you need to logout<br>Then, Sign In with a manager account<br>to see the requested page']);
      else
     $this->view('/login',['error'=>'Sorry,but only Managers can see<br> the requested page<br>Please Sign In with<br>a manager account.']);
    }
    else{
     
      $service=$this->model('Services');
      if(Input::exists()){
         if(Input::get('delete')=='delete'){
            $serviceid=Input::get('serviceid');
            $service->deleteRecord($serviceid);
            $this->services();
       }
            if(Input::get('ok')=='ok'){
            $serviceid=Input::get('serviceid');
            $service->serviceDone($serviceid);
            $this->services();
       }

           if(Input::get('chat')=='chat'){
                        $chat=$this->model('Chat');
 
            $reserveid= Input::get('reserveid');
            
                      $showchat=true;
                      $chatParams=$chat->getChatParams($reserveid,'services',$user);
                   
                      // print_r($chat->getChat($reserveid,'reservations'));
                      // print_r($chatParams);
                      $service=$this->model('Services');
                       $servicesA=$service->getServices('all','Awaiting');
                       $servicesO=$service->getServices('all','Ongoing');
                       $servicesC=$service->getServices('all','Resolved');
                       $this->view('/manservices',['highlightsrv'=>'active','servicesA'=>$servicesA,'servicesO'=>$servicesO,'servicesC'=>$servicesC,'activetext'=>'','activelist'=>'active','showchat'=>$showchat,'chatParams'=>$chatParams,'type'=>'services']);                       
          }else
            $showchat=false;

        

           if(Input::get('reply')=='reply'){
             $serviceid=Input::get('serviceid');
             $serviceR=$service->getServices('all','Awaiting',$serviceid);

            // echo('<br>reply button pressed<br>');
            $this->view('/manservices',['activetext'=>'active','activelist'=>'','serviceinfo'=>$serviceR]);
           }

           if(Input::get('update')=='update'){
             $serviceid=Input::get('serv');
             $replytext=Input::get('context');
             $serviceUpdate=$service->updateService($serviceid,$replytext,'Ongoing');
              $this->services();
           }
      }
      // if($reply){
        $this->services();
      // }
    }

	}
  private function services(){
       // echo 'function services'.$showchat.'-';
      $service=$this->model('Services');
     $servicesA=$service->getServices('all','Awaiting');
     $servicesO=$service->getServices('all','Ongoing');
     $servicesC=$service->getServices('all','Resolved');

     $this->view('/manservices',['highlightsrv'=>'active','servicesA'=>$servicesA,'servicesO'=>$servicesO,'servicesC'=>$servicesC,'activetext'=>'','activelist'=>'active']);

  }
	
}