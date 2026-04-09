<!--CSS FOR MULTISELECTOR-->

<?php 
// error_reporting(E_ALL);
// ini_set('display_errors', 'On');
    include('../../univ/baseurl.php');
    session_start();
   
 
        include '../../mlayer/' . $class . '.class.php';
   



?>

<link href="../../assets/css/bootstrap-multiselect.css" rel="stylesheet" type="text/css" />
<script src="../../assets/js/bootstrap-multiselect.js" type="text/javascript"></script>
<script type="text/javascript">
//USER ONE
$(function() {
$('#leftmenu').multiselect({
includeSelectAllOption: true
});
});
</script>
<!--CSS FOR MULTISELECTOR-->

<script type="text/javascript">
$("#spPostingOpenHouse_").on("change", function() {
//alert();
var openhouse = this.value;
if (openhouse == 'No') {
$(".showAgentBoxAdd").html("");
$("#spPostingSoldBy_").hide();



} else {
/*$(".showAgentBoxAdd").load("loadAgentName.php", function () {

});*/
}
});
//===Real-Estate-Agent-Sold By====================
$("#spPostingSoldBy_").on("change", function() {
var SoldBy = this.value;
if (SoldBy == 'Owner') {
$(".showAgentBoxAdd").html("");
} else {
$(".showAgentBoxAdd").load("loadAgentName.php", function() {

});
}
});


//===Real-Estate-Agent-Sold By====================
</script>
<div class="row sponsorInfo ">
<h3>Agent Detail</h3>
<br>

<div class="col-md-6">
<div class="form-group">
<label for="spPostingOpenHouse_">Open House</label>
<select class="form-control spPostField" name="spPostingOpenHouse" id="spPostingOpenHouse_">
<option selected>Select any option</option>
<option value="Yes" <?php if ($spPostingOpenHouse == 'Yes') {
echo 'selected';
} ?>>Yes</option>
<option value="No" <?php if ($spPostingOpenHouse == 'No') {
echo 'selected';
}  ?>>No</option>
</select>

</div>
</div>
<div class="col-md-6">
<div class="form-group">
<label for="spPostingSoldBy_">Sold By</label>
<select class="form-control spPostField" name="spPostingSoldBy" id="spPostingSoldBy_">
<option selected>Select any option</option>
<option value="Owner" <?php if ($spPostingSoldBy == 'Owner') {
echo 'selected';
} ?>>Owner</option>
<option value="Agent" <?php if ($spPostingSoldBy == 'Agent') {
echo 'selected';
}  ?>>Agent</option>
</select>
</div>
</div>
<div class="col-md-12">
<div class="form-group">
<label for="spPostingkeyword_">Keywords</label>
<textarea class="form-control spPostField" data-filter="0" id="spPostingkeyword_" name="spPostingkeyword"><?php echo $spPostingkeyword; ?></textarea>
</div>
</div>

<div class="showAgentBoxAdd">
<?php
function fordropdownselect($data, $keyword)
{
$dgff = in_array($keyword, $data);
if ($dgff) {
return 'true';
} else {
return 'false';
}
}

$arr = (explode(",", $spPostHighLit));

?>
</div>
<div class="col-md-12">
<div class="form-group highlit">
<label for="spPostHighLit_"><?php //echo $spPostHighLit.'====='; 
?>Select Highlights of the property</label><br>
<select id="leftmenu" class="form-control spPostField " name="spPostHighLit[]" multiple="multiple" style="width: 100%;">

