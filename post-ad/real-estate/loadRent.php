<script type="text/javascript">
//===Real-Estate-Rent-a-room====================
$("#spRoomRent_").on("change", function() {
var RentBy = this.value;
if (RentBy == 'Rent A Room') {
$(".rentaRoom").load("loadRoomfield.php", function() {

});
}
});
//===Real-Estate-Rent-a-room====================
</script>
<?php
session_start();
if (!isset($_GET['type'])) {
function sp_autoloader($class)
{
include '../../mlayer/' . $class . '.class.php';
}
spl_autoload_register("sp_autoloader");
}
// print_r($prop_data);
// exit;
?>
<?php
//  error_reporting(E_ALL);
// ini_set('display_errors', 'On');
$row['defaltcurrency'] = $defaltcurrency;
$bc = new _currency;
$uid = $_SESSION['uid'];

$dataucurrency = $bc->readCurrencyuser($uid);
if($dataucurrency){
$rowucurrency = mysqli_fetch_array($dataucurrency);
$currency_ = $rowucurrency['currency'];
}
?>
<div class="rentaRoom">
<div class="row">
<div class="col-md-3">
<div class="form-group">
<label for="spRoomRent_">Rent</label>
<select class="form-control spPostField" data-filter="1" id="spRoomRent_" name="spRoomRent" value="">
<option class="opt2" selected>Select any option</option>
<option value="Rent Entire Place" <?php echo (!empty($spRoomRent) && $spRoomRent == 'Rent Entire Place') ? 'selected' : ''; ?>>Rent Entire Place</option>
<option value="Rent A Room" <?php echo (!empty($spRoomRent) && $spRoomRent == 'Rent A Room') ? 'selected' : ''; ?>>Rent A Room</option>
</select>
</div>
</div>
<div class="col-md-3">
<div class="form-group">
<label for="spPostDurstion_" class="spPostDurstion_">Rent Duration</label><span class="red">*</span>
<select class="form-control spPostField" data-filter="1" id="spPostDurstion_" name="spPostDurstion" value="">
<option class="opt2" selected>Select rent duration</option>
<option value="1" <?php echo (!empty($spPostDurstion ) && $spPostDurstion  == '1') ? 'selected' : ''; ?>>Short Term</option>
<option value="2" <?php echo (!empty($spPostDurstion ) && $spPostDurstion  == '2') ? 'selected' : ''; ?>>Long Term</option>
</select>
</div>
</div>
<?php //echo $row["spPostingPropertyType"]."ffggffggggggg"; 
?>  
<div class="col-md-3">
<div class="form-group">
<label for="spPostingPropertyType" class="spPostingPropertyType_"> Property Type </label><span class="red">*</span>
<select class="form-control spPostField" data-filter="1" id="spPostingPropertyType" name="spPostingPropertyType" onchange="propType_1()" value="<?php echo (empty($row6["Property type"]) ? "" : $row6["Property type"]); ?>">
<option selected>Select property type</option>
<?php $row["spPostingPropertyType"] = $spPostingPropertyType;  ?>

<option value="Detached House" <?php if ($row["spPostingPropertyType"] == 'Detached House') {
echo 'selected';
} ?>>Detached House</option>
<option value="Condominium" <?php if ($row["spPostingPropertyType"] == 'Condominium') {
echo 'selected';
} ?>>Condominium</option>
<option value="Townhouse" <?php if ($row["spPostingPropertyType"] == 'Townhouse') {
echo 'selected';
} ?>>Townhouse</option>
<option value="Duplex" <?php if ($row["spPostingPropertyType"] == 'Duplex') {
echo 'selected';
} ?>>Duplex</option>
<option value="Commercial Place" <?php if ($row["spPostingPropertyType"] == 'Commercial Place') {
echo 'selected';
} ?>>Commercial Place</option>
<option value="Farmland" <?php if ($row["spPostingPropertyType"] == 'Farmland') {
echo 'selected';
} ?>>Farmland</option>
<option value="Land/Lot" <?php if ($row["spPostingPropertyType"] == 'Land/Lot') {
echo 'selected';
} ?>>Land/Lot</option>
<option value="Mobile Home" <?php if ($row["spPostingPropertyType"] == 'Mobile Home') {
echo 'selected';
} ?>>Mobile Home</option>


