<?php
	
	include('../../univ/baseurl.php');
    session_start();
	

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
				// print_r($row);
				$row[$result["spPostFieldLabel"]] = $result["spPostFieldValue"];
		}
		
		$p = new _postingview;
		$r = $p->read($_POST["postid"]);
		if ($r != false)
		{
			print_r($r);
			$rw = mysqli_fetch_assoc($r);
			$ePrice = $rw["spPostingPrice"];
			$quantitytype = $rw["quantitytype"];
		}
		else{
			$quantitytype = "Hard";
		}
		
	}


	                                             
?>
	<script type="text/javascript">
        $(function() {
            $('#auctionPrice').keypress(function(e){
                if(isNaN(this.value+""+String.fromCharCode(e.charCode))){
                   e.preventDefault(); //stop character from entering input
                }
           });
            $('#auctionQuantity_').keypress(function(e){
                if(isNaN(this.value+""+String.fromCharCode(e.charCode))){
                   e.preventDefault(); //stop character from entering input
                }
           });
           
        });
    </script>

 
	<!-- <div class="col-md-4 ">
		<div class="form-group">
			<label for="industryType_">Industry Type</label>
			<input type="text" class="form-control spPostField" data-filter="1" name="industryType_" id="industryType_" value="Auction" readonly />
			
		</div>
	</div> -->
	<!-- Retail code of Sell-->
	<div class="auction">
		<!-- <div class="col-md-4">
			<div class="form-group">
				<label for="auctionPrice" class="">Auction Start Price ($)<span>* <span class="lbl_5"></span></span></label>
				<input type="text" class="form-control spPostField" data-filter="0" placeholder="$" id="auctionPrice" name="spPostingPrice" value="" >
			</div>
		</div> -->
		<!-- <div class="col-md-4">
			<div class="form-group"> -->
					<!-- <label for="auctionQuantity_" class="">Auction Quantity<span>* <span class="lbl_6"></span></span></label>
					<input type="text" class="form-control spPostField" data-filter="0" id="auctionQuantity_" name="auctionQuantity_" value=""> -->
			<!-- </div>
		</div> -->
		    <div class="col-md-4" style="">
				<div class="form-group" style="padding-top: 26px;">

					
					<input type="radio" class=" " value="Hard" id="hardqty" name="quantitytype"  <?php if($quantitytype == "Hard" ){ echo "checked";} ?>>
					<label for="hardqty">Hard Quantity </label>
					<input type="radio" class=" " value="Soft" id="softqty" name="quantitytype" <?php if($quantitytype == "Soft" ){ echo "checked";} ?>>
					<label for="softqty">Soft Quantity </label>

					<!--<input type="hidden" id="quantity" class="spPostField" name="quantitytype" value="Hard">-->
				    
				
				</div>
			</div>


          <?php

            $expDate = date('Y-m-d', strtotime("+90 days"));
            //print_r($expDate);
          ?>

<!--  <input class="form-control" id="auctionEndDate_" name="auctionEndDate" type="hidden" value="<?php echo $ExpiryDate;?>" > -->
</div>
	<!-- 	<div class="col-md-4">
            <div class="form-group">
                <label>Auction End Date</label>
                <div class="input-group date form_datetime" data-date="" data-date-format="yyyy-mm-dd " data-link-field="dtp_input1">
                    <span class="input-group-addon"><span class="fa fa-calendar"></span></span>                   
                    <input class="form-control" id="auctionEndDate_" name="auctionEndDate_" type="text" value="<?php echo date('Y-m-d');?>" >
                </div>
                <input type="hidden" id="dtp_input2" value="" /><br/>
            </div>
        </div> -->




		<!-- <div class="col-md-4">
			<div class="form-group">
				<label for="auctionEndDate_">Auction End Date</label>
				<input type="date" class="form-control spPostField" data-filter="0" id="auctionEndDate_" name="auctionEndDate_" value="">
			</div>
		</div> -->
		
	<div class="auction">
		<?php
	        if ($eExDt) {
	            $todayDate1 = date("Y-m-d\TH:i:sP");
	            $dateExp1 = date("Y-m-d\TH:i:s", strtotime($eExDt));
	            if($todayDate1 > $dateExp1) {
	                $expDate1 = date("Y-m-d\TH:i:s", strtotime("+60 days"));
	            } else {
	                $expDate1 = $dateExp1;
	            }
	        } else {
	            $expDate1 = date("Y-m-d\TH:i:s", strtotime("+60 days"));
	        }
	    ?>

        <div class="col-md-4">
            <div class="form-group">
                <label for="">Expiry Date</label>
                <input type="datetime-local" name="spPostingExpDt" class="form-control" value="<?php echo $expDate1; ?>"  />
            </div>
        </div>

