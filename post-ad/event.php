<div class="row">
<script>
function evadd(){
document.getElementById("evadd_err").innerText="";
}

</script> 
<style>
.addticketmodel label {
	width: 100% !IMPORTANT;
	background: #c8bfe7 !IMPORTANT;
	padding: 10px !IMPORTANT;	
	margin: 0 !IMPORTANT;
}
.addticketmodel .col-md-4 {
	padding: 0 !IMPORTANT;
}
p.addticketcss {
	margin: 0;
	padding: 10px;
}
.ticketss {
	border: 1px solid #c8bfe7;
}
.modelfield label {
	background: unset !IMPORTANT;
	padding: 0px !IMPORTANT;
}
</style>

<div class="col-md-6"> 
	<div class="form-group">
		<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAPpH4FGQaj_JIJOViHAeHGAjl7RDeW8OQ&libraries=places"></script>
		<label for="spPostingStartDate_" class="lbl_9">Event Address <span style="color:red;">*</span><span id="evadd_err" class="label_error"></span></label>
		<input type="text" class="form-control" onkeyup="evadd()" name="eventaddress" id="eventaddress"  value="<?php echo (isset($eeventaddress) && $eeventaddress != '') ? $eeventaddress : ''; ?>">
		<input type="hidden" class="form-control lat" name="lat" >
		<input type="hidden" class="form-control long" name="long" >

	</div>
</div>
<script>
	var input = document.getElementById('eventaddress');
	var autocomplete = new google.maps.places.Autocomplete(input);
	var autocomplete = new google.maps.places.Autocomplete($("#eventaddress")[0], {});
            google.maps.event.addListener(autocomplete, 'place_changed', function() {
                var place = autocomplete.getPlace();
                // document.querySelector(".lat").value=place.geometry.location.lat();
                $('.lat').val(place.geometry.location.lat());
                $('.long').val(place.geometry.location.lng());
            });
</script>
<div class="col-md-6">
<script>
function evveneu(){
	document.getElementById("lbl_6").innerText="";
}
</script>
<div class="form-group">
<label for="spPostingEventVenue_" class="lbl_6">Name Of Place <span style="color:red;">*</span> <span id="lbl_6" class="label_error"></span></label>
<input type="text" class="form-control spPostField" data-filter="0" onkeyup="evveneu()" id="spPostingEventVenue_" name="spPostingEventVenue" value="<?php echo (empty($venu) ? "" : $venu); ?>" autocomplete="off" >
<!-- <input id="geocomplete" class="form-control" type="text" placeholder="Type in an address" size="90" /> -->
</div>
</div>
</div>
<div class="row">
<div class="col-md-3">
<div class="form-group">
<label for="spPostingStartDate_" class="lbl_29">Event Type <span style="color:red;">*</span><span id="type_err" class="label_error"></span></label>
<br><br>
<label class="radio-inline">
<?php  
// echo $eventpaymenttype;
// die('=========');

?>
<!--<input  type="radio" id="eventtype" name="event_payment_type" value="1" onclick="eventtyeCheck('1')" <?php
//if($eventpaymenttype == 1){ echo "checked"; } ?>>Free-->


<input  type="radio"  name="event_payment_type"  checked value="1" onclick="eventtyeChecks('1')" <?php
if($eventpaymenttype == 1){ echo "checked"; } ?> >Free
<!-- 1 for Art -->
</label>
<label class="radio-inline">
<!--  <input type="radio" id="eventtype2" name="event_payment_type" value="2" onclick="eventtyeCheck('2')" <?php //if($eventpaymenttype == 2){ echo "checked"; } ?>>Paid-->
<input type="radio"  id="paid_ticked_ch" name="event_payment_type" value="2" onclick="eventtyeChecks('2')" <?php if($eventpaymenttype == 2){ echo "checked"; } ?>>Paid
<!-- 2 for Craft -->
</label>
</div>
</div>



<div class="col-md-3">
<div class="form-group">
<label for="registration_req_" class="lbl_29_">Registration Needed</label>
<br><br>
<label class="radio-inline">
   
<input  type="radio" name="registration_req" value="1" <?php if($registration_req == 1){ echo "checked"; } ?>>Yes
</label>
<label class="radio-inline">
<input type="radio" id="radio4"  name="registration_req" value="0" <?php if($registration_req == 0){ echo "checked"; } ?>>No
</label>
</div>
</div>


<div class="col-md-6">
<div class="form-group" style="width:20%;">
<label for="spPostingEventVenue_" class="lbl_26">Event Capacity <span style="color:red;">*</span> <span id="event_cap" class="label_error"></span></label>  
<input type="text" class="form-control" maxlength="5" class="hallcapacity" id="hallcapacity" name="hallcapacity" value="<?php echo $hallcapacity; ?>"  onkeyup="numericFilter(this);" />
</div>
</div>
</div>


<script>
   
    // window.onload = function() {
    //     // Check if the radio button is already checked
    //     if (document.getElementById("paid_ticked_ch").checked) {
    //         // Trigger the onclick event handler and execute the associated function
    //         eventtyeCheck('2');
    //     } else {
    //         // Click the radio button to check it and trigger the onclick event handler
    //         document.getElementById("paid_ticked_ch").click();
    //     }
    // }
</script>
<script type="text/javascript">
	// model event type
