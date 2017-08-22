<?php
require_once( '../app/helpers/head.php');
require_once( '../app/helpers/manheader.php');
if($data['showchat'])
require ( '../app/helpers/ChatBox.php');
echo'
<div class="container-fluid">';
require_once( '../app/helpers/dashboardheader.php');
echo '  

	
   <div  class="container dash1 col-xs-12 col-md-12  col-lg-12  pull-left"> 
    <legend>Reservations</legend>
	 <br>
        <form method="post">
        <ul  class="nav nav-pills">
		            <li id="g" class=""><button type="submit" class="btn btn-default" formaction="manreservgroom">Guest Room</a></button></li>
		            <li id="p" class=""><button type="submit" class="btn btn-default" formaction="manreservproom">Party Room</a></button></li>
		            <li id="e" class=""><button type="submit" class="btn btn-primary" formaction="manreservelevator">Elevator</a></button></li>
		        </ul>
		  </form>     
   <div  class="container col-xs-12 col-md-12 pull-left" style="
    margin-top: 20px;"> 
        <ul  class="nav nav-pills">
            <li id="ge" class="active"><a  href="#1a" data-toggle="tab">Pending<span class="badge">'.count($data['manGRoomp']).'</span></a></li>
            <li id="pe" class=""><a  href="#2a" data-toggle="tab">Confirmed<span class="badge">'.count($data['manGRoomc']).'</span></a></li>
            <li id="ee" class=""><a  href="#3a" data-toggle="tab">Completed<span class="badge">'.count($data['manGRoomcp']).'</span></a></li>
        </ul> 
		        <div class="tab-content">
		            <div class="tab-pane active" style="margin-top: -40px;" id="1a">
		                    <table class="table table-striped table-hover table-responsive">
		                          <thead class="thead-inverse">
		                            <tr>
		                              <th>#</th>
		                              <th>Request#</th>
		                              <th>Request<br>Date</th>
		                              <th>Date</th>
		                              <th>Time Period</th>
		                              <th>Fee</th>
		                              <th>Deposit</th>
		                              <th>Status</th>
		                              <th>Chat</th>
		                              <th>Update</th>
		                              <th></th>
		                            </tr>
		                          </thead>
		                          <tbody>';
		                          if($data['manGRoomp']){
		                              $x=1;
		                          foreach ($data['manGRoomp'] as $grData) {
		                           $username=$grData->firstname.' '.$grData->lastname;
		                        echo'<tr >
		                              <th scope="row">'.$x.'</th>
		                              <td>'.$grData->reservationid.'<br><strong>'.$username.'</strong></td>
		                              <td>'.$grData->reservationdate.'<br><span class="badge">'.$grData->unitno.'</span></td>
		                              <td>'.$grData->startdate.'</td>
		                              <td>'.$grData->starttime.'</td>
		                              <form action="manreservelevator" method="post">
		                              <td>'.$grData->fee.' $</td>
		                              <td>'.$grData->deposit.' $<br>
			                              <select name="depoIsPaid" class="btn-warning" data-style="btn-warning">
			                                  <option value="unpaid">unpaid</option>
										      <option value="paid">paid</option>
										  </select>
		                              </td>
		                              <td>'.$grData->status.'</td>
		                              
			                              <td>
			                                <button  type="submit" formaction="manreservelevator"  class="btn btn-warning chat glyphicon glyphicon-comment" name="chat" value="chat" data-toggle="tooltip" data-placement="top" title="Chat" reservetype="reservations" reserveid='.$grData->reservationid.'></button>
			                                  <input  type="hidden"  name="reserveid" value="'.$grData->reservationid.'"> 
			                             </td>
			                          
		                              <td>
		                              <button type="submit" name="update" value="update" class="btn btn-success data-toggle="confirmation" data-singleton="true">Update</button>
		                              </td>
		                              <td><button type="submit" name="delete" value="delete" class="btn btn-danger">x</button></td>
		                                  <input type="hidden"  name="groomid" value="'.$grData->reservationid.'">
		                            </tr>
		                            </form>';
		                            $x++;

		                            }
		                          }
		 
		                     echo' </tbody>
		                          <tfoot
		                          </tfoot>
		                        </table>
		            </div>
		            <div class="tab-pane" style="margin-top: -40px;" id="2a">
		                    <table class="table table-striped table-hover table-responsive">
		                          <thead class="thead-inverse">
		                            <tr>
		                              <th>#</th>
		                              <th>Request#</th>
		                              <th>Request<br>Date</th>
		                              <th>Date</th>
		                              <th>Time Period</th>
		                              <th>Fee</th>
		                              <th>Deposit</th>
		                              <th>Status</th>
		                              <th>Chat</th>
		                              <th></th>
		                            </tr>
		                          </thead>
		                          <tbody>';
		                          if($data['manGRoomc']){
		                              $x=1;
		                          foreach ($data['manGRoomc'] as $grData) {
		                           $username=$grData->firstname.' '.$grData->lastname;
		                        echo'<tr >
		                              <th scope="row">'.$x.'</th>
		                              <td>'.$grData->reservationid.'<br><strong>'.$username.'</strong></td>
		                              <td>'.$grData->reservationdate.'<br><span class="badge">'.$grData->unitno.'</span></td>
		                              <td>'.$grData->startdate.'</td>
		                               <td>'.$grData->starttime.'</td>
		                              <form action="manreservelevator" method="post">
		                              <td>'.$grData->fee.' $</td>
		                              <td>'.$grData->deposit.' $</td>
		                              <td>'.$grData->status.'</td>
		                              
			                              <td>
			                                <button  type="submit" formaction="manreservelevator"  class="btn btn-warning chat glyphicon glyphicon-comment" name="chat" value="chat" data-toggle="tooltip" data-placement="top" title="Chat" reservetype="reservations" reserveid='.$grData->reservationid.'><span class="number">4</span></button>
			                                  <input  type="hidden"  name="reserveid" value="'.$grData->reservationid.'"> 
			                             </td>
			                           
		                              <td><button type="submit" name="delete" value="delete" class="btn btn-danger">x</button></td>
		                                  <input type="hidden"  name="groomid" value="'.$grData->reservationid.'">
		                            </tr>
		                            </form>';
		                            $x++;

		                            }
		                          }
		 
		                     echo' </tbody>
		                          <tfoot
		                          </tfoot>
		                        </table>
		            </div>
		            <div class="tab-pane" style="margin-top: -40px;" id="3a">
		                    <table class="table table-striped table-hover table-responsive">
		                          <thead class="thead-inverse">
		                            <tr>
		                              <th>#</th>
		                              <th>Request#</th>
		                              <th>Request<br>Date</th>
		                              <th>Date</th>
		                              <th>Time Period</th>
		                              <th>Fee</th>
		                              <th>Deposit</th>
		                              <th>Status</th>
		                              <th>Chat</th>
		                              <th></th>
		                            </tr>
		                          </thead>
		                          <tbody>';
		                          if($data['manGRoomcp']){
		                              $x=1;
		                          foreach ($data['manGRoomcp'] as $grData) {
		                        
		                           $username=$grData->firstname.' '.$grData->lastname;
		                        echo'<tr >
		                              <th scope="row">'.$x.'</th>
		                              <td>'.$grData->reservationid.'<br><strong>'.$username.'</strong></td>
		                              <td>'.$grData->reservationdate.'<br><span class="badge">'.$grData->unitno.'</span></td>
		                              <td>'.$grData->startdate.'</td>
		                              <td>'.$grData->starttime.'</td>
		                              <form action="manreservelevator" method="post">
		                              <td>'.$grData->fee.' $</td>
		                              <td>'.$grData->deposit.' $</td>
		                              <td>'.$grData->status.'</td>
		                              
			                              <td>
			                                <button  type="submit" formaction="manreservelevator"  class="btn btn-warning chat glyphicon glyphicon-comment" name="chat" value="chat" data-toggle="tooltip" data-placement="top" title="Chat" reservetype="reservations" reserveid='.$grData->reservationid.'></button>
			                                  <input  type="hidden"  name="reserveid" value="'.$grData->reservationid.'"> 
			                             </td>
			                           
		                              <td><button type="submit" name="delete" value="delete" class="btn btn-danger">x</button></td>
		                                  <input type="hidden"  name="groomid" value="'.$grData->reservationid.'">
		                            </tr>
		                            </form>';
		                            $x++;

		                            }
		                          }
		 
		                     echo' </tbody>
		                          <tfoot
		                          </tfoot>
		                        </table>
		            </div>
		            <div class="tab-pane" id="4a">
		                    <h3>We use css to change the background color of the content to be equal to the tab</h3>
		            </div>
		</div> 
		
		</div>
	</div>';
require_once( '../app/helpers/footer.php');