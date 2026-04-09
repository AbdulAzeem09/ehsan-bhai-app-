<?php
include('../../univ/baseurl.php');
session_start();
if(!isset($_SESSION['pid'])){ 
$_SESSION['afterlogin']="real-estate/";
include_once ("../../authentication/islogin.php");

}else{
function sp_autoloader($class) {
include '../../mlayer/' . $class . '.class.php';
}
spl_autoload_register("sp_autoloader");

$_GET["categoryID"] = "3";
$_GET["categoryName"] = "Realestate";
$header_realEstate = "realEstate";
$activePage = 21;
?>
<!DOCTYPE html>
<html lang="en-US">

<head>
<?php include('../../component/f_links.php');?>


<!-- ===== INPAGE SCRIPTS====== -->
<!-- High Charts script -->
<script src="<?php echo $BaseUrl;?>/assets/js/highcharts.js"></script>
<!-- Morris chart -->
<link href="<?php echo $BaseUrl; ?>/assets/admin/plugins/morris/morris.css" rel="stylesheet" type="text/css" />
<?php include('../../component/dashboard-link.php'); ?>
</head>
<style>


body{

background-color: #eee; 
}

table th , table td{
text-align: center;
}

table tr:nth-child(even){
background-color: #e4e3e3
}

th {
background: #333;
color: #fff;
}

.pagination {
margin: 0;
}

.pagination li:hover{
cursor: pointer;
}

.header_wrap {
padding:30px 0;
}
.num_rows {
width: 20%;
float:left;
}
.tb_search{
width: 20%;
float:right;
}
.pagination-container {
width: 70%;
float:left;
}

.rows_count {
width: 20%;
float:right;
text-align:right;
color: #999;
}


ul#profileDropDown {
border: none;
}
#profileDropDown li.active {
background-color: #95ba3d!important;
}
#profileDropDown li.active a {
color: #fff!important;
}	
</style>								
<?php									
///////// start code for stripe payment request , response////////////

