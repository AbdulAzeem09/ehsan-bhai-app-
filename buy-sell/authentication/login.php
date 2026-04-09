<?php

	include('../univ/baseurl.php');
	function sp_autoloader($class) {
		include '../mlayer/' . $class . '.class.php';
	}

	spl_autoload_register("sp_autoloader");
	
	session_start();
	$i = 0;
	$u = new _spuser;
	$re = new _redirect;

	   $userid=$_POST['uid'];

       $uid =($userid);


//print_r($_POST['verifycode']);
//exit();
     //   $uid=base64_decode($uid);
	

	if (!empty($_POST['verifycode'])) {

		$r = $u->login($_POST['spUserEmail'], $_POST['spUserPassword']);

		if ($r != false) {
			//$verify = $u->isEmailVerify($);
			// chek user is locked or unlock
			$result2 = $u->chekLock($_POST['spUserEmail']);
			if ($result2) {
				// IF NOT LOCKED THEN WORKING PROPER
				if ($r->num_rows == 1) {
					if($rows = mysqli_fetch_array($r)) {
				      


		if ($rows['phone_verify_code'] == $_POST['verifycode']) {

							
						if ($rows['is_email_verify'] == 1) {

							// UPDATE USER IP IN DATABASE
							$ip = $_SERVER['REMOTE_ADDR'];
							if ($ip != '') {
								$result = $u->updateIp($ip, $rows['idspUser']);
							}
							

							$_SESSION['login_user'] = $rows['spUserName'];
							$_SESSION['uid'] = $rows['idspUser'];
							$_SESSION['spUserEmail'] = $rows['spUserEmail'];
							
							$p = new _spprofiles;
							//$rp = $p->readProfiles($_SESSION['uid']);
							//login with default profile
							$rp = $p->readDefaultProfile($_SESSION['uid']);
							if ($rp != false) {
								$row = mysqli_fetch_array($rp);
								
								//$u->updatetwostep(0,$_SESSION['uid']);
								$updateid = $p->update(array('is_active' => 1), "WHERE t.idspProfiles =" . $row['idspProfiles']);

								$_SESSION['pid'] 			= $row['idspProfiles'];
								$_SESSION['myprofile'] 		= $row["spProfileName"];
								$_SESSION['MyProfileName'] 	= $row["spProfileName"];
								$_SESSION['ptname'] 		= $row["spProfileTypeName"];
								$_SESSION['ptpeicon'] 		= $row["spprofiletypeicon"];
								$_SESSION['ptid'] 			= $row["spProfileType_idspProfileType"];
								$_SESSION['isActive'] 		= 1;
								$c = new _order;
								$res = $c->read($_SESSION['pid']);
								if ($res != false) {
									$_SESSION['cartcount'] = $res->num_rows;
									//echo $_SESSION['cartcount'];
								} else {
									$_SESSION['cartcount'] = 0;
								}
							}

					if (isset($_SESSION['login_user'])) {
					if (isset($_SESSION['afterlogin'])) {
						$redirctUrl = $BaseUrl . "/" . $_SESSION['afterlogin'];
						
					} else{
						$redirctUrl = $BaseUrl . "/timeline/";
					}
					// echo $redirctUrl;

				 $re = new _redirect;

				 $re->redirect($redirctUrl);
			
				}

						}else{
							//echo 2;
					$_SESSION['err']="Please Verify Your Email.";

                   $redirctUrl = $BaseUrl ."/loginverfication.php?uid=".$uid;
                   
                 //   $re = new _redirect;

				 $re->redirect($redirctUrl);
						}
                     
                   /*  $redirctUrl = $BaseUrl . "/timeline/";

                     echo $redirctUrl;*/

                    }else{

                         $_SESSION['err']="Please Enter Valid Code.";

                   $redirctUrl = $BaseUrl ."/loginverfication.php?uid=".$uid;
                   
                 //   $re = new _redirect;

				 $re->redirect($redirctUrl);

					  	//echo "false";
					}

                    }
				}
				
				
			}else{
				echo 1;
			}
		}else {
			echo 0;
		}
	}else{
		  $_SESSION['err']="Please Enter Code.";

                   $redirctUrl = $BaseUrl ."/loginverfication.php?uid=".$uid;
                   
                    //$re = new _redirect;

				 $re->redirect($redirctUrl);
	}
	
?>