<style>
.input-group[class*=col-] {
margin-top:-21px!important;
}


</style>


<input class="dynamic-pid" type="hidden" id="myprofileid" value="<?php echo $_SESSION['pid']; ?>">
<div class="col-md-12">
<div class="row">
<div id="artcateforhideshow">
<div class="col-md-6">
<?php
$postid = isset($_GET["postid"]) ? (int) $_GET["postid"] : 0;

if (!empty($artsubcategoryid)) {
$selectdataart = $artsubcategoryid;
} else {
$selectdataart = 0;
}
?>
<div class="form-group frm-left">
<label for="photos_" class="lbl_4">Category</label><span style="color:red;"> * </span>
<select onchange="forArtCategory(this.value,'forart','<?php echo $selectdataart; ?>')" class="form-control spPostField artCategory" data-filter="1" id="photos_" name="photos_" value="<?php echo (empty($row["Category"]) ? "" : $row["Category"]); ?>">
<option value="0">Category</option>
<?php
$m = new _subcategory;
$catid = 13;
$result = $m->readArtcate();
if ($result) {
while ($rows = mysqli_fetch_assoc($result)) { ?>
<option value='<?php echo $rows["idspArtgallery"]; ?>' <?php echo (isset($categoryid) && $categoryid == $rows['idspArtgallery']) ? 'selected' : ''; ?>><?php echo $rows["spArtgalleryTitle"]; ?></option>
<?php
}
}
?>
</select>





<!-- <div class="row">
<div class="col-sm-12">
<select>
<option value="0">Category</option>
<?php
$m = new _subcategory;

$result = $m->rain();
if ($result) {
while ($rows = mysqli_fetch_assoc($result)) { ?>

<option  value='<?php echo $rows["id"]; ?>'><?php echo $rows["select_category"]; ?></option>
<?php

}
}
?>
</select>
</div>
</div>  -->













</select>
</div>
</div>
<div class="col-md-6">
<div class="form-group frm-left">
<label for="photos_" class="lbl_5">Medium</label>
<select name="subcategoryforart" class="form-control" id="subcateforartss">
<option value="0">select</option>



</select>

</div>
</div>
</div>
<div id="craftcateforhideshow">
<?php
if (!empty($craftsubcategoryid)) {
$selectdatacraft = $craftsubcategoryid;
} else {
$selectdatacraft = 0;
}
?>
<div class="col-md-6">
<div class="form-group frm-left">
<label for="photos_" class="lbl_4">Craft Category</label><span style="color:red;"> * </span>
<select onchange="forArtCategory(this.value,'forcraft','<?php echo $selectdatacraft; ?>')" class="form-control spPostField spPostFieldforcraftt" data-filter="1" id="photoscraft_" name="craftcategory" value="<?php echo (empty($row["Category"]) ? "" : $row["Category"]); ?>">
<option value="0">Craft Category</option>
<?php
$mn = new _subcategories;
$result = $mn->craft_categorylist();

if ($result) {
while ($rows = mysqli_fetch_assoc($result)) { ?>
<option value='<?php echo $rows["id"]; ?>' <?php echo (isset($craftcategory) && $craftcategory == $rows['idspCraftgallery']) ? 'selected' : ''; ?>><?php echo $rows["craft_title"]; ?></option>
<?php
}
}
?>

</select>

</div>
</div>
<div class="col-md-6">
<div class="form-group frm-left">
<label for="photos_" class="">Medium</label><span style="color:red;"> </span>
<select name="subcategoryforcraft" class="form-control" id="subcateforcraft">
<option value="0">Craft Subcategory</option>
</select>

</div>
</div>
</div>


<script>
var category = $('#photos_ option:selected').val();
if (category != '') {
forArtCategory(category, 'forart', <?php echo $selectdataart; ?>);
}

var craftcategory = $('.spPostFieldforcraftt option:selected').val();
if (craftcategory != '') {
forArtCategory(craftcategory, 'forcraft', <?php echo $selectdatacraft; ?>);
}


function forArtCategory(cateid, work, selectdata) {
const xhttp = new XMLHttpRequest();
xhttp.onload = function() {
if (work == 'forart') {
document.getElementById("subcateforartss").innerHTML =
this.responseText;
}
if (work == 'forcraft') {
document.getElementById("subcateforcraft").innerHTML =
this.responseText;
}
}
xhttp.open("GET", "getsubcategory.php?cateid=" + cateid + "&work=" + work + "&selectdatacraft=" + selectdata);
xhttp.send();
}
</script>




