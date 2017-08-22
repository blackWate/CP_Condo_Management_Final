<?php

require_once( '../app/helpers/head.php');
require_once( '../app/helpers/header.php');
if($data['showchat'])
require ( '../app/helpers/ChatBox.php');
echo ' <hr>
<div id="exTab1"  class="container"> 
        <ul  class="nav nav-pills">
            <li id="g" class="'.$data['activeg'].'"><a  href="#1a" data-toggle="tab">Guest Room</a></li>
            <li id="p" class="'.$data['activep'].'"><a  href="#2a" data-toggle="tab">Party Room</a></li>
            <li id="e" class="'.$data['activee'].'"><a  href="#3a" data-toggle="tab">Elevator</a></li>
        </ul>

        <div class="tab-content clearfix">
            <div class="tab-pane '.$data['activeg'].' align-middle" id="1a">
                    <table class="table table-striped table-hover table-responsive">
                          <thead class="thead-inverse">
                            <tr>
                              <th>#</th>
                              <th>Request#</th>
                              <th>Request<br>Date</th>
                              <th>Start Date</th>
                              <th>Duration</th>
                              <th>Fee</th>
                              <th>Deposit</th>
                              <th>Status</th>
                              <th>Chat</th>
                              <th></th>
                              <th></th>
                            </tr>
                          </thead>
                          <tbody>
                          ';
                          if($data['grData']){
                              $x=1;
                          foreach ($data['grData'] as $grData) {
                            $fee=$grData->fee*$grData->duration;
                          
                        echo'<tr >
                              <th scope="row">'.$x.'</th>
                              <td>'.$grData->reservationid.'</td>
                              <td>'.$grData->reservationdate.'</td>
                              <td>'.$grData->startdate.'</td>
                              <td>'.$grData->duration.' days</td>
                              <td>'.$fee.' $</td>
                              <td>'.$grData->deposit.' $</td>
                              <td>'.$grData->status.'</td>
                              <form method="post">
                              <td>
                                <button  type="submit" formaction="reservation"  class="btn btn-warning chat glyphicon glyphicon-comment" name="chat" value="chat" data-toggle="tooltip" data-placement="top" title="Chat with Manager" reservetype="reservations" reserveid='.$grData->reservationid.'></button>
                                  <input  type="hidden"  name="reserveid" value="'.$grData->reservationid.'"> 
                             </td>
                              </form>
                              <td><button type="button" class="btn btn-danger"><a style="color:white;" href="reservation?refg='.$grData->reservationid.'">x</a></button></td>
                            </tr>';
                            $x++;

                            }
                          }
 
                     echo' </tbody>
                          <tfoot>
                               <tr>
                                    <form action="reservation" method="post" name="guestRoom">
            
                                        <table class="table table-striped table-hover table-responsive">
                                            <thead class="thead-inverse">
                                                <tr>
                                                    <th>Start Date</th>
                                                    <th>End Date</th>
                                                    <th>Duration</th>
                                                    <th>Fee</th>
                                                    <th>Deposit</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td><input type = "text" class = "datepicker start" id="startDate" name="startDate" readonly ></td>
                                                    <td><input type = "text" class = "datepicker end" id="endDate" name="endDate" readonly></td>
                                                    <td><input type="text" name="duration" id="duration" readonly></td> 
                                                    <td><input type="text" name="fee" id="fee" readonly></td>
                                                    <td><input type="text" name="deposit" id="deposit"  readonly></td>
                                                     <input type="hidden"  name="token1" value="'.Token::generate(1).'"> 
                                                </tr>       
                                            </tbody>

                                            <tfoot> 
                                                <tr >        
                                                    <td colspan="5"><input type="submit" id="submit" name="gRoom"></td>

                                                </tr> 
                                      
                                            </tfoot>      
                                        </table>
                            
                                            
                                    </form>
                               </tr>
                          </tfoot>
                        </table>
            </div>
            <div class="tab-pane '.$data['activep'].'" id="2a">
                    <table class="table table-striped table-hover table-responsive">
                          <thead class="thead-inverse">
                            <tr>
                              <th>#</th>
                              <th>Request#</th>
                              <th>Request<br>Date</th>
                              <th>Reservation<br>Date</th>
                              <th>Start<br>Time</th>
                              <th>End<br>Time</th>
                              <th>Number of<br>People</th>
                              <th>Fee</th>
                              <th>Deposit</th>
                              <th>Status</th>
                              <th>Chat</th>
                              <th></th>
                            </tr>
                          </thead>
                          <tbody>';
                          if($data['prData']){
                           $x=1;
                          foreach ($data['prData'] as $prData) {
        
                        echo'<tr>
                              <th scope="row">'.$x.'</th>
                              <td>'.$prData->reservationid.'</td>
                              <td>'.$prData->reservationdate.'</td>
                              <td>'.$prData->startdate.'</td>
                              <td>'.$prData->starttime.'</td>
                              <td>'.$prData->endtime.'</td>
                              <td>'.$prData->numberofpeople.'</td>
                              <td>'.$prData->fee.' $</td>
                              <td>'.$prData->deposit.' $</td>
                              <td>'.$prData->status.'</td>
                              <form method="post">
                              <td>
                                <button  type="submit" formaction="reservation"  class="btn btn-warning chat glyphicon glyphicon-comment" name="chat" value="chat" data-toggle="tooltip" data-placement="top" title="Chat with Manager" reservetype="reservations" reserveid='.$prData->reservationid.'></button>
                                  <input  type="hidden"  name="reserveid" value="'.$prData->reservationid.'"> 
                             </td>
                              </form>
                             
                              <td><button type="button" class="btn btn-danger"><a style="color:white;" href="reservation?refp='.$prData->reservationid.'">x</a></button></td>
                            </tr>';
                            $x++;
                              }
                            }
                        echo'  </tbody>
                           <tfoot>
                               <tr>
                                    <form  id="partyRoomForm" method="post" action="reservation"  name="pr" onsubmit="return myValidation()">
            
                                        <table class="table">
                                            <thead class="thead-inverse">
                                                <tr>
                                                    <th>Reservation Date</th>
                                                    <th>Start Time</th>
                                                    <th>End Time</th>
                                                    <th>Number of<br>people</th>
                                                    <th>Fee</th>
                                                    <th>Deposit</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td><input type = "text"  id="reservationDate" name="reservationDate" readonly ></td>
                                                    <td>
                                                        <select name="startTime" id="startTime">
                                                          <option value="09:00">09:00</option>
                                                          <option value="10:00">10:00</option>
                                                          <option value="11:00">11:00</option>
                                                          <option value="12:00">12:00</option>
                                                          <option value="13:00">13:00</option>
                                                          <option value="14:00">14:00</option>
                                                          <option value="15:00">15:00</option>
                                                          <option value="16:00">16:00</option>
                                                          <option value="17:00">17:00</option>
                                                          <option value="18:00">18:00</option>  
                                                          <option value="19:00">19:00</option>
                                                          <option value="20:00">20:00</option>
                                                          <option value="21:00">21:00</option>
                                                          <option value="22:00">22:00</option>
                                                          <option value="23:00">23:00</option>
                                                          <option value="24:00">24:00</option>                            
                                                        </select>
                                                    </td> 
                                                    <td>
                                                        <select name="endTime" id="endTime">
                                                          <option value="09:00">09:00</option>
                                                          <option value="10:00">10:00</option>
                                                          <option value="11:00">11:00</option>
                                                          <option value="12:00">12:00</option>
                                                          <option value="13:00">13:00</option>
                                                          <option value="14:00">14:00</option>
                                                          <option value="15:00">15:00</option>
                                                          <option value="16:00">16:00</option>
                                                          <option value="17:00">17:00</option>
                                                          <option value="18:00">18:00</option>  
                                                          <option value="19:00">19:00</option>
                                                          <option value="20:00">20:00</option>
                                                          <option value="21:00">21:00</option>
                                                          <option value="22:00">22:00</option>
                                                          <option value="23:00">23:00</option>
                                                          <option value="24:00">24:00</option>                            
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <select name="numberOfPeople" id="numberOfPeople">
                                                          <option value="1-25">1-25</option>
                                                          <option value="26-50">26-50</option>
                                                          <option value="51-75">51-75</option>
                                                        </select>
                                                    </td>
                                                    <td><input type="text" name="fee" id="fee" readonly value="200.00"></td>
                                                    <td><input type="text" name="deposit" id="deposit"  readonly value="400.00"></td>
                                                </tr> 
                                                 <input type="hidden"  name="token2" value="'.Token::generate(2).'">      
                                            </tbody>
                                            <tfoot> 
                                                <tr >        
                                                    <td colspan="6"><input type="submit" id="submit" name="pRoom"></td>
                                                </tr> 
                                            </tfoot>      
                                        </table>
                            
                                            
                                    </form>
                               </tr>
                          </tfoot>
                        </table>
            </div>
            <div class="tab-pane '.$data['activee'].'" id="3a">
                     <table class="table table-striped table-hover table-responsive">
                          <thead class="thead-inverse">
                            <tr>
                              <th>#</th>
                              <th>Request#</th>
                              <th>Request<br>Date</th>
                              <th>Reservation<br>Date</th>
                              <th>Time Period</th>
                              <th>Fee</th>
                              <th>Deposit</th>
                              <th>Status</th>
                              <th>Chat</th>
                              <th></th>
                            </tr>
                          </thead>
                          <tbody>';
                          if($data['elData']){
                           $x=1;
                          foreach ($data['elData'] as $elData) {
        
                        echo'<tr>
                              <th scope="row">'.$x.'</th>
                              <td>'.$elData->reservationid.'</td>
                              <td>'.$elData->reservationdate.'</td>
                              <td>'.$elData->startdate.'</td>
                              <td>'.$elData->starttime.'</td>
                              <td>'.$elData->fee.' $</td>
                              <td>'.$elData->deposit.' $</td>
                              <td>'.$elData->status.'</td>
                              <form method="post">
                              <td>
                                <button  type="submit" formaction="reservation"  class="btn btn-warning chat glyphicon glyphicon-comment" name="chat" value="chat" data-toggle="tooltip" data-placement="top" title="Chat with Manager" reservetype="reservations" reserveid='.$elData->reservationid.'></button>
                                  <input  type="hidden"  name="reserveid" value="'.$elData->reservationid.'"> 
                             </td>
                              </form>
                              <td><button type="button" class="btn btn-danger"><a style="color:white;" href="reservation?refe='.$elData->reservationid.'">x</a></button></td>
                            </tr>';
                            $x++;
                        
                            }
                          }
                        echo'  </tbody>
                           <tfoot>
                               <tr>
                                    <form  method="post" action="reservation"  name="el">
            
                                        <table class="table">
                                            <thead class="thead-inverse">
                                                <tr>
                                                    <th>Reservation Date</th>
                                                    <th>Using Period</th>
                                                    <th>Fee</th>
                                                    <th>Deposit</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td><input type = "text"  id="ereservationDate" name="reservationDate" readonly  ></td>
                                                    <td>
                                                         <select name="usingPeriod">
                                                          <option >Choose using Period</option> 
                                                          <option value="10:00-13:00" id="period1">10:00-13:00</option>
                                                          <option value="13:00-16:00" id="period2">13:00-16:00</option>
                                                          <option value="16:00-19:00" id="period3">16:00-19:00</option>
                                                        </select>
                                                     </td>
                                                    <td><input type="text" name="fee" id="fee" readonly value="0.00"></td>
                                                   <td><input type="text" name="deposit" id="deposit"  readonly value="350.00"></td>
                                                   <input type="hidden"  name="token3" value="'.Token::generate(3).'"> 
                                                </tr>       
                                            </tbody>
                                            <tfoot> 
                                                <tr >        
                                                    <td colspan="4"><input type="submit" id="submit" name="el"></td>
                                                </tr> 
                                            </tfoot>      
                                        </table>
                            
                                            
                                    </form>
                               </tr>
                          </tfoot>
                        </table>
            </div>
            <div class="tab-pane" id="4a">
                    <h3>We use css to change the background color of the content to be equal to the tab</h3>
            </div>
        </div>

        
</div><!- exTab1->
<script  type="text/javascript" src="js/partyRoom.js"></script>
        <script  type="text/javascript" src="js/elevator.js"></script>
         <script  type="text/javascript" src="js/test.js"></script>
       <script  type="text/javascript">
        
        var arrGuest ='.$data['busyGRDays'].';
        var arrElevator ='.$data['busyELDays'].';
         var arrParty ='.$data['busyPRDays'].';
        
        elevator(arrElevator);
               
                function myValidation(){
                    
                    var submitForm = true;
                    if($("#reservationDate").val()==""){
                        submitForm = false;
                        alert("Please enter Reservation Date!");
                    }
                    else if($("#startTime").val()>=$("#endTime").val()){
                        submitForm = false;
                        alert("End time must be Later than start time!");
                        }       
                    return submitForm;
                }

            </script>
<script src = "https://code.jquery.com/jquery-1.10.2.js"></script>
<script src = "https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
   <script src="js/main.js"></script>
       
 
';
require_once( '../app/helpers/footer.php');