<?php
//$m = new _spAllStoreForm;
// $result = $m->readPropertyType();
//   if($result){
//    while($rows = mysqli_fetch_assoc($result)){ 
?>
<!--   <option value='<?php //echo $rows["propertyTypeTitle"]; 
?>' <?php //echo (!empty($row6["Property type"]) && $row6["Property type"] == $rows['propertyTypeTitle'])?'selected':'';
?> ><?php //echo $rows["propertyTypeTitle"];
?></option> -->
<?php
// }
//  }
?>
</select>
</div>
</div>
<div class="col-md-3">
<div class="form-group">
<label for="spPostingSqurefoot_" class="lbl_4">Square foot <span class="red">*</span></label>
<input type="text" class="form-control spPostField" id="spPostingSqurefoot_" name="spPostingSqurefoot" data-filter="1" value="<?php echo (empty($spPostingSqurefoot) ? "" : $spPostingSqurefoot); ?>" required>
</div>
</div>
<div class="col-md-3">
<div class="form-group">
<label for="spPostingBedroom_" class="lbl_5">Bed Rooms</label><span class="red">*</span>
<input type="number" min="1" maxlength="10" class="form-control spPostField" id="spPostingBedroom_" name="spPostingBedroom" data-filter="1" value="<?php echo (empty($spPostingBedroom) ? "" : $spPostingBedroom); ?>" required>
</div>
</div>
<div class="col-md-3">
<div class="form-group">
<label for="spPostingBathroom_" class="lbl_6">Bath Rooms </label><span class="red">*</span>
<input type="number" min="1" maxlength="10" class="form-control spPostField" id="spPostingBathroom_" name="spPostingBathroom" data-filter="1" value="<?php echo (empty($spPostingBathroom) ? "" : $spPostingBathroom); ?>" required>
</div>
</div>
<div class="col-md-3">
<div class="form-group">
<label for="spPostFurnish_">Furnishing</label>
<select class="form-control spPostField" data-filter="1" id="spPostFurnish_" name="spPostFurnish" value="<?php echo $row6["spPostFurnish"]; ?>">

<option class="opt2" selected>Select any option</option>
<option value="Furnished" <?php echo (!empty($spPostFurnish) && $spPostFurnish == 'Furnished') ? 'selected' : ''; ?>>Furnished</option>
<option value="Unfurnished" <?php echo (!empty($spPostFurnish) && $spPostFurnish == 'Unfurnished') ? 'selected' : ''; ?>>Unfurnished</option>
</select>
</div>
</div>
<div class="col-md-3">
<div class="form-group">
<label>Available Dates</label><span class="red">*</span> 
<input type="text" class="form-control" id="config-demo" value="<?php echo $spPostAvailFrom; ?>" required="">
</div>
</div>
<div class="col-md-3">
<div class="form-group">
<label class="control-label lbl_7" for="spPostAvailFrom_">Availability From</label>
<input type="date" class="form-control spPostField" id="spPostAvailFrom_" name="spPostAvailFrom" value="<?php echo $spPostAvailFrom; ?>" readonly />
</div>
</div>
<div class="col-md-3">
<div class="form-group">
<label class="control-label lbl_8" for="spPostAvailTo_">Availability To</label>
<input type="date" class="form-control spPostField" id="spPostAvailTo_" name="spPostAvailTo" value="<?php echo $spPostAvailTo; ?>" readonly />
</div>
</div>
<div class="col-md-3">
<div class="form-group">
<label for="spPostingRentBy_">Rent By</label>
<select class="form-control spPostField" name="spPostingRentBy" id="spPostingRentBy_">
<option class="opt2" selected>Select any option</option>
<option value="Owner" <?php echo (!empty($spPostingRentBy) && $spPostingRentBy == 'Owner') ? 'selected' : ''; ?>>Owner</option>
<option value="Agent" <?php echo (!empty($spPostingRentBy) && $spPostingRentBy == 'Agent') ? 'selected' : ''; ?>>Agent</option>
</select>
</div>
</div>
<div class="col-md-3" id="lotSize" style="display:none;">
  <div class="form-group">
    <label for="lotSize_" >Lot Size</label>
    <input type="text" class="form-control spPostField" id="lotSize_" name="lotSize" value="<?php echo $lotSize;?>" />
  </div>
</div>
<div class="col-md-4">
<div class="form-group">
<label for="spPostingsMeal_">Meal Included</label>
<select class="form-control spPostField" data-filter="1" id="spPostingMeal" name="spPostingMeal" value="<?php echo (empty($row6["Property type"]) ? "" : $row6["Property type"]); ?>">
<option class="opt1" selected>Select any option</option>
<option value="no" <?php echo (!empty($prop_data["spPostingMeal"]) && $prop_data["spPostingYes"] == 'No') ? 'selected' : ''; ?>>No</option>
<option value="yes" <?php echo (!empty($prop_data["spPostingMeal"]) && $prop_data["spPostingMeal"] == 'yes') ? 'selected' : ''; ?>>Yes</option>
</select>
</div>
</div>
<!--   <div class="col-md-3">
<div class="form-group">
<label for="spPostDepositAmt_" class="lbl_9">Deposit Amount($) <span class="red">*</span></label>
<input type="number" class="form-control spPostField" id="spPostDepositAmt_" name="spPostDepositAmt" data-filter="0" value="<?php echo (empty($row["Deposit Amount($) *"]) ? "" : $row["Deposit Amount($) *"]); ?>" />
</div>
</div>

