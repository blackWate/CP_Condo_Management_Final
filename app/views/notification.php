 <?php
require_once( '../app/helpers/head.php');
require( '../app/helpers/manheader.php');

 echo'
<div class="container-fluid">';
require_once( '../app/helpers/dashboardheader.php');

 echo'<div class="panel-body dash col-xs-12 col-sm-7 pull-left">

             
          <form action="notification" method="post" class="form-horizontal col-xs-12 col-lg-12" role="form" enctype="multipart/form-data">

              <div class="form-group">
                <legend>New Notification</legend>
              </div>

              <div class="form-group">
                <div class="input-group col-md-12">
                  <div class="input-group-addon">?</div>
                     <input type="text" name="subject" id="inputSubject" placeholder="Subject" class="form-control" value="'.$data['edtdata']->notesubject.'" required="required"  title="Subject">
                  </div>
                </div>
              
              <div class="form-group ">
                <div class="input-group col-md-12">
                  <div class="input-group-addon">@</div>
                    <textarea id="to" rows="2" name="sendTo" class="form-control clearable" rows="12"  placeholder="Send To" title="Send To" data-validation="custom" data-validation-optional="true" data-validation-regexp="^[\W]*([\w+\-.%]+@[\w\-.]+\.[A-Za-z]{2,4}[\W]*,{1}[\W]*)*([\w+\-.%]+@[\w\-.]+\.[A-Za-z]{2,4})[\W]*$">'.$data['edtdata']->notesendto.'</textarea>
                    <span id="clear" class="glyphicon glyphicon-remove-circle "></span>
                </div>
                </div>

                 <div class="form-group "> 
                <div class="form-group col-md-6 pull-left">
                <div class="input-group col-md-12">
                  <div class="input-group-addon"><span class="glyphicon glyphicon-calendar" aria-hidden="true"></span></div>
                     <input id="stdate"   type="date" name="stdate" id="inputSubject" placeholder="Start Date" class="form-control" value="'.$data['edtdata']->notestartdate.'"  title="Start Date">
                  </div>
                </div>


                <div class="form-group col-md-6 pull-right">
                <div class="input-group col-md-12">
                  <div class="input-group-addon"><span class="glyphicon glyphicon-calendar" aria-hidden="true"></span></div>
                     <input id="exdate"  type="date" name="exdate" id="inputSubject" placeholder="Expiry Date" class="form-control" value="'.$data['edtdata']->notexdate.'"  title="Expiry Date">
                  </div>
                </div>
              </div>
               <div class="form-group">
                <div class="input-group col-md-10 pull-right">
                  <div class="input-group-addon"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></div>
                     <textarea class="form-control tiny" name="context" placeholder="Notification details" rows="12"  >'.$data['edtdata']->notetext.'</textarea>
                  </div>
                </div>

                 <div class="form-group">
                <div class="input-group col-md-10 pull-right">
                  <div class="input-group-addon"><span class="glyphicon glyphicon-open-file" aria-hidden="true"></span></div>
                    <input id="fileToUpload" type="file" name="fileToUpload"   class="form-control" title="File To Upload"   data-max-size="'.$data['filesize'].'kb">
                  </div>
                </div>

      
                <input type="hidden"  name="token" value="'.Token::generate().'"> 
                <input type="hidden"  name="notifid" value="'.$data['edtdata']->notifid.'">
                <div class="form-group">
                <div class="input-group col-md-10 pull-right">
                  <button type="submit" name="button" value="submit" class="btn btn-primary '.$data['submitH'].'">Submit</button>
                  <button type="submit" name="button" value="update" class="btn btn-primary '.$data['updateH'].'">Update</button>
                 </div>
                </div>

                <div class="form-group col-md-10 pull-right">
                    <div class="input-group col-md-1 pull-left">
                       <input id="noEmail"  type="checkbox" name="noEmail"  class="form-control" value="noemail" style="width: 15px; height: 15px;     margin-top: 2px;">
                     </div>
                     Don\'t send email just save it.
                </div>




          </form>

           </div>';
require_once( '../app/helpers/EmailBox.php');


            echo  '</div>';
require_once( '../app/helpers/footer.php');