function eventtyeChecks(eid) {
    if (eid==2) {
        document.getElementById('paidevents').style.display = 'block';
    } else {
        document.getElementById('paidevents').style.display = 'none';
        document.getElementById('paidevent').style.display = 'none';
        document.getElementById('ticketurl').style.display = 'none';
    }
}

// show hide model on ticket url
function addTicketUrl() {
    document.getElementById('ticketurl').style.display = 'block';
    document.getElementById('paidevent').style.display = 'none';
	if(eid==2) {
		document.getElementById('paidevents').style.display = 'block';
	}else{
		document.getElementById('paidevents').style.display = 'none';
		document.getElementById('paidevent').style.display = 'none';
		document.getElementById('ticketurl').style.display = 'none';
	}
}

// sell ticket model box
function eventtyeCheck(eid) {
	if(eid==2) {
		document.getElementById('ticketurl').style.display = 'none';
		document.getElementById('paidevent').style.display = 'block';
	}else{
		document.getElementById('paidevent').style.display = 'none';
	}
}
</script>
 <!-- show model add ticket url or not-->
<div class="row tickets-section" id="paidevents" style="padding: 10px; border-radius: 18px;display: none;">
	<div class="form-group">
		<label for="spPostingStartDate_" class="lbl_29">Add Ticket Link <span style="color:red;">*</span><span id="type_err" class="label_error"></span></label>
		<br><br>
		<label class="radio-inline">
			<input  type="radio"   name="event_payment_types" value="1" onclick="addTicketUrl()" >  Add external ticket link
			<!-- 1 for Art -->
		</label>
		<label class="radio-inline">
			<!--  <input type="radio" id="eventtype2" name="event_payment_type" value="2" onclick="eventtyeCheck('2')" <?php //if($eventpaymenttype == 2){ echo "checked"; } ?>>Paid-->
			<input type="radio" id="paid_ticked_chs"  name="event_payment_types" value="2" onclick="eventtyeCheck('2')"> Sell Ticket on TheSharePage
			<!-- 2 for Craft -->
		</label>
	</div>
</div>

<!-- add ticket url -->
<div class="row tickets-section" id="ticketurl" style="padding: 10px; border-radius: 18px; display:none;">
	<div class="form-group">
		<label for="spPostingStartDate_" class="lbl_29">Add Ticket Url <span style="color:red;">*</span><span id="type_err" class="label_error"></span></label><br>
		<label class="radio-inline" style="width:50%; padding: 0px;"><input  type="text" class ="form-control pac-target-input"  name="ticketlink" value=""></label>
	</div>
