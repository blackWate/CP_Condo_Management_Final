<?php
class DashboardCal extends Controller{

	
  public function noMethod()
{
     $dashcalender=$this->model('DashCalender');
     $events=$dashcalender->getCalEvents();
     $calevents=array();
     foreach ($events as $event) {
     	$calevent=(object)[];
     	if($event->eventstart==null){
     		$calevent->start=$event->startdate;
     		$calevent->end=$event->enddate;
     	}else{
     		$calevent->start=$event->eventstart;
     		$calevent->end=$event->eventend;
     	}
     	switch ($event->status) {
     		case 'completed':
     		$calevent->backgroundColor='#d9534f';
     		$calevent->textColor='#f9f9f9';
     			break;
     		case 'confirmed':
     		$calevent->backgroundColor='#5cb85c';
     		$calevent->textColor='#f9f9f9';
     			break;
     		case 'pending':
     		$calevent->backgroundColor='#f0ad4e';
     		$calevent->textColor='#f9f9f9';
     			break;			
     		
     		default:
     			# code...
     			break;
     	}
     	$calevent->title=$event->title;
     	$calevent->url=$event->url;
     	array_push($calevents, (object)$calevent);
     }
 
      echo json_encode($calevents);
      

}



}