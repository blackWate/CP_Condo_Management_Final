<?php

require_once '../app/helpers/head.php';
require_once '../app/helpers/header.php';

echo '<content>
          <div class="form" action="logout" method="post">
            <div>
              <div id="login">   
                <h1 style="color:white">'.$data['error'].'</h1>
                <form  action ="logout">
                  <input type="submit" class="button button-block" name="btn-logout" value="Log Out"> 
                </form>
              </div> 
            </div>   
          </div> 
        </content>';
require_once( '../app/helpers/footer.php');