$paymentMessage = '';
if(!empty($_POST['stripeToken'])){

//die('===============');

// get token and user details
$stripeToken  = $_POST['stripeToken'];
$customerName = $_POST['customerName'];
$cardNumber = $_POST['cardNumber'];
$cardCVC = $_POST['cardCVC'];
$cardExpMonth = $_POST['cardExpMonth'];
$cardExpYear = $_POST['cardExpYear']; 
$cardString = strtolower($customerName)."||".$cardNumber."||".$cardExpMonth."||".$cardExpYear."||".$cardCVC;

//$cardDetails = PHP_AES_Cipher::encrypt($encrypt_key, $encrypt_iv, $cardString);


$u = new _spuser;
$resultbok = $u->read($_SESSION['uid']);	
if ($resultbok != false) {
$bookedbuy = mysqli_fetch_array($resultbok);
$customerEmail =	 $bookedbuy['spUserEmail'];
$customerAddress =   $bookedbuy['spUserAddress'];
$customerZipcode =   $bookedbuy['spUserzipcode'];
$customerFname =   $bookedbuy['spUserFirstName'];
$customerLname =   $bookedbuy['spUserLastName'];

$country_code =   $bookedbuy['spUserCountry'];
$state_code =   $bookedbuy['spUserState'];
$city_code =   $bookedbuy['spUserCity'];

$co = new _country;
$result3 = $co->readCountryName($country_code);
//echo $co->ta->sql;
if($result3 && $result3->num_rows > 0){
$row3 = mysqli_fetch_assoc($result3);
$customerCountry = $row3['country_title'];
}else{
$customerCountry = "";
}
// CITY NAME
$ci = new _city;
$result4 = $ci->readCityName($city_code);
if ($result4) {
$row4 = mysqli_fetch_assoc($result4);
$customerCity = $row4['city_title'];
}else{
$customerCity = "";
}

$st = new _state;
$result5 = $st->readStateName($state_code);
if ($result5) {
$row5 = mysqli_fetch_assoc($result5);
$customerState = $row5['state_title'];
}else{
$customerState = "";
}


}	





//include Stripe PHP library
require_once('../../stripe-php/init.php'); 

//set stripe secret key and publishable key
$stripe = array(
"secret_key"      => SECRET_KEY,
"publishable_key" => PUBLIC_KEY
);    
\Stripe\Stripe::setApiKey($stripe['secret_key']);    

try{
//add customer to stripe
$customer = \Stripe\Customer::create(array(
'name' => $customerName,
'description' =>  'PRO TITLE',
'email' => $customerEmail,
'source'  => $stripeToken,
"address" => ["city" => $customerCity, "country" => $customerCountry, "line1" => $customerAddress, "line2" => "", "postal_code" => $customerZipcode, "state" => $customerState]
));  
// item details for which payment made
$seller_id = $_POST['seller_id'];
//$itemPrice = number_format($_POST['price'], 2, '.', '');
//$totalAmount = number_format($_POST['total_amount'], 2, '.', '');
$totalAmount = $_POST['total_amount'];
//$totalAmount = $totalprice;  //$totalprice
$currency = $_POST['currency_code'];
$orderQty = $_POST['spOrderQty'];
$orderNumber ="WER12345";   
//print_r($_POST); die('=================');
// details for which payment performed
$payDetails = \Stripe\Charge::create(array(
'customer' => $customer->id,
'amount'   => $totalAmount*100,
'currency' => $currency,
'description' => 'ITEM NAME',
'metadata' => array(
'order_id' => $orderNumber
)
)); 

$paymenyResponse = $payDetails->jsonSerialize();

}
catch (Error\Card $e) {

$paymentMessage ='Your card was declined '. $e->getMessage().'card_declined '.$e->getStripeCode().'generic_decline '.$e->getDeclineCode().'exp_month '. $e->getStripeParam();
}
catch (Error\InvalidRequest $e) {

$paymentMessage = "<strong>".ucfirst($e->getStripeParam())."</strong> ".$e->getMessage();
} 
catch (\Exception $e) {
$paymentMessage = "<strong>".ucfirst($e->getStripeParam())." </strong> ".$e->getMessage();
} 



//print_r($payDetails);
// get payment details

//echo "<pre>";
//print_r($paymenyResponse);
//exit;
// check whether the payment is successful
if($paymenyResponse['amount_refunded'] == 0 && empty($paymenyResponse['failure_code']) && $paymenyResponse['paid'] == 1 && $paymenyResponse['captured'] == 1){
// die('---------');
// transaction details 
$amountPaid = $paymenyResponse['amount'];
$balanceTransaction = $paymenyResponse['balance_transaction'];
$paidCurrency = $paymenyResponse['currency'];
$paymentStatus = $paymenyResponse['status'];
$payer_id = $paymenyResponse['customer'];
//$payer_status = $paymenyResponse['outcome']['type'];
$paymentDate = date("Y-m-d H:i:s");     



$data = array(
"payer_email"=>$customerEmail,
"payer_id"=>$payer_id,
"payer_status"=>$payer_status,
"payment_status"=>$paymentStatus,
"first_name"=>$customerFname,
"last_name"=>$customerLname,
"txn_id"=>$balanceTransaction,
"currency"=>$currency,
"quantity"=>$orderQty,
"payment_date"=>$paymentDate,
"buyer_uid"=>$_SESSION['uid'],
"buyer_pid"=>$_SESSION['pid'],
"payment_gross"=>$totalAmount,
"sellerid"=>$seller_id,
"bookingid"=>$_POST['bookid']
);
// $cardDetails



$uu = new _spprofiles;

$resultu = $uu->read($ArtistId);
if ($resultu != false) {
$row6 = mysqli_fetch_array($resultu);
$evetpostuid = $row6['spUser_idspUser'];	
$posteduseremail =	 $row6['spProfileEmail'];	
$postedusername =	 $row6['spProfileName'];

$resultboku = $uu->read($_SESSION['pid']);	
if ($resultboku != false) {

$bookedbuyu = mysqli_fetch_array($resultboku);


$bokkedbynameu = $bookedbuyu['spProfileName'];
$bookeduseremail =	 $bookedbuyu['spProfileEmail'];

}	

$event_title = '<a style="text-decoration: underline;" href="'.$BaseUrl.'/events/event-detail.php?postid='.$_GET['postid'].'">'.$ProTitle.'</a>';

$e = new _email;
////// email to event Organizer
$e->sendeventbooked($postedusername,$posteduseremail,$event_title,$bokkedbynameu,$orderQty,$totalAmount);


//// email to buyer
$e->sendeventbooked($postedusername,"ecommerceguru13@gmail.com",$event_title,$bokkedbynameu,$orderQty,$totalAmount);
}

$pet = new _spevent_transection;

$tr_id = $pet->createagainrealstate($data); 
$paass = new _spevent_transection;

$paass->updateorderstatusrealstate($_POST['bookid']);
$paymentMessage = "The payment was successful. Order ID: {$tr_id}";
if($tr_id && $paymentStatus == 'succeeded'){
$paymentMessage = "The payment was successful. Order ID: {$tr_id}";
} else{
//$paymentMessage = "failed";
}


} else{
//$paymentMessage = "failed";
}

}

