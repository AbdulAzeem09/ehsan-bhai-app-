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
                  'spPostingVisibility' => 0,
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
                  'idspPostings' => $postid,
                  'spPostingTitle' => $_POST['spPostingTitle'],
                  'spPostingNotes' => $_POST['spPostingNotes'],
                  'spPostingExpDt' => date('Y-m-d h:i:s', strtotime("+30 days")),
                  'spPostingPrice' => $_POST['spPostingPrice'],
                  'spPostingVisibility' => 0,
                  "spPostingDate"=> date('Y-m-d'),
                  'spCategories_idspCategory' => 5,
                  'spProfiles_idspProfiles' => $_POST['spProfiles_idspProfiles'],
                  'sppostingscommentstatus' => 1,
                  'spPostingCategory' => $_POST['spPostingCategory'],
                  'spPostInSubCategory' => $_POST['spPostInSubCategory'],
                  'spPostExperienceLevl' => $_POST['spPostExperienceLevl'],
                  'spPostingSkill' => $_POST['spPostingSkill'],
                  'spPostingPriceFixed' => 1,
                  "spPostingPriceHourly"=> 0
                                      
                 );

                                 
          $data = array("status" => 200, "message" => "success","data"=>$project_data);

        }else{

         $data = array("status" => 1, "message" => "No Record Found.");

        }



   echo json_encode($data);
	
?>  