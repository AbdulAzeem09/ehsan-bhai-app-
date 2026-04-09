<?php
	$m = new _masterdetails;
?>
<div class="card">
  <ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#lookingfor" aria-controls="home" role="tab" data-toggle="tab">Looking For</a></li>
	<li role="presentation"><a href="#choice" aria-controls="profile" role="tab" data-toggle="tab">Choice</a></li>
  </ul>

  <div class="tab-content">
		<div role="tabpanel" class="tab-pane active" id="lookingfor">
		<?php
		$masterid = 18;
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
    <div role="tabpanel" class="tab-pane" id="choice">
	<?php
		$masterid = 13;
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


