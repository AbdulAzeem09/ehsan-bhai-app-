<?php

	include('connection.php');
	date_default_timezone_set("Asia/Dubai");
	$date = date('H:i');
	$start_time = strtotime($date . ' - 1 minute'); //gets timestamp
	$end_time = strtotime($date . ' + 1 minute'); //gets timestamp

	$today = date('Y-m-d');
	//echo $today;die; 
	//convert into whichever format you need 
	$end_time = date('H:i', $end_time); // . '<br>'; //it prints 2011-04-08 08:34:49

	$today = date('Y-m-d');
	$campaignssql = mysql_query("SELECT * FROM sms_email_campaigns WHERE status = 'pending' AND type = 'Email' AND time <= '" . $end_time . "' AND date = '" . $today . "'");

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
				//GET USER NAME AND EMAIL FROM USER TO SEND EMAIL
				$sqluserdata = mysql_query("SELECT spProfileName ,spProfileEmail FROM spprofiles WHERE idspProfiles IN ($usersIds) ");
				//$rs2 = @mysql_num_rows($sql2 > 0);
				if ($sqluserdata) {
					$email = array();
					$email_test = array();
					$i = 0;
					while ($userdata = mysql_fetch_array($sqluserdata)) {
						$email[] = $userdata['spProfileEmail'];
						$s_test['spProfileName'] = $userdata['spProfileName'];
						$e_test[$userdata['spProfileEmail']]=$s_test;
						$i = $i + 1;
					}
					$myJSON = json_encode($e_test);

					$totalCount = count($email);
					$emails = implode(', ', $email);

					//$campaing_limit_ok = TRUE;
					//THIS IS CHEK  FOR USER EMAIL SENT MONTHLY ONLY 2000 OR LIMIT 3000
					//$checkcountsql = mysql_query("SELECT * FROM campaign_count WHERE campaign_type = 'email' AND user_id = '" . $campaigns['user_id'] . "'");
					//$checkcountresult = mysql_fetch_array($checkcountsql);

					//if ($checkcountresult) {
						//$count = $checkcountresult['count'];
						//if ($count >= $i) {

						//	$campaing_limit_ok = TRUE;
						//} else {
							//$campaing_limit_ok = FALSE;
						//}
					//}
					

					$api_key = "key-2664c40f3b1c2991fb51e72fa4ecd13a"; /* Api Key got from https://mailgun.com/cp/my_account */
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
						'to' => 'info@thesharepage.com', //$rows2['email'],
						'bcc' => $emails, //$rows2['email'],
						'subject' => $campaigns['name'],
						'html' => $campaigns['text'],
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

					mysql_query("UPDATE sms_email_campaigns SET status = 'Ok', job_id = '" . $job_id . "'  WHERE id = " . $campaigns['id']);


					echo 'Email sent';


					$c_status = " SUCCESS ";
					mysql_query("INSERT INTO email_campaign_system_logs (campaign_id, status, date_time) VALUES ('" . $campaign_id . "', '" . $c_status . "', '" . $current_date_time . "')");
				
					
				}
			}elseif($importIds){
				
				$usersIds = implode(',', $importIds);
				//GET USER NAME AND EMAIL FROM USER TO SEND EMAIL
				$sqluserdata = mysql_query("SELECT name ,email FROM email_campaign_user WHERE id IN ($usersIds) ");
				//$rs2 = @mysql_num_rows($sql2 > 0);
				if ($sqluserdata) {
					$email = array();
					$email_test = array();
					$i = 0;
					while ($userdata = mysql_fetch_array($sqluserdata)) {
						$email[] = $userdata['email'];
						$s_test['name'] = $userdata['name'];
						$e_test[$userdata['email']]=$s_test;
						$i = $i + 1;
					}
					$myJSON = json_encode($e_test);
					$totalCount = count($email);
					$emails = implode(', ', $email);
					$api_key = "key-2664c40f3b1c2991fb51e72fa4ecd13a"; /* Api Key got from https://mailgun.com/cp/my_account */
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
						'to' => 'info@thesharepage.com', //$rows2['email'],
						'bcc' => $emails, //$rows2['email'],
						'subject' => $campaigns['name'],
						'html' => $campaigns['text'],
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
					mysql_query("UPDATE sms_email_campaigns SET status = 'Ok', job_id = '" . $job_id . "'  WHERE id = " . $campaigns['id']);
					echo 'Email sent';
					$c_status = " SUCCESS ";
					mysql_query("INSERT INTO email_campaign_system_logs (campaign_id, status, date_time) VALUES ('" . $campaign_id . "', '" . $c_status . "', '" . $current_date_time . "')");
					
				}
			
				
				
			} else {
				$c_status = " NO Users found for this campaign ";
				mysql_query("INSERT INTO email_campaign_system_logs (campaign_id, status, date_time) VALUES ('" . $campaign_id . "', '" . $c_status . "', '" . $current_date_time . "')");
			}
		}
	} else {
		//NO CAMPAIGNS
	}
?>