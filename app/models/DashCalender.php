<?php
class DashCalender{


private $_db;

    public function __construct()
    {
        $this->_db=DB::getInstance();
    }
    public function getCalEvents(){
		    $sql="SELECT\n";
		$sql.="reservations.startdate,\n";
		$sql.="if(duration>0,DATE_ADD(startdate,INTERVAL (duration)day),startdate) as enddate,\n";
		$sql.="if(starttime LIKE '%-%',CONCAT(reservations.startdate,'T',SUBSTRING_INDEX(starttime, '-', 1),':00'),\n";
		$sql.="if(startdate IS NOT NULL,CONCAT(reservations.startdate,'T',starttime,':00'),NULL )) as eventstart,\n";
		$sql.="if(facilities.facilityid=1,'manreservgroom',if(facilities.facilityid=2,'manreservproom','manreservelevator')) as url,\n";
		$sql.="if(starttime LIKE '%-%',CONCAT((select enddate),'T',SUBSTRING_INDEX(starttime, '-', -1),':00'),\n";
		$sql.="if((select enddate) IS NOT NULL,CONCAT((select enddate),'T',endtime,':00'),NULL )) as eventend,\n";
		$sql.="reservations.duration,\n";
		$sql.="reservations.`status`,\n";
		$sql.="facilities.facilityname,\n";
		$sql.="CONCAT(reservationid,'-',UCASE(facilities.facilityname),' - ',UCASE(reservations.`status`),' - ',`user`.unitno,' - ',`user`.firstname,' ',`user`.lastname,' - ',`user`.mobilephone) as title\n";
		$sql.="FROM\n";
		$sql.="reservations\n";
		$sql.="JOIN facilities\n";
		$sql.="ON reservations.facilityid = facilities.facilityid\n";
		$sql.="JOIN `user`\n";
		$sql.="ON reservations.userid = `user`.userid\n";
		$caldata=$this->_db->query($sql);
    	if(!$caldata->error())
    		return $caldata->results();
    	else 
    		return false;

}











}