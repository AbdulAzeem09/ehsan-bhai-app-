<?php
	$r = new _spprofilehasprofile;
	$res = $r->friendReequestAll($_SESSION["pid"]);
	//echo $r->ta->sql;
	
	$total = 0;
	if($res != false)
	{
		
		
		$total = $res->num_rows;
		while($rows = mysqli_fetch_assoc($res))
		{
			
			$p = new _spprofiles;
			$sender = $rows["spProfiles_idspProfileSender"];
			$receiver = $rows["spProfiles_idspProfilesReceiver"];
			$result = $p->read($rows["spProfiles_idspProfileSender"]);
			if($result != false)
			{	
				$row = mysqli_fetch_assoc($result);
					$pr=$row['spProfilePic'];
					if($pr==""){
	$row['spProfilePic']="https://thesharepage.com/assets/images/icon/blank-img.png";
					}
				echo "<div class='row'>";
					echo "<div class='col-md-8' style='padding:10px;'><img  alt='profile-Pic' class='img-rounded' style='width:30px; height: 30px;' src=' ".($row['spProfilePic'])."' >&nbsp;&nbsp;<a href='../friends/?profileid=".$rows["spProfiles_idspProfileSender"]."'>".$row["spProfileName"]." (".$row["spProfileTypeName"].")</a></div>" ;
					
					echo "<div class='col-md-4'>";
						echo "<div class='btn-group pull-right' role='group' aria-label='Basic example' style='padding:10px;'>
						  
						  <button type='button' class='btn btn-primary btn-sm acceptrequest' data-sender='".$sender."' data-receiver='".$receiver."'>Accept</button>
						  
						  <button type='button' class='btn btn-warning btn-sm rejectrequest'  data-sender='".$sender."' data-receiver='".$receiver."'>Reject</button>
						</div>";
					echo "</div>";
				 echo "</div>";
				echo "<hr>";
			}
			
		}
	}else{

		echo"<h5 class='text-center'>No Record Found!</h5>";
	}
?>