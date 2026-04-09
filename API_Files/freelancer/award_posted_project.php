<?php

/*echo "string";*/
	include '../../univ/baseurl.php';

	//session_start();
	function sp_autoloader($class) {
		include '../../mlayer/' . $class . '.class.php';
	}


	spl_autoload_register("sp_autoloader");
	


$fps = new _freelance_project_status;
  $fc = new _milestone;




if(isset($_POST['postid']) && $_POST['postid'] > 0 && isset($_POST['profile_id']) && $_POST['profile_id'] >0){
    $spPosting_idspPostings = $_POST['postid'];
    $spProfiles_idspProfiles = $_POST['profile_id'];
    $price = $_POST['price'];

      $fps_status ="Acepted";
   
    $conn = _data::getConnection();

    $fps_start_date = date('Y m d');
    $chkAlready = $fps->checkStatusExist($spPosting_idspPostings, $spProfiles_idspProfiles);
    //echo $fps->ta->sql;
    if($chkAlready == false){
      $sql = "INSERT INTO freelance_project_status(spProfiles_idspProfiles, spPosting_idspPostings, fps_start_date, fps_status, fps_price) VALUES('$spProfiles_idspProfiles', '$spPosting_idspPostings', Now(), '$fps_status', $price)";          
    }else{
      $sql = "UPDATE freelance_project_status SET spProfiles_idspProfiles = '$spProfiles_idspProfiles',spPosting_idspPostings = '$spPosting_idspPostings', fps_start_date = NOW(), fps_status = '$fps_status'  WHERE spPosting_idspPostings = '$spPosting_idspPostings'";
    }
        
        $result = mysqli_query($conn, $sql);

 $payment = array(
                   "spPosting_idspPostings" =>$spPosting_idspPostings,
                   "spProfiles_idspProfiles" =>$spProfiles_idspProfiles,
                   "price" =>$price,
                   "fps_status" =>$fps_status
               );

              $data = array("status" => 200, "message" => "success","data"=>$payment);
          
           }else{

              $data = array("status" => 1, "message" => "Some field is Empty.");

        }

   echo json_encode($data);
    

    
?>


