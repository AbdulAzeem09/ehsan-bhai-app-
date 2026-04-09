<?php
	//echo"here";
	include '../../univ/baseurl.php';


    	function sp_autoloader($class) {
			include '../../mlayer/' . $class . '.class.php';
		}

		
		spl_autoload_register("sp_autoloader");




                    $profile_id = $_POST['profile_id'];

                                                                                 $pf  = new _postfield;
                                                                               

                                                                                $sp = new _sponsorpic;
                                                                                $result2 = $sp->readAll($profile_id);
                                                                                //echo $sp->ta->sql;
                                                                                if($result2 != false){
                                                                                    while ($row2 = mysqli_fetch_assoc($result2)) {
                                                                                        if(in_array($row2['idspSponsor'], $allSponsor)){
                                                                                            $spSelect = "selected";
                                                                                        }else{
                                                                                            $spSelect = '';
                                                                                        }


                                                                                        $allsponser[] = array('idspSponsor' =>$row2['idspSponsor'] ,'sponser_name'=>$row2['sponsorTitle'] );
                                                                                      /*  echo "<option value='".$row2['idspSponsor']."' ".$spSelect.">".$row2['sponsorTitle']."</option>";*/
                                                                                    }

                                                                                      $data = array("status" => 200, "message" => "success","data"=>$allsponser);
                                                                                }else{

                                                                                      $data = array("status" => 1, "message" => "No Record Found.");
                                                                                }
                                                                               

   echo json_encode($data);
	
?>  