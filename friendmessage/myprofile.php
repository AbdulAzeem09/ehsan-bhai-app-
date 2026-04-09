<?php
	$r = new _spprofilehasprofile;
	//My profile as a Receiver
	$res = $r->myprofileidReciever($_SESSION["uid"] ,$_POST["friendid"]);
	if($res != false)
	{

		while($rows = mysqli_fetch_assoc($res))
		{
			$pr = new _spprofiles;
			$result = $pr->read($rows["spProfiles_idspProfilesReceiver"]);
			if($result != false)
			{
				$row = mysqli_fetch_assoc($result);
				$myname = $row["spProfileName"];
			}
		}
	}
	//My profile as a Receiver
	$res = $r->myprofileidSender($_SESSION["uid"] ,$_POST["friendid"]);
	if($res != false)
	{

		while($rows = mysqli_fetch_assoc($res))
		{
			
			$pr = new _spprofiles;
			$result = $pr->read($rows["spProfiles_idspProfileSender"]);
			if($result != false)
			{
				$row = mysqli_fetch_assoc($result);
				$myname = $row["spProfileName"];
			}
		}
	}
?>