<?php
class Notify{


private $_db;

    public function __construct()
    {
        $this->_db=DB::getInstance();
    }
      
    public function getEmails($nonR=null){
    	
    	// $emailJson='../app/data/emils.json';
        	$sql="SELECT\n";
	$sql.="CONCAT_WS(' ',firstname, lastname) as fullname,\n";
	$sql.="email,\n";
    $sql.="unitno,\n";
    $sql.="photo\n";
	$sql.="FROM\n";
	$sql.="user\n";
    if($nonR)
    $sql.="WHERE unitno IS NULL\n";
    else    
    $sql.="WHERE unitno <= 706\n";
    $sql.="AND email<>''\n";
    $sql.="ORDER BY\n";
    $sql.="unitno ASC\n";
	$edata=$this->_db->query($sql);
    	if(!$edata->error()){
    		return $edata->results();
    	}
    return false;
    }



    public function insertNotiWfile($file){
        

        $userid=Session::get(Config::get('session/user_id')); 
        
    	$notesubject=Input::get('subject');
        $notesendto=Input::get('sendTo');
        $notestartdate=Input::get('stdate');
        $notexdate=Input::get('exdate');
        $notetext=Input::get('context');
        $filepath=$file->getFilePath();
        
        $fields=['userid'=>$userid,'notesubject'=>$notesubject,'notesendto'=>$notesendto,'notestartdate'=>$notestartdate,'notexdate'=>$notexdate,'notetext'=>$notetext,'filepath'=>$filepath];
        $table='notifications';
        $insertNote=$this->_db->insert($table,$fields);
        if ($insertNote){
         // Session::put('message','Notification has been inserted/s');
            if($notesendto){
        	if($this->sendEmailsWFile($file))
        		return true;
            }
        }
        else
        	return false;

    }

    public function insertNotiWNofile(){
        

        $userid=Session::get(Config::get('session/user_id')); 
        
        $notesubject=Input::get('subject');
        $notesendto=Input::get('sendTo');
        $notestartdate=Input::get('stdate');
        $notexdate=Input::get('exdate');
        $notetext=Input::get('context');

        
        $fields=['userid'=>$userid,'notesubject'=>$notesubject,'notesendto'=>$notesendto,'notestartdate'=>$notestartdate,'notexdate'=>$notexdate,'notetext'=>$notetext];
        $table='notifications';
        $insertNote=$this->_db->insert($table,$fields);
        if ($insertNote){
         // Session::put('message','Notification has been inserted/s');
            if($notesendto){
            if($this->sendEmailsWNoFile())
                return true;
            }
        }
        else
            return false;

    }





    public function sendEmailsWFile($file){
        // echo '<br>sendEmails or not:'.Session::get('noEmail').'<br>';
       	if(Session::get('noEmail')==""){
            // echo '<br>sendEmails($file=null):<br>';
       $notesubject=Input::get('subject');
       $recipient=Input::get('sendTo');
       $notetext=Input::get('context');
       if(Email::sendNotiEmailWFile($recipient,$notesubject,$notetext,$file))
        return true;
        }
         else false;
        // // Session::put('message','Notification is saved and email  sent successfully/s');
        // }else{
        //  Session::put('message','Notification is saved but email hasn\'t been sent as you wish/i');   
        // }	
                          
    }

    public function sendEmailsWNoFile(){
        // echo '<br>sendEmails or not:'.Session::get('noEmail').'<br>';
        if(Session::get('noEmail')==""){
       $notesubject=Input::get('subject');
       $recipient=Input::get('sendTo');
       $notetext=Input::get('context');
       if(Email::sendNotiEmailWNoFile($recipient,$notesubject,$notetext))
        return true;
        }
         else false;
        // // Session::put('message','Notification is saved and email  sent successfully/s');
        // }else{
        //  Session::put('message','Notification is saved but email hasn\'t been sent as you wish/i');   
        // }    
                          
    }


