<?php

require_once '../app/helpers/head.php';
require_once '../app/helpers/header.php';

echo '<content>
          <div class="form">
            <div>
              <div id="login">   
                <h1 style="color:white">Password reset link has been sent to your email. Please check.</h1>
                <form  action ="login">
                  <input type="submit" class="button button-block" name="btn-login" value="Log In"> 
                </form>
              </div> 
            </div>   
          </div> 
        </content>';
require_once( '../app/helpers/footer.php');