

<div class="row sponsorInfo ">
<h3>Condition</h3>
<br>
<?php 


?>
<div class="col-md-4">
<div class="form-group">
<label for="spPostDog_">Dogs</label>
<select class="form-control spPostField" name="spPostDog" id="spPostDog_">
<option class="opt2" selected>Select any option</option>
<option value="Yes" <?php echo (!empty($spPostDog) && $spPostDog == 'Yes')?'selected':'';?> >Yes</option>
<option value="No" <?php echo (!empty($spPostDog) && $spPostDog == 'No')?'selected':'';?> >No</option>
</select>
</div>
</div>
<div class="col-md-4">
<div class="form-group">
<label for="spPostCat_">Cats</label>
<select class="form-control spPostField" name="spPostCat" id="spPostCat_">
<option class="opt2" selected>Select any option</option>
<option value="Yes" <?php echo (!empty($spPostCat ) && $spPostCat  == 'Yes')?'selected':'';?> >Yes</option>
<option value="No" <?php echo (!empty($spPostCat ) && $spPostCat  == 'No')?'selected':'';?> >No</option>
</select>
</div>
</div>
<div class="col-md-4">
<div class="form-group">
<label for="spPostSmoke_">Smoking</label>
<select class="form-control spPostField" name="spPostSmoke" id="spPostSmoke_">
<option class="opt2" selected>Select any option</option>
<option value="Yes" <?php echo (!empty($spPostSmoke) && $spPostSmoke == 'Yes')?'selected':'';?> >Yes</option>
<option value="No" <?php echo (!empty($spPostSmoke) && $spPostSmoke == 'No')?'selected':'';?> >No</option>
</select>

</div>
</div>
<!--  <div class="col-md-6">
<div class="form-group">
<label for="spPostLeaseTerm_">Lease Term</label>
<input type="text" class="form-control spPostField" id="spPostLeaseTerm_" name="spPostLeaseTerm_" value="<?php echo (empty($row["Lease Term"]) ? "" : $row["Lease Term"]);?>">
</div>
</div> -->

</div>
<div class="row sponsorInfo ">
<h3>Features</h3>
<br>
<div class="col-md-3">
<div class="form-group">
<label for="spPostStainless_">Stainless Steel Appliances</label>
<select class="form-control spPostField" name="spPostStainless" id="spPostStainless_">
<option class="opt2" selected>Select any option</option>
<option value="Yes" <?php echo (!empty($spPostStainless) && $spPostStainless == 'Yes')?'selected':'';?>>Yes</option>
<option value="No" <?php echo (!empty($spPostStainless) && $spPostStainless == 'No')?'selected':'';?>>No</option>
</select>
</div>
</div>
<div class="col-md-3">
<div class="form-group">
<label for="spPostCentralAir_">Central Air Conditioning</label>
<select class="form-control spPostField" name="spPostCentralAir" id="spPostCentralAir_">
<option class="opt2" selected>Select any option</option>
<option value="Yes" <?php echo (!empty($spPostCentralAir) && $spPostCentralAir == 'Yes')?'selected':'';?> >Yes</option>
<option value="No" <?php echo (!empty($spPostCentralAir) && $spPostCentralAir == 'No')?'selected':'';?>>No</option>
</select>
</div>
</div>
<div class="col-md-3">
<div class="form-group">
<label for="spPostLotsCloset_">Lots of Closet Space</label>
<select class="form-control spPostField" name="spPostLotsCloset" id="spPostLotsCloset_">
<option class="opt2" selected>Select any option</option>
<option value="Yes" <?php echo (!empty($spPostLotsCloset) && $spPostLotsCloset == 'Yes')?'selected':'';?> >Yes</option>
<option value="No" <?php echo (!empty($spPostLotsCloset) && $spPostLotsCloset == 'No')?'selected':'';?> >No</option>
</select>
</div>
</div>
<div class="col-md-3">
<div class="form-group">
<label for="spPostOpenFloor_">Open Floor Plan</label>
<select class="form-control spPostField" name="spPostOpenFloor" id="spPostOpenFloor_">
<option class="opt2" selected>Select any option</option>

