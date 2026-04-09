<?php
	session_start();


	function sp_autoloader($class){
		include '../mlayer/' . $class . '.class.php';
	}
	spl_autoload_register("sp_autoloader");
	
	$p = new _spprofiles;
	$p->setDefault($_SESSION['uid'],$_POST["profileid"]);


	$rp = $p->readDefaultProfile($_SESSION['uid']);

	//echo "<pre>";
	//print_r($p);  
	
	if ($rp != false) {
		$row = mysqli_fetch_array($rp);
		$updateid = $p->update(array('is_active' => 1), "WHERE t.idspProfiles =" . $row['idspProfiles']);
		$_SESSION['pid'] = $row['idspProfiles'];
		$_SESSION['myprofile'] = $row["spProfileName"];
		$_SESSION['MyProfileName'] = $row["spProfileName"];
		$_SESSION['ptname'] = $row["spProfileTypeName"];
		$_SESSION['ptpeicon'] = $row["spprofiletypeicon"];
		$_SESSION['ptid'] = $row["spProfileType_idspProfileType"];
		$_SESSION['isActive'] = 1;
		$c = new _order;
		$res = $c->read($_SESSION['pid']);
		if ($res != false) {
			$_SESSION['cartcount'] = $res->num_rows;
			//echo $_SESSION['cartcount'];
		} else {
			$_SESSION['cartcount'] = 0;
		}
	}

?>