///////// end code for stripe payment request , response////////////
?>




<body class="bg_gray">
<?php include_once("../../header.php");?>

<section class="realTopBread" style="padding:0px;">
<div class="container">
<div class="row">
<div class="col-md-6">

<div class="text-left agentbreadCrumb" style="margin-top: 10px;margin-bottom: -15px;">
<ol class="breadcrumb">
<li class="breadcrumb-item"><a style="font-size: 14px;color:white!important;" href="<?php echo $BaseUrl.'/real-estate/dashboard/';?>">Dashboard</a></li>
<li style="font-size: 14px;" class="breadcrumb-item active">Send Booking for Place</li>
</ol>

</div>
</div>
<div class="col-md-6">
<div class="text-right">

</div>
</div>
</div>

</div>
</section>


<section class="" style="padding: 40px;">
<div class="container">
<div class="row">
<div class="col-md-12 realDashboard no-padding">
<?php //include('top-dashboard.php');?>
</div>
</div>
<div class="space"></div>
<div class="row">
<div class="sidebar col-md-3 no-padding left_real_menu" id="sidebar" >
<?php include('left-menu.php'); ?> 
</div>


<div class="col-md-9 bg_white table-responsive">

<link rel='stylesheet' href='https://cdn.datatables.net/1.10.9/css/jquery.dataTables.min.css'>

<style type="text/css">
.paginate_button {
border-radius: 0 !important;
}
</style>


<div class="container-fluid" style="margin-top:10px;">


<!--<h4>Booking Sent Related to Rent Entire Place</h4>
partial:index.partial.html -->
<link rel='stylesheet' href='https://cdn.datatables.net/1.10.9/css/jquery.dataTables.min.css'>
<table class="table table-striped table-class" id= "example">
<!-- <table id="example" class="display" cellspacing="0" width="100%" > -->
<thead>
<tr>
<th>ID</th>
<th>ID</th>
<th>Property Title</th>
<th>Price</th>
<th>Booking Date</th>
<th>Days</th>
<th>Check In Date</th>
<th>Check Out Date</th>
<!-- <th>Date</th> -->
<th>Action</th>
</tr>
</thead>



<tbody>
<?php
$st= new _spuser;
$st1=$st->readdatabybuyerid($_SESSION['uid']);
if($st1!=false){
$stt=mysqli_fetch_assoc($st1);
$account_status=$stt['deactivate_status'];
}
$p = new _bookRoom;
$pv = new _postingview;
$type ="Rent Entire Place";
$result2 = $p->readMyBooking($_SESSION['pid'],$type);

