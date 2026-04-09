<?php
	//echo"here";
	include '../../univ/baseurl.php';


    	function sp_autoloader($class) {
			include '../../mlayer/' . $class . '.class.php';
		}

		
		spl_autoload_register("sp_autoloader");




    $countryId = $_POST['country_id'];


     
                                                                           $pr = new _state;
                                                                                            $result3 = $pr->readState($countryId);

                                                                                            //echo $pr->ta->sql;
                                                                            if($result3 != false){
                                                                                while ($row3 = mysqli_fetch_assoc($result3)) {
                                                                                    
                                                                                    

                                                                                    $statedata[] = array('country_id' =>$row3['country_id'],'state_id' =>$row3['state_id'],'state' =>$row3['state_title']);
                                                                                }

                                                                                $data = array("status" => 200, "message" => "success","data"=>$statedata);
                                                                            }else{

                                                                               $data = array("status" => 1, "message" => "No Record Found.");

                                                                              }
                                                                                       


   echo json_encode($data);
	
?>  