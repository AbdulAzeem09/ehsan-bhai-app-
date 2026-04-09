<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
    include('../univ/baseurl.php');

    function sp_autoloader($class)
    {
        include '../mlayer/' . $class . '.class.php';
    }

    spl_autoload_register("sp_autoloader");
    
    session_start();
    $i = 0;
    $u = new _spuser;
    $re = new _redirect;
  //  $_POST['spUserEmail'] ="ashish7730@gmail.com";
	//    $_POST['spUserPassword'] ="123456";

                        
    if ($_POST['spUserEmail'] != '') {
		$r = $u->login($_POST['spUserEmail'], hash("sha256", $_POST['spUserPassword']));
		
		//echo json_encode($r); exit;

        if ($r != false) {
            //$verify = $u->isEmailVerify($);
            // chek user is locked or unlock
			$result2 = $u->chekLock($_POST['spUserEmail']);
			
            if ($result2) {
			
                // IF NOT LOCKED THEN WORKING PROPER
                if ($r->num_rows == 1) {
                    if ($rows = mysqli_fetch_array($r)) {
                        //echo "<pre>";
                        //print_r($rows);
                        // echo "</pre>";exit;
                        $spUserEmail = $rows['spUserEmail'];
                        $spUserPassword = $rows['spUserPassword'];

                        $userid=$rows['idspUser'];

                        //  echo $redirctUrl;

                        //  print_r($spUserEmail);
                        /*  print_r($spUserPassword);
							print_r($userid);
							exit();
						*/
                        //   print_r($_POST['spUserEmail']);

                        /*if ($_POST['spUserEmail'] == $spUserEmail && hash("sha256", $_POST['spUserPassword']) == $spUserPassword ) {*/

                        $userId = $rows['idspUser'];
 
                        $result = $u->read($userId);

                        
						
                        if ($result) {
                            $row = mysqli_fetch_assoc($result);

                            $genratecode = $row['phone_verify_code'];

                            $mobile = $row["spUserCountryCode"].$row['spUserPhone'];
                         

							
                            if ($row["twostep"]  == 0) {
                             
                                if ($rows['is_email_verify'] == 1) {
                               
                                    /*session_start();*/
                                    // UPDATE USER IP IN DATABASE
                                    $ip = $_SERVER['REMOTE_ADDR'];
									
                                    if ($ip != '') {
									
                                        $result11 = $u->updateIp($ip, $rows['idspUser']);
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
											
                                        } else {
                                                  
                                            $redirctUrl = $BaseUrl . "/timeline/";

										}
                                 
                                      echo $redirctUrl;
                                      //die();
                                        /*header("Location: $redirctUrl");*/
                

                 					//$re->redirect($redirctUrl);
                                    }
                                }
                            } else {
							
                                if ($genratecode == "" || $genratecode == 0) {
                                    //GENERATE ALPHA NUMARIC RANDOM NUMBERS UNIQUE START
                                    $size = 6;
                                    $alpha_key = '';
                                    $keys = range('A', 'Z');
                                    for ($i = 0; $i < 2; $i++) {
                                        $alpha_key .= $keys[array_rand($keys)];
                                    }
                                    $length = $size - 2;
                                    $key = '';
                                    $keys = range(0, 9);
                                    for ($i = 0; $i < $length; $i++) {
                                        $key .= $keys[array_rand($keys)];
                                    }

                                    $randCode = $alpha_key . $key;

                                    // echo"here"; print_r($randCode);
                                    //GENERATE ALPHA NUMARIC RANDOM NUMBERS UNIQUE END
                                    // UPDATE CODE ON USER PROFILE START
                                    //$u->updateCode($userId, $randCode);
                                    $u->updateEmailCode($userId, $randCode, 1);
                                    //echo $u->ta->sql;
                                    // UPDATE CODE ON USER PROFILE END
                                    /*$message = "Verification code for online account registration is:" .urlencode($randCode)." Okease verify at www.thesharepage.com";*/

                                    $message = urlencode($randCode)." is your code to login to TheSharePage.com . Do not share it with anyone.";
                                } else {
                                    /*$message = "Verification code for online account registration is:" .$row['phone_verify_code']." Okease verify at www.thesharepage.com";*/

                                    $message = $row['phone_verify_code']." is your code to login to TheSharePage.com . Do not share it with anyone.";
                                    // is your code to login to TheSharePage.com . Do not share it with anyone.

                //$message = $row['phone_verify_code'];
                                }
                                //SEND SMS TO SPECIFIC USER WHO REGISTER START
                                $sms = new _sms;
                                $sms->send_any_sms($mobile, $message);
                                //SEND SMS TO SPECIFIC USER WHO REGISTER END
                                // echo 1;

                                $redirctUrl = $BaseUrl ."/loginverfication.php?uid=".($userId);

                                echo $redirctUrl;
                            }
                        } else {
                            echo 2;
                        }

        
                        /*echo "true";
                        }
                        else{
                            echo "false";
                        }
                        */
                    }
                }
            } else {
                echo 1;
            }
        } else {
            echo 0;
        }
    } else {
        echo 0;
    }
