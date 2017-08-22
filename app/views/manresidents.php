 <?php
require_once( '../app/helpers/head.php');
require( '../app/helpers/manheader.php');

 echo'
<div class="container-fluid">';
require_once( '../app/helpers/dashboardheader.php');

echo ' <div id="exTab1"  class="container col-xs-12 col-sm-12 col-md-12 col-lg-12 pull-left dash1"> 
			
        <legend>Residents</legend>
        <ul  class="nav nav-pills">
            <li id="" class="active"><a  href="#1a" data-toggle="tab">Renters <span class="badge">'.count($data['renters']).'</span></a></li>
            <li id="" class=""><a  href="#2a" data-toggle="tab">Owners-R <span class="badge">'.count($data['owners']).'</span></a></li>
            <li id="" class=""><a  href="#3a" data-toggle="tab">Owners-NR <span class="badge">'.count($data['ownerNRs']).'</span></a></li>
			      <li ><a href="manresidentsnew" class="btn btn-success" role="button">New</a></li>
            
			      <li style="margin-left: 80px;">  
			            <form action="manresidents" method="post" class="search-form">
			                <div class="form-group has-feedback">
			            		<label for="search" class="sr-only">Search</label>
			            		<input type="text" class="form-control" name="search" id="search" placeholder="search">
			              		<span class="glyphicon glyphicon-search form-control-feedback"></span>
			            	</div>
			            </form>
			

            </li>
        </ul>
<hr>
         
        <div class="tab-content clearfix">
             
            
            <div class="tab-pane fade active in" id="1a">
                     <table id="residents" class="table table-striped table-hover table-responsive"  style="
