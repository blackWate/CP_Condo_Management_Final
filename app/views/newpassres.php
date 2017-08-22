<?php

require_once( '../app/helpers/head.php');
require_once( '../app/helpers/header.php');

echo '<content>
      <div class="form">
      <div>
        <div id="login">';
          if($stmt->execute(array(":upass"=>$nPass,":uid"=>$id)))
          echo '<h1 style="color:white">Your Password is reset successfully</h1>';
            else echo '<h1 style="color:white">Oops something went wrong. Try again ,Please</h1>';

         echo '<form  action="login" >
          
          
          <input type="submit" class="button button-block" name="btn-login" value="Log In"> 
          </form>
        </div> 
      </div>   
    </div> 
</content>';
require_once( '../app/helpers/footer.php');