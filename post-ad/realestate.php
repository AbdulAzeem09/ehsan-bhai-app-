<?php
$row['defaltcurrency'] = $defaltcurrency;
$row["spPostingPropertyType"]=$spPostingPropertyType ; 
?>

<div class="row">		
  
  <div class="col-md-6">
    <div class="form-group">
      <label for="spPostingPropertyType" class="spPostingPropertyType_" >Property Type </label><span class="red">*</span>
      <select class="form-control spPostField" onchange="propType_1()" data-filter="1" id="spPostingPropertyType" name="spPostingPropertyType" required>
        <option selected >Select property type</option>   
        <option value="Detached House" <?php if($row["spPostingPropertyType"]=='Detached House' ){ echo 'selected';} ?>>Detached House</option>
        <option value="condominium"   <?php if($row["spPostingPropertyType"]=='condominium' ){ echo 'selected';} ?>>Condominium</option>
        <option value="Townhouse"   <?php if($row["spPostingPropertyType"]=='Townhouse' ){ echo 'selected';} ?> >Townhouse</option>
        <option value="Duplex"  <?php if($row["spPostingPropertyType"]=='Duplex' ){ echo 'selected';} ?> >Duplex</option>
        <option value="Commercial Place"  <?php if($row["spPostingPropertyType"]=='Commercial Place' ){ echo 'selected';} ?>>Commercial Space/Commercial Place</option>   
        <option value="Mobile Home"  <?php if($row["spPostingPropertyType"]=='Mobile Home' ){ echo 'selected';} ?>>Mobile Home</option>
        <option value="Basement suite"  <?php if($row["spPostingPropertyType"]=='Basement suite' ){ echo 'selected';} ?>>Basement suite</option>
        <option value="Land/Lot"  <?php if($row["spPostingPropertyType"]=='Land/Lot' ){ echo 'selected';} ?>>Land/Lot</option>
      </select>
    </div>
  </div>
<script>
function propType_1(){
  $(".spPostingPropertyType_").removeClass("label_error");
  $(".spPostingPropertyType_").text("Property Type");

  $val=$( "#spPostingPropertyType option:selected" ).text();
  if($val=='Condominium'||$val=='Townhouse'){
    $('#div_show').show();
  }else{
    $('#div_show').hide();
  }


  if($val=='Condominium'){
    $('#PostBaseme').hide();
  }else{
    $('#PostBaseme').show();
  }
  
  
  if($val=='Detached House' || $val=='Townhouse' || $val=='Land/Lot'){
    $('#lotSize').show();
  }else{
    $('#lotSize').hide();
  }
  
  if($val=='Detached House' || $val=='Land/Lot'){
    $('#unitNumber').hide();
  }else{
    $('#unitNumber').show();
  }
  
}

</script>

<div class="col-md-3">
<div class="form-group">
<label for="spPostingPostalcode_" class="lbl_4">Postal code</label> <span class="red">*</span>
<input type="text" class="form-control spPostField" id="spPostingPostalcode_" name="spPostingPostalcode" data-filter="0" value="<?php echo $spPostingPostalcode; ?>" required>
</div>
</div>
<div class="col-md-3">
<div class="form-group">
<label for="spPostingYearBuilt_" class="lbl_5">Year built </label><span class="red">*</span>

<input type="number" class="form-control spPostField" id="spPostingYearBuilt_" name="spPostingYearBuilt" value="<?php echo (empty($spPostingYearBuilt) ? "" : $spPostingYearBuilt);?>">
</div>
</div>
<div class="col-md-3" id="forbedrooms">
<div class="form-group">
<label for="spPostingBedroom_" class="lbl_6">Bed Rooms</label><span class="red">*</span>
<input type="number" maxlength="10" onkeyup="numericFilter(this);" class="form-control spPostField" id="spPostingBedroom_" name="spPostingBedroom" data-filter="1" value="<?php echo (empty($spPostingBedroom) ? "" : $spPostingBedroom);?>">
</div>
</div>