<option value="Yes" <?php echo (!empty($spPostOpenFloor) && $spPostOpenFloor == 'Yes')?'selected':'';?> >Yes</option>
<option value="No" <?php echo (!empty($spPostOpenFloor) && $spPostOpenFloor == 'No')?'selected':'';?> >No</option>
<!-- <option value="Yes">Yes</option>
<option value="No">No</option> -->
</select>
</div>
</div>
<div class="col-md-3">
<div class="form-group">
<label for="spPostBuildAment_">Building Amenities</label>
<select class="form-control spPostField" name="spPostBuildAment" id="spPostBuildAment_">
<option class="opt2" selected>Select any option</option>
<option value="Yes" <?php echo (!empty($spPostBuildAment) && $spPostBuildAment == 'Yes')?'selected':'';?> >Yes</option>
<option value="No" <?php echo (!empty($spPostBuildAment) && $spPostBuildAment == 'No')?'selected':'';?> >No</option>
</select>
</div>
</div>
<div class="col-md-3">
<div class="form-group">
<label for="spPostWasher_">Washer/Dryer</label>
<select class="form-control spPostField" name="spPostWasher" id="spPostWasher_">
<option class="opt2" selected>Select any option</option>
<option value="Yes" <?php echo (!empty($spPostWasher) && $spPostWasher == 'Yes')?'selected':'';?> >Yes</option>
<option value="No" <?php echo (!empty($spPostWasher) && $spPostWasher == 'No')?'selected':'';?> >No</option>
</select>
</div>
</div>
<div class="col-md-3">
<div class="form-group">
<label for="spPostSpacious_">Spacious Backyard</label>
<select class="form-control spPostField" name="spPostSpacious" id="spPostSpacious_">
<option class="opt2" selected>Select any option</option>
<option value="Yes" <?php echo (!empty($spPostSpacious) &&$spPostSpacious == 'Yes')?'selected':'';?> >Yes</option>
<option value="No" <?php echo (!empty($spPostSpacious) && $spPostSpacious == 'No')?'selected':'';?> >No</option>
</select>
</div>
</div>
<div class="col-md-3">
<div class="form-group">
<label for="spPostGargParking_">Garage Parking</label>
<select class="form-control spPostField" name="spPostGargParking" id="spPostGargParking_">
<option class="opt2" selected>Select any option</option>
<option value="Yes" <?php echo (!empty($spPostGargParking) && $spPostGargParking  == 'Yes')?'selected':'';?> >Yes</option>
<option value="No" <?php echo (!empty($spPostGargParking) && $spPostGargParking  == 'No')?'selected':'';?> >No</option>
</select>
</div>
</div>
<div class="col-md-3">
<div class="form-group">
<label for="spPostJettedTub_">JETTED tub/acuzzi</label>
<select class="form-control spPostField" name="spPostJettedTub" id="spPostJettedTub_">
<option class="opt2" selected>Select any option</option>
<option value="Yes" <?php echo (!empty($spPostJettedTub) && $spPostJettedTub == 'Yes')?'selected':'';?> >Yes</option>
<option value="No" <?php echo (!empty($spPostJettedTub) && $spPostJettedTub == 'No')?'selected':'';?> >No</option>
</select>
</div>
</div>
<div class="col-md-3">
<div class="form-group">
<label for="spPostSwimPool_">Swimming Pool</label>
<select class="form-control spPostField" name="spPostSwimPool" id="spPostSwimPool_"
<option class="opt2" selected>Select any option</option>>
<option value="Yes" <?php echo (!empty($spPostSwimPool) && $spPostSwimPool == 'Yes')?'selected':'';?> >Yes</option>
<option value="No" <?php echo (!empty($spPostSwimPool) && $spPostSwimPool == 'No')?'selected':'';?> >No</option>
</select>
</div>
</div>
<div class="col-md-3">
<div class="form-group">
<label for="spPostBedType_">Bed type</label>
<select class="form-control spPostField" name="spPostBedType" id="spPostBedType_">
<option class="opt2" selected>Select any option</option>
<option value="Yes" <?php echo (!empty($spPostBedType) && $spPostBedType == 'Yes')?'selected':'';?> >Double bed</option>
<option value="No" <?php echo (!empty($spPostBedType) && $spPostBedType == 'No')?'selected':'';?> >single bed</option>
<option value="Bds" <?php echo (!empty($spPostBedType) && $spPostBedType == 'Bds')?'selected':'';?> >Both double and single bed</option>
<option value="sofa" <?php echo (!empty($spPostBedType) && $spPostBedType == 'sofa')?'selected':'';?> >Sofa-Bed</option>
<option value="king" <?php echo (!empty($spPostBedType) && $spPostBedType == 'king')?'selected':'';?> >King Bed</option>
<option value="twin" <?php echo (!empty($spPostBedType) && $spPostBedType == 'twin')?'selected':'';?> >Twin Bed</option>
</select>
</div>
</div>
<!-- <div class="col-md-3">
<div class="form-group">
<label for="spPostRentOwn_">Rent To Own</label>
<select class="form-control spPostField" name="spPostRentOwn_" id="spPostRentOwn_">
<option value="Yes" <?php echo (!empty($row["Rent To Own"]) && $row["Rent To Own"] == 'Yes')?'selected':'';?> >Yes</option>
<option value="No" <?php echo (!empty($row["Rent To Own"]) && $row["Rent To Own"] == 'No')?'selected':'';?> >No</option>
</select>
</div>
</div> -->
<div class="col-md-3">
<div class="form-group">
<label for="spPostFirePlace_">Fireplace</label>
<select class="form-control spPostField" name="spPostFirePlace" id="spPostFirePlace_">
<option class="opt2" selected>Select any option</option>
<option value="Yes" <?php echo (!empty($spPostFirePlace) && $spPostFirePlace == 'Yes')?'selected':'';?> >Yes</option>
<option value="No" <?php echo (!empty($spPostFirePlace) && $spPostFirePlace == 'No')?'selected':'';?> >No</option>
</select>
</div>
</div>
<div class="col-md-3">
<div class="form-group">
<label for="spPostBalcony_">Balcony</label>
<select class="form-control spPostField" name="spPostBalcony" id="spPostBalcony_">
<option value="Yes" <?php echo (!empty($spPostBalcony) && $spPostBalcony == 'Yes')?'selected':'';?> >Yes</option>
<option value="No" <?php echo (!empty($spPostBalcony) && $spPostBalcony == 'No')?'selected':'';?> >No</option>
</select>
</div>
</div>
<div class="col-md-3">
<div class="form-group">
<label for="spPostFenced_">Fenced Backyard</label>
<select class="form-control spPostField" name="spPostFenced" id="spPostFenced_">
<option value="Yes" <?php echo (!empty($spPostFenced) && $spPostFenced == 'Yes')?'selected':'';?> >Yes</option>
<option value="No" <?php echo (!empty($spPostFenced) && $spPostFenced == 'No')?'selected':'';?> >No</option>
</select>
</div>
</div>
<div class="col-md-3">
<div class="form-group">
<label for="spPostFitnesArea_">Fitness Area</label>
<select class="form-control spPostField" name="spPostFitnesArea" id="spPostFitnesArea_">
<option value="Yes" <?php echo (!empty($spPostFitnesArea) && $spPostFitnesArea == 'Yes')?'selected':'';?> >Yes</option>
<option value="No" <?php echo (!empty($spPostFitnesArea) && $spPostFitnesArea == 'No')?'selected':'';?> >No</option>
</select>
</div>
</div>

