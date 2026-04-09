<?php
	function sp_autoloader($class){
			include '../mlayer/' . $class . '.class.php';
		}
		spl_autoload_register("sp_autoloader");
	
	
 $m = new _spgroupmessage;

    if (isset($_POST['postid']) && $_POST['postid'] > 0) {
    	$postid = $_POST['postid'];

    	print_r($postid);

    	$result = $m->remove($postid);

    	// echo $s->ta->sql;

        
    }

	//window.location.reload();
	//header("Location:../grouptimelines/?groupid=".$_POST["spGroup_idspGroup"]."&groupname=".$_POST["groupname_"]."");
?>