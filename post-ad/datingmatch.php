		
	<div class="row">
		<div class="col-md-6">
			<div class="form-group">
				<label for="lookingFor_">Relationship Type</label>
				<select class="form-control spPostField" id="lookingFor_" data-filter="1" name="lookingFor_" value="<?php echo (empty($row["Looking For"]) ? "" : $row["Looking For"]);?>">
					<!--<option value="Friendship">Friendship</option>
					<option value="Marriage">Marriage</option>
					<option value="Relationship">Relationship</option>-->
					<?php
						$m = new _masterdetails;
						$masterid = 18;
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
		<div class="col-md-6">
			<div class="form-group">
				<label for="from_">For</label>
				<select class="form-control spPostField" id="from_" name="from_" data-filter="0" value="<?php echo (empty($row["From"]) ? "" : $row["From"]);?>">
					<option value="Male">Male</option>
					<option value="Female">Female</option>
			  </select>
			</div>
		</div>
	</div><br>
	<div class="row">
		<div class="col-md-6">
			<div class="form-group">
				<label for="spPostingAboutMe_">About me</label>
				<textarea class="form-control spPostField" id="spPostingAboutMe_" data-filter="0" name="spPostingAboutMe_" rows="3" required value="<?php echo (empty($row["About me"]) ? "" : $row["About me"]);?>"><?php echo (empty($row["About me"]) ? "" : $row["About me"]);?></textarea>
			</div>
		</div>
		
		<div class="col-md-6">
			<div class="form-group">
				<label for="spPostingAboutLooking_">Ideal Partner </label>
				<textarea class="form-control spPostField" id="spPostingAboutLooking_" data-filter="0" name="spPostingAboutLooking_" rows="3" value="<?php echo (empty($row["About Looking For"]) ? "" : $row["About Looking For"]);?>"><?php echo (empty($row["About Looking For"]) ? "" : $row["About Looking For"]);?></textarea>
			</div>
		</div>
	</div><br>
	<div class="row">
		<div class="col-md-6">
			<div class="form-group">
				<label for="spPostingChoice_">Choice</label>
				<select class="form-control spPostField" id="spPostingChoice_" data-filter="1" name="spPostingChoice_" value="<?php echo (empty($row["Choice"]) ? "" : $row["Choice"]);?>">
					<!--<option value="Non-Smoker">Non- Smoker</option>
					<option value="Drinking Habbits">Drinking Habbits</option>
					<option value="Enthnicity">Ethnicity</option>
					<option value="Religion">Religion</option>
					<option value="Pets">Pets</option>-->
					<?php
						$m = new _masterdetails;
						$masterid = 13;
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
		<div class="col-md-6">
			<div class="form-group">
				<label for="spPostingLocation_">Location</label>
				<input type="text" class="form-control spPostField" id="spPostingLocation_" data-filter="1" name="spPostingLocation_" value="<?php echo (empty($row["Location"]) ? "" : $row["Location"]);?>">
			</div>
		</div>
	</div><br>
	
	