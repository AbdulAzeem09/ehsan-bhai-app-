<?php
	$g = new _spgroup; 
	$p = new _spprofiles;
	//$result = $f->readallfriend($_GET["profileid"]);
	$frndlist = array();
	$f = new _spprofilehasprofile;


	//====================
	//my friend list
	//====================
	//sender
	$myFrndList = array();
	$result3 = $f->readallfriend($_SESSION["pid"]);
	if($result3 != false){
		while ($row3 = mysqli_fetch_assoc($result3)) {
			array_push($myFrndList, $row3['spProfiles_idspProfilesReceiver']);
		}
	}
	//receiver
	$result4 = $f->readall($_SESSION["pid"]);
	if($result4 != false){
		while ($row4 = mysqli_fetch_assoc($result4)) {
			array_push($myFrndList, $row4['spProfiles_idspProfileSender']);
		}
	}
	//print_r($myFrndList);
	//====end my frnd list
	//============================
	//User visited friend list
	//============================
	//Sender
	$result5 = $f->readallfriend($_GET["profileid"]);
	if( $result5  != false){  		
		while ($row5 = mysqli_fetch_assoc($result5)) {
			array_push($frndlist, $row5['spProfiles_idspProfilesReceiver']);
		}
	}
	//receiver
	$result6 = $f->readall($_GET["profileid"]);
	//echo $f->ta->sql;
	if($result6 != false){
		while ($row6 = mysqli_fetch_assoc($result6)) {
			array_push($frndlist, $row6['spProfiles_idspProfileSender']);
		}
	}
	//====end my frnd list
	//==two array intersection
	$result5 = array_intersect($myFrndList, $frndlist);
	//print_r($result5);
	$MutualFrnd = count($result5);
	//=======================
	?>
	<div class="col-md-12 no-padding m_top_10">
		<?php
		foreach ($result5 as $key => $value) { 
			$pr = new _spprofiles;
			$result7 = $pr->read($value);
			//echo $f->ta->sql;
			if($result7 != false){
			  	$row7 = mysqli_fetch_array($result7);
			  	?>
			  	<a href="<?php echo $BaseUrl.'/friends/?profileid='.$value;?>">
					<?php
		  			$picture = $row7['spProfilePic'];
  					if(isset($picture))
						echo "<img style='height: 32px;width:32px;' alt='Profile Pic' class='img-circle' src=' ".($picture)."' >" ;
					else{
						echo "<img style='height: 32px;width:32px;' alt='Profile Pic' class='img-circle' src='../assets/images/icon/blank-img.png' >" ;
					} ?>
				</a> <?php
			}
		}
		?>
		<?php echo ($MutualFrnd > 0)?$MutualFrnd.' Mutual Friend': 'No Mutual Friends';?>
	</div>
	<div class="col-md-12">
		<hr>
	</div>
	<?php

	$result = $f->readallfriend($_GET["profileid"]);
	//echo $f->ta->sql;
	if( $result  != false){ 
		$flag = 0 ; 		//Sender
		printProfile($result,$flag );
	}
	
	$result2 = $f->readall($_GET["profileid"]);
	if($result2 != false){
		$flag = 1;		//Reciever
		echo printProfile($result2,$flag);
	}
	//user friend list show
	
	function printProfile($result,$flag){

	if($result != false){ ?>		
		<?php
		while($rows = mysqli_fetch_assoc($result)){	
			if($flag == 0)//sender
			{
				$profileid = $rows["spProfiles_idspProfilesReceiver"];
			}
			else //Receiver
			{
				$profileid = $rows["spProfiles_idspProfileSender"];
			}
			
			$p = new _spprofiles;
			$res = $p->read($profileid);
			//echo $f->ta->sql;
			if($res != false)
			{
			  	$row = mysqli_fetch_array($res);
			  	?>
			  	<div class="col-md-6 no-padding">
					<div class="row no-margin boxFriend">
						<div class="col-md-3 no-padding">
							<?php
		  					$picture = $row['spProfilePic'];
		  					if(isset($picture))
								echo "<img  alt='Profile Pic' class='img-responsive' src=' ".($picture)."' >" ;
							else{
								echo "<img  alt='Profile Pic' class='img-responsive' src='../assets/images/icon/blank-img.png' >" ;
							} ?>

						</div>
						<div class="col-md-9 rightbox sp-group-details">
							<a href="<?php echo '../friends/?profileid='.$profileid;?>"><?php echo $row["spProfileName"];?></a>
							<small><?php echo $row["spProfileTypeName"]; ?></small>
							<a class="btn btnUnfrnd pull-right" href="<?php echo '../friends/?profileid='.$profileid;?>">View Profile</a>
							
						</div>
					</div>
				</div>
	  			
	  			<?php
			}
		}
	}
}
?>