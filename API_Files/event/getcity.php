<?php
	//echo"here";
	include '../../univ/baseurl.php';


    	function sp_autoloader($class) {
			include '../../mlayer/' . $class . '.class.php';
		}

		
		spl_autoload_register("sp_autoloader");




    $stateId = $_POST['state_id'];


     
                                                                          $co = new _city;
                                                                                                $result3 = $co->readCity($stateId);

                                                                                            //echo $pr->ta->sql;
                                                                            if($result3 != false){
                                                                                while ($row3 = mysqli_fetch_assoc($result3)) {
                                                                                    
                                                                                    //print_r($row3);

                                                                                    $citydata[] = array('country_id' =>$row3['country_id'],'state_id' =>$row3['state_id'],'city_id'=>$row3['city_id'],'city' =>$row3['city_title']);
                                                                                }

                                                                                $data = array("status" => 200, "message" => "success","data"=>$citydata);
                                                                            }else{

                                                                               $data = array("status" => 1, "message" => "No Record Found.");

                                                                              }
                                                                                       


   echo json_encode($data);
	
?>  