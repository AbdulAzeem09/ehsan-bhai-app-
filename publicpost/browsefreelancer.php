<?php
		session_start();
		function sp_autoloader($class){
			include '../mlayer/' . $class . '.class.php';
		}
		spl_autoload_register("sp_autoloader");
	$f = new _spprofiles;
		 $result = $f->freelancers($_SESSION['uid']);
	if($result != false)
	{
		while($rows = mysqli_fetch_assoc($result))
		{	
			echo "<div class='row'>";
				$picture = $rows['spProfilePic'];
				if(isset($picture))
					echo "<div class='col-md-1'>
					<img  alt='Posting Pic' class='img-circle' style='width:100px; height:100px;' src='".($picture)."' ></div>" ;
				
				else
					echo "<div class='col-md-1'>
					<img  alt='Posting Pic' class='img-circle' style='width:100px; height:100px;' src='../img/default-profile.png' ></div>" ;
				
				echo "<div style='margin-top:20px; margin-left:10px;'>";
					echo "<div><b style='color:#1a936f;'>".$rows["spProfileName"]."</b></div>";
					echo   "<h4 style='color:gray;'>About</h4><span style='margin-left:20px;'>" .$rows["spProfileAbout"] ."</span>";
				echo "</div>";
			echo "</div>";
			echo "<hr class='hrline' style='margin-top:10px;'><br>";
		}
	}
?>