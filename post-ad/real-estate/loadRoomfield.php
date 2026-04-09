<script type="text/javascript">
//===Real-Estate-Rent-a-room====================
$("#spRoomRent_").on("change", function() {
var RentBy = this.value;
if (RentBy == 'Rent Entire Place') {
$(".addcustomRent").load("loadRent.php", function() {

});
}
});
//===Real-Estate-Rent-a-room====================
</script>
<?php
if (!isset($_GET['type'])) {
function sp_autoloader($class)
{
include '../../mlayer/' . $class . '.class.php';
}
spl_autoload_register("sp_autoloader");
}
//print_r($row);
//exit;
?>

<div class="addcustomRent">
<div class="row">
<div class="col-md-3">
<div class="form-group">
<label for="spRoomRent_">Rent</label>
<select class="form-control spPostField" data-filter="1" id="spRoomRent_" name="spRoomRent" value="">
<option value="Rent Entire Place">Rent Entire Place</option>
<option value="Rent A Room" selected="">Rent A Room</option>
</select>
</div>
</div>
<div class="col-md-3">
<div class="form-group">
<label for="spPostingPropertyType_">Property type </label><span class="red">*</span>
<select class="form-control spPostField" data-filter="1" id="spPostingPropertyType_" name="spPostingPropertyType" ">

<?php $row["spPostingPropertyType"] = $spPostingPropertyType;  ?>

<option value=" Detached House" <?php if ($row["spPostingPropertyType"] == 'Detached House') {
echo 'selected';
} ?>>Detached House</option>
<option value="Condomenum" <?php if ($row["spPostingPropertyType"] == 'Condomenum') {
echo 'selected';
} ?>>Condomenum</option>
<option value="Townhouse" <?php if ($row["spPostingPropertyType"] == 'Townhouse') {
echo 'selected';
} ?>>Townhouse</option>
<option value="Duplex" <?php if ($row["spPostingPropertyType"] == 'Duplex') {
echo 'selected';
} ?>>Duplex</option>
<option value="Commecial Place" <?php if ($row["spPostingPropertyType"] == 'Commecial Place') {
echo 'selected';
} ?>>Commecial Place</option>
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
//      $m = new _spAllStoreForm;
//     $result = $m->readPropertyType();
//   if($result){
//   while($rows = mysqli_fetch_assoc($result)){ 
?>
<!--   <option value='<?php //echo $rows["propertyTypeTitle"]; 
?>' <?php //echo $row6["Property type"];
?> ><?php //echo $rows["propertyTypeTitle"];
?></option> -->
<?php
//     }
//  }
?>
</select>
</div>
</div>
<?php
//print_r($row);
//die("++++++++");
?>
<div class="col-md-3">
<div class="form-group">
<label for="spPostingSqurefoot_" class="lbl_4">Square foot </label><span class="red">*</span>
<input type="text" class="form-control spPostField" id="spPostingSqurefoot_" name="spPostingSqurefoot" data-filter="1" value="<?php if ($spPostingSqurefoot) {
echo $spPostingSqurefoot;
} ?>" required>
</div>
</div>
<div class="col-md-3">
<div class="form-group">
<label for="spPostingBedroom_" class="lbl_5">Bed Rooms </label><span class="red">*</span>
<input type="number" min="1" max="1000" class="form-control spPostField" id="spPostingBedroom_" name="spPostingBedroom" data-filter="1" value="<?php if ($spPostingBedroom) {
echo $spPostingBedroom;
} ?>">
</div>
</div>
<div class="col-md-3">
<div class="form-group">
<label for="spPostingBathroom_" class="lbl_6">Bath Rooms </label><span class="red">*</span>
<input type="number" min="1" max="1000" class="form-control spPostField" id="spPostingBathroom_" name="spPostingBathroom" data-filter="1" value="<?php if ($spPostingBathroom) {
echo $spPostingBathroom;
} ?>">
</div>
</div>
<div class="col-md-3">
<div class="form-group">
<label for="spPostRoomType_">Room type</label>
<select class="form-control spPostField" data-filter="1" id="spPostRoomType_" name="spPostRoomType" value="">
<option value="Private" <?php echo (!empty($row["Room type"]) && $row["Room type"] == 'Private') ? 'selected' : ''; ?>>Private</option>
<option value="Shared" <?php echo (!empty($row["Room type"]) && $row["Room type"] == 'Shared') ? 'selected' : ''; ?>>Shared</option>
</select>
</div>
</div>
<div class="col-md-3">
<div class="form-group">
<label for="spPostBathRoomType_">Bathroom type</label>
<select class="form-control spPostField" data-filter="1" id="spPostBathRoomType_" name="spPostBathRoomType" value="<?php echo (empty($row["Property type"]) ? "" : $row["Property type"]); ?>">
<option value="Private" <?php echo (!empty($row6["Bathroom type"]) && $row6["Bathroom type"] == 'Private') ? 'selected' : ''; ?>>Private</option>
<option value="Shared" <?php echo (!empty($row6["Bathroom type"]) && $row6["Bathroom type"] == 'Shared') ? 'selected' : ''; ?>>Shared</option>
</select>
</div>
</div>
<div class="col-md-3">
<div class="form-group">
<label for="spPostFurnish_">Furnishing</label>
<select class="form-control spPostField" data-filter="1" id="spPostFurnish_" name="spPostFurnish" value="">
<option value="Furnished" <?php echo (!empty($row6["Furnishing"]) && $row6["Furnishing"] == 'Furnished') ? 'selected' : ''; ?>>Furnished</option>
<option value="Unfurnished" <?php echo (!empty($row6["Furnishing"]) && $row6["Furnishing"] == 'Unfurnished') ? 'selected' : ''; ?>>Unfurnished</option>
</select>
</div>
</div>
<div class="col-md-3">
<div class="form-group">
<label>Available Dates  </label><span class="red">*</span>
<input type="text" class="form-control" id="config-demo" value="" required="">
</div>
</div>
<div class="col-md-3">
<div class="form-group">
<label class="control-label lbl_7" for="spPostAvailFrom_">Availability From</label>
<input type="text" class="form-control spPostField" id="spPostAvailFrom_" name="spPostAvailFrom" value="<?php if ($spPostAvailFrom) {
echo $spPostAvailFrom;
} ?>" readonly />
</div>
</div>
<div class="col-md-3">
<div class="form-group">
<label class="control-label lbl_8" for="spPostAvailTo_">Availability To</label>
<input type="text" class="form-control spPostField" id="spPostAvailTo_" name="spPostAvailTo" value="<?php if ($spPostAvailTo) {
echo $spPostAvailTo;
} ?>" readonly />
</div>
</div>

