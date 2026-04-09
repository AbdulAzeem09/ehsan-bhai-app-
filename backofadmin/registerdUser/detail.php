<?php
// error_reporting(E_ALL);
// 	ini_set('display_errors', '1');
if (!defined('WEB_ROOT')) {
exit;
}

if (isset($_GET['uid']) && $_GET['uid'] > 0) {
$uid = $_GET['uid'];
}else {
// redirect to index.php if user id is not present
redirect('index.php');
}
$sql		=	"SELECT * FROM spuser WHERE idspUser = $uid";
$result     = dbQuery($dbConn,$sql);
if ($result) {
$row = dbFetchAssoc($result);
if (is_array($row)) {
    extract($row);
}
}


?>

<!-- Content Header (Page header) -->
<section class="content-header ">
<h1>Registered User <small>[Detail]</small></h1>
</section>
<!-- Main content -->
<section class="content">
<div class="box box-success">
<div>
<?php
if(isset($_SESSION['errorMessage']) && isset($_SESSION['count'])){
if($_SESSION['count'] <= 1){
$_SESSION['count'] +=1; ?>
<div class="space"></div>
<p class="alert alert-success"><?php echo $_SESSION['errorMessage'];  ?></p> <?php
unset($_SESSION['errorMessage']);
}
} ?>
</div>
<div class="box-body">
<div class="row">
<div class="col-md-6">
<div class="table-responsive p_top_15">
<table class="table table-striped ">
<tbody>
<tr>
<td><strong>Account Name</td>
<td><?php echo $spUserName; ?></td>
</tr>
<tr>
<td><strong>First Name</td>
<td><?php echo $spUserFirstName; ?></td>
</tr>
<tr>
<td><strong>Last Name</td>
<td><?php echo $spUserLastName; ?></td>
</tr>

<tr>
<td><strong>Address</strong></td>
<td><?php echo $spUserAddress; ?></td>
</tr>
<tr>
<td><strong>Date Of Birth</strong></td>
<td><?php echo formatMySQLDate($spUserDob, "d-M-Y" ); ?></td>
</tr>
<tr>
<td><strong>Registration Date</strong></td>
<td><?php echo formatMySQLDate($spUserRegDate, "d-M-Y h:m:s" ); ?></td>
</tr>
<tr>


<?php
if(!empty($row['refferalcodeused'])){
  $ref=$row['refferalcodeused'];
  $sql_1		=	"SELECT spUserName FROM spuser WHERE userrefferalcode = '$ref'";
  $result_1     = dbQuery($dbConn,$sql_1);
  if ($result_1) {
    $row_1= dbFetchAssoc($result_1);
    extract($row_1);
  }
}
 ?>
<td><strong>Referred By</strong></td>
<td><?php echo $row['refferalcodeused'].' '; ?><?php if(isset($row_1)){ echo "(".$row_1['spUserName'].")"; }?></td>
</tr>


</tbody>
</table>
</div>
</div>
<div class="col-md-6">
<div class="table-responsive p_top_15">
<table class="table table-striped ">
<tbody>
<tr>
<td><strong>Phone Number</strong></td>
<td><?php echo $spUserCountryCode.$spUserPhone; ?>
<?php if($is_phone_verify == 1) { ?>
<span class="pull-right">(Verified) &#10004;
</span>
<?php } else { ?>
<span class="pull-right">
<button type="button" id="vphones" name="btnButton" class="btn btn-primary" onclick="vphone(<?php echo $idspUser; ?>,<?php echo $spUserCountryCode.$spUserPhone; ?>)">Send SMS Code to Verify Phone</button>
</span>
<?php } ?>
</td>
</tr>
<tr>								
<td><strong>Email</strong></td>
<td><?php echo $spUserEmail; ?>
<?php if($is_email_verify == 1) { ?>
<span class="pull-right">(Verified) &#10004;
</span>
<?php } else { ?>
<span class="pull-right">
<button type="button" id="vemail" name="btnButtons" class="btn btn-primary" onclick="vemail(<?php echo $idspUser; ?>,'<?php echo $spUserEmail; ?>','<?php echo $spUserName; ?>')">Send Code to Verify Email</button>
</span>

<?php } ?>

</td>

</tr>

<tr>
<td><strong>Country</strong></td>

<td>
<?php
if($spUserCountry > 0 && $spUserCountry != ''){
CountryName($dbConn, $spUserCountry);
} ?>
</td>
</tr>

<tr>
<td><strong>State</strong></td>
<td>
<?php
if($spUserState > 0 && $spUserState != ''){
StateName($dbConn, $spUserState);
} ?>
</td>
</tr>
<tr>
<td><strong>City</strong></td>
<td>
<?php
if($spUserCity > 0 && $spUserCity != ''){
CityName($dbConn, $spUserCity);
} ?>
</td>
</tr>
<tr>
<td><strong>Ip Address</strong></td>
<td><?php echo $spUserIpLastLogin; ?></td>
</tr>

