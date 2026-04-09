<?php
	
	include '../../univ/baseurl.php';


    	function sp_autoloader($class) {
			include '../../mlayer/' . $class . '.class.php';
		}

		
		spl_autoload_register("sp_autoloader");


$post_id = $_POST['post_id'];
     $sf  = new _jobpostings;

                                // print_r($_SESSION['pid']);

                                // $res = $p->client_publicpost(5, $_SESSION['pid']);

                                  $res = $sf->singletimelines($post_id);

                                        //echo $sf->ta->sql;

                                        $i = 1;
                                        if($res){
           
       /*while($rows = mysqli_fetch_assoc($res)){*/


        $rows = mysqli_fetch_assoc($res);
                                                $dt = new DateTime($row['spPostingExpDt']);
                                               
                                        $u = new  _spbusiness_profile;
                        $result3 = $u->read($clientId);

                          $CmpnyName = "";
                            $CmpnyDesc  = "";
                            $CmpSize    = "";
                        //echo $u->ta->sql;
                        if ($result3) {
                          

                            $row3 = mysqli_fetch_assoc($result3);

                            //print_r($row3);

                             $CmpSize = $row3['CompanySize'];
                              //$CmpnyDesc = $row3['skill']; 
                              $CmpnyName = ucfirst($row3['companyname']); 

                            }


                     $draftdata[]= array(
                                         "idspPostings"=> $rows['idspPostings'],
                                      "spPostingTitle"=> $rows['spPostingTitle'],
                                      "spPostingNotes"=> $rows['spPostingNotes'],
                                      "spPostingExpDt"=> $rows['spPostingExpDt'],
                                      "spPostingVisibility"=> $rows['spPostingVisibility'],
                                      "spPostingDate"=> $rows['spPostingDate'],
                                      "spCategories_idspCategory"=> $rows['spCategories_idspCategory'],
                                      "spProfiles_idspProfiles"=> $rows['spProfiles_idspProfiles'],
                                      "spPostingsCountry"=> $rows['spPostingsCountry'],
                                      "spPostingsState"=> $rows['spPostingsState'],
                                      "spPostingsCity"=> $rows['spPostingsCity'],
                                      "spPostingDate"=> $rows['spPostingDate'],
                                      "spPostingSkill"=> $rows['spPostingSkill'],
                                      "spPostingSlryRngFrm"=> $rows['spPostingSlryRngFrm'],
                                      "spPostingSlryRngTo"=> $rows['spPostingSlryRngTo'],
                                      "spPostingJoblevel"=> $rows['spPostingJoblevel'],
                                      "spPostingNoofposition"=> $rows['spPostingNoofposition'],
                                      "spPostingLocation"=> $rows['spPostingLocation'],
                                      "spPostingJobAs"=> $rows['spPostingJobAs'],
                                      "spPostingJobType"=> $rows['spPostingJobType'],
                                      "spPostingExperience"=> $rows['spPostingExperience'],
                                      "spPostingClosing"=> $rows['spPostingClosing'],
                                      "CompanySize"=>  $CmpSize,
                                      "companyname"=> $CmpnyName
                                    );               


/*}*/




                          

          $data = array("status" => 200, "message" => "success","data"=>$draftdata);

        }else{

         $data = array("status" => 1, "message" => "No Record Found.");

        }



   echo json_encode($data);
	
?>  