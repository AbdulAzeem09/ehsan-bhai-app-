<?php
	include('../univ/baseurl.php');
	session_start();
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);

	function sp_autoloader($class){
		include '../mlayer/' . $class . '.class.php';
	}
	spl_autoload_register("sp_autoloader");

	$u = new _spuser;
	$re = new _redirect;
	$redirctUrl = $BaseUrl . "/sign-up.php";
//print_r($redirctUrl); exit();


		$a = mt_rand(1000,32700);


         
         //Set deault value 4 for default registered Personal  Profile
         $_REQUEST["spProfileType_idspProfileType_"] = 4;
$promocode = substr(base_convert(sha1(uniqid(mt_rand())), 16, 36), 0, 8);
           $userdata = array(
                            
                           "userid"=> $uid,  
          	               "spProfileType_idspProfileType_"=> $_REQUEST["spProfileType_idspProfileType_"],
          	             //  "spUserIpLastLogin"=> $_REQUEST["spUserIpLastLogin"],
          	               "txtCountryCode"=> "+".$_REQUEST["txtCountryCode"],
          	               "spUserFirstName"=> $_REQUEST["spUserFirstName"],
          	               "spUserLastName"=> $_REQUEST["spUserLastName"],
          	               "spUserEmail"=> $_REQUEST["spUserEmail"],
          	               "spUserPassword"=> $_REQUEST["spUserPassword"],
          	               "spUserGender"=> $_REQUEST["spUserGender"],
          	               "address"=> $_REQUEST["address"],
          	               "zipcode"=> $_REQUEST["zipcode"],
          	               "latitude"=> $_REQUEST["latitude"],
          	               "longitude"=> $_REQUEST["longitude"],
          	               "spUserDob"=> $_REQUEST["spUserDob"],
          	               "respUserEphone"=> $_REQUEST["respUserEphone"],
                           "refferalcodeused"=>$_REQUEST["refferalcodeused"],
                           "userrefferalcode"=>strtoupper($promocode)

          	             
                          );

         	
			//print_r($_REQUEST);


		if (isset($_REQUEST['spUserEmail']) && $_REQUEST['spUserEmail'] != '') {

			$chkEmail = $u->emailavailable($_REQUEST['spUserEmail']);
			//print_r($chkEmail);
			

			if ($chkEmail == 0) {
				//echo 0;
				//$re->redirect($redirctUrl);

				$data = array("status" => 1, "message" => "Email Exist!");
				
			}else{

				 $uid = $u->registerapi($userdata,$a);
				//$_SESSION['chkuid'] = $uid;

				
				
			
				if ($uid > 0) {
					// add points to the user
					$po = new _spPoints;
					$result = $po->read(2);
					//echo $po->ta->sql;
					//exit();

					if ($result != false) {
						//echo "33";
						$row = mysqli_fetch_array($result);
						$point = $row['point_total'];

						$data1 = array(
							"pointPercentage" => $point,
							"pointBalance" => $point,
							"spUser_idspUser" => $uid,
							"spPointComment" => "User Registration",
							"spPoint_type" => "D"
						);


						$po->tad->create($data1);
					}

                 if($uid >0){

                 	$devicedata=array("uid" =>$uid ,"device_type"=>$_REQUEST["device_type"],"device_id"=>$_REQUEST["device_id"],"created"=>date("Y-m-d H:i:s") ); 

                 	$de = new _spuser_device;
					$result = $de->create($devicedata);


                    $userdata1 = array(
                            
                           "userid"=> $uid,  
          	               "spProfileType_idspProfileType_"=> $_REQUEST["spProfileType_idspProfileType_"],
          	              // "spUserIpLastLogin"=> $_REQUEST["spUserIpLastLogin"],
          	               "txtCountryCode"=> $_REQUEST["txtCountryCode"],
          	               "spUserFirstName"=> $_REQUEST["spUserFirstName"],
          	               "spUserLastName"=> $_REQUEST["spUserLastName"],
          	               "spUserEmail"=> $_REQUEST["spUserEmail"],
          	               "spUserPassword"=> $_REQUEST["spUserPassword"],
          	              
          	               "spUserGender"=> $_REQUEST["spUserGender"],
          	               "address"=> $_REQUEST["address"],
          	               "zipcode"=> $_REQUEST["zipcode"],
          	               "latitude"=> $_REQUEST["latitude"],
          	               "longitude"=> $_REQUEST["longitude"],
          	               "spUserDob"=> $_REQUEST["spUserDob"],
          	               "respUserEphone"=> $_REQUEST["respUserEphone"],
          	               "device_type"=> $_REQUEST["device_type"],
          	               "device_id"=> $_REQUEST["device_id"],
                           "refferalcodeused"=>$_REQUEST["refferalcodeused"],
                           "userrefferalcode"=>strtoupper($promocode)
          	             
                          );

                  $data = array("status" => 200, "message" => "success","data"=> $userdata1);


                 }else{

                 	$data = array("status" => 1, "message" => "User Registration Failed!");

                 }
            
					// ===END
				}
				

			}
		}
		
	//}

	 echo json_encode($data);
?>
