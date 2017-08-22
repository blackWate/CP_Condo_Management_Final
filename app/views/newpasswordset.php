<?php

require_once( '../app/helpers/head.php');
require_once( '../app/helpers/header.php');

echo '<content>
        <div class="form">
        <div>
          <div id="login">   
              <h1 style="color:#d7caca">Reset Password</h1>
              <form action="newpasswordset" method="post">
              <div class="field-wrap">
                <label>
                  New Password<span class="req">*</span>
                </label>
                <input style="color:white" id="nPass" name="nPass" type="password" required autocomplete="off"/>
              </div>
              <div class="field-wrap">
                <label>
                  Verify Password<span class="req">*</span>
                </label>
                <input style="color:white" id="vPass"  type="password" required autocomplete="off"/>
                <input type="hidden"  name="token" value="'.$_GET['token'].'">
                <input type="hidden"  name="ne" value="'.$_GET['ne'].'">
              </div>      
              <button type="submit" id="myButton" class="button button-block" style="display:none" />Reset</button>
            </form>
          </div> 
        </div>  
      </div>

      <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
      <script src="js/index.js"></script>

      <script type="text/javascript">

          $("#vPass").keyup(function(){
    
            if($("#vPass").val()==$("#nPass").val()){
                $("#vPass").css("background-color", "green");
                $("#myButton").css("display", "block");
            }
              else{
                  $("#vPass").css("background-color", "red");
                   $("#myButton").css("display", "none");
              }
            });


           $("#nPass").keyup(function(){
    
            if($("#vPass").val()==$("#nPass").val()){
                $("#vPass").css("background-color", "green");
                $("#myButton").css("display", "block");
            }
            else{
                $("#vPass").css("background-color", "red");
                 $("#myButton").css("display", "none");
            }
            });
      </script>
    </content>';

require_once( '../app/helpers/footer.php');