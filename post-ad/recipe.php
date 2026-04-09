	<br>	
	<div class="row">
	<div class="col-md-4">
			<div class="form-group">
				<label for="spPostingEventOrgName_">Recipe Name</label>
				<input type="text" class="form-control spPostField" data-filter="1" id="spPostingEventOrgName_" name="spPostingEventOrgName_" value="<?php echo (empty($row["Recipe Name"]) ? "" : $row["Recipe Name"]);?>" required>
			</div>
		</div>
		<div class="col-md-4">
			<div class="form-group">
				<label for="reciepcategory_">Category</label>
				<select class="form-control spPostField" id="reciepcategory_" data-filter="1" name="reciepcategory_" value="<?php echo (empty($row["Category"]) ? "" : $row["Category"]);?>">
					<?php
						$m = new _masterdetails;
						$masterid = 12;
						$result = $m->read($masterid);
						
						if($result != false)
						{
							while($rows = mysqli_fetch_assoc($result))
							{
								echo "<option value='".$rows["masterDetails"]."'>".$rows["masterDetails"]."</option>";
							}
						}
					?>
			  </select>
			</div>
		</div>
		<div class="col-md-2">
			<div class="form-group">
				<label for="spPostingTotalCalorie_">Total Calorie</label>
				<input type="text" class="form-control spPostField" data-filter="1" id="spPostingTotalCalorie_" name="spPostingTotalCalorie_" value="<?php echo (empty($row["Total Calorie"]) ? "" : $row["Total Calorie"]);?>">
			</div>
		</div>
		<div class="col-md-2">
			<div class="form-group">
				<label for="videoalbum_">Album</label>
				<!--Testing-->
				<div class="dropdown">
				  <button class="btn btn-default dropdown-toggle myalbum" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"><?php echo (empty($row["Album"]) ? "Select Album" : $row["Album"]);?>
					<span class="caret"></span>
				  </button>
				  <ul class="dropdown-menu" aria-labelledby="my_album">
					<?php
						$p = new _album;
						$res = $p->read($_SESSION['pid']);
						if ($res != false){
							while($rows = mysqli_fetch_assoc($res)) {
								echo "<li><a href='#' class='my-album-dd' data-albumid='".$rows['idspPostingAlbum']."' data-albumname='".$rows['spPostingAlbumName']."'>".$rows['spPostingAlbumName']."</a></li>";					
							}
						}
					?>
					<li role="separator" class="divider"></li>
					<li><a href="../../album/">Create New Album</a></li>
				  </ul>
				</div>
				<input type ="hidden" class="album_id" data-filter="0" name="spPostingAlbum_idspPostingAlbum_">
				<input type="hidden" class="form-control spPostField" data-filter="1" id="videoalbum_" name="videoalbum_" value="<?php echo (empty($row["Album"]) ? "" : $row["Album"]);?>">
			</div>
		</div>
	</div><br>
	<div class="row">
		<div class="col-md-6">
			<div class="form-group">
				<label for="spPostingEthinicity_">Ethnicity</label>
				<input type="text" class="form-control spPostField" data-filter="1" id="spPostingEthinicity_" name="spPostingEthinicity_" value="<?php echo (empty($row["Ethnicity"]) ? "" : $row["Ethnicity"]);?>" required>
			</div>
		</div>
		
		<div class="col-md-3">
			<div class="form-group">
				<label for="spPostingPrepTime_">Prep Time</label>
				<input type="time" class="form-control spPostField" data-filter="0" id="spPostingPrepTime_" name="spPostingPrepTime_" value="<?php echo (empty($row["Prep Time"]) ? "" : $row["Prep Time"]);?>">
			</div>
		</div>
		<div class="col-md-3">
			<div class="form-group">
				<label for="spPostingCookTime_">Cook time</label>
				<input type="time" class="form-control spPostField" data-filter="0" id="spPostingCookTime_" name="spPostingCookTime_" value="<?php echo (empty($row["Cook time"]) ? "" : $row["Cook time"]);?>">
			</div>
		</div>
	</div><br>
	<div class="row">
		<div class="col-md-6">
			<div class="form-group">
				<label for="spPostingIngredients_">Ingredients</label>
				<textarea class="form-control spPostField"  data-filter="0" id="spPostingIngredients_" name="spPostingIngredients_" rows="5" value="<?php echo (empty($row["Ingredients"]) ? "" : $row["Ingredients"]);?>"><?php echo (empty($row["Ingredients"]) ? "" : $row["Ingredients"]);?></textarea>
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<label for="spPostingDirection_">Direction</label>
				<textarea class="form-control spPostField" id="spPostingDirection_" data-filter="0" name="spPostingDirection_" rows="5" value="<?php echo (empty($row["Direction"]) ? "" : $row["Direction"]);?>"><?php echo (empty($row["Ingredients"]) ? "" : $row["Ingredients"]);?></textarea>
			</div>
		</div>
	</div><br>
	<div class="form-group">
		<label for="addvideo">Add Video</label>
		<input type="file" id="addvideo" class="spmedia" name="spPostingMedia[]"  accept="video/*"  multiple="multiple">
		<p class="help-block"><small>Browse</small></p>
	</div>
	<div id="media-container">
	</div>
	<br>
	
	