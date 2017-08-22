<?php
class Reserve{

    private $_db;

    public function __construct()
    {
        $this->_db=DB::getInstance();
    }


	public function deleteRecord($reserveid=null)
	{	if($reserveid)
		$delete=$this->_db->delete('reservations',array('reservationid','=',$reserveid));

		if(Input::get('refg')){
			  			$delete=$this->_db->delete('reservations',array('reservationid','=',Input::get('refg')));
			  			   Input::delete('refg');
			  			 return 'g';
					}
					
		if(Input::get('refp')){
			  			$delete=$this->_db->delete('reservations',array('reservationid','=',Input::get('refp')));
			  			return 'p';

					}
		if(Input::get('refe')){
			  			$delete=$this->_db->delete('reservations',array('reservationid','=',Input::get('refe')));
			  			return 'e';
			  	
					}	
	}


	public function insertRecord($user,$userid)
	{
		if(Token::check(Input::get('token1'),1)){								
							if(Input::get('gRoom')){
									$facilityid=1;
									$startdate=Input::get('startDate');
									$duration=Input::get('duration');
									$insert=$user->insert('reservations',['userid'=>$userid,'facilityid'=>$facilityid,'startdate'=>$startdate,'duration'=>$duration]);
									
									return 'g';
								}
							}

							if(Token::check(Input::get('token2'),2)){
								if(Input::get('pRoom')){

									$facilityid=2;
									$startdate=Input::get('reservationDate');
									$starttime=Input::get('startTime');
									$endtime=Input::get('endTime');
									$numberofpeople=Input::get('numberOfPeople');
									$insert=$user->insert('reservations',['userid'=>$userid,'facilityid'=>$facilityid,'startdate'=>$startdate,'starttime'=>$starttime,'endtime'=>$endtime,'numberofpeople'=>$numberofpeople]);
									
									return 'p';
				  					// $activeg='';
								}
							}

							if(Token::check(Input::get('token3'),3)){		
								if(Input::get('el')){
									$facilityid=3;
									$startdate=Input::get('reservationDate');
									$starttime=Input::get('usingPeriod');
									$insert=$user->insert('reservations',['userid'=>$userid,'facilityid'=>$facilityid,'startdate'=>$startdate,'starttime'=>$starttime]);
				  				   
				  				   return 'e';
				  				   // $activeg='';
								}
							}		



	}
	public function updateStatus($user,$elevator=false){
		$adminid=Session::get('userid');
		$reservationid=Input::get('groomid');
		if($elevator)
			$insert=$user->insert('manreservations',['adminid'=>$adminid,'reservationid'=>$reservationid,'depositpaid'=>'paid']);
		else
		$insert=$user->insert('manreservations',['adminid'=>$adminid,'reservationid'=>$reservationid,'feepaid'=>'paid','depositpaid'=>'paid']);
		// $dbase=DB::getInstance();
		$updateStatus=$this->_db->update('reservations',$reservationid,['status'=>'confirmed'],'reservationid');
		if($updateStatus)
			return true;
		else return false;

	}
    
    public function getAllReserveId(){

    	$sql="select\n"; 
	$sql.="`reservations`.`reservationid` AS `reservationid`,\n";
	$sql.="'reservations' AS `tablename`\n"; 
	$sql.="from `reservations`\n"; 
	$sql.="union\n";
	$sql.="select `services`.`serviceid` AS `serviceid`,\n";
	$sql.="'services' AS `tablename`\n"; 
	$sql.="from `services`\n"; 
	$sql.="union\n"; 
	$sql.="select `notifications`.`notifid` AS `notifid`,\n";
	$sql.="'notifications' AS `tablename`\n"; 
	$sql.="from `notifications`\n";
	$allResId=$this->_db->query($sql);
    	if(!$allResId->error())
    		return $allResId->results();
    	else return false;
    		
    
    }
	
	
    


}