<option value="Swimming Pool" <?php if (fordropdownselect($arr, 'Swimming Pool') == 'true') {
echo 'selected';
} ?>>Swimming Pool</option>
<option value="Heated Floor" <?php if (fordropdownselect($arr, 'Heated Floor') == 'true') {
echo 'selected';
} ?>>Heated Floor</option>
<option value="Sauna" <?php if (fordropdownselect($arr, 'Swimming Pool') == 'true') {
echo 'selected';
} ?>>Sauna</option>
<option value="A/C" <?php if (fordropdownselect($arr, 'A/C') == 'true') {
echo 'selected';
} ?>>A/C</option>
<option value="Spice Kitchen" <?php if (fordropdownselect($arr, 'Spice Kitchen') == 'true') {
echo 'selected';
} ?>>Spice Kitchen</option>
<option value="ClthWsh/Dryr/Frdg/Stve/DW" <?php if (fordropdownselect($arr, 'ClthWsh/Dryr/Frdg/Stve/DW') == 'true') {
echo 'selected';
} ?>>ClthWsh/Dryr/Frdg/Stve/DW</option>
<option value="Disposal-Waste" <?php if (fordropdownselect($arr, 'Disposal-Waste') == 'true') {
echo 'selected';
} ?>>Disposal-Waste</option>
<option value="Drapes/Window Coverings" <?php if (fordropdownselect($arr, 'Drapes/Window Coverings') == 'true') {
echo 'selected';
} ?>>Drapes/Window Coverings</option>
<option value="Garage Door Opener" <?php if (fordropdownselect($arr, 'Garage Door Opener') == 'true') {
echo 'selected';
} ?>>Garage Door Opener</option>
<option value="Microwave" <?php if (fordropdownselect($arr, 'Microwave') == 'true') {
echo 'selected';
} ?>>Microwave</option>
<option value="Pantry" <?php if (fordropdownselect($arr, 'Pantry') == 'true') {
echo 'selected';
} ?>>Pantry</option>
<option value="Security-RI" <?php if (fordropdownselect($arr, 'Security-RI') == 'true') {
echo 'selected';
} ?>>Security-RI</option>
<option value="Vacuum R.I" <?php if (fordropdownselect($arr, 'Vacuum R.I') == 'true') {
echo 'selected';
} ?>>Vacuum R.I</option>
<option value="Garden" <?php if (fordropdownselect($arr, 'Garden') == 'true') {
echo 'selected';
} ?>>Garden</option>
<option value="Sauna/Steam Room" <?php if (fordropdownselect($arr, 'Sauna/Steam Room') == 'true') {
echo 'selected';
} ?>>Sauna/Steam Room</option>

</select>
</div>
</div>

</div>
<div class="row sponsorInfo " id="multipleinfo">
<h3>Open House</h3>
<br>
<div class="col-md-4">
<div class="form-group">
<label class="control-label" for="openHouseDayone_">Day Date</label>
<input type="date" class="form-control spPostField form_datetime" data-date-format="yyyy-mm-dd" id="openHouseDayone_" name="openHouseDayone" value="<?php echo (empty($openHouseDayone) ? "" : $openHouseDayone); ?>" />
</div>
</div>
<div class="col-md-4">
<div class="form-group">
<label class="control-label" for="openHouseDayoneStrtTime_">Day Start Time</label>
<input type="time" class="form-control spPostField" id="openHouseDayoneStrtTime_" name="openHouseDayoneStrtTime" value="<?php echo (empty($openHouseDayoneStrtTime) ? "" : $openHouseDayoneStrtTime); ?>" />
</div>
</div>
<div class="col-md-4">
<div class="form-group">
<label class="control-label" for="openHouseDayoneEndTime_">Day End Time</label>
<input type="time" class="form-control spPostField" id="openHouseDayoneEndTime_" name="openHouseDayoneEndTime" value="<?php echo (empty($openHouseDayoneEndTime) ? "" : $openHouseDayoneEndTime); ?>" />
</div>
</div>
<!----<div class="col-md-4">
<div class="form-group">
<label class="control-label" for="openHouseDayTwo_">Day 2 Date</label>
<input type="text" class="form-control spPostField form_datetime" id="openHouseDayTwo_" data-date-format="yyyy-mm-dd" name="openHouseDayTwo" value="<?php echo (empty($row6["Day 2 Date"]) ? "" : $row6["Day 2 Date"]); ?>" />
</div>
</div>
<div class="col-md-4">
<div class="form-group">
<label class="control-label" for="openHouseDayTwoStrtTime_">Day 2 Start Time</label>
<input type="time" class="form-control spPostField" id="openHouseDayTwoStrtTime_" name="openHouseDayTwoStrtTime" value="<?php echo (empty($row6["Day 2 Start Time"]) ? "" : $row6["Day 2 Start Time"]); ?>" />
</div>
</div>
<div class="col-md-4">
<div class="form-group">
<label class="control-label" for="openHouseDayTwoEndTime_">Day 2 End Time</label>
<input type="time" class="form-control spPostField" id="openHouseDayTwoEndTime_" name="openHouseDayTwoEndTime" value="<?php echo (empty($row6["Day 2 End Time"]) ? "" : $row6["Day 2 End Time"]); ?>" />
</div>
</div>--->
</div>