<div class="col-md-3" id="forbathrooms">
  <div class="form-group">
    <label for="spPostingBathroom_" class="lbl_7">Full Bath Rooms</label><span class="red">*</span>
    <input type="number" class="form-control spPostField" id="spPostingBathroom_" name="spPostingBathroom" data-filter="1" value="<?php echo $spPostingBathroom;?>">
  </div>
</div>

<div class="col-md-3" id="forpartialbathrooms">
  <div class="form-group">
    <label for="spPartialPostingBathroom_" class="lbl_15">Partial Bath Rooms</label>
    <input type="number" class="form-control spPostField" id="spPartialPostingBathroom_" name="spPartialPostingBathroom" value="<?php echo $spPartialPostingBathroom;?>">
  </div>
</div>

<div class="col-md-3" id="forBasementss">
<div class="form-group" id="PostBaseme" style="display: block;">
<label for="spPostBasement_" class="lbl_8">Basements</label><span class="red"></span>
<input type="number" class="form-control spPostField" id="spPostBasement_" name="spPostBasement" data-filter="0" value="<?php echo (empty($spPostBasement) ? "" : $spPostBasement);?>" maxlength="10" onkeyup="numericFilter(this);">
</div>
</div>
<div class="col-md-3">
  <?php include("currencyList.php");?>
</div>



<div class="col-md-3">
<div class="form-group">
<label for="spPostingPrice" class="lbl_9">Price</label><span class="red">*</span>
<input type="number" class="form-control" data-filter="1" id="spPostingPrice" name="spPostingPrice" value="<?php echo $ePrice;?>" min="1" onkeyup="numericFilter(this);"> 
</div>
</div>


<div class="col-md-3">
<div class="form-group">
<label for="spPostingSqurefoot_" class="lbl_10">Square foot</label><span class="red">*</span>
<input type="text" class="form-control spPostField" id="spPostingSqurefoot_" name="spPostingSqurefoot" data-filter="1" value="<?php echo (empty($spPostingSqurefoot) ? "" : $spPostingSqurefoot);?>" required>
</div>
</div>

<div class="col-md-3" id="lotSize" style="display:none;">
  <div class="form-group">
    <label for="lotSize_">Lot Size</label>
    <input type="text" class="form-control spPostField" id="lotSize_" name="lotSize" value="<?php echo $lotSize;?>" />
  </div>
</div>


<div class="col-md-3" id="unitNumber">
<div class="form-group">
<label for="spPostUnitNum_" class="lbl_11">Unit Number </label>
  <input type="number" class="form-control spPostField" id="spPostUnitNum_" name="spPostUnitNum" data-filter="1" value="<?php echo $spPostUnitNum;?>" maxlength="10"  onkeyup="numericFilter(this);"/>
</div>
</div>
<div class="col-md-3">
<div class="form-group">
<label for="spPostTaxAmt_" class="lbl_12">Tax Amount</label>
<input type="number" class="form-control spPostField" id="spPostTaxAmt_" name="spPostTaxAmt" data-filter="1" value="<?php echo (empty($spPostTaxAmt) ? "" : $spPostTaxAmt);?>" maxlength="3"  onkeyup="numericFilter(this);"/>
</div>
</div>

<div class="col-md-3" id="forbedroomstax">
  <div class="form-group">
    <label for="spPostTaxYear_" class="lbl_13">Tax Year </label>
    <input type="number" class="form-control spPostField" id="spPostTaxYear_" name="spPostTaxYear" data-filter="1" value="<?php echo (empty($spPostTaxYear) ? date("Y", strtotime("-1 year")) :$spPostTaxYear);?>" />
  </div>
</div>

<div class="col-md-3" id="community">
  <div class="form-group">
    <label for="community_" class="lbl_17">Community</label>
    <input type="text" class="form-control spPostField" id="community_" name="community" value="<?php echo $community;?>" />
  </div>
</div>

<div class="col-md-3">
<div class="form-group">


