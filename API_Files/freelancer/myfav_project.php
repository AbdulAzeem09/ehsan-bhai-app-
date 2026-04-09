<?php
	//echo"here";
	include '../../univ/baseurl.php';


    	function sp_autoloader($class) {
			include '../../mlayer/' . $class . '.class.php';
		}

		
		spl_autoload_register("sp_autoloader");


   /* $offset = $_POST['offset'];*/

    $profile_id = $_POST['profile_id'];

   // print_r($profile_id);
		//$device_id = $_POST['device_id'];
         //$device_type = $_POST['device_type'];




           //$start = 0;
        $limit = 10;
               if($offset > 0 ){
                  //$offset = $offset 

                  $offset = $limit * $offset;
               } 

$fe = new _freelance_favorites;

                                  $re = $fe->myfavourite($profile_id);
  $sf  = new _freelancerposting;




       if ($re != false) {

           


                           /* while ($row = mysqli_fetch_assoc($res))*/ 
                           while ($rw = mysqli_fetch_assoc($re)){




                                     
$res = $sf->read($rw['spPostings_idspPostings']);
                                  
                            

while ($rows = mysqli_fetch_assoc($res)){






$favourites = True;




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




                                   
                            }

                              $data = array("status" => 200, "message" => "success","data"=>$freelancedata);

        }else{

         $data = array("status" => 1, "message" => "No Record Found.");

        }



   echo json_encode($data);
	
?>  