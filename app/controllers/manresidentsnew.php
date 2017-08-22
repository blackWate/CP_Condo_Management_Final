<?php

class Manresidentsnew extends Controller{
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
    $hideB='updateH';
    $notify=$this->model('Notify');
    $photos=$notify->getEmails();
    // print_r($photos);
    $resident=$this->model('Residents');
    $data=array();
    $resList=$resident->getResidentList();
    // print_r($resList);
     if(Input::exists()){
      	if(Input::get('edit')=='edit'){
      		$hideB='submitH';
         $data=$resident->getResidents('',Input::get('userid'));
        $this->view('/manresidentsnew',[$hideB=>'hide','resident'=>$data,'resList'=>$resList,'photos'=>$photos]);
      	 }
     
 
     	if(Input::get('button')=='submit'){

        $fields=[];

     	}
       if(Input::get('button')=='update'){

       $update=$resident->updateResident();
       $residents=$resident->getResidents();
      
       $groups=$resident->getResGoups($residents);

      
       $this->view('/manresidents',['highlightmr'=>'active','renters'=>$groups[0],'owners'=>$groups[1],'ownerNRs'=>$groups[2]]);
       }
  
     
 	}else{

   $this->view('/manresidentsnew',[$hideB=>'hide','resident'=>$data,'resList'=>$resList,'photos'=>$photos]);
    }

  }
  
  
}
 
}
