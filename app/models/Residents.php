<?php
class Residents{
        
     private $_db;

    public function __construct()
    {
        $this->_db=DB::getInstance();
    }

	public function getResidentList(){
			$sql="SELECT\n";
			$sql.="CONCAT_WS(' ',`user`.firstname,`user`.lastname) AS fullname,\n";
			$sql.="`user`.userid\n";
			$sql.="FROM\n";
			$sql.="`user`\n";
			$sql.="where firstname  is not null\n"; 
			$sql.="and lastname is not null\n";
			$sql.="ORDER BY fullname ASC\n";
			$listdata=$this->_db->query($sql);
	    	if(!$listdata->error())
	    		return $listdata->results();
			else return false;
	}

	public function clearResident(){

		$unitno= Input::get('unitno');
        $fields=['photo'=>'empty.jpeg','firstname'=>'','lastname'=>'','email'=>'','emergencycontact'=>'','mobilephone'=>'','homephone'=>'','workphone'=>'','emergencyphone'=>'','emergencyrelation'=>''];
        $clear=$this->_db->update('user',$unitno,$fields,$where='unitno');
        if ($clear) 
				return true;
			 else 
				return false;
	}

	public function updateResident(){
	       
		    $unitno= Input::get('unitno');
	        $pic=Input::get('pic');
	        $fname=Input::get('fname');
	        $unitowner=Input::get('owner');
	        $lname=Input::get('lname');
	        $email=Input::get('email');
	        $mobile=Input::get('mobile');
	        $home=Input::get('home');
	        $work=Input::get('work');
	        $ephone=Input::get('ephone');
	        $econtact=Input::get('econtact');
	        $erelation=Input::get('erelation');
	        if($pic)
	        $fields=['photo'=>$pic,'firstname'=>$fname,'lastname'=>$lname,'email'=>$email,'emergencycontact'=>$econtact,'mobilephone'=>$mobile,'homephone'=>$home,'workphone'=>$work,'emergencyphone'=>$ephone,'emergencyrelation'=>$erelation,'owneruserid'=>$unitowner];
	         else
	         $fields=['firstname'=>$fname,'lastname'=>$lname,'email'=>$email,'emergencycontact'=>$econtact,'mobilephone'=>$mobile,'homephone'=>$home,'workphone'=>$work,'emergencyphone'=>$ephone,'emergencyrelation'=>$erelation,'owneruserid'=>$unitowner];

			$update=$this->_db->update('user',$unitno,$fields,$where='unitno');
			if ($update) 
				return true;
			 else 
				return false;
	}
	public function getResidents($search=null,$userid=null){
			$sql="SELECT\n";
		$sql.="`user`.owneruserid,\n";
		$sql.="if(`user`.userid=ownername.userid,if( ISNULL(`user`.unitno) AND if(`user`.userid=ownername.userid,'owner','renter')='owner','ownerNR','owner'),'renter') as ownrent,\n";
		$sql.="CONCAT_WS(' ',ownername.firstname,ownername.lastname)  as ownername,\n";
		$sql.="`user`.firstname,\n";
		$sql.="`user`.lastname,\n";
		$sql.="`user`.unitno,\n";
		$sql.="`user`.photo,\n";
		$sql.="`user`.userid,\n";
		$sql.="`user`.email,\n";
		$sql.="`user`.mobilephone,\n";
		$sql.="`user`.homephone,\n";
		$sql.="`user`.workphone,\n";
		$sql.="`user`.emergencyphone,\n";
		$sql.="`user`.emergencycontact,\n";
		$sql.="`user`.emergencyrelation,\n";
		$sql.="`user`.userstatus,\n";
		$sql.="ownerunits.ownerunits\n";
		$sql.="FROM\n";
		$sql.="`user`\n";
		$sql.="JOIN `user` AS ownername\n";
		$sql.="ON `user`.owneruserid = ownername.userid\n";
		$sql.="JOIN \n";
		$sql.="(select `user`.`owneruserid` AS `owneruserid`,group_concat(`user`.`unitno` separator ',') AS `ownerunits` from `user` group by `user`.`owneruserid`) as ownerunits\n";
		$sql.="ON ownername.owneruserid = ownerunits.owneruserid\n";
		if($search){
		$sql.="where  CONCAT_WS(' ',`user`.`userid`,`user`.`unitno`,`user`.`mobilephone`,`user`.`homephone`,`user`.`workphone`,`user`.`owneruserid`,`user`.`lastname`,`user`.`firstname`,`user`.`emergencyrelation`,`user`.`emergencyphone`,`user`.`emergencycontact`,`user`.`email`,ownerunits) like '%".$search."%'";}
		if($userid)
			$sql.="where `user`.userid=".$userid;

		$residata=$this->_db->query($sql);
	    	if(!$residata->error())
	    		return $residata->results();
			else return false;

		}
        public function getResGoups($residents){

          $owners=array();
	      $renters=array();
	      $ownerNRs=array();

	      foreach ($residents as $resident) {
	        switch ($resident->ownrent) {
	          case 'renter':
	            array_push($renters, $resident);
	            break;
	           case 'owner':
	            array_push($owners, $resident);
	            break;
	           case 'ownerNR':
	            array_push($ownerNRs, $resident);
	            break;     
	          
	          default:
	            break;
	        }
	      }
	      return array($renters,$owners,$ownerNRs);

        }

}