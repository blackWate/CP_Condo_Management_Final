<?php

require_once( '../app/helpers/head.php');
require_once( '../app/helpers/header.php');

echo '
		<div class="bg">
		  <div class="container-fluid">
		    <h1>Contact Us</h1>
		  </div>
		</div>
		<div class="container-fluid">
		  <h3> 21 CLAIRTRELL RD</h3>
		  <div class="row">
		    <div class="col-sm-8 column">
		      <div class="embed-responsive embed-responsive-4by3">
		        <div class="map">
		          <div id="display-google-map" style="height:100%; width:100%;max-width:100%;">
		            <iframe style="height:70%;width:100%;border:0;"  src="https://www.google.com/maps/embed/v1/search?q=Clairtrell+Road,+North+York,+ON,+Canada&key=AIzaSyAN0om9mFmy1QN6Wf54tXAowK4eT0ZUPrU"></iframe>
		          </div>
		          
		        </div>
		      </div>
		    </div>
		    <div class="col-sm-1 column"></div>
		    <div class="col-sm-3 column">
		      <div class="row">
		        <h4>Reach Us</h4>
		        <p><img src="icon/phone.png">&nbsp;647-430-4913</p>
		        <br>
		        <hr>
		        <h4>Send an email</h4>
		        <p><img src="icon/mail-back.png" alt="mback_icon">&nbsp;condos@rogers.com</p>
		        <br>
		        <hr>
		        <h4>Contact for services</h4>
		        <p><a href="services.html"><img src="icon/screw-driver.png" alt="sd_icon"></a>&nbsp;Click icon to redirect</p>
		      </div>
		      <div class="row"></div>

		    </div>
		    
		  </div>
		</div>';

require_once( '../app/helpers/footer.php');

