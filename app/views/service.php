 <?php

require_once( '../app/helpers/head.php');
require_once( '../app/helpers/header.php');
if($data['showchat'])
require ( '../app/helpers/ChatBox.php');
 echo'
<div class="container-fluid">
        <ul  class="nav nav-pills col-md-offset-1">
            <li id="p" class="active"><a  href="#1a" data-toggle="tab">My Service Requests</a></li>
            <li id="g" class=""><a class="btn btn-success" role="button" href="#2a" data-toggle="tab">New</a></li>

        </ul>

      <div class="tab-content clearfix" style="margin-top: 40px;">
              
              <div class="tab-pane col-xs-12 col-md-12" id="2a">
          
                    <form action="service" method="post" class="col-xs-12 col-lg-12" role="form" enctype="multipart/form-data">

                        <div class="form-group">
                          <div class="input-group col-md-12">
                            <div class="input-group-addon">?</div>
                               <input type="text" name="subject" id="inputSubject" placeholder="Subject" class="form-control" value="" required="required"  title="Subject">
                            </div>
                          </div>

                        <div class="form-group col-sm-3 col-md-3" style="margin-top: 6px;">
                          <div class="input-group col-sm-3 col-md-3 pull-right">
                          <select name="servicetype" class="custom-select">
                            <option selected>Service Type</option>
                            <option value="Plumbing">Plumbing</option>
                            <option value="Electric">Electric</option>
                            <option value="Leaking">Leaking</option>
                            <option value="Locksmith">Locksmith</option>
                            <option value="Broken glass">Broken glass</option>
                            <option value="Other">Other</option>
                          </select>
                           </div>
                      </div>
                     

                        <div class="form-group">
                          <div class="input-group col-md-10 pull-right">
                            <div class="input-group-addon"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></div>
                               <textarea class="form-control tiny" name="context" rows="12" placeholder="Service request details"  ></textarea>
                            </div>
                          </div>

                
                        <input type="hidden"  name="token" value="'.Token::generate().'"> 

                        <div class="form-group">
                          <div class="input-group col-md-10 pull-right">
                            <button type="submit" name="button" value="submit" class="btn btn-primary " style="margin-top: 30px;">Submit</button>
                           
                           </div>
                          </div>

                    </form>
                 </div><!-1a tab pane-> 
       





              <div class="tab-pane col-xs-12 col-md-12  active" id="1a">
                      <ul  class="nav nav-pills">
                        <li id="g" class="active"><a  href="#1a-1" data-toggle="tab">Awaiting<span class="badge">'.count($data['servicesA']).'</span></a></li>
                        <li id="p" class=""><a  href="#2a-1" data-toggle="tab">Ongoing<span class="badge">'.count($data['servicesO']).'</span></a></li>
                        <li id="e" class=""><a  href="#3a-1" data-toggle="tab">Resolved<span class="badge">'.count($data['servicesC']).'</span></a></li>
                      </ul>

                <div class="tab-content clearfix">
                      <div class="tab-pane align-middle active" id="1a-1">
                        <table class="table table-striped table-hover table-responsive">
                              <thead class="thead-inverse">
                                <tr>
                                  <th>#</th>
                                  <th>Request#</th>
                                  <th>Request<br>Date</th>
                                  <th>Subject</th>
                                  <th>Service<br>Type</th>
                                  <th>Description</th>
                                  <th>Status</th>
                                  <th>Chat</th>
                                  <th>Delete</th>
                                </tr>
                              </thead>
                              <tbody>';
                          if($data['servicesA']){
                              $x=1;
                          foreach ($data['servicesA'] as $serviceA) {
                          echo'<tr >
                                  <th scope="row">'.$x.'</th>
                                  <td>'.$serviceA->serviceid.'</td>
                                  <td>'.$serviceA->requestdate.'</td>
                                  <td>'.$serviceA->subject.'</td>
                                  <td>'.$serviceA->servicetype.'</td>
                                  <td><span class="glyphicon glyphicon-eye-open" data-toggle="modal" data-target="#contentA'.$x.'">
                                    </span>
                                    <div class="modal fade" id="contentA'.$x.'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                          <div class="modal-content">
                                            <div class="modal-header">
                                              <h2 class="modal-title" id="exampleModalLabel">Service Request Details</h2>
                                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                              </button>
                                            </div>
                                            <div class="modal-body">
                                              '.$serviceA->description.'
                                            </div>
                                            <div class="modal-footer">
                                              <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                                            </div>
                                          </div>
                                        </div>
                                      </div></td>
                                  <td>'.$serviceA->status.'</td>
                                  <form  method="post">
                                  
                                  <td>
                                      <button  type="submit" formaction="service"  class="btn btn-warning chat glyphicon glyphicon-comment" name="chat" value="chat" data-toggle="tooltip" data-placement="top" title="Chat with Manager" reservetype="services" reserveid='.$serviceA->serviceid.'></button>
                                        <input  type="hidden"  name="reserveid" value="'.$serviceA->serviceid.'"> 
                                   </td>  
                                  
                                  <td><button type="submit" class="btn btn-danger" name="delete" value="delete" formaction="service">Delete</button></td>
                                </tr>
                                <input type="hidden"  name="serviceid" value="'.$serviceA->serviceid.'">
                                </form>';
                            $x++;

                            }
                          }
 
                     echo'</tbody>
                              <tfoot>
                              </tfoot>
                            </table>
                        </div><!-tab pane 1a-1->
                    
                      <div class="tab-pane align-middle " id="2a-1">
                             <table class="table table-striped table-hover table-responsive">
                              <thead class="thead-inverse">
                                <tr>
                                  <th>#</th>
                                  <th>Request#</th>
                                  <th>Request<br>Date</th>
                                  <th>Subject</th>
                                  <th>Service<br>Type</th>
                                  <th>Description</th>
                                  <th>Status</th>
                                  <th>Chat</th>
                                  <th>Delete</th>
                                </tr>
                              </thead>
                              <tbody>';
                          if($data['servicesO']){
                              $x=1;
                          foreach ($data['servicesO'] as $serviceO) {
                          echo'<tr >
                                  <th scope="row">'.$x.'</th>
                                  <td>'.$serviceO->serviceid.'</td>
                                  <td>'.$serviceO->requestdate.'</td>
                                  <td>'.$serviceO->subject.'</td>
                                  <td>'.$serviceO->servicetype.'</td>
                                  <td><span class="glyphicon glyphicon-eye-open" data-toggle="modal" data-target="#contentO'.$x.'">
                                    </span>
                                    <div class="modal fade" id="contentO'.$x.'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                          <div class="modal-content">
                                            <div class="modal-header">
                                              <h2 class="modal-title" id="exampleModalLabel">Service Request Details</h2>
                                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                              </button>
                                            </div>
                                            <div class="modal-body">
                                              '.$serviceO->description.'
                                            </div>
                                            <div class="modal-footer">
                                              <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                                            </div>
                                          </div>
                                        </div>
                                      </div></td>
                                  <td>'.$serviceO->status.'</td>
                                  <form  method="post">
                                  <td>
                                      <button  type="submit" formaction="service"  class="btn btn-warning chat glyphicon glyphicon-comment" name="chat" value="chat" data-toggle="tooltip" data-placement="top" title="Chat with Manager" reservetype="services" reserveid='.$serviceO->serviceid.'></button>
                                        <input  type="hidden"  name="reserveid" value="'.$serviceO->serviceid.'"> 
                                   </td>  

                                  
                                  <td><button type="submit" class="btn btn-danger" name="delete" value="delete" formaction="service">Delete</button></td>
                                </tr>
                                <input type="hidden"  name="serviceid" value="'.$serviceO->serviceid.'">
                                </form>';
                            $x++;

                            }
                          }
 
                     echo'</tbody>
                              <tfoot>
                              </tfoot>
                            </table>
                        </div><!-tab pane 2a-1->


                    <div class="tab-pane align-middle " id="3a-1">
                              <table class="table table-striped table-hover table-responsive">
                              <thead class="thead-inverse">
                                <tr>
                                  <th>#</th>
                                  <th>Request#</th>
                                  <th>Request<br>Date</th>
                                  <th>Subject</th>
                                  <th>Service<br>Type</th>
                                  <th>Description</th>
                                  <th>Status</th>
                                  <th>Chat</th>
                                  <th>Delete</th>
                                </tr>
                              </thead>
                              <tbody>';
                          if($data['servicesC']){
                              $x=1;
                          foreach ($data['servicesC'] as $serviceC) {
                          echo'<tr >
                                  <th scope="row">'.$x.'</th>
                                  <td>'.$serviceC->serviceid.'</td>
                                  <td>'.$serviceC->requestdate.'</td>
                                  <td>'.$serviceC->subject.'</td>
                                  <td>'.$serviceC->servicetype.'</td>
                                  <td><span class="glyphicon glyphicon-eye-open" data-toggle="modal" data-target="#contentC'.$x.'">
                                    </span>
                                    <div class="modal fade" id="contentC'.$x.'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                          <div class="modal-content">
                                            <div class="modal-header">
                                              <h2 class="modal-title" id="exampleModalLabel">Service Request Details</h2>
                                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                              </button>
                                            </div>
                                            <div class="modal-body">
                                              '.$serviceC->description.'
                                            </div>
                                            <div class="modal-footer">
                                              <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                                            </div>
                                          </div>
                                        </div>
                                      </div></td>
                                  <td>'.$serviceC->status.'</td>
                                  
                                   <form  method="post">
                                  <td>
                                      <button  type="submit" formaction="service"  class="btn btn-warning chat glyphicon glyphicon-comment" name="chat" value="chat" data-toggle="tooltip" data-placement="top" title="Chat with Manager" reservetype="services" reserveid='.$serviceC->serviceid.'></button>
                                        <input  type="hidden"  name="reserveid" value="'.$serviceC->serviceid.'"> 
                                   </td>

                                  <td><button type="submit" class="btn btn-danger" name="delete" value="delete" formaction="service">Delete</button></td>
                                </tr>
                                <input type="hidden"  name="serviceid" value="'.$serviceC->serviceid.'">
                                </form>';
                            $x++;

                            }
                          }
 
                     echo'</tbody>
                              <tfoot>
                              </tfoot>
                            </table>
                    </div><!-tab pane 3a-1->

                    <div class="tab-pane" id="4a-1">
                            <h3>We use css to change the background color of the content to be equal to the tab</h3>
                       </div><!-tab pane 4a-1->

                         
               
                     </div><!-2a tab content->
                      


                 </div><!-2a tab pane->
               <div class="tab-pane col-xs-12 col-md-10  col-md-offset-1 active" id="3a">  
              </div><!-3a tab content->
     
      </div><!-tab-content->
</div><!-container-fluid->
';
require_once( '../app/helpers/footer.php');