<!---<div class="col-md-6" id="forMedium">
<div class="form-group">
<label for="medium_" class="lbl_5">Medium</label>
<div class="loadMedium">
<!-- <input type="text" class="form-control spPostField" id="medium_" name="medium_" value=""> -->
<!---<select class="form-control spPostField" id="medium_" name="medium_">
<?php
if (isset($mediam) && $mediam != '') {

$co = new _spAllStoreForm;
$result3 = $co->readInSubCategory($categoryid);
//echo $co->ta->sql;
if ($result3) {
while ($row3 = mysqli_fetch_assoc($result3)) { ?>
<option value='<?php echo $row3['insubcatTitle']; ?>' <?php echo ($mediam == $row3['insubcatTitle']) ? 'selected' : ''; ?>><?php echo $row3['insubcatTitle']; ?></option>
<?php
}
}
}
?>
</select>
</div>
</div>
</div>--->

<style type="text/css">
.makk{
margin-left: 42px !important;  
}.jsss{
	margin-left: 15px;
	width: 23%;
} 
.mmm{
	width: 19%;
}
#hidediscount{
	margin-left: 5px;
}
</style>
<div class="row">
<div class="col-md-3 jsss">
<div class="form-group frm-left">
<label for="photosalbum_" class="">Album</label>   
<div class="dropdown" id="wdth_bx" style="width: 100px;">   
<button class="btn btn-default dropdown-toggle myalbum" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"><?php echo (empty($row["Album"]) ? "Select Album" : $row["Album"]); ?>
<span class="caret"></span>   
</button>
<ul class="dropdown-menu albumdroupdown" aria-labelledby="my_album">
<?php
$p = new _album;
$res = $p->photos($_SESSION['uid']);
if ($res != false) {
while ($rows = mysqli_fetch_assoc($res)) {
echo "<li><a href='#' class='my-album-dd' data-albumid='" . $rows['idspPostingAlbum'] . "' data-albumname='" . $rows['spPostingAlbumName'] . "'>" . $rows['spPostingAlbumName'] . "</a></li>";
}
}
?>
<li role="separator" class="divider"></li>
<!--<li><a href="../../album/">Create New Album</a></li>-->
<li><a href="#" data-toggle="modal" data-target="#exampleModal">Create New Album</a></li>
</ul>
</div>
<input type="hidden" class="album_id" name="spPostingAlbum_idspPostingAlbum_" data-filter="0">
<input type="hidden" class="form-control spPostField" id="photosalbum_" name="photosalbum_" data-filter="1" value="<?php echo (empty($row["Album"]) ? "" : $row["Album"]); ?>">
</div>
</div>
<div class="col-md-3">
<div class="form-group frm-left" id="forartsoldby">
<label for="spArtsoldby_" class="">Art Sold By</label>
<select class="form-control spPostField" name="spArtsoldby_" id="spArtsoldby_">
<option value="Artist" <?php echo (isset($artSoldBy) && $artSoldBy == 'Artist') ? 'selected' : ''; ?>>Artist</option>
<option value="Dealers/Resellers" <?php echo (isset($artSoldBy) && $artSoldBy == 'Dealers/Resellers') ? 'selected' : ''; ?>>Dealers/Resellers</option>
<option value="Wholesaler" <?php echo (isset($artSoldBy) && $artSoldBy == 'Wholesaler') ? 'selected' : ''; ?>>Wholesaler</option>
</select>
</div>
</div>
<!----<div class="col-md-6">
<div class="form-group">
<?php
$pr = new _spprofiles;
if (isset($organizerId)) {
$resultpr = $pr->read($organizerId);
//echo $p->ta->sql;
if ($resultpr != false) {
$row2 = mysqli_fetch_assoc($resultpr);
// echo $row2['spProfileName'];
}
}
?>
<label for="spPostingEventOrgId_" class="lbl_6">Organizer Name</label>
<input type="hidden" id="spPostingEventOrgId_" class="spPostField" name="spPostingEventOrgId_" value="<?php echo (isset($organizerId) && $organizerId != '') ? $organizerId : ''; ?>">
<input type="text" class="form-control spPostField" id="spPostingEventOrgName"  value="<?php echo (isset($row2['spProfileName'])) ? $row2['spProfileName'] : ''; ?>" required autocomplete="off" >            
</div>
</div>--->

