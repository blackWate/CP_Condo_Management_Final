<?php
class User 
{
	private $_db,
	        $_data,
	        $_sessionName,
	        $_firstName,
	        $_photo,
	        $_userid,
    		$_isLoggedIn,
    		$_role,
    		$_isAdmin;
    		
	

	public function __construct($user=null)
	{
		$this->_db=DB::getInstance();
		$this->_sessionName=Config::get('session/session_name');
		$this->_firstName=Config::get('session/user_name');
		$this->_userid=Config::get('session/user_id');
		$this->_photo=Config::get('session/user_photo');
		$this->_role=Config::get('session/user_role');
		if (!$user) {
			if (Session::exists($this->_sessionName)) {
				$unitno=Session::get($this->_sessionName);
				if ($this->find($unitno,'unitno')) {
					$this->_isLoggedIn=true;

				} 

				
			}
		}
		else{
			$this->find($user,'unitno');
		}
	}
	//create user
	public function create($fields=array())
	{
		if (!$this->_db->insert('user',$fields)) {
		throw new Exception('There was a problem creating an account.');
			
		}
	}
	public function systemUsers(){

		$sql="SELECT\n";
		$sql.="* FROM INFORMATION_SCHEMA.PROCESSLIST;\n";
		$sql.="WHERE state='executing'\n";

		$srvdata=$this->_db->query($sql);
    	if(!$srvdata->error())
    		return $srvdata->results();
    	else 
    		return false;
	}

	public function setGTimezone(){
		$sql="SELECT \n";
		$sql.="@@global.time_zone;\n";
		$sql.="SET GLOBAL time_zone = 'Toronto/America';\n";
		$isSet=$this->_db->query($sql);
		if(!$isSet->error())
    		return $isSet->results();
    	else 
    		return false;
	}


	public function find($unitno,$dbCname)
	{
		if ($unitno) {
			
			$data=$this->_db->get('user',array($dbCname,'=',$unitno));
		
				if ($data->count()) {
					$this->_data=$data->first();
					if($data->first()->role=="manager"){
						$this->_isAdmin=true;
						// echo($this->_isAdmin);
					}

					return true;
				}
		
			}
		return false;
	}
	public function email($email)
	{
		$email=$this->find($email,'email');
		if($email){
			$email=$this->data()->email;
			$token=$this->data()->token;
			$username=$this->data()->firstname;
			$unitno=$this->data()->unitno;
			return array($email,$token,$username,$unitno);
		}
		return false;

	}
    public function getGRoom($unitno,$status=null,$facilityid=null)
    {
    	

    	$sql="SELECT\n";
	$sql.="reservations.reservationid,\n";
	$sql.=Convertor::timezone('reservations.reservationdate' ,'reservationdate').",\n";
	$sql.="reservations.starttime,\n";
	$sql.="reservations.endtime,\n";
	$sql.="reservations.startdate,\n";
	$sql.="reservations.numberofpeople,\n";
	$sql.="facilities.fee,\n";
	if ($status) {
	$sql.="`user`.firstname,\n";
	$sql.="`user`.lastname,\n";
	$sql.="`user`.unitno,\n";
	$sql.="`user`.email,\n";
	}
	$sql.="reservations.duration,\n";
	$sql.="reservations.status,\n";
	$sql.="facilities.deposit\n";
	$sql.="FROM\n";
	$sql.="reservations\n";
	$sql.="JOIN facilities\n";
	$sql.="ON reservations.facilityid = facilities.facilityid\n"; 
	$sql.="JOIN `user`\n";
	$sql.="ON reservations.userid = `user`.userid\n";
	$sql.="WHERE\n";
	if ($status) {
	$sql.="reservations.status='".$status."'\n";
	}
	if(is_numeric($facilityid)){
	if($status)
	$sql.="AND\n";	
	$sql.="reservations.facilityid=".$facilityid."\n";
	}
	else if(!$facilityid){
	if($status)
	$sql.="AND\n";	
	$sql.="reservations.facilityid=1\n";
	}
	if(is_numeric($unitno))	
	$sql.="AND `user`.unitno =\n".$unitno;
    	$prdata=$this->_db->query($sql);
    	if(!$prdata->error())
    		return $prdata;
    	else 
    		return false;
    }

    public function busyGR()
    {
    	$sql="SELECT\n";
$sql.="reservations.startdate ,\n";
$sql.="reservations.duration\n";
$sql.="FROM\n";
$sql.="reservations\n";
$sql.="JOIN facilities\n";
$sql.="ON reservations.facilityid = facilities.facilityid\n";
$sql.="WHERE facilities.facilityid=1\n";
$sql.="AND reservations.startdate >= CURDATE();\n";
		$bdata=$this->_db->query($sql);
    	if(!$bdata->error()){
    		return $grBDays=Convertor::busyDays($bdata->results());
    	}
    		
    return false;	
    }