<div class="col-md-3">
<div class="form-group">
<label for="spPostRentalMonth_" class="lbl_10">Rent Per Month($) <span class="red">*</span></label>
<input type="number" class="form-control spPostField" id="spPostRentalMonth_" name="spPostRentalMonth" data-filter="0" value="<?php echo (empty($row["Rent Per Month($) *"]) ? "" : $row["Rent Per Month($) *"]); ?>"  maxlength="4" onkeyup="numericFilter(this);" >
</div>
</div>
<div class="col-md-3">
<div class="form-group">
<label for="spPostRentalWeek_" class="lbl_11">Rent Per Week($) <span class="red">*</span></label>
<input type="number" class="form-control spPostField" id="spPostRentalWeek_" name="spPostRentalWeek" data-filter="0" value="<?php echo (empty($spPostRentalWeek) ? "" : $spPostRentalWeek); ?>" maxlength="3" onkeyup="numericFilter(this);" >
</div>
</div>
<div class="col-md-3">
<div class="form-group">
<label for="spPostRentalWeek_" class="lbl_11">Rent Per Day($) <span class="red">*</span></label> 
<input type="number" class="form-control spPostField" id="spPostRentalNight" name="spPostRentalNight" data-filter="0" value="<?php echo (empty($spPostRentalNight) ? "" : $spPostRentalNight); ?>" maxlength="3" onkeyup="numericFilter(this);" >
</div>
</div>
<div class="col-md-3">
<div class="form-group">
<label for="spPostingServicChrg_" class="lbl_12">Service Charges($) <span class="red">*</span></label>
<input type="number" class="form-control spPostField" id="spPostingServicChrg_" name="spPostingServicChrg" data-filter="0" value="<?php echo (empty($row["Service Charges($) *"]) ? "" : $row["Service Charges($) *"]); ?>"   maxlength="3" onkeyup="numericFilter(this);">
</div>
</div>
<div class="col-md-3">
<div class="form-group">
<label for="spPostingCleaningChrg_" class="lbl_13">Cleaning Charges($) <span class="red">*</span></label>
<input type="number" class="form-control spPostField" id="spPostingCleaningChrg_" name="spPostingCleaningChrg" data-filter="0" value="<?php echo (empty($row["Cleaning Charges($) *"]) ? "" : $row["Cleaning Charges($) *"]); ?>"   maxlength="3" onkeyup="numericFilter(this);">
</div>
</div>-->


<div class="row">

<div class="col-md-4 spPostingYes_">
<div class="form-group ">
<label for="spPostingsPostingYes_"></label> <br><br>
<label class="checkbox-inline" for="BreakFast">
<input type="checkbox" id="BreakFast" class="form-check-input" name="BreakFast" value="1" <?php echo (!empty($BreakFast) && $BreakFast == 1) ? 'checked' : ''; ?> />
BreakFast</label>
<label class="checkbox-inline" for="Lunch">
<input type="checkbox" class="form-check-input" id="Lunch" name="Lunch" value="1" <?php echo (!empty($Lunch) && $Lunch == 1) ? 'checked' : ''; ?> />
Lunch</label>
<label class="checkbox-inline" for="Dinner">
<input type="checkbox" class="form-check-input" id="Dinner" name="Dinner" value="1" <?php echo (!empty($Dinner) && $Dinner == 1) ? 'checked' : ''; ?> />
Dinner</label>
</div>
</div>
</div>

</div>







<div class="row sponsorInfo ">
<h3>Rates</h3>
<br>

<div class="col-md-4">
  <?php include("../currencyList.php");?>
</div>

<div class="col-md-4">
<div class="form-group">
<label for="spPostDepositAmt_" class="lbl_9">Deposit Amount(<?php echo $currency_; ?>) </label><span class="red">*</span>
<input type="number" class="form-control spPostField" id="spPostDepositAmt_" name="spPostDepositAmt" data-filter="0" required value="<?php echo (empty($spPostDepositAmt) ? "" : $spPostDepositAmt); ?>">
</div>
</div>

