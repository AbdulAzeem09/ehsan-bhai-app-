<?php

//die('ffffffffff');
include('connection.php');
date_default_timezone_set("Asia/Dubai");
//$date = date('Y-m-d');
$date = date('H:i');
//$start_time = strtotime($date. ' - 1 minute');//gets timestamp
$end_time = strtotime($date. ' + 1 minute');//gets timestamp


//convert into whichever format you need 
$start_time = date('H:i', $start_time).'<br>';//it prints 2011-04-08 08:34:49
$end_time = date('H:i', $end_time).'<br>';//it prints 2011-04-08 08:34:49

//echo $start_time . ' ' . $end_time;die;
$today = date('Y-m-d');

$sql = mysql_query("SELECT * FROM sms_email_campaigns WHERE status = 'pending' AND type = 'Sms' AND time <= '".$end_time."' AND date = '".$today."'");
$rs = mysql_num_rows($sql);
//var_dump($rs);die;
$myfile = fopen("newfile.txt", "w") or die("Unable to open file!");
        //fwrite($myfile, print_r($checkresult, true));
        fwrite($myfile, "SELECT * FROM sms_email_campaigns WHERE status = 'pending' AND type = 'Sms' AND time <= '".$end_time."' AND date = '".$today."'");
        fclose($myfile);
        while( $row = mysql_fetch_assoc( $sql)){
           $new_array[] = $row; // Inside while loop
        }
    
       // $rows = mysql_fetch_assoc( $sql);
       // echo '<pre>'; print_r($new_array );die;
{
	//while($rows = mysql_fetch_array($sql))
	
	foreach( $new_array as $rows)
	{
	    
	    //$new_array[] = mysql_fetch_assoc( $sql);
	    
	    // echo '<pre>'; print_r($new_array );die;
		
		$sql = mysql_query("SELECT * FROM campaign_count WHERE campaign_type = 'Sms' AND user_id = '".$rows['user_id']."'");
		$result = mysql_fetch_array($sql);
		
		if( $result ) {
		$count = $result['count'];
	//	echo $count;die;
		//Check if user does not exeed the limit of his quota.
		if ( $count > 100) {

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
			
		//	echo '<pre>'; print_r($usersIds );die;
		//Get email from email campaign user table.
		$sqlEmail = mysql_query("SELECT * FROM email_campaign_user WHERE id in ($usersIds)");
		while($rowsUsersEmail = mysql_fetch_array($sqlEmail ))
			{
			
			$userEmails[] = $rowsUsersEmail ['email'];
				//var_dump($rows2['email']);die;
			}
			
		}
			
			if ( $user_group_type == 'user') {
			
			
			$users = mysql_query("SELECT * FROM email_campaign_user_groups WHERE campaign_id = '".$rows['id']."'");
		//$result = mysql_fetch_array($sql);
		
			while($usersIds= mysql_fetch_array($users ))
				{
			
				$userIds[] = $usersIds['user_id'];
				//var_dump($rows2['email']);die;
			}
               		 $usersIds = implode(',', $userIds);
                	
			//	echo '<pre>'; print_r($usersIds );die;
			}
		
		
		$sql2 = mysql_query("SELECT email ,name, mobile_no from email_campaign_user WHERE id IN ($usersIds) ");
		$rs2 = @mysql_num_rows($sql2>0);
		{
		     $i = 0;
			while($rows2 = mysql_fetch_array($sql2))
				{
				//echo $rows2['mobile_no'];die;
				//var_dump($rows2['mobile_no']);die;
					//mail($rows2['email'],$rows['name'],$rows['text']);
					//echo $rows2['email'].$rows['name'].$rows['text'];
					 $mobile_no[] = $rows2['mobile_no'];
					 $i = $i+ 1;
					 
				}
			//	$totalCount = $i;
				
			//	echo $totalCount;die;
				
				$totalCount = count($mobile_no);
				
			    //echo $totalCount;die;
				
				$mobile_numbers = implode(', ', $mobile_no);
			//	echo '<pre>'; print_r($mobile_numbers);die;
		
				$user = "jouple"; //your username
	            $password = "Xendxb!5544"; //your password
	           // '12345678, 971554080, 23232323, 2232323, 123456789, 97150260, 55407826'; //
	            $mobilenumbers =  $mobile_numbers; ////'+971 50 343 5663'; // '+923216359974'; //$mobile_numbers; //enter Mobile numbers comma seperated. //'+971 50 343 5663'; '+923216359974'; //
	            //$message = $rows['text'];//"test messgae"; //enter Your Message
	            $senderid="UAE"; //Your senderid
	            $messagetype="N"; //Type Of Your Message
	            $DReports="Y"; //Delivery Reports
	            $url="http://www.smscountry.com/SMSCwebservice_Bulk.aspx";  //callbackURL=http://www.jouple.com/marketing/public/save/sms
	            $message = urlencode($rows['text']);
	            $ch = curl_init();
	            if (!$ch){
	                die("Couldn't initialize a cURL handle");
	            }
	            $ret = curl_setopt($ch, CURLOPT_URL,$url);
	            curl_setopt ($ch, CURLOPT_POST, 1);
	            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
	            curl_setopt ($ch, CURLOPT_POSTFIELDS,
	                // print_r($mobilenumbers);die;
	            "User=$user&passwd=$password&mobilenumber=$mobilenumbers&message=$message&sid=$senderid&mtype=$messagetype&DR=$DReports");
	            $ret = curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	            //If you are behind proxy then please uncomment below line and provide your proxy ip with port.
	            // $ret = curl_setopt($ch, CURLOPT_PROXY, "PROXY IP ADDRESS:PORT");
	            $curlresponse = curl_exec($ch); // execute
	            // print_r($ch);die;
	            if(curl_errno($ch))
	            echo 'curl error : '. curl_error($ch);
	            if (empty($ret)) {
	            // some kind of an error happened
	            die(curl_error($ch));
	            curl_close($ch); // close cURL handler
	            } else {
	            $info = curl_getinfo($ch);
	            curl_close($ch); // close cURL handler
	            $job_id = substr($curlresponse, 3);
	            
	
	            
	            mysql_query("UPDATE campaign_count SET count = count - $totalCount WHERE user_id = '".$rows['user_id']."' AND campaign_type = 'sms' ");
		//die('sent');
		mysql_query("UPDATE sms_email_campaigns SET status = 'Ok', job_id = " . $job_id . "  WHERE id = ".$rows['id']." ");
		
		mysql_query("INSERT INTO campaign_log (campaign_id) VALUES('1')");
		
	            //echo '<pre>'; print_r($curlresponse);die;
				}
				
				
		//echo 'sms sent';
		
		
		echo 'SMS sent';
	}
	
	} else {
		echo 'You have reached you quota limit.';
	}
	} else {
		echo 'no';
	}
	}
	}
	
?>