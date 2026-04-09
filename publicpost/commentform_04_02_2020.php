<?php
	//session_start();
?>

<form action="../publicpost/addcomment.php" id="comntform" method="post">
	<input type="hidden" name="spPostings_idspPostings" id="timlinepost" value="<?php echo $rows['idspPostings']?>">
	<input class="dynamic-pid" name="spProfiles_idspProfiles" type="hidden" value="<?php echo $idspprofile?>">

	<input name="userid" type="hidden" value="<?php echo $_SESSION['uid']?>">
	
	<div class="row">
		<div class="col-md-12">
			<div class="input-group">
				<div class="input-group-addon commentprofile inputgroupadon">
					<?php
						$p = new _spprofiles;
						$result = $p->read($idspprofile);
						if($result != false)
						{
							$row = mysqli_fetch_assoc($result);
							if(isset($row["spProfilePic"]))
								echo "<img alt='profilepic' class='' src=' ". ($row["spProfilePic"])."' style='width: 30px; height: 30px;' >" ;
							else
								echo "<img alt='profilepic' class='' src='../assets/images/blank-img/default-profile.png' style='width: 30px; height: 30px;' >" ;
						}
					?>
				</div>
				<input type="text" class="form-control enterkey" name="comment" id="timeline"  placeholder="Type your comment here..." style='height:45px;border-radius: 0px;margin-bottom: 0px;'>
			</div>
		</div>
	</div>
</form>