<?php
/*error_reporting(E_ALL);
ini_set('display_errors', 'On');*/

	include('../univ/baseurl.php');
	require_once '../library/config.php';
	require_once '../library/functions.php';

	checkUser();
	$action = isset($_GET['action']) ? $_GET['action'] : '';
	switch ($action) {
		
		case 'delete' :
			deleteUser($dbConn);
			break;
			case 2:

		case 'lock' :
			lockUser($dbConn);
			break;	


		case 'reactive' :
			reactiveUser($dbConn);
			break;			
		case 'PerDeleted' :
			PerDeletedUser($dbConn);
			break;	


		case 'accepted' :
			accepted($dbConn);
			break;
		case 'rejected' :
			rejected($dbConn);
			break;
			
		case 'unlock' :
			unlockUser($dbConn);
			break;	
			
			case 'activate' :
			activateUser($dbConn);
			break;
			
			
		default :
			// if action is not defined or unknown
			// move to main index page
			redirect($BaseUrl.'/backofadmin/registerdUser/index.php');
	}
	
	function deleteUser($dbConn){
		if (isset($_GET['userId']) && $_GET['userId'] > 0){
			$userId	=    $_GET['userId'];
		}

		$sql_74= "SELECT * FROM `spuser` WHERE idspUser = $userId ";
		$result_74 	= 	dbQuery($dbConn, $sql_74);
		$row_74 = dbFetchAssoc($result_74);

		

		$sql_dl="INSERT INTO `spdeleted_user`(`idspUser`, `spUserName`, `spUserFirstName`, `spUserLastName`, `spUserGender`, `sprand_no`, `spUserPhone`, `spUserEmail`, `spUserAddress`, `spUserPassword`, `spUserRegDate`, `spUserCountry`, `spUserState`, `spUserCity`, `spUserActCode`, `spUserActive`, `spUserResetCode`, `spuserAdmin`, `spUserIpLastLogin`, `is_email_verify`, `is_phone_verify`, `email_verify_code`, `phone_verify_code`, `twostep`, `spUserLock`, `spUserDob`, `uploadidentity`, `spUserShipAdd`, `spUserCountryCode`, `spUserPostalCode`, `spUserzipcode`, `address`, `latitude`, `longitude`, `refferalcodeused`, `userrefferalcode`, `spUserTotalPoints`, `currency`, `default_country`, `default_state`, `default_city`, `upload_spfile`, `time_zone`, `tag`, `memberrelation`, `personal_PhoneNo`, `relationship_status`, `spDynamicWholesell`, `category`, `highlights`, `languagefluency`, `sphobbies`, `Education`, `spProfileAbout`, `wallet_address`, `customerName`, `cardNumber`, `cardExpMonth`, `cardExpYear`, `cardCVC`, `duration`, `recurring_duration`, `bonus_reffer`, `deactivate_date`, `deactivate_status`, `pos_status`, `customer_type`, `sales_price`, `tax`, `discount`, `payment_1`, `payment_2`, `notes`, `email_news`, `empcheck`, `paymentterm_type`, `submembership`, `membership`, `profiletype`, `added_from`, `pos_customer_id`, `client_id`, `client_secret`, `key_json`, `business_address`, `business_email`, `business_phone`, `date_of_birth`) VALUES ('$row_74[idspUser]','$row_74[spUserName]','$row_74[spUserFirstName]','$row_74[spUserLastName]','$row_74[spUserGender]','$row_74[sprand_no]','$row_74[spUserPhone]','$row_74[spUserEmail]','$row_74[spUserAddress]','$row_74[spUserPassword]','$row_74[spUserRegDate]','$row_74[spUserCountry]','$row_74[spUserState]','$row_74[spUserCity]','$row_74[spUserActCode]','$row_74[spUserActive]','$row_74[spUserResetCode]','$row_74[spuserAdmin]','$row_74[spUserIpLastLogin]','$row_74[is_email_verify]','$row_74[is_phone_verify]','$row_74[email_verify_code]','$row_74[phone_verify_code]','$row_74[twostep]','$row_74[spUserLock]','$row_74[spUserDob]','$row_74[uploadidentity]','$row_74[spUserShipAdd]','$row_74[spUserCountryCode]','$row_74[spUserPostalCode]','$row_74[spUserzipcode]','$row_74[address]','$row_74[latitude]','$row_74[longitude]','$row_74[refferalcodeused]','$row_74[userrefferalcode]','$row_74[spUserTotalPoints]','$row_74[currency]','$row_74[default_country]','$row_74[default_state]','$row_74[default_city]','$row_74[upload_spfile]','$row_74[time_zone]','$row_74[tag]','$row_74[memberrelation]','$row_74[personal_PhoneNo]','$row_74[relationship_status]','$row_74[spDynamicWholesell]','$row_74[category]','$row_74[highlights]','$row_74[languagefluency]','$row_74[sphobbies]','$row_74[Education]','$row_74[spProfileAbout]','$row_74[wallet_address]','$row_74[customerName]','$row_74[cardNumber]','$row_74[cardExpMonth]','$row_74[cardExpYear]','$row_74[cardCVC]','$row_74[duration]','$row_74[recurring_duration]','$row_74[bonus_reffer]','$row_74[deactivate_date]','$row_74[deactivate_status]','$row_74[pos_status]','$row_74[customer_type]','$row_74[sales_price]','$row_74[tax]','$row_74[discount]','$row_74[payment_1]','$row_74[payment_2]','$row_74[notes]','$row_74[email_news]','$row_74[empcheck]','$row_74[paymentterm_type]','$row_74[submembership]','$row_74[membership]','$row_74[profiletype]','$row_74[added_from]','$row_74[pos_customer_id]','$row_74[client_id]','$row_74[client_secret]','$row_74[key_json]','$row_74[business_address]','$row_74[business_email]','$row_74[business_phone]','$row_74[date_of_birth]')";

	
		$result_dl 	= 	dbQuery($dbConn, $sql_dl);

		$sql		=	"DELETE FROM spuser WHERE idspUser = $userId";
		$result 	= 	dbQuery($dbConn, $sql);

		$sql_1		=	"UPDATE `spproduct` SET `spPostingVisibility` = '0' WHERE spuser_idspuser = $userId";
		$result_1	= 	dbQuery($dbConn, $sql_1);

		$sql1_3		=	"UPDATE `spjobboard` SET `spPostingVisibility` = '0' WHERE  spuser_idspuser = $userId";
		$result1_3	= 	dbQuery($dbConn, $sql1_3);

		$sql1_2		=	"UPDATE `spfreelancer` SET `spPostingVisibility` = '0' WHERE  spuser_idspuser = $userId";
		$result1_2	= 	dbQuery($dbConn, $sql1_2);

		$sql_11		=	"UPDATE `sprealstate` SET `spPostingVisibility` = '0' WHERE  spuser_idspuser = $userId";

		$result_11	= 	dbQuery($dbConn, $sql_11);

		$sql3_s		=	"UPDATE `spevent` SET `spPostingVisibility` = '0' WHERE spuser_idspuser = $userId";
		$result3_s	= 	dbQuery($dbConn, $sql3_s);	

		$sql4_s		=	"UPDATE `sppostingsartcraft` SET `spPostingVisibility` = '0' WHERE spuser_idspuser = $userId";
		$result4_s	= 	dbQuery($dbConn, $sql4_s);

		$sql6_s		=	"UPDATE `spvideo` SET `video_visibility` = '0' WHERE spUserid = $userId";
		$result6_s	= 	dbQuery($dbConn, $sql6_s);

		$sql10_s		=	"UPDATE `spclassified` SET `spPostingVisibility` = '0' WHERE  spuser_idspuser = $userId";
		$result10_s	= 	dbQuery($dbConn, $sql10_s);


		$sql5_s		=	"UPDATE `sptraining` SET `status` = '0' WHERE spuser_idspuser = $userId";
		$result5_s	= 	dbQuery($dbConn, $sql5_s);

		$sql7_s		=	"UPDATE `spbuisnesspostings` SET `status` = '0' WHERE  `uid` = $userId";
		$result7_s	= 	dbQuery($dbConn, $sql7_s);


		
		$_SESSION['count'] = 0;
		$_SESSION['errorMessage'] = "Deleted Successfully.";
		redirect(@$BaseUrl.'/backofadmin/registerdUser/index.php');			
	}

    // Permanent Delete

	function PerDeletedUser($dbConn){
		if (isset($_GET['userId']) && $_GET['userId'] > 0){
			$userId	=    $_GET['userId'];
		}

		$sql		=	"DELETE FROM spdeleted_user WHERE idspUser = $userId";
		$result 	= 	dbQuery($dbConn, $sql);

		$sql1		=	"DELETE FROM spproduct WHERE spuser_idspuser = $userId";
		$result1	= 	dbQuery($dbConn, $sql1);

		$sql3		=	"DELETE FROM spevent WHERE spuser_idspuser = $userId";
		$result3	= 	dbQuery($dbConn, $sql3);

		$sql4		=	"DELETE FROM sppostingsartcraft WHERE spuser_idspuser = 
		$userId";
		$result4	= 	dbQuery($dbConn, $sql4);

		$sql5		=	"DELETE FROM sptraining WHERE spuser_idspuser = $userId";
		$result5	= 	dbQuery($dbConn, $sql5);

		$sql6		=	"DELETE FROM spvideo WHERE spUserid = $userId";
		$result6	= 	dbQuery($dbConn, $sql6);

		$sql7		=	"DELETE FROM spbuisnesspostings WHERE  `uid` = $userId";
		$result7	= 	dbQuery($dbConn, $sql7);

		$sql8		=	"DELETE FROM news_comments WHERE  userid = $userId";
		$result8	= 	dbQuery($dbConn, $sql8);

		$sql9		=	"DELETE FROM follow_news WHERE  `uid` = $userId";
		$result9	= 	dbQuery($dbConn, $sql9);

		$sql10		=	"DELETE FROM spclassified WHERE  spuser_idspuser = $userId";
		$result10	= 	dbQuery($dbConn, $sql10);

		$sql11		=	"DELETE FROM sprealstate WHERE  spuser_idspuser = $userId";
		$result11	= 	dbQuery($dbConn, $sql11);

		$sql12		=	"DELETE FROM spfreelancer WHERE  spuser_idspuser = $userId";
		$result12	= 	dbQuery($dbConn, $sql12);

		$sql13		=	"DELETE FROM spjobboard WHERE  spuser_idspuser = $userId";
		$result13	= 	dbQuery($dbConn, $sql13);

		$sql15		=	"DELETE FROM comment_reply WHERE  userid = $userId";
		$result15	= 	dbQuery($dbConn, $sql15);

		$sql16		=	"DELETE FROM comment WHERE  userid = $userId";
		$result16	= 	dbQuery($dbConn, $sql16);

		$sql17		=	"DELETE FROM spprofiles WHERE  spUser_idspUser = $userId";
		$result17	= 	dbQuery($dbConn, $sql17);


		$_SESSION['count'] = 0;
		$_SESSION['errorMessage'] = "Deleted Successfully.";
		redirect(@$BaseUrl.'/backofadmin/registerdUser/index.php?view=delete_list');			
	}


	// Reactive User

	function reactiveUser($dbConn){
		if (isset($_GET['userId']) && $_GET['userId'] > 0){
			$userId	=    $_GET['userId'];
		}

		$sql_84= "SELECT * FROM `spdeleted_user` WHERE idspUser = $userId ";
		$result_84 	= 	dbQuery($dbConn, $sql_84);
		$row_84 = dbFetchAssoc($result_84);

		

		$sql_ru="INSERT INTO `spuser`(`idspUser`, `spUserName`, `spUserFirstName`, `spUserLastName`, `spUserGender`, `sprand_no`, `spUserPhone`, `spUserEmail`, `spUserAddress`, `spUserPassword`, `spUserRegDate`, `spUserCountry`, `spUserState`, `spUserCity`, `spUserActCode`, `spUserActive`, `spUserResetCode`, `spuserAdmin`, `spUserIpLastLogin`, `is_email_verify`, `is_phone_verify`, `email_verify_code`, `phone_verify_code`, `twostep`, `spUserLock`, `spUserDob`, `uploadidentity`, `spUserShipAdd`, `spUserCountryCode`, `spUserPostalCode`, `spUserzipcode`, `address`, `latitude`, `longitude`, `refferalcodeused`, `userrefferalcode`, `spUserTotalPoints`, `currency`, `default_country`, `default_state`, `default_city`, `upload_spfile`, `time_zone`, `tag`, `memberrelation`, `personal_PhoneNo`, `relationship_status`, `spDynamicWholesell`, `category`, `highlights`, `languagefluency`, `sphobbies`, `Education`, `spProfileAbout`, `wallet_address`, `customerName`, `cardNumber`, `cardExpMonth`, `cardExpYear`, `cardCVC`, `duration`, `recurring_duration`, `bonus_reffer`, `deactivate_date`, `deactivate_status`, `pos_status`, `customer_type`, `sales_price`, `tax`, `discount`, `payment_1`, `payment_2`, `notes`, `email_news`, `empcheck`, `paymentterm_type`, `submembership`, `membership`, `profiletype`, `added_from`, `pos_customer_id`, `client_id`, `client_secret`, `key_json`, `business_address`, `business_email`, `business_phone`, `date_of_birth`) VALUES ('$row_84[idspUser]','$row_84[spUserName]','$row_84[spUserFirstName]','$row_84[spUserLastName]','$row_84[spUserGender]','$row_84[sprand_no]','$row_84[spUserPhone]','$row_84[spUserEmail]','$row_84[spUserAddress]','$row_84[spUserPassword]','$row_84[spUserRegDate]','$row_84[spUserCountry]','$row_84[spUserState]','$row_84[spUserCity]','$row_84[spUserActCode]','$row_84[spUserActive]','$row_84[spUserResetCode]','$row_84[spuserAdmin]','$row_84[spUserIpLastLogin]','$row_84[is_email_verify]','$row_84[is_phone_verify]','$row_84[email_verify_code]','$row_84[phone_verify_code]','$row_84[twostep]','$row_84[spUserLock]','$row_84[spUserDob]','$row_84[uploadidentity]','$row_84[spUserShipAdd]','$row_84[spUserCountryCode]','$row_84[spUserPostalCode]','$row_84[spUserzipcode]','$row_84[address]','$row_84[latitude]','$row_84[longitude]','$row_84[refferalcodeused]','$row_84[userrefferalcode]','$row_84[spUserTotalPoints]','$row_84[currency]','$row_84[default_country]','$row_84[default_state]','$row_84[default_city]','$row_84[upload_spfile]','$row_84[time_zone]','$row_84[tag]','$row_84[memberrelation]','$row_84[personal_PhoneNo]','$row_84[relationship_status]','$row_84[spDynamicWholesell]','$row_84[category]','$row_84[highlights]','$row_84[languagefluency]','$row_84[sphobbies]','$row_84[Education]','$row_84[spProfileAbout]','$row_84[wallet_address]','$row_84[customerName]','$row_84[cardNumber]','$row_84[cardExpMonth]','$row_84[cardExpYear]','$row_84[cardCVC]','$row_84[duration]','$row_84[recurring_duration]','$row_84[bonus_reffer]','$row_84[deactivate_date]','$row_84[deactivate_status]','$row_84[pos_status]','$row_84[customer_type]','$row_84[sales_price]','$row_84[tax]','$row_84[discount]','$row_84[payment_1]','$row_84[payment_2]','$row_84[notes]','$row_84[email_news]','$row_84[empcheck]','$row_84[paymentterm_type]','$row_84[submembership]','$row_84[membership]','$row_84[profiletype]','$row_84[added_from]','$row_84[pos_customer_id]','$row_84[client_id]','$row_84[client_secret]','$row_84[key_json]','$row_84[business_address]','$row_84[business_email]','$row_84[business_phone]','$row_84[date_of_birth]')";

	
$result_ru 	= 	dbQuery($dbConn, $sql_ru);




		
		$sql_sp		=	"DELETE FROM spdeleted_user WHERE idspUser = $userId";
		$result_sp 	= 	dbQuery($dbConn, $sql_sp);

		$sql_1s		=	"UPDATE `spproduct` SET `spPostingVisibility` = '-1' WHERE spuser_idspuser = $userId";
		$result_1s	= 	dbQuery($dbConn, $sql_1s);

		$sql1_3s		=	"UPDATE `spjobboard` SET `spPostingVisibility` = '-1' WHERE  spuser_idspuser = $userId";
		$result1_3s	= 	dbQuery($dbConn, $sql1_3s);

		$sql1_2s		=	"UPDATE `spfreelancer` SET `spPostingVisibility` = '-1' WHERE  spuser_idspuser = $userId";
		$result1_2s	= 	dbQuery($dbConn, $sql1_2s);

		$sql_11s		=	"UPDATE `sprealstate` SET `spPostingVisibility` = '-1' WHERE  spuser_idspuser = $userId";
		$result_11s	= 	dbQuery($dbConn, $sql_11s);

		$sql3s		=	"UPDATE `spevent` SET `spPostingVisibility` = '-1' WHERE spuser_idspuser = $userId";
		$result3s	= 	dbQuery($dbConn, $sql3s);

		$sql4s		=	"UPDATE `sppostingsartcraft` SET `spPostingVisibility` = '-1' WHERE spuser_idspuser = $userId";
		$result4s	= 	dbQuery($dbConn, $sql4s);

		$sql6s		=	"UPDATE `spvideo` SET `video_visibility` = '1' WHERE spUserid = $userId";
		$result6s	= 	dbQuery($dbConn, $sql6s);

		$sql10s		=	"UPDATE `spclassified` SET `spPostingVisibility` = '-1' WHERE  spuser_idspuser = $userId";
		$result10s	= 	dbQuery($dbConn, $sql10s);


		$sql5s		=	"UPDATE `sptraining` SET `status` = '1' WHERE spuser_idspuser = $userId";
		$result5s	= 	dbQuery($dbConn, $sql5s);

		$sql7s		=	"UPDATE `spbuisnesspostings` SET `status` = '1' WHERE  `uid` = $userId";
		$result7s	= 	dbQuery($dbConn, $sql7s);



		$_SESSION['count'] = 0;
		$_SESSION['errorMessage'] = "Deleted Successfully.";
		redirect(@$BaseUrl.'/backofadmin/registerdUser/index.php?view=delete_list');			
	}


	// user account locked
	function lockUser($dbConn){
		if (isset($_GET['userId']) && $_GET['userId'] > 0) {
			$userId = $_GET['userId'];
			$sql = "UPDATE spuser SET spUserLock = 1 WHERE idspUser = $userId";
			$result = dbQuery($dbConn, $sql);
			$_SESSION['count'] = 0;
			$_SESSION['errorMessage'] = "Account Locked Successfully.";
			redirect(@$BaseUrl.'/backofadmin/registerdUser/index.php');
		}
	}
	// unlock user account
	function unlockUser($dbConn){
		if (isset($_GET['userId']) && $_GET['userId'] > 0) {
			$userId = $_GET['userId'];
			$sql = "UPDATE spuser SET spUserLock = 0 WHERE idspUser = $userId";
			$result = dbQuery($dbConn, $sql);
			$_SESSION['count'] = 0;
			$_SESSION['errorMessage'] = "Account Un-Locked Successfully.";
			redirect(@$BaseUrl.'/backofadmin/registerdUser/index.php?view=block');	
		}
	}
	
	function activateUser($dbConn){
		if (isset($_GET['userId']) && $_GET['userId'] > 0) {
			$userId = $_GET['userId'];
			$sql = "UPDATE spuser SET deactivate_status = 0 WHERE idspUser = $userId";
			$result = dbQuery($dbConn, $sql);
			$_SESSION['count'] = 0;
			$_SESSION['errorMessage'] = "Account Activated Successfully.";
			redirect(@$BaseUrl.'/backofadmin/registerdUser/index.php');	
		}
	}
	
	
		
			function accepted($dbConn){
		if (isset($_GET['id']) && $_GET['id'] > 0) {
			$userId = $_GET['id'];
			
			$sql = "UPDATE spbuiseness_files SET status = 2 WHERE id = $userId";
 
			$result = dbQuery($dbConn, $sql);
			//$_SESSION['count'] = 0;
			//$_SESSION['errorMessage'] = "Account Un-Locked Successfully.";
			 https://dev.thesharepage.com/backofadmin/registerdUser/index.php?view=baccount
			 redirect(@$BaseUrl.'/backofadmin/registerdUser/index.php?view=baccount');
 
		}
			}
		
		function rejected($dbConn){
			//print_r($_POST);
		if (isset( $_POST['ids']) && $_POST['ids'] > 0) {
			$userId = $_POST['ids'];
			$reject_reason=$_POST['reject_reason'];
			
			 $sql = "UPDATE spbuiseness_files SET status = 3 ,reject_reason='$reject_reason'  WHERE id = $userId";

			$result = dbQuery($dbConn, $sql);
			//$_SESSION['count'] = 0;
			//$_SESSION['errorMessage'] = "Account Un-Locked Successfully.";
			redirect(@$BaseUrl.'/backofadmin/registerdUser/index.php?view=baccount');
 
		}
			}
		
		
	

	
	

?>