</div>
<!-- end -->
<div class="row tickets-section addticketmodel"  id="paidevent" style="padding: 10px; border-radius: 18px;display: none; ">
	<div class="col-md-3">
		<!-- Button trigger modal -->
		<button type="button" class="btn btn-primary btn-border-radius" data-toggle="modal" data-target="#exampleModalTicket" style="    background-color: #c11f50 !important;font-weight: 600;"> 
		<?php
		$post_id = isset($_GET['postid']) ? (int) $_GET['postid'] : 0;
		if ($post_id) {
		echo 'Update Ticket';
		} else {
		//die('===');
		echo 'Add/Edit Ticket';
		}
		//print_r($_SESSION);die;  
		?>
		</button>
		<br>
		<!-- Modal -->
		<div class="modal fade modelfield" id="exampleModalTicket" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
		<div class="modal-header">
			<h5 class="modal-title text-danger" id="exampleModalLabel">
				<b>
				<?php
				if ($post_id) {
				echo 'Update Ticket';
				} else {
				echo 'Add Ticket';
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
if ($post_id && $post_id > 0) {
$fieldName = "spPostingCohost_";
$result7 = $splinkp->read($post_id);
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

$resultdata = $prictype->read_price($post_id);

if ($resultdata != false) {
while ($pricedata = mysqli_fetch_assoc($resultdata)) {
   // print_r($pricedata);

//for($i=0; $i<=$count; $i++){
//echo $allTicket_Type[$i].'<br>';
?>
<div id="inputFormRow">
<div class="row">
<div class="col-md-3">
<div class="form-group">
<label for="Ticket_Type">Ticket Type </label>
<input type="text" class="form-control Ticket_Type" name="Ticket_Typeadd[]" id="Ticket_Type<?php echo $pricedata['typeid']; ?>" value="<?php echo $pricedata['event_type']; ?>" />
<!--<input type="hidden" class="form-control Ticket_Typenew" name="typeid_new[]" id="Ticket_Typenew" value="<?php echo $pricedata['typeid']; ?>" />-->
<input type="hidden" class="form-control Ticket_Typenew" id="Ticket_Typenew" value="<?php echo $pricedata['event_type'] . "||" . $pricedata['typeid']; ?>" />
</div>
</div>
<div class="col-md-3">
<div class="form-group">
<label for="Capacity">Ticket Quantity Limit</label>
<input type="text" class="form-control Capacity" name="Capacity[]" id="Capacity<?php echo $pricedata['typeid']; ?>" value="<?php echo $pricedata['event_limit']; ?>"  />
<input type="hidden" class="form-control Capacitynew" id="Capacitynew" value="<?php echo $pricedata['event_limit'] . "||" . $pricedata['typeid']; ?>"  />
</div>
</div>
<div class="col-md-3">
<div class="form-group">
<label for="Price">Ticket Price</label>


<input type="text" class="form-control Price" name="Price[]" id="Price<?php echo $pricedata['typeid']; ?>" value="<?php echo number_format((float)$pricedata['event_price'], 2, '.', ''); ?>" placeholder="$"  />




<input type="hidden" class="form-control Pricenew" id="Pricenew" value="<?php echo $pricedata['event_price'] . "||" . $pricedata['typeid']; ?>" placeholder="$"  />
</div>
</div>
</div>
<div class="input-group-append">
<button id="removeRow" type="button" class="btn btn-danger">Remove</button>
</div>
</div>
<?php }
}
if (!$post_id) {
?>
<div class="row">
<div class="col-md-3">
<div class="form-group">
<label for="Ticket_Type">Ticket Type</label>
<input type="text" class="form-control Ticket_Typeadd"  name="Ticket_Typeadd[]" id="Ticket_Typeadd" placeholder=""  />
</div>
</div>
<div class="col-md-3">
<div class="form-group">
<label for="Capacity">Ticket Quantity Limit</label>
<input type="text" class="form-control Capacityadd" name="Capacity[]" id="Capacityadd"  maxlength="6" onkeyup="numericFilter(this);" />
</div>
</div>
<div class="col-md-3">
<div class="form-group"> <label for="Price">Ticket Price</label>
<input type="text" class="form-control Priceadd" name="Price[]" id="Priceadd" placeholder="$"  maxlength="5" onkeyup="numericFilter(this);" />
</div>
</div>
</div>
<?php } ?>
<script>
function numericFilter(txb) {
txb.value = txb.value.replace(/[^\0-9]/ig, "");
}
</script>
<div id="newRow"></div>
<button id="addRow" type="button" class="btn btn-info btn-border-radius" style="    background-color: #c11f50 !important;font-weight: 600;">Add Another Ticket</button>
<span>Tax Rate : </span><input style=" height: 40px; " type="text" class="taxrate" placeholder="%" maxlength="2" id="taxrate" name="taxrate" value="<?php echo $taxrate; ?>"  onkeyup="numericFilter(this);" />
<input type="hidden" value="<?php echo $notax; ?>" name="notax" id="notaxval">
<input type="checkbox" id="notax" <?php if ($notax == 1) {
echo "checked"; 
} ?>> No Tax
</div>
</div>
<div class="modal-footer">
<button type="button" class="btn btn-danger btn-border-radius" data-dismiss="modal" aria-label="Close">Cancel</button>
<button onclick="getvalues();" id="saveclosebutton" type="button" class="btn btn-border-radius" style="background-color:#c11f50;color:white" data-dismiss="modal" aria-label="Close">Save</button>
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

var value = $("#Ticket_Type" + keyval).val();
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
if(value!="")
{
var html = '';
html += '<p class="addticketcss"><input type="hidden" id="ticket_type_id" name="Ticket_Type_add[' + key + ']" class="classnameticket" value="' + value + '">' + value + '</p>';
$('#forTicket_Type1').append(html);
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
html += '<p class="addticketcss"><input type="hidden" id="Capacity_add_id" name="Capacity_add[' + key + ']" class="classnameticket" value="' + value + '">' + value + '</p>';
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
html += '<p class="addticketcss"><input type="hidden" id="Price_add_id" name="Price_add[' + key + ']" class="classnameticket" value="' + value + '"><?php echo $currency;?> ' + value + '</p>';
$('#forTicket_Price1').append(html);
}
});
}


$("#notax").click(function() {
$("#taxrate").attr("disabled", this.checked);
$('#taxrate').val("0");
$("#totaleventCapacity").attr("disabled", this.checked);
$('#totaleventCapacity').val("0");
if (this.checked) {
$('#notaxval').val("1");
} else {
$('#notaxval').val("0");
}
});


$("#addRow").click(function() {
var html = '';
html += '<div id="inputFormRow">';
html += '<div class="row"> <div class="col-md-3"> <div class="form-group"> <label for="Ticket_Type">Ticket Type</label> <input type="text" class="form-control Ticket_Typeadd" id="Ticket_Typeadd" name="Ticket_Typeadd[]" placeholder=""  /> </div> </div> <div class="col-md-3"> <div class="form-group"> <label for="Capacity">Ticket Quantity Limit</label> <input type="text" class="form-control Capacityadd" id="Capacityadd" name="Capacity[]"  /></div> </div> <div class="col-md-3"> <div class="form-group"> <label for="Price">Ticket Price</label> <input type="text" class="form-control Priceadd" id="Priceadd" name="Price[]" placeholder="$"  /> </div> </div> </div>';
html += '<div class="input-group-append">';
html += '<button id="removeRow" type="button" class="btn btn-danger">Remove</button>';
html += '</div>';
html += '</div>';
$('#newRow').append(html);
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
document.getElementById("forTicket_Type").innerHTML = "";
document.getElementById("forCapacity").innerHTML = "";
document.getElementById("forTicket_Price").innerHTML = "";
document.getElementById("forTicket_Type1").innerHTML = "";
document.getElementById("forCapacity1").innerHTML = "";
document.getElementById("forTicket_Price1").innerHTML = "";

checkArraycheckboxPrice();
checkArraycheckboxTicket_Type();
checkArraycheckboxCapacity();

});
</script>
<br>
</div>
<?php //echo $spStartDate;die('======='); ?>
<div class="col-md-9">
<div class="row ticketss">
<div class="col-md-4">
<label>Ticket Type</label>
<div id="forTicket_Type">
</div>
<div id="forTicket_Type1">
</div>
</div>
<div class="col-md-4">
<label>Ticket Quantity Limit</label>
<div id="forCapacity" style="margin-left: 42px;">
</div>
<div id="forCapacity1" >
</div>
</div>
<div class="col-md-4">
<label>Ticket Price</label>
<div id="forTicket_Price">
</div>
<div id="forTicket_Price1">
</div>
</div>
</div>
</div>
</div>
<br>
<div class="row">
<div class="col-md-3">
<div class="form-group">
<?php
$pr = new _spprofiles;