<label for="spPostListId_" class="">Listing Id</label><span class></span>
<input type="text" class="form-control spPostField" id=" " name="spPostListId" data-filter="1" value="<?php echo (empty($spPostListId) ? "" : $spPostListId);?>" maxlength="12" />
</div>
</div>
<div id="div_show" style="display:none;">
<div class="col-md-3">
<div class="form-group">
<label for="strata_title" class="lbl_01">Strata Title </label><span class="red">*</span>
<input type="text"  class="form-control spPostField" id="strata_title" name="strata_title" data-filter="1" value="<?php echo (empty($strata_title) ? "" : $strata_title);?>"/>
</div>
</div>
<div class="col-md-3">
<div class="form-group">
<label for="building_style" class="lbl_0">Building Style
</label><span class="red">*</span>
<input type="text" class="form-control spPostField" id="building_style" name="building_style" data-filter="1" value="<?php echo (empty($building_style) ? "" : $building_style);?>"  />
</div>
</div>
<div class="col-md-3">
<div class="form-group">
<label for="strata_fee" class="lbl_03">Strata Fee </label><span class="red">*</span>
<input type="text" class="form-control spPostField" id="strata_fee" name="strata_fee" data-filter="1" value="<?php echo (empty($strata_fee) ? "" : $strata_fee);?>" />
</div>
</div>
</div>


</div>
<script>





$(document).ready(function(){
//alert('ggggggggggggggggg');
$("#spPostingTitle").change(function(){
$(".lbl_1").removeClass("label_error");
$(".lbl_1").text("Title");
});
$("#spPostingAddress_").change(function(){
$(".lbl_16").removeClass("label_error");
$(".lbl_16").text(" Address");
});


$("#spPostDurstion_").change(function(){
$(".spPostDurstion_").removeClass("label_error");
$(".spPostDurstion_").text("Rent duration");
});
$("#spPostingPostalcode_").change(function(){
$(".lbl_4").removeClass("label_error");
$(".lbl_4").text("Postal Code");
});
$("#spPostingYearBuilt_").click(function(){
$(".lbl_5").removeClass("label_error");
$(".lbl_5").text("Year built");
});
$("#spPostingBedroom_").change(function(){
$(".lbl_6").removeClass("label_error");
$(".lbl_6").text(" Bed Room");
});
$("#spPostingBathroom_").change(function(){
$(".lbl_7").removeClass("label_error");
$(".lbl_7").text("Full Bath Rooms");
});

$("#spPostingPrice").change(function(){
$(".lbl_9").removeClass("label_error");
$(".lbl_9").text("Price ($)");
});
$("#Lot_Size_Formate").change(function(){
$(".lbl_150").removeClass("label_error");
$(".lbl_150").text("Lot Size Formate");
});
$("#spPostingSqurefoot_").change(function(){
$(".lbl_10").removeClass("label_error");
$(".lbl_10").text("Square foot");
});
$("#spPostUnitNum_").change(function(){
$(".lbl_11").removeClass("label_error");
$(".lbl_11").text("Unit Number");
});
$("#spPostTaxAmt_").change(function(){
$(".lbl_12").removeClass("label_error");
$(".lbl_12").text("Tax Amount($)");
});
$("#spPostTaxYear_").click(function(){
$(".lbl_13").removeClass("label_error");
$(".lbl_13").text("Tax Year");
});
// $("#spPostListId_").change(function(){
// 	$(".lbl_14").removeClass("label_error");
// 					$(".lbl_14").text("Listing Id");
// 	});
$("#spPostingNotes").change(function(){
$(".lbl_101").removeClass("label_error");
$(".lbl_101").text("Description");
});
$("#postingpic_realestate").click(function(){
$(".lbl_pic_error_mcg").removeClass("label_error");
$(".lbl_pic_error_mcg").text(" ");
});
})
</script>	
<script>	
function numericFilter(txb) {
  txb.value = txb.value.replace(/[^\0-9]/ig, "");
}
</script>	
<script>
$(document).ready(function () {
  $('#spPostingPropertyType').change(function () {
    if($(this).val()=='Land/lot'){
      $('#forbedrooms').hide();
      $('#forbathrooms').hide();
      $('#forBasementss').hide();
      $('#forbedroomstax').hide();
    }else{
      $('#forbedrooms').show();
      $('#forbathrooms').show();
      $('#forBasementss').show();
      $('#forbedroomstax').show();
    }
  })
});
</script>





