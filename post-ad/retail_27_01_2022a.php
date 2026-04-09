<?php

	if(isset($_POST["retailflag"]) && $_POST["retailflag"] == 1){
		function sp_autoloader($class){
			include '../mlayer/' . $class . '.class.php';
		}
		spl_autoload_register("sp_autoloader");
		$f = new _postfield;
		$res = $f->field($_POST["postid"]);
		if($res != false)
			while($result = mysqli_fetch_assoc($res)){
				$row[$result["spPostFieldName"]] = $result["spPostFieldValue"];
		}
		
		$p = new _postingview;
		$r = $p->read($_POST["postid"]);
		if ($r != false)
		{
			$rw = mysqli_fetch_assoc($r);
			$ePrice = $rw["spPostingPrice"];
		}
		
	}
	//print_r($row);
?>	
	<script type="text/javascript">
        $(function() {
            $('#retailPrice').keypress(function(e){
                if(isNaN(this.value+""+String.fromCharCode(e.charCode))){
                   e.preventDefault(); //stop character from entering input
                }
           });
            $('#retailDiscount_').keypress(function(e){
                if(isNaN(this.value+""+String.fromCharCode(e.charCode))){
                   e.preventDefault(); //stop character from entering input
                }
           });
            $('#retailSpecDiscount_').keypress(function(e){
                if(isNaN(this.value+""+String.fromCharCode(e.charCode))){
                   e.preventDefault(); //stop character from entering input
                }
           });
           //  $('#retailQuantity_').keypress(function(e){
           //      if(isNaN(this.value+""+String.fromCharCode(e.charCode))){
           //         e.preventDefault(); //stop character from entering input
           //      }
           // });
        });
    </script>

	<!-- Retail code of Sell-->
	<div class="retail">
	        <div class="col-md-4" style="">
				<div class="form-group" style="padding-top: 26px;">
					
						<input type="radio" class="quantity " value="Hard" id="hardqty" name="quantitytype" <?php if($quantitytype == "Hard" ){ echo "checked";}else{ echo "checked"; } ?> >
					<label for="hardqty">Hard Quantity </label>
					<input type="radio" class="quantity " value="Soft" id="softqty" name="quantitytype" <?php if($quantitytype == "Soft" ){ echo "checked";} ?>>
					<label for="softqty">Soft Quantity </label>

					<input type="hidden" id="quantity" class="spPostField" name="quantitytype" value="Hard">
				    
				</div>
			</div>

		<div class="col-md-4">
			<div class="form-group">
				<!-- <label for="retailPrice" class="">Price ($)<span>* <span class="lbl_5"></span></span></label>
				<input type="text" class="form-control spPostField" data-filter="0" maxlength="8" id="retailPrice" name="spPostingPrice" value="<?php echo (empty($ePrice)?'':$ePrice); ?>" > -->
			</div>
		</div>


		<div class="col-md-4">
			<div class="form-group">
				<label for="retailPrice" class="">Price ($)<span>* <span class="lbl_5"></span></span></label>
				<input type="text" class="form-control spPostField" data-filter="0" maxlength="8" id="retailPrice" name="spPostingPrice" value="<?php echo (empty($price)?'':$price); ?>" >
			</div>
		</div>
		<div class="col-md-4">
			<div class="form-group">
				<label for="retailDiscount_" class="">Discount (%)</label>
				<input type="text" class="chekspnum form-control spPostField" data-filter="0" maxlength="3" id="retailDiscount_" name="retailDiscount" value="<?php echo (empty($retailDiscount) ? "" : $retailDiscount);?>">
			</div>
		</div>
		<div class="col-md-4">
			<div class="form-group">
				<label for="retailSpecDiscount_" class="">Special Discount (%) <u>(for 1st Connection only)</u> </label>
			<!-- <input type="text" class="form-control spPostField" placeholder="Only for 1st connection" maxlength="3" data-filter="0" id="retailSpecDiscount_" name="retailSpecDiscount_" value="<?php echo (empty($row["retailSpecDiscount_"])?"": $row["retailSpecDiscount_"]); ?>"> -->
				<input type="text" class="form-control spPostField" placeholder="" maxlength="3" data-filter="0" id="retailSpecDiscount_" name="retailSpecDiscount" value="<?php echo (empty($retailSpecDiscount)?"": $retailSpecDiscount); ?>">
			</div>
		</div>


      	<div class="col-md-4">
			<div class="form-group">
				<label for="retailQuantity_" class="">Quantity <span>* <span class="lbl_6"></span></span></label>
				<input type="text" class="form-control spPostField" data-filter="0" id="retailQuantity_" maxlength="15" name="retailQuantity" placeholder="e.g: 2 pieces, kg etc.." value="<?php echo (empty($retailQuantity) ? "" : $retailQuantity);?>">
			</div>
		</div>
		
		
	
		<div class="col-md-4">
			<div class="form-group">
				<label for="retailStatus_">Status <span>*</span></label>
				<select class="form-control spPostField" data-filter="1" id="retailStatus_" name="retailStatus" value="<?php echo (empty($retailStatus) ? "" : $retailStatus);?>">
					
					<?php
					$it = new _spAllStoreForm;
					$result3 = $it->readProductStatus();
					if ($result3) {
						while($row3 = mysqli_fetch_assoc($result3)){
							?>
							
							  <option value="<?php echo $row3['productStatusTitle'] ?>" <?php if($row3['productStatusTitle'] == $retailStatus){  echo "selected"; } ?> > <?php echo $row3['productStatusTitle']; ?> </option>

							<?php
						}
					}
					?>
			  </select>
			</div>
		</div>
 




 </div>

<!-- <div class="retail"> -->

	<!-- 	<div class="col-md-4">
			<div class="form-group">
				<label for="retailQuantity_" class="">Quantity <span>* <span class="lbl_6"></span></span></label>
				<input type="text" class="form-control spPostField" data-filter="0" id="retailQuantity_" maxlength="5" name="retailQuantity_" value="<?php echo (empty($row["retailQuantity_"]) ? "" : $row["retailQuantity_"]);?>">
			</div>
		</div>
		
		
	
		<div class="col-md-4">
			<div class="form-group">
				<label for="retailStatus_">Status <span>*</span></label>
				<select class="form-control spPostField" data-filter="1" id="retailStatus_" name="retailStatus_" value="<?php echo (empty($row["retailStatus_"]) ? "" : $row["retailStatus_"]);?>">
					
					<?php
					$it = new _spAllStoreForm;
					$result3 = $it->readProductStatus();
					if ($result3) {
						while($row3 = mysqli_fetch_assoc($result3)){
							echo "<option value='".$row3["productStatusTitle"]."'>".$row3["productStatusTitle"]."</option>";
						}
					}
					?>
			  </select>
			</div>
		</div> -->
		

<!-- 	</div> -->

  <script type="text/javascript">
  	
		$(".quantity").click(function(){
            var radioValue = $("input[name='quantitytype']:checked").val();
            if(radioValue){

            	$("#quantity").val(radioValue);
                //alert("Your are a - " + radioValue);
            }
        });
  </script>