<?php
class About extends Controller{

	
  public function noMethod()
{
   // echo("about controller set<br>");
	
   	$this->view('/about',['highlighta'=>'active']);
}
}