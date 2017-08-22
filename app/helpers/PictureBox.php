<?php
echo'<div class="col-xs-12 col-lg-2 col-md-2 sidebar-offcanvas " role="navigation">

   <div class="col-lg-12"  style="padding: 0px;">
      <div class="panel-primary" style="margin-bottom: 0px; margin-top:1px">
        <div class="panel-heading">
            <h3 class="panel-title">PICTURE BOX</h3>
           
        </div>
        <div class="list-group-item"><input id="sEmail" type="text" class="form-control search-query" placeholder="Search...."></div>
        <div class="panel-body"  style="padding: 0px; padding-top: 1px;">


         <div class="col-lg-12"  style="padding: 0px;">
      <div class="panel panel-primary" style="margin-bottom: 0; margin-top:1px">
        <div class="panel-heading">
            <h3 class="panel-title">Residents</h3>
           <span class="pull-right clickable" style="margin-top: -20px;"><i class="glyphicon glyphicon-chevron-up"></i></span>
        </div>
        <div id="photos" class="panel-body"  style="padding: 0px;height: auto;overflow: scroll;max-height: 690px;">
        <ul class="list-group">';
        // print_r($data['photos']);
        foreach ($data['photos'] as $photo){
          if($photo->photo!='')
            $source=Config::get('filepath/photos_residents3').$photo->photo;
     echo'     <li class="list-group-item" title="'.$source.'"><img src="'.Config::get('filepath/photos_residents').$photo->photo.'" class="img-thumbnail img-circle">&emsp;<span class="badge">'.$photo->unitno.'</span><br>'.$photo->fullname.'</li>';
        }
     echo'      </ul>
        </div>
    </div>
    </div>

       
        </div>
    </div>
    </div>
    

    </div>

      ';