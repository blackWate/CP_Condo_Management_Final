<?php
  
  echo'

<div class="col-md-3 collapseed" id="sidebar">
                    <div class="notice-board">
                        <div class="panel panel-default primary">
                            <div class="panel-heading">
                              Active  Notice Panel <span class="badge pull-right \">'.count(Session::get('notiBoard')).'</span>
                            </div>
                            <div class="panel-body">
                               
                                <ul style="padding-left:0px;list-style:none; text-primary">';
                                 $x=1;
                                foreach (Session::get('notiBoard') as $notBrd) {
                          echo'
                                    <li style="line-height: 50px; font-weight: 600;">
                                        <span class="glyphicon glyphicon-exclamation-sign danger" style="color:red;"></span>
                                        '.$notBrd->notesubject.'
                                         <span class="glyphicon glyphicon-eye-open pull-right" data-toggle="modal" data-target="#contentact'.$x.'" style="line-height: 50px;">
                                    </span>
                                    <div class="modal fade" id="contentact'.$x.'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                          <div class="modal-content">
                                            <div class="modal-header">
                                              <h2 class="modal-title" id="exampleModalLabel">Content of the Notification</h2>
                                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                              </button>
                                            </div>
                                            <div class="modal-body printmodal">
                                              '.$notBrd->notetext.'
                                            </div>
                                            <div class="modal-footer">
                                            <button  type="button" class="btn btn-default printm">Print</button>
                                              <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                                            </div>
                                          </div>
                                        </div>
                                      </div>  
                                    </li>';
                                   $x++;

                            }
                          
                            echo'    </ul>
                            </div>
                            <div class="panel-heading">
                              <h3 class="panel-title">Toronto Weather</h3>
                            </div>
                            <div class="panel-body">
                                <div id="weather"> 
                                </div>     
                            </div>
                            <div class="panel-heading">
                              <h3 class="panel-title">Toronto News</h3>
                            </div>
                            <div class="panel-body">
                                <ul id="news" class="list-group"> 
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- END BOARD PANEL-->
				
</div>';

