<?php
class Services{
	private $_db;

    public function __construct()
    {
        $this->_db=DB::getInstance();
    }
public function getServices($unitno,$status=null,$serviceid=null)
	{
		$sql="SELECT\n";
		$sql.="services.serviceid,\n";
		$sql.=Convertor::timezone('services.requestdate' ,'requestdate').",\n";
		$sql.=Convertor::timezone('services.replytime' ,'replytime').",\n";
		$sql.="services.`subject`,\n";
		$sql.="services.servicetype,\n";
		$sql.="services.description,\n";
		$sql.="services.`status`,\n";
		$sql.="services.`manreply`,\n";
		$sql.="`user`.unitno,\n";
		$sql.="`user`.firstname,\n";
		$sql.="`user`.lastname,\n";
		$sql.="services.userid\n";
		$sql.="FROM\n";
		$sql.="services\n";
		$sql.="JOIN `user`\n";
		$sql.="ON services.userid = `user`.userid\n";
		$sql.="WHERE\n";
		if($status){
		$sql.="services.`status`='".$status."'\n";	
		}
		if(is_numeric($unitno)){
		if($status)	
		$sql.="AND\n";	
		$sql.="`user`.unitno =".$unitno."\n";
		}
		if($serviceid){
		if($status||is_numeric($unitno))	
		$sql.="AND\n";	
		$sql.="services.serviceid =".$serviceid."\n";
		}

		// echo $sql;
		$srvdata=$this->_db->query($sql);
    	if(!$srvdata->error())
    		return $srvdata->results();
    	else 
    		return false;
	}
	public function deleteRecord($serviceid)
	{
		$delete=$this->_db->delete('services',array('serviceid','=',$serviceid));
	}


	public function insertRecord($user,$userid)
	{
		


	}
	public function updateService($serviceid,$reply,$status){
    $date = date('Y-m-d H:i:s');
	$fields=['status'=>$status,'manreply'=>$reply,'replytime'=>$date];	
	$update=$this->_db->update('services',$serviceid,$fields,'serviceid');	

	}

	public function serviceDone($serviceid){
     $fields=['status'=>'Resolved'];
     $update=$this->_db->update('services',$serviceid,$fields,'serviceid');

	}
	
    


}