<?php
	//echo"here";
	include '../../univ/baseurl.php';


    	function sp_autoloader($class) {
			include '../../mlayer/' . $class . '.class.php';
		}

		
		spl_autoload_register("sp_autoloader");

/*
    $offset = $_POST['offset'];*/

    $user_id = $_POST['user_id'];

  


  $f  = new _spprofiles;

                              
   $limit = 8;

                                     $offset = $_POST['offset'];
                                       if($offset > 0 ){
                                          //$offset = $offset 

                                          $offset = $limit * $offset;
                                       } 
                                    if($_POST['cat'] == 'ALL'){
                                      
                                       $res = $f->profileTypePerson(5, $user_id,$limit,$offset);

                                    }else{

                                        $res = $f->profileTypePersonbycat(5, $user_id,$_POST['cat'],$limit,$offset);
                                        
                                    }

                              //$res = $p->profileTypePerson(5, $user_id);
                     
/*echo $p->ta->sql;
*/



        if ($res != false){

          


                            while ($rows = mysqli_fetch_assoc($res)) {

                          /*  print_r($rows);*/


                                      $profile_pic = ($rows['spProfilePic']);

/*
                        $jobdata[]= array(
                                      "idspProfiles"=> $rows['idspProfiles'],
                                      "spProfileName"=> $rows['spProfileName'],
                                     

                                     
                                    );*/

                                    $jobdata[]= array(
                                      "idspProfiles"=> $rows['idspProfiles'],
                                      "spProfileName"=> $rows['spProfileName'],
                                      "spProfileEmail"=> $rows['spProfileEmail'],
                                      "spProfilePic"=> $profile_pic,
                                      "spUser_idspUser"=> $rows['spUser_idspUser'],
                                      "spProfileType_idspProfileType"=> $rows['spProfileType_idspProfileType'],
                                      "spProfileAbout"=> $rows['spProfileAbout'],
                                      "spProfiles_idspProfiles"=> $rows['spProfiles_idspProfiles'],
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