<?php
	
	include '../univ/baseurl.php';


    	function sp_autoloader($class) {
			include '../mlayer/' . $class . '.class.php';
		}

		
		spl_autoload_register("sp_autoloader");

		$user_id = $_REQUEST['userid'];
		$device_id = $_REQUEST['device_id'];
         $device_type = $_REQUEST['device_type'];
       //  print_r($device_type);
       
        $ud = new _spuser_device;

        $user = $ud->readdevice($user_id,$device_id,$device_type);
        //echo $ud->ta->sql;
       // print_r($user);
        if(!empty($user)){
            
             $Deletedid = $ud->remove($user_id,$device_id,$device_type);
            // echo $ud->ta->sql;
                 
            $data = array("status" => 200, "message" => "success");
            
        }else{
            
            $data = array("status" => 1, "message" => "User not Found.");
            
            
        }

    
   echo json_encode($data);
	
?>  