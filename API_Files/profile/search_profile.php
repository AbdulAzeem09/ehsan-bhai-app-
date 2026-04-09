

    <?php


  include '../../univ/baseurl.php';


      function sp_autoloader($class) {
      include '../../mlayer/' . $class . '.class.php';
    }

    
    spl_autoload_register("sp_autoloader");





  $categoryId  = $_POST['category'];
              $txtSearch    = $_POST['search'];
  $p = new _spprofiles;
                $result = $p->searchprofile($categoryId, $txtSearch);
  //echo $po->ta->sql;
  
  if($result != false){
      while($row = mysqli_fetch_assoc($result)){ 
              
        // print_r($row);


         $profilepic = ($row['spProfilePic']);
                                                       

    $profiedata[] = array("idspProfiles"=>$row['idspProfiles'],"spProfileName"=>$row['spProfileName'],"spProfilePic"=>$profilepic,"spUser_idspUser"=>$row['spUser_idspUser'],"spProfileType_idspProfileType"=>$row['spProfileType_idspProfileType'],"spProfileTypeName"=>$row['spProfileTypeName']);

       }


     $data = array("status" => 200, "message" => "success","data"=>$profiedata);
  }else{

    $data = array("status" => 1, "message" => "No RfQ found");
  } 



echo json_encode($data);

?>