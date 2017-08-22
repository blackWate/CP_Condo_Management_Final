<?php

class Notification extends Controller{


  public function noMethod()
{
    
    $user=$this->model('User');
    $notify=$this->model('Notify');
     // echo("<br>user logged in".$user->isLoggedIn()."<br>");
     // echo("<br>user is admin".$user->isAdmin()."<br>");
    if($user->isLoggedIn()&&$user->isAdmin()){


      

        Session::put('message','');

        $emails=$notify->getEmails();
        $emailsNR=$notify->getEmails('nonR');
        // Session::put('message',"Emails are added to the emailbox/i");    
        $allresidents=array_column($emails, 'email');
        $emailsNR=array_column($emailsNR, 'email');
        // $allresidents=sort($allresidents);
         $allresidents=implode(',',$allresidents); 
         $emailsNR=implode(',',$emailsNR); 
          $hideB='updateH';
          $data=array();
          
        if(Input::exists()){
                  // echo '<br>input exists <br>';
           
                  if(Input::get('edit')=='edit'){
                    $hideB='submitH';
                   // echo '<br>edit button clicked<br>';
                   $data=$notify->getNotification(Input::get('notifid'));
                  if($data){
                  Session::put('message','Notification has been copied for an update/i');
                    }
                  }else if(Input::get('copy')=='copy'){
                    $hideB='updateH';
                   // echo '<br>copy button clicked<br>';
                   $data=$notify->getNotification(Input::get('notifid'));
                   // print_r($data);
                  if($data){
                  Session::put('message','Notification has been copied for a new notification/s');
                    }
                  }
              

              if(Token::check(Input::get('token'))){
                 // echo '<br>Token exists <br>';

                    Session::put('noEmail',Input::get('noEmail'));
                  //new notification  
                if(Input::get('button')=='submit'){
                //upload file
                if(Input::get('fileToUpload')["size"]>0){
                $file=new UpLoadFile(Input::get('fileToUpload'));
                // echo('<br>Filename:'.$file->getFileName());
                        if(is_array($file->getResult())){
                           // echo '<br>'.$file->getResult().'<br>';
                           // echo '<br>'.$file->errorString().'<br>';
                           Session::put('message',$file->errorString());
                        }else{
                         $insert=$notify->insertNotiWfile($file);
                          Session::put('message',$file->getResult().'/s');
                          // echo '<br>'.$file->getResult().'<br>';
                         }
                       }
                   else{
                        if($notify->insertNotiWNofile())
                        Session::put('message','No file attachment/i');
                        }
               }
               //update notification
              if(Input::get('button')=='update'){ 
                 // echo '<br>update button clicked<br>';
                  if(Input::get('fileToUpload')["size"]>0){
                $file=new UpLoadFile(Input::get('fileToUpload'));
                // echo('<br>Filename:'.$file->getFileName());
                        if(is_array($file->getResult())){
                           // echo '<br>'.$file->getResult().'<br>';
                           // echo '<br>'.$file->errorString().'<br>';
                           Session::put('message',$file->errorString());
                        }else{
                         $insert=$notify->updateNotiWfile(Input::get('notifid'),$file);
                          Session::put('message',$file->getResult().'/s');
                          // echo '<br>'.$file->getResult().'<br>';
                         }
                       }
                   else{
                        if($notify->updateNotiWNofile(Input::get('notifid')))
                        Session::put('message','No file attachment/i');
                        }
               }
             

            }//if token exits
             
            // $this->view('/notification',['emails'=>$emails,$hideB=>'hide','edtdata'=>$copy,'filesize'=>Config::get('uploadfile/max_filesize')]);

         }//if input exists





    $this->view('/notification',['emails'=>$emails,'edtdata'=>$data[0] ,$hideB=>'hide','filesize'=>Config::get('uploadfile/max_filesize'),'resemails'=>$allresidents,'emailsNR'=>$emailsNR]);
    }else{

        $this->view('/login',['error'=>'Sorry,but only Managers can see<br> the requested page<br>Please Sign In with<br>a manager account.']);
     }

}
}