if($organizerId=="")
{
$organizerId = $_SESSION['pid'];

}
if (isset($organizerId)) {
$resultpr = $pr->read($organizerId);
//echo $p->ta->sql;
if ($resultpr != false) {
$row2 = mysqli_fetch_assoc($resultpr);

$organizerName =  $row2['spProfileName'].' ( '.$row2['spProfileTypeName'].' )';

}
}
?>
<label for="spPostingEventOrgId_">Organizer Name <span style="color:red;">*</span><span style="color:blue;font-weight: 500;font-size: 11px;">(Type the name of organizer)</span> <span id="org_name_err" class="label_error"></span></label>
<input type="hidden" id="spPostingEventOrgId_" class="spPostField" name="spPostingEventOrgId" value="<?php echo (isset($organizerId) && $organizerId != '') ? $organizerId : ''; ?>">
<input type="text" class="form-control spPostField" id="spPostingEventOrgName" maxlength="25" name="spPostingEventOrgName" value="<?php echo (isset($organizerName)) ? $organizerName : ''; ?>"  autocomplete="off">
</div>
</div>
<div class="col-md-3">
<div class="form-group">
<label for="spPostingEventOrgId_">Organizer Email <span style="color:red;">*</span><span style="color:blue;font-weight: 500;font-size: 11px;">(Type the email of organizer)</span> <span id="org_email_err" class="label_error"></span></label>
<input type="text" class="form-control spPostField" id="spPostingEventOrgEmail" maxlength="125" name="spPostingEventOrgEmail" value="<?php echo (isset($organizerEmail)) ? $organizerEmail : ''; ?>"  autocomplete="off">
</div>
</div>
<div class="col-md-3">
<div class="form-group">
<label for="spPostingEventOrgId_">Organizer Phone <span style="color:red;">*</span><span style="color:blue;font-weight: 500;font-size: 11px;">(Type the phone of organizer)</span> <span id="org_phone_err" class="label_error"></span></label>
<input type="text" class="form-control spPostField" id="spPostingEventOrgPhone" maxlength="25" name="spPostingEventOrgPhone" value="<?php echo (isset($organizerPhone)) ? $organizerPhone : ''; ?>"  autocomplete="off">
</div>
</div>
<div class="">
</div>
</div>
<br>
<div class="row">
<script>
function sdate(){

document.getElementById("lbl_9").innerText="";
}
</script>
<div class="col-md-3">
<div class="form-group">
<label for="spPostingStartDate_" class="lbl_9">Start Date <span style="color:red;">*</span><span id="lbl_9" class="label_error"></span></label>
<input type="text" onchange="sdate()" class="form-control spPostField datepicker" data-filter="1" id="spPostingStartDate_" name="spPostingStartDate" value="<?php echo (empty($spStartDate) ? "" : $spStartDate); ?>" >
</div>
</div>
<div class="col-md-3">
<script>
function edate(){
document.getElementById("lbl_10").innerText="";
}
</script>
<div class="form-group">
<label for="spPostingExpDt" class="lbl_10">End Date <span style="color:red;">*</span> <span id="end_date"style="font-size:10px;"></span><span id="lbl_10" class="label_error"></span></label>
<input type="text" class="form-control datepicker" data-filter="0" onchange="edate()" id="spPostingExpDt" name="spPostingExpDt" value="<?php echo (empty($spEndDate) ? "" : $spEndDate); ?>" >
</div>
</div>
<div class="col-md-3">
<script>
function stime(){
document.getElementById("lbl_11").innerText="";
}
</script>
<div class="form-group">
<label for="spPostingStartTime_" class="lbl_11">Start Time <span style="color:red;">*</span> <span id="lbl_11" class="label_error"></span></label>
<input type="time" class="form-control spPostField" data-filter="1" onchange="stime()" id="spPostingStartTime_" name="spPostingStartTime" value="<?php echo (empty($srtTime) ? "" : $srtTime); ?>" >
</div>
</div> 
<div class="col-md-3">
<script>
function etime(){
document.getElementById("lbl_12").innerText="";
}
</script>
<div class="form-group">
<label for="spPostingEndTime_" class="lbl_12">End Time <span style="color:red;">*</span> <span id="end_time"style="font-size:9px;"></span><span id="lbl_12" class="label_error"></span></label>
<input type="time" class="form-control spPostField" data-filter="0" onchange="etime()" id="spPostingEndTime_" name="spPostingEndTime" value="<?php echo (empty($endTime) ? "" : $endTime); ?>" >
</div>
</div>
</div>
<br>
<div class="row">
<div class="col-md-3">
<label for="addfeaturning_">Featured Artist For This Event</label>
<br>
<style>
.largerCheckbox {
transform: scale(2);
margin-right: 21px;
margin-top: 19px;
}
.allCheckbox {
transform: scale(2);
margin-right: 21px;
}
.mhead {
height: 430px;
overflow-y: scroll;
}
.bhead {
background: #8080801f;
border-radius: 10px;
margin: 5px;
}
.image {
border-radius: 50px;
}
.people_show {
height: 430px;
background: #8080801f; 
overflow-y: scroll;
}
.show_frainds {
background: #8080801f;
border-radius: 10px;
margin-bottom: 10px;
}
.btn-danger {
    color: #fff;
    background-color: orange!important;
    border-color: orange!important;
}
b {
color: red;
margin-left: 7px;
}
.text-center {
text-align: center;
margin-top: -13px;
}
</style>
<!-- Button trigger modal -->
<button type="button" class="btn btn-primary btn-border-radius" data-toggle="modal" data-target="#exampleModalaa" style="    background-color: #c11f50 !important;font-weight: 600;">
Select Friends
</button>
<!-- Modal -->
<div class="modal fade" id="exampleModalaa" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog modal-lg" role="document">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title text-danger" id="exampleModalLabel"><b>Select Featured Members</b></h5>
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<div class="modal-body">
<div class="container">
<div class="row">
<div class="col-md-4 p-2" style="padding:10px;">
<div class="searchNameField">
<input type="text" placeholder="Search member" id="searchName" class="form-control" />
</div>
<div class="mhead p-2" style="padding:10px;">
<div class="text-center mb-3">
<h5 class="members-heading">Select All
<input class="float-right allCheckbox" id="statusall" onclick="toggle(this);" type="checkbox" style="float:right;     margin-right: 25px;">
</h5>
</div>
<?php
$splinkp = new _spevent;

