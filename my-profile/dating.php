<?php
/*error_reporting(E_ALL);
ini_set('display_errors', '1');*/

session_start();
function sp_autoloader($class){
include '../mlayer/' . $class . '.class.php';
}
spl_autoload_register("sp_autoloader");

$fm = new _spfamily_profile;
$profObj = new _spprofiles;

if(isset($_POST['pid'])){
$storename = "";
$result  = $profObj->read($_POST["pid"]);
if($result != false)
{
$row = mysqli_fetch_assoc($result);
//print_r($row);
// $name = $row["spProfileName"];
// $email = $row["spProfileEmail"];
// $phone = $row["spProfileCntryCode"].$row["spProfilePhone"];
// $usercountry = $row["spProfilesCountry"];
// $userstate = $row['spProfilesState'];
// $usercity = $row["spProfilesCity"];
// $dob = $row['spProfilesDob'];
// $about = $row["spProfileAbout"];
// $picture = $row["spProfilePic"];
// $location = $row["spprofilesLocation"];
// $language = $row["spprofilesLanguage"];
// $address = $row["spprofilesAddress"];
// $postalCode = $row['spProfilePostalCode'];
// $relationship_status = $row['relationship_status'];
// $phone_status = $row['phone_status'];
// $email_status = $row['email_status'];
// $address_city = $row["address"];
$spProfile_storename = $row["store_name"];
$spProfileAbout=$row["spProfileAbout"];
}

$res = $fm->read($_POST["pid"]);
//echo $pf->ta->sql;
if($res != false){

$spprofileid  = "";

$Interested  = "";
$Idealrelationship = "";
$Career 	= "";
$spProfileAbout="";

while($result = mysqli_fetch_assoc($res)){
//print_r($result); 
$choice=$result['choice'];
$location=$result['location'];
$age_group=$result['age_group'];

$ids=$result['spprofiles_idspProfiles'];

$fam_name=$result['family_name'];
$memberrelation=$result['memberrelation'];

if ($spprofileid == '') {
$spprofileid = $result['spprofiles_idspProfiles'];
}
if ($Interested == '') {
$Interested = $result['interested']; 
}
if ($Idealrelationship == '') {
$Idealrelationship = $result['idealrelationship']; 
}
if ($Career == '') {
$Career = $result['carrer']; 
}
if ($spProfileAbout == '') {
$spProfileAbout = $result['spProfileAbout']; 
}

}
}

if (isset($spProfile_storename) && !is_null($spProfile_storename) && !empty($spProfile_storename)) 
{
$storename = $spProfile_storename; 
}
}

$family_add = $fm->read_famly($ids);


?>
<style>
.col-md-4 {
padding-left: 22px;
padding-right: 22px;
}
.db_bluebtn {
background: #7649b3!important;
}
</style>



<div class="row">

<div class="col-md-12 tickets-section" id="paidevent" style=" background: beige; padding: 10px; border-radius: 18px;">
<div class="col-md-4">
<!-- Button trigger modal -->
<button type="button" class="btn btn-primary btn-border-radius" data-toggle="modal" data-target="#exampleModalTicket" style="    background-color: #c11f50 !important;font-weight: 600;"> 
<?php
if (isset($_GET['postid'])) {
echo 'Update Family';
} else {
//die('===');
echo 'Add/Edit Family';
}
//print_r($_SESSION);die;  
?>
</button>
<br>
<!-- Modal -->
<div class="modal fade" id="exampleModalTicket" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog modal-lg" role="document">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title text-danger" id="exampleModalLabel"><b>
<?php
if (isset($_GET['postid'])) {
echo 'Update Family';
} else {
echo 'Add Family';
}

?>
</b>
</h5>
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<div class="modal-body">
<div class="container">
<?php
$splinkp = new _spevent;
$prictype = new _spevent_type_price;
$allTicket_Type = array();
$allPrice = array();
$allCapacity = array();
if (isset($_GET['postid']) && $_GET['postid'] > 0) {
$fieldName = "spPostingCohost_";
$result7 = $splinkp->read($_GET['postid']);
//  echo $splinkp->ta->sql."<br>";  die('-------------------------');
if ($result7 != false) {
while ($row7 = mysqli_fetch_assoc($result7)) {
if ($row7['Ticket_Type'] != '') {
$allTicket_Type = explode(",", $row7['Ticket_Type']);
}
if ($row7['Price'] != '') {
$allPrice = explode(",", $row7['Price']);
}
if ($row7['Capacity'] != '') {
$allCapacity = explode(",", $row7['Capacity']);
}

if ($row7['taxrate'] != '') {
$taxrate = $row7['taxrate'];
}
if ($row7['totaleventCapacity'] != '') {
$totaleventCapacity = $row7['totaleventCapacity'];
}
if ($row7['notax'] != '') {
$notax = $row7['notax'];
}
}
}
}