<div class="col-md-3">
<div class="form-group">
<label for="spPostStorage_">Storage</label>
<select class="form-control spPostField" name="spPostStorage" id="spPostStorage_">
<option value="Yes" <?php echo (!empty($spPostStorage) && $spPostStorage == 'Yes')?'selected':'';?> >Yes</option>
<option value="No" <?php echo (!empty($spPostStorage) && $spPostStorage == 'No')?'selected':'';?> >No</option>
</select>
</div>  
</div>
<div class="col-md-6">
<div class="form-group">
<label for="spPostClosePublic_">Close to Public Transportation</label>
<select class="form-control spPostField" name="spPostClosePublic" id="spPostClosePublic_">
<option value="Yes" <?php echo (!empty($spPostClosePublic) && $spPostClosePublic == 'Yes')?'selected':'';?> >Yes</option>
<option value="No" <?php echo (!empty($spPostClosePublic) && $spPostClosePublic == 'No')?'selected':'';?> >No</option>
</select>
</div>
</div>

</div>
<div class="row sponsorInfo ">
<h3>Utilities Included</h3>
<br>
<div class="col-md-3">
<div class="form-group">
<label for="spPostHeat_">Heat</label>
<select class="form-control spPostField" name="spPostHeat" id="spPostHeat_">
<option value="Yes" <?php echo (!empty($spPostHeat) && $spPostHeat == 'Yes')?'selected':'';?> >Yes</option>
<option value="No" <?php echo (!empty($spPostHeat) && $spPostHeat == 'No')?'selected':'';?> >No</option>
</select>
</div>
</div>
<div class="col-md-3">
<div class="form-group">
<label for="spPostWater_">Water</label>
<select class="form-control spPostField" name="spPostWater" id="spPostWater_">
<option value="Yes" <?php echo (!empty($spPostWater) && $spPostWater == 'Yes')?'selected':'';?> >Yes</option>
<option value="No" <?php echo (!empty($spPostWater) && $spPostWater == 'No')?'selected':'';?> >No</option>
</select>
</div>
</div>
<div class="col-md-3">
<div class="form-group">
<label for="spPostElect_">Electricity</label>
<select class="form-control spPostField" name="spPostElect" id="spPostElect_">
<option value="Yes" <?php echo (!empty($spPostElect) && $spPostElect == 'Yes')?'selected':'';?> >Yes</option>
<option value="No" <?php echo (!empty($spPostElect) && $spPostElect == 'No')?'selected':'';?> >No</option>
</select>
</div>
</div>
<div class="col-md-3">
<div class="form-group">
<label for="spPostCableTv_">Cable Tv</label>
<select class="form-control spPostField" name="spPostCableTv" id="spPostCableTv_">
<option value="Yes" <?php echo (!empty($spPostCableTv) && $spPostCableTv == 'Yes')?'selected':'';?> >Yes</option>
<option value="No" <?php echo (!empty($spPostCableTv) && $spPostCableTv == 'No')?'selected':'';?> >No</option>
</select>
</div>
</div>
<div class="col-md-3">
<div class="form-group">
<label for="spPostInternet_">Internet</label>
<select class="form-control spPostField" name="spPostInternet" id="spPostInternet_">
<option value="Yes" <?php echo (!empty($spPostInternet ) && $spPostInternet  == 'Yes')?'selected':'';?> >Yes</option>
<option value="No" <?php echo (!empty($spPostInternet ) && $spPostInternet  == 'No')?'selected':'';?> >No</option>
</select>
</div>
</div>

