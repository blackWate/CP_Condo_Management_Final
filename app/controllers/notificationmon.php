<?php

class Notificationmon extends Controller{

    
  public function noMethod()
{
    Session::put('message','');
	$user=$this->model('User');
     if(!$user->isAdmin()){
       if($user->isLoggedIn())
        $this->view('/logout',['error'=>'First,you need to logout<br>Then, Sign In with a manager account<br>to see the requested page']);
      else
     $this->view('/login',['error'=>'Sorry,but only Managers can see<br> the requested page<br>Please Sign In with<br>a manager account.']);
    }
   

    if($user->isLoggedIn()){
    	$notify=$this->model('Notify');
        

         if(Input::exists()){
            // echo "<br>post exists<br>";
            // echo '<br>token :'.Input::get('token3').'<br>';
            // echo '<br>session token :'.Session::get('token3').'<br>';
            // if(Token::check(Input::get('token3'),3)){
                // echo '<br>token exists:'.Token::check(Input::get('token3'),3).'<br>';
                if(Input::get('delete')=='delete'){
                 // echo "<br>delete pressed<br>";
                  // echo "<br>".Input::get('notifid')."<br>";
    	        // if(Input::get('notifid'))
    	        if($notify->deleteNotification(Input::get('notifid')))
            Session::put('message','Notification has been deleted successfully/s');
             }
        // }
         }
         $actNotes=$notify->getNotifications('active');
        $comNotes=$notify->getNotifications('coming');
        $allNotes=$notify->getNotifications('all');
        // print_r($allNotes);
        if ($$actNote&&$comNotes&&$allNotes)
            Session::put('message','All notifications are fetched/i');
    	
       
    	$this->view('/notificationmon',['highlightnm'=>'active','comNote'=>$comNotes,'activeNote'=>$actNotes,'allNote'=>$allNotes]);

           

    	 
	
       // $this->view('/notificationmon',['comNote'=>$comNotes,'activeNote'=>$actNotes,'allNote'=>$allNotes]);
}

}
}