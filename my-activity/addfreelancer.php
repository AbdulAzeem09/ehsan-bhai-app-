<?php 
session_start();
	function sp_autoloader($class){
			include '../mlayer/' . $class . '.class.php';
		}
		spl_autoload_register("sp_autoloader");
	
		$g = new _spgroup;
		$res = $g->readfreelancers($_SESSION['uid']);
		//echo $g->ta->sql;
		if($res != false)
		{
			while($rows = mysqli_fetch_assoc($res))
			{
				if($rows["spGroupName"] == "Favourite_Freelancer")
				{
					$gid = $rows["idspGroup"];
					echo $gid;
				}
			}
			if(!isset($gid))
			{
				$pid = $_SESSION["pid"];
				$gid = $g->createFreelancer($pid);
				echo $gid;
			}
		}
		
		else
		{	
			$pid = $_SESSION["pid"];
			$gid = $g->createFreelancer($pid);
			echo $gid;
		}
		$g->addfreelancer($gid,$_POST["profileid"]);
?>