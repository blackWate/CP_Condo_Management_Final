<?php
echo'

<div class="popup-box chat-popup" id="qnimate">

    		  <div id="type" class="popup-head" title="'.$data['type'].'">
				<div id="chatHeader" class="popup-head-left pull-left" title="'.$data['chatParams'][0]->reservationid.'"><img id="residentPic" title="'.$data['chatParams'][0]->sender.'"  src="'.Config::get('filepath/photos_residents').$data['chatParams'][0]->senderpic.'" alt="picresident">&emsp;<span id="receiver" title="'.$data['chatParams'][0]->receiver.'">'.$data['chatParams'][0]->senderfname.'</span>&emsp;#'.$data['chatParams'][0]->reservationid.'

				</div>
					  <div class="popup-head-right pull-right">
						
						
						<button data-widget="remove" id="removeClass" class="chat-header-button pull-right" type="button"><i class="glyphicon glyphicon-off"></i></button>
                      </div>
			  </div>
			<div id="popmessages" class="popup-messages" >
    		
			
			

			
			</div>
			<div class="popup-messages-footer">
	
			<textarea id="status_message" placeholder="Type a message..." rows="10" cols="40" name="message"></textarea>
			<div class="btn-footer">
			
			<button id="sendMessage"  class="bg_none pull-right"><i class="glyphicon glyphicon-send
glyphicon"></i> </button>


			</div>
			</div>
	  </div>
	 <script>
    getChatMessages('.$data['chatParams'][0]->reservationid.',\''.$data['type'].'\','.$data['chatParams'][0]->sender.');
    </script>  
      
	  ';