$count = count($allTicket_Type);
$count = $count - 1;

$resultdata = $prictype->read($_GET['postid']);

if ($resultdata != false) {
while ($pricedata = mysqli_fetch_assoc($resultdata)) {

//for($i=0; $i<=$count; $i++){
//echo $allTicket_Type[$i].'<br>';
?>
<div id="inputFormRow"> 
<div class="row ">
<div class="col-md-3">
<div class="form-group">
<!-- <label for="Ticket_Type">Family Name </label>
<input type="text" class="form-control Ticket_Type" name="Ticket_Type[]" id="Ticket_Type<?php //echo $pricedata['typeid']; ?>" value="<?php// echo $pricedata['event_type']; ?>" /> -->
<!--<input type="hidden" class="form-control Ticket_Typenew" name="typeid_new[]" id="Ticket_Typenew" value="<?php echo $pricedata['typeid']; ?>" />-->
<input type="hidden" class="form-control Ticket_Typenew" id="Ticket_Typenew" value="<?php echo $pricedata['event_type'] . "||" . $pricedata['typeid']; ?>" />
</div>
</div>
<div class="col-md-3">
<div class="form-group">
<label for="Capacity">Relation Type </label>
<!--<input type="text" class="form-control Capacity" name="Capacity[]" id="Capacity<?php echo $pricedata['typeid']; ?>" value="<?php echo $pricedata['event_limit']; ?>" required />-->

<select name="Capacity[]" id="memberrelation" id="Capacity" class="form-control Capacity">
<option value="">Choose relationship:</option>
<option value="Mother">Mother</option>
<option value="Father">Father</option>
<option value="Daughter">Daughter</option>
<option value="Son">Son</option>
<option value="Sister">Sister</option>
<option value="Brother">Brother</option>
<option value="Auntie">Auntie</option>
<option value="Uncle">Uncle</option>
<option value="Niece">Niece</option>
<option value="Nephew">Nephew</option>
<option value="Cousin">Cousin</option>
<option value="Grandmother">Grandmother</option>
<option value="Grandfather">Grandfather</option>
<option value="Granddaughter">Granddaughter</option>
<option value="Grandson">Grandson</option>
<option value="Stepsister">Stepsister</option>
<option value="Stepbrother">Stepbrother</option>
<option value="Stepmother">Stepmother</option>
<option value="Stepfather">Stepfather</option>
<option value="Stepdaughter">Stepdaughter</option>
<option value="Stepson">Stepson</option>
<option value="Sister-in-law">Sister-in-law</option>
<option value="Brother-in-law">Brother-in-law</option>
<option value="Mother-in-law">Mother-in-law</option>
<option value="Father-in-law">Father-in-law</option>
<option value="Daughter-in-law">Daughter-in-law</option>
<option value="Son-in-law">Son-in-law</option>
</select>


<input type="hidden" class="form-control Capacitynew" id="Capacitynew" value="<?php echo $pricedata['event_limit'] . "||" . $pricedata['typeid']; ?>" required />
</div>
</div>
</div>
<div class="input-group-append">
<button id="removeRow" type="button" class="btn btn-danger btn-border-radius">Remove</button>
</div>
</div>
<?php }
}







$fm = new _spfamily_profile;
$family1 = $fm->read_famly($ids);

