<?php
	include('../univ/baseurl.php');
	function sp_autoloader($class){
		include '../mlayer/' . $class . '.class.php';
	}
	spl_autoload_register("sp_autoloader");
	
	$p = new _comment;
	$re = new _redirect;
	
	
	if(isset($_POST["idComment"]) && !empty($_POST["idComment"]) ){

		$p->updatecpmment($_POST["comment"],$_POST["idComment"]);
		if(isset($_POST['grouptimelines_']) && $_POST["grouptimelines_"] == 1){
 			$loc = $BaseUrl.'/grouptimelines';
			$re->redirect($loc);
		}else{
			$loc = $BaseUrl.'/timeline';
			$re->redirect($loc);
		}
		
	}else{
		if($_POST['comment'] == ""){
			//header("location:".$BaseUrl."/details");
			$loc = $BaseUrl.'/timeline';
			$re->redirect($loc);
		}else{

			$p->comment($_POST);
			if(isset($_POST['grouptimelines_']) && $_POST["grouptimelines_"] == 1){
				//header("Location:../grouptimelines/");
				$loc = $BaseUrl.'/grouptimelines';
				$re->redirect($loc);
			}else{
				$loc = $BaseUrl.'/timeline';
				$re->redirect($loc);
			}
		 
		}
	}
	
	
?>