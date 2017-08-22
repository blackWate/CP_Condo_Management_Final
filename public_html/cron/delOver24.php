<?php
$user=$this->model('User');
$reservation=$this->model('Reserve');
$pending=$user->getGRoom('All','pending','All')->results();
$confirmed=$user->getGRoom('All','confirmed','All')->results();
$date2 = new DateTime(date('Y-m-d h:i A' , time()));
$dbase=DB::getInstance(); 
foreach ($pending as $pend) {
$date1 = new DateTime($pend->reservationdate);
$diff = $date2->diff($date1);
if (($diff->h+$diff->days*24)>Config::get('reservation/pending_limit')) {
    $reservation->deleteRecord($pend->reservationid);
}

  //  echo '<br>Database: '.$pend->reservationdate.'<br>';
  //  echo '<br>reformat: '.date('Y-m-d h:i A' , time()).'<br>';
  //  echo '<br>difference: '.($diff->h+$diff->days*24).'<br>';
  // echo $pend->reservationdate-date('Y-m-d h:i A', time());
}