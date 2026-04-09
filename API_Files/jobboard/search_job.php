<?php
	//echo"here";
	include '../../univ/baseurl.php';


    	function sp_autoloader($class) {
			include '../../mlayer/' . $class . '.class.php';
		}

		
		spl_autoload_register("sp_autoloader");


    $offset = $_POST['offset'];

    $profile_id = $_POST['profile_id'];

  




           //$start = 0;
        /*$limit = 10;
               if($offset > 0 ){
                  //$offset = $offset 

                  $offset = $limit * $offset;
               } */


  $p  = new _jobpostings;

                              
                            $txtJobTitle = $_POST['txtJobTitle'];
                            $txtJobLoc = $_POST['txtJobLoc'];

                                
                                 $res = $p->readJobSearch($txtJobTitle,$txtJobLoc);
                     
//echo $p->ta->sql;


        if ($res != false){

              $closingdate = "";
                                  $Fixed = "";
                                    $Category = "";
                                    $hourly = "";
                                    $skill = "";


                            while ($rows = mysqli_fetch_assoc($res)) {

                                  
                               /* echo "<pre>";*/
                               // print_r($rows);
                               
                      







                                    $jobdata[]= array(
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

                              $data = array("status" => 200, "message" => "success","data"=>$jobdata);

        }else{

         $data = array("status" => 1, "message" => "No Record Found.");

        }



   echo json_encode($data);
	
?>  