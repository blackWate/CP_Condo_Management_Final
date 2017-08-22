<?php
require_once( '../app/helpers/head.php');
require( '../app/helpers/manheader.php');

 echo'
<div class="container-fluid">';
require_once( '../app/helpers/dashboardheader.php');
require_once ( '../app/helpers/PictureBox.php');
echo'<div dash class="panel-body col-xs-12 col-sm-8 pull-left">
   
             
          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 toppad" >
    <form action="manresidentsnew" method="post">
   
          <div class="panel panel-info">
            <div class="panel-heading">';
            $str = ($data['resident']) ? $data['resident'][0]->firstname.' '.$data['resident'][0]->lastname.' - Unit# '.$data['resident'][0]->unitno.'<span class="pull-right">Unit Owner: '.$data['resident'][0]->ownername.'</span>' : '' ;
      echo'<h3 class="panel-title">'.$str.'</h3>
            </div>
            <div class="panel-body">
              <div class="row">';
              $photo= ($data['resident']) ? Config::get('filepath/photos_residents3').$data['resident'][0]->photo : Config::get('filepath/photos_residents3').'empty.jpg';
          echo'<div class="col-md-3 col-lg-3 " align="center"> <img id="resPhoto" alt="User Pic" src="'.$photo.'"  class="img-circle img-responsive img-thumbnail img" height="300" width="300"> 
              <div class="form-group"  style="margin-top: 15px;margin-left: -15px;">
                <div class="input-group col-md-10">
                  
                    
                    <input id="pic" type="hidden"  name="pic" value="">
                  </div>
                </div>

            </div>
                
                <div class=" col-md-9 col-lg-9 "> 
                  <table class="table table-user-information newres">
                    <tbody>
                     <tr>
                        <td>
                          Unit# <span class="badge">'.$data['resident'][0]->unitno.'</span>
                        </td>
                      </tr>
                      <tr>
                        <td>First Name:</td>
                        <td><input type="text" name="fname" id="fname" placeholder="" class="form-control" value="'.$data['resident'][0]->firstname.'" required="required"  title="First Name"></td>
                      </tr>
                       <tr>
                        <td>Last Name:</td>
                        <td><input type="text" name="lname" id="lname" class="form-control" value="'.$data['resident'][0]->lastname.'" required="required"  title="Last Name"></td>
                      </tr>
                      <tr>
                        <td>Email:</td>
                        <td><input type="email" name="email" id="email" class="form-control" value="'.$data['resident'][0]->email.'" required="required"  title="Email"></td>
                      </tr>
                      <tr>
                        <td>Unit Owner:</td>
                        <td>';
                          if($data['resList']){
                           echo'
                            <select name="owner">';
                          foreach ($data['resList'] as $res) {
                         
                            if($res->fullname==$data['resident'][0]->ownername)
                           echo'   <option value="'.$res->userid.'" selected >'.$res->fullname.'</option>
                              ';
                              else
                                echo'   <option value="'.$res->userid.'">'.$res->fullname.'</option>
                              ';
                            }
                          }
 
                     echo'</select>
                        </td>
                      </tr>
                      <tr>
                      <td colspan="2" style="text-align:left;padding-left: 37px;"><strong>Phone</strong></td>
                      </tr>
                      <tr>
                        <td>Mobile:</td>
                        <td><input type="text" name="mobile"  class="form-control  phone" value="'.$data['resident'][0]->mobilephone.'"   title="Mobile Phone #"></td>
                      </tr>
                      <tr>
                        <td>Home:</td>
                        <td><input type="text" name="home" class="form-control phone" value="'.$data['resident'][0]->homephone.'"   title="Home Phone #"></td>
                      </tr>
                      <tr>
                        <td>Work:</td>
                        <td><input type="text" name="work" class="form-control phone" value="'.$data['resident'][0]->workphone.'"   title="Work Phone #"></td>
                      </tr>
                       <tr>
                      <td colspan="2" style="text-align:left;padding-left: 37px;"><strong>Emergency</strong></td>
                      </tr>
                      <tr>
                        <td>Phone:</td>
                        <td><input type="text" name="ephone"  class="form-control  phone" value="'.$data['resident'][0]->emergencyphone.'"  title="Emergency Phone #"></td>
                      </tr>
                      <tr>
                        <td>Contact:</td>
                        <td><input type="text" name="econtact" class="form-control" value="'.$data['resident'][0]->emergencycontact.'"   title="Emergency Contact"></td>
                      </tr>
                      <tr>
                        <td>Relationship:</td>
                        <td><input type="text" name="erelation" class="form-control" value="'.$data['resident'][0]->emergencyrelation.'"  title="Relationship"></td>
                      </tr>
                     
                    </tbody>
                  </table>
                 
                 <div class="form-group">
                <div class="input-group col-md-10 pull-right">
                
                  <button type="submit" name="button" value="submit" class="btn btn-primary '.$data['submitH'].'">Submit</button>
                  <button type="submit" name="button" value="update" class="btn btn-primary '.$data['updateH'].'">Update</button>
                  <input type="hidden"  name="unitno" value="'.$data['resident'][0]->unitno.'">
                  
                  </form>
                 </div>
                </div>
                </div>

                </div>
              </div>
            </div>
                 
            
          </div>
        </div>';





require_once( '../app/helpers/footer.php');