<div class="col-md-3">
<div class="form-group radio-fld">
<label for="imagecost_" class="error_f" style="margin-right: -10px;">Original Price</label><span style="color: red; margin-left: 12px;">*</span>
<br>
<!-- <?php echo $imagecost; 
echo ('-------------'); ?> -->
<label class="radio-inline" style="margin-right: -5px;">
<input type="radio" class="spPostField postcost" id="imagecost_paid" value="1" checked="checked" name="imagecost" <?php if($imagecost==1){ echo 'checked'; } ?>>
Paid
</label>

<label class="radio-inline">
<input type="radio" class="spPostField postfree" id="imagecost_free" value="2" <?php if($imagecost==2){ echo 'checked'; } ?> name="imagecost">
Free
</label>
</div>
</div>
<div class="col-md-3" id="cost">
<div class="input-group scnd-clm">
<label for="imagecost_" class="error_f" style=" margin-right: -10px; "></label>
<span class="input-group-addon">USD</span>
<input id="wdth_bx" style=" width: 100px; " type="text" id="sppostcost" class="form-control" name="spPostingPrice" 111111111 value="<?php echo $ePrice; ?>" onkeypress="return onlyNumberKey(event)" maxlength="3">
</div>
</div>
</div>



</div>
<div class="row">
		<div class="col-md-3 pull-right">


<div id="hidediscount">
<label>Discount Price(Optional)</label>
<div class="input-group">
<span class="input-group-addon">USD</span>
<input id="wdth_bx" style=" width: 100px; " 22222222222222 onkeypress="return onlyNumberKey(event)" maxlength="3" pattern="[1-9]{1}[0-9]{9}" type="text" class="form-control" id="discountphoto" name="discountphoto" value="<?php echo $discountphoto; ?>">
</div>
</div>

</div>
</div>
<?php if($postid){
if($imagecost==1){?>
<script>
		 setTimeout(function(){
	$('#imagecost_paid').click();
	    },1000);

</script>
<?php }
if($imagecost==2){
?>
<script>
	 setTimeout(function(){
		$('#imagecost_free').click();
    },1000);
</script>
<?php } 
}?>
<script>
$("#sppostcost").keyup(function() {
var sppostcost = $('#sppostcost').val();
// alert(sppostcost);
if (sppostcost != '') {
$("#discountphoto").prop('disabled', false);
} else {
$("#discountphoto").prop('disabled', true);
}
});
$("#discountphoto").change(function() {
var sppostcost = $('#sppostcost').val();
var discountphoto = $('#discountphoto').val();
if (parseInt(sppostcost) <= parseInt(discountphoto)) {
$("#discountphoto").val('');
}
});

function onlyNumberKey(evt) {

// Only ASCII character in that range allowed
var ASCIICode = (evt.which) ? evt.which : evt.keyCode
if (ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57))
return false;
return true;
}
</script>
<!-----<div class="col-md-6" id="forExpirayDate">
<div class="form-group">
<label for="spPostingExpDt">Expiray Date</label>
<div class="input-group date form_datetime" data-date="" data-date-format="dd-M-yyyy " data-link-field="dtp_input1">
<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>                   
<input class="form-control" data-filter="1" size="16" id="spPostingExpDt" name="spPostingExpDt" type="text" value="
<?php
if ($eExDt) {
echo date('Y-m-d', strtotime($eExDt));
} else {
echo date('Y-m-d', strtotime("+30 days"));
}
?>
" >

</div>


</div>
</div>----->

<!----<div class="col-md-6" id="forMediaPrintedyear">
<div class="form-group">
<label for="mediaprinted_" class="lbl_7">Media Printed in(Year)</label>
<input type="text" class="form-control spPostField" id="mediaprinted_" name="mediaprinted_" value="<?php echo (isset($mediaPrinted)) ? $mediaPrinted : ''; ?>">
</div>
</div>---->
<br>
<div class="row">
<div class="col-md-3" id="forMediaPrintedyear">
<div class="form-group frm-left">
<label for="imagesize_">Select Art (inches)</label>
<br>

