<?php
class Chat{


private $_db;

    public function __construct()
    {
        $this->_db=DB::getInstance();
    }

    public function getChatParams($reserveid,$reservationidtype,$user){

         	$sql="select\n"; 
		$sql.="`reservations`.`reservationid` AS `reservationid`,\n";
		$sql.="`user`.unitno,\n";
		$sql.="`user`.photo,\n";
		$sql.="CONCAT_WS(' ',`user`.firstname,`user`.lastname) as fullname,\n";
		$sql.="'reservations' AS `tablename`\n"; 
		$sql.="from `reservations`\n"; 
		$sql.="JOIN `user`\n";
		$sql.="ON `user`.userid = `reservations`.userid\n";
		$sql.="HAVING tablename='".$reservationidtype."' AND reservationid=".$reserveid."\n";
		$sql.="union\n";
		$sql.="select `services`.`serviceid` AS `serviceid`,\n";
		$sql.="`user`.unitno,\n";
		$sql.="`user`.photo,\n";
		$sql.="CONCAT_WS(' ',`user`.firstname,`user`.lastname) as fullname,\n";
		$sql.="'services' AS `tablename`\n"; 
		$sql.="from `services`\n";
		$sql.="JOIN `user`\n";
		$sql.="ON `user`.userid = `services`.userid\n";
		$sql.="HAVING tablename='services' AND serviceid=".$reserveid."\n";
		// $sql.="union\n"; 
		// $sql.="select `notifications`.`notifid` AS `notifid`,\n";
		// $sql.="`user`.unitno,\n";
		// $sql.="`user`.photo,\n";
		// $sql.="CONCAT_WS(' ',`user`.firstname,`user`.lastname) as fullname,\n";
		// $sql.="'notifications' AS `tablename`\n"; 
		// $sql.="from `notifications`\n";
		// $sql.="JOIN `user`\n";
		// $sql.="ON `user`.userid = `notifications`.userid\n";
		// $sql.="HAVING tablename='".$reservationidtype."' AND notifid=".$reserveid."\n";

		$chatdata=$this->_db->query($sql);
    	if(!$chatdata->error()){
    		$chatdata=$chatdata->results();
    		$sender=Session::get(Config::get('session/session_name'));
            if(!$user->isAdmin()){//sender is resident
            	//admin receiver details
            $receiver=Config::get('admin/admin_default');
             $sql="SELECT `user`.photo , CONCAT_WS(' ',firstname,lastname) as fullname FROM `user` where unitno=".$receiver."";
             $receiverfname=($this->_db->query($sql))->results()[0]->fullname;
             $receiverpic=($this->_db->query($sql))->results()[0]->photo;
             //resident details
              $senderpic=$chatdata[0]->photo;
              $senderfname=$chatdata[0]->fullname;
        	}
        	else{//sender is admin
        		//resident receiver details
        		$receiver=$chatdata[0]->unitno;
        		 $sql="SELECT `user`.photo , CONCAT_WS(' ',firstname,lastname) as fullname FROM `user` where unitno=".$receiver."";
        		 $receiverpic=($this->_db->query($sql))->results()[0]->photo;
        		 $receiverfname=($this->_db->query($sql))->results()[0]->fullname;
        		  $sql="SELECT `user`.photo , CONCAT_WS(' ',firstname,lastname) as fullname FROM `user` where unitno=".$sender."";
        		 $senderpic=($this->_db->query($sql))->results()[0]->photo;
                 $senderfname=($this->_db->query($sql))->results()[0]->fullname;

        	}
        	$chatdata[0]->sender=$sender;
        	$chatdata[0]->senderpic=$senderpic;
        	$chatdata[0]->senderfname=$senderfname;
        	$chatdata[0]->receiver=$receiver;
        	$chatdata[0]->receiverpic=$receiverpic;
        	$chatdata[0]->receiverfname=$receiverfname;
    		return $chatdata;
    	}
    return false;

    }
     
