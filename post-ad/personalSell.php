<?php

include('../../univ/baseurl.php');
session_start();

if (isset($_POST["retailflag"]) && $_POST["retailflag"] == 1) {
function sp_autoloader($class)
{
include '../mlayer/' . $class . '.class.php';
}
spl_autoload_register("sp_autoloader");
$f = new _postfield;
$res = $f->field($_POST["postid"]);
if ($res != false)
while ($result = mysqli_fetch_assoc($res)) {
    
$row[$result["spPostFieldName"]] = $result["spPostFieldValue"];
}
}
/*$p = new _postingview;
$r = $p->read($_POST["postid"]);
if ($r != false)
{
die('=========');
$rw = mysqli_fetch_assoc($r);
$ePrice = $rw["spPostingPrice"];
$quantitytype = $rw["quantitytype"];

}*/
$p = new _productposting;
if (isset($_GET["postid"])) {

$r = $p->read($_GET["postid"]);

//echo $p->ta->sql;
if ($r != false) {
$rw = mysqli_fetch_assoc($r);
$ePrice = $rw["spPostingPrice"];

//print_r($rw);
//die('==11');

}




}

if($rw["quantitytype"]){
$quantitytype = $rw["quantitytype"];

}else{
$quantitytype  = "Hard";
}


//print_r($row);
?>
<script type="text/javascript">
$(function() {
$('#retailPrice').keypress(function(e) {
if (isNaN(this.value + "" + String.fromCharCode(e.charCode))) {
e.preventDefault(); //stop character from entering input
}
});
$('#retailDiscount_').keypress(function(e) {
if (isNaN(this.value + "" + String.fromCharCode(e.charCode))) {
e.preventDefault(); //stop character from entering input
}
});
$('#retailSpecDiscount_').keypress(function(e) {
if (isNaN(this.value + "" + String.fromCharCode(e.charCode))) {
e.preventDefault(); //stop character from entering input
}
});
//  $('#retailQuantity_').keypress(function(e){
//      if(isNaN(this.value+""+String.fromCharCode(e.charCode))){
//         e.preventDefault(); //stop character from entering input
//      }
// });
});
</script>
<style>
input[type=radio] {
vertical-align: text-bottom;
margin-bottom: 2px !important;
}
</style>
<!-- Retail code of Sell11111111111-->
<div class="retail">
<div class="col-md-4" style="">
<div class="form-group" style="padding-top: 26px;">

<input type="radio" class=" " value="Hard" id="hardqty" name="quantitytype" <?php if ($quantitytype == "Hard") {
    echo "checked";
} ?>>
<label for="hardqty" data-toggle="tooltip"  data-original-title="actual items are available">Hard Quantity </label>

<input type="radio" class=" " value="Soft" id="softqty" name="quantitytype" <?php if ($quantitytype == "Soft") {
    echo "checked";
} ?>>
<label for="softqty" data-toggle="tooltip"  data-original-title="actual items are not available ">Soft Quantity </label>
<!--<input type="hidden" id="quantity" class="spPostField" name="quantitytype" value=""> -->

</div>
</div>

<div class="col-md-4">
<div class="form-group">
<label for="protype">Product Type <span></span></label>
<select class="form-control protype" onchange="checkprotype(this.value)" id="protype" name="protype">

<option value="0" <?php if ($producttype == 0) {
echo "selected";
} ?>> Normal </option>
<option value="1" <?php if ($producttype == 1) {
echo "selected";
} ?>> Variants </option>
</select>
</div>
</div>
<script type="text/javascript">
setTimeout(function() {
<?php
if (isset($_GET['postid']) && $producttype == 1) {
?>

checkprotype(1);

<?php
}
?>

}, 1000);
</script>

<?php
$userid = $_SESSION['uid'];
//$profid=$_SESSION['pid'];
$c = new _spuser;
$currency = $c->getcurrency($userid);
$res = mysqli_fetch_assoc($currency);
//echo $curre = $res['currency'];
?>

<?php //echo $res['currency'].'hello'; 
?>
<div class="col-md-4" id="showretailPrice">
<div class="form-group">
<label for="retailPrice" class="">Price (<?php echo $res['currency']; ?>)<span>* <span class="lbl_50"></span></span></label>
<input type="text" class="form-control spPostField" data-filter="0" maxlength="8" id="retailPrice" name="spPostingPrice" value="<?php echo (empty($price) ? '' : $price); ?>">
</div>
</div>
<!--<div class="col-md-4">
<div class="form-group">
<label for="retailDiscount_" class="">Discount (%)</label>
<input type="text" class="chekspnum form-control spPostField" data-filter="0" maxlength="3" id="retailDiscount_" name="retailDiscount" value="<?php //echo (empty($retailDiscount) ? "" : $retailDiscount);
                                                                        ?>">
</div>
</div>-->
<div class="col-md-4">
<div class="form-group">
<label for="retailSpecDiscount_" class="">Special Discount Price </label>
<!-- <input type="text" class="form-control spPostField" placeholder="Only for 1st connection" maxlength="3" data-filter="0" id="retailSpecDiscount_" name="retailSpecDiscount_" value="<?php echo (empty($row["retailSpecDiscount_"]) ? "" : $row["retailSpecDiscount_"]); ?>"> -->
<input type="text" class="form-control spPostField" placeholder="" maxlength="3" data-filter="0" id="retailSpecDiscount_" name="retailSpecDiscount" value="<?php echo (empty($retailSpecDiscount) ? "" : $retailSpecDiscount); ?>">
</div>
</div>


