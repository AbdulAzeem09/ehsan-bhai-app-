<?php

	function sp_autoloader($class){
			include '../mlayer/' . $class . '.class.php';
		}
		spl_autoload_register("sp_autoloader");
	//spProfileTypes_idspProfileTypesid,spGroup_idspGroup
	$g = new _spgroup;

	$pid = $_GET['pid'];
		$gid = $_GET['gid'];
		$gname = $_GET['groupname'];
$g->acceptrequest($gid, $pid);

$re = new _redirect;
    $location = $BaseUrl.'/grouptimelines/member.php?groupid='.$gid.'&groupname='.$gname.'&members';
    $re->redirect($location);
	?>