<?php

	
		
		$email_test = array();
		$i = 0;
		$emails = "adnanghouri97@gmail.com";
		$name = "Adnan";
		$subject = "Health-Testing";
		$txt = "This is multiple testing email";		
					
					
		$api_key = "ae6e0fc1f1fcf9db61dfc51f1d4831a8-9c988ee3-65f27b72"; /* Api Key got from https://mailgun.com/cp/my_account */
		$domain = "dev.thesharepage.com";
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
		curl_setopt($ch, CURLOPT_USERPWD, 'api:' . $api_key);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
		curl_setopt($ch, CURLOPT_URL, 'https://api.mailgun.net/v2/' . $domain . '/messages');
		curl_setopt($ch, CURLOPT_POSTFIELDS, array(
			//'X-Mailgun-Recipient-Variables' => $myJSON,
			'from' => 'thesharepage <info@thesharepage.com>',
			'to' =>  $emails, //'adnan@jouple.com'
			'subject' => $subject,
			'html' => $txt,
			'o:tracking-clicks' => TRUE
		));
		$result = curl_exec($ch);
		curl_close($ch);
		//$string = '{ "id": "<20170424074159.23658.65668.63B3D50D@www.ondotz.com>", "message": "Queued. Thank you." }';
		//$output = explode(',', $result);
		$output = explode(',', $result);
		$messageId = $output[0];
		$string2 = ltrim($messageId, '{');
		$string3 = ltrim($string2, ' "id": "<');
		$string4 = trim($string3);
		$string5 = ltrim($string4, '"id": "<');
		$job_id = rtrim($string5, '>"');
		//mysql_query("UPDATE campaign_count SET count = count - $totalCount WHERE user_id = '" . $campaigns['user_id'] . "' AND campaign_type = 'email' ");
		echo $job_id;
					
					
				