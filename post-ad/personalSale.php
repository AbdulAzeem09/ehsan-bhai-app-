<?php

	if(isset($_POST["retailflag"]) && $_POST["retailflag"] == 1)
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
		
		$p = new _postingview;
		$r = $p->read($_POST["postid"]);
		if ($r != false)
		{
			$rw = mysqli_fetch_assoc($r);
			$ePrice = $rw["spPostingPrice"];
		}
		
	}
?>
	<script type="text/javascript">
        $(function() {
            $('#personalSalePrice').keypress(function(event){
                if(event.which != 8 && isNaN(String.fromCharCode(event.which))){
                   event.preventDefault(); //stop character from entering input
                }
           });
            $('#personalSaleQuantity_').keypress(function(event){
                if(event.which != 8 && isNaN(String.fromCharCode(event.which))){
                   event.preventDefault(); //stop character from entering input
                }
           });
            $('#personalSaleDiscount_').keypress(function(event){
                if(event.which != 8 && isNaN(String.fromCharCode(event.which))){
                   event.preventDefault(); //stop character from entering input
                }
           });
            
        });
    </script>
	<!-- Retail code of Sell-->
	<div class="retail">
		<div class="col-md-4">
			<div class="form-group">
				<label for="personalSalePrice" class="">Price ($)<span>* <span class="lbl_5"></span></span></label>
				<input type="text" class="form-control spPostField" data-filter="0" maxlength="8" id="personalSalePrice" name="spPostingPrice" value="<?php echo (empty($ePrice)?'':$ePrice); ?>" >
			</div>
		</div>
		<div class="col-md-4">
			<div class="form-group">
					<label for="personalSaleQuantity_" class="">Quantity<span>* <span class="lbl_6"></span></span></label>
					<input type="text" class="form-control spPostField" data-filter="0" maxlength="5" id="personalSaleQuantity_" name="personalSaleQuantity_" value="">
			</div>
		</div>
		
		<div class="col-md-4">
			<div class="form-group">
					<label for="personalSaleDiscount_" class="">Discount (%)<span>* <span class="lbl_7"></span></span></label>
					<input type="text" class="form-control spPostField" data-filter="0" maxlength="3" id="personalSaleDiscount_" name="personalSaleDiscount_" value="">
			</div>
		</div>
	
		<div class="col-md-4">
			<div class="form-group">
				<label for="personalSaleStatus_">Status <span>*</span></label>
				<select class="form-control spPostField" data-filter="1" id="personalSaleStatus_" name="personalSaleStatus_" value="">
					<?php
					$it = new _spAllStoreForm;
					$result3 = $it->readProductStatus();
					if ($result3) {
						while($row3 = mysqli_fetch_assoc($result3)){
							echo "<option value='".$row3["productStatusTitle"]."'>".ucwords(strtolower($row3["productStatusTitle"]))."</option>";
						}
					}
					?>
			  	</select>
			</div>
		</div>
	</div>