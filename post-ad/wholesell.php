<?php
include('../../univ/baseurl.php');
session_start();

if ($_POST["retailflag"] == 1) {
function sp_autoloader($class)
{
include '../mlayer/' . $class . '.class.php';
}
spl_autoload_register("sp_autoloader");
$f = new _postfield;
$res = $f->field($_POST["postid"]);
if ($res != false)
while ($result = mysqli_fetch_assoc($res)) {
$row[$result["spPostFieldLabel"]] = $result["spPostFieldValue"];
}

$p = new _postingview;
$r = $p->read($_POST["postid"]);
if ($r != false) {
$rw = mysqli_fetch_assoc($r);
$ePrice = $rw["spPostingPrice"];
$quantitytype = $rw["quantitytype"];
echo  $spOrderQty_11 = $rw["spOrderQty"];
//die("+++++++++++++++");
} else {
$quantitytype  = "Hard";
}
}
?>

<script type="text/javascript">
$(function() {
$('#fobprice').keypress(function(e) {
if (isNaN(this.value + "" + String.fromCharCode(e.charCode))) {
e.preventDefault(); //stop character from entering input
}
});

$('#minorderqty_').keypress(function(e) {
if (isNaN(this.value + "" + String.fromCharCode(e.charCode))) {
e.preventDefault(); //stop character from entering input
}
});

$('#supplyability_').keypress(function(e) {
if (isNaN(this.value + "" + String.fromCharCode(e.charCode))) {
e.preventDefault(); //stop character from entering input
}
});

});
</script>


<div class="wholesell">

<!-- 	<div class="col-md-4">
<input type="hidden" id="wholesellflag" name="spPostingsFlag" value="0"> 
<div class="form-group">
<label for="fobprice" class="">FOB Price ($)<span>* <span class="lbl_5"></span></span></label>
<input type="text" class="form-control" data-filter="0" id="fobprice" maxlength="8" name="spPostingPrice" value="<?php echo (empty($ePrice) ? '' : $ePrice); ?>" >
</div>
</div> -->


<div class="col-md-4" style="">
<div class="form-group" style="padding-top: 26px;">
<input type="radio" class=" " value="Hard" id="hardqty" name="quantitytype" <?php if ($quantitytype == "Hard") {
echo "checked";
} ?>>
<label for="hardqty">Hard Quantity </label>
<input type="radio" class=" " value="Soft" id="softqty" name="quantitytype" <?php if ($quantitytype == "Soft") {
echo "checked";
} ?>>
<label for="softqty">Soft Quantity </label>

<!--<input type="hidden" id="quantity" class="spPostField" name="quantitytype" value="Hard">-->


</div>
</div>

<div class="col-md-4" style="" id="industry_select" style="display:none;">
<div class="form-group">
<label for="industryType_">Industry Type <span> <span class="lbl_19"></span></span></label>
<select class="form-control spPostField" data-filter="1" name="industryType" id="industryType_">
<option value="0">Select Industry Type</option>
<?php
$it = new _spAllStoreForm;
$result2 = $it->readIndustryType();
if ($result2) {
while ($row2 = mysqli_fetch_assoc($result2)) {
?>
<option value="<?php echo str_replace(' ', '', $row2['industryTitle']); ?>" <?php if (ucwords(strtolower($row2['industryTitle'])) == $industryType) {
echo "selected";
} ?>><?php echo ucwords(strtolower($row2['industryTitle'])); ?></option>
<?php
}
}
?>
</select>
</div>
</div>

<!-- 	<div class="col-md-4">
<input type="hidden" id="wholesellflag" name="spPostingsFlag" value="0"> 
<div class="form-group">

</div>
</div> -->
<?php
$userid = $_SESSION['uid'];
//$profid=$_SESSION['pid'];
$c = new _spuser;
$currency = $c->getcurrency($userid);
$res = mysqli_fetch_assoc($currency);
//echo $curre = $res['currency'];
?>

<div class="col-md-4">
<input type="hidden" id="wholesellflag" name="spPostingsFlag" value="0">
<div class="form-group">
<label for="fobprice" class="">FOB Price (<?php echo $res['currency']; ?>)<span>* <span class="lbl_5"></span></span></label>
<input type="text" class="form-control" data-filter="0" id="fobprice" maxlength="8" name="spPostingPrice" value="<?php echo (empty($ePrice) ? '' : $ePrice); ?>">
</div>
</div>

<div class="col-md-4">
<div class="form-group">
<label for="minorderqty_" class="">Min Order Qty<span>* <span class="lbl_6"></span></span></label>
<input type="text" class="form-control spPostField" data-filter="0" id="minorderqty_" maxlength="5" name="minorderqty" value="<?php echo (empty($minorderqty) ? "1" : $minorderqty); ?>">
</div>
</div>

<div class="col-md-4">
<div class="form-group">
<label for="supplyability_" class="">Supply Ability<span>* <span class="lbl_7"></span></span></label>
<input type="number" class="form-control spPostField" data-filter="0" id="supplyability_" maxlength="5" min="0" name="supplyability" value="<?php echo (empty($supplyability) ? "1" : $supplyability); ?>">
</div>
</div>

<div class="col-md-4" id="showretailQuantity">
<div class="form-group">
<label for="retailQuantity_" class="">Quantity<span class="quantity">*<span class="lbl_60"></span></span></label>
<input type="number" class="form-control spPostField" data-filter="0" id="wholesaleQuantity" maxlength="15" name="wholesaleQuantity" placeholder="e.g: 2 pieces, kg etc.." value="<?php echo (empty($wholesaleQuantity) ? "1" : $wholesaleQuantity); ?>">
</div>
</div>
<div class="col-md-12">
<div class="form-group">
<label for="paymentterm_" class="">Payment Terms<span>* <span class="lbl_8"></span></span></label>
<input type="text" class="form-control spPostField" data-filter="0" id="paymentterm_" maxlength="40" name="paymentterm" value="<?php echo (empty($paymentterm) ? "" : $paymentterm); ?>">
</div>
</div>
</div>
<!-- 	<div class="pull-right col-md-12">
<?php

$up = new _spprofiles;
$res = $up->read($_POST["profileid"]);
if ($res != false) {
$rows = mysqli_fetch_assoc($res);
$membershipid = $rows["spMembership_idspMembership"];
if (isset($membershipid)) {
$m = new _spmembership;
$result = $m->readmember($membershipid);
if ($result != false) {
$rws = mysqli_fetch_assoc($result);
if ($rws["idspMembership"] != 0)
echo "<input type='text' class='form-control spPostField' data-filter='0' name='spPostingMembership_' id='spPostingMembership_' value='" . $rws["spMembershipName"] . "' style='text-align: center;background-color : green; color:white;'  readonly>";

else {
echo "<input type='hidden' id='buymem' value='0'>";
echo "<a class='btn btn-primary pull-right bradius-20' style='border-radius:20px;' href='../../membership/' role='button'>Buy Membership</a>";
}
}
} else {
echo "<input type='hidden' id='buymem' value='0'>";
echo "<a class='btn btn-primary pull-right bradius-20' style='border-radius:20px;' href='../../membership/' role='button'>Buy Membership</a>";
}
}
?>
</div> -->

<script type="text/javascript">
$(".quantity").click(function() {
var radioValue = $("input[name='quantitytype']:checked").val();
if (radioValue) {

$("#quantity").val(radioValue);
//alert("Your are a - " + radioValue);
}
});
</script>