margin-top: 0px;">
                          <thead class="thead-inverse">
                                <tr>
                                  <th>#</th>
                                  <th>Ref#</th>
                                  <th>Picture</th>
                                  <th>Unit#</th>
                                  <th>First<br>Name</th>
                                  <th>Last<br>Name</th>
                                  <th>Unit<br>Owner</th>
                                  <th>Email</th>
                                  <th>Status</th>
                                  <th></th>
                                  <th></th>
                                </tr>
                          </thead>
                           <tbody>';
                          if($data['renters']){
                              $x=1;
                          foreach ($data['renters'] as $renter) {
                          echo'<tr >
                           <form  method="post">
                                  <th scope="row">'.$x.'</th>
                                  <td >'.$renter->userid.'</td>
                                  <td><img src="'.Config::get('filepath/photos_residents').$renter->photo.'" class="img-thumbnail img-circle"></td>
                                  <td>'.$renter->unitno.'</td>

                                  <td>'.$renter->firstname.'</td>
                                  <td>'.$renter->lastname.'</td>
                                  <td>'.$renter->ownername.'</td>
                                  <td>'.$renter->email.'</td>
                                  <td></td>
                                   <td><button type="submit" formaction="manresidentsnew" class="btn btn-warning" name="edit" value="edit" data-toggle="tooltip" data-placement="top" title="Edit"><span class="glyphicon glyphicon-pencil"></span></button></td>
                                  <td><button type="submit" class="btn btn-danger" name="clear" value="clear" formaction="manresidents" data-toggle="tooltip" data-placement="top" title="Clear">x</button></td>
                                  <input type="hidden"  name="userid" value="'.$renter->userid.'">
                                  <input type="hidden"  name="unitno" value="'.$renter->unitno.'">
                                  </tr>
                                  <tr class="emer">
                                  	<td colspan="13" class="tp">Emergency Contact #:<span class="badge badge-danger">'.$renter->emergencyphone.'</span> &emsp;&emsp;&emsp;Contact Name:'.$renter->emergencycontact.'&emsp;&emsp;&emsp;Relation:'.$renter->emergencyrelation.'</td>
                                  </tr>
                                  <tr class="ph">
                                    <td colspan="13" class="tpm">Phone Numbers:
                                       M '.$renter->mobilephone.'&emsp;&emsp;&emsp;
                                       H '.$renter->homephone.'&emsp;&emsp;&emsp;
                                       W '.$renter->workphone.'
                                    </td>
                                    
                                  </tr>
                                  </form>
                               ';
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
                                  <th>Picture</th>
                                  <th>Unit#</th>
                                  <th>First<br>Name</th>
                                  <th>Last<br>Name</th>
                                  <th>Email</th>
                                  <th>Units<br>Owned</th>
                                  <th>Status</th>
                                  <th></th>
                                  <th></th>
                                </tr>
                          </thead>
                          <tbody>';
                          if($data['owners']){
                              $x=1;
                          foreach ($data['owners'] as $owner) {
                            $splitOU=explode(',', $owner->ownerunits);
                            $index = array_search($owner->unitno,$splitOU);
                            unset($splitOU[$index]);
                            $splitOU= array_values($splitOU);
                          echo'<tr >
                                  <form  method="post">
                                  <th scope="row">'.$x.'</th>
                                  <td>'.$owner->userid.'</td>
                                  <td><img src="'.Config::get('filepath/photos_residents').$owner->photo.'" class="img-thumbnail img-circle"></td>
                                  <td>'.$owner->unitno.'</td>
                                  <td>'.$owner->firstname.'</td>
                                  <td>'.$owner->lastname.'</td>
                                  <td>'.$owner->email.'</td>
                                  <td>';
                                  
                                    if(count($splitOU)>0)
                                for ($i = 0; $i < count($splitOU); $i++) {
                            
                             echo'
                              <button type="submit" formaction="manresidents" class="btn btn-primary" name="search" value="'.$splitOU[$i].'" data-toggle="tooltip" data-placement="top" title="Unit# '.$splitOU[$i].'">'.$splitOU[$i].'</button>';
                                  }
                             echo'</td>
                                  <td></td>
                                  <td></td>
                                  
                                  <td><button type="submit" formaction="manresidentsnew" class="btn btn-warning" name="edit" value="edit" data-toggle="tooltip" data-placement="top" title="Edit"><span class="glyphicon glyphicon-pencil"></span></button></td>
                                  <td><button type="submit" class="btn btn-danger" name="delete" value="delete" formaction="manresidents" data-toggle="tooltip" data-placement="top" title="Delete">x</button></td>
                                  <input type="hidden"  name="userid" value="'.$owner->userid.'">
                                  </tr>
                                  <tr class="emer">
                                    <td colspan="13" class="tp">Emergency Contact #:<span class="badge badge-danger">'.$owner->emergencyphone.'</span> &emsp;&emsp;&emsp;Contact Name:'.$owner->emergencycontact.'&emsp;&emsp;&emsp;Relation:'.$owner->emergencyrelation.'</td>
                                  </tr>
                                  <tr class="ph">
                                    <td colspan="13" class="tpm">Phone Numbers:
                                       M '.$owner->mobilephone.'&emsp;&emsp;&emsp;
                                       H '.$owner->homephone.'&emsp;&emsp;&emsp;
                                       W '.$owner->workphone.'
                                    </td>
                                    
                                  </tr>
                                  </form>
                               ';
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
                                  <th>Picture</th>
                                  <th>Unit#</th>
                                  <th>First<br>Name</th>
                                  <th>Last<br>Name</th>
                                  <th>Email</th>
                                  <th>Units<br>Owned</th>
                                  <th>Status</th>
                                  <th></th>
                                  <th></th>
                                </tr>
                          </thead>
                          <tbody>';
                          if($data['ownerNRs']){
                              $x=1;
                          foreach ($data['ownerNRs'] as $ownerNR) {
                             $splitONRU=explode(',', $ownerNR->ownerunits);
                          echo'<tr >
                          <form  method="post">
                                  <th scope="row">'.$x.'</th>
                                  <td>'.$ownerNR->userid.'</td>
                                  <td><img src="'.Config::get('filepath/photos_residents').$ownerNR->photo.'" class="img-thumbnail img-circle"></td>
                                  <td>'.$ownerNR->unitno.'</td>
                                  <td>'.$ownerNR->firstname.'</td>
                                  <td>'.$ownerNR->lastname.'</td>
                                  <td>'.$ownerNR->email.'</td>
                                  <td>';
                                  
                                    if(count($splitONRU)>0)
                                for ($i = 0; $i < count($splitONRU); $i++) {
                            
                             echo'
                              <button type="submit" formaction="manresidents" class="btn btn-primary" name="search" value="'.$splitONRU[$i].'" data-toggle="tooltip" data-placement="top" title="Unit# '.$splitONRU[$i].'">'.$splitONRU[$i].'</button>';
                                  }
                             echo'
                                  </td>
                                  <td></td>
                                  <td></td>
                                
                                  <td><button type="submit" formaction="manresidentsnew" class="btn btn-warning" name="edit" value="edit" data-toggle="tooltip" data-placement="top" title="Edit"><span class="glyphicon glyphicon-pencil"></span></button></td>
                                  <td><button type="submit" class="btn btn-danger" name="delete" value="delete" formaction="manresidents" data-toggle="tooltip" data-placement="top" title="Delete">x</button></td>
                                  <input type="hidden"  name="userid" value="'.$ownerNR->userid.'">
                                   </tr>
                                  <tr class="ph">
                                    <td colspan="13" class="tpm">Phone Numbers:
                                       M '.$ownerNR->mobilephone.'&emsp;&emsp;&emsp;
                                       H '.$ownerNR->homephone.'&emsp;&emsp;&emsp;
                                       W '.$ownerNR->workphone.'
                                    </td>
                                    
                                  </tr>
                                  </form>
                               ';
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