<!-- <br>
		<br> -->
		<div class="col-md-4">
			<div class="form-group">
					<label for="auctionQuantity_" class="">Auction Quantity<span>* <span class="lbl_6"></span></span></label>
					                                                                                           
					<input type="text" class="form-control spPostField" data-filter="0" id="auctionQuantity_" name="auctionQuantity" value="<?php echo(empty($Quantity) ? "1" : $Quantity);?>" maxlength="8" >
			</div>
		</div>


		<div class="col-md-4">
			<div class="form-group">
				<label for="auctionStatus_">Status</label>


				<select class="form-control spPostField" data-filter="1" id="auctionStatus_" name="auctionStatus" value="">
					<!-- <?php print_r($ItemCondition); ?> -->
					<?php
					
					//print_r($ItemCondition);
					$it = new _spAllStoreForm;
					$result3 = $it->readProductStatus();
					if ($result3) {
						while($row3 = mysqli_fetch_assoc($result3)){

							?>

                         <option value="<?php echo $row3['productStatusTitle'] ?>" <?php if($row3['productStatusTitle'] == $ItemCondition){  echo "selected"; } ?> > <?php echo $row3['productStatusTitle']; ?> </option>


							<?php
						}
					 }
					?>
			  </select>
			</div>
		</div>
		<?php
                                                      $userid=$_SESSION['uid'];
                                                        //$profid=$_SESSION['pid'];
                                                        $c= new _spuser;
                                                        $currency= $c->getcurrency($userid);
														if($currency){
                                                        $res= mysqli_fetch_assoc($currency);
												             $curre = $res['currency'];
														} 
                                                        ?>
		
		<div class="col-md-4">
			<div class="form-group">
				<label for="auctionPrice" class="">Auction Start Price (<?php echo $curre; ?>)<span>* <span class="auc"></span></span></label>
				<input type="text" class="form-control spPostField lll74" data-filter="0" placeholder="<?php echo $curre; ?>" id="auctionPrice" name="spPostingPrice" value="<?php echo $price; ?>" maxlength="8" required>
			</div>
		</div>
		
			<!-- <div class="col-md-4">
			<div class="form-group">
				<label for="auctionPrice" class="">Auction Start Price ($)<span>* <span class="lbl_5"></span></span></label>
				<input type="text" class="form-control spPostField" data-filter="0" placeholder="$" id="auctionPrice" name="spPostingPrice" value="" >
			</div>
		</div> -->
	</div>
	<!-- <script type="text/javascript">
      
      $('.form_datetime').datetimepicker({
        
          //language:  'fr',
          weekStart: 1,
          todayBtn:  1,
          autoclose: 1,
          todayHighlight: 1,
          startView: 2,
          forceParse: 0,
          minView: 2,
          pickerPosition: "top-right"
      });

      
  </script> -->
  
  <script>
$(document).ready(function(){
		
		$('#auctionQuantity_').keypress(function(){ 
			//alert("djsfdsj");
			$('.lbl_6').remove();
			
			});
			
			$('#auctionPrice').keypress(function(){ 
			//alert("djsfdsj");
			$('.lbl_5').remove();
			
			});
			
			
			$('#sppreviewSaveDraftStore').click(function(){ 
			
			var ab = $("#auctionPrice").val();
			if(ab == ""){
				return false; 
				} 
			//$("#auctionPrice").prop('required',true);
			
			});
			});
			
			
			
			</script>

  <script type="text/javascript">
  	
$(".quantity").click(function(){
            var radioValue = $("input[name='quantitytype']:checked").val();
            if(radioValue){

            	$("#quantity").val(radioValue);
                //alert("Your are a - " + radioValue);
            }
        });




  </script>