if ($family1 != false) {
while ($result_1 = mysqli_fetch_assoc($family1)) {



?>
<div id="family_row_rofile"  class="row">
<div class="row" id="rowid<?php echo $result_1['id']; ?>">
<div class="col-md-3">
<div class="form-group">
<?php
$r = new _spprofilehasprofile;

$res = $r->readallfriend($_POST['pid']); //As a sender


//echo $r->ta->sql;
if ($res != false) {


//get friend store
?>
<label  for="Ticket_Type">Family Name </label>
<select name="Ticket_Typeadd[]"  id="Ticket_Typeadd" class="form-control Ticket_Typeadd">
<?php while ($rows = mysqli_fetch_assoc($res)) {


$p = new _spprofiles;
$result = $p->read($rows["spProfiles_idspProfilesReceiver"]);
if ($result != false) {
$receive = $rows["spProfiles_idspProfilesReceiver"];

$row = mysqli_fetch_assoc($result);
$totalFrnd2 = $r->countTotalFrnd($row['idspProfiles']); 
$str2 = substr($result_1['family_name'], 5); 

?>

<option value="<?php echo $row["idspProfiles"];?>,<?php echo $row["spProfileName"];?>" <?php if ($str2 == $row["spProfileName"]) {echo "selected";} ?>><?php echo $row["spProfileName"]; ?></option>
<?php } }?>
</select>

<?php


}
?>

<input type="hidden" class="form-control "  name="family_id" id="family_id" placeholder="" value="<?php echo $result_1['family_id']; ?>">
</div>
</div>
<div class="col-md-3">
<div class="form-group">
<label for="Capacity">Relation Type </label>

<select aaaaaaaaa name="Capacity[]"  id="Capacity" class="form-control Capacity">
<option value="">Choose relationship:</option>
<option value="Mother" <?php if ($result_1['family_relation'] == "Mother") {echo "selected";} ?>>Mother</option>
<option value="Father" <?php if ($result_1['family_relation'] == "Father") {echo "selected";} ?>>Father</option>
<option value="Daughter" <?php if ($result_1['family_relation'] == "Daughter") {echo "selected";} ?>>Daughter</option>
<option value="Son" <?php if ($result_1['family_relation'] == "Son") {echo "selected";} ?>>Son</option>
<option value="Sister" <?php if ($result_1['family_relation'] == "Sister") {echo "selected";} ?>>Sister</option>
<option value="Brother" <?php if ($result_1['family_relation'] == "Brother") {echo "selected";} ?>>Brother</option>
<option value="Auntie" <?php if ($result_1['family_relation'] == "Auntie") {echo "selected";} ?>>Auntie</option>
<option value="Uncle" <?php if ($result_1['family_relation'] == "Uncle") {echo "selected";} ?>>Uncle</option>
<option value="Niece" <?php if ($result_1['family_relation'] == "Niece") {echo "selected";} ?>>Niece</option>
<option value="Nephew" <?php if ($result_1['family_relation'] == "Nephew") {echo "selected";} ?>>Nephew</option>
<option value="Cousin" <?php if ($result_1['family_relation'] == "Cousin") {echo "selected";} ?>>Cousin</option>
<option value="Grandmother" <?php  if ($result_1['family_relation'] == "Grandmother") {echo "selected";} ?>>Grandmother</option>
<option value="Grandfather" <?php if ($result_1['family_relation'] == "Grandfather") {echo "selected";} ?>>Grandfather</option>
<option value="Granddaughter" <?php  if ($result_1['family_relation'] == "Granddaughter") {echo "selected";} ?>>Granddaughter</option>
<option value="Grandson" <?php if ($result_1['family_relation'] == "Grandson") {echo "selected";} ?>>Grandson</option>
<option value="Stepsister" <?php if ($result_1['family_relation'] == "Stepsister") {echo "selected";} ?>>Stepsister</option>
<option value="Stepbrother" <?php if ($result_1['family_relation'] == "Stepbrother") {echo "selected";} ?>>Stepbrother</option>
<option value="Stepmother" <?php if ($result_1['family_relation'] == "Stepmother") {echo "selected";} ?>>Stepmother</option>
<option value="Stepfather" <?php if ($result_1['family_relation'] == "Stepfather") {echo "selected";} ?>>Stepfather</option>
<option value="Stepdaughter" <?php if ($result_1['family_relation'] == "Stepdaughter") {echo "selected";} ?>>Stepdaughter</option>
<option value="Stepson" <?php if ($result_1['family_relation'] == "Stepson") {echo "selected";} ?>>Stepson</option>
<option value="Sister-in-law" <?php if ($result_1['family_relation'] == "Sister-in-law") {echo "selected";} ?>>Sister-in-law</option>
<option value="Brother-in-law" <?php if ($result_1['family_relation'] == "Brother-in-law") {echo "selected";} ?>>Brother-in-law</option>
<option value="Mother-in-law" <?php if ($result_1['family_relation'] == "Mother-in-law") {echo "selected";} ?>>Mother-in-law</option>
<option value="Father-in-law" <?php if ($result_1['family_relation'] == "Father-in-law") {echo "selected";} ?>>Father-in-law</option>
<option value="Daughter-in-law" <?php if ($result_1['family_relation'] == "Daughter-in-law") {echo "selected";} ?>>Daughter-in-law</option>
<option value="Son-in-law" <?php if ($result_1['family_relation'] == "Son-in-law") {echo "selected";} ?>>Son-in-law</option>
</select>
</div>
</div>

<div  class="col-md-3">
<br>
<a class="btn btn-danger btn-border-radius" onclick="remove_family(<?php echo $result_1['id']; ?>)"> Remove </a>
</div>


</div>
</div>
<?php  } } 

