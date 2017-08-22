<?php
echo '
<!doctype html>
<html lang="en">
<head id="head">
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<title>Condo</title>
  <link href="css/fullcalendar.min.css" rel="stylesheet" />
<link href="css/fullcalendar.print.min.css" rel="stylesheet" media="print" />
<script src="js/moment.min.js"></script>
	<script
  src="https://code.jquery.com/jquery-3.1.1.min.js"
  integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
  crossorigin="anonymous"></script>
   <script
  src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"
  integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU="
  crossorigin="anonymous"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	<link href = "https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css" rel = "stylesheet">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
  <script src="js/tinymce/tinymce.min.js"></script>
  <script>tinymce.init({ selector:\'.tiny\',plugins: \'placeholder\' });</script>
  <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="style.css">

  <link rel="stylesheet" type="text/css" href="css/dashboard.css">
  
<script src="js/fullcalendar.min.js"></script>
   
  
   <script type="text/javascript" src="js/Chart.bundle.min.js"></script>
 <script type="text/javascript" src="js/Chart.PieceLabel.min.js"></script>
 <script type="text/javascript" src="js/loading.js"></script>

<style>#display-google-map img{max-width:none!important;background:none!important;font-size: inherit;}</style>
</head>';
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

//   //  echo '<br>Database: '.$pend->reservationdate.'<br>';
//   //  echo '<br>reformat: '.date('Y-m-d h:i A' , time()).'<br>';
//   //  echo '<br>difference: '.($diff->h+$diff->days*24).'<br>';
//   // echo $pend->reservationdate-date('Y-m-d h:i A', time());
}

foreach ($confirmed as $conf) {
$date1 = new DateTime($conf->startdate);
if ($conf->duration)
   $date1->add(new DateInterval('P'.$conf->duration.'D'));
 

$diff = $date2->diff($date1)->format("%R%a");

if($diff<0)
$updateStatus=$dbase->update('reservations',$conf->reservationid,['status'=>'completed'],'reservationid');


   // echo '<br>Today: '.$diff.'<br>';
   // echo '<br>startdate: '.$conf->startdate.'<br>';
   // if($conf->duration)
   // echo '<br>duration: '.$conf->duration.'<br>';
   // echo '<br>Day Difference: '.$diff.'<br>';
}
