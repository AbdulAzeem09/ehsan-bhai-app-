<?php
	if($_POST["flag"] == 1)
	{
		function sp_autoloader($class){
			include '../mlayer/' . $class . '.class.php';
		}
		spl_autoload_register("sp_autoloader");
		$f = new _postfield;
		$res = $f->field($_POST["postid"]);
		if($res != false)
			while($result = mysqli_fetch_assoc($res)){
				$row[$result["spPostFieldLabel"]] = $result["spPostFieldValue"];
				
		}
	}
?>

<div class="row">

           <!--  <div class="col-md-4" style="">
				<div class="form-group" style="padding-top: 26px;">
					<input type="radio" class=" spPostField" value="Hard" id="hardqty" name="quantitytype" checked>
					<label for="hardqty">Hard Quantity </label>
					<input type="radio" class=" spPostField" value="Soft" id="softqty" name="quantitytype" >
					<label for="softqty">Soft Quantity </label>
				    
				
				</div>
			</div>
 -->

	<div class="col-md-4">
		<div class="form-group">
			<label for="subcategory_">Subcategory</label>
			<select class="form-control spPostField" id="subcategory_" name="spSubcategory_" value="<?php echo (empty($row["Subcategory"]) ? "" : $row["Subcategory"]);?>" data-filter="1">
				<!--<option value="Jewellery">Jewellery</option>
				<option value="Electronics">Electronics</option>
				<option value="Mobile">Mobile</option>
				<option value="Watch">Watch</option>
				<option value="Cloths">Cloths</option>-->
				<?php
					$m = new _masterdetails;
					$masterid = 23;
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
				<label for="buyQuantity_">Quantity</label>
				<input type="text" class="form-control spPostField" id="buyQuantity_" name="spBuyQuantity_" value="<?php echo (empty($row["Quantity"]) ? "" : $row["Quantity"]);?>" data-filter="1">
			</div>
		</div>
		
		<div class="col-md-4">
			<div class="form-group">
				 <label for="amount">Price range</label>
				<input type="text" id="amount" class="form-control" name="spPostingPrice" value="<?php echo $ePrice;?>" data-filter="1">
			</div>
			<div id="slider-range"></div>
		</div>
</div><br>