else { ?>

<div id="family_row_rofile"  class="row">
<div class="row">

<div class="col-md-3">
<div class="form-group">

<?php
$r = new _spprofilehasprofile;

$res = $r->readallfriend($_POST['pid']); //As a sender


//echo $r->ta->sql;
if ($res != false) {


//get friend store
?>
<label tttttttttttttt for="Ticket_Type">Family Name </label>
<select name="Ticket_Typeadd[]"  id="Ticket_Typeadd" class="form-control Ticket_Typeadd">

<option value="">Select Name</option>
<?php while ($rows = mysqli_fetch_assoc($res)) {

$b = array();
$p = new _spprofiles;
$result = $p->read($rows["spProfiles_idspProfilesReceiver"]);
if ($result != false) {
$receive = $rows["spProfiles_idspProfilesReceiver"];

$row = mysqli_fetch_assoc($result);
$totalFrnd2 = $r->countTotalFrnd($row['idspProfiles']); ?>

<option value="<?php echo $row["idspProfiles"];?>,<?php echo $row["spProfileName"];?>"><?php echo $row["spProfileName"]; ?></option>
<?php } }?>
</select>

<?php


}

else { ?>

<label jjjjjjjjjjjjj for="Ticket_Type">Family Name </label>
<select name="Ticket_Typeadd[]"  id="Ticket_Typeadd" class="form-control Ticket_Typeadd">
<option value=",">select </option>
<option value="cgbcv">cgbcv</option>
<option value="rsad">gfgfc</option>
<option value="fgfdgf">cgffgg</option>

<option value="<?php echo $row["idspProfiles"]; ?>,<?php echo $row["spProfileName"]; ?>"><?php echo $row["spProfileName"]; ?></option>
</select>


<?php  } ?>
</div>
</div>
<div class="col-md-3">
<div class="form-group">
<label for="Capacity">Relation Type </label>

<select name="Capacity[]"  id="Capacity" class="form-control Capacity">
<option value="">Choose relationship:</option>
<option value="Mother">Mother</option>
<option value="Father">Father</option>
<option value="Daughter">Daughter</option>
<option value="Son">Son</option>
<option value="Sister">Sister</option>
<option value="Brother">Brother</option>
<option value="Auntie">Auntie</option>
<option value="Uncle">Uncle</option>
<option value="Niece">Niece</option>
<option value="Nephew">Nephew</option>
<option value="Cousin">Cousin</option>
<option value="Grandmother">Grandmother</option>
<option value="Grandfather">Grandfather</option>
<option value="Granddaughter">Granddaughter</option>
<option value="Grandson">Grandson</option>
<option value="Stepsister">Stepsister</option>
<option value="Stepbrother">Stepbrother</option>
<option value="Stepmother">Stepmother</option>
<option value="Stepfather">Stepfather</option>
<option value="Stepdaughter">Stepdaughter</option>
<option value="Stepson">Stepson</option>
<option value="Sister-in-law">Sister-in-law</option>
<option value="Brother-in-law">Brother-in-law</option>
<option value="Mother-in-law">Mother-in-law</option>
<option value="Father-in-law">Father-in-law</option>
<option value="Daughter-in-law">Daughter-in-law</option>
<option value="Son-in-law">Son-in-law</option>
</select>
</div>
</div>
</div>

</div>



<?php }



?>
<script>
function remove_family(id){

$('#rowid'+id).html('');
}


function numericFilter(txb) {
txb.value = txb.value.replace(/[^\0-9]/ig, "");
}
</script>
<div id="newRow"></div>
<?php
$r = new _spprofilehasprofile;

$res = $r->readallfriend($_SESSION["pid"]); 

if($res != false){?>
<button id="addRow" type="button" class="btn btn-info btn-border-radius" style="    background-color: #c11f50 !important;font-weight: 600;">Add More</button>
<?php } ?>

</div>
</div>
<div class="modal-footer">
<button type="button" class="btn btn-danger btn-border-radius" data-dismiss="modal" aria-label="Close">Cancel</button>
<button id="saveclosebutton" type="button" class="btn btn-success btn-border-radius" style="" data-dismiss="modal" aria-label="Close">Save</button>
</div>
</div>
</div>
</div>
<script type="text/javascript">
setTimeout(function() {
checkArraycheckboxPrice();
checkArraycheckboxTicket_Type();
checkArraycheckboxCapacity();

}, 1000);