$i = 1;
if($account_status!=1){
if($result2 != false){
while ($row2 = mysqli_fetch_assoc($result2)) {
$dt = new DateTime($row2['spBookDate']);


$pageLink = $BaseUrl."/real-estate/room-detail.php?postid=".$row2['spPosting_idspPosting'];   

?>
<tr>

<td><?php echo $i; ?></td>
<td><?php echo $i; ?></td>
<td>
<a href="<?php echo $pageLink;?>">
<?php 
// $result3 = $pv->singletimelines($row2['spPosting_idspPosting']);
$result3 = $pv->singleRealPost($row2['spPosting_idspPosting']);
if ($result3) {
$row3 = mysqli_fetch_assoc($result3);
echo $row3['spPostingTitle'];
}

?>

</a>
</td>

<td>
<?php
if ($row2['spDiscountPrice'] > 0) {
$ppppp = $row2['spDiscountPrice'];
}else{
$ppppp = $row2['spPrice'];
}
if ($row2['spDiscountPrice'] > 0) {
echo $row3['defaltcurrency'].' '.$ppppp.' ('.$row2['spDiscountPer'].'% Discount)';
}else{
echo $row3['defaltcurrency'].' '.$ppppp + $row2['spCleaningChrg']+$row2['spServiceChrg'] ; 
}
?>
</td>
<?php $total = $ppppp+$row3['spPostAgencyFee']+$row2['spCleaningChrg']+$row2['spServiceChrg'] ; ?>
<!------<td><?php echo $row3['spPostAgencyFee'];?></td>
<td><?php echo $row2['spCleaningChrg'];?></td>
<td><?php echo $row2['spServiceChrg'];?></td>--->
<td><?php echo $dt->format('d-M-Y'); ?></td>
<td><?php echo $row2['spDays']; ?></td>
<?php	

$dt1 = new DateTime($row2['spCheckInDate']); 
$dt2 = new DateTime($row2['spCheckOutDate']); 

?>
<td><?php echo $dt1->format('d-M-Y'); ?></td>
<td><?php echo $dt2->format('d-M-Y'); ?></td>
<!-- <td><?php echo $row2['fromdate']; ?></td> -->

<td>
<?php
if ($row2['spStatus'] == 0) {
?>
<a href="javascript:void(0)" class="btn btn-info" style="color: #FFF;">Waiting</a>
<?php
}else if($row2['spStatus'] == 1){
?>
<a  class="btn btn-success" style="color: #FFF;" href="#" data-toggle="modal" data-target="#exampleModal" onclick="payOnlyThisSeller('<?php echo $row3['idspPostings']; ?>','<?php echo $total; ?>','<?php echo $row2['idspRoomBook']; ?>');">Approved - Pay Now</a>
<?php 
}else if ($row2['spStatus'] == 2) {
echo "<p>You are Rejected!</p>";
}else if ($row2['spStatus'] == 3) {
echo "<p style='color: green;'>Payment Successful</p>";
}
?>
</td>
</tr>                                            
<?php
$i++;    }
}}
?>
</tbody>

</table>

<!--		Start Pagination -->
<div class='pagination-container'>
<nav>
<ul class="pagination">
<!--	Here the JS Function Will Add the Rows -->
</ul>
</nav>
</div>

</div> <!-- 		End of Container -->
<!-- partial -->
<!-- <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script> -->
<!-- <script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js'></script> -->
<script src='https://cdn.datatables.net/1.10.9/js/jquery.dataTables.min.js'></script>



<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-creditcardvalidator/1.0.0/jquery.creditCardValidator.js"></script>	


<script>

Stripe.setPublishableKey('<?php echo PUBLIC_KEY?>');

function checkqty(txb) {                
var qty = parseInt(txb);
var actualQty = $("#spOrderQty").val();
//alert(actualQty);return false;
//console.log(actualQty);
if(qty > actualQty){
document.getElementById("newValue").value = actualQty;
}
if(qty < 1){
document.getElementById("newValue").value = 1;
//alert("less");
}

$('#payqty').val($('#newValue').val());
}
</script>

<script type="text/javascript" src="<?php echo $BaseUrl; ?>/assets/js/payment.js"></script>





<script type="text/javascript">

function payOnlyThisSeller(sellerid, totalprice,bookid){
$('#selleridforss').val(sellerid);
$('#total_amountforss').val(totalprice);
$('#totalpriceforss').html(totalprice);
$('#bookid').val(bookid);
}