$pro = new _spprofiles;
$allFeature = array();
$i = 1;
if ($post_id && $post_id > 0) {

$result6 = $splinkp->read($post_id);
//echo $pf->ta->sql."<br>";
if ($result6 != false) {
while ($row6 = mysqli_fetch_assoc($result6)) {
if ($row6['addfeaturning'] != '') {
$allFeature = explode(",", $row6['addfeaturning']);
}
}
}
}
$selectedFeat = "";

if (in_array($_SESSION['pid'], $allFeature)) {
$selected = "checked";
$selectedFeat .= $_SESSION['MyProfileName'] . "<br>";
} else {
$selected = '';
}
$p = new _spprofiles;
$resultaa = $p->read($_SESSION['pid']);
if ($resultaa != false) {
$rowaa = mysqli_fetch_assoc($resultaa);
}
if (!empty($rowaa['spProfilePic'])) {
$avatar = $rowaa['spProfilePic'];
} else {
$avatar = 'https://www.seekpng.com/png/full/114-1149972_avatar-free-png-image-avatar-png.png';
}
?>
<!-- <div class="bhead">
<img class="image" id="img<?= $i; ?>" width="50" height="50" src="<?php echo $avatar; ?>">
<span id="name<?= $i; ?>" class="ml-4 font-weight-bold"><?php echo $_SESSION['MyProfileName']; ?></span>
<span>
<input value="<?php echo  $_SESSION['pid']; ?>" class="largerCheckbox" id="status<?= $i; ?>" onchange="checka('<?= $i; ?>')" type="checkbox" style="float:right;margin: 19px;" <?php echo $selected; ?>>
</span>
</div>-->
<?php
//$i = 2;
$b = array();
$r = new _spprofilehasprofile;
$pv = new _postingview;
$res = $r->readall($_SESSION["pid"]); //As a receiver
//echo $r->ta->sql;
if ($res != false) {
while ($rows = mysqli_fetch_assoc($res)) {
$p = new _spprofiles;
$sender = $rows["spProfiles_idspProfileSender"];
array_push($b, $sender);
$result = $p->read($rows["spProfiles_idspProfileSender"]);
//echo $p->ta->sql;
if ($result != false) {
$row = mysqli_fetch_assoc($result);
if (in_array($rows["spProfiles_idspProfileSender"], $allFeature)) {
$selected = "checked";
$selectedFeat .= $row["spProfileName"] . "<br>";
} else {
$selected = '';
}
if (!empty($row['spProfilePic'])) {
$avatar = $row['spProfilePic'];
} else {
$avatar = 'https://www.seekpng.com/png/full/114-1149972_avatar-free-png-image-avatar-png.png';
}
?>
<div class="bhead">
<img class="image" id="img<?= $i; ?>" width="50" height="50" src="<?php echo $avatar; ?>">
<span id="name<?= $i; ?>" class="ml-4 font-weight-bold"><?php echo $row['spProfileName']; ?></span>
<span>
<input value="<?php echo $rows['spProfiles_idspProfileSender']; ?>" class="largerCheckbox" id="status<?= $i; ?>" onchange="checka('<?= $i; ?>')" type="checkbox" style="float:right;margin: 19px;" <?php echo $selected; ?>>
</span>
</div>
<?php  }
$i++;
}
} ?>
<?php
//show profile as sender
$r = new _spprofilehasprofile;
$res = $r->readallfriend($_SESSION["pid"]); //As a sender
//echo $r->ta->sql;
if ($res != false) {
while ($rows = mysqli_fetch_assoc($res)) {
// print_r($rows);
$rm = in_array($rows["spProfiles_idspProfilesReceiver"], $b, true);
if ($rm == "") {
$p = new _spprofiles;
$result = $p->read($rows["spProfiles_idspProfilesReceiver"]);
if ($result != false) {
$receive = $rows["spProfiles_idspProfilesReceiver"];
$row = mysqli_fetch_assoc($result);
if (in_array($rows["spProfiles_idspProfilesReceiver"], $allFeature)) {
$selected = "checked";
$selectedFeat .= $row["spProfileName"] . "<br>";
} else {
$selected = '';
}
if (!empty($row['spProfilePic'])) {
$avatar = $row['spProfilePic'];
} else {
$avatar = 'https://www.seekpng.com/png/full/114-1149972_avatar-free-png-image-avatar-png.png';
} 
?>
<div class="bhead">
<img class="image" id="img<?= $i; ?>" width="50" height="50" src="<?php echo $avatar; ?>">
<span id="name<?= $i; ?>" class="ml-4 font-weight-bold"><?php echo $row['spProfileName']; ?></span>
<span>
<input value="<?php echo $rows['spProfiles_idspProfilesReceiver']; ?>" class="largerCheckbox" id="status<?= $i; ?>" onchange="check('<?= $i; ?>')" type="checkbox" style="float:right;margin: 19px;" <?php echo $selected; ?>>
</span>
</div>
<?php  }
}
}
}
?>
<br>
</div>
</div>
<div class="col-md-5 p-2" style="padding:10px;">
<div id="frainds" class="people_show p-3" style="padding:13px;">
</div>
</div>
</div>
</div>
</div>
<div class="modal-footer">
<button type="button" class="btn btn-danger btn-border-radius" data-dismiss="modal" aria-label="Close">Cancel</button>
<button type="button" id="saveclosebuttonnew" class="btn btn-primary btn-border-radius" data-dismiss="modal" aria-label="Close">Save</button>
</div>
</div>
</div>
</div>
<script>
function check(id) {
if ($("#status" + id + ":checked").length > 0) {
var name = $("#name" + id).html();
var image = $("#img" + id).attr('src');
var result = '<div class="show_frainds" id="pepole' + id + '"><img width="50" height="50" style="border-radius: 50px;" src="' + image + '"><span class="ml-4"><b>' + name + '</b></span></div>';
$('#frainds').append(result);

//var resulta = '<div class="show_frainds" id="pepolepre'+id+'"><img width="50" height="50" style="border-radius: 50px;" src="'+image+'"><span class="ml-4"><b>'+name+'</b></span></div>';
//$('#fraindspre').append(resulta);  
} else {
$("#pepole" + id).remove();
//$("#pepolepre"+id).remove(); 
}
}

