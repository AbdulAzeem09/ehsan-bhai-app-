<?php

/* function sp_autoloader($class){
  include '../mlayer/' . $class . '.class.php';
  }
  spl_autoload_register("sp_autoloader");
  $p = new _postings;
  if(isset($_POST["idspPostings"]))
  {
  $postid = $p->update( $_POST, "WHERE t.idspPostings =" . $_POST["idspPostings"]);
  echo trim($_POST["idspPostings"]);
  }

  else
  {
  if($_POST["spProfiles_idspProfiles"]!=""){
  if(isset($_POST["spPostingAlbum_idspPostingAlbum_"]))
  $postid = $p->post($_POST, $_FILES, $_POST["spPostingAlbum_idspPostingAlbum_"]);
  else
  $postid = $p->post($_POST, $_FILES);
  echo trim($postid);
  }
  } */

	function sp_autoloader($class) {
		include '../mlayer/' . $class . '.class.php';
	}
  
//print_r($_POST);

//exit();
//print_r($_FILES);
	spl_autoload_register("sp_autoloader");
	$p = new _spevent;
$re = new _redirect;
	if (isset($_POST["idspPostings"]) && $_POST["idspPostings"]!= '') {

		$postid = $p->update($_POST, "WHERE t.idspPostings =" . $_POST["idspPostings"]);
		//echo trim($_POST["idspPostings"]);
	
  } else {
            
		  $result8 = $p->eventExists();
                            if ($result8) {
                                $row8 = mysqli_fetch_assoc($result8);
								
								if($row8['spPostingTitle']==$_POST["spPostingTitle"]&&$row8['eventcategory']==$_POST["eventcategory"]&&$row8['spPostingEventOrgName']==$_POST["spPostingEventOrgName"]&&$row8['spPostingEventVenue']==$_POST["spPostingEventVenue"]&&$row8['eventaddress']==$_POST["eventaddress"]){
								}else{
										$postid = $p->post($_POST, $_FILES);
	                                 	//echo trim($postid);
								}
                           
                            }
		
	
  }
	
	 $_SESSION['count'] = 0;
    $_SESSION['errorMessage'] = "<strong>Success!</strong> Event Flagged Successfully!";
	$redirctUrl = $BaseUrl . "/events";
	$re->redirect($redirctUrl);
?>