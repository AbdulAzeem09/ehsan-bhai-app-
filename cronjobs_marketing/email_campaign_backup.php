<?php

//echo 'ffffffffff';die;
 	include('connection.php');
	date_default_timezone_set("Asia/Dubai");
	
	//$pass = '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'; // not the key, but the token
	//$url = 'https://api.sendgrid.com/';
	
	
		
	$date = date('H:i');
	$start_time = strtotime($date. ' - 1 minute');//gets timestamp
	$end_time = strtotime($date. ' + 9 minute');//gets timestamp

	$today = date('Y-m-d');
	//echo $today;die; 
	//convert into whichever format you need 
	$start_time = date('H:i', $start_time).'<br>';//it prints 2011-04-08 08:34:49
	$end_time = date('H:i', $end_time).'<br>';//it prints 2011-04-08 08:34:49
	
	

	//echo 'ffffffffff';die;
//echo $start_time . ' ' . $end_time;die;

	$sql = mysql_query("SELECT * FROM sms_email_campaigns WHERE status = 'pending' AND type = 'Email' AND time > '".$start_time."' AND time < '".$end_time."' AND date = '".$today."' ");
	$rs = mysql_num_rows($sql);
	

    //while( $row = mysql_fetch_assoc( $sql)){
    //    $new_array[] = $row; // Inside while loop
//    }

   
	//$totalCampaigns = count($new_array);
	

	    
	{
	    
	    while ( $rows = mysql_fetch_array( $sql) ) {

    	//foreach($new_array as $rows )
	        {
	    
	 //   echo '<pre>'; print_r($rows['user_id'] );die;
	 
	   // echo '<pre>'; print_r($rows);die;
		//Get user limit of his quota.
		$sql = mysql_query("SELECT * FROM campaign_count WHERE campaign_type = 'email' AND user_id = '".$rows['user_id']."'");
		$result = mysql_fetch_array($sql);
		
		if( $result ) {
		$count = $result['count'];
		
		//echo $count;die;
		
		//Check if user does not exeed the limit of his quota.
		if ( $count > 1) {
		
		$user_group_type = $rows['user_or_group'];
		
		if ( $user_group_type == 'group') {
		
		$sql4 = mysql_query("SELECT * FROM email_campaign_user_groups WHERE campaign_id = '".$rows['id']."'");
		//$result = mysql_fetch_array($sql);
		
		while($rows4 = mysql_fetch_array($sql4))
			{
			
			$groupdIds[] = $rows4['group_id'];
				//var_dump($rows2['email']);die;
			}
                $groupsIds = implode(',', $groupdIds);
                	
                $sqlUserGroups = mysql_query("SELECT distinct user_id FROM user_groups WHERE group_id in ($groupsIds)");
               
                while($rowsUserGroup = mysql_fetch_array($sqlUserGroups ))
			{
			
			$userIds[] = $rowsUserGroup ['user_id'];
				//var_dump($rows2['email']);die;
			}
			
			$usersIds= implode(',', $userIds);
			
			//echo '<pre>'; print_r($usersIds );die;
		//Get email from email campaign user table.
		$sqlEmail = mysql_query("SELECT * FROM email_campaign_user WHERE id in ($usersIds)");
		while($rowsUsersEmail = mysql_fetch_array($sqlEmail ))
			{
			
			$userEmails[] = $rowsUsersEmail ['email'];
				//var_dump($rows2['email']);die;
			}
			
		}
			
			if ( $user_group_type == 'user') {
			//die('users');
			
			$users = mysql_query("SELECT * FROM email_campaign_user_groups WHERE campaign_id = '".$rows['id']."'");
		//$result = mysql_fetch_array($usersData );
		//echo '<pre>'; print_r($result );die;
			//echo $rows['id'];die;
			while($usersIds= mysql_fetch_array($users ))
				{
			
				$userIds[] = $usersIds['user_id'];
				//var_dump($rows2['email']);die;
			}
               		 $usersIds = implode(',', $userIds);
                	
				//echo '<pre>'; print_r($usersIds );die;
			}
		//echo '<pre>'; print_r($usersIds );die;
			//echo 'yes';die;
		//echo $rows['user_id'];die;
		//$sql2 = mysql_query("SELECT email , name from email_campaign_user WHERE user_id = '".$rows['user_id']."'");
		$sql2 = mysql_query("SELECT email , name from email_campaign_user WHERE id IN ($usersIds)");
		$rs2 = @mysql_num_rows($sql2>0);
		//$rows2 = mysql_fetch_array($sql2)
	//	var_dump($rows2 );die;
		
		{
		    $i = 0;
			while($rows2 = mysql_fetch_array($sql2))
			{
			
				$email[] = $rows2['email'];
				$i = $i+ 1;
				//var_dump($rows2['email']);die;
			
			}
		//	$totalCount = $i;
			
		//	echo $totalCount;die;
			
			$totalCount = count($email);
			
		//	echo $totalCount;die;
		
			$emails = implode(', ', $email);
			
			//echo $rows['id'];die;
		//	var_dump($emails);die;
			
			$api_key="key-d87ef5ce795f42ae0226ffc0a74eae19";/* Api Key got from https://mailgun.com/cp/my_account */
 			$domain ="www.ondotz.com";
			//$emails = 'umairkhalil36@gmail.com, khalil@jouple.com';
			
			
		//	print_r($emails);die;
			$ch = curl_init();
 			curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
 			curl_setopt($ch, CURLOPT_USERPWD, 'api:'.$api_key);
 			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
 			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
 			curl_setopt($ch, CURLOPT_URL, 'https://api.mailgun.net/v2/'.$domain.'/messages');
 			curl_setopt($ch, CURLOPT_POSTFIELDS, array(
  				'from' => 'Ondotz <support@ondotz.com>',
  				'to' => $emails, //$rows2['email'],
  				'subject' => $rows['name'],
  				'html' => $rows['text']
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

	
			mysql_query("UPDATE campaign_count SET count = count - $totalCount WHERE user_id = '".$rows['user_id']."' AND campaign_type = 'email' ");
			
			mysql_query("UPDATE sms_email_campaigns SET status = 'Ok', job_id = '" . $job_id . "'  WHERE id = ".$rows['id']);
		    
		    
		    	echo 'Email sent';
	
		//}
		
		
		
	}
	} else {

		echo 'You have reached you quota limit.';
	
	}
	} else {
	    
	 //   mysql_query('INSERT INTO campaign_count (user_id, count, created_at, last_sent_date, campaign_type) VALUES ('$rows["user_id"]','10000','date('Y-m-d')','date('Y-m-d')','email') ');
	//die('ddddddddddddd');
		//$sql = "INSERT INTO MyGuests (firstname, lastname, email)
//VALUES ('John', 'Doe', 'john@example.com')";

		//mysql_query("INSERT INTO campaign_count (user_id, count, created_at, last_sent_date, campaign_type) VALUES ('$rows['user_id']', '1', 'date('Y-m-d')', 'date('Y-m-d')', 'email'));
	}
	//}
	
}
//}
}


?>