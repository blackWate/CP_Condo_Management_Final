 <?php


 echo'
<div class="container-fluid">
<!--top nav start=======-->
<nav class="navbar navbar-inverse top-navbar" id="top-nav">
  <div class="container-fluid">
    <div class="navbar-header">      
      <a class="navbar-brand" href="#"><img class="img-thumbnail img-circle" src="'.Config::get('filepath/photos_residents').Session::get('photo').'" width="64" height="64"></a>
        <a href="javascript:;" class="sidebar-toggle">
        <i class="fa fa-bars"></i></a>
        <span class="close-btn" id="hide-btn"><i class="fa fa-times" aria-hidden="true"></i></span>
    </div>
      
         
    </div>  
</nav>    
<!--    top nav end===========-->

  <!-- begin SIDE NAV USER PANEL -->     
<div class="container-1" id="user-profil">                  
<ul id="side" class="nav navbar-nav-1 side-nav">
    
 <li class="side-user">  
    <p class="name tooltip-sidebar-logout">'.Session::get('name').'
    <a href="logout"><i class="fa fa-sign-out"></i></a>
    </p>        
 </li>
    
    
    
    <li class="dashboard">
   <a class="active" href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a>
 </li>
    
    <li class="panel">
   <a href="javascript:;" data-toggle="collapse" data-target="#residents">
   <i class="fa fa-address-card"></i> Residents <i class="fa fa-caret-down pull-right"></i>
   </a>
    
  <ul class="collapse nav" id="residents">
    <li>
        <a href="manresidents"><i class="fa fa-angle-double-right"></i> All</a>
    </li>
    <li>
        <a href="manresidentsnew"><i class="fa fa-angle-double-right"></i> New</a>
    </li>
  </ul>
</li>
    
    <li class="panel">
   <a href="manreservgroom" >
   <i class="fa fa-calendar"></i> Reservations </i>
   </a>
    
</li>
    
    <li class="panel">
   <a href="javascript:;" data-toggle="collapse" data-target="#notification">
   <i class="fa fa-bell"></i> Notifications <i class="fa fa-caret-down pull-right"></i>
   </a>
    
  <ul class="collapse nav" id="notification">
    <li>
        <a href="notificationmon"><i class="fa fa-angle-double-right"></i> All</a>
    </li>
    <li>
        <a href="notification"><i class="fa fa-angle-double-right"></i> New</a>
    </li>
  </ul>
</li>
    
</li>
    
    <li class="panel">
   <a href="manservices" >
   <i class="fa fa-briefcase"></i> Services </i>
   </a>
    
</li>
                    
</ul>      
    </div>    
    <!-- end SIDE NAV USER PANEL --> 
';
// require_once( '../app/helpers/adminSidebar.php');

// echo'<div class="col-xs-12 col-sm-10" ><h1 style="color: blueviolet;">Under Construction</h1></div>';


// require_once( '../app/helpers/footer.php');