

    <?php


	include '../../univ/baseurl.php';


    	function sp_autoloader($class) {
			include '../../mlayer/' . $class . '.class.php';
		}

		
		spl_autoload_register("sp_autoloader");

    $p = new _favorites;
    $result = $p->readFavourt($_POST['profile_id']);
	//echo $p->ta->sql;
	
	if($result != false){
	    while($row = mysqli_fetch_assoc($result)){ 
              
  
		$favouratedata[] = array("spProfiles_idspProfiles"=>$row['spProfiles_idspProfiles'],"spPostings_idspPostings"=>$row['spPostings_idspPostings'],"spUserid"=>$row['spUserid']);


       }

		 $data = array("status" => 200, "message" => "success","data"=>$favouratedata);
	}else{

		$data = array("status" => 1, "message" => "No favourite found");
	}	



echo json_encode($data);

?>