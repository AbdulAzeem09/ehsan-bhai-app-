

    <?php


	include '../../univ/baseurl.php';


    	function sp_autoloader($class) {
			include '../../mlayer/' . $class . '.class.php';
		}

		
		spl_autoload_register("sp_autoloader");




 $u = new _spuser;


 $userId= $_POST['user_id'];


 $result = $u->read($userId);

	
if($result){
            $row = mysqli_fetch_assoc($result);

           /*echo "<pre>"; print_r($row);*/

           

            $genratecode = $row['phone_verify_code'];

            $myuserid      =   $row['idspUser'];

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

               // echo"here"; print_r($randCode);
                //GENERATE ALPHA NUMARIC RANDOM NUMBERS UNIQUE END
                // UPDATE CODE ON USER PROFILE START
                //$u->updateCode($userId, $randCode);
                $u->updateEmailCode($myuserid , $randCode, 1);

               //echo $u->ta->sql;

              // exit();
                // UPDATE CODE ON USER PROFILE END
                
                 $message = urlencode($randCode)." is your code to verify your Withdraw Request to TheSharePage.com . Do not share it with anyone.";

            }else{
               
               $message = $row['phone_verify_code']." is your code to login to TheSharePage.com . Do not share it with anyone.";
               // is your code to login to TheSharePage.com . Do not share it with anyone.
                 $randCode = $row['phone_verify_code'];
                //$message = $row['phone_verify_code'];
            }
            //SEND SMS TO SPECIFIC USER WHO REGISTER START
            $sms = new _sms; 
            $sms->send_any_sms($mobile, $message);


		 $veriata = array("phone_verify_code"=>$randCode,"userid"=>$_POST['user_id']); 
     


		 $data = array("status" => 200, "message" => "success","data"=>$veriata);
	}else{

		$data = array("status" => 1, "message" => "User Not found");
	}	



echo json_encode($data);

?>