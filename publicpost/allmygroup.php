<?php
		$p = new _spgroup;
		//$rpvt = $p->asprofile($_SESSION['pid']);
		$rpvt = $p->groupmember($_SESSION['uid']);
		if ($rpvt != false)
		{	
			while($row = mysqli_fetch_assoc($rpvt))
			{
				echo "<li><a href='#' class='my-group-dd' data-gid='".$row['idspGroup']."' data-gname='".$row['spGroupName']."' data-profileid='".$_SESSION["pid"]."' data-categoryid='1600'>".$row['spGroupName']."</a></li>";
			}
		}
		
?>
		