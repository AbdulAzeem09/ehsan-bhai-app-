<?php

	include('../univ/baseurl.php');
	function sp_autoloader($class) {
		include '../mlayer/' . $class . '.class.php';
	}

	spl_autoload_register("sp_autoloader");
	
	//session_start();
	$i = 0;
	$u = new _spuser;
	//$re = new _redirect;


	if ($_REQUEST['spUserEmail'] != '') {
		$r = $u->login($_REQUEST['spUserEmail'], hash("sha256", $_REQUEST['spUserPassword']));

		if ($r != false) {
			//$verify = $u->isEmailVerify($);
			// chek user is locked or unlock
			$result2 = $u->chekLock($_REQUEST['spUserEmail']);
			if ($result2) {
				// IF NOT LOCKED THEN WORKING PROPER
				if ($r->num_rows == 1) {

					if($rows = mysqli_fetch_array($r)) {
				        //echo "<pre>";
				        //print_r($rows);
				        // echo "</pre>";exit;
				     $spUserEmail = $rows['spUserEmail'];  
				     $spUserPassword = $rows['spUserPassword'];
				     $userid=$rows['idspUser'];

			

                     $userId = $rows['idspUser'];
                     $result = $u->read($userId);

        
        if($result){


                   $u = new _spuser;
                   $result2 = $u->isEmailVerify($userId);
                  
                  //echo $u->ta->sql;

            if ($result2) {
                               

            $row = mysqli_fetch_assoc($result);

           // print_r($row);

            $genratecode = $row['phone_verify_code'];

            $mobile = $row["spUserCountryCode"].$row['spUserPhone'];

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

                $u->updateEmailCode($userId, $randCode, 1);
             

                 $message = urlencode($randCode)." is your code to login to TheSharePage.com . Do not share it with anyone.";

            }else{
               
               $message = $row['phone_verify_code']." is your code to login to TheSharePage.com . Do not share it with anyone.";
               // is your code to login to TheSharePage.com . Do not share it with anyone.

               //$message = $row['phone_verify_code'];
            }

            //SEND SMS TO SPECIFIC USER WHO REGISTER START
            //$sms = new _sms; 
            //$sms->send_any_sms($mobile, $message);
            //SEND SMS TO SPECIFIC USER WHO REGISTER END
           // echo 1;

         /*   $redirctUrl = $BaseUrl ."/loginverfication.php?uid=".($userId);

	        echo $redirctUrl;*/

			     /*   $pro = new _spprofiles;
			        $profile_id = $pro->getDefault($userId);
                                    

                               $profile_detail = $pro->read($profile_id);

                   if($profile_detail){

                   	$profile = mysqli_fetch_assoc($profile_detail);

                     print_r($profile);*/

                   	 $userdata1 = array(
                            
                           "userid"=> $userId,  
          	              // "spUserIpLastLogin"=> $_REQUEST["spUserIpLastLogin"],
          	               "spUserFirstName"=> $row["spUserFirstName"],
          	               "spUserLastName"=> $row["spUserLastName"],
          	               "spUserEmail"=> $row["spUserEmail"],
          	               "spUserPassword"=> $row["spUserPassword"],
          	              /* "respUserEnpass_"=> $_REQUEST["respUserEnpass_"],*/
          	               "spUserGender"=> $row["spUserGender"],
          	               "address"=> $row["address"],
          	               "zipcode"=> $row["spUserzipcode"],
          	               "latitude"=> $row["latitude"],
          	               "longitude"=> $row["longitude"],
          	               "spUserDob"=> $row["spUserDob"],
          	               "txtCountryCode"=> $row["spUserCountryCode"],
          	               "respUserEphone"=> $row["spUserPhone"],
          	               "device_type"=>$_REQUEST["device_type"],
          	               "device_id"=>$_REQUEST["device_id"]
          	               
                          );
                 /*  	}*//*else{

                   	}*/
                   
                   
                    	$devicedata=array("uid" =>$userId ,"device_type"=>$_REQUEST["device_type"],"device_id"=>$_REQUEST["device_id"],"created"=>date("Y-m-d H:i:s") ); 

                 	$de = new _spuser_device;
					$result = $de->create($devicedata);


	         $data = array("status" => 200, "message" => "success","data"=> $userdata1);

         }else{

           $data = array("status" => 1, "message" => "Email Not Verified.");
         }

        }else{
            
           // echo "User not Found";
            $data = array("status" => 1, "message" => "User not Found.");
        }


					}
				}
				
				
			}else{
				
				//echo "user locked by admin!";
				$data = array("status" => 1, "message" => "User locked by Admin.");
			
			}

               

		}else {

			// echo "Please Enter correct Email and Password.";
			 $data = array("status" => 1, "message" => "Please Enter correct Email and Password.");
			//echo 0;
		}
	}else{

		//echo "Please Enter Email.";

		$data = array("status" => 1, "message" => "Please Enter Email.");
		//Please Enter correct Email and Password.
	}
	
echo json_encode($data);

?>