function checknew(id) {
if ($("#status" + id + ":checked").length > 0) {
var name = $("#name" + id).html();
var image = $("#img" + id).attr('src');
var value = $("#status" + id).val();
//alert(value);
//var result = '<div class="show_frainds" id="pepole'+id+'"><img width="50" height="50" style="border-radius: 50px;" src="'+image+'"><span class="ml-4"><b>'+name+'</b></span></div>';
// $('#frainds').append(result);   

var resulta = '<div class="show_frainds" id="pepolepre' + id + '"><input type="hidden" name="addfeaturning[]" value="' + value + '"><img width="50" height="50" style="border-radius: 50px;" src="' + image + '"><span class="ml-4"><b>' + name + '</b></span></div>';
$('#fraindspre').append(resulta);
} else {
//$("#pepole"+id).remove(); 
$("#pepolepre" + id).remove();
}
}

function toggle(source) {
var checkboxes = document.querySelectorAll('input[type="checkbox"]');
//alert($("#statusall:checked").length);
if ($("#statusall:checked").length > 0) {
//alert('999999999999999');
$('#frainds').children('.show_frainds').remove();
for (var i = 1; i <= checkboxes.length; i++) {
$('#status' + i).prop('checked', true);
check(i);
//checkpreview(i);
}
} else {
for (var i = 1; i <= checkboxes.length; i++) {
$('#status' + i).prop('checked', false);
}
$('#frainds').children('.show_frainds').remove();
// $('#fraindspre').children('.show_frainds').remove();
}
}
setTimeout(function() {
checkArray();
checkArraynew();
}, 1000);

function checkArray() {
$checkbox = $('.largerCheckbox');
var chkArray = [];
chkArray = $.map($checkbox, function(el) {
if (el.checked) {
return el.id
};
});
$.each(chkArray, function(key, value) {
var id = value.replace("status", "");
check(id);
//checkpreview(i);
});
}