<script>
$(document).ready(function() {
$('#spPostingOpenHouse_').change(function() {
if ($(this).val() == 'No') {
$('#multipleinfo').hide();
}
if ($(this).val() == 'Yes') {
$('#multipleinfo').show();
}
})
});
</script>

<div class="row sponsorInfo ">
<h3>contact seller</h3>
<?php
$uid = $_SESSION['uid'];
$b = new _currency;
$data = $b->readCurrency();
$dataucurrency = $b->readCurrencyuser($uid);
$rowucurrency = mysqli_fetch_array($dataucurrency);
?>
<br>


<div class="col-md-3">
  <div class="form-group">
  <label class="control-label" for="seller_picture">Profile</label>
  <input type="file" class="form-control" name="seller_picture" id="seller_picture"/>
  </div>
</div>


<div class="col-md-3">
<div class="form-group">
<label class="control-label" for="openHouseDayone_">Name</label>
<input type="text" class="form-control" name="seller_name" value="<?php if (empty($seller_name)) {
echo $rowucurrency['spUserName'];
} else {
echo $seller_name;
} ?>" placeholder="Name" />
</div>
</div>
<div class="col-md-3">
<div class="form-group">
<label class="control-label" for="openHouseDayone_">Email</label>
<input type="email" class="form-control" name="seller_email" value="<?php if (empty($seller_email)) {
echo $rowucurrency['spUserEmail'];
} else {
echo $seller_email;
} ?>" placeholder="Email" />
</div>
</div>
<div class="col-md-3">
<div class="form-group">
<label class="control-label sellerMob" for="openHouseDayone_">Mobile Number</label>
<input type="text" onkeypress="return onlyNumberKey(event)" class="form-control" maxlength="10" id="seller_mnumber_"name="seller_mnumber" value="<?php if (empty($seller_mnumber)) {
echo $rowucurrency['spUserPhone'];
} else {
echo $seller_mnumber;
} ?>" placeholder="Number" />
</div>
</div>
<?php if($_GET['postid']){
    ?>
<div class="col-md-3">
<div class="form-group">
  <?php  if($saller_picture==''){
$saller_picture=$BaseUrl1.' '."/img/noman.png";
    }
    ?>
<label class="control-label" for="seller_picture">Picture Preview</label>
<img src="<?php echo $saller_picture ; ?>" alt="" style="width: 50px;" >

</div>
</div>

<?php } ?>


</div>

<div class="row sponsorInfo ">
<h3>status</h3>
<br>


<?php if($_GET['postid'] == true) { 
$fynh="";
}
else {
       $fynh="style='display:none;'";
    } ?>

<div class="col-md-3"<?php echo $fynh; ?>>
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
<input <?php if (isset($_GET['postid'])) {
if ($status_active_sold == 'ACTIVE') {
echo ' checked="checked" ';
}
} else {
echo ' checked="checked" ';
} ?> type="radio" name="status_active_sold" value="ACTIVE">ACTIVE
</label>
<label class="radio-inline">
<input <?php if ($status_active_sold == 'SOLD') {
echo ' checked="checked" ';
}  ?> type="radio" name="status_active_sold" value="SOLD">SOLD
</label>
</div>
</div>--->

</div>



<script>
function onlyNumberKey(evt) {

// Only ASCII character in that range allowed
var ASCIICode = (evt.which) ? evt.which : evt.keyCode
if (ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57))
return false;
return true;
}
</script>
