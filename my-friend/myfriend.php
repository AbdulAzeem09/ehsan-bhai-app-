<div class='row'>
	<div class='col-md-3'><h4>Friends</h4></div>
	<div class='col-md-7'><h4>Connected Profile</h4></div>
	<div class='col-md-2'><h4>Action</h4></div>
</div><hr class="frndinfo">

<?php
$b = array();
$r = new _spprofilehasprofile;
$res = $r->friends($_SESSION["uid"]);//As a receiver
if($res != false)
{
	while($rows = mysqli_fetch_assoc($res))
	{
		$p = new _spprofiles;
		$sender = $rows["spProfiles_idspProfileSender"];
		array_push($b,$sender);
		$result = $p->read($rows["spProfiles_idspProfileSender"]);
		if($result != false)
		{	echo "<div class='deletefriend'>";
			echo "<div class='row'>";
				$row = mysqli_fetch_assoc($result);
				echo "<div class='col-md-3'><img  alt='profile-Pic' class='img-rounded' style='width:30px; height: 30px;' src=' ".($row['spProfilePic'])."' >&nbsp;<a href='../friends/?profileid=".$rows["spProfiles_idspProfileSender"]."'><span class='searchtimelines title' data-profileid='".$row["idspProfiles"]."' style='cursor:pointer;font-size:14px;'>".$row["spProfileName"]." (".$row["spProfileTypeName"].")</span></a></div>";
				
				
				echo "<div class='col-md-7'>";
					$rs = $p->read($rows["spProfiles_idspProfileSender"],$_SESSION["uid"]);
					if($rs != false)
					{
						$rw = mysqli_fetch_assoc($rs);
						echo "<img  alt='profile-Pic' class='img-rounded' style='width:30px; height: 30px;' src=' ".($rw['spProfilePic'])."' >&nbsp;<a href='#'><span class='searchtimelines title' data-profileid='".$rw["idspProfiles"]."' style='cursor:pointer;font-size:14px;'>".$rw["spProfileName"]." (".$rw["spProfileTypeName"].")</span></a>";
					}
				echo "</div>";
				
				echo "<div class='col-md-2' style='margin-top:5px;'><a href='../publicpost/?friendid=".$rows["spProfiles_idspProfileSender"]."'>Store</a><span class='verticalline sp-group-details'> <a href='#' class='deleteMember' data-profileid='".$rows["spProfiles_idspProfileSender"]."'>Unfriend</a></span><span class='verticalline sp-group-details'> <a href='#' data-profileid='".$rows["spProfiles_idspProfileSender"]."' class='".($rows["spProfiles_has_spProfileFlag"] == 0  ?"unblockMember":"blockMember")."' >".($rows["spProfiles_has_spProfileFlag"] == 0 ?"Unblock":"Block")."</a></span></div>";
			echo "</div>";
			echo "<hr class='frndinfo'>";
			echo "</div>";
		}
    }
 }

$r = new _spprofilehasprofile;
$res = $r->friend($_SESSION["uid"]);//As a sender
if($res != false)
{
		
	while($rows = mysqli_fetch_assoc($res))
	{
		
		$rm = in_array($rows["spProfiles_idspProfilesReceiver"],$b,true);
		if($rm == ""){
		$p = new _spprofiles;
		$result = $p->read($rows["spProfiles_idspProfilesReceiver"]);
		if($result != false)
		{	echo "<div class='deletefriend'>";
			echo "<div class='row'>";
				$row = mysqli_fetch_assoc($result);
				echo "<div class='col-md-3'><img  alt='profile-Pic' class='img-rounded' style='width:30px; height: 30px;' src=' ".($row['spProfilePic'])."' >&nbsp;<a href='../friends/?profileid=".$rows["spProfiles_idspProfilesReceiver"]."'><span class='searchtimelines title' data-profileid='".$row["idspProfiles"]."' style='cursor:pointer;font-size:14px;'>".$row["spProfileName"]." (".$row["spProfileTypeName"].")</span></a></div>";
				
				//
				echo "<div class='col-md-7'>";
					$rs = $r->connectedprofile($rows["spProfiles_idspProfilesReceiver"],$_SESSION["uid"]);
					if($rs != false)
					{
						while($rw = mysqli_fetch_assoc($rs))
						{
							//profiledetails Testing
							$p = new _spprofiles;
							$rslt = $p->read($rw["spProfiles_idspProfileSender"]);
							if($rslt != false)
							{
								$rsender = mysqli_fetch_assoc($rslt);
								echo "<img  alt='profile-Pic' class='img-rounded' style='width:30px; height: 30px;' src=' ".($rsender['spProfilePic'])."' >&nbsp;<a href='#'><span class='searchtimelines title' data-profileid='".$rsender["idspProfiles"]."' style='cursor:pointer;font-size:14px;'>".$rsender["spProfileName"]." (".$rsender["spProfileTypeName"].")</span></a>";
							}
							//Testing Complete
						}
					}
				echo "</div>";
				
				echo "<div class='col-md-2' style='margin-top:5px;'><a href='../publicpost/?friendid=".$rows["spProfiles_idspProfilesReceiver"]."'>Store</a><span class='verticalline sp-group-details'> <a href='#' class='deleteMember' data-profileid='".$rows["spProfiles_idspProfilesReceiver"]."'>Unfriend</a></span><span class='verticalline sp-group-details'> <a href='#'  class='".($rows["spProfiles_has_spProfileFlag"] == 0  ?"unblockMember":"blockMember")."' data-profileid='".$rows["spProfiles_idspProfilesReceiver"]."'>".($rows["spProfiles_has_spProfileFlag"] == 0 ?"Unblock":"Block")."</a></span></div><br>";
				
			echo "</div>";
			echo "<hr class='class='frndinfo''>";
			echo "</div>";
			}
		}
	}
}
?>