</script>
<script type="text/javascript">
$(document).ready(function() {

var table = $('#example').DataTable({ 
select: false,
"columnDefs": [{
className: "Name", 
"targets":[0],
"visible": false,
"searchable":false
}]
});//End of create main table


$('#example tbody').on( 'click', 'tr', function () {

// alert(table.row( this ).data()[0]);

} );
table.destroy();
});
</script>							
</div>
</div>
</div>
</section>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title" id="exampleModalLabel">Payment To <?php echo $sellerNmae; ?></h5>

</div>
<div class="modal-body">


<form class="row" action="<?php echo $BaseUrl;?>/real-estate/dashboard/my_send_booking2.php" method="POST" id="paymentForm">	
<div class="col-md-2"></div>
<div class="col-md-10">
<div class="row">
<div class="col-md-9 form-group">
<label><b>Card Holder Name <span class="text-danger">*</span></b></label>
<input type="text" name="customerName" id="customerName" class="form-control" value="" required>
<span id="errorCustomerName" class="text-danger"></span>
</div>

<div class="col-md-9 form-group">
<label>Card Number <span class="text-danger">*</span></label>
<input type="text" name="cardNumber" id="cardNumber" class="form-control" maxlength="20" onkeypress="">
<span id="errorCardNumber" class="text-danger"></span>
</div>
<div class="col-md-9">
<div class="row">
<div class="col-md-4">
<label>Expiry Month</label>
<input type="text" name="cardExpMonth" id="cardExpMonth" class="form-control" placeholder="MM" maxlength="2" onkeypress="return validateNumber(event);">
<span id="errorCardExpMonth" class="text-danger"></span>
</div>
<div class="col-md-4">
<label>Expiry Year</label>
<input type="text" name="cardExpYear" id="cardExpYear" class="form-control" placeholder="YYYY" maxlength="4" onkeypress="return validateNumber(event);">
<span id="errorCardExpYear" class="text-danger"></span>
</div>

<div class="col-md-4">
<label>CVC</label>
<input type="text" name="cardCVC" id="cardCVC" class="form-control"  maxlength="4" onkeypress="return validateNumber(event);">
<span id="errorCardCvc" class="text-danger"></span>
</div>
</div>
</div>
<br>
<div class="col-md-7" align="left" style=" margin-top: 12px; ">
<input type="hidden" id="total_amountforss" name="total_amount" value="">
<input type="hidden" id="selleridforss" name="seller_id" value="">
<input type="hidden" id="bookid" name="bookid" value="">
<input type="hidden" name="currency_code" value="USD">
<button type="button" class="btn butn_cancel btn-border-radius" name="payNow" id="payNow" onclick="stripePay(event)" value="Pay Now"><span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span>Pay Now <span id="totalpriceforss"><span></button>

<!-- <input type="button" name="payNow" id="payNow" class="btn btn-success btn-sm" onclick="stripePay(event)" value="Pay Now" /> -->
</div>
<br>
</div>
</div>
<div class="col-md-2"></div>
</form>
</div>
<div class="modal-footer">
<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
</div>
</div>
</div>
</div>		
</div>
</div>

<?php 
include('../../component/f_footer.php');
include('../../component/f_btm_script.php'); 
?>



<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.9/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            var table = $('#example').DataTable({
                paging: true, // Enable pagination
                select: false,
                columnDefs: [{
                    className: "Name",
                    targets: [0],
                    visible: false,
                    searchable: false
                }]
            });

            $('#example tbody').on('click', 'tr', function() {
                // Handle row click event here
            });
        });
    </script>
</body>
</html>
<?php
}
?>


<!-- <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script> -->
<!-- <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script> -->
<script>

