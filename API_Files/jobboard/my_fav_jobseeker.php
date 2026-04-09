<?php
	
	include '../../univ/baseurl.php';


    	function sp_autoloader($class) {
			include '../../mlayer/' . $class . '.class.php';
		}

		
		spl_autoload_register("sp_autoloader");

$profile_id = $_POST['profile_id'];
$m = new _job_favorites;
            $catid = 2;
            $result = $m->myfavourite_job($profile_id);

            /*echo $m->ta->sql;*/
            if($result){
              while($row = mysqli_fetch_assoc($result)){

        /*print_r($rows);*/$f = new _spprofiles;

                                          $result1 = $f->empTypePerson($row['spPostings_idspPostings']);
                                          $rows = mysqli_fetch_assoc($result1);

                                                  $profile_pic = ($rows['spProfilePic']);

                      $jobdata[]= array(
                                      "idspProfiles"=> $rows['idspProfiles'],
                                      "spProfileName"=> $rows['spProfileName'],
                                      "spProfileEmail"=> $rows['spProfileEmail'],
                                      "spProfilePic"=> $profile_pic,
                                      "spUser_idspUser"=> $rows['spUser_idspUser'],
                                      "spProfileType_idspProfileType"=> $rows['spProfileType_idspProfileType'],
                                      "spProfileAbout"=> $rows['spProfileAbout'],
                                     
                                      "spProfileTypeName"=> $rows['spProfileTypeName'],
                                      "spprofiles_idspProfiles"=> $rows['spprofiles_idspProfiles'],
                                      "college"=> $rows['college'],
                                      "university"=> $rows['university'],
                                      "experience"=> $rows['experience'],
                                      "degree"=> $rows['degree'],
                                      "percentage"=> $rows['percentage'],
                                      "spPostingJobType"=> $rows['spPostingJobType'],

                                      
                                      "graduate"=> $rows['graduate'],
                                      "profilePublicaly"=> $rows['profilePublicaly'],
                                      "skill"=> $rows['skill'],
                                      "reference"=> $rows['reference'],
                                      "achievements"=> $rows['achievements'],
                                      "hobbies"=> $rows['hobbies'],
                                      "certification"=> $rows['certification']

                                     
                                    );





}




                          

          $data = array("status" => 200, "message" => "success","data"=>$jobdata);

        }else{

         $data = array("status" => 1, "message" => "No Record Found.");

        }



   echo json_encode($data);
	
?>  