<!--   <div class="col-md-3">
<div class="form-group">
<label for="spPostingPropStatus_">Status</label>
<select class="form-control spPostField" data-filter="1" id="spPostingPropStatus_" name="spPostingPropStatus" value="">
<option value="Active"  >Active</option>
<option value="Sold"  
<option value="Expired"  
</select>
</div>
</div> -->
<!-- <div class="col-md-3">
<div class="form-group">
<label for="spPostInterNetInclude_">Internet Included</label>
<select class="form-control spPostField" data-filter="1" id="spPostInterNetInclude_" name="spPostInterNetInclude_" value="">
<option value="Yes" <?php echo (!empty($row6["Internet Included"]) && $row6["Internet Included"] == 'Yes') ? 'selected' : ''; ?> >Yes</option>
<option value="No" <?php echo (!empty($row6["Internet Included"]) && $row6["Internet Included"] == 'No') ? 'selected' : ''; ?> >No</option>
</select>
</div>
</div>
<div class="col-md-3">
<div class="form-group">
<label for="spPostHotWaterInclude_">Hot Water Included</label>
<select class="form-control spPostField" data-filter="1" id="spPostHotWaterInclude_" name="spPostHotWaterInclude_" value="">
<option value="Yes" <?php echo (!empty($row6["Hot Water Included"]) && $row6["Hot Water Included"] == 'Yes') ? 'selected' : ''; ?>  >Yes</option>
<option value="No" <?php echo (!empty($row6["Hot Water Included"]) && $row6["Hot Water Included"] == 'No') ? 'selected' : ''; ?> >No</option>
</select>
</div>
</div> -->
<!-- THIS IS NEW SCRIPT -->
<!-- <div class="col-md-3">
<div class="form-group">
<label for="spPostBreakFastInclude_">Break Fast Included</label>
<select class="form-control spPostField" data-filter="1" id="spPostBreakFastInclude_" name="spPostBreakFastInclude_" value="">
<option value="Yes" <?php echo (!empty($row6["Break Fast Included"]) && $row6["Break Fast Included"] == 'Yes') ? 'selected' : ''; ?> >Yes</option>
<option value="No" <?php echo (!empty($row6["Break Fast Included"]) && $row6["Break Fast Included"] == 'No') ? 'selected' : ''; ?> >No</option>
</select>
</div>
</div> -->