getPagination('#table-id');
$('#maxRows').trigger('change');
function getPagination (table){

$('#maxRows').on('change',function(){
$('.pagination').html('');						// reset pagination div
var trnum = 0 ;									// reset tr counter 
var maxRows = parseInt($(this).val());			// get Max Rows from select option

var totalRows = $(table+' tbody tr').length;		// numbers of rows 
$(table+' tr:gt(0)').each(function(){			// each TR in  table and not the header
trnum++;									// Start Counter 
if (trnum > maxRows ){						// if tr number gt maxRows

$(this).hide();							// fade it out 
}if (trnum <= maxRows ){$(this).show();}// else fade in Important in case if it ..
});											//  was fade out to fade it in 
if (totalRows > maxRows){						// if tr total rows gt max rows option
var pagenum = Math.ceil(totalRows/maxRows);	// ceil total(rows/maxrows) to get ..  
//	numbers of pages 
for (var i = 1; i <= pagenum ;){			// for each page append pagination li 
$('.pagination').append('<li data-page="'+i+'">\
<span>'+ i++ +'<span class="sr-only">(current)</span></span>\
</li>').show();
}											// end for i 


} 												// end if row count > max rows
$('.pagination li:first-child').addClass('active'); // add active class to the first li 


//SHOWING ROWS NUMBER OUT OF TOTAL DEFAULT
showig_rows_count(maxRows, 1, totalRows);
//SHOWING ROWS NUMBER OUT OF TOTAL DEFAULT

$('.pagination li').on('click',function(e){		// on click each page
e.preventDefault();
var pageNum = $(this).attr('data-page');	// get it's number
var trIndex = 0 ;							// reset tr counter
$('.pagination li').removeClass('active');	// remove active class from all li 
$(this).addClass('active');					// add active class to the clicked 


//SHOWING ROWS NUMBER OUT OF TOTAL
showig_rows_count(maxRows, pageNum, totalRows);
//SHOWING ROWS NUMBER OUT OF TOTAL



$(table+' tr:gt(0)').each(function(){		// each tr in table not the header
trIndex++;								// tr index counter 
// if tr index gt maxRows*pageNum or lt maxRows*pageNum-maxRows fade if out
if (trIndex > (maxRows*pageNum) || trIndex <= ((maxRows*pageNum)-maxRows)){
$(this).hide();		
}else {$(this).show();} 				//else fade in 
}); 										// end of for each tr in table
});										// end of on click pagination list
});
// end of on select change 

// END OF PAGINATION 

}	




// SI SETTING
$(function(){
// Just to append id number for each row  
default_index();

});

//ROWS SHOWING FUNCTION
function showig_rows_count(maxRows, pageNum, totalRows) {
//Default rows showing
var end_index = maxRows*pageNum;
var start_index = ((maxRows*pageNum)- maxRows) + parseFloat(1);
var string = 'Showing '+ start_index + ' to ' + end_index +' of ' + totalRows + ' entries';               
$('.rows_count').html(string);
}

// CREATING INDEX
// function default_index() {
// $('table tr:eq(0)').prepend('<th> ID </th>')

// var id = 0;

// $('table tr:gt(0)').each(function(){	
// id++
// $(this).prepend('<td>'+id+'</td>');
// });
// }

// All Table search script
function FilterkeyWord_all_table() {

// Count td if you want to search on all table instead of specific column

var count = $('.table').children('tbody').children('tr:first-child').children('td').length; 

// Declare variables
var input, filter, table, tr, td, i;
input = document.getElementById("search_input_all");
var input_value =     document.getElementById("search_input_all").value;
filter = input.value.toLowerCase();
if(input_value !=''){
table = document.getElementById("table-id");
tr = table.getElementsByTagName("tr");

// Loop through all table rows, and hide those who don't match the search query
for (i = 1; i < tr.length; i++) {

var flag = 0;

for(j = 0; j < count; j++){
td = tr[i].getElementsByTagName("td")[j];
if (td) {

var td_text = td.innerHTML;  
if (td.innerHTML.toLowerCase().indexOf(filter) > -1) {
//var td_text = td.innerHTML;  
//td.innerHTML = 'shaban';
flag = 1;
} else {
//DO NOTHING
}
}
}
if(flag==1){
tr[i].style.display = "";
}else {
tr[i].style.display = "none";
}
}
}else {
//RESET TABLE
$('#maxRows').trigger('change');
}
}
</script>