function checkArraycheckboxTicket_Type() {

$checkboxTicket_Type = $('.Ticket_Typenew');
var chkArray = [];
chkArray = $.map($checkboxTicket_Type, function(el) {
return el.value;
});
$.each(chkArray, function(key, value) {
var html = '';

var ArrId = value.split("||");
var vall = ArrId[0];
var keyval = ArrId[1];

var value1 = $("#Ticket_Type" + keyval).val();
var value=value1.slice(5);
//alert(value);


if(value!="")
{
html += '<p><input type="hidden" name="Ticket_Type[' + keyval + ']" class="classnameticket" value="' + value + '">' + value + '</p>';
$('#forTicket_Type').append(html);
}

});






$checkboxTicket_Type1 = $('.Ticket_Typeadd');
var chkArray1 = [];
chkArray1 = $.map($checkboxTicket_Type1, function(el) {
return el.value;
});

$.each(chkArray1, function(key, value) {
//alert(value);
//var value1=value.slice(5);
var value1=value;
//alert(value1);
if(value1!="")
{
var html = '';
html += '<p><input type="hidden" id="ticket_type_id" name="Ticket_Type_add[' + key + ']" class="classnameticket" value="' + value + '">' + value1+ '</p>';
$('#forTicket_Type1').append(html);
}
});






$checkboxTicket_Type2 = $('.Capacity');
var chkArray1 = [];
chkArray1 = $.map($checkboxTicket_Type2, function(el) {
return el.value;
});
$.each(chkArray1, function(key, value) {



if(value!="")
{	
var html = '';
html += '<p style="margin-left: 42px;"><input type="hidden" id="Capacity_add_id" name="Capacity_add[' + key + ']" class="classnameticket" value="' + value + '">' + value + '</p>';
$('#forCapacity1').append(html);
}

});









}

function checkArraycheckboxCapacity() {
$checkboxCapacity = $('.Capacitynew');
var chkArray = [];
chkArray = $.map($checkboxCapacity, function(el) {
return el.value;
});
$.each(chkArray, function(key, value) {

var ArrId = value.split("||");
var vall = ArrId[0];
var keyval = ArrId[1];
var value = $("#Capacity" + keyval).val();
if(value!="")
{
var html = '';
html += '<p><input type="hidden" name="Capacity[' + keyval + ']" class="classnamecapacity" value="' + value + '">' + value + '</p>';
$('#forCapacity').append(html);
}
});

$checkboxTicket_Type1 = $('.Capacityadd');
var chkArray1 = [];
chkArray1 = $.map($checkboxTicket_Type1, function(el) {
return el.value;
});
$.each(chkArray1, function(key, value) {
if(value!="")
{
var html = '';
html += '<p style="margin-left: 42px;"><input type="hidden" id="Capacity_add_id" name="Capacity_add[' + key + ']" class="classnameticket" value="' + value + '">' + value + '</p>';
$('#forCapacity1').append(html);
}
});

}

function checkArraycheckboxPrice() {
$checkboxPrice = $('.Pricenew');
var chkArray = [];
chkArray = $.map($checkboxPrice, function(el) {
return el.value;
});
$.each(chkArray, function(key, value) {
if (value != '') {

var ArrId = value.split("||");
var vall = ArrId[0];
var keyval = ArrId[1];
var value = $("#Price" + keyval).val();
if(value!="")
{
var html = '';
html += '<p><input type="hidden" name="Price[' + keyval + ']" class="classnameprice" value="' + value + '"><?php echo $currency;?> ' + value + '</p>';
$('#forTicket_Price').append(html);
}
}
});

$checkboxTicket_Type1 = $('.Priceadd');
var chkArray1 = [];
chkArray1 = $.map($checkboxTicket_Type1, function(el) {
return el.value;
});
$.each(chkArray1, function(key, value) { 
if(value!="")
{
var html = '';
html += '<p><input type="hidden" id="Price_add_id" name="Price_add[' + key + ']" class="classnameticket" value="' + value + '"><?php echo $currency;?> ' + value + '</p>';
$('#forTicket_Price1').append(html);
}
});
}

