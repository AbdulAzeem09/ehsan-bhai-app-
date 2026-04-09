
<?php
	include('../univ/baseurl.php');
	function sp_autoloader($class){
		include '../mlayer/' . $class . '.class.php';
	}
	spl_autoload_register("sp_autoloader");
	$fm 	= new _freelance_milestone;
	$p  	= new _postingview;
	$pr 	= new _spprofiles;
	$fps 	= new _freelance_project_status;
	$fa 	= new _freelance_account;
	$sph 	= new _sharepage_history;


	if(isset($_GET['milestone']) && $_GET['milestone'] >0){
		$chkOld = $fm->aprove($_GET['milestone']);

		$result =$fm->read($_GET['milestone']);
		if($result ){
			$row = mysqli_fetch_assoc($result);
			$milestonePrice 	= $row['milestonePrice'];
			$milestoneId 		= $_GET['milestone'];
			$projectId 			= $row['spPosting_idspPostings'];

			$result2 = $p->read($projectId);
			//echo $p->ta->sql;
			if($result2){
				$row2 = mysqli_fetch_assoc($result2);
				$BusinessUserId = $row2['spUser_idspUser'];
				//amount detect from business acount

				$result3 = $fps->readAceptid($projectId);
				if($result3){
					$row3 = mysqli_fetch_assoc($result3);
					$freelancerId = $row3['spProfiles_idspProfiles'];

					$result4 = $pr->readUserId($freelancerId);
					//echo $pr->ta->sql;
					if($result4){
						$row4 = mysqli_fetch_assoc($result4);
						$freelancerUserId = $row4['spUser_idspUser'];

						//get last price of freelance business and sharepae
						//freelance blnc
						$result5 = $fa->readUserBlnc($freelancerUserId);
						if($result5){
							$row5 = mysqli_fetch_assoc($result5);
							$freelanceBlnc = $row5['fa_current_amount'];
						}else{
							$freelanceBlnc = 0;
						}
						//business blnc
						$result6 = $fa->readUserBlnc($BusinessUserId);
						if($result6){
							$row6 = mysqli_fetch_assoc($result6);
							$businessBlnc = $row6['fa_current_amount'];
						}else{
							$businessBlnc = 0;
						}
						//sharepage acount blanc read
						$result7 = $sph->readSharepageBlnc();
						if($result7){
							$row7 = mysqli_fetch_assoc($result7);
							$SharepageBlnc = $row7['sharepage_currentAmount'];
						}else{
							$SharepageBlnc = 0;
						}
						//new amount of business 
						$businessCurrnAmt = $businessBlnc - $milestonePrice;
						//calculation of amount transer
						$sharePageAmtSend = $milestonePrice * 0.05;
						$freelanceAmtSend = $milestonePrice - $sharePageAmtSend;
						//freelance Current Amount
						$frelanceCurrnAmt = $freelanceBlnc + $freelanceAmtSend;
						//sharepage Balance
						$sharepageCurrnAmt = $sharePageAmtSend + $SharepageBlnc;

						//set connection for custom query
						$conn = _data::getConnection();
						//amount business k acount say detect kr li
						if(isset($BusinessUserId) && $BusinessUserId > 0){
							$sql = "INSERT INTO freelance_account (spUser_idspUser, spPosting_idspPostings, fa_debit, fa_credit, fa_current_amount, id_milestone, fa_status, fa_date)VALUES
							('$BusinessUserId', '$projectId', '0', '$milestonePrice','$businessCurrnAmt', '$milestoneId', 'pending', NOW() )";
							$result_sql = mysqli_query($conn, $sql);
							if($result_sql){
								//Amount freelancer k acount main send ki
								if(isset($freelancerUserId) && $freelancerUserId > 0){
									$sql2 = "INSERT INTO freelance_account(spUser_idspUser, spPosting_idspPostings, fa_debit, fa_credit, fa_current_amount, id_milestone, fa_status, fa_date)VALUES
									($freelancerUserId, $projectId, $freelanceAmtSend, '0',$frelanceCurrnAmt, $milestoneId, 'pending', NOW() )";
									$result_sql2 = mysqli_query($conn, $sql2);
									if($result_sql2){
										//insert amount in sharepage account
										$sql3 = "INSERT INTO sharepage_history(id_milestone, sharepage_credit, sharepage_debit, sharepage_currentAmount, sharepage_status, sharepage_date)VALUES
										($milestoneId, '0','$sharePageAmtSend', $sharepageCurrnAmt, 'pending', NOW() )";
										$result_sql3 = mysqli_query($conn, $sql3);
										header('location:'.$BaseUrl.'/freelancer/active-bid.php');

									}
								}
							}
						}
					}
				}
			}
		}
		//header('location:'.$BaseUrl.'/freelancer/active-bid.php');
	}else{
		header('location:'.$BaseUrl.'/freelancer');
	}
	
	
?>
