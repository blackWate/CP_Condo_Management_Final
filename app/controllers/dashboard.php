<?php
class Dashboard extends Controller{

	
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
           $this->view('/dashboard');

    }
}
}