$("#addRow").click(function() {
var html = '';
html += '<div id="inputFormRow">';
html += '<div class="row"> <div class="col-md-3"> <div class="form-group"> <label for="Ticket_Type">Ticket Type</label> <input type="text" class="form-control Ticket_Typeadd" id="Ticket_Typeadd" name="Ticket_Typeadd[]" placeholder=""  /> </div> </div> <div class="col-md-3"> <div class="form-group"> <label for="Capacity">Relation Type</label> <select name="Capacity[]" id="Capacity" class="form-control Capacity"><option value="">Choose relationship:</option><option value="Mother">Mother</option><option value="Father">Father</option><option value="Daughter">Daughter</option><option value="Son">Son</option><option value="Sister">Sister</option><option value="Brother">Brother</option><option value="Auntie">Auntie</option><option value="Uncle">Uncle</option><option value="Niece">Niece</option><option value="Nephew">Nephew</option><option value="Cousin">Cousin</option><option value="Grandmother">Grandmother</option><option value="Grandfather">Grandfather</option><option value="Granddaughter">Granddaughter</option><option value="Grandson">Grandson</option><option value="Stepsister">Stepsister</option><option value="Stepbrother">Stepbrother</option><option value="Stepmother">Stepmother</option><option value="Stepfather">Stepfather</option><option value="Stepdaughter">Stepdaughter</option><option value="Stepson">Stepson</option><option value="Sister-in-law">Sister-in-law</option><option value="Brother-in-law">Brother-in-law</option><option value="Mother-in-law">Mother-in-law</option><option value="Father-in-law">Father-in-law</option><option value="Daughter-in-law">Daughter-in-law</option><option value="Son-in-law">Son-in-law</option></select></div> </div> </div>';
html += '<div class="input-group-append">';
html += '<button id="removeRow" type="button" class="btn btn-danger">Remove</button>';
html += '</div>';
html += '</div>';
//$('#newRow').append(html); newRow

$('#newRow').append($('#family_row_rofile').html());




});
$(document).on('click', '#removeRow', function() {
$(this).closest('#inputFormRow').remove();
});


setTimeout(function() {
notaxchecked();
}, 1000);
$checkboxnotax = $('#notax');

function notaxchecked() {
var chkArray = [];
chkArray = $.map($checkboxnotax, function(el) {
if (el.checked) {
$("#taxrate").prop('disabled', true);
$('#taxrate').val("0");
$("#totaleventCapacity").prop('disabled', true);
$('#totaleventCapacity').val("0");
};
});
}
$("#saveclosebutton").click(function() {

var familydata = 	$('#Ticket_Typeadd').val();
var relationdata =  $('#Capacity').val();







// console.log(familydata);
// console.log(relationdata);

document.getElementById("forTicket_Type").innerHTML = "";
document.getElementById("forCapacity").innerHTML = "";
//document.getElementById("forTicket_Price").innerHTML = "";
document.getElementById("forTicket_Type1").innerHTML = "";
document.getElementById("forCapacity1").innerHTML = "";
//document.getElementById("forTicket_Price1").innerHTML = "";

checkArraycheckboxPrice();
if(familydata != ',' && relationdata!='')
{
checkArraycheckboxTicket_Type();
}
else{
alert("plz fiil the required");
}
checkArraycheckboxCapacity();

});
</script>
<br>
</div>
<?php //echo $spStartDate;die('======='); ?>
<div class="col-md-8">
<div class="row">
<div class="col-md-4">
<label>Family Name</label>
<div id="forTicket_Type">
</div>
<div id="forTicket_Type1">
</div>
</div>
<div class="col-md-4">
<label>Relation Type</label>
<div id="forCapacity" style="margin-left: 42px;">
</div>
<div id="forCapacity1" >
</div>
</div>

</div>
</div>
</div>
</div>

<input type="hidden" class="control-label" id="spprofiles_idspProfiles" name="spprofiles_idspProfiles" value="<?php echo (isset($spprofileid))?$spprofileid: ''; ?>">
<div class="row">

<div class="col-md-4">
<div class="form-group">
<!-- <label for="agegroup_" class="control-label">Age Group<span class="red">* <span class="lbl_8"></span></span></label>
<input type="text" class="form-control profilefield" onkeypress="return onlyNumberKey(event)" id="agegroup_" name="agegroup_"value="<?php //echo (empty($age_group) ? "" : $age_group);?>"> -->
<span id="error_age" style="color:red;"></span>			
</div>
</div>
</div>

<div class="row">
<div class="after-add-more">
<div class="col-md-5">
<div class="form-group">
<!-- <label for="fname" class="control-label">Family Name<span class="red">* <span class="lbl_8"></span></span></label>
<input type="text" class="form-control profilefield" id="fname" name="fname[]"value="<?php echo (empty($fam_name) ? "" : $fam_name);?>"> -->

</div>
</div>

