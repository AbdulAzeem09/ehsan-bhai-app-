<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title">Add Friends</h3>
	</div>
	<div class="panel-body">
		<div style="height:200px; overflow-y: auto; overflow-x: hidden;" class="friend_message">
		<?php
			$b = array();
			$g = new _spgroup;
			$r = new _spprofilehasprofile;
			$res = $r->friends($_SESSION["uid"]);//As a receiver
			if($res != false)
			{
				
				while($rows = mysqli_fetch_assoc($res))
				{
					if($rows["spProfiles_has_spProfileFlag"] == 1){
						$p = new _spprofiles;
						$sender = $rows["spProfiles_idspProfileSender"];
						array_push($b,$sender);
						$result = $p->read($rows["spProfiles_idspProfileSender"]);
						if($result != false)
						{	
							$rs =$g->readMember($rows["spProfiles_idspProfileSender"],$_POST["gid"]);
							if($rs != false)
							{
								
							}
							else
							{	echo "<div class='hidefriend'>";
								echo "<div class='row'>";
								$row = mysqli_fetch_assoc($result);
								echo "<div class='col-md-11'><img  alt='profile-Pic' class='img-rounded' style='width:30px; height: 30px;' src=' ".($row['spProfilePic'])."' >&nbsp;<a href='../friends/?profileid=".$rows["spProfiles_idspProfileSender"]."'><span class='searchtimelines title' data-profileid='".$row["idspProfiles"]."' style='cursor:pointer;font-size:14px;'>".$row["spProfileName"]." (".$row["spProfileTypeName"].")</span></a></div>";
								
								echo "<div class='col-md-1'><input class='unchecked' type='checkbox' data-pid='".$rows["spProfiles_idspProfileSender"]."' data-pname='".$row["spProfileName"]."' data-gid='".$_POST["gid"]."'></div>";
							echo "</div>";
							echo "<hr></div>";
							}
						}
					}
				}
			}

			$r = new _spprofilehasprofile;
			$res = $r->friend($_SESSION["uid"]);//As a sender
			if($res != false)
			{
				while($rows = mysqli_fetch_assoc($res))
				{
					if($rows["spProfiles_has_spProfileFlag"] != 0){
						$rm = in_array($rows["spProfiles_idspProfilesReceiver"],$b,true);
						if($rm == ""){
						$p = new _spprofiles;
						$result = $p->read($rows["spProfiles_idspProfilesReceiver"]);
						if($result != false)
						{	
							$rs =$g->readMember($rows["spProfiles_idspProfilesReceiver"],$_POST["gid"]);
							if($rs != false)
							{
								
							}
							else
							{
								echo "<div class='hidefriend'>";
								echo "<div class='row '>";
								$row = mysqli_fetch_assoc($result);
								echo "<div class='col-md-11'><img  alt='profile-Pic' class='img-rounded' style='width:30px; height: 30px;' src=' ".($row['spProfilePic'])."' >&nbsp;<a href='../friends/?profileid=".$rows["spProfiles_idspProfilesReceiver"]."'><span class='searchtimelines title' data-profileid='".$row["idspProfiles"]."' style='cursor:pointer;font-size:14px;'>".$row["spProfileName"]." (".$row["spProfileTypeName"].")</span></a></div>";
								
								echo "<div class='col-md-1'><input class='unchecked' type='checkbox' data-pid='".$rows["spProfiles_idspProfilesReceiver"]."' data-gid='".$_POST["gid"]."' data-pname='".$row["spProfileName"]."'></div>";
							echo "</div>";
							echo "<hr></div>";
							
							}
						}
					}
				}
			  }
			}
		?>
		</div>
		<button type="button" class="btn btn-primary pull-right" id="addcheckeditem"><span class="glyphicon glyphicon-plus glyphicon "></span> Add</button>
	</div>
</div>

