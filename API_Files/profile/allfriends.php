<?php
  //echo"here";
  include '../../univ/baseurl.php';


      function sp_autoloader($class) {
      include '../../mlayer/' . $class . '.class.php';
    }

    
    spl_autoload_register("sp_autoloader");

  $f = new _spprofilehasprofile;

               
  $result = $f->readallfriend($_POST["profile_id"]);

  /*$result2 = $f->readall($_POST["profile_id"]);
 

  if( $result  != false){ 
    $flag = 0 ;     //Sender
    printProfile($result,$flag );
  }
  
  
  if($result2 != false){
    $flag = 1;    //Reciever
    echo printProfile($result2,$flag);
  }

*/
  //user friend list show
  
  //function printProfile($result,$flag){

  if($result != false){ 
    while($rows = mysqli_fetch_assoc($result)){ 
      if($flag == 0)//sender
      {
        $profileid = $rows["spProfiles_idspProfilesReceiver"];
      }
      else //Receiver
      {
        $profileid = $rows["spProfiles_idspProfileSender"];
      }
      
      $p = new _spprofiles;
      $res = $p->read($profileid);
      //echo $f->ta->sql;
      if($res != false)
      {
          $row = mysqli_fetch_array($res);

           $profilepic = ($row['spProfilePic']);
           $profilename = $row["spProfileName"];
           $profiletype = $row["spProfileTypeName"];
           





                  $profiledata[]= array("spProfileid"=> $profileid,
                                      "spProfileName"=> $profilename,
                                      "spProfileTypeName"=> $profiletype,
                                      "spProfilePic"=>$profilepic
                                     
                                    
                                     );



      }
    }
  
//}
   $data = array("status" => 200, "message" => "success","data"=>$profiledata);

                                // print_r($timelinedata);

                               }else{

                                $data = array("status" => 1, "message" => "No Friends Found.");
                               }
                      





   echo json_encode($data);
  
?>  