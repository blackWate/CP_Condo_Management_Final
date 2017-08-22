<?php

class Email{

	public static function sendEmail($email,$token,$firstname,$unitno)
	{
		if($email&&$token){
		$to = $email;

		$subject = 'Password Reset Request';

		$headers = "From: ". strip_tags(Config::get('website/website_name'))."\r\n";
		$headers .='bcc: '. $to . "\r\n";
		$headers .= "Reply-To: ". strip_tags('no-reply') . "\r\n";
		$headers .= "";
		$headers .= "MIME-Version: 1.0\r\n";
		$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

		$message = '<html><body>';
		$message .= '<p>Hello ,'.$firstname.'</p>';
		$message .= '<p> We got requested to reset your password, if you do this then just click the following link to reset your password, if not just ignore this email,</p>';
		$message .= '<p>Click Following Link To Reset Your Password </p>';
		$message .= '<a href="'.Config::get('website/website_address').'newpasswordset?token='.$token.'&ne='.$unitno.'">click here to reset your password</a>';
		$message .='<p>thank you :) </p></body></html>';
    

     	return mail('', $subject, $message, $headers);



     	}
     	
     	return false;
     	}
		public static function sendNotiEmailWFile($email,$notification,$contentext,$file)
	{
				$to = $email;
             
				$subject = 'Notification - '.$notification;
				
		        $file = $file->getFilePath();
				$content = file_get_contents( $file);
				$content = chunk_split(base64_encode($content));
				$uid = md5(uniqid(time()));
				$filename = basename($file);
				// header
				$header = "From: ". strip_tags(Config::get('website/website_name'))."\r\n";
				$header.= 'bcc: '. $to . "\r\n";
				$header.= "Reply-To: ". strip_tags('no-reply') . "\r\n";
				$header.= "MIME-Version: 1.0\r\n";
				$header.= "Content-Type: multipart/mixed; boundary=".$uid."\r\n\r\n";
                
				// message & attachment
				$message = "\r\n--".$uid."\r\n";
				$message.= "Content-type:text/html; charset='iso-8859-1'\r\n\r\n";
				$message.= '<html><body>';
				$message.=  $contentext;
				$message.='</body></html>';
				$message.= "\r\n--".$uid."\r\n";
				$message.= "Content-Transfer-Encoding: base64\r\n";
				$message.= "Content-Type: application/application/octet-stream;\r\n";
				$message.= "Content-Disposition: attachment; filename=\"".$filename."\"\r\n\r\n";
				$message.= $content;
				$message.= "--".$uid."--";

				$send=mail('', $subject, $message, $header);
				// if($send)
				// 	echo 'email\s sent successfully with attachment';
				// else
				// 	echo 'email\s not been sent ';
				return $send;
		} 
				


    			public static function sendNotiEmailWNoFile($email,$notification,$contentext)
	   {
	   			$to = $email;
             
				$subject = 'Notification - '.$notification;

				$header = "From: ". strip_tags(Config::get('website/website_name'))."\r\n";
				$header.='bcc: '. $to . "\r\n";
				$header.= "Reply-To: ". strip_tags('no-reply') . "\r\n";
				$header.= "MIME-Version: 1.0\r\n";
				$header.= "Content-Type: text/html; charset=ISO-8859-1\r\n";

				$message = '<html><body>';
				$message.=$contentext;
				$message.='</body></html>';
		    

		        $send=mail('', $subject, $message, $header); 
		        

		        if($send)
		        	// echo 'email\s sent successfully no attachment';
		     	
		     	return $send;
		}

			public static function sendReservCon($email,$name,$facilityname,$reservationid,$reservationdate,$startdate,$duration,$fee,$deposit,$status)
	   {
	   			$to = $email;
             
				$subject = 'Your '.$facilityname.' reservation has been confirmed.';

			$headers = "From: ". strip_tags(Config::get('website/website_name'))."\r\n";
			$headers .='bcc: '. $to . "\r\n";
			$headers .= "Reply-To: ". strip_tags('no-reply') . "\r\n";
			$headers .= "";
			$headers .= "MIME-Version: 1.0\r\n";
			$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

			$contentext='<h2 style="color: #2e6c80;">Hi '.$name.',</h2>';
			$contentext.='<h3>Your reservation for the '.$facilityname.' has been confirmed, please check your reservation details.</h3>';
			$contentext.= '<h3>Please contact with&nbsp;us when you have any questions about your reservation, &nbsp;our contact info given below.</h3>';
			$contentext.= '<h3>Kind regards,</h3>';
			$contentext.= '<h3>TSCC2316 Condo Management,</h3>';
			$contentext.= '<p>&nbsp;</p>';
			$contentext.= '<h3>&nbsp;<span style="background-color: #2b2301; color: #fff; display: inline-block; padding: 3px 10px; font-weight: bold; border-radius: 5px;">Your Reservation Details</span>&nbsp;</h3>';
			$contentext.= '<table  style="margin-left: auto; margin-right: auto;" border="1">';
			$contentext.= '<thead>';
			if($facilityname!=="Guest Room")
				$contentext.= '<tr><th>Request#</th><th>Request<br />Date</th><th>Date</th><th>Time Period</th><th>Fee</th><th>Deposit</th><th>Status</th>';
				else{
			$contentext.= '<tr><th>Request#</th><th>Request<br />Date</th><th>Start Date</th><th>Duration</th><th>Fee</th><th>Deposit</th><th>Status</th>';
			$days = ($duration)>1 ? 'days' : 'day' ;
			
		}
			$contentext.= '</thead>';
			$contentext.= '<tbody>';
			$contentext.= '<tr>';
			$contentext.= '<td style="text-align: center;">'.$reservationid.'</td>';
			$contentext.= '<td style="text-align: center;">'.$reservationdate.'</td>';
			$contentext.= '<td style="text-align: center;">'.$startdate.'</td>';
			$contentext.= '<td style="text-align: center;">'.$duration.' '.$days.'</td>';
			$contentext.= '<td style="text-align: center;">'.$fee.' $</td>';
			$contentext.= '<td style="text-align: center;">'.$deposit.' $</td>';
			$contentext.= '<td style="text-align: center;">'.$status.'</td>';
			$contentext.= '</tr>';
			$contentext.= '</tbody>';
			$contentext.= '</table>';
			$contentext.= '<h2 style="color: #2e6c80;">&nbsp;</h2>';
			$contentext.= '<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</p>';
			$contentext.= '<h2 style="color: #2e6c80;">&nbsp;</h2>';
			$contentext.= '<p><strong>&nbsp;</strong></p>';

				$message = '<html><body>';
				$message.=$contentext;
				$message.='</body></html>';
		    
		        $send=mail('', $subject, $message, $headers); 
		        if($send)
		        	// echo '<br>reservation confirmation has been sent to resident<br>';
		     	
		     	return $send;
		}



	}


	
	
