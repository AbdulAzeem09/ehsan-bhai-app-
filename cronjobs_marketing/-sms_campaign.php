<?php


	include('connection.php');
	date_default_timezone_set("Asia/Dubai");
	$date = date('H:i');
	$end_time = strtotime($date . ' + 1 minute'); //gets timestamp
	//
	//convert into whichever format you need 
	$start_time = date('H:i', $start_time) . '<br>'; //it prints 2011-04-08 08:34:49
	$end_time = date('H:i', $end_time); // . '<br>'; //it prints 2011-04-08 08:34:49

	$today = date('Y-m-d');
	$campaignssql = mysql_query("SELECT * FROM sms_email_campaigns WHERE status = 'pending' AND type = 'Sms' AND time <= '" . $end_time . "' AND date = '" . $today . "'");


	if ($campaignssql) {
		while ($campaigns = mysql_fetch_array($campaignssql)) {

			$current_date_time = date('Y-m-d H:i');
			$campaign_id = $campaigns['id'];
			$user_group_type = $campaigns['user_or_group'];
			$userIds = array();
			if ($user_group_type == 'group') {
				$campaigngroupsIDs = array();
				$groupsql = mysql_query("SELECT * FROM email_campaign_user_groups WHERE campaign_id = '" . $campaigns['id'] . "'");
				while ($campaigngroups = mysql_fetch_array($groupsql)) {
					$campaigngroupsIDs[] = $campaigngroups['group_id'];
				}
				$campaigngroupsIDs = implode(',', $campaigngroupsIDs);
				$sqlUserGroups = mysql_query("SELECT distinct spProfiles_idspProfiles FROM spprofiles_has_spgroup WHERE spGroup_idspGroup IN ($campaigngroupsIDs)");
				while ($rowsUserGroup = mysql_fetch_array($sqlUserGroups)) {
					$userIds[] = $rowsUserGroup ['spProfiles_idspProfiles'];
				}
			}
			if ($user_group_type == 'user') {
				$sqlusers = mysql_query("SELECT * FROM email_campaign_user_groups WHERE campaign_id = '" . $campaigns['id'] . "'");

				while ($usersIds = mysql_fetch_array($sqlusers)) {
					$userIds[] = $usersIds['user_id'];
				}
			}

			if ($userIds) {
				$usersIds = implode(',', $userIds);
				$sqluserdata = mysql_query("SELECT spProfileEmail ,spProfileName, spProfilePhone from spprofiles WHERE idspProfiles IN ($usersIds) ");
				//$rs2 = @mysql_num_rows($sql2 > 0);
				if ($sqluserdata) {
					$mobile_no = array();
					$i = 0;
					while ($userdata = mysql_fetch_array($sqluserdata)) {
						if($userdata['spProfilePhone']==""){
							$mobile_no[] = 0;
						}
						else{
							$mobile_no[] = $userdata['spProfilePhone'];
						}
						$i = $i + 1;
					}

					//$totalCount = count($mobile_no);

					$mobile_numbers = implode(', ', $mobile_no);
					//$campaing_limit_ok = TRUE;
					//$checkcountsql = mysql_query("SELECT * FROM campaign_count WHERE campaign_type = 'Sms' AND user_id = '" . $campaigns['user_id'] . "'");
					//$checkcountresult = mysql_fetch_array($checkcountsql);

					//if ($checkcountresult) {
						//$count = $checkcountresult['count'];
						//if ($count >= $i) {

							//$campaing_limit_ok = TRUE;
						//} else {
							//$campaing_limit_ok = FALSE;
						//}
					//}
					
						$user = "jouple"; //your username
						$password = "Xendxb!5544"; //your password
						// '12345678, 971554080, 23232323, 2232323, 123456789, 97150260, 55407826'; //
						$mobilenumbers = $mobile_numbers; ////'+971 50 343 5663'; // '+923216359974'; //$mobile_numbers; //enter Mobile numbers comma seperated. //'+971 50 343 5663'; '+923216359974'; //
						//$message = $rows['text'];//"test messgae"; //enter Your Message
						$senderid = "UAE"; //Your senderid
						$messagetype = "N"; //Type Of Your Message
						$DReports = "Y"; //Delivery Reports
						$url = "http://www.smscountry.com/SMSCwebservice_Bulk.aspx";  //callbackURL=http://www.jouple.com/marketing/public/save/sms
						$message = urlencode($campaigns['text']);
						$ch = curl_init();
						if (!$ch) {
							die("Couldn't initialize a cURL handle");
						}
						$ret = curl_setopt($ch, CURLOPT_URL, $url);
						curl_setopt($ch, CURLOPT_POST, 1);
						curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
						curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
						curl_setopt($ch, CURLOPT_POSTFIELDS,
								// print_r($mobilenumbers);die;
								"User=$user&passwd=$password&mobilenumber=$mobilenumbers&message=$message&sid=$senderid&mtype=$messagetype&DR=$DReports");
						$ret = curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
						//If you are behind proxy then please uncomment below line and provide your proxy ip with port.
						// $ret = curl_setopt($ch, CURLOPT_PROXY, "PROXY IP ADDRESS:PORT");
						$curlresponse = curl_exec($ch); // execute
						// print_r($ch);die;
						if (curl_errno($ch))
							echo 'curl error : ' . curl_error($ch);
						if (empty($ret)) {
							// some kind of an error happened
							$c_status = " Some kind of crul error ";
							mysql_query("INSERT INTO sms_campaign_system_logs (campaign_id, status, date_time) VALUES ('" . $campaign_id . "', '" . $c_status . "', '" . $current_date_time . "')");
							die(curl_error($ch));
							curl_close($ch); // close cURL handler
						} else {
							$info = curl_getinfo($ch);
							curl_close($ch); // close cURL handler
							if (strpos($curlresponse, "OK") == 0) {
								$job_id = substr($curlresponse, 3);



								//mysql_query("UPDATE campaign_count SET count = count - $totalCount WHERE user_id = '" . $campaigns['user_id'] . "' AND campaign_type = 'sms' ");
								//die('sent');
								mysql_query("UPDATE sms_email_campaigns SET status = 'Ok', job_id = " . $job_id . "  WHERE id = " . $campaigns['id'] . " ");

								//mysql_query("INSERT INTO campaign_log (campaign_id) VALUES('1')");


								$c_status = " SUCCESS ";
								mysql_query("INSERT INTO sms_campaign_system_logs (campaign_id, status, date_time) VALUES ('" . $campaign_id . "', '" . $c_status . "', '" . $current_date_time . "')");
							} else {
								$c_status = " NO Job ID found in response ";
								mysql_query("INSERT INTO sms_campaign_system_logs (campaign_id, status, date_time) VALUES ('" . $campaign_id . "', '" . $c_status . "', '" . $current_date_time . "')");
							}
						}

						echo 'SMS sent';
					
				}
			} else {
				$c_status = " NO Users found for this campaign ";
				mysql_query("INSERT INTO sms_campaign_system_logs (campaign_id, status, date_time) VALUES ('" . $campaign_id . "', '" . $c_status . "', '" . $current_date_time . "')");
			}
		}
	} else {
		//NO CAMPAIGNS
	}
?>