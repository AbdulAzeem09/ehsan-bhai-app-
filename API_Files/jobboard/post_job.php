<?php
	//echo"here";
	include '../../univ/baseurl.php';


    	function sp_autoloader($class) {
			include '../../mlayer/' . $class . '.class.php';
		}

		
		spl_autoload_register("sp_autoloader");
  $p = new _jobpostings;

  $pro  = array( 
                  'spCategories_idspCategory' => 2,
                  'spPostingVisibility' => -1,
                  'spProfiles_idspProfiles' => $_POST['spProfiles_idspProfiles'],
                  
                  'spPostingTitle' => $_POST['spPostingTitle'],
                  'spPostingsCountry' => $_POST['spPostingsCountry'],
                  'spPostingsState' => $_POST['spPostingsState'],
                  'spPostingsCity' => $_POST['spPostingsCity'],
                  'spPostingSlryRngFrm' => $_POST['spPostingSlryRngFrm'],
                  'spPostingSlryRngTo' => $_POST['spPostingSlryRngTo'],
                  'spPostingJoblevel' => $_POST['spPostingJoblevel'],
                  'spPostingNoofposition' => $_POST['spPostingNoofposition'],
                  'spPostingLocation' => $_POST['spPostingLocation'],
                  'spPostingJobAs' => $_POST['spPostingJobAs'],
                  'spPostingJobType' => $_POST['spPostingJobType'],
                  'spPostingExperience' => $_POST['spPostingExperience'],
                  'spPostingExpDt' => $_POST['spPostingExpDt'],
                  'spPostingSkill' => $_POST['spPostingSkill'],
                  'spPostingNotes' => $_POST['spPostingNotes']

                 );


      if(!empty($_POST['spPostingNoofposition'])){

$postid = $p->post($pro);

 $project_data  = array( 
                  'project_id' => $postid,
                  'spCategories_idspCategory' => 2,
                  'spPostingVisibility' => -1,
                  'spProfiles_idspProfiles' => $_POST['spProfiles_idspProfiles'],
                  
                  'spPostingTitle' => $_POST['spPostingTitle'],
                  'spPostingsCountry' => $_POST['spPostingsCountry'],
                  'spPostingsState' => $_POST['spPostingsState'],
                  'spPostingsCity' => $_POST['spPostingsCity'],
                  'spPostingSlryRngFrm' => $_POST['spPostingSlryRngFrm'],
                  'spPostingSlryRngTo' => $_POST['spPostingSlryRngTo'],
                  'spPostingJoblevel' => $_POST['spPostingJoblevel'],
                  'spPostingNoofposition' => $_POST['spPostingNoofposition'],
                  'spPostingLocation' => $_POST['spPostingLocation'],
                  'spPostingJobAs' => $_POST['spPostingJobAs'],
                  'spPostingJobType' => $_POST['spPostingJobType'],
                  'spPostingExperience' => $_POST['spPostingExperience'],
                  'spPostingExpDt' => $_POST['spPostingExpDt'],
                  'spPostingSkill' => $_POST['spPostingSkill'],
                  'spPostingNotes' => $_POST['spPostingNotes']

                 );


                          

          $data = array("status" => 200, "message" => "success","data"=>$project_data);

        }else{

         $data = array("status" => 1, "message" => "No Record Found.");

        }



   echo json_encode($data);
	
?>  