<select id="leftmenu" class="form-control spPostField imgSizeSelect" name="imagesize_" multiple="multiple" style="width: 100%;">
<?php
$as = new _artSize;
$res = $as->read(); //As a receiver

//echo $as->ta->sql;
if ($res != false) {
while ($rows = mysqli_fetch_assoc($res)) {
$pfss  = new _postfield;
$result6 = $pfss->readSizePost($postid);
if ($result6 != false) {
$selected = ' ';
while ($row6 = mysqli_fetch_assoc($result6)) {
//print_r($row6); die('==============');
if ($row6['spPostFieldValue'] == $rows['spSizeTitle']) {
$selected = 'selected';
}
}
}
echo "<option " . $selected . " value='" . $rows['spSizeTitle'] . "' id='" . $rows['idartsize'] . "' >" . $rows['spSizeTitle'] . "</option>";
}
}   ?>


</select>
</div>
</div>
<div class="col-md-3">
<div class="form-group frm-left">
<label for="quantity_" class="lbl_8">Quantity</label><span style="color:red;"> * </span>
<input style=" width: 100%; " 333333333 onkeypress="return onlyNumberKey(event)" maxlength="4" pattern="[1-9]{1}[0-9]{9}" type="text" class="form-control spPostField" id="quantity_" name="quantity_" value="<?php echo (isset($quantity) && $quantity > 0) ? $quantity : ''; ?>">
</div>
</div>



<div class="col-md-4" id="forFramingType">
<div class="form-group frm-left">
<label for="framingtype_">Framing Type</label>
<select class="form-control spPostField" id="framingtype_" name="framingtype_">
<?php
$m = new _spAllStoreForm;
$result2 = $m->readFrameType();
if ($result2) {
while ($row3 = mysqli_fetch_assoc($result2)) {
?>
<option value="<?php echo $row3['spFrameTitle']; ?>" <?php echo (isset($frameType) && $frameType == $row3['spFrameTitle']) ? 'selected' : ''; ?>><?php echo $row3['spFrameTitle']; ?> </option>
<?php
}
}

?>

</select>
</div>
</div>
<!-- <div class="col-md-4">
<div class="form-group">
<label for="framingtype_">Framing Type</label>
<input type="text" class="form-control spPostField" id="framingtype_" name="framingtype_" value="">
</div>
</div> -->



<div class="col-sm-2">
<div class="form-group frm-left">
<label class="lbl_7a">Is cancellable ?</label> <br>
<label class="radio-inline">
<input <?php if ($postid) {
echo '';
} else {
echo 'checked="checked"';
} ?> type="radio" name="is_cancellable" <?php if ($is_cancellable == 1) {
echo 'checked="checked"';
} ?> value="1"> Yes
<!-- 1 for Art -->
</label>
<label class="radio-inline">
<input type="radio" name="is_cancellable" <?php if ($is_cancellable == 0) {
echo 'checked="checked"';
} ?> value="0"> No
<!-- 2 for Craft -->
</label>
</div>
</div>

<div class="col-md-3 mmm">
<div class="form-group frm-left">
<label class="lbl_7a">Refund If Applicable </label> <br>
<label class="radio-inline">
<input onclick="loadDocReturn(1)" id="refund_yes" <?php if ($postid) {
echo 'checked="checked"';
} else {
echo '';
} ?> type="radio" name="return_if_applicable" <?php if ($return_if_applicable == 1) {
echo 'checked="checked"';
} ?> value="1"> Yes
<!-- 1 for Art -->
</label>
<label class="radio-inline">
<input id="return_if_applicable_iid" onclick="loadDocReturn(0)" type="radio" name="return_if_applicable" <?php if ($return_if_applicable == 0) {
echo 'checked="checked"';
} ?> value="0"> No
<!-- 2 for Craft -->
</label>
</div>
</div>


<div class="col-md-3">
<div class="form-group frm-left">
<div id="ifYes">
<label for="quantity_" class="err_refund">Refund Within(Days) <span class="red">*<span></label>
<input id="wdth_bxs" style=" width: 100px; " id="return_within_iid" onkeyup="numericFilter(this);" maxlength="2" type="text" class="form-control" name="return_within" value="<?php echo $return_within; ?>" placeholder="" required />
</div>
</div>
</div>

</div>
<div class="row"> 


</div>
</div>
