<?php
  //echo"here";
  include '../../univ/baseurl.php';


      function sp_autoloader($class) {
      include '../../mlayer/' . $class . '.class.php';
    }

    
    spl_autoload_register("sp_autoloader");


          $pp = new _spprofiles;
          $rpvt = $pp->read($_POST['profile_id']);
        //  echo $pp->ta->sql;
          if ($rpvt != false){
            $row = mysqli_fetch_assoc($rpvt);
            //print_r($row);
            $name     = $row["spProfileName"];
            $picture  = $row['spProfilePic'];
            $about    = $row["spProfileAbout"];
            $phone    = $row["spProfilePhone"];
            $phonestatus    = $row["phone_status"];
            $emailstatus    = $row["email_status"];
            $relationship_status    = $row["relationship_status"];
            $uid = $row["spUser_idspUser"];
           $city     = $row["spProfilesCity"];
            $profiletype    = $row["spProfileType_idspProfileType"];
            $profileTypeName  = $row['spProfileTypeName'];
            $icon     = $row["spprofiletypeicon"];
            $ptypeid  = $row["idspProfileType"];
            $email    = $row["spProfileEmail"];
            $location   = $row["spprofilesLocation"];
            $language   = $row["spprofilesLanguage"];
            $address  = $row["spprofilesAddress"];
            $profileaddress   = $row["address"];
       
                                      
                               

                                    //print_r($rows);
                   $profiledata[]= array("spProfileName"=> $name,
                                      "spProfileEmail"=> $email,
                                      "address"=> $profileaddress,
                                      "spProfilePhone"=> $phone,
                                      "spUser_idspUser"=> $uid,
                                      "spProfileType_idspProfileType"=>$profiletype
                                    
                                     );
                               
                                 
                                 $data = array("status" => 200, "message" => "success","data"=>$profiledata);

                               }else{

                                $data = array("status" => 1, "message" => "No Profile Data Found.");
                               }
                      
   echo json_encode($data);
  
?>  