<div class="col-md-3">
<div class="form-group">
<label for="spPostSecurtyCam_">Security Camera</label>
<select class="form-control spPostField" name="spPostSecurtyCam" id="spPostSecurtyCam_">
<option value="Yes" <?php echo (!empty($$spPostSecurtyCam) && $spPostSecurtyCam == 'Yes')?'selected':'';?> >Yes</option>
<option value="No" <?php echo (!empty($spPostSecurtyCam) && $spPostSecurtyCam == 'No')?'selected':'';?> >No</option>
</select>
</div>
</div>
<div class="col-md-3">
<div class="form-group">
<label for="spPostCntrlAces_">Controlled-Access Lobby</label>
<select class="form-control spPostField" name="spPostCntrlAces" id="spPostCntrlAces_">
<option value="Yes" <?php echo (!empty($spPostCntrlAces ) && $spPostCntrlAces  == 'Yes')?'selected':'';?> >Yes</option>
<option value="No" <?php echo (!empty($spPostCntrlAces ) && $spPostCntrlAces  == 'No')?'selected':'';?> >No</option>
</select>
</div>
</div>
<div class="col-md-3">
<div class="form-group">
<label for="spPostFulyEquipedGym_">Fitness: Fully Equipped Gym</label>
<select class="form-control spPostField" name="spPostFulyEquipedGym" id="spPostFulyEquipedGym_">
<option value="Yes" <?php echo (!empty($spPostFulyEquipedGym) && $spPostFulyEquipedGym == 'Yes')?'selected':'';?> >Yes</option>
<option value="No" <?php echo (!empty($spPostFulyEquipedGym) && $spPostFulyEquipedGym == 'No')?'selected':'';?> >No</option>
</select>
</div>
</div>

