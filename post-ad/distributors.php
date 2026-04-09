<?php
	if($_POST["retailflag"] == 1)
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
            $('#distributorsprice').keypress(function(event){
                if(event.which != 8 && isNaN(String.fromCharCode(event.which))){
                   event.preventDefault(); //stop character from entering input
                }
           });
            $('#minorderqty_').keypress(function(event){
                if(event.which != 8 && isNaN(String.fromCharCode(event.which))){
                   event.preventDefault(); //stop character from entering input
                }
           });
            $('#supplyability_').keypress(function(event){
                if(event.which != 8 && isNaN(String.fromCharCode(event.which))){
                   event.preventDefault(); //stop character from entering input
                }
           });
           
        });
    </script>

	<div class="Distributors">
		
		<div class="col-md-4">
			<input type="hidden" id="wholesellflag" name="spPostingsFlag" value="0"> 
			<div class="form-group">
				<label for="distributorsprice" class="">Distributors Price ($)<span>* <span class="lbl_5"></span></span></label>
				<input type="text" class="form-control" data-filter="0" id="distributorsprice" maxlength="9" name="spPostingPrice" value="<?php echo (empty($ePrice)?'':$ePrice); ?>" >
			</div>
		</div>
		
		<div class="col-md-4">
			<div class="form-group">
				<label for="minorderqty_" class="">Min Order Qty<span>* <span class="lbl_6"></span></span></label>
				<input type="text" class="form-control spPostField" data-filter="0" maxlength="5" id="minorderqty_" name="minorderqty_" value="<?php echo (empty($row["Min Order Qty"]) ? "" : $row["Min Order Qty"]);?>" >
			</div>
		</div>
		
		<div class="col-md-4">
			<div class="form-group">
				<label for="supplyability_" class="">Supply Ability<span>* <span class="lbl_7"></span></span></label>
				<input type="text" class="form-control spPostField" data-filter="0" maxlength="5" id="supplyability_" name="supplyability_" value="<?php echo (empty($row["Supply Ability"]) ? "" : $row["Supply Ability"]);?>">
			</div>
		</div>
		
		<div class="col-md-4">
			<div class="form-group">
				<label for="paymentterm_" class="">Payment Terms<span>* <span class="lbl_8"></span></span></label>
				<input type="text" class="form-control spPostField" data-filter="0" id="paymentterm_" name="paymentterm_" value="<?php echo (empty($row["Payment Terms"]) ? "" : $row["Payment Terms"]);?>">
			</div>
		</div>
	</div>

	
	
	