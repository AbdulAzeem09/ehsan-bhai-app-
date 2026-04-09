<?php

require_once("../../univ/baseurl.php" );
session_start();
if(!isset($_SESSION['pid'])){ 
$_SESSION['afterlogin']="dashboard/";
include_once ("../../authentication/islogin.php");

}else{
function sp_autoloader($class) {
include '../../mlayer/' . $class . '.class.php';
}

spl_autoload_register("sp_autoloader");

$pageactive = 52;
?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php include('../../component/f_links.php');?>
<!--This script for posting timeline data End-->
<!-- ===========DSHBOARD LINKS================= -->
<?php include('../../component/dashboard-link.php');?>
<!-- ===========PAGE SCRIPT==================== -->
<script src="<?php echo $BaseUrl; ?>/assets/js/bootstrap-checkbox.js" defer></script>
<style>
.tagLine-max-char {

font-size: smaller;
font-weight: 600;

}


.dataTables_filter			{
margin-bottom: 5px;
}
.dataTables_empty{text-align:center!important;}
</style>
</head>
<body class="bg_gray" onload="pageOnload('details')">
<?php

include_once("../../header.php");
?>

<section class="">
<div class="container-fluid no-padding">
<div class="row">
<!-- left side bar -->
<div class="col-md-2 no_pad_right">
<?php
;
include('../../component/left-dashboard.php');
?>
</div>
<!-- main content -->
<div class="col-md-10 no_pad_left">
<div class="rightContent">



<style>
.smalldot{
width : 100px;
overflow:hidden;
display:inline-block;
text-overflow: ellipsis;
white-space: nowrap;
}
/* Style the tab */
.tab {
overflow: hidden;
border: 1px solid #ccc;
background-color: #f1f1f1;
}

/* Style the buttons that are used to open the tab content */
.tab button {
background-color: inherit;
float: left;
border: none;
outline: none;
cursor: pointer;
padding: 14px 16px;
transition: 0.3s;
}

/* Change background color of buttons on hover */
.tab button:hover {
background-color: #ddd;
}

/* Create an active/current tablink class */
.tab button.active {
background-color: #ccc;
}

/* Style the tab content */
.tabcontent {
display: none;
padding: 6px 12px;
border: 1px solid #ccc;
border-top: none;
}						

</style>






<div class="content">
<div class="col-sm-12 ">

<div class="row">




<div class="col-sm-12 ">
<div class="panel with-nav-tabs panel-warning" style=" border-color: #BACCE8;">
<div class="panel-heading" style="padding: 0px!important;background-color: #BACCE8;
border-color: #BACCE8;">
<ul class="nav nav-tabs">
<li style="background-color:green;" class="active"><a href="#tab1warning" style="color:white;" data-toggle="tab">Accepted</a></li>
<li style="background-color:blue;"><a href="#tab2warning"  style="color:white;"data-toggle="tab">Pending</a></li>
<li style="background-color:red;"><a href="#tab3warning" style="color:white;"data-toggle="tab">Rejected</a></li>



</ul>
</div>
<div class="panel-body">
<div class="tab-content">
<div class="tab-pane fade in active" id="tab1warning">

<link rel='stylesheet' href='https://cdn.datatables.net/1.10.9/css/jquery.dataTables.min.css'>

<style type="text/css">
.paginate_button {
border-radius: 0 !important;
}
</style>

<div class="col-sm-12 no-padding">
<span style="text-align:center;"><h4>Accepted Withdrawal</h4></span>
<div class="">


<div class="table-responsive">
<!-- <table class="table table-striped table-class" id= "example1"> -->
<link rel='stylesheet' href='https://cdn.datatables.net/1.10.9/css/jquery.dataTables.min.css'>
<table class="table tbl_store_setting display " id="example" cellspacing="0" style="width:100%;">
<thead>
<tr>
<th></th>
<th>ID</th>
<th  class="text-center">Module</th>
<th  class="text-center">Amount</th>
<th class="text-center">Action Date</th>
<th class="text-center">Detail</th>
<th class="text-center">status</th>
<th class="text-center">Message</th>


</tr>
</thead>
<tbody>
<?php
$userid=$_SESSION['uid'];
$c= new _orderSuccess;
$currency= $c->readcurrency($userid);
$res1= mysqli_fetch_assoc($currency);
$curr=$res1['currency'];


$status = '1';
$w= new _orderSuccess;

$result = $w->readWithdraw($_SESSION['uid'] ,$status);


//echo $p->ta->sql;
if ($result) {
$i = 1;
while ($row = mysqli_fetch_assoc($result)) {
//echo "<pre>";
//print_r($row); 

?><tr>
<td></td>
<td><?php echo $i++;?></td>
<td class="text-center "><span class="smalldot"><?php echo ucfirst($row['module']); ?></span></td>
<td class="text-center "><span class="smalldot"><?php echo $row['amount']; ?></span></td>
<td   class="text-center "><span><?php echo $row['action_date']; ?></span></td>
<td  class="text-center "> 
<button type="button" 
data-module="<?php echo $row['module'];?>" 
data-amount="<?php echo $row['amount'];?>" 
data-date="<?php echo $row['date'];?>" 
data-username="<?php echo $row['spBankusername']; ?>" 
data-spBankusername="<?php echo $row['spBankusername'];?>" 
data-spBankname="<?php echo $row['spBankname']; ?>" 
data-spBanknumber="<?php echo $row['spBanknumber']; ?>" 
data-spBranchnumber="<?php echo $row['spBranchnumber']; ?>"
data-spAccountnumber="<?php echo $row['spAccountnumber']; ?>" 
data-spBankcode="<?php echo $row['spBankcode']; ?>" class="btn btn-info withdraw" data-toggle="modal" data-target="#exampleModal">
View Details
</button></td>

<td   class="text-center "><span><?php echo $row['actionStatus']; ?></span></td>

<td class="text-center">
  <button type="button" class="btn btn-info view-message" data-id="<?php echo $row['id']; ?>" data-toggle="modal" data-target="#messageModal">View Message</button>
</td>

</tr>
<?php
// $i++
}
}
?>


</tbody>
</table>

</div> <!-- 		End of Container -->
</div>
</div>
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<!-- <script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js'></script> -->

</div>

<div class="tab-pane fade " id="tab2warning">


<link rel='stylesheet' href='https://cdn.datatables.net/1.10.9/css/jquery.dataTables.min.css'>

<style type="text/css">
.paginate_button {
border-radius: 0 !important;
}
</style>
<div class="col-sm-12 no-padding">
<span style="text-align:center;"><h4>Pending Withdrawal</h4></span>

<div class="container-fluid">

<div class="">
<div class="table-responsive1">

<!-- <table class="table table-striped table-class" id= "table-id"> -->
<table class="table tbl_store_setting " id="example2" cellspacing="0" style="width:100%;">
<thead>
<tr>
<th></th>
<th class="text-center">ID</th>
<th  class="text-center">Module</th>
<th  class="text-center">Amount</th>
<th class="text-center">Action date</th>
<th class="text-center">Detail</th>
<th class="text-center">status</th>
<th class="text-center">Message</th>

</tr>
</thead>
<tbody>
<?php

$c= new _orderSuccess;
$currency= $c->readcurrency($userid);
$res1= mysqli_fetch_assoc($currency);
$curr=$res1['currency'];

$status = '0';
$w= new _orderSuccess;

// die("------------");
$result = $w->readWithdraw($_SESSION['uid'] ,$status);


//echo $p->ta->sql;
if ($result) {
$i = 1;
while ($row = mysqli_fetch_assoc($result)) {
//echo "<pre>";
//  print_r($row); 

?><tr>
<td></td>
<td class="text-center "><?php echo $i++;?></td>
<td class="text-center "><span class="smalldot"><?php echo ucfirst($row['module']); ?></span></td>
<td class="text-center "><span class="smalldot"><?php echo $row['amount']; ?></span></td>
<td   class="text-center "><span><?php echo $row['action_date']; ?></span></td>
<td  class="text-center "> 
<button type="button" 
data-module="<?php echo $row['module'];?>" 
data-amount="<?php echo $row['amount'];?>" 
data-date="<?php echo $row['date'];?>" 
data-username="<?php echo $row['spBankusername']; ?>" 
data-spBankusername="<?php echo $row['spBankusername'];?>" 
data-spBankname="<?php echo $row['spBankname']; ?>" 
data-spBanknumber="<?php echo $row['spBanknumber']; ?>" 
data-spBranchnumber="<?php echo $row['spBranchnumber']; ?>"
data-spAccountnumber="<?php echo $row['spAccountnumber']; ?>" 
data-spBankcode="<?php echo $row['spBankcode']; ?>" class="btn btn-info withdraw" data-toggle="modal" data-target="#exampleModal">
View Details
</button></td>

<td   class="text-center "><span><?php echo $row['actionStatus']; ?></span></td>
<td class="text-center">
  <button type="button" class="btn btn-info view-message" data-id="<?php echo $row['id']; ?>" data-toggle="modal" data-target="#messageModal">View Message</button>
</td>
</tr>
<?php
// $i++
}
}
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
</div>
</div>
</div>


<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<!-- <script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js'></script> -->
<!--<script src='https://cdn.datatables.net/1.10.9/js/jquery.dataTables.min.js'></script>-->

<script type="text/javascript">

$(document).ready( function () {
var table = $('#example2').DataTable({
  paging: true, // Enable pagination
  select: false,
  columnDefs: [{
    className: "Name",
    targets: [0],
    visible: false,
    searchable: false
  }],
  "order": [[ 0, "desc" ]],
  pageLength : 10,
  lengthMenu: [[10, 20, 50, 100], [10, 20, 50, 100]]
});



} );

</script>

</div>
<div class="tab-pane fade " id="tab3warning">


<link rel='stylesheet' href='https://cdn.datatables.net/1.10.9/css/jquery.dataTables.min.css'>

<style type="text/css">
.paginate_button {
border-radius: 0 !important;
}
</style>
<div class="col-sm-12 no-padding">
<span style="text-align:center;"><h4>Rejected Withdrawal</h4></span>

<div class="container-fluid">

<div class="">
<div class="table-responsive1">

<!-- <table class="table table-striped table-class" id= "table-id"> -->
<table class="table tbl_store_setting display" id="example3" cellspacing="0" style="width:100%;"s>
<thead>
<tr>
<th></th>
<th class="text-center">ID</th>
<th  class="text-center">Module</th>
<th  class="text-center">Amount</th>
<th class="text-center">Action date</th>
<th class="text-center">Detail</th>
<th class="text-center">status</th>
<th class="text-center">Message</th>


</tr>


</thead>


<tbody>

<?php

$userid=$_SESSION['uid'];
$c= new _orderSuccess;
$currency= $c->readcurrency($userid);
$res1= mysqli_fetch_assoc($currency);
$curr=$res1['currency'];


$status = '2';
$w= new _orderSuccess;

// die("------------");
$result = $w->readWithdraw($_SESSION['uid'] ,$status);

//echo $p->ta->sql;
if ($result) {
$i = 1;
while ($row = mysqli_fetch_assoc($result)) {
//echo "<pre>";
//print_r($row); 

?><tr>

<td></td>
<td class="text-center "><?php echo $i++;?></td>
<td class="text-center "><span class="smalldot"><?php echo ucfirst($row['module']); ?></span></td>
<td class="text-center "><span class="smalldot"><?php echo $row['amount']; ?></span></td>
<td   class="text-center "><span><?php echo $row['action_date']; ?></span></td>
<td  class="text-center "> 
<button type="button" 
data-module="<?php echo $row['module'];?>" 
data-amount="<?php echo $row['amount'];?>" 
data-date="<?php echo $row['date'];?>" 
data-username="<?php echo $row['spBankusername']; ?>" 
data-spBankusername="<?php echo $row['spBankusername'];?>" 
data-spBankname="<?php echo $row['spBankname']; ?>" 
data-spBanknumber="<?php echo $row['spBanknumber']; ?>" 
data-spBranchnumber="<?php echo $row['spBranchnumber']; ?>"
data-spAccountnumber="<?php echo $row['spAccountnumber']; ?>" 
data-spBankcode="<?php echo $row['spBankcode']; ?>" class="btn btn-info withdraw" data-toggle="modal" data-target="#exampleModal">
View Details
</button></td>

<td   class="text-center "><span><?php echo $row['actionStatus']; ?></span></td>

<td class="text-center">
  <button type="button" class="btn btn-info view-message" data-id="<?php echo $row['id']; ?>" data-toggle="modal" data-target="#messageModal">View Message</button>
</td>

</tr>
<?php
// $i++
}
}
?>


</tbody>
</table>
<!--		Start Pagination -->



</div> <!-- 		End of Container -->


</div>
</div>
</div>


<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<!-- <script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js'></script> -->


<script type="text/javascript">

$(document).ready( function () {
var table = $('#example3').DataTable( {
  paging: true, // Enable pagination
  select: false,
  columnDefs: [{
    className: "Name",
    targets: [0],
    visible: false,
    searchable: false
  }],
  "order": [[ 0, "desc" ]],
  pageLength : 10,
  lengthMenu: [[10, 20, 50, 100], [10, 20, 50, 100]]
} );



} );

</script>

</div>

</div>
</div>
</div>
</div>



















<!-- new design -->

</div>
</div>
</div>





</div>
</div>
</div>





</div>
</section>


<?php include('../../component/f_footer.php');?>
<!-- INNER PAGE SCRIPTS STARTS FOR SMS AND EMAIL START-->
<?php include('../../component/f_btm_script.php'); ?>


<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
<h3 class="modal-title text-center" id="exampleModalLabel"><b>Transaction Details</b></h3>
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<div class="modal-body">
<form action="" method="post">
<input type="hidden" name="store" value="store">

<div class="row">

<?php
/*$uid = $_SESSION['uid'];
$b = new _spbankdetail;
$data = $b->read($uid);
$row = mysqli_fetch_array( $data );
//print_r($row);*/	
?>

<div class="col-md-6">
<div class="form-group">
<label for="price" class="control-label">Module<span class="red">*</span></label>
<input type="text" class="form-control" id="module" name="module" value="<?php //echo $row['spBankname'];?>" readonly>
<span id="spBankname_error" style="color:red;"></span>
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label for="username" class="control-label">Username<span class="red">*</span></label>
<input type="text" class="form-control" id="username" name="username" value="<?php //echo $row['spBankname'];?>" readonly>
<span id="spBankname_error" style="color:red;"></span>
</div>
</div>
<div class="col-md-6">
<div class="form-group">
<label for="amount" class="control-label">Amount<span class="red">*</span></label>
<input type="text"  class="form-control" id="amount" name="amount" value="<?php //echo $row['spBankname'];?>" readonly>
<span id="spBankname_error" style="color:red;"></span>
</div>
</div>
<div class="col-md-6">
<div class="form-group">
<label for="date" class="control-label">Requested Date<span class="red">*</span></label>
<input type="text" class="form-control" id="date" name="date" value="<?php //echo $row['spBankname'];?>" readonly>
<span id="spBankname_error" style="color:red;"></span>
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<input type="hidden" name="spProfile_idspProfile" id="spProfile_idspProfile" value="<?php echo $_SESSION['pid']; ?>">
<input type="hidden" id="uid" name="uid" value="<?php echo $userid;?>">
<label for="spBankusername" class="control-label">Name of Account Holder <span class="red">*</span></label>
<input type="text" class="form-control" id="spBankusername" name="spBankusername" value="<?php //echo $row['spBankusername'];?>" readonly>
<span id="spBankuser_error" style="color:red;"></span>
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label for="spBankname" class="control-label">Bank Name<span class="red">*</span></label>
<input type="text" class="form-control" id="spBankname" name="spBankname" value="<?php //echo $row['spBankname'];?>" readonly>
<span id="spBankname_error" style="color:red;"></span>
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label for="spBankusername" class="control-label">Bank Number <span class="red">*</span></label>
<input type="text" class="form-control" id="spBanknumber" name="spBanknumber" value="<?php //echo $row['spBanknumber'];?>" readonly>
<span id="spBanknumber_error" style="color:red;"></span>
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label for="spBankname" class="control-label">Branch Number<span class="red">*</span></label>
<input type="text" class="form-control" id="spBranchnumber" name="spBranchnumber" value="<?php //echo $row['spBranchnumber'];?>" readonly>
<span id="spBranchnumber_error" style="color:red;"></span>
</div>
</div>



<div class="col-md-6">
<div class="form-group">
<label for="spAccountname" class="control-label">Account Number <span class="red">*</span></label>
<input type="text" class="form-control" maxlength="18" id="spAccountnumber" name="spAccountnumber" value="<?php //echo $row['spAccountnumber'];?>" readonly>
<span id="spAccountnumber_error" style="color:red;"></span>
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label for="spBankcode" class="control-label">IFSC Code<span class="red">*</span></label>
<input type="text" class="form-control" maxlength="11" id="spBankcode" name="spBankcode" value="<?php // echo $row['spBankcode'];?>" readonly>
<span id="spBankcode_error" style="color:red;"></span>
</div>
</div>
<div class="col-md-6">

</div>
</div>
</div>
<div class="modal-footer">
<button type="button" class="btn btn-secondary" data-dismiss="modal" style="background-color:red">Close</button>

</form>
</div>
</div>
</div>
</div>

<!-- Message Modal -->
<div class="modal fade" id="messageModal" tabindex="-1" role="dialog" aria-labelledby="messageModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="messageModalLabel">Message Details</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
             <span aria-hidden="true">&times;</span>
          </button>
          <input type="hidden" name="requestid" id="requestid">
      </div>
      <div class="modal-body">
        <div class="scroll-container" style="max-height: 200px; overflow-y: auto;">
          <div id="messagesContainer"></div>
        </div>
        <input type="hidden" id="profileId" name="profileId" value="<?php echo $_SESSION['pid'];?>">
        <textarea id="messageContent" rows="6" cols="10" class="form-control"></textarea>
        <div>
            <span id="message_error" style="color:red;"></span>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id="submitMessage" onclick="saveChanges()">Submit</button>
        <button type="button" class="btn btn-danger" id="closeModalButton" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<script>
$('.withdraw').on('click', function() {
var username = $(this).data('username');
$('#username').val(username);

var amount = $(this).data('amount');
$('#amount').val(amount);

var date = $(this).data('date');
$('#date').val(date);


var spBankusername = $(this).attr("data-spBankusername"); 

$('#spBankusername').val(spBankusername);


var spAccountnumber = $(this).attr('data-spAccountnumber');
$('#spAccountnumber').val(spAccountnumber);

var spBankcode = $(this).attr('data-spBankcode');
$('#spBankcode').val(spBankcode);

var spBankname = $(this).attr('data-spBankname');
$('#spBankname').val(spBankname);

var spBanknumber = $(this).attr('data-spBanknumber');
$('#spBanknumber').val(spBanknumber);

var spBranchnumber = $(this).attr('data-spBranchnumber');
$('#spBranchnumber').val(spBranchnumber);

var module = $(this).attr('data-module');
$('#module').val(module);

});
</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.10.9/js/jquery.dataTables.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {

$('#closeModalButton').on('click', function () {
  $('#messageContent').val('');
  $('#message_error').text('');
});

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


$('.view-message').on('click', function() {
  var uniqueId = $(this).data('id');
  $('#requestid').val(uniqueId);
  $.ajax({
    type: "GET",
    url: "getwithdrawmessage.php",
    data: { id: uniqueId },
    success: function(response) {
      var responseData = JSON.parse(response);
      $('#messagesContainer').empty();
      $.each(responseData.data, function(index, message) {
        $('#messagesContainer').append('<p>' + message.spProfileName + ': ' + message.message + '</p>');
      });
    },
    error: function(error) {
      console.error("Error fetching withdrawal status details:", error);
    }
  });
});



});

function saveChanges() {
    var message = $("#messageContent").val();
    var requestId = document.getElementById("requestid").value;
    var profileId = document.getElementById("profileId").value
    if(message == ""){
        $("#message_error").text("Please Enter Message.");
        $("#messageContent").focus();
        return false;
    } else {
      $.ajax({
        type: 'POST',
        url: '/my-profile/addwithdrawmessage.php',
        data: {
          "messsage": message,
          "requestId": requestId,
          "profileId": profileId
        },
        success: function(response){
          response = JSON.parse(response);
          if (response.status == 0){
            alert(response.message);
          } else {
            alert(response.message);
            window.location.reload();
          }
        }
      });
    }
}

</script>

</body> 
</html>
<?php
} ?>


<!-- <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script> -->
<!-- <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script> -->
