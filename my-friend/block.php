	

	<div class="row no-margin findRealTimeSearch">
		<div class="col-md-6 no-padding">
			<h4>Blocked List</h4>
		</div>
		<div class="col-md-6 no-padding">
			<form class="form-inline">

				<div class="form-group pull-right">
					<label>Filter By</label>
					<input type="text" name="" placeholder="Profile Name" class="form-control no-radius" id="searchtx" />
				</div>
			</form>
		</div>
	</div>

	<div class='row'>
		<div class='col-md-6'><h4></h4></div>
		<div class='col-md-6 text-center'><h4>Action</h4></div>
	</div>
	<hr class="underline" style="margin-top: 0px;">

	<?php
	$r 	= new _spprofilehasprofile;
	$pv = new _postingview;
	$f 	= new _spprofilefeature;
	$res = $f->getmyblockuser($_SESSION['pid']);

	//echo $f->ta->sql;
	if($res != false){
		
		while($rows = mysqli_fetch_assoc($res)){
			$p = new _spprofiles;
			$blockUser = $rows["idspProfile_to"];

			$result = $p->read($blockUser);
			//echo $p->ta->sql;

			if($result != false){
				$row = mysqli_fetch_assoc($result);
				$totalFrnd = $r->countTotalFrnd($row['idspProfiles']);
				//get friend store
                $result3 = $pv->singlefriendstore($blockUser);
                if($result3 != false){
                	if(mysqli_num_rows($result3) > 0){
                		$storeshow = mysqli_num_rows($result3);
                	}else{
                		$storeshow = 0;
                	}
                }else{
                	$storeshow = 0;
                }
				?>
				<div class="searchable deletefriend">
					<div class="row">
						<div class="col-md-6 ">
							<?php 
							echo "<img  alt='profile-Pic' class='img-responsive' src='".(isset($row['spProfilePic'])?" ".($row['spProfilePic'])."":"../img/default-profile.png")."'>";
							?>
							<a href='<?php echo $BaseUrl."/friends/?profileid=".$blockUser;?>'><span class='searchtimelines title' data-profileid="<?php echo $row["idspProfiles"];?>" ><?php echo strtolower($row["spProfileName"]." (".$row["spProfileTypeName"].")");?></span></a>
							<span class="totalfriend"><?php echo $totalFrnd;?> Friends</span>
						</div>
						<div class="col-md-6 text-center">
							<span class='verticalline sp-group-details'> <a href='<?php echo $BaseUrl.'/friends/favourite.php?block=0&by='.$_SESSION['pid'].'&to='.$blockUser;?>' class='btn' >Unblock</a></span>
							<span class="verticalline sp-group-details">|</span>
							<span class='verticalline sp-group-details'> <a href='<?php echo $BaseUrl.'/friends/?profileid='.$blockUser;?>' class='btn' >View Detail</a></span>

						</div>
					</div>
				</div>
				<?php
			}
	    }
	}

	
	?>