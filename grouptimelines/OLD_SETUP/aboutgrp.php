<?php
	$g = new _spgroup;
	$result = $g->groupdetails($_GET["groupid"]);
	if($result != false)
	{
		$row = mysqli_fetch_assoc($result);
		$gname = $row["spGroupName"];
		$gtag = $row["spGroupTag"];
		$gdes = $row["spGroupAbout"];
		$gtype = $row["spgroupflag"];
		$gcategory= $row["spgroupCategory"];
		$glocation= $row["spgroupLocation"];
		$gimage = $row["spgroupimage"];
		
	}
	
?>


			
<div style="margin-bottom:10px;">
	<img src="<?php echo ($gimage); ?>" alt="Banner Image" class="img-rounded grpbanner">
	
	<input type="hidden" id="idspGroup"  value=<?php echo $_GET["groupid"]; ?>></input> 
	
	<h2><?php echo $gname;?></h2>
	<h3 class="help-block"><?php echo $gtag;?></h3>

	<div class="description">
		<p><?php echo $gdes;?></p>
	</div>
	
	<div class="row" style="margin-top:10px;">
		<div class="col-md-6 description">
			<label for="groupcategory">Group Category</label>
			<p><?php echo $gcategory;?></p>
		</div>
		
		<div class="col-md-6 description">
			<label for="male">Location</label>
			<p><?php echo $glocation;?></p>
		</div>
	</div>
</div>
			
		