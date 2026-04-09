<?php
	session_start();
	function sp_autoloader($class){
		include '../mlayer/' . $class . '.class.php';
	}
	spl_autoload_register("sp_autoloader");
?>
<input type="hidden" id="profiletyeid" value="<?php echo $_POST["profiletype"];?>">

<?php
	$p = new _spprofiles;
	$res = $p->readprofilepic($_POST["profiletype"],$_SESSION['uid']);
	if ($res != false){
		$r = mysqli_fetch_assoc($res);
		$picture = $r['spProfilePic'];
		echo "<img  alt='Posting Pic' class='img-circle' style='width:40px; height:40px;' src=' ".($picture)."' >" ;
		echo $r['spProfileName'];
		echo "<input type='hidden' id='profileid' value='".$r['idspProfiles'] ."'>";
		echo "<input type='hidden' id='profilename' value='".$r['spProfileName']."'>";
	}

?>