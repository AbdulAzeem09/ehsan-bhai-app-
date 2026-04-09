<?php
    


    include '../../univ/baseurl.php';


        function sp_autoloader($class) {
            include '../../mlayer/' . $class . '.class.php';
        }

        
        spl_autoload_register("sp_autoloader");

   $u = new _spprofilehasprofile;
    //echo $_POST['profileid'];
    //echo $_SESSION['pid'];
 
  
    if (isset($_POST['spProfiles_idspProfileSender']) && $_POST['spProfiles_idspProfileSender'] > 0) {
       

           $result = $u->unfriend($_POST['spProfiles_idspProfileSender'] ,$_POST['spProfiles_idspProfilesReceiver']);

         $data = array("status" => 200, "message" => "success");
    }else{
        $data = array("status" => 1, "message" => "Enter Profile id");
    }
    
    echo json_encode($data);
?>