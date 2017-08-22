<?php
class Forgotpass extends Controller{

	
  public function noMethod()
{
    $user=$this->model('User');
    $emailToken=$user->email(Input::get('email'));
    $email=$emailToken[0];
    $token=$emailToken[1];
    $firstname=$emailToken[2];
    $unitno=$emailToken[3];
    if($email)
    {
    	if(Email::sendEmail($email,$token,$firstname,$unitno))
    	{
     //        SMS::sendSMS('4164143806','pcs.rogers.com',$firstname,$unitno);
    	$this->view('/prsuccess');
        }
        else{
            $error='';
            $this->view('/resetpas',['error'=>'Sorry, Something went wrong, please try again']);
        }
    }
    else{
    	 $error='';
    	 $this->view('/resetpas',['error'=>'Email is not exist']);
	}
}
}