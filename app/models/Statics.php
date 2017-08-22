<?php
class Statics{


private $_db;

    public function __construct()
    {
        $this->_db=DB::getInstance();
    }
    	//resident status report
     public function getResidentSR(){

		$sql="SELECT\n";
		$sql.="owners.ownrent,\n";
		$sql.="count(*) as number\n";
		$sql.="FROM(\n";
		$sql.="SELECT\n";
		$sql.="IF(`user`.owneruserid=`user`.userid,IF(unitno is null,'owner-NR','owner'),'renter') as ownrent,\n";
		$sql.="unitno\n";
		$sql.="FROM\n";
		$sql.="`user`\n";
		$sql.="WHERE unitno <= 706 OR unitno is null) as owners\n";
		$sql.="GROUP BY owners.ownrent\n";
		$srvdata=$this->_db->query($sql);
    	if(!$srvdata->error())
    		return $srvdata->results();
    	else 
    		return false;
     }
     //facility status report
      public function getFacilitySR($facilityname){

		$sql="SELECT\n";
		$sql.="count(facstatus.status) as statusnum,\n";
		$sql.="facstatus.facilityname,\n";
		$sql.="facstatus.status\n";
		$sql.="from\n";
		$sql.="(SELECT\n";
		$sql.="facilities.facilityname,\n";
		$sql.="CONCAT(facilities.facilityname,reservations.`status`) as concatfs,\n";
		$sql.="reservations.`status`\n";
		$sql.="FROM\n";
		$sql.="reservations\n";
		$sql.="JOIN facilities\n";
		$sql.="ON reservations.facilityid = facilities.facilityid) as facstatus\n";
		$sql.="GROUP BY facstatus.concatfs\n";
		$sql.="HAVING facstatus.facilityname='".$facilityname."'";
		$facdata=$this->_db->query($sql);
    	if(!$facdata->error())
    		return $facdata->results();
    	else 
    		return false;

      }
      	//facilities occupied dates
       public function getFacilityOD($facilityid){
		      $sql="SELECT\n";
		$sql.="reservations.startdate,\n";
		$sql.="if(duration>0,DATE_ADD(startdate,INTERVAL (duration-1)day),startdate) enddate,\n";
		$sql.="reservations.duration,\n";
		$sql.="facilities.facilityname\n";
		$sql.="FROM\n";
		$sql.="reservations\n";
		$sql.="JOIN facilities\n";
		$sql.="ON reservations.facilityid = facilities.facilityid\n";
		$sql.="where facilities.facilityid=".$facilityid."";
		$facdata=$this->_db->query($sql);
    	if(!$facdata->error())
    		return $facdata->results();
    	else 
    		return false;
   	 }

}