    public function parseEmails($recipients){

        if($recipients)
    	return $recipients=explode(';', rtrim($recipients));

        return false;

                          
    }
     public function getNotifications($status){

        $sql="SELECT\n";
        $sql.="notifications.notifid,\n";
        $sql.="notifications.notesubject,\n";
        $sql.=Convertor::timezone('notifications.notedatetime' ,'notedatetime').",\n";
        $sql.="notifications.notestartdate,\n";
        $sql.="notifications.notexdate,\n";
        $sql.="notifications.notetext,\n";
        $sql.="notifications.filepath,\n";
        $sql.="SUBSTRING_INDEX(filepath,'/',-1) as filename,\n";
        $sql.="DATEDIFF(notestartdate,CURDATE()) as remain,\n";
        $sql.="DATEDIFF(notexdate,CURDATE()) as effective,\n";
        $sql.="IF(notexdate >= CURDATE() AND notestartdate <= CURDATE() ,'success' ,IF(notexdate < CURDATE() ,'secondary' ,IF(notestartdate > CURDATE() ,'warning' ,''))) as background\n";
        $sql.="FROM\n";
        $sql.="notifications\n";
        if($status=='active'){
        $sql.="WHERE notexdate >= CURDATE()\n";
        $sql.="AND notestartdate <= CURDATE();\n";}
        else if($status=='coming'){
        $sql.="WHERE notestartdate > CURDATE();\n";   
        }else{
        $sql.=";\n";
        }
        // echo($sql);
        $bdata=$this->_db->query($sql);
        if(!$bdata->error()){
            return $bdata->results();
        }
            
    return false;

    }

    public function deleteNotification($notifid)
    {

           if(DB::getInstance()->delete('notifications',array('notifid','=',$notifid)))
            return true;
            else false;
    }

     public function getNotification($notifid)
    {

         $sql="SELECT\n";
        $sql.="notifications.notesubject,\n";
        $sql.="notifications.notesendto,\n";
        $sql.="notifications.notestartdate,\n";
        $sql.="notifications.notexdate,\n";
        $sql.="notifications.notetext,\n";
        $sql.="notifications.notifid\n";
        $sql.="FROM\n";
        $sql.="notifications\n";
        $sql.="where notifid=".$notifid.";\n";
         $edtdata=$this->_db->query($sql);
         if(!$edtdata->error()){
            return $edtdata->results();
           
            }
    }       
     public function updateNotiWfile($notifid,$file)
     {
        $filepath=$file->getFilePath();
        $fields=['notesubject'=>Input::get('subject'),'notesendto'=>Input::get('sendTo'),'notestartdate'=>Input::get('stdate'),'notexdate'=>Input::get('exdate'),'notetext'=>Input::get('context'),'filepath'=>$filepath];

        
       // echo('<br>updateNotification filepath:'.$filepath.'<br>');

          $update=$this->_db->update('notifications',$notifid,$fields,'notifid');
        
        if ($update){
            // echo '<br>update is okay<br>';
         // Session::put('message','Notification has been inserted/s');
          // echo '<br>email receiver:'.Input::get('sendTo').'<br>';
            if(Input::get('sendTo')){
            if($this->sendEmailsWFile($file))
                return true;
            }
        }
        else
            return false;
        


     }
    public function updateNotiWNofile($notifid)
     {
        
        $fields=['notesubject'=>Input::get('subject'),'notesendto'=>Input::get('sendTo'),'notestartdate'=>Input::get('stdate'),'notexdate'=>Input::get('exdate'),'notetext'=>Input::get('context')];

        
       // echo('<br>updateNotification filepath:'.$filepath.'<br>');

          $update=$this->_db->update('notifications',$notifid,$fields,'notifid');
        
        if ($update){
            // echo '<br>update is okay<br>';
         // Session::put('message','Notification has been inserted/s');
          // echo '<br>email receiver:'.Input::get('sendTo').'<br>';
            if(Input::get('sendTo')){
            if($this->sendEmailsWNoFile())
                return true;
            }
        }
        else
            return false;
        


     }
}