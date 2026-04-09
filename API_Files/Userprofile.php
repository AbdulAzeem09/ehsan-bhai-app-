<?php
	
	include '../univ/baseurl.php';


    	function sp_autoloader($class) {
			include '../mlayer/' . $class . '.class.php';
		}

		
		spl_autoload_register("sp_autoloader");

		$user_id = $_GET['userid'];
		/*$device_id = $_GET['device_id'];
         $device_type = $_GET['device_type'];*/
       //  print_r($device_type);

                                      $p = new _spprofiles;
                                        $rpvt = $p->readProfiles($user_id);

										 $albumObj = new _album;
                



                                        /*echo $p->ta->sql;*/
                                        if ($rpvt != false){
                                            while($row = mysqli_fetch_assoc($rpvt)) {

                                                 /*print_r($row);*/
                                             
                                             $blob_data = base64_encode($row['spProfilePic']);
                                              //print_r($blob_data);

											        $pid = $row['idspProfiles'];
													$query = "SELECT * FROM sppostingalbum as t
													INNER JOIN spProfiles as d ON t.spProfiles_idspProfiles = d.idspProfiles
													WHERE t.spProfiles_idspProfiles = ".$pid;

													$resultOfAlbum = mysqli_query($con,$query);

													if ($resultOfAlbum->num_rows > 0) {
														while ($row = mysqli_fetch_array($resultOfAlbum)) {
															if ($row['spPostingAlbumName'] == "Timeline") {
																$albumid = $row["idspPostingAlbum"];
															}
														}
														if (!isset($albumid)) {
															$albumid = $albumObj->timelinealbum($pid);
														}
													}else {
														$albumid = $albumObj->timelinealbum($pid);
													}


                                             $profile_data[]=array(
                                                "idspProfiles"=>$row['idspProfiles'],
                                                
                                                "spProfileName"=>$row['spProfileName'],
                                                "spUser_idspUser"=>$row['spUser_idspUser'],
                                                "idspProfileType"=>$row['idspProfileType'],
                                                "spProfileTypeName"=>$row['spProfileTypeName'],
                                                "spProfilePic"=>$blob_data,
												"albumid"=>$albumid
                                            );

                                            }

                                        $data = array("status" => 200, "message" => "success","data"=>$profile_data);
                                        }else{
                                         
                                         $data = array("status" => 1, "message" => "User not Found.");


                                        }

       
      /*  $ud = new _spuser_device;

        $user = $ud->readdevice($user_id,$device_id,$device_type);*/
        //echo $ud->ta->sql;
       // print_r($user);
/*        if(!empty($user)){
            
             $Deletedid = $ud->remove($user_id,$device_id,$device_type);
            // echo $ud->ta->sql;
                 
            $data = array("status" => 200, "message" => "success");
            
        }else{
            
            $data = array("status" => 1, "message" => "User not Found.");
            
            
        }
*/
    
   echo json_encode($data);
	
?>  