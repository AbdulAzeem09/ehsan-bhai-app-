<?php
	$f = new _spprofiles;
	switch($freelancertimeline){
		case 1:  $result = $f->freelancers($_SESSION['uid']);
		break;
		
		case 2: $result = $f->myfreelancer($_SESSION['uid']);
		break;
	}
		
	
	
	if($result != false)
	{
		while($rows = mysqli_fetch_assoc($result))
		{	echo "<div class='mfreelancer'>";
			echo "<div class='row'>";
			$picture = $rows['spProfilePic'];
			if(isset($picture))
				echo "<div class='col-md-2'>
				<img  alt='Posting Pic' class='img-circle' style='width:100px; height:100px;' src=' ".($picture)."' ></div>" ;
			
			else
				echo "<div class='col-md-2'>
				<img  alt='Posting Pic' class='img-circle' style='width:100px; height:100px;' src='../img/default-profile.png' ></div>" ;
			
			echo "<div style='margin-top:20px; margin-left:10px;'>";
				echo "<div class='searchtimelines' data-profileid='".$rows["idspProfiles"]."'><b style='color:#1a936f; cursor:pointer'>".$rows["spProfileName"]."</b></div>";
				echo   "<h4 style='color:gray;'>About</h4><span style='margin-left:20px;'>" .$rows["spProfileAbout"] ."</span>";
			echo "</div>";
			
			
				$i = 0;
				$g = new _spgroup;
				$res = $g->checkfreelancer($rows["idspProfiles"],$_SESSION["uid"]);
				if($res != false)
				{
					$rw = mysqli_fetch_assoc($res);
					$groupid = $rw["idspGroup"];
					$i++;
				}
				echo "<button class='".($freelancertimeline != 2?"":"hidden")." btn btn-success btn-large pull-right ".($i==0?"freelancers":"deletefreelancer")."' type='button' data-freelancerid='".$rows["idspProfiles"]."' data-groupid='".$groupid."'><span class='glyphicon glyphicon-heart'></span> ".($i==0?"Add to Favourite":"Remove")."</button>";
			
			if($freelancertimeline == 2)
			{
				echo "<button class='btn btn-success btn-large pull-right deletefav' type='button' data-freelancerid='".$rows["idspProfiles"]."' data-groupid='".$groupid."'><span class='glyphicon glyphicon-heart'></span> Remove</button>";
			}
		
				
			echo "</div>";
			echo "<hr class='hrline' style='margin-top:10px;'><br>";
			echo "</div>";
		}
	}
?>