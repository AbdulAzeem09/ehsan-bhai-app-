<?php
	
	include '../../univ/baseurl.php';


    	function sp_autoloader($class) {
			include '../../mlayer/' . $class . '.class.php';
		}

		
		spl_autoload_register("sp_autoloader");


$profile_id = $_POST['profile_id'];
     $sf  = new _jobpostings;

                                // print_r($_SESSION['pid']);

                                // $res = $p->client_publicpost(5, $_SESSION['pid']);

                                  $res = $sf->myProfilejobpost($profile_id);

                                        //echo $sf->ta->sql;

                                        $i = 1;
                                        if($res){
           
       while($rows = mysqli_fetch_assoc($res)){
                                                $dt = new DateTime($row['spPostingExpDt']);
                                               
                                             //  echo "<pre>";
                                              // print_r($row);

                                               // $pf = new _postfield;
                                                //$result_pf = $pf->totalbids($row['idspPostings']);

                                     /*     $result_pf = $sf->totalbids1($row['idspPostings']);
                                                
                                                //echo $sf->ta->sql;
                                                if($result_pf){
                                                    //print_r($result_pf);
                                                    $totalBid = $result_pf->num_rows;
                                                }else{
                                                    $totalBid = 0;
                                                }
                                             */

/*
                     $draftdata[]= array(
                                      "idspPostings"=> $row['idspPostings'],
                                      "spPostingTitle"=> $row['spPostingTitle'],
                                      "spPostingPrice"=> $row['spPostingPrice'],
                                      "spPostingExpDt"=> $row['spPostingExpDt']

                                    );*/


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
                                    );               






}




                          

          $data = array("status" => 200, "message" => "success","data"=>$draftdata);

        }else{

         $data = array("status" => 1, "message" => "No Record Found.");

        }



   echo json_encode($data);
	
?>  