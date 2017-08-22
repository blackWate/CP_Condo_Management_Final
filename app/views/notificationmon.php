<?php
require_once( '../app/helpers/head.php');
require( '../app/helpers/manheader.php');

 echo'
<div class="container-fluid">';
require_once( '../app/helpers/dashboardheader.php');
echo ' <div id="exTab1"  class="container dash1 col-xs-12 col-sm-12 col-md-12 col-lg-12 pull-left"> 
        <legend>Notifications</legend>
        <ul  class="nav nav-pills">
            <li id="" class="active"><a  href="#1a" data-toggle="tab">Active</a></li>
            <li id="" class=""><a  href="#2a" data-toggle="tab">Upcoming</a></li>
            <li id="" class=""><a  href="#3a" data-toggle="tab">All</a></li>
            <li id="" class=""><a href="notification" class="btn btn-success" role="button">New</a></li>
        </ul>
<hr>
         
        <div class="tab-content clearfix">
             
            
            <div class="tab-pane fade active in" id="1a">
                     <table class="table table-striped table-hover table-responsive  "  style="
margin-top: 0px;">
                          <thead class="thead-inverse">
                                <tr>
                                  <th>#</th>
                                  <th>Ref#</th>
                                  <th>Notify  <br>Date</th>
                                  <th>Subject</th>
                                  <th>Effective</th>
                                  <th>Content</th>
                                  <th>File</th>
                                  <th>Edit</th>
                                  <th>Copy</th>
                                  <th>Delete</th>
                                </tr>
                          </thead>
                           <tbody>';
                          if($data['activeNote']){
                              $x=1;
                          foreach ($data['activeNote'] as $actNote) {
                          echo'<tr>
                                  <th scope="row">'.$x.'</th>
                                  <td>'.$actNote->notifid.'</td>
                                  <td>'.$actNote->notedatetime.'</td>
                                  <td>'.$actNote->notesubject.'</td>
                                  <td>'.$actNote->effective.' days</td>
                                  <td><span class="glyphicon glyphicon-eye-open" data-toggle="modal" data-target="#contentact'.$x.'">
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
                                            <div class="modal-body">
                                              '.$actNote->notetext.'
                                            </div>
                                            <div class="modal-footer">
                                              <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                                            </div>
                                          </div>
                                        </div>
                                      </div>  
                                 </td>';
                           //          // if($actNote->filename)
                           //          //   $namet='<span class="glyphicon glyphicon-paperclip" title='.$actNote->filename.'></span>';
                           // echo   '<td >'.$namet.'</td>
                                 echo   '<td >'.$actNote->filename.'</td>
                                 <form  method="post">
                                  <td><button type="submit" formaction="notification" class="btn btn-warning" name="edit" value="edit">Edit</button></td>
                                  <td><button type="submit" formaction="notification" class="btn btn-info" name="copy" value="copy">Copy</button></td>
                                  <td><button type="submit" class="btn btn-danger" name="delete" value="delete" formaction="notificationmon"  >Delete</button></td>
                                  <input type="hidden"  name="notifid" value="'.$actNote->notifid.'">
                                  
                                  </form>
                               </tr>';
                            $x++;

                            }
                          }
 
                     echo'</tbody>
                          <tfoot>
                               <tr>  
                               </tr>
                          </tfoot>
                      </table>
            </div>
            
            <div class="tab-pane fade" id="2a">
                      <table class="table table-striped table-hover table-responsive " style="