<tr>
<td><strong>My Referred Code</strong></td>
<td><span id="p1"><?php echo $row['userrefferalcode']; ?><span><span style="margin-left: 20px;"><i class="fa fa-clone" onclick="copyToClipboard('#p1')" data-toggle="popover"  data-content="Copied!"></i></span></td>
</tr>

</tbody> 

</table>
<a class="btn" style="background-color:green;" href="index.php?view=referred_user&uid=<?php echo $_GET['uid']?>">My Referred Users</a>
</div>

</div>
</div>

</div>

</div>
<div class="box box-success">
<div class="box-body tbl-respon">
	<div class="table-responsive">
<table id="example1" class="table table-bordered table-striped tbl-respon2 tbl_User_Rec">
<thead>
<tr>
<th class="text-center">ID</th>
<th>Picture</th>
<th>Profile Name</th>
<th>Phone</th>
<th>Email</th>
<th>Profile Type</th>
<th>Country</th>
<th>State</th>
<th>City</th>
<th>Postal Code</th>
<th class="text-center">Action</th>
</tr>
</thead>
<tbody>

<?php
$sql2 = "SELECT * FROM spprofiles WHERE spUser_idspUser = $uid";
$result2 = dbQuery($dbConn, $sql2);
if($result2){
$i = 1;
while ($row2 = dbFetchAssoc($result2)) {

/*   echo"<pre>";
print_r(WEB_ROOT);*/
?>
<tr>
<td class="text-center"><?php echo $row2['idspProfiles']; ?></td>
<td><?php 

if(!empty($row2["spProfilePic"])){

echo "<img class='img-responsive' src=' " . ($row2["spProfilePic"]) . "' style='width:50px;height:50px;' >";

}else{

echo "<img class='img-responsive' src='".WEB_ROOT."assets/images/default_user.png' style='width:50px;height:50px;' >";

}

?>

</td>
<td><a href="javascript:singleProfileDetail(<?php echo $uid.','.$row2['idspProfiles']; ?>)"><?php echo ucfirst($row2['spProfileName']); ?></a></td>
<td><?php echo $row2['spProfilePhone']; ?></td>
<td><?php echo $row2['spProfileEmail']; ?></td>
<td>
<?php
ProfileType($dbConn, $row2['spProfileType_idspProfileType']);
?>
</td>
<td>
<?php
if($row2['spProfilesCountry'] > 0 && $row2['spProfilesCountry'] != ''){
CountryName($dbConn, $row2['spProfilesCountry']);
} ?>
</td>
<td>
<?php
if($row2['spProfilesState']> 0 && $row2['spProfilesState'] != ''){
StateName($dbConn, $row2['spProfilesState']);
}
?>
</td>
<td>
<?php 
if ($row2['spProfilesCity'] > 0 && $row2['spProfilesCity'] != '') {
CityName($dbConn, $row2['spProfilesCity']);
}
?>
</td>
<td><?php echo $row2['spProfilePostalCode']?></td>
<td class="text-center menu-action" style="">
<a href="javascript:singleProfileDetail(<?php echo $uid.','.$row2['idspProfiles']; ?>)" data-original-title="Detail" data-toggle="tooltip" data-placement="top" class="btn menu-icon vd_bg-green"><i class="fa fa-info"></i></a>


</td>
</tr>
<?php
$i++;
}
}
?>
</tbody>
</table>
</div>
</div>
</div>


</section>
<script type="text/javascript">

$(document).ready( function () {
var table = $('#example1').DataTable( {

"order": [[ 0, "desc" ]],
pageLength : 10,
lengthMenu: [[10, 20, 50, 100], [10, 20, 50, 100, ]]
} );



} );

function vphone(uid,mobile)
{
$('#vphones').prop('disabled', true);
$.ajax({
type: "POST",
url:"verified_phone.php",
data: {u_id:uid,mobile_number:mobile},
success: function(data)
{
$('#vphones').prop('disabled', false);
if(data)
{
swal({
title: "Verification Code Sent Successfully.",
type: "success",
confirmButtonClass: "sweet_ok",
confirmButtonText: "Ok",
showCancelButton: false,
},
function(isConfirm) {
//window.location.href = 'index.php';
});

}
}
});
}

function vemail(uid,email,username)
{
$('#vemail').prop('disabled', true);
$.ajax({
type: "POST",
url:"verified_email.php",
data: {"u_id":uid,"email":email,"username":username},
success: function(data)
{
$('#vemail').prop('disabled', false);
if(data)
{
swal({
title: "Verified Code Sent Successfully.",
type: "success",
confirmButtonClass: "sweet_ok",
confirmButtonText: "Ok",
showCancelButton: false,
},
function(isConfirm) {
//window.location.href = 'index.php';
});

}
}
});
}

</script>   
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script> -->
<script>
function copyToClipboard(element) {
  var $temp = $("<input>");
  $("body").append($temp);
  $temp.val($(element).text()).select();
  document.execCommand("copy");
  $temp.remove();
 $('[data-toggle="popover"]').popover();
}
</script>
