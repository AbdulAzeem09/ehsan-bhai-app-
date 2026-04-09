
<div class="sp-group-details">
<?php
$r = new _sppostrating;
$p = new _spprofiles;
$rp = $p->readProfiles($_SESSION['uid']);
$s = new _spprofilehasprofile;
$i = 0;
if ($rp != false)
{
	
	while($row = mysqli_fetch_assoc($rp))
	{	
		if($row['spProfileType_idspProfileType'] == 1 || $row['spProfileType_idspProfileType'] == 3 || $row['spProfileType_idspProfileType'] == 4)
		{
			$flag = 0;
			$result = $s->checkfriend($row['idspProfiles'],$_GET["profileid"]);
			if($result != false)
			{
				$rw = mysqli_fetch_assoc($result);
				if($rw["spProfiles_has_spProfileFlag"] == 1)
				{
					$flag = 1;
					$i++;
				}
					
			}
			// ".($flag == 1?"disabled":"")."
			echo "<div class='checkbox'><input type='checkbox' class='selected-profile' data-ptid='".$row['spProfileType_idspProfileType']."' data-pid='".$row['idspProfiles']."' data-ptname='".$row['spProfileTypeName']."' data-profilename='".$row['spProfileName']."'><span class='".$row['spprofiletypeicon']."'></span> ".$row['spProfileName']."</input><a href='#' class='deleteMember pull-right ".($flag == 1?"":"hidden")."' data-profileid='".$row['idspProfiles']."'>Unfriend</a></div>";
		}
	}
}
?>
</div>