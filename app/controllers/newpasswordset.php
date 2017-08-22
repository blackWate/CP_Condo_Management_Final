<?php
class Newpasswordset extends Controller{

  
          public function noMethod()
        {

              $user=$this->model('User');
              if(!$user->isLoggedIn()){
              $tokenunit=$user->token(Input::get('token'),Input::get('ne'));
              $token=$tokenunit[0];
              $unitno=$tokenunit[1];

             if(Input::exists()){
                         
                  $newpassword=password_hash(Input::get('nPass'),PASSWORD_BCRYPT,array('cost'=>10));
                  $tokenupdate=$user->update($unitno,['token'=>md5(uniqid())]);
                  $passwordupdate=$user->update($unitno,['password'=>$newpassword]);
                  if($tokenupdate&&$passwordupdate){
                  $this->view('/login',['error'=>'Your password has been reset successfully.']);
                  }
                  else
                  {
                  $this->view('/resetpas',['error'=>'Something went wrong. Please try again.']);
                  }  
              }
              else if($token===Input::get('token')){
                    $this->view('/newpasswordset');  
                   }
                  else
                      $this->view('/resetpas',['error'=>'Link expired<br>Please request a new link']);
              
                  
                                      
          }
           else{
                 $this->view('/home');

           }
            
        }
}


