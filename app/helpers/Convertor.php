<?php

class Convertor{

	public static function findET($time,$duration)
	{

		return ;
	}

   public static function elValues($array)
	{
		if($array){

		 $days=array();	
		 $times=array();
		 $busyDays=array();

				foreach ($array as $arr) {
					if(!in_array($arr->startdate,$days)){
				   array_push($days, $arr->startdate);
				   array_push($times, array());
				}
				}
				foreach ($array as $arr) {
					$day=$arr->startdate;
				    $index=array_search($day,$days);
				    array_push($times[$index],$arr->starttime);
				}
				for ($i=0; $i <count($days) ; $i++) { 
					$bday=array($days[$i],$times[$i]);
					array_push($busyDays,$bday);
				}

		return $busyDays;
		}
		return false;
	}
	public static function getValues($array)
	{
			if($array){
		 $values=array();
		foreach ($array as $arr) {


			array_push($values,$arr->startdate);
			}
			return $values;
		}
		return false;

	}
	public static function busyDays($daysDur)
	{
         $days=array();
		foreach ($daysDur as $day) {
			for ($i=0; $i <$day->duration ; $i++) { 
				$date = $day->startdate;
			array_push($days,date('Y-m-d', strtotime($date. ' +'.$i.' days')));	
			}
		}

		return $days;
	}
	public static function timezone($table,$as=null){

		 $dtz = new DateTimeZone(Config::get('timezone/timezone_name'));
		 $time_in= new DateTime('now', $dtz);
		 $time=$dtz->getOffset($time_in)/3600;
	     $timeDiff = ($time>0) ? $timeDiff="'+".$time.":00'" : $timeDiff="'".$time.":00'" ;
         $sql="DATE_FORMAT(CONVERT_TZ(".$table.",'+00:00',".$timeDiff."),'".Config::get('timezone/timezone_date_format')."  ".Config::get('timezone/timezone_time_format')."')";
         if($as)
         $sql.=" as ".$as;
         // echo "<br>date result:".$sql."<br>";
         return $sql;

	}
    
    public static function arrayToString($array,$delimiter){
    	return implode($delimiter,$array);
    }



}