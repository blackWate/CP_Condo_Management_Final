<?php

class Home extends Controller{
  public function noMethod()
{


   	$this->view('/home',['highlighth'=>'active']);
       

	}
	
}