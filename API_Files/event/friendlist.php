<?php
	//echo"here";
	include '../../univ/baseurl.php';


    	function sp_autoloader($class) {
			include '../../mlayer/' . $class . '.class.php';
		}

		
		spl_autoload_register("sp_autoloader");




                                 $profile_id = $_POST['profile_id'];




                                                                          $b = array();
                                                                          $r = new _spprofilehasprofile;
                                                                          $pv = new _postingview;

                                                                          $res = $r->readall($profile_id);//As a receiver
                                                                          /*echo $r->ta->sql;*/
                                                                          if($res != false){
                                                                            while($rows = mysqli_fetch_assoc($res)){
                                                                              // print_r($rows);
                                                                              $p = new _spprofiles;
                                                                              $sender = $rows["spProfiles_idspProfileSender"];
                                                                              array_push($b,$sender);

                                                                              $result = $p->read($rows["spProfiles_idspProfileSender"]);
                                                                              //echo $p->ta->sql;

                                                                              if($result != false){
                                                                                $row = mysqli_fetch_assoc($result);
                                                                               /* print_r($row);*/
                                                                                $totalFrnd = $r->countTotalFrnd($row['idspProfiles']);
                                                                                //get friend store
                                                                                        $result3 = $pv->singlefriendstore($sender);
                                                                                        if($result3 != false){
                                                                                          if(mysqli_num_rows($result3) > 0){
                                                                                            $storeshow = mysqli_num_rows($result3);
                                                                                          }else{
                                                                                            $storeshow = 0;
                                                                                          }
                                                                                        }else{
                                                                                          $storeshow = 0;
                                                                                        }
                                                                             
                                                                             $profile_data[]=array("idspProfiles"=>$row['idspProfiles'],"spProfileName"=>$row['spProfileName'],"spUser_idspUser"=>$row['spUser_idspUser']);
                                                                                
                                                                              }



                                                                              }

                                                                                $data = array("status" => 200, "message" => "success","data"=>$profile_data);
                                                                           }else{

                                                                                      $data = array("status" => 1, "message" => "No Record Found.");
                                                                                }



   /*

                                                                                $r = new _spprofilehasprofile;
                                                                                $result2 = $r->readallfriend($profile_id);



                                                                             
                                                                                //echo $sp->ta->sql;
                                                                                if($result2 != false){
                                                                                    while ($row2 = mysqli_fetch_assoc($result2)) {
                                                                                      
                                                                                            print_r($row2);
                                                                                     
                                                                                    }

                                                                                      $data = array("status" => 200, "message" => "success","data"=>$allsponser);
                                                                                }else{

                                                                                      $data = array("status" => 1, "message" => "No Record Found.");
                                                                                }
                                                                               */

   echo json_encode($data);
	
?>  