<?php

require_once( '../app/helpers/head.php');
require_once( '../app/helpers/header.php');
echo'
<div class="container-fluid">';
require_once( '../app/helpers/dashboardheader.php');
echo' <div  class="container  col-xs-12 col-md-12  col-lg-12 dash1  pull-left"> 


	 <div class="container-2">
     <div id="page-wrapper">   
      <div class="row">
     <div class="col-md-12">
      <div class="page-title">
       <h2>Dashboard</h2>
        <ol class="breadcrumb">
         <li class="active"><i class="fa fa-dashboard"></i> Dashboard</li>
          
        </ol>
       </div>
      </div>
     </div> 
               
                    <div class="col-lg-3 col-sm-6">
                        <div class="circle-tile">
                            <a href="#">
                                <div class="circle-tile-heading dark-blue">
                                    <i class="fa fa-users fa-fw fa-3x"></i>
                                </div>
                            </a>
                            <div class="circle-tile-content dark-blue">
                                <div class="circle-tile-description text-faded">
                                    Residents
                                </div>
                                <div class="circle-tile-number text-faded">
                                    <canvas id="resichart" width="100" height="100"></canvas>
                                    <span id="sparklineA"></span>
                                </div>
                                <a href="manresidents" class="circle-tile-footer">More Info <i class="fa fa-chevron-circle-right"></i></a>
                            </div>
                        </div>
                    </div>
                 

                    <div class="col-lg-9 col-sm-6">
                         <div class="circle-tile">
                            <a href="#">
                                <div class="circle-tile-heading green">
                                    <i class="fa fa-calendar fa-fw fa-3x"></i>
                                </div>
                            </a>
                            <div class="circle-tile-content green">
                                <div class="circle-tile-description text-faded">
                                    Reservations Status
                                </div>
                                <div class="col-lg-4">
                                    <h5 class="circle-tile-description text-faded">Guest Room </h5>
                                    <div class="circle-tile-number text-faded">
                                        <canvas id="reservgroom" width="100" height="100"></canvas>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <h5 class="circle-tile-description text-faded">Party Room </h5>
                                    <div class="circle-tile-number text-faded">
                                        <canvas id="reservproom" width="100" height="100"></canvas>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                        <h5 class="circle-tile-description text-faded">Elevator </h5>
                                        <div class="circle-tile-number text-faded">
                                            <canvas id="reservelevator" width="100" height="100"></canvas>
                                        </div>
                                </div>

                                <a href="manreservgroom" class="circle-tile-footer">More Info <i class="fa fa-chevron-circle-right"></i></a>
                            </div>
                        </div>
                    </div><!-- container end-->
                    <div class="col-lg-12">
                    <div id="calendar"></div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="circle-tile">
                            <a href="#">
                                <div class="circle-tile-heading orange">
                                    <i class="fa fa-bell fa-fw fa-3x"></i>
                                </div>
                            </a>
                            <div class="circle-tile-content orange">
                                <div class="circle-tile-description text-faded">
                                    Notifications
                                </div>
                                <div class="circle-tile-number text-faded">
                                   You have '.count(Session::get('notiBoard')).' notification/s
                                </div>
                                <a href="notificationmon" class="circle-tile-footer">More Info <i class="fa fa-chevron-circle-right"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="circle-tile">
                            <a href="#">
                                <div class="circle-tile-heading blue">
                                    <i class="fa fa-tasks fa-fw fa-3x"></i>
                                </div>
                            </a>
                            <div class="circle-tile-content blue">
                                <div class="circle-tile-description text-faded">
                                    Tasks
                                </div>
                                <div class="circle-tile-number text-faded">
                                    10
                                    <span id="sparklineB"></span>
                                </div>
                                <a href="#" class="circle-tile-footer">More Info <i class="fa fa-chevron-circle-right"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="circle-tile">
                            <a href="#">
                                <div class="circle-tile-heading red">
                                    <i class="fa fa-connectdevelop fa-fw fa-3x"></i>
                                </div>
                            </a>
                            <div class="circle-tile-content red">
                                <div class="circle-tile-description text-faded">
                                    Connected Residents
                                </div>
                                <div class="circle-tile-number text-faded">
                                    24
                                    <span id="sparklineC"></span>
                                </div>
                                <a href="#" class="circle-tile-footer">More Info <i class="fa fa-chevron-circle-right"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="circle-tile">
                            <a href="#">
                                <div class="circle-tile-heading purple">
                                    <i class="fa fa-comments fa-fw fa-3x"></i>
                                </div>
                            </a>
                            <div class="circle-tile-content purple">
                                <div class="circle-tile-description text-faded">
                                    Mentions
                                </div>
                                <div class="circle-tile-number text-faded">
                                    96
                                    <span id="sparklineD"></span>
                                </div>
                                <a href="#" class="circle-tile-footer">More Info <i class="fa fa-chevron-circle-right"></i></a>
                            </div>
                        </div>
                    </div>



                </div>
    </div><!-- page-wrapper END-->
   </div><!-- container-1 END-->



</div>
</div>
</div>';

require_once( '../app/helpers/footer.php');

