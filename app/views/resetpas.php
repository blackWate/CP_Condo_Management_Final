<?php

require_once '../app/helpers/head.php';
require_once '../app/helpers/header.php';

echo '
     <content>
      <div  class="form">
        <div id="emailBox">
          <div id="login">   
            <h1 style="color:white">Please enter your email</h1>
            
            <form action="forgotpass" method="post">
              <div class="field-wrap">
              <label>
                Email<span class="req">*</span>
              </label>
              <input id="email" type="email" name="email" required autocomplete="off" style="color:white"/>
            </div>
            <div class="text" style="color:white"><p>Please Click confirm and check your email for resetting your password!</p></div>';
                
              if(isSet($data['error']))
                  echo '<h3 class="button button-block" style="text-align:center">'.$data['error'].'</h3>';
           
                
         echo '<input type="submit" class="button button-block" name="submit" value="Send"/>
            </form>
          </div> 
        </div>   
      </div> 
    </content>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="js/index.js"></script>';
require_once( '../app/helpers/footer.php');