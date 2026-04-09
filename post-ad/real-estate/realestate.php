<?php
// print_r($row);
// exit;
?>



<div class="row">
<div class="col-md-6"> 
<div class="form-group">
<label for="spPostingPropertyType_">Property Type</label>
<select class="form-control spPostField" data-filter="1" id="spPostingPropertyType" name="spPostingPropertyType" value="<?php echo (empty($row6["Property type"]) ? "" : $row6["Property type"]); ?>">
<?php
$m = new _spAllStoreForm;
$result = $m->readPropertyType();
if ($result) {
while ($rows = mysqli_fetch_assoc($result)) { ?>
<option value='<?php echo $rows["propertyTypeTitle"]; ?>' <?php echo (!empty($row6["Property type"]) && $row6["Property type"] == $rows['propertyTypeTitle']) ? 'selected' : ''; ?>><?php echo $rows["propertyTypeTitle"]; ?></option>
<?php
}
}
?>
</select>
</div>
</div>
<div class="col-md-3">
<div class="form-group">
<label for="spPostingPropStatus_">Status</label>
<select class="form-control spPostField" data-filter="1" id="spPostingPropStatus_" name="spPostingPropStatus" value="">
<?php
$m = new _spAllStoreForm;
$result2 = $m->readPropertyStats();
if ($result) {
while ($row2 = mysqli_fetch_assoc($result2)) { ?>
<option value='<?php echo $row2["spProStatusTitle"]; ?>' <?php echo (!empty($row6["Status"]) && $row6["Status"] == $row2["spProStatusTitle"]) ? 'selected' : ''; ?>><?php echo $row2["spProStatusTitle"]; ?></option>
<?php
}
}
?>
</select>
</div>
</div>
<div class="col-md-3">
<div class="form-group">
<label for="spPostingPostalcode_" class="lbl_4">Postal code <span class="red">*</span></label>
<input type="text" class="form-control spPostField" id="spPostingPostalcode_" name="spPostingPostalcode" data-filter="0" value="<?php echo (empty($row["Postal code *"]) ? "" : $row["Postal code"]); ?>" required>
</div>
</div>
<div class="col-md-3">
<div class="form-group">
<label for="spPostingYearBuilt_" class="lbl_5">Year built <span class="red">*</span></label>

<input type="text" class="form-control spPostField form_datetime" id="spPostingYearBuilt_" data-date="" data-date-format="yyyy" name="spPostingYearBuilt" data-filter="0" value="<?php echo (empty($row["Year built *"]) ? "" : $row["Year built *"]); ?>">
</div>
</div>

<div class="col-md-3">
<div class="form-group">
<label for="spPostingBedroom_" class="lbl_6">Bed Rooms<span class="red">*</span></label>
<input type="number" min="1" max="1000" class="form-control spPostField" id="spPostingBedroom_" name="spPostingBedroom" data-filter="1" value="<?php echo (empty($row["Bed Rooms*"]) ? "" : $row["Bed Rooms*"]); ?>">
</div>
</div>
<div class="col-md-3">
<div class="form-group">
<label for="spPostingBathroom_" class="lbl_7">Bath Rooms <span class="red">*</span></label>
<input type="number" min="1" max="1000" class="form-control spPostField" id="spPostingBathroom_" name="spPostingBathroom" data-filter="1" value="<?php echo (empty($row["Bath Rooms *"]) ? "" : $row["Bath Rooms *"]); ?>">
</div>
</div>


<div class="col-md-3">
<div class="form-group">
<label for="spPostBasement_" class="lbl_8">Basements <span class="red"></span></label>
<input type="number" class="form-control spPostField" id="spPostBasement_" name="spPostBasement" data-filter="0" value="<?php echo (empty($row["Basements"]) ? "" : $row["Basements"]); ?>">
</div>
</div>
<div class="col-md-3">
<div class="form-group">
<label for="spPostingPrice" class="lbl_9">Price($) <span class="red">*</span></label>
<input type="number" class="form-control" data-filter="1" id="spPostingPrice" name="spPostingPrice" value="<?php echo $ePrice; ?>">
</div>
</div>
<div class="col-md-3">
<div class="form-group">
<label for="spPostingSqurefoot_" class="lbl_10">Square foot <span class="red">*</span></label>
<input type="text" class="form-control spPostField" id="spPostingSqurefoot_" name="spPostingSqurefoot" data-filter="1" value="<?php echo (empty($row["Square foot *"]) ? "" : $row["Square foot *"]); ?>" required>
</div>
</div>
<div class="col-md-3">
<div class="form-group">
<label for="spPostUnitNum_" class="lbl_11">Unit Number <span class="red">*</span></label>
<input type="text" class="form-control spPostField" id="spPostUnitNum_" name="spPostUnitNum" data-filter="1" value="<?php echo (empty($row["Unit Number *"]) ? "" : $row["Unit Number *"]); ?>" />
</div>
</div>
<div class="col-md-3">
<div class="form-group">
<label for="spPostTaxAmt_" class="lbl_12">Tax Amount($) <span class="red">*</span></label>
<input type="number" class="form-control spPostField" id="spPostTaxAmt_" name="spPostTaxAmt" data-filter="1" value="<?php echo (empty($row["Tax Amount($) *"]) ? "" : $row["Tax Amount($) *"]); ?>" />
</div>
</div>
<div class="col-md-3">
<div class="form-group">
<label for="spPostTaxYear_" class="lbl_13">Tax Year 5555<span class="red">*</span></label>
<input type="text" class="form-control spPostField form_datetime" id="spPostTaxYear_" data-date-format="yyyy" name="spPostTaxYear" data-filter="1" value="<?php echo (empty($row["Tax Year *"]) ? "" : $row["Tax Year *"]); ?>" />
</div>
</div>
<div class="col-md-3">
<div class="form-group">
<label for="spPostListId_" class="lbl_14">Listing Id
<!-- <span class="red"></span> -->
</label>
<input type="text" class="form-control spPostField" id="spPostListId_" name="spPostListId" data-filter="1" value="<?php echo (empty($row["spPostListId"]) ? "" : $row["spPostListId"]); ?>" />
</div>
</div>



</div>