<!-- 
<div class="col-md-5">
<div class="form-group">
<label for="family" class="control-label">Add Family Members</label>
<select name="memberrelation[]" id="memberrelation" class="form-control memberrelation">
<option value="">Choose relationship:</option>
<option value="Mother">Mother</option>
<option value="Father">Father</option>
<option value="Daughter">Daughter</option>
<option value="Son">Son</option>
<option value="Sister">Sister</option>
<option value="Brother">Brother</option>
<option value="Auntie">Auntie</option>
<option value="Uncle">Uncle</option>
<option value="Niece">Niece</option>
<option value="Nephew">Nephew</option>
<option value="Cousin">Cousin</option>
<option value="Grandmother">Grandmother</option>
<option value="Grandfather">Grandfather</option>
<option value="Granddaughter">Granddaughter</option>
<option value="Grandson">Grandson</option>
<option value="Stepsister">Stepsister</option>
<option value="Stepbrother">Stepbrother</option>
<option value="Stepmother">Stepmother</option>
<option value="Stepfather">Stepfather</option>
<option value="Stepdaughter">Stepdaughter</option>
<option value="Stepson">Stepson</option>
<option value="Sister-in-law">Sister-in-law</option>
<option value="Brother-in-law">Brother-in-law</option>
<option value="Mother-in-law">Mother-in-law</option>
<option value="Father-in-law">Father-in-law</option>
<option value="Daughter-in-law">Daughter-in-law</option>
<option value="Son-in-law">Son-in-law</option>
</select>
<span id="error_age" style="color:red;"></span>			
</div>
</div> -->
</div>






<!--<div class="col-md-4">
<div class="form-group">
<label for="interested_" class="control-label">Interested In<span class="red">* <span class="error lbl_9"></span></span></label>
<input type="text" class="form-control profilefield" id="interested_" name="interested"  value="<?php echo (isset($Interested))?$Interested: ''; ?>"> 
<span id="error_interest" style="color:red;"></span>			

</div>
</div>

<div class="col-md-4">
<div class="form-group">
<label for="idealrelationship_" class="control-label">Ideal relationship<span class="red">* <span class="error lbl_10"></span></span></label>
<input type="text" class="form-control profilefield" id="idealrelationship_" name="idealrelationship" value="<?php echo (isset($Idealrelationship))?$Idealrelationship: ''; ?>"> 
<span id="error_ideal" style="color:red;"></span>			

</div>
</div> -->

</div>
<div class="row" style="margin-top: 5px;">
<div class="col-md-12">
<div class="form-group">
<label for="choice_" class="control-label">My Interest<span class="red">* </span></label>
<input type="text" class="form-control profilefield" id="choice_" name="choice_" value="<?php echo (empty($choice) ? "" : $choice);?>" required> 
<span id="error_choice" style="color:red;"></span>
</div>
</div> 
<div class="col-md-12">
<div class="form-group">
<label for="carrer_" class="control-label">Career In</label>
<input type="text" class="form-control profilefield" id="carrer_" name="carrer" value="<?php echo (isset($Career))?$Career: ''; ?>">  
</div>
</div>

<div class="col-md-12">
<div class="form-group"> 
<label for="storeName" class="control-label">Store Name</label>
<input type="text" class="form-control  " id="1<?php echo (isset($storename)? "":"");?>" name="spDynamicWholesell" value="<?php if(isset($storename)){ echo $storename;}?>"  > 
<!-- <span id="error_store" style="color:red;"></span>
--></div>
<p class="hidden" id="checkstore">This storename is taken. Try another.</p>
</div>
</div>
<!--<div class="col-md-4">
<div class="form-group">
<label for="location_" class="control-label">Location<span class="red">* <span class="lbl_13"></span></span></label>
<input type="text" class="form-control profilefield" id="location_" name="location_"value="<?php echo (empty($location) ? "" : $location);?>"> 
<span id="error_location" style="color:red;"></span>
</div>
</div> 
div class="col-md-4">
<div class="form-group">
<label for="Myself" class="control-label">About Myself<span class="red">* <span class="lbl_13"></span></span></label>
<input type="text" class="form-control profilefield" id="Myself" name="Myself"value="<?php echo (isset($spProfileAbout))?$spProfileAbout: '';?>"> 
<span id="error_about" style="color:red;"></span>
</div>
</div> -->
</div>





<script type="text/javascript">
$(document).ready(function() {
$("body").on("click", ".add-more", function() {
var html = $(".after-add-more").first().clone();
$(html).find(".change").html("<label for=''>&nbsp;</label><br/><a class='btn btn-danger remove'>- Remove</a>");


$(".after-add-more").last().after(html);
$(".after-add-more").last().find('.membername').val('');





});

$("body").on("click", ".remove", function() {
$(this).parents(".after-add-more").remove();
});
});

