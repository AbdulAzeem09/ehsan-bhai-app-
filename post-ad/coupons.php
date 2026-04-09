
		<div class="row">
			<div class="col-md-4">
				<div class="form-group">
					<label for="couponCategory_">Category</label>
					<select class="form-control spPostField" data-filter="1" name="couponCategory_" id="couponCategory_" value="<?php echo (empty($row["Category"]) ? "" : $row["Category"]);?>">
						<!--<option value="SPA">SPA</option>
						<option value="SPA">SPA</option>
						<option value="SPA">SPA</option>
						<option value="SPA">SPA</option>
						<option value="SPA">SPA</option>-->
						<?php
						$m = new _masterdetails;
						$masterid = 16;
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
					<label for="couponSize_">Sizes</label>
					<select class="form-control spPostField" data-filter="1" name="couponSize_" id="couponSize_" value="<?php echo (empty($row["Sizes"]) ? "" : $row["Sizes"]);?>">
						<!--<option value="Small">Small</option>
						<option value="Medium">Medium</option>
						<option value="Large">Large</option>
						<option value="XL">XL</option>
						<option value="NA">NA</option>-->
						<?php
						$m = new _masterdetails;
						$masterid = 17;
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
					<label for="couponquantity_">Limited Quantity</label>
					<input type="number" class="form-control spPostField" data-filter="0" name="couponquantity_" id="couponquantity_" value="<?php echo (empty($row["Limited Quantity"]) ? "" : $row["Limited Quantity"]);?>">
				</div>
				</div>
		</div><br>
			<div class="row">
				<div class="col-md-3">
					<div class="form-group">
						<label for="couponExp_">Expiry</label>
						<input type="date" data-filter="0" class="form-control spPostField" id="couponExp_" name="couponExp_" value="<?php echo (empty($row["Expiry"]) ? "" : $row["Expiry"]);?>" min="<?php echo date("Y-m-d");?>">
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label for="couponLocation_">Location</label>
						<input type="text" class="form-control spPostField" data-filter="1" id="couponLocation_" name="couponLocation_"  value="<?php echo (empty($row["Location"]) ? "" : $row["Location"]);?>">
					</div>
				</div>
			
				<div class="col-md-3">
					<div class="form-group">
						<!--<label for="couponValue_">Value</label>
						<input type="text" class="form-control" data-filter="0" id="couponValue_" name="couponValue_" value="<?php echo (empty($row["Value"]) ? "" : $row["Value"]);?>">-->
						<label for="spPostingPrice">Value</label>
						<input type="text" class="form-control" id="spPostingPrice" name="spPostingPrice" value="<?php echo $ePrice;?>">
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label for="coupondiscount_">Discount</label>
						<input type="number" class="form-control spPostField" data-filter="0" name="coupondiscount_" id="coupondiscount_" value="<?php echo (empty($row["Discount"]) ? "" : $row["Discount"]);?>">
					</div>
				</div>
			</div><br>
			
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label for="couponFilePrint_">File print</label>
						<textarea class="form-control spPostField" data-filter="0" name="couponFilePrint_" id="couponFilePrint_" rows="3" value="<?php echo (empty($row["File print"]) ? "" : $row["File print"]);?>"><?php echo (empty($row["File print"]) ? "" : $row["File print"]);?></textarea>
					</div>
				</div>
				<div class="col-md-6">
				<div class="form-group">
					<label for="couponOption_">Option</label>
					<textarea class="form-control spPostField" data-filter="0" name="couponOption_" id="couponOption_" rows="3" value="<?php echo (empty($row["Option"]) ? "" : $row["Option"]);?>"><?php echo (empty($row["Option"]) ? "" : $row["Option"]);?></textarea>
				</div>
				</div>
			</div><br>
			

		
		
		
	
	