

<?php


$u = new _spuser;
		$res = $u->read($_SESSION["uid"]);
		if($res != false){
			$ruser = mysqli_fetch_assoc($res);
			
			  $time_zone = $ruser["time_zone"];
			  $userCountry = $ruser["spUserCountry"];
			  $userState = $ruser["spUserState"];
			  $userCity = $ruser["spUserCity"];
			
		}
		
		date_default_timezone_set('Asia/Kolkata');
    $postid = isset($_GET['postid']) ? (int) $_GET['postid'] : 0;
	  $m = new _masterdetails;
//	date_default_timezone_set($time_zone);
?>
<div class="row">
	<div class="col-md-12">
		<div class="form-group">
			<label for="spPostingSkill_" class="lbl_5">Skills Needed<span style="font-weight: normal; color:black">(Please Enter To Save)</span><span style="color:red;">*</span> <span id="errorSkill_1"></span></label>
			<input type="text" class="form-control spPostField" data-filter="1" id="tokenfield-typeahead" name="spPostingSkill" value="<?php echo (isset($skill) ? $skill : ''); ?>" placeholder="Type skill and hit enter"  required />
		</div>
	</div>
	 
	<div class="col-md-6">
		<div class="form-group">
			<label for="spPostingJobType_" class="lbl_11">Job Category <span style="color:red;">*</span></label>
			<select class="form-control spPostField" id="spPostingJobType_" data-filter="1" name="spPostingJobType" value="<?php echo (empty($row["Job Type"]) ? "" : $row["Job Type"]);?>">
			<option value="0" >Select Job Category</option>
				<?php
					$m = new _subcategory;
					$catid = 2;
					$result = $m->read($catid);
					
					/*echo $m->ta->sql;*/
					if($result){
						while($rows = mysqli_fetch_assoc($result)){ ?>
						<option value='<?php echo $rows["subCategoryTitle"]; ?>' <?php if(isset($jobType)){
							if($jobType == $rows['subCategoryTitle']){echo "selected";}}?>><?php echo ucwords(strtolower($rows["subCategoryTitle"])); ?></option>
						<?php
						}
					}
				?>
				
				
			</select>
		</div>
	</div>
	<!-- <div class="col-md-12"> 
		<div class="form-group">
		<label for="spPostingSkill_">What Skills are required for this job <span id="errorSkill"></span></label>
		<input type="text" class="form-control spPostField" data-filter="1" id="spPostingSkill_" name="spPostingSkill_" value="<?php echo (isset($skill) ? $skill : ''); ?>" required />
		</div>
	</div> -->
	<?php // echo $jobLoc."hello";  ?>
	<div class="col-md-3"> 
		<div class="form-group">
			<label for="spPostingLocation_" class="lbl_9">Job Location <span style="color:red;">*</span></label><br>
	   <select class="form-control" id="spPostingLocation_" name="spPostingLocation">
			<option value="0" >Select Job Location</option>
				<option <?php if($jobLoc == 'Office'){echo "selected";} ?>>Office</option>
				<option <?php if($jobLoc == 'Remote'){echo "selected";} ?>>Remote</option>
				<option <?php if($jobLoc == 'Mix'){echo "selected";} ?>>Mix</option>
				
				 
			</select>
			
			<datalist id="suggested_address">
			</datalist>
		</div>
	</div>
	
	<div class="col-md-3">
		<div class="form-group">
			<label for="spPostingJoblevel_" class="lbl_7">Job Type  <span style="color:red;">*</span></label>
			<select class="form-control spPostField" id="spPostingJoblevel_" data-filter="1" name="spPostingJoblevel" value="<?php echo (isset($row["Job Level"]) ? "" : $row["Job Level"]);?>">
			<option value="0" >Select Job Level</option>
				<?php
					$jl = new _spAllStoreForm;
					$result2 = $jl->readJobLevel();
					if($result2){
						while ($row2 = mysqli_fetch_assoc($result2)) {
						?>
						<option value="<?php echo $row2['jobLevelTitle']; ?>" <?php if(isset($jobLevel)){if($jobLevel == $row2["jobLevelTitle"]){ echo 'selected';}}?> ><?php echo $row2['jobLevelTitle']; ?></option>
						<?php
						}
					}
				?>
				
			</select>
			
		</div>
	</div>
	
	<?php echo $salType; ?>
	<div class="col-md-2">
		<div class="form-group">
			<label for="spPostingJobAs_" class="lbl_10">Salary Type<span style="color:red;">*</span></label>
			<select class="form-control spPostField" id="spPostingJobAs_" name="spPostingJobAs" >
			<option value="0" >Select Salary Type</option>
				<option <?php if($jobAs == 'Hourly'){echo "selected";} ?>>Hourly</option>
				<option <?php if($jobAs == 'Monthly'){echo "selected";} ?>>Monthly</option>
				<option <?php if($jobAs == 'Yearly'){echo "selected";} ?>>Yearly</option>
			</select>
		</div>
	</div>
	
	
	<?php
		$uid = $_SESSION['uid'];
		$b = new _currency;
		$data = $b->readCurrency();
		$dataucurrency = $b->readCurrencyuser($uid);
		$rowucurrency = mysqli_fetch_array($dataucurrency);
		
		
	?>
	
	
	<div class="col-md-3">
		<div class="form-group">
			<label for="job_currency"  class="lbl_101">Currency <span id="currency"   style="color:red;">*</span></label>
			<select class="form-control" name="job_currency" onchange="fun();" id="job_currency">
				<option value="0" selected >Select Currency</option>
