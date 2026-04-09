<?php
	session_start();
	function sp_autoloader($class)
	{
		include '../mlayer/' . $class . '.class.php';
	}
	spl_autoload_register("sp_autoloader");
	
	$c = new _comment;
	$result = $c->read($_POST['idspPostings']);
	if($result != false)
	{
		while($row = mysqli_fetch_assoc($result))
		{	
			$profilename = $row["spProfileName"];
			$comment = $row["comment"];
			$picture = $row["spProfilePic"];
			$date = $row["commentdate"];
		}
		echo "<a href='#' data-toggle='modal' data-target='#mycomment'><span  style='margin-left:10px;' class='morecomment' data-postid='" . $_POST['idspPostings'] . "' >View previous comments</span></a>";
		echo "<div class='row' style='margin-left:10px;'>";
			if(isset($picture))
				echo "<div class='col-md-3 commentoverflow'><img alt='profilepic'  class='img-circle' src=' ".($picture)."' style='width: 40px; height: 40px;'><span style='color:#1a936f;'>" .$profilename."</span></div>";
			else
				echo "<div class='col-md-3 commentoverflow'><img alt='profilepic'  class='img-circle' src='../img/default-profile.png' style='width: 40px; height: 40px;'><span style='color:#1a936f;'>" .$profilename."</span></div>";
				
			
			echo "<div class='col-md-6 commentoverflow' style='margin-top:8px;'><span style='color:gray;' >".$comment."</span></div>";
			
			echo "<div class='col-md-3'><span style='color:gray;'>".$date."</span></div>";
		echo "</div>";
	}
?>