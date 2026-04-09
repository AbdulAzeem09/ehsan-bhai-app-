<?php
include('../univ/baseurl.php');

	function sp_autoloader($class){
		include '../../mlayer/' . $class . '.class.php';
	}
	spl_autoload_register("sp_autoloader");
	
	$p = new _groupsponsor;
	$re = new _redirect;
	
    //print_r($_FILES['sponsorImg']);
	//print_r($_FILES['sponsorImg']['name']);

 //print_r($_POST);

	if(isset($_POST["idspSponsor"]) && $_POST['idspSponsor'] > 0){
		$idspSponsor = $_POST['idspSponsor'];

		$id = $p->updateSponsor($_POST, "WHERE t.idspSponsor =" . $_POST["idspSponsor"]);
		echo $id;

	/*	$img =	$_FILES['sponsorImg']['name'];
		$img = str_replace("data:image/".$_POST["ext"].";base64,", "", $img);
		$img = str_replace(" ", "+", $img);
		$data = base64_decode($img);/
*/
	//echo $_POST['postedit']. '--'.$_POST['del'];

	/*if($id != ''){
		$sp->updatepic($idspSponsor, $data);
		//echo $_POST['SponorId'];
	}*/
	$redirctUrl = $BaseUrl . "/grouptimelines/group-sponsorlist.php?groupid=".$_POST['spgroupid']."&groupname=".$_POST['spgroupname']."&sponsor";

	/*	$redirctUrl = $BaseUrl . "/post-ad/events/group-form.php?groupid=".$_GET["groupid"]."&groupname=".$_GET['groupname']."&event&back=back&groupflag=gflag";*/
	$re->redirect($redirctUrl);
	}else{

		//print_r($_POST);
		$id = $p->createsp($_POST);	
		echo $id;

		/*	$sp = new _sponsorpic;*/
	/*$ext = end((explode(".", $_FILES['sponsorImg']['name'])));
	//$img = $_POST["spPostingPic"];
	$img =	$_FILES['sponsorImg']['name'];
	$img = str_replace("data:image/".$ext.";base64,", "", $img);
	$img = str_replace(" ", "+", $img);
	$data = base64_decode($img);

	//echo $_POST['postedit']. '--'.$_POST['del'];

	if($id != ''){
		$sp->updatepic($id, $data);
		//echo $_POST['SponorId'];
	}*/
/*$redirctUrl = $BaseUrl . "/post-ad/events/group-form.php?groupid=".$_GET["groupid"]."&groupname=".$_GET['groupname']."&event&back=back&groupflag=gflag";*/	

$redirctUrl = $BaseUrl . "/grouptimelines/group-sponsorlist.php?groupid=".$_POST['spgroupid']."&groupname=".$_POST['spgroupname']."&sponsor";


$re->redirect($redirctUrl);
	}
	
	
?>