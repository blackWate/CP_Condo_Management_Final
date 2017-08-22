<?php
class Logout extends Controller{

	
  public function noMethod()
{
	
	session_unset(); 
	session_destroy();
   $this->view('/home');

}
}