margin-top: 0px;">
                          <thead class="thead-inverse">
                                <tr>
                                  <th>#</th>
                                  <th>Ref#</th>
                                  <th>Notify  <br>Date</th>
                                  <th>Subject</th>
                                  <th>Remaining<br>days</th>
                                  <th>Content</th>
                                  <th>File</th>
                                  <th>Edit</th>
                                  <th>Copy</th>
                                  <th>Delete</th>
                                </tr>
                          </thead>
                          <tbody>';
                          if($data['comNote']){
                              $x=1;
                          foreach ($data['comNote'] as $comNote) {
                          echo'<tr >
                                  <th scope="row">'.$x.'</th>
                                  <td>'.$comNote->notifid.'</td>
                                  <td>'.$comNote->notedatetime.'</td>
                                  <td>'.$comNote->notesubject.'</td>
                                  <td>'.$comNote->remain.' days</td>
                                  <td><span class="glyphicon glyphicon-eye-open" data-toggle="modal" data-target="#contentcom'.$x.'">
                                    </span>
                                    <div class="modal fade" id="contentcom'.$x.'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                          <div class="modal-content">
                                            <div class="modal-header">
                                              <h2 class="modal-title" id="exampleModalLabel">Content of the Notification</h2>
                                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                              </button>
                                            </div>
                                            <div class="modal-body">
                                              '.$comNote->notetext.'
                                            </div>
                                            <div class="modal-footer">
                                              <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                                            </div>
                                          </div>
                                        </div>
                                      </div> 
                                  </td>';
                           //          if($comNote->filename)
                           //            $namec='<span class="glyphicon glyphicon-paperclip" title='.$comNote->filename.'></span>';
                           // echo   '<td >'.$namec.'</td>
                              echo   '    <td >'.$comNote->filename.'</td>
                                 <form  method="post">
                                  <td><button type="submit" formaction="notification" class="btn btn-warning" name="edit" value="edit">Edit</button></td>
                                  <td><button type="submit" formaction="notification" class="btn btn-info" name="copy" value="copy">Copy</button></td>
                                  <td><button type="submit" class="btn btn-danger" name="delete" value="delete" formaction="notificationmon"  >Delete</button></td>
                                  <input type="hidden"  name="notifid" value="'.$comNote->notifid.'">
                                  
                                  </form>
                               </tr>';
                            $x++;

                            }
                          }
 
                     echo'</tbody>
                          <tfoot>
                               <tr>  
                               </tr>
                          </tfoot>
                      </table>
            </div>

            <div class="tab-pane fade" id="3a">
                      <table class="table table-striped table-hover table-responsive" style="
margin-top: 0px;">
                          <thead class="thead-inverse">
                                <tr>
                                  <th>#</th>
                                  <th>Ref#</th>
                                  <th>Notification<br>Date<span class="glyphicon glyphicon-chevron-down pull-right" ></th>
                                  <th>Subject</th>
                                  <th>Start<br>Date<
                                    </span></th>
                                  <th>End<br>Date</th>
                                  <th>Content</th>
                                  <th>File</th>
                                  <th>Edit</th>
                                  <th>Copy</th>
                                  <th>Delete</th>
                                </tr>
                          </thead>
                          <tbody>';
                          if($data['allNote']){
                              $x=1;
                          foreach ($data['allNote'] as $allNote) {
                          echo'<tr class="'.$allNote->background.'" >
                                  <th scope="row">'.$x.'</th>
                                  <td>'.$allNote->notifid.'</td>
                                  <td>'.$allNote->notedatetime.'</td>
                                  <td>'.$allNote->notesubject.'</td>
                                  <td>'.$allNote->notestartdate.'</td>
                                  <td>'.$allNote->notexdate.'</td>
                                  <td><span class="glyphicon glyphicon-eye-open" data-toggle="modal" data-target="#contentall'.$x.'">
                                    </span>
                                    <div class="modal fade" id="contentall'.$x.'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                          <div class="modal-content">
                                            <div class="modal-header">
                                              <h2 class="modal-title" id="exampleModalLabel">Content of the Notification</h2>
                                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                              </button>
                                            </div>
                                            <div class="modal-body">
                                              '.$allNote->notetext.'
                                            </div>
                                            <div class="modal-footer">
                                              <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                                            </div>
                                          </div>
                                        </div>
                                      </div>  
                                  </td>';
                           //          if($allNote->filename)
                           //            $name='<span class="glyphicon glyphicon-paperclip" title='.$allNote->filename.'></span>';
                           // echo   '<td >'.$name.'</td>
                                  echo   '<td >'.$allNote->filename.'</td>
                                <form  method="post">
                                  <td><button type="submit" formaction="notification" class="btn btn-warning" name="edit" value="edit">Edit</button></td>
                                  <td><button type="submit" formaction="notification" class="btn btn-info" name="copy" value="copy">Copy</button></td>
                                  <td><button type="submit" class="btn btn-danger" name="delete" value="delete" formaction="notificationmon"  >Delete</button></td>
                                  <input type="hidden"  name="notifid" value="'.$allNote->notifid.'">
                                  
                                  </form>
                               </tr>';
                            $x++;

                            }
                          }
 
                     echo'</tbody>
                          <tfoot>
                               <tr>  
                               </tr>
                          </tfoot>

                           
                      </table>
            </div>

        	<div class="tab-pane fade" id="4a">
                 <h1>something</h1>     
            </div>
        </div>
        
</div>
</div>
 ';

require_once( '../app/helpers/footer.php');
