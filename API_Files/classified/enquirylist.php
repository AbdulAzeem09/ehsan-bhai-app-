<?php
	//echo"here";
	include '../../univ/baseurl.php';


    	function sp_autoloader($class) {
			include '../../mlayer/' . $class . '.class.php';
		}

		
		spl_autoload_register("sp_autoloader");


    $profile_id = $_POST['profile_id'];


                                  $p = new _classified;
                             

                                     $res = $p->myServEnq(7,$profile_id);
                                     
                                
                                  
                                                      ///echo $p->ta->sql;
                                      if($res != false){
                                          while ($rows = mysqli_fetch_assoc($res)) {

               $pro = new  _spprofiles;
               $resultpro = $pro->read($rows['sender_id']);

               $rowsp = mysqli_fetch_assoc($resultpro);


                                           $productdata[]= array(
                                      "idspPostings"=> $rows['idspPostings'],
                                      "spPostingTitle"=> $rows['spPostingTitle'],
                                      
                                      "spProfile_idspProfile"=> $rows['spProfile_idspProfile'],
                                      "spProfileName"=> $rowsp['spProfileName'],
                                      "enquiry_msg"=> $rows['enquiry_msg'],
                                      "enquiry_id"=> $rows['enquiry_id'],
                                      "sender_id"=> $rows['sender_id']

                                    
                                     
                                    );
                                             /* $statedata[] = array('country_id' =>$row3['country_id'],'state_id' =>$row3['state_id'],'state' =>$row3['state_title']);*/
                                          }

                                          $data = array("status" => 200, "message" => "success","data"=>$productdata);
                                      }else{

                                         $data = array("status" => 1, "message" => "No Record Found.");

                                        }
                                                 


   echo json_encode($data);
	
?>  