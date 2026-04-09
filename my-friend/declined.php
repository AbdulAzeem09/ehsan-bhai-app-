<?php
	$r = new _spprofilehasprofile;
	$res = $r->declined($_SESSION["uid"]);
	if($res != false)
	{
		while($rows = mysqli_fetch_assoc($res))
		{
			
			$p = new _spprofiles;
			$sender = $rows["spProfiles_idspProfileSender"];
			$receiver = $rows["spProfiles_idspProfilesReceiver"];
			$result = $p->read($rows["spProfiles_idspProfileSender"]);
			if($result != false)
			{	
				$row = mysqli_fetch_assoc($result);
				echo "<div class='row'>";
					echo "<div class='col-md-3' style='padding:10px;'><img  alt='profile-Pic' class='img-rounded' style='width:30px; height: 30px;' src=' ".($row['spProfilePic'])."' >&nbsp;&nbsp;<a href='/friends/?profileid=".$rows["spProfiles_idspProfileSender"]."'>".$row["spProfileName"]." (".$row["spProfileTypeName"].")</a></div>" ;
					
					echo "<div class='col-md-5'></div>";
					echo "<div class='col-md-4'>";
						echo "<div class='btn-group pull-right' role='group' aria-label='Basic example' style='padding:10px;'>
						  <button type='button' class='btn btn-primary btn-sm acceptrequest' data-sender='".$sender."' data-receiver='".$receiver."'>Accept</button>
						</div>";
					echo "</div>";
				echo "</div>";
				echo "<hr>";
			}
			
		}
	}
?>