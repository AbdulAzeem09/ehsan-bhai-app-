<?php
  //echo"here";
  include '../../univ/baseurl.php';


      function sp_autoloader($class) {
      include '../../mlayer/' . $class . '.class.php';
    }

    
    spl_autoload_register("sp_autoloader");

  $user_id = $_POST['user_id'];
  $cat = $_POST['cat'];
  $offset = $_POST['offset'];



              $limit = 5;
               if($offset > 0 ){
              
                  $offset = $limit * $offset;
               } 
     
                                  $f = new _spprofiles;
                                  if($_POST['cat'] == "ALL"){

                                   
                                    $result = $f->get_all_category_freelancers_offset($user_id,$limit,$offset);

                                   //echo $f->ta->sql;
                                  }else{

                                     
                                     $result = $f->get_category_freelancers_offset($user_id,$cat,$limit,$offset);
                                    //  echo $f->ta->sql;
                                  }
                                  
                                                      //echo $f->ta->sql;
                                       if($result){
                                        while ($row = mysqli_fetch_assoc($result)) {

                                           // print_r($row);
                                              
                                           $fi = new _spfreelancer_profile;
                                            $result_fi = $fi->read($row['idspProfiles']);

                                            $row_fi = mysqli_fetch_assoc($result_fi);


                                             $skills = $row_fi['skill'];
                                            $perhour = $row_fi['hourlyrate'];


                                           $productdata[]= array(
                                      "idspProfiles"=> $row['idspProfiles'],
                                      "spProfileName"=> $row['spProfileName'],
                                      "spProfileEmail"=> $row['spProfileEmail'],
                                      "spProfilePhone"=> $row['spProfilePhone'],
                                      "profilecategory"=> $row['profiletype'],
                                      "spUser_idspUser"=> $row['spUser_idspUser'],
                                      "spProfileType_idspProfileType"=> $row['spProfileType_idspProfileType'],
                                      "spProfileAbout"=> $row['spProfileAbout'],
                                      "spProfilesDefault"=> $row['spProfilesDefault'],
                                      "spProfilesAboutStore"=> $row['spProfilesAboutStore'],
                                      "spprofilesPublished"=> $row['spprofilesPublished'],
                                      "spProfileVerification"=> $row['spProfileVerification'],
                                      "is_active"=> $row['is_active'],
                                      "spProfilePostalCode"=> $row['spProfilePostalCode'],
                                      "relationship_status"=> $row['relationship_status'],
                                      "phone_status"=> $row['phone_status'],
                                      "email_status"=> $row['email_status'],
                                      "address"=> $row['address'],
                                      "spUserzipcode"=> $row['spUserzipcode'],
                                      "spProfileTypeName"=> $row['spProfileTypeName'],
                                      "spprofiles_idspProfiles"=> $row['spprofiles_idspProfiles'],
                                      "hourlyrate"=> $row['hourlyrate'],
                                      "skill"=> $row['skill'],
                                      "certification"=> $row['certification'],
                                      "projectworked"=> $row['projectworked'],
                                      "workinginterests"=> $row['workinginterests'],
                                      "availablefrom"=> $row['availablefrom'],
                                      "reference"=> $row['reference'],
                                      "personalwebsite"=> $row['personalwebsite'],
                                      "languagefluency"=> $row['languagefluency'],
                                      "spProfilePic"=> ($row['spProfilePic'])
                                      
                                     /* "spPostingPrice"=> $rows['spPostingPrice'],
                                      "sellType"=> $rows['sellType'],
                                      "picture"=> $pict*/
                                     
                                    );
                                             /* $statedata[] = array('country_id' =>$row3['country_id'],'state_id' =>$row3['state_id'],'state' =>$row3['state_title']);*/
                                          }

                                          $data = array("status" => 200, "message" => "success","data"=>$productdata);
                                      }else{

                                         $data = array("status" => 1, "message" => "No Record Found.");

                                        }
                                                 


   echo json_encode($data);
  
?>  