<div class="col-md-3">
<div class="form-group">
<label for="spPostConcierge_">Concierge</label>
<select class="form-control spPostField" name="spPostConcierge" id="spPostConcierge_">
<option value="Yes" <?php echo (!empty($spPostConcierge) && $spPostConcierge == 'Yes')?'selected':'';?> >Yes</option>
<option value="No" <?php echo (!empty($spPostConcierge) && $spPostConcierge == 'No')?'selected':'';?> >No</option>
</select>
</div>
</div>
<div class="col-md-3">
<div class="form-group">
<label for="spPostElevator_">Elevator</label>
<select class="form-control spPostField" name="spPostElevator" id="spPostElevator_">
<option value="Yes" <?php echo (!empty($spPostElevator) && $spPostElevator == 'Yes')?'selected':'';?> >Yes</option>
<option value="No" <?php echo (!empty($spPostElevator) && $spPostElevator == 'No')?'selected':'';?> >No</option>
</select>
</div>
</div>
<div class="col-md-3">
<div class="form-group">
<label for="spPostOnsiteStore_">On-Site Convenience Store</label>
<select class="form-control spPostField" name="spPostOnsiteStore" id="spPostOnsiteStore_">
<option value="Yes" <?php echo (!empty($spPostOnsiteStore) && $spPostOnsiteStore == 'Yes')?'selected':'';?> >Yes</option>
<option value="No" <?php echo (!empty($spPostOnsiteStore) && $spPostOnsiteStore == 'No')?'selected':'';?> >No</option>
</select>
</div>
</div>

<div class="col-md-3">
<div class="form-group">
<label for="spPostParking_">Parking</label>
<select class="form-control spPostField" name="spPostParking" id="spPostParking_">
<option value="Garage_Single" <?php echo (!empty($spPostParking) && $spPostParking == 'Garage_Single')?'selected':'';?> >Garage Single</option>
<option value="Garage_Double" <?php echo (!empty($spPostParking) && $spPostParking == 'Garage_Double')?'selected':'';?> >Garage Double</option>
<option value="Garage_Triple" <?php echo (!empty($spPostParking) && $spPostParking == 'Garage_Triple')?'selected':'';?> >Garage Triple</option>
<option value="Underground" <?php echo (!empty($spPostParking) && $spPostParking== 'Underground')?'selected':'';?> >Underground</option>
<option value="Covered" <?php echo (!empty($spPostParking) &&$spPostParking == 'Covered')?'selected':'';?> >Covered</option>
<option value="Outdorr" <?php echo (!empty($spPostParking) && $spPostParking == 'Outdoor')?'selected':'';?> >Outdoor</option>
<option value="Street" <?php echo (!empty($spPostParking) && $spPostParking == 'Street')?'selected':'';?> >On Street</option>
</select>
</div>
</div>
<!-- <div class="col-md-6">
<div class="form-group">
<label for="spPostProfBuild_">Professional Building Management On Site</label>
<select class="form-control spPostField" name="spPostProfBuild_" id="spPostProfBuild_">
<option value="Yes" <?php echo (!empty($row["Professional Building Management On Site"]) && $row["Professional Building Management On Site"] == 'Yes')?'selected':'';?> >Yes</option>
<option value="No" <?php echo (!empty($row["Professional Building Management On Site"]) && $row["Professional Building Management On Site"] == 'No')?'selected':'';?> >No</option>
</select>
</div>
</div>
-->

</div>


<div class="row sponsorInfo ">
<h3>status</h3>
<br>

<div class="col-md-3">
<div class="form-group">
<label for="spPostingPropStatus_">Status</label>
<select class="form-control spPostField" data-filter="1" id="spPostingPropStatus_" name="spPostingPropStatus" value="">
<option value="Active" <?php echo (!empty($spPostingPropStatus1) && $spPostingPropStatus1 == 'Active')?'selected':'';?> >Active</option>
<option value="Sold" <?php echo (!empty($spPostingPropStatus1) && $spPostingPropStatus1 == 'Sold')?'selected':'';?>>Sold</option>
<option value="Expired" <?php echo (!empty($spPostingPropStatus1) && $spPostingPropStatus1 == 'Expired')?'selected':'';?>>Expired</option>
</select>
</div>
</div>

<!---<div class="col-md-6">
<div class="form-group">
<label class="lbl_7a"></label>
<label class="radio-inline">
<input <?php if(isset($_GET['postid'])){ if($status_active_sold=='ACTIVE'){ echo ' checked="checked" '; } }else { echo ' checked="checked" '; } ?> type="radio" name="status_active_sold" value="ACTIVE">ACTIVE
</label>
<label class="radio-inline">
<input <?php if($status_active_sold=='SOLD'){ echo ' checked="checked" '; }  ?> type="radio" name="status_active_sold" value="SOLD">SOLD
</label>
</div>
</div>--->
</div>