
	<div class='row'>
		<div class='col-md-8'><h4>Friends</h4></div>
		<div class='col-md-4 text-center'><h4>Action</h4></div>
	</div>
	<hr class="underline">

	<?php
	$b = array();
	$r = new _spprofilehasprofile;
	$res = $r->readall_recently($_SESSION["pid"]);//As a receiver
	//echo $r->ta->sql;
	if($res != false){
		while($rows = mysqli_fetch_assoc($res)){
			$p = new _spprofiles;
			$sender = $rows["spProfiles_idspProfileSender"];
			array_push($b,$sender);
			$result = $p->read($rows["spProfiles_idspProfileSender"]);
			if($result != false){
				$row = mysqli_fetch_assoc($result);
				$totalFrnd = $r->countTotalFrnd($row['idspProfiles']);

				?>
				<div class="deletefriend">
					<div class="row">
						<div class="col-md-8">
							<?php 
							echo "<img  alt='profile-Pic' class='img-responsive' src='".(isset($row['spProfilePic'])?" ".($row['spProfilePic'])."":"../img/default-profile.png")."'>";
							?>
							<a href='<?php echo $BaseUrl."/friends/?profileid=".$rows["spProfiles_idspProfileSender"];?>'><span class='searchtimelines title' data-profileid="<?php echo $row["idspProfiles"];?>" ><?php echo $row["spProfileName"]." (".$row["spProfileTypeName"].")";?></span></a>
							<span class="totalfriend"><?php echo $totalFrnd;?> Friends</span>
						</div>
						<div class="col-md-4 text-center">
							<span class='verticalline sp-group-details'> <a href='#' class='btn deleteMember' data-profileid='<?php echo $rows["spProfiles_idspProfileSender"];?>'>Unfriend</a></span>
						</div>
					</div>
				</div>
				<?php
			}
	    }
	 }

	$r = new _spprofilehasprofile;
	$res = $r->readall_recently_sender($_SESSION["pid"]);//As a sender
	//echo $r->ta->sql;
	if($res != false){
		while($rows = mysqli_fetch_assoc($res)){
			
			$rm = in_array($rows["spProfiles_idspProfilesReceiver"],$b,true);
			if($rm == ""){
			$p = new _spprofiles;
			$result = $p->read($rows["spProfiles_idspProfilesReceiver"]);
			if($result != false){
				$row = mysqli_fetch_assoc($result);
				$totalFrnd2 = $r->countTotalFrnd($row['idspProfiles']);
				?>
				<div class="deletefriend">
					<div class="row">
						<div class="col-md-8">
							<?php 
							echo "<img  alt='profile-Pic' class='img-responsive' src='".(isset($row['spProfilePic'])?" ".($row['spProfilePic'])."":"../img/default-profile.png")."'>";
							?>
							<a href='<?php echo $BaseUrl."/friends/?profileid=".$rows["spProfiles_idspProfilesReceiver"];?>'><span class='searchtimelines title' data-profileid="<?php echo $row["idspProfiles"];?>" ><?php echo $row["spProfileName"]." (".$row["spProfileTypeName"].")";?></span></a>
							<span class="totalfriend"><?php echo $totalFrnd2?> Friends</span>
						</div>
						<div class="col-md-4 text-center">
							<span class='verticalline sp-group-details'> <a href='#' class='btn deleteMember' data-profileid='<?php echo $rows["spProfiles_idspProfileSender"];?>'>Unfriend</a></span>
							
						</div>
					</div>
				</div>
				<?php
				
				}
			}
		}
	}else{

	 	echo"<h5 class='text-center'>No Record Found!</h5>";
	 }
	?>