</script>
<script>
$(document).ready(function () {
$("#idupdate").on("click",function(){
var agegroup=$("#agegroup_").val(); 
var interested=$("#interested_").val(); 
var idealrelationship=$("#idealrelationship_").val(); 
var choice=$("#choice_").val(); 
var carrer=$("#carrer_").val(); 
var storename_=$(".storename_").val(); 
var location=$("#location_").val(); 
var Myself=$("#Myself").val(); 
//alert(storename_);
if((choice=="")||(carrer=="")||(location=="")||(Myself=="")||(agegroup=="")||(interested=="")||(idealrelationship=="")){


if(agegroup==""){
$("#error_age").html('This field is required');
}
else{
$("#error_age").html('');

}
if(interested==""){
$("#error_interest").html('This field is required');
}
else{
$("#error_interest").html('');

}
if(idealrelationship==""){
$("#error_ideal").html('This field is required');
}
else{
$("#error_ideal").html('');

}




if(choice==""){
$("#error_choice").html('This field is required11');
}
else{
$("#error_choice").html('');

}
if(carrer==""){
$("#error_career").html('This field is required');
}
else{
$("#error_career").html('');

}
/*
if(storename_==""){
$("#error_store").html('This field is required');
}
else{
$("#error_store").html('');

}*/


if(location==""){
$("#error_location").html('This field is required');
}
else{
$("#error_location").html('');

}
if(Myself==""){
$("#error_about").html('This field is required');
}else{
$("#error_about").html('');

}
return false;
}
});
});




$("#addfamily").click(function(e) {
//alert('========');
/* var name = $('input[name="membername[]"]').map(function(){ 
var name= this.value; 
}).get();

console.log(name);


*/

var n = $("input[name^='membername[]']").length;

/*var array = $("input[name^='membername[]']");


for(i=0;i<n;i++)
{
//card_value=  array[i].val();
name=  array.eq(i).val(); //gets jquery object at index i

//alert(card_value);
var name_err = 0;
if(name==""){
var name_err=1;
}
}*/

//alert(name);
var family_status = true;
var name = $('input[name="membername[]"]').map(function() {
if (this.value) {
return this.value;
} else {
family_status = false;
return this.value;

}

}).get();
if (family_status == false) {
alert("Please fill name field.");
return false;
}

var name_err = 0;
if (name == "") {
var name_err = 1;
}

var mem_err = 0;

var m = $('select[name="memberrelation[]"] option:selected').each(function() {
var mem_name = ($(this).val());
//alert(m);
/*if (mem_name == "") {
alert("Please fill relation field.");
return false;
e.preventDefault();
var mem_err = 1;
}*/
});




/*
var mem_err = 0;

var m = $("select[name^='memberrelation[]']").length;
//	 alert(m);
//var array1 = $("input[name^='memberrelation[]']");
for(i=0;i<m;i++)
{
//card_value=  array[i].val();
var mem_name = ($(this).val()); //gets jquery object at index i
if(mem_name==""){
alert("Please fill relation field.");
return false;
e.preventDefault();
var mem_err=1;
}

}
*/


var relation_status = true;
var relation = $('select[name="memberrelation[]"]').map(function() {
if (this.value) {
return this.value;
} else {
relation_status = false;
return this.value;
}
}).get();

if (relation_status == false) {
alert("Please fill relation field.")
return false;
}



var spProfileId = $("#spProfileId").val();
var spuserId = $("#spuserId").val();
var memberprofileid = $("#memberprofileid").val();
//alert(memberprofileid);
var id = $("#valid").val();
///alert(memberprofileid);



var flag = 0;

if (name != "") {
var strArr = new Array();
//strArr = name.split("");

//if(strArr[0]==" ") // this is the the key part. you can do whatever you want here!
//{
//flag=1;
//	}


}



if (name_err == 1) {
alert("Please fill Name field.");
return false;
} else {
//alert("1");
$.ajax({
url: "addfamily.php",
type: "POST",
data: 'id=' + id + '&membername=' + name + '&memberrelation=' + relation + '&spProfileId=' + spProfileId + '&spuserId=' + spuserId + '&memberprofileid=' + memberprofileid,
success: function(vi) {


swal({

title: "Family Member Added Successfully!",
type: 'success',
showConfirmButton: true

},
function() {
//alert(vi);
$("#newfamily").append(vi);
//	$("#newfamily").append("<tr><td>"+id+"</td><td>"+name+"</td><td>"+relation+"</td><td><a href='#' id='del_fam' onclick='delfam("+vi+");'><i class='fa fa-trash' aria-hidden='true' ></i></a>&nbsp;<a href='#'  data-toggle='modal' data-target='#editfamilymember"+vi+"'><i class='fa fa-pencil' aria-hidden='true'></i></a></td></tr>");

document.getElementById("btn-close").click();
document.getElementById("membername").value = "";
document.getElementById("memberrelation").value = "";
});

//window.location.reload();
//alert(vi);
//$('#update_gallery').html(vi);
},
error: function(error) {

}
});
}



});

</script>
<script>
function onlyNumberKey(evt) {

// Only ASCII character in that range allowed
var ASCIICode = (evt.which) ? evt.which : evt.keyCode
if (ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57))
return false;
return true;
}
</script>