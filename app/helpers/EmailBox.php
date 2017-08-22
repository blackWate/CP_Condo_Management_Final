<?php
echo'<div class="col-xs-12 col-lg-3 sidebar-offcanvas " role="navigation">

   <div class="col-lg-12"  style="padding: 0px;">
      <div class="panel-primary" style="margin-bottom: 0px; margin-top:1px">
        <div class="panel-heading">
            <h3 class="panel-title">EMAIL BOX</h3>
           
        </div>
        <div class="list-group-item">
        <input id="sEmail" type="text" class="form-control search-query " placeholder="Search....">
        </div>
        <div class="panel-body"  style="padding: 0px; padding-top: 1px;">


         <div class="col-lg-12"  style="padding: 0px;">
      <div class="panel panel-primary" style="margin-bottom: 0; margin-top:1px">
        <div class="panel-heading">
            <h3 class="panel-title">People</h3>
           <span class="pull-right clickable" style="margin-top: -20px;"><i class="glyphicon glyphicon-chevron-up"></i></span>
        </div>
        <div id="people" class="panel-body"  style="padding: 0px;height: auto;overflow: scroll;max-height: 290px;">
        <ul class="list-group">';
        foreach ($data['emails'] as $eData){
     echo'     <li class="list-group-item" title="'.$eData->email.'"><span class="badge pull-left">'.$eData->unitno.'</span>&emsp;'.$eData->fullname.'</li>';
        }
     echo'      </ul>
        </div>
    </div>
    </div>


              <div class="col-lg-12"  style="padding: 0px;">
      <div class="panel panel-primary" style="margin-bottom: 0; margin-top:1px">
        <div class="panel-heading">
            <h3 class="panel-title">Groups</h3>
           <span class="pull-right clickable" style="margin-top: -20px;"><i class="glyphicon glyphicon-chevron-up"></i></span>
        </div>
        <div id="groups" class="panel-body"  style="padding: 0px;">
        
        <ul class="list-group">
          <li class="list-group-item" title="'.$data['resemails'].'">All Residents</li>
          <li class="list-group-item" title="'.$data['emailsNR'].'">Non-resident Owners</li>
          <li class="list-group-item">1st Floor</li>
          <li class="list-group-item">2st Floor</li>
          <li class="list-group-item">3st Floor</li>
          <li class="list-group-item">4st Floor</li>
          <li class="list-group-item">5st Floor</li>
          <li class="list-group-item">6st Floor</li>
          <li class="list-group-item">7st Floor</li>
        </ul>
        </div>
    </div>
    </div>

       



        </div>
    </div>
    </div>
     <script  type="text/javascript">
          emails='.json_encode($data['emails']).';
          </script>

    </div>

      ';