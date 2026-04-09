<?php
	//echo"here";
	include '../../univ/baseurl.php';


    	function sp_autoloader($class) {
			include '../../mlayer/' . $class . '.class.php';
		}

		
		spl_autoload_register("sp_autoloader");
  $p = new _freelancerposting;

  $pro  = array( 
                  'spCategories_idspCategory' => 5,
                  'spPostingVisibility' => -1,
                  'spProfiles_idspProfiles' => $_POST['spProfiles_idspProfiles'],
                  'sppostingscommentstatus' => 1,
                  'spPostingTitle' => $_POST['spPostingTitle'],
                  'spPostingExpDt' => date('Y-m-d', strtotime("+30 days")),
                  'spPostingCategory' => $_POST['spPostingCategory'],
                  'spPostInSubCategory' => $_POST['spPostInSubCategory'],
                  'spPostExperienceLevl' => $_POST['spPostExperienceLevl'],
                  'spPostingSkill' => $_POST['spPostingSkill'],
                  'spPostingPriceFixed' => 1,
                  'spPostingPrice' => $_POST['spPostingPrice'],
                  'spPostingNotes' => $_POST['spPostingNotes']

                 );


      if(!empty($_POST['spPostingPrice'])){

$postid = $p->create($pro);

 $project_data  = array( 
                  'project_id' => $postid,
                  'spCategories_idspCategory' => 5,
                  'spPostingVisibility' => -1,
                  'spProfiles_idspProfiles' => $_POST['spProfiles_idspProfiles'],
                  'sppostingscommentstatus' => 1,
                  'spPostingTitle' => $_POST['spPostingTitle'],
                  'spPostingExpDt' => date('Y-m-d', strtotime("+30 days")),
                  'spPostingCategory' => $_POST['spPostingCategory'],
                  'spPostInSubCategory' => $_POST['spPostInSubCategory'],
                  'spPostExperienceLevl' => $_POST['spPostExperienceLevl'],
                  'spPostingSkill' => $_POST['spPostingSkill'],
                  'spPostingPriceFixed' => 1,
                  'spPostingPrice' => $_POST['spPostingPrice'],
                  'spPostingNotes' => $_POST['spPostingNotes']

                 );


                          

          $data = array("status" => 200, "message" => "success","data"=>$project_data);

        }else{

         $data = array("status" => 1, "message" => "No Record Found.");

        }



   echo json_encode($data);
	
?>  