function checkArraynew() {
$checkbox = $('.largerCheckbox');
var chkArray = [];
chkArray = $.map($checkbox, function(el) {
if (el.checked) {
return el.id
};
});
$.each(chkArray, function(key, value) {
var id = value.replace("status", "");
checknew(id);
//checkpreview(i);
});
}
$("#saveclosebuttonnew").click(function() {
document.getElementById("fraindspre").innerHTML = "";
checkArraynew();

});
</script>
</div>
<div class="col-md-3" id="fraindspre" style=" height: 138px; overflow: auto; ">
</div>
<div class="col-md-2">
<label for="spPostingCohost_">Co-Host Name </label>
<br>
<style>
.largerCheckboxa {
transform: scale(2);
margin-right: 21px;
margin-top: 19px;
}
.allCheckboxa {
transform: scale(2);
margin-right: 21px;
}
.mheada {
height: 430px;
overflow-y: scroll;
}
.bheada {
background: #8080801f;
border-radius: 10px;
margin: 5px;
}
.imagea {
border-radius: 50px;
}
.people_showa {
height: 430px;
background: #8080801f;
overflow-y: scroll;
}
.show_fraindsa {
background: #8080801f;
border-radius: 10px;
margin-bottom: 10px;
}
</style>
<!-- Button trigger modal -->
<button type="button" class="btn btn-primary btn-border-radius" data-toggle="modal" data-target="#exampleModalaaaa" style="    background-color: #c11f50 !important;font-weight: 600;">
Select Friends
</button>
<!-- Modal -->
<div class="modal fade" id="exampleModalaaaa" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog modal-lg" role="document">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title text-danger" id="exampleModalLabel"><b>Select Co-Host Name</b></h5>
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<div class="modal-body">
<div class="container">
<div class="row">
<div class="col-md-4 p-2" style="padding:10px;">
<div class="searchNameField">
<input type="text" placeholder="Search member" id="searchName" class="form-control " />
</div>
<div class="mhead p-2" style="padding:10px;">
<div class="text-center mb-3">
<h5 class="members-heading">Select All
<input class="float-right allCheckboxa" id="statusalla" onclick="togglea(this);" type="checkbox" style="float:right;     margin-right: 25px;">
</h5>
</div>
<?php
$splinkp = new _spevent;
$pro = new _spprofiles;
$allCohost = array();
$ii = 1;
if ($post_id && $post_id > 0) {
$fieldName = "spPostingCohost_";
$result7 = $splinkp->read($post_id);
//  echo $splinkp->ta->sql."<br>";  die('-------------------------');
if ($result7 != false) {
while ($row7 = mysqli_fetch_assoc($result7)) {
if ($row7['spPostingCohost'] != '') {
$allCohost = explode(",", $row7['spPostingCohost']);
}
}
}
}
//print_r($allFeature);
$selectedCohost = "";

if (in_array($_SESSION['pid'], $allCohost)) {
$selectco = "checked";
} else {
$selectco = '';
}

$b = array();
$r = new _spprofilehasprofile;
$pv = new _postingview;
$res = $r->readall($_SESSION["pid"]); //As a receiver
//echo $r->ta->sql;
if ($res != false) {
while ($rows = mysqli_fetch_assoc($res)) {
$p = new _spprofiles;
$sender = $rows["spProfiles_idspProfileSender"];
array_push($b, $sender);
$result = $p->read($rows["spProfiles_idspProfileSender"]);
//echo $p->ta->sql;
if ($result != false) {
$row = mysqli_fetch_assoc($result);
if (in_array($rows["spProfiles_idspProfileSender"], $allCohost)) {
$selectco = "checked";
$selectedCohost .= $row["spProfileName"] . "<br>";
} else {
$selectco = '';
}

if (!empty($row['spProfilePic'])) {
$avatar = $row['spProfilePic'];
} else {
$avatar = 'https://www.seekpng.com/png/full/114-1149972_avatar-free-png-image-avatar-png.png';
}
?>
<div class="bheada">
<img class="imagea" id="imga<?= $ii; ?>" width="50" height="50" src="<?php echo $avatar; ?>">
<span id="namea<?= $ii; ?>" class="ml-4 font-weight-bold"><?php echo $row["spProfileName"]; ?></span>
<span>
<input value="<?php echo $rows["spProfiles_idspProfileSender"]; ?>" class="largerCheckboxa" id="statusa<?= $ii; ?>" onchange="check('<?= $ii; ?>')" type="checkbox" style="float:right;margin: 19px;" <?php echo $selectco; ?>>
</span>
</div>
<?php }
$ii++;
}
} ?>
<?php
//show profile as sender
//$ii=2;
$r = new _spprofilehasprofile;
$res = $r->readallfriend($_SESSION["pid"]); //As a sender
//echo $r->ta->sql;
if ($res != false) {
while ($rows = mysqli_fetch_assoc($res)) {
// print_r($rows);
$rm = in_array($rows["spProfiles_idspProfilesReceiver"], $b, true);
if ($rm == "") {
$p = new _spprofiles;
$result = $p->read($rows["spProfiles_idspProfilesReceiver"]);
if ($result != false) {
$receive = $rows["spProfiles_idspProfilesReceiver"];
$row = mysqli_fetch_assoc($result);
if (in_array($rows["spProfiles_idspProfilesReceiver"], $allCohost)) {
$selectco = "checked";
$selectedCohost .= $row["spProfileName"] . "<br>";
} else {
$selectco = '';
}

if (!empty($row['spProfilePic'])) {
$avatar = $row['spProfilePic'];
} else {
$avatar = 'https://www.seekpng.com/png/full/114-1149972_avatar-free-png-image-avatar-png.png';
}

?>
<div class="bhead">
<img class="imagea" id="imga<?= $ii; ?>" width="50" height="50" src="<?php echo $avatar; ?>">
<span id="namea<?= $ii; ?>" class="ml-4 font-weight-bold"><?php echo $row["spProfileName"]; ?></span>
<span>
<input value="<?php echo $rows["spProfiles_idspProfilesReceiver"]; ?>" class="largerCheckboxa" id="statusa<?= $ii; ?>" onchange="check('<?= $ii; ?>')" type="checkbox" style="float:right;margin: 19px;" <?php echo $selectco; ?>>
</span>
</div>
<?php
}
}
$ii++;
}
}
?>
</div>
</div>
<div class="col-md-5 p-2" style="padding:10px;">
<div id="fraindsa" class="people_showa p-3" style="padding:13px;">
</div>
</div>
</div>
</div>
</div>
<div class="modal-footer">
<button type="button" class="btn btn-danger btn-border-radius" data-dismiss="modal" aria-label="Close">Cancel</button>
<button type="button" id="saveclosebuttonnewa" class="btn btn-primary btn-border-radius" data-dismiss="modal" aria-label="Close">Save</button>
</div>
</div>
</div>
</div>
<script>
function checka(id) {
if ($("#statusa" + id + ":checked").length > 0) {
var name = $("#namea" + id).html();
var image = $("#imga" + id).attr('src');
var result = '<div class="show_fraindsa" id="pepolea' + id + '"><img width="50" height="50" style="border-radius: 50px;" src="' + image + '"><span class="ml-4"><b>' + name + '</b></span></div>';
$('#fraindsa').append(result);



//var resulta = '<div class="show_fraindsa" id="pepoleprea'+id+'"><img width="50" height="50" style="border-radius: 50px;" src="'+image+'"><span class="ml-4"><b>'+name+'</b></span></div>';
//$('#fraindsprea').append(resulta);  
} else {
$("#pepolea" + id).remove();
//$("#pepoleprea"+id).remove(); 
}
}

