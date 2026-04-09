		<div class="row">
			<div class="col-md-4">
				<div class="form-group">
					<label for="spPostingVehicleType_">Vehicle type</label>
					<select class="form-control spPostField" data-filter="1" name="spPostingVehicleType_" id="spPostingVehicleType_" value="<?php echo (empty($row["Vehicle type"]) ? "" : $row["Vehicle type"]);?>">
						<!--<option value="Car">Car</option>
						<option value="Saffari">Saffari</option>
						<option value="Ferrari">Ferrari</option>
						<option value="Scentro">Scentro</option>
						<option value="Hunddai">Hunddai</option>-->
						<?php
						$m = new _masterdetails;
						$masterid = 5;
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
			<div class="col-md-4">
				<div class="form-group">
					<label for="spPostingCarMake_">Make</label>
					<input type="text" class="form-control spPostField" data-filter="0" id="spPostingCarMake_" name="spPostingCarMake_" value="<?php echo (empty($row["Make"]) ? "" : $row["Make"]);?>">
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group">
					<label for="spPostingCarModal_">Modal</label>
					<input type="text" class="form-control spPostField" data-filter="1" id="spPostingCarModal_" name="spPostingCarModal_" value="<?php echo (empty($row["Modal"]) ? "" : $row["Modal"]);?>">
				</div>
			</div>
		</div><br>
			<div class="row">
				<div class="col-md-3">
					<div class="form-group">
						<label for="spPostingCarMileage_">Mileage</label>
						<input type="text" class="form-control spPostField" data-filter="1" id="spPostingCarMileage_" name="spPostingCarMileage_" value="<?php echo (empty($row["Mileage"]) ? "" : $row["Mileage"]);?>">
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label for="spPostingYearBuilt_">Year built</label>
						<input type="date" class="form-control spPostField" data-filter="1" id="spPostingYearBuilt_" name="spPostingYearBuilt_" value="<?php echo (empty($row["Year built"]) ? "" : $row["Year built"]);?>">
					</div>
				</div>
			
				<div class="col-md-3">
					<div class="form-group">
						<label for="spPostingPrice">Price</label>
						<input type="text" class="form-control" id="spPostingPrice" data-filter="1" name="spPostingPrice" value="<?php echo $ePrice;?>">
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label for="spPostingCarStatus_">Status</label>
						<select class="form-control spPostField" data-filter="1" name="spPostingCarStatus_" id="spPostingCarStatus_" value="<?php echo (empty($row["Status"]) ? "" : $row["Status"]);?>">
							<!--<option value="Used">Used</option>
							<option value="Unused">New</option>-->
							<?php
								$m = new _masterdetails;
								$masterid = 4;
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
			</div><br>
			

		
		
		
	
	