    public function checkChat($reserveid,$reservetype){

    		$sql="select\n"; 
		$sql.="`chat`.chatid\n";
		$sql.="from `chat`\n"; 
		$sql.="WHERE `chat`.reserveid=".$reserveid."\n";
		$sql.="AND `chat`.reservetype='".$reservetype."'\n";
		$resid=$this->_db->query($sql);
    	if(!$resid->error()){
    		return $resid->results();
    	}
    		
    return false;	

    }
    public function getChat($reserveid,$reservetype){

		    	$sql="SELECT\n";
		$sql.="messages.message,\n";
		$sql.="chat.reserveid,\n";
		$sql.="chat.reservetype,\n";
		$sql.="CONCAT_WS(' ',sender.firstname,sender.lastname) AS senderfname,\n";
		$sql.="sender.photo AS senderphoto,\n";
		$sql.="receiver.photo AS receiverphoto,\n";
		$sql.="CONCAT_WS(' ',receiver.firstname,receiver.lastname) AS receiverfname,\n";
		// $sql.="DATE(messages.`timestamp`) AS date,\n";
		$sql.="DATE_FORMAT(DATE(messages.timestamp),'".Config::get('timezone/timezone_date_format')."') as date,\n";
		$sql.="TIME_FORMAT(TIME(messages.timestamp),'".Config::get('timezone/timezone_time_format')."' ) AS time,\n";
		$sql.="receiver.unitno as receiverunitno,\n";
		$sql.="sender.unitno AS senderunitno\n";
		$sql.="FROM\n";
		$sql.="chat\n";
		$sql.="JOIN messages\n";
		$sql.="ON chat.chatid = messages.chatid\n"; 
		$sql.="JOIN `user` AS sender\n";
		$sql.="ON messages.sentunitno = sender.unitno\n"; 
		$sql.="JOIN `user` AS receiver\n";
		$sql.="ON messages.receiveunitno = receiver.unitno\n";
		$sql.="WHERE\n"; 
		$sql.="chat.reservetype='".$reservetype."'\n"; 
		$sql.="AND\n"; 
		$sql.="chat.reserveid=".$reserveid."\n"; 
		$sql.="ORDER BY\n"; 
		$sql.="messages.`timestamp` ASC\n"; 
		$chats=$this->_db->query($sql);
    	if(!$chats->error()){
    		// echo $chats->results();
    		return $chats->results();
    	}
    }
    	public function markReadReserv($reserveid){
    	$sql="UPDATE\n";
		$sql.="messages\n"; 
		$sql.="JOIN chat\n";
		$sql.="ON messages.chatid = chat.chatid\n"; 
		$sql.="JOIN reservations\n";
		$sql.="ON chat.reserveid = reservations.reservationid\n";
		$sql.="SET\n"; 
		$sql.="messages.isread='y'\n";
		$sql.="WHERE messages.isread='n' AND reserveid=".$reserveid." AND messages.sentunitno<>".Session::get(Config::get('session/session_name'))."";
		echo $sql;
			// return $this->_db->query($upsql);
			

       }
       public function getUnreadReserv($reserveid){
		    	$sql="SELECT\n";
		$sql.="count(messages.isread) as unread,\n";
		$sql.="reservations.reservationid,\n";
		$sql.="messages.sentunitno\n";
		$sql.="FROM\n";
		$sql.="chat\n";
		$sql.="JOIN reservations\n";
		$sql.="ON chat.reserveid = reservations.reservationid\n"; 
		$sql.="JOIN messages\n";
		$sql.="ON messages.chatid = chat.chatid\n"; 
		$sql.="JOIN `user`\n";
		$sql.="ON reservations.userid = `user`.userid\n";
		$sql.="where isread='n' and reserveid=".$reserveid." and messages.sentunitno<>".Session::get(Config::get('session/session_name'))."\n";
		$unread=$this->_db->query($sql);
    	if(!$unread->error()){
    		return $unread->results();
    	}
    		
    return false;

       }
     


}    