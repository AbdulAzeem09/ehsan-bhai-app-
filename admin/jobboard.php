<?php
	$m = new _masterdetails;
?>
<div class="card">
  <ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#joblevel" aria-controls="home" role="tab" data-toggle="tab">Job Level</a></li>
	<li role="presentation"><a href="#jobtype" aria-controls="profile" role="tab" data-toggle="tab">Job Type</a></li>
  </ul>

  <div class="tab-content">
		<div role="tabpanel" class="tab-pane active" id="joblevel">
		<?php
		$masterid = 2;
		$result = $m->read($masterid);
		if($result != false)
		{
			echo "<ul class='list-group'>";
			while($rows = mysqli_fetch_assoc($result))
			{
				echo "<li class='list-group-item'>";
					echo $rows["masterDetails"];
					echo "<div class='btn-group pull-right' role='group' aria-label='...'>";
						
						echo "<button type='button' class='btn btn-success btn-xs editMasterDetails' data-toggle='modal' data-target='#addupdate' data-masterdetailsid='".$rows["idmasterDetails"]."' data-masterdetails='".$rows["masterDetails"]."' data-masterid='".$rows["master_idmaster"]."'><span class='glyphicon glyphicon-pencil'></span></button>";
						
						echo "<button type='button' class='btn btn-danger btn-xs deleteMasterDetails' data-masterdetailsid='".$rows["idmasterDetails"]."'><span class='glyphicon glyphicon-remove'></span></button>";
					echo "</div>";
				echo "</li>";
			}
			echo "</ul>";
		}
		?>
		<button class="btn btn-primary pull-right master" data-toggle="modal" data-target="#addupdate" data-masterid="<?php echo $masterid ;?>">Add</button><br>
	</div>
    <div role="tabpanel" class="tab-pane" id="jobtype">
	<?php
		$masterid = 21;
		$result = $m->read($masterid);
		if($result != false)
		{
			echo "<ul class='list-group'>";
			while($rows = mysqli_fetch_assoc($result))
			{
				echo "<li class='list-group-item'>";
					echo $rows["masterDetails"];
					echo "<div class='btn-group pull-right' role='group' aria-label='...'>";
						
						echo "<button type='button' class='btn btn-success btn-xs editMasterDetails' data-toggle='modal' data-target='#addupdate' data-masterdetailsid='".$rows["idmasterDetails"]."' data-masterdetails='".$rows["masterDetails"]."' data-masterid='".$rows["master_idmaster"]."'><span class='glyphicon glyphicon-pencil'></span></button>";
						
						echo "<button type='button' class='btn btn-danger btn-xs deleteMasterDetails' data-masterdetailsid='".$rows["idmasterDetails"]."'><span class='glyphicon glyphicon-remove'></span></button>";
					echo "</div>";
				echo "</li>";
			}
			echo "</ul>";
		}
		?>
		<button class="btn btn-primary pull-right master" data-toggle="modal" data-target="#addupdate" data-masterid="<?php echo $masterid ;?>">Add</button><br>
	</div>
  </div>
</div>


