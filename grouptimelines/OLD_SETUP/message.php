<?php
	function sp_autoloader($class){
			include '../mlayer/' . $class . '.class.php';
		}
	spl_autoload_register("sp_autoloader");
	$m = new _spgroupmessage;
	$res = $m->read($_POST["groupid"]);
	if($res != false)
	{
		while($rows = mysqli_fetch_assoc($res))
		{
			echo "<div class='row'>";
				echo "<div class='col-md-10'><span style='font-size:17px;' class='commentoverflow'><img alt='profilepic' class='img-circle' src=' ". ($rows["spProfilePic"])."' style='width: 40px; height: 40px;' >&nbsp;".$rows["spProfileName"]." &nbsp;</span><span>".$rows["spGroupMessage"]."</span></div>";
				echo "<div class='col-md-2'>".$rows["spGroupMessageDate"]."</div>";
			echo "</div><br>";
				
		}
	}
?>