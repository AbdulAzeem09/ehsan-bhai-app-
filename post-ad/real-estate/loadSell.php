<?php
if (!isset($_GET['type'])) {
function sp_autoloader($class){
include '../../mlayer/' . $class . '.class.php';
}
spl_autoload_register("sp_autoloader");
}
// print_r($prop_data);
// exit;
?>


<?php
$p = new _postingview;
$r = $p->read($_GET["postid"]);
//print_r($r);
//die('=====');

if ($r != false) {
while ($row = mysqli_fetch_assoc($r)) {
//print_r($row);
//die('======');

}

}



?>



<div class="row">		
<div class="col-md-6">
<div class="form-group">
<label for="spPostingPropertyType_">Property type </label><span class="red">*</span>
<select class="form-control spPostField" data-filter="1" id="spPostingPropertyType_" name="spPostingPropertyType" value="<?php echo (empty($row["Property type"]) ? "" : $row["Property type"]);?>">
<option value="Detached House">Detached House</option>
<option value="Condomenum">Condomenum</option>
<option value="Townhouse">Townhouse</option>
<option value="Duplex">Duplex</option>
<option value="Commecial Place">Commecial Place</option>
<option value="Mobile Home">Mobile Home</option>
<option value="Basement suite">Basement suite</option>

</select>
</div>
</div>
<div class="col-md-3">
<div class="form-group">
<label for="spPostingPropStatus_">Status</label>
<select class="form-control spPostField" data-filter="1" id="spPostingPropStatus_" name="spPostingPropStatus" value="">
<option value="Active">Active</option>
<option value="Sold">Sold</option>
<option value="Expired">Expired</option>
</select>
</div>
</div>
<div class="col-md-3">
<div class="form-group">
<label for="spPostingPostalcode_" class="lbl_4">Postal code </label><span class="red">*</span>
<input type="text" class="form-control spPostField" id="spPostingPostalcode_" name="spPostingPostalcode" minlength="6" maxlength="6" data-filter="0" value="<?php echo (empty($row["Postal code"]) ? "" : $row["Postal code"]);?>" required>
</div>
</div>
<div class="col-md-3">
<div class="form-group">
<label for="spPostingYearBuilt_" class="lbl_5">Year built </label><span class="red">*</span>
<input type="text" class="form-control spPostField" id="spPostingYearBuilt_" name="spPostingYearBuilt"  data-filter="0" value="<?php echo (empty($row["Year built"]) ? "" : $row["Year built"]);?>">
</div>
</div>

<div class="col-md-3">
<div class="form-group">
<label for="spPostingBedroom_" class="lbl_6">Bed Rooms </label><span class="red">*</span>
<input type="number" min="1" max="1000" class="form-control spPostField" id="spPostingBedroom_" name="spPostingBedroom" data-filter="1" value="<?php echo (empty($row["Bedrooms"]) ? "" : $row["Bedrooms"]);?>">
</div>
</div>
<div class="col-md-3">
<div class="form-group">
<label for="spPostingBathroom_" class="lbl_7">Bath Rooms </label><span class="red">*</span>
<input type="number" min="1" max="1000" class="form-control spPostField" id="spPostingBathroom_" name="spPostingBathroom" data-filter="1" value="<?php echo (empty($row["Bathrooms"]) ? "" : $row["Bathrooms"]);?>">
</div>
</div>


<div class="col-md-3">
<div class="form-group">
<label for="spPostBasement_" class="lbl_8">Basements </label><span class="red">*</span>
<input type="text" class="form-control spPostField" id="spPostBasement_" name="spPostBasement" data-filter="0" value="">
</div>
</div>
<div class="col-md-3">
<div class="form-group">
<label for="spPostingPrice" class="lbl_9">Price </label><span class="red">*</span>
<input type="text" class="form-control" data-filter="1" id="spPostingPrice" name="spPostingPrice" value="<?php echo isset($ePrice)? $ePrice: '';?>">
</div>
</div>
<div class="col-md-3">
<div class="form-group">
<label for="spPostingSqurefoot_" class="lbl_10">Square foot </label><span class="red">*</span>
<input type="text" class="form-control spPostField" id="spPostingSqurefoot_" name="spPostingSqurefoot" data-filter="1" value="<?php echo (empty($row["Square foot"]) ? "" : $row["Square foot"]);?>" required>
</div>
</div>
<div class="col-md-3">
<div class="form-group">
<label for="spPostUnitNum_" class="lbl_11">Unit Number </label><span class="red">*</span>
<input type="text" class="form-control spPostField" id="spPostUnitNum_" name="spPostUnitNum" data-filter="1" value="" />
</div>
</div>
<div class="col-md-3">
<div class="form-group">
<label for="spPostTaxAmt_" class="lbl_12">Tax Amount </label><span class="red">*</span>
<input type="text" class="form-control spPostField" id="spPostTaxAmt_" name="spPostTaxAmt" data-filter="1" value="" />
</div>
</div>
<div class="col-md-3">
<div class="form-group">
<label for="spPostTaxYear_" class="lbl_13">Tax Year </label><span class="red">*</span>
<input type="text" class="form-control spPostField" id="spPostTaxYear_" name="spPostTaxYear" data-filter="1" value="" />
</div>
</div>
<div class="col-md-3">
<div class="form-group">
<label for="spPostListId_" class="lbl_14">Listing Id<!-- <span class="red">*</span> --></label>
<input type="text" class="form-control spPostField" id="spPostListId_" name="spPostListId" data-filter="1" value="" />
</div>
</div>



</div>