    public function getPRoom($unitno,$status=null)
    {
    	
		$sql="SELECT\n";
	$sql.="reservations.reservationid,\n";
	$sql.=Convertor::timezone('reservations.reservationdate','reservationdate').",\n";
	$sql.="reservations.starttime,\n";
	$sql.="reservations.endtime,\n";
	$sql.="reservations.startdate,\n";
	$sql.="reservations.numberofpeople,\n";
	$sql.="facilities.fee,\n";
	$sql.="reservations.duration,\n";
	$sql.="reservations.status,\n";
	$sql.="facilities.deposit\n";
	$sql.="FROM\n";
	$sql.="reservations\n";
	$sql.="JOIN facilities\n";
	$sql.="ON reservations.facilityid = facilities.facilityid\n"; 
	$sql.="JOIN `user`\n";
	$sql.="ON reservations.userid = `user`.userid\n";
	$sql.="WHERE\n";
	if ($status) {
	$sql.="reservations.status=".$status."\n";
	}
	$sql.="reservations.facilityid=2\n";
	if(is_numeric($unitno))
	$sql.="AND `user`.unitno =\n".$unitno;
    	$prdata=$this->_db->query($sql);
    	if(!$prdata->error())
    		return $prdata;
		else return false;
    }
	 public function busyPR()
	    {
	    	$sql="SELECT\n";
	$sql.="reservations.startdate\n";
	$sql.="FROM\n";
	$sql.="reservations\n";
	$sql.="JOIN facilities\n";
	$sql.="ON reservations.facilityid = facilities.facilityid\n";
	$sql.="WHERE facilities.facilityid=2\n";
	$sql.="AND reservations.startdate >= CURDATE();\n";
			$bdata=$this->_db->query($sql);
	    	if(!$bdata->error()){
              return $prBDays=Convertor::getValues($bdata->results());
	    	}
	    	else return false;
	}
    public function getEl($unitno)
    {
    	
		$sql="SELECT\n";
	$sql.="reservations.reservationid,\n";
	$sql.=Convertor::timezone('reservations.reservationdate','reservationdate').",\n";
	$sql.="reservations.startdate,\n";
	$sql.="reservations.starttime,\n";
	$sql.="reservations.duration,\n";
	$sql.="reservations.`status`,\n";
	$sql.="facilities.fee,\n";
	$sql.="facilities.deposit\n";
	$sql.="FROM\n";
	$sql.="reservations\n";
	$sql.="JOIN `user`\n";
	$sql.="ON reservations.userid = `user`.userid\n";
	$sql.="JOIN facilities\n";
	$sql.="ON reservations.facilityid = facilities.facilityid\n";
	$sql.="WHERE\n";
		if ($status) {
	$sql.="reservations.status=".$status."\n";
	}
	$sql.="facilities.facilityid=3\n";
	if(is_numeric($unitno))
	$sql.="AND `user`.unitno=".$unitno;
    	$eldata=$this->_db->query($sql);
    	if(!$eldata->error())
    		return $eldata;
    	else return false;	
    }

     public function busyEL()
	    {
	    	$sql="SELECT\n";
	$sql.="reservations.startdate,\n";
	$sql.="reservations.starttime\n";
	$sql.="FROM\n";
	$sql.="reservations\n";
	$sql.="JOIN facilities\n";
	$sql.="ON reservations.facilityid = facilities.facilityid\n";
	$sql.="WHERE facilities.facilityid=3\n";
	$sql.="AND reservations.startdate >= CURDATE();\n";
	$sql.="ORDER BY\n";
	$sql.="reservations.startdate ASC,\n";
	$sql.="reservations.starttime ASC\n";
			$bdata=$this->_db->query($sql);
	    	if(!$bdata->error()){
            return $elBDays=Convertor::elValues($bdata->results());
	    	}
	    	else return false;
	}
public function getDataResId($reservationid){
		$sql="SELECT\n";
	$sql.="`user`.firstname,\n";
	$sql.="`user`.lastname,\n";
	$sql.="`user`.email,\n";
	$sql.="facilities.facilityname,\n";
	$sql.="facilities.fee,\n";
	$sql.="facilities.deposit,\n";
	$sql.="reservations.startdate,\n";
	$sql.="reservations.starttime,\n";
	$sql.=Convertor::timezone('reservations.reservationdate','reservationdate').",\n";
	$sql.="reservations.endtime,\n";
	$sql.="reservations.duration,\n";
	$sql.="reservations.status,\n";
	$sql.="reservations.numberofpeople\n";
	$sql.="FROM\n";
	$sql.="reservations\n";
	$sql.="JOIN `user`\n";
	$sql.="ON reservations.userid = `user`.userid \n";
	$sql.="JOIN facilities\n";
	$sql.="ON reservations.facilityid = facilities.facilityid\n";
	$sql.="WHERE\n";
	$sql.="reservationid=".$reservationid;
	$resdata=$this->_db->query($sql);
    	if(!$resdata->error())
    		return $resdata;
		else return false;
	}
    public function token($token,$unitno)
	{
		$unitno=$this->find($unitno,'unitno');
		if ($unitno) {
			$token=$this->data()->token;
			$unitno=$this->data()->unitno;
			return array($token,$unitno);
		}
		return false;
	}
    public function update($unitno,$fields)
    { 
    	if($data=$this->_db->update('user',$unitno,$fields))
    		return true;

    	return false;
    }
    public function insert($table,$fields)
    { 
    	if($data=$this->_db->insert($table,$fields))
    		return true;

    	return false;
    }

	public function login($unitno=null,$password=null)
	{
		$unit=$this->find($unitno,'unitno');
		if ($unit) {
			if(password_verify($password,$this->data()->password)){
				Session::put($this->_sessionName,$this->data()->unitno);
				Session::put($this->_firstName,$this->data()->firstname);
             	Session::put($this->_userid,$this->data()->userid);
             	Session::put($this->_role,$this->data()->role);
             	Session::put($this->_photo,$this->data()->photo);
             	
				return true;
			}
			
		}

		return false;
	}

	

	

    public function data()
    {
    	return $this->_data;
    }

    public function isLoggedIn()
    {
    	return $this->_isLoggedIn;
    }
     public function isAdmin()
    {
    	if($this->_isAdmin)
         return true;	
    }

}