<div class="col-md-3">
<div class="form-group">
<label for="spPostMealsInclude_">Meals Included</label>
<select class="form-control spPostField" data-filter="1" id="spPostingMeal" name="spPostingMeal">
<option value="Yes" <?php echo (!empty($prop_data["spPostingYes"]) && $prop_data["spPostingYes"] == 'Yes') ? 'selected' : ''; ?>>Yes</option>
<option value="No" <?php echo (!empty($prop_data["spPostingYes"]) && $prop_data["spPostingYes"] == 'No') ? 'selected' : ''; ?>>No</option>
</select>
</div>
</div>
<div class="col-md-4 spPostBreakFastInclude_">
<div class="form-group">
<label for="spPostBreakFastInclude_">&nbsp;</label><br>
<label class="checkbox-inline">
<input type="checkbox" name="BreakFast" id="Breakfast" value="1" <?php echo (!empty($BreakFast) && $BreakFast == 1) ? 'checked' : ''; ?>>Breakfast</label>
<label class="checkbox-inline">
<input type="checkbox" name="Lunch" id="Lunch" value="1" <?php echo (!empty($Lunch) && $Lunch == 1) ? 'checked' : ''; ?>>Lunch</label>
<label class="checkbox-inline">
<input type="checkbox" name="Dinner" id="Dinner" value="1" <?php echo (!empty($Dinner) && $Dinner == 1) ? 'checked' : ''; ?>>Dinner</label>  
</div>
</div>
</div>
<div class="row">
<div class="col-md-12 m_btm_15">
<h3>Rates</h3>
</div>
<div class="col-md-4">
<div class="form-group">
<label for="spPostAgencyFee_" class="lbl_9">Agency Fee </label><span class="red">*</span>
<input type="number" class="form-control spPostField" id="spPostAgencyFee_" name="spPostAgencyFee" data-filter="0" value="<?php echo $spPostAgencyFee; ?>" />
</div>
</div>
<!-- <div class="col-md-3">
<div class="form-group">
<label for="spPostingPrice">Price</label>
<input type="text" class="form-control" data-filter="1" id="spPostingPrice" name="spPostingPrice"  maxlength="8" value="<?php echo isset($ePrice) ? $ePrice : ''; ?>">
</div>
</div> -->
<div class="col-md-4">
<div class="form-group">
<label for="spPostingServicChrg_" class="lbl_10">Service Charges</label><span class="red">*</span>
<input type="number" class="form-control spPostField" id="spPostingServicChrg_" name="spPostingServicChrg" data-filter="0" value="<?php echo $spPostingServicChrg; ?>">
</div>
</div>
<div class="col-md-4">
<div class="form-group">
<label for="spPostingCleaningChrg_" class="lbl_11">Cleaning Charges </label><span class="red">*</span>
<input type="number" class="form-control spPostField" id="spPostingCleaningChrg_" name="spPostingCleaningChrg" data-filter="0" value="<?php echo $spPostingCleaningChrg; ?>">
</div>
</div>

<div class="col-md-4">
<div class="form-group">
<label for="spPostRentalMonth_" class="lbl_12">Rent Per Month </label><span class="red">*</span>
<input type="number" class="form-control spPostField" id="spPostRentalMonth_" name="spPostRentalMonth" data-filter="0" value="<?php echo $spPostRentalMonth; ?>">
</div>
</div>
<div class="col-md-4">
<div class="form-group">
<label for="spPostRentalWeek_" class="lbl_13">Rent Per Week </label><span class="red">*</span>
<input type="number" class="form-control spPostField" id="spPostRentalWeek_" name="spPostRentalWeek" data-filter="0" value="<?php echo $spPostRentalWeek; ?>">
</div>
</div>
<div class="col-md-4">
<div class="form-group">
<label for="spPostRentalNight_" class="lbl_14">Rent Per Night </label><span class="red">*</span>
<!-- <input type="number" class="form-control spPostField" id="spPostRentalNight_" name="spPostRentalNight_" data-filter="0" value="<?php //echo (empty($row["Rent Per Night($) *"]) ? "" : $row["Rent Per Night($) *"]);
?>"> -->
<input type="number" class="form-control spPostField" id="spPostRentalNight_" name="spPostRentalNight" value="<?php echo $spPostRentalNight; ?>">
</div>
</div>
</div>
</div>

<script type="text/javascript">
$(document).ready(function() {
$(".spPostBreakFastInclude_").show();
var startDate = new Date();

$('#config-demo').daterangepicker({

"minDate": startDate,

"linkedCalendars": false,
"autoUpdateInput": true,
"startDate": "<?php echo date('m/d/Y') ?>",
"endDate": "<?php echo date('m/d/Y') ?>"
}, function(start, end, label) {
$("#spPostAvailFrom_").val(start.format('YYYY-MM-DD'));
$("#spPostAvailTo_").val(end.format('YYYY-MM-DD'));
});

$("#spPostingMeal").change(function() {
var end = this.value;
var spPostingMealVal = $('#spPostingMeal option:selected').val();
if (spPostingMealVal == 'Yes') {
$(".spPostBreakFastInclude_").show();
} else {
$(".spPostBreakFastInclude_").hide();
}
});

});
</script>