<!-- 				<option>Select Currency</option>
 -->				<?php
					while($row = mysqli_fetch_array( $data )){
					
					?>
					<option value="<?php echo $row['iso']; ?>" <?php if(isset($postid)){ if($job_currency == $row['iso']){ echo 'selected'; } } ?>> <?php echo $row['name']; ?> ( <?php echo $row['iso']; ?> )</option>
				<?php } ?>
			</select>
		</div>
	</div>
	
	
	<div class="col-md-3">
		<div class="form-group">
			<label for="spPostingNoofposition_" class="lbl_8">No. of Position <span style="color:red;">*</span> </label>
			<input type="text" class="form-control spPostField" data-filter="1" id="spPostingNoofposition_" name="spPostingNoofposition" onkeypress="return onlyNumberKey(event)" value="<?php echo (isset($noOfPosition) ? $noOfPosition : ''); ?>" required />
		</div>
		</div>
		
		
		<div class="col-md-4">
		<div class="form-group">
		<label for="spPostingSalaryRange_" class="lbl_6">Salary Range($) <?php //echo $endSalry; die('---------------------------'); ?> <span style="color:red;">* </span> <span class="error" style="display:none">Enter greater value</span></label><span class="error" id="great11" style="color:red;"></span>
		<div class="row">
		<div class="col-md-6">
		<input  onkeyup="numericFilter(this);" maxlength="6" pattern="[1-9]{1}[0-9]{9}" type="text" required class="form-control spPostField" data-filter="1" id="spPostingSlryRngFrm_" name="spPostingSlryRngFrm" value="<?php echo (isset($endSalry) ? $endSalry : ''); ?>" placeholder="From" />
		</div>
		<i class="fa fa-minus" aria-hidden="true"style="margin-left: -139px;"></i>
		<div class="col-md-6">
		<input onkeyup="numericFilter(this);" maxlength="6" pattern="[1-9]{1}[0-9]{9}" type="text" required class="form-control spPostField" data-filter="1" id="spPostingSlryRngTo_" name="spPostingSlryRngTo" value="<?php echo (isset($strtSalry) ? $strtSalry : ''); ?>" placeholder="To" />
		</div> 
		
		</div>
		</div>
		</div>
		<!-- 
		<div class="col-md-6">
		<div class="form-group">
		<label for="spPostingApply_">How to Apply</label>
		<input type="text" class="form-control spPostField"  data-filter="0" id="spPostingApply_" name="spPostingApply_" value="<?php echo (empty($row["How to Apply"]) ? "" : $row["How to Apply"]);?>">
		</div>
		</div>
		-->
		
		<div class="col-md-3">
		<div class="form-group">
		<label for="spPostingExperience_" class="lbl_12"style="white-space: nowrap;">Min. Years of Experience<span style="color:red;">*</span></label>
		  <div style="position: relative; width: fit-content;">
		    <input type="number" class="form-control spPostField" data-filter="1" id="spPostingExperience_" name="spPostingExperience" value="<?php echo (isset($jobExp) ? $jobExp : ''); ?>" maxlength="2" style="width:60px !important; text-align: center; padding-right: 25px;" required />
		    <button type="button" style="position: absolute; top: 0; right: 1px;font-size: 10px;" onclick="increaseValue()">▲</button>
		    <button type="button" style="position: absolute; bottom: 0; right: 1px;font-size: 10px;" onclick="decreaseValue()">▼</button>
		 </div>
		
		<?php 
		
		 if($time_zone == NULL || $time_zone == '' ){
		$currentDate = date('Y-m-d H:i:s');
		?>
		
		<input type="hidden" name="spPostingDate" value="<?php echo $currentDate; ?>">

<?php }else{ ?>
	<input type="hidden" name="spPostingDate" value="<?php echo $date = date('Y-m-d H:i:s',strtotime($time_zone.'hours'));

		
?>">

		<?php } ?>	
		</div>
		</div>
	<?php  if(isset($postid)){ ?>
		<div class="col-md-3">
<div class="form-group">
<label for="spPostingCountry" class="lbl_2">Country</label>
<select class="form-control " name="spPostingsCountry" id="spUserCountry" >
<option value="">Select Country</option>
<?php




$co = new _country;
$result3 = $co->readCountry();
if($result3 != false){
while ($row3 = mysqli_fetch_assoc($result3)) {
?>
<option value='<?php echo $row3['country_id'];?>' <?php echo (isset($country11) && $country11 == $row3['country_id'])?'selected':''; ?>   ><?php echo $row3['country_title'];?></option>
<?php
}
}
?>
</select>
<!-- <input type="text" class="form-control" id="spPostingCountry" name="spPostingsCountry" value="<?php echo (isset($eCountry) ? $eCountry : $country); ?>"> -->
</div>
</div>
<div class="col-md-3">
<div class="loadUserState">
<label for="spPostingCity" class="lbl_3">State</label>
<select class="form-control" id="spUserState" name="spPostingsState">
<option>Select State</option>
<?php

$countryId = $usercountry;
$pr = new _state;
$result2 = $pr->readState($country11);
if($result2 != false){
while ($row2 = mysqli_fetch_assoc($result2)) { ?>
<option value='<?php echo $row2["state_id"];?>' <?php echo (isset($state11) && $state11 == $row2["state_id"] )?'selected':'';?> ><?php echo $row2["state_title"];?> </option>
<?php
}

}
?>
</select>
</div>
</div>

<div class="col-md-3">
<div class="loadCity">
<div class="form-group">
<label for="spPostingCity" class="lbl_4">City</label>
<select class="form-control" id="spUserCity" name="spPostingsCity">
<option>Select City</option>
<?php

$stateId = $userstate;
$co = new _city;
$result3 = $co->readCity($state11);
//echo $co->ta->sql;
if($result3 != false){
while ($row3 = mysqli_fetch_assoc($result3)) { ?>
<option value='<?php echo $row3['city_id']; ?>' <?php echo (isset($city11) && $city11 == $row3['city_id'])?'selected':'';  ?> ><?php echo $row3['city_title'];?></option> <?php
}
}

?>
</select>

</div>
</div>
</div>

	<?php  } 
	
	else{ ?>
			<div class="col-md-3">
<div class="form-group">
<label for="spPostingCountry" class="lbl_2">Country</label>
<select class="form-control " name="spPostingsCountry" id="spUserCountry" >
<option value="">Select Country</option>
<?php




$co = new _country;
$result3 = $co->readCountry();
if($result3 != false){
while ($row3 = mysqli_fetch_assoc($result3)) {
?>
<option value='<?php echo $row3['country_id'];?>' <?php echo (isset($userCountry) && $userCountry == $row3['country_id'])?'selected':''; ?>   ><?php echo $row3['country_title'];?></option>
<?php
}
}
?>
</select>
<!-- <input type="text" class="form-control" id="spPostingCountry" name="spPostingsCountry" value="<?php echo (isset($eCountry) ? $eCountry : $country); ?>"> -->
</div>
</div>
<div class="col-md-3">
<div class="loadUserState">
<label for="spPostingCity" class="lbl_3">State</label>
<select class="form-control" id="spUserState" name="spPostingsState">
<option>Select State</option>
<?php

$countryId = $_SESSION['spPostCountry'];
if(isset($userCountry)) {
  $pr = new _state;
  $result2 = $pr->readState($userCountry);
  if($result2 != false){
    while ($row2 = mysqli_fetch_assoc($result2)) { ?>
      <option value='<?php echo $row2["state_id"];?>' <?php echo (isset($userState) && $userState == $row2["state_id"] )?'selected':'';?> ><?php echo $row2["state_title"];?> </option>
      <?php
    }
  }
}
?>
</select>
</div>
</div>

<div class="col-md-3">
<div class="loadCity">
<div class="form-group">
<label for="spPostingCity" class="lbl_4">City</label>
<select class="form-control" id="spUserCity" name="spPostingsCity">
<option>Select City</option>
<?php

$stateId = $_SESSION['spPostState'];
if(isset($userState)){
  $co = new _city;
  $result3 = $co->readCity($userState);
  //echo $co->ta->sql;
  if($result3 != false){
    while ($row3 = mysqli_fetch_assoc($result3)) { ?>
      <option value='<?php echo $row3['city_id']; ?>' <?php echo (isset($userCity) && $userCity == $row3['city_id'])?'selected':'';  ?> ><?php echo $row3['city_title'];?></option> <?php
    }
  }
}
?>
</select>

</div>
</div>
</div>
		
		
	 <?php  }?>

		
																
																<!-- 	<div class="col-md-3">
                                                                        <div class="form-group">
                                                                       <label for="postingPicPreview" class="lbl_13">Status<span style="color:red;"> *</span></label>
																	<select class="form-control" id="status_" name="posting_status">
																				<option value="0" selected>Select Status</option>
																		<option <?php //if($posting_status=='Open')echo 'selected'; ?>>Open</option>
																		<option <?php //if($posting_status=='Close') echo 'selected'; ?>>Close</option>
																				</select>
																			</div>
                                                                    </div> -->
		<div class="col-md-3">
		<div class="form-group">
			<label for="spPostingClosing_">Closing Date</label>
			<div class="input-group date form_datetime" data-date="" data-date-format="yyyy-m-dd" data-link-field="dtp_input1">
				<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>                   
				<input class="form-control" data-filter="1" size="16" id="spPostingClosing" name="spPostingClosing" type="text" value="<?php echo (empty($spPostingClosing) ? "" : $spPostingClosing);?>" >
			</div>
		<?php
		if(isset($postid) && $postid > 0){ ?>
		<!-- <label for="spPostingExpDt">Expiry Date</label>
		<div class="input-group date form_datetime" data-date="" data-date-format="dd-M-yyyy " data-link-field="dtp_input1">
		<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>                   
		<input class="form-control" data-filter="1" size="16" id="spPostingExpDt" name="spPostingExpDt" type="text" value="" >
		</div>
		<input type="hidden" id="dtp_input2" value="" /><br/> -->
		<!-- <input type="date" class="form-control" id="spPostingExpDt" name="spPostingExpDt"  value="<?php echo (empty($eExDt) ? "" : $eExDt);?>" /> --> <?php
		}else{ ?>
		<!-- <label for="spPostingClosing_">Closing Date</label>
		<div class="input-group date form_datetime" data-date="" data-date-format="dd-M-yyyy " data-link-field="dtp_input1">
		<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>                   
		<input class="form-control" data-filter="1" size="16" id="spPostingClosing_" name="spPostingClosing" type="text" value="" >
		</div>
		<input type="hidden" id="dtp_input2" value="" /><br/> -->
		
		<!-- <input type="date" class="form-control" id="spPostingClosing_" name="spPostingClosing_" value="<?php echo (empty($row["Closing Date"]) ? "" : $row["Closing Date"]);?>"> -->
		<?php
		}
		?>
		</div>
		</div>
		</div>
		
		
		<script type="text/javascript">
		
		$("#spPostingSlryRngTo").focusout(function(){
		alert('ffff');
		
		if(parseFloat($("#spPostingSlryRngFrm").val()) > parseFloat($("#spPostingSlryRngTo").val()))
		{
		$(".error").css("display","block").css("color","red");
		$("#spPostSubmitjob").prop('disabled',true);
		}
		else {
		$(".error").css("display","none");
		$("#spPostSubmitjob").prop('disabled',false);        
		}
		
		});
		
		
		
		
		function getaddress(){
		
		var address = $("#spPostingLocation").val();
		
		$.ajax({
		type: "POST",
		url: "address.php",
		cache:false,
		data: {'address':address},
		success: function(data) {
		
		var obj = JSON.parse(data);
		
		$("#suggested_address").html('<option value="' + obj.address + '" class="op_address">' + obj.address + '</option>');
		
		
		$("#latitude").val(obj.latitude);
		$("#longitude").val(obj.longitude);
		
		} 
		}); 
		}
		
		
		
		</script>
		
		<script>
		function numericFilter(txb) {
		txb.value = txb.value.replace(/[^\0-9]/ig, "");
		}
		</script>		
		<script>
    function onlyNumberKey(evt) {
          
        // Only ASCII character in that range allowed
        var ASCIICode = (evt.which) ? evt.which : evt.keyCode
        if (ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57))
            return false;
        return true;
    }
</script>


<script>
$("#spUserState").on("change", function () {
// alert('===1');
var state = this.value;
$.post("loadUserCity.php", {
	state: state
}, function (r) {
//alert(r);
$(".loadCity").html(r);
});

});
</script>

<script>
function increaseValue() {
  var value = parseInt(document.getElementById("spPostingExperience_").value, 10);
  value = isNaN(value) ? 0 : value;
  value++;
  document.getElementById("spPostingExperience_").value = value;
}

function decreaseValue() {
  var value = parseInt(document.getElementById("spPostingExperience_").value, 10);
   value = isNaN(value) ? 0 : value;
   value--;
   if (value < 0) {
   value = 0;
}
document.getElementById("spPostingExperience_").value = value;
}
</script>
