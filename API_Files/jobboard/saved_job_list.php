<?php
	//echo"here";
	include '../../univ/baseurl.php';


    	function sp_autoloader($class) {
			include '../../mlayer/' . $class . '.class.php';
		}

		
		spl_autoload_register("sp_autoloader");


$profile_id = $_POST['profile_id'];
     $sf  = new _jobpostings;

                                // print_r($_SESSION['pid']);

                                // $res = $p->client_publicpost(5, $_SESSION['pid']);

                                  $res = $sf->mySaveJob(2, $profile_id);

                                        //echo $sf->ta->sql;

                                        $i = 1;
                                        if($res){
           
       while($rows = mysqli_fetch_assoc($res)){
                                                $dt = new DateTime($row['spPostingExpDt']);
                                               
                                             //  echo "<pre>";
                                              // print_r($row);



                     $savedata[]= array(
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
                                    );               






}




                          

          $data = array("status" => 200, "message" => "success","data"=>$savedata);

        }else{

         $data = array("status" => 1, "message" => "No Record Found.");

        }



   echo json_encode($data);
	
?>  