function checkanew(id) {
if ($("#statusa" + id + ":checked").length > 0) {
var name = $("#namea" + id).html();
var image = $("#imga" + id).attr('src');
var value = $("#statusa" + id).val();
//var result = '<div class="show_fraindsa" id="pepolea'+id+'"><img width="50" height="50" style="border-radius: 50px;" src="'+image+'"><span class="ml-4"><b>'+name+'</b></span></div>';
//$('#fraindsa').append(result);   

var resulta = '<div class="show_fraindsa" id="pepoleprea' + id + '"><input type="hidden" name="spPostingCohost[]" value="' + value + '"><img width="50" height="50" style="border-radius: 50px;" src="' + image + '"><span class="ml-4"><b>' + name + '</b></span></div>';
$('#fraindsprea').append(resulta);
} else {
//$("#pepolea"+id).remove(); 
$("#pepoleprea" + id).remove();
}
}

function togglea(source) {
var checkboxes = document.querySelectorAll('input[type="checkbox"]');
//alert($("#statusalla:checked").length);
if ($("#statusalla:checked").length > 0) {

$('#fraindsa').children('.show_fraindsa').remove();
for (var i = 1; i <= checkboxes.length; i++) {
$('#statusa' + i).prop('checked', true);
checka(i);

}
} else {
for (var i = 1; i <= checkboxes.length; i++) {
$('#statusa' + i).prop('checked', false);
}
$('#fraindsa').children('.show_fraindsa').remove();
//$('#fraindsprea').children('.show_fraindsa').remove();
}
}
setTimeout(function() {
checkArraya();
checkArrayanew();
}, 1000);

function checkArraya() {
$checkboxa = $('.largerCheckboxa');
var chkArray = [];
chkArray = $.map($checkboxa, function(el) {
if (el.checked) {
return el.id
};
});
$.each(chkArray, function(key, value) {
var id = value.replace("statusa", "");
checka(id);
});
}

function checkArrayanew() {
$checkboxa = $('.largerCheckboxa');
var chkArray = [];
chkArray = $.map($checkboxa, function(el) {
if (el.checked) {
return el.id
};
});
$.each(chkArray, function(key, value) {
var id = value.replace("statusa", "");
checkanew(id);
});
}


$("#saveclosebuttonnewa").click(function() {
document.getElementById("fraindsprea").innerHTML = "";
checkArrayanew();

});
</script>  
<script>
$(document).ready(function(){


var aa=$('#eventtype2').val();
//alert(aa);
if(aa==2){

$('#eventtype2').click();
}

});

$('#spPostSubmitEvent').click(function(){ 

/*alert('hello');  

if($('#paid_ticked_ch').is(':checked')) { 

   alert('check1111');
  var ticket_type_id = $('.ticket_type_id').val();
  var Capacity_add_id = $('.Capacity_add_id').val();
  var Price_add_id = $('.Price_add_id').val();

  if((ticket_type_id == " ") && (Capacity_add_id == " ") && (Price_add_id == " ")){
   alert('check222');
   return false;  

  }
   

    }  */              

}); 
</script>
</select>
</div>
<div class="col-md-4" id="fraindsprea" style=" height: 138px; overflow: auto; ">
</div>
</div>
<br>


<script>
$(document).ready(function(){

    var val = $('input[name=event_payment_type]:checked').val();
    if(val==2){
        document.getElementById('paidevent').style.display = 'block';
    }
 
});
</script>
