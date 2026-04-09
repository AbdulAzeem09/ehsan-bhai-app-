<form action="addmember.php" method="post" class="form-horizontal" id="sp-add-member">

<?php
	session_start();
		function sp_autoloader($class){
			include '../mlayer/' . $class . '.class.php';
		}
		spl_autoload_register("sp_autoloader");
	$p = new _spprofiles;
	$rpvt = $p->read($_POST['pid']);
	if ($rpvt != false){
		$row = mysqli_fetch_assoc($rpvt);
	}
?>	
	
	<input type="hidden" name="spProfiles_idspProfiles" id="spProfiles_idspProfiles" value=<?php echo  $_POST['pid']; ?>></input>
	
	<input type="hidden" name="spGroup_idspGroup" id="spGroup_idspGroup" value></input>
	
	<input type="hidden" name="spApproveRegect" id="spApproveRegect" value ="1"></input>
	
	<input type="hidden" name="spProfileIsAdmin" id="spProfileIsAdmin" value="1"></input>
	
	<div id="sp-profile-page">
	<div class="form-group">
	<label class="col-sm-2 control-label">Email</label>
	<div class="col-sm-10">
		<p class="form-control-static"><?php echo $row['spProfileEmail'];?></p>
		</div>
	</div>
						
	<div class="form-group">
		<label class="col-sm-2 control-label">Phone</label>
		<div class="col-sm-10">
			<p class="form-control-static"><?php echo $row['spProfilePhone']?></p>
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-2 control-label">Profile type</label>
		<div class="col-sm-10">
			<p class="form-control-static"><?php echo $row['spProfileTypeName'];?></p>
		</div>
	</div>
	
	<div class="form-group">
		<label class="col-sm-2 control-label">Country</label>
		<div class="col-sm-10">
			<p class="form-control-static"><?php echo $row['spProfilesCountry'];?></p>
		</div>
	</div>
	
	<div class="form-group">
		<label class="col-sm-2 control-label">City</label>
		<div class="col-sm-10">
			<p class="form-control-static"><?php echo $row['spProfilesCity'];?></p>
		</div>
	</div>
	
	<div class="form-group">
		<label class="col-sm-2 control-label">About</label>
		<div class="col-sm-10">
			<p class="form-control-static"><?php echo $row['spProfileAbout'];?></p>
		</div>
	</div>
	
	<button id="submitMember" type="submit" class="btn btn-primary btn-sm hidden">Add</button>
	
	 
	 <?php
			$p = new _spgroup;
			$rpvt = $p->read($_POST['pid']);
			if ($rpvt != false){
				$row = mysqli_fetch_assoc($rpvt);
			}
		?>	
		  <a href="removeMember.php/?pid=<?php echo $_POST['pid'] ?>&gid=<?php echo $_POST["gid"] ?>" class="btn btn-danger btn-sm hidden deleteMember"> Remove </a>
</div>		 
</form>


	
