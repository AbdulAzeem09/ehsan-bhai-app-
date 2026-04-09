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
  
  //echo "<pre>";
  //print_r($_POST);

  //exit();


//print_r($_FILES);
	spl_autoload_register("sp_autoloader");
	$p = new _spgroup_event;

	if (isset($_POST["idspPostings"]) && $_POST["idspPostings"]!= '') {
    
		$postid = $p->update($_POST, "WHERE t.idspPostings =" . $_POST["idspPostings"]);
		echo trim($_POST["idspPostings"]);
	
  }else{
		$postid = $p->post($_POST, $_FILES);
//		echo trim($postid);

    $re = new _redirect;
    $re->redirect($BaseUrl."/grouptimelines/group-event.php?groupid=".$_POST['spgroupid']."&groupname=".$_POST['spgroupname']."");

   // print_r($postid);
	}
	
	
	/*
 $_SESSION['count'] = 0;
    $_SESSION['errorMessage'] = "<strong>Success!</strong> Your group event!";

    $re = new _redirect;
    $re->redirect("<?php echo $BaseUrl?>/grouptimelines/group-event.php?groupid=<?php echo $_GET['groupid']?>&groupname=<?php echo $_GET['groupname'];?>");*/

?>