<div class="col-md-4">
<div class="form-group">
<label for="spPostRentalMonth_" class="lbl_10">Rent Per Month(<?php echo $currency_; ?>) </label><span class="red">*</span>
<input type="number" class="form-control spPostField" id="spPostRentalMonth_" required name="spPostRentalMonth" data-filter="0" value="<?php echo (empty($spPostRentalMonth) ? "" : $spPostRentalMonth); ?>" maxlength="4" onkeyup="numericFilter(this);">
</div>
</div>
<div class="col-md-4">
<div class="form-group">
<label for="spPostRentalWeek_" class="lbl_11">Rent Per Week(<?php echo $currency_; ?>) </label><span class="red">*</span>
<input type="number" class="form-control spPostField" id="spPostRentalWeek_" required name="spPostRentalWeek" data-filter="0" value="<?php echo (empty($spPostRentalWeek) ? "" : $spPostRentalWeek); ?>" maxlength="3" onkeyup="numericFilter(this);">
</div>
</div>
<div class="col-md-4">
<div class="form-group">
<label for="spPostRentalWeek_" class="lbl_11">Charge Per Day(<?php echo $currency_; ?>) </label><span class="red">*</span>
<input type="number" class="form-control spPostField" id="spPostRentalNight" name="spPostRentalNight" data-filter="0" value="<?php echo (empty($spPostRentalNight) ? "" : $spPostRentalNight); ?>" maxlength="3" onkeyup="numericFilter(this);" required>
</div>
</div>
<div class="col-md-4">
<div class="form-group">
<label for="spPostingServicChrg_" class="lbl_12">Service Charges(<?php echo $currency_; ?>) </label><span class="red">*</span>
<input type="number" class="form-control spPostField" id="spPostingServicChrg_" name="spPostingServicChrg" data-filter="0" value="<?php echo (empty($spPostingServicChrg) ? "" : $spPostingServicChrg); ?>" maxlength="3" onkeyup="numericFilter(this);" required>
</div>
</div>
<div class="col-md-4">
<div class="form-group">
<label for="spPostingCleaningChrg_" class="lbl_13">Cleaning Charges(<?php echo $currency_; ?>) </label><span class="red">*</span>
<input type="number" class="form-control spPostField" id="spPostingCleaningChrg_" name="spPostingCleaningChrg" data-filter="0" value="<?php echo (empty($spPostingServicChrg) ? "" : $spPostingServicChrg); ?>" maxlength="3" onkeyup="numericFilter(this);" required>
</div>
</div>


</div>


</div>

<?php
if (!empty($spPostAvailFrom)) {
$date1 = date("m/d/Y", strtotime($spPostAvailFrom));
} else {
  $date1 = "";
}

if (!empty($spPostAvailTo)) {
$date2 = date("m/d/Y", strtotime($spPostAvailTo));
} else {
  $date2 = "";
}
$date3 =  date("m/d/Y");
//echo "Today is " . date("Y/m/d") . "<br>";
?>

<script type="text/javascript">
function propType_1(){
  $val=$( "#spPostingPropertyType option:selected" ).text();
  if($val=='Detached House' || $val=='Townhouse' || $val=='Land/Lot'){
    $('#lotSize').show();
  }else{
    $('#lotSize').hide();
  }
}
$(document).ready(function() {
propType_1()
$(".spPostingYes_").show();
//var startDate = new Date();
var startDate = "<?php echo $date3; ?> ";
//alert(startDate);

var available_from = "<?php echo $date1;  ?>";
var available_to = "<?php echo $date2; ?>";

if (available_from) {
available_from = available_from;
} else {

available_from = startDate;
}

if (available_to) {
available_to = available_to;
} else {

available_to = "<?php echo date('m/d/Y') ?>";
}
//alert(available_from);
//alert(available_to); 

$('#config-demo').daterangepicker({

"minDate": available_from,

"linkedCalendars": false,
"autoUpdateInput": true,
"startDate": available_from,
"endDate": available_to
}, function(start, end, label) {
$("#spPostAvailFrom_").val(start.format('YYYY-MM-DD'));
$("#spPostAvailTo_").val(end.format('YYYY-MM-DD'));
});
// ------------ Meal Included Yes/No action
$("#spPostingMeal").change(function() {
var end = this.value;
var spPostingMealVal = $('#spPostingMeal').val();
if (spPostingMealVal == 'yes') {
console.log(spPostingMealVal);
$(".spPostingYes_").show();
} else {
console.log(spPostingMealVal);
$(".spPostingYes_").hide();
}
});


});
$('#config-demo').val('');
</script>