<div class="col-md-4" id="showretailQuantity">
<div class="form-group">
<label for="retailQuantity_" class="">Quantity <span>* <span class="lbl_6"></span></span></label>
<input type="text" class="form-control spPostField" data-filter="0" id="retailQuantity_" maxlength="15" name="retailQuantity" placeholder="e.g: 2 pieces, kg etc.." value="<?php echo (empty($retailQuantity) ? "1" : $retailQuantity); ?>">
</div>
</div>



<div class="col-md-4">
<div class="form-group">
<label for="retailStatus_">Status <span>*</span></label>
<select class="form-control spPostField" data-filter="1" id="retailStatus_" name="retailStatus" value="<?php echo (empty($retailStatus) ? "" : $retailStatus); ?>">

<?php
$it = new _spAllStoreForm;
$result3 = $it->readProductStatus();
if ($result3) {
while ($row3 = mysqli_fetch_assoc($result3)) {
?>

<option value="<?php echo $row3['productStatusTitle'] ?>" <?php if ($row3['productStatusTitle'] == $retailStatus) {
echo "selected";
} ?>> <?php echo $row3['productStatusTitle']; ?> </option>

<?php
}
}
?>
</select>
</div>



<?php
//echo $_GET["postid"]; die('=======');
$p = new _productposting;
$r = $p->read($_GET["postid"]);
// print_r($r);die('==========');
if ($r != false) {
$rw = mysqli_fetch_assoc($r);

$cancel = $rw['is_cancel'];
$refund = $rw['is_refund'];
$refundwithin = $rw['refund_within'];
} else {
//die('=');

$cancel = 0;
$refund = 0;
$refundwithin = 0;
}

//echo $cancel;die('jhhhhhhhhhh');
//	$cancel= $rw['is_cancel'];
//$refund= $rw['is_refund'];
//$refundwithin= $rw['refund_within'];
?>

<div class="row">
<div id="wrapper">
<div class="col-md-6">
<label for="yes_no_radio" data-toggle="tooltip"  data-original-title="customer can cancel after purchase">Can Cancel</label>
<p>
<input type="radio" name="yes_no" value="1" <?php if ($cancel == '1') {
echo 'checked';
}  ?>>Yes</input>&nbsp;&nbsp;


<input type="radio" name="yes_no" value="0" <?php if($cancel=='0'){ echo 'checked'; }  
?>>No</input>
</p>
</div>
</div>
<div id="wrapper1">
<div class="col-md-6">

<label for="yes_no_radio" data-toggle="tooltip"  data-original-title="customer can get a refund after cancellation">Can Refund</label>
<p>
<input type="radio" name="yes" onclick="so_input()" value="1" <?php if ($refund == '1') {
    echo 'checked';
}  ?>>Yes</input>&nbsp;&nbsp;


<input type="radio" name="yes" onclick="so_out()" value="0" <?php if($refund=='0'){ echo 'checked'; }  
?>>No</input>
<input type="text" name="refund" id="refund" placeholder="Refund Within" style="display:none; width:120px;" value="<?php if ($refundwithin) {
                                                        echo $refundwithin;
                                                    }  ?>">

</p>
</div>
</div>
</div>
</div>





</div>

<!-- <div class="retail"> -->

<!-- 	<div class="col-md-4">
<div class="form-group">
<label for="retailQuantity_" class="">Quantity <span>* <span class="lbl_6"></span></span></label>
<input type="text" class="form-control spPostField" data-filter="0" id="retailQuantity_" maxlength="5" name="retailQuantity_" value="<?php echo (empty($row["retailQuantity_"]) ? "" : $row["retailQuantity_"]); ?>">
</div>
</div>



<div class="col-md-4">
<div class="form-group">
<label for="retailStatus_">Status <span>*</span></label>
<select class="form-control spPostField" data-filter="1" id="retailStatus_" name="retailStatus_" value="<?php echo (empty($row["retailStatus_"]) ? "" : $row["retailStatus_"]); ?>">

<?php
$it = new _spAllStoreForm;
$result3 = $it->readProductStatus();
if ($result3) {
while ($row3 = mysqli_fetch_assoc($result3)) {
echo "<option value='" . $row3["productStatusTitle"] . "'>" . $row3["productStatusTitle"] . "</option>";
}
}
?>
</select>
</div>
</div> -->


<!-- 	</div> -->

<script>
$(document).ready(function() {

$('#retailQuantity_').keypress(function() {
//alert("djsfdsj");
$('.lbl_6').remove();

});



$('#retailPrice').keypress(function() {
//alert("djsfdsj");
$('.lbl_50').remove();

});

    $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip();
    });

/*$('.select2-search__field').keypress(function(){ 
alert("djsfdsj");
$('.lbl_20').remove();

});*/

});
</script>

<script type="text/javascript">
$(".quantity").click(function() {
var radioValue = $("input[name='quantitytype']:checked").val();
if (radioValue) {

$("#quantity").val(radioValue);
//alert("Your are a - " + radioValue);
}
});
</script>