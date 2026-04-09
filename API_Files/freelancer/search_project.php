<?php
	//echo"here";
	include '../../univ/baseurl.php';


    	function sp_autoloader($class) {
			include '../../mlayer/' . $class . '.class.php';
		}

		
		spl_autoload_register("sp_autoloader");


    $txtSearchProject = $_POST['txtSearchProject'];
 $profile_id = $_POST['profile_id'];
    //$profile_id = $_GET['profile_id'];

   // print_r($profile_id);
		//$device_id = $_POST['device_id'];
         //$device_type = $_POST['device_type'];




           //$start = 0;
        $limit = 10;
               if($offset > 0 ){
                  //$offset = $offset 

                  $offset = $limit * $offset;
               } 


   $p      = new _freelancerposting;
$res = $p->search_project($txtSearchProject);
//echo $p->ta->sql;

        if ($res != false){

              $closingdate = "";
                                  $Fixed = "";
                                    $Category = "";
                                    $hourly = "";
                                    $skill = "";


                            while ($rows = mysqli_fetch_assoc($res)) {

                                  
                              /*  echo "<pre>";
                                print_r($row);*/
                               
                             // $result_pf = $pf->read($row['idspPostings']);
                                //echo $pf->ta->sql."<br>";

                             /* if($result_pf){
                                    $closingdate = "";
                                    $Fixed = "";
                                    $Category = "";
                                    $hourly = "";
                                    $skill = "";*/

                                   /* while ($row2 = mysqli_fetch_assoc($result_pf)) {*/
                               


                                   /* }*/
                                  //  $postingDate = $p-> spPostingDate($row["spPostingDate"]);
                                   
                              /*  }*/

$fe = new _freelance_favorites;

                                  $re = $fe->read($rows['idspPostings']);
if ($re != false) {
while ($rw = mysqli_fetch_assoc($re)) {
if ($rw['spProfiles_idspProfiles'] == $profile_id) {

       $favourites =true;

}else{
  $favourites =false;
}
/*print_r($rw);*/
}
}else{
$favourites =false;
}




                                    $freelancedata[]= array(
                                      "idspPostings"=> $rows['idspPostings'],
                                      "spPostingTitle"=> $rows['spPostingTitle'],
                                      "spPostingNotes"=> $rows['spPostingNotes'],
                                      "spPostingExpDt"=> $rows['spPostingExpDt'],
                                      "spPostingPrice"=> $rows['spPostingPrice'],
                                      "spPostingVisibility"=> $rows['spPostingVisibility'],
                                      "spPostingDate"=> $rows['spPostingDate'],
                                      "spCategories_idspCategory"=> $rows['spCategories_idspCategory'],
                                      "spProfiles_idspProfiles"=> $rows['spProfiles_idspProfiles'],
                                      "sppostingscommentstatus"=> $rows['sppostingscommentstatus'],
                                      "spPostingCategory"=> $rows['spPostingCategory'],
                                      "spPostInSubCategory"=> $rows['spPostInSubCategory'],
                                      "spPostExperienceLevl"=> $rows['spPostExperienceLevl'],
                                      "spPostingSkill"=> $rows['spPostingSkill'],
                                      "spPostingPriceHourly"=> $rows['spPostingPriceHourly'],
                                      "spPostingPriceFixed"=> $rows['spPostingPriceFixed'],
                                      "favourites"=> $favourites
                                     
                                    );
                            }

                              $data = array("status" => 200, "message" => "success","data"=>$freelancedata);

        }else{

         $data = array("status" => 1, "message" => "No Record Found.");

        }



   echo json_encode($data);
	
?>  