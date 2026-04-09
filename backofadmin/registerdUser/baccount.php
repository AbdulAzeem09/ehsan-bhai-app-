<?php
//error_reporting(0);
if (!defined('WEB_ROOT')) {
exit;
}
include('../univ/baseurl.php');


//print_r($sp_sql);		
$errorMessage = (isset($_SESSION['errorMessage']) && $_SESSION['errorMessage'] != '') ? $_SESSION['errorMessage'] : '&nbsp;';


if(isset($_POST['verification_form_submit_btn'])){
   $sp_sql  = "select * from spbuiseness_files where sp_pid = '".$_POST['idspProfiles']."' and sp_uid = '".$_POST['spUser_idspUser']."'";
   $check_sp_sql = dbQuery($dbConn, $sp_sql);
   if(mysqli_num_rows($check_sp_sql)){
    $update_sql = " update spbuiseness_files set direct_verification_code = '".$_POST['verification_code']."', status = '1' where sp_pid = '".$_POST['idspProfiles']."' and sp_uid = '".$_POST['spUser_idspUser']."'";
    $result = dbQuery($dbConn, $update_sql);
   }else{
    $update_sql = "INSERT INTO spbuiseness_files (sp_pid, sp_uid, Business_Name, Address, Country , State , City , Profiles , upload_bills , bswebsite , counts , status , reject_reason,direct_verification_code) VALUES ('".$_POST['idspProfiles']."','".$_POST['spUser_idspUser']."',' ',' ',' ', ' ', ' ', ' ', ' ', ' ', ' ', '1', ' ','".$_POST['verification_code']."')";
    $result = dbQuery($dbConn, $update_sql);
   }
   //print_r($_POST);exit;
}

?>


<section class="content-header">
<h1>Business Profile Verification</h1>
</section>
<!-- Main content -->
<section class="content">

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

<!--to show status for approve,pending and rejected..-->
<style>
button.tablinks.active {
font-size: 20px;
font-weight: bold;
}
.swal2-popup { 
font-size: small !important;
}

</style>

<div class="tab"> 
<button class="tablinks btn btn-primary active" onclick="openCity(event, 'London')"id="upload1">PENDING</button>
<button class="tablinks btn btn-success" onclick="openCity(event, 'Paris')">APPROVED</button>
<button class="tablinks btn btn-danger" onclick="openCity(event, 'Tokyo')">REJECTED</button>
<button class="tablinks btn btn-warning" onclick="openCity(event, 'Usa')">BUSINESS PROFILE</button>
</div>


<script>
function openCity(evt, cityName) {
var i, tabcontent, tablinks;
tabcontent = document.getElementsByClassName("tabcontent");
for (i = 0; i < tabcontent.length; i++) {
tabcontent[i].style.display = "none";
}
tablinks = document.getElementsByClassName("tablinks");
for (i = 0; i < tablinks.length; i++) {
tablinks[i].className = tablinks[i].className.replace(" active", "");
}
document.getElementById(cityName).style.display = "block";
evt.currentTarget.className += " active";
}
</script>
<!-- Pendding case code here-->
<div id="London" class="tabcontent"style="display:none;margin-top:10px"> 
<div class="table-responsive"><span>Pending List</span><br><br>
<table id="example1" class="table table-striped table-bordered">
<thead>
<tr>
<th class="text-center" style="width: 50px!important;">ID</th>
<th>User Name</th>

<th>Business Name</th>
<th>Profile Name</th>
<!-- <th>Submission</th>
<th>Address</th> -->

<!-- <th>Total Profiles</th> -->
<th>License</th>
<th>Bill</th>
<th>website</th>
<!-- <th>Status</th> -->
<th class="text-center" style="min-width:143px;">Action</th>
</tr>
</thead>
<tbody>

<?php

$sp_sql = "SELECT * FROM spbuiseness_files where status=1";

$result1 = dbQuery($dbConn, $sp_sql);

//print_r($result1);
$i = 1;

while($row1 = mysqli_fetch_array($result1)) { 
// echo '<pre>';
// print_r($row1);
$sp_uid=$row1['sp_uid'];
$business_name=$row1['Business_Name'];
$spaddress=$row1['Address'];
$country=$row1['Country'];
$states=$row1['State'];
$cites=$row1['City'];
$spimages1=$row1['Profiles'];
$spimages2=$row1['upload_bills'];
$bswebsite=$row1['bswebsite'];
// $counts=$row1['counts'];
$userstatus=$row1['status'];
$rowid=$row1['id'];
//query for count submission...



$sqls = "SELECT * FROM spuser WHERE idspUser =  $sp_uid  ";

$spusercmd=mysqli_query($dbConn, $sqls);
if($spusercmd=="")
{
$spuserrecord="";
}
else{
while( $spuserrecord=mysqli_fetch_array($spusercmd))
{
$username=$spuserrecord['spUserName'];
$spuser_tmp = "SELECT * FROM spprofiles WHERE spUser_idspUser =    ".$spuserrecord['idspUser'];
$spuser_tmp = mysqli_query($dbConn, $spuser_tmp);
$spuser_tmp = mysqli_fetch_assoc($spuser_tmp);
?>

<tr class="">

<input type="hidden" name="uid" id="Userid" value="<?php echo $uid; ?>">



<td class="text-center">
<?php echo $i++;?></td>

<td><a href="index.php?view=detail&uid=<?php echo $sp_uid;?>"><?php echo   $username ;?></a></td>


<td><?php echo $business_name ; ?></td>
<td><?php echo isset($spuser_tmp['spProfileName']) ? $spuser_tmp['spProfileName'] : "" ; ?></td>
<!-- <td><?php echo $counts; ?></td>

<td><?php echo  $counts; ?></td> -->



<td class="text-center"> 
<a target="_blank" href="/dashboard/settings/profile_pic/<?php echo  $spimages1 ?>"> <img src="/dashboard/settings/profile_pic/<?php echo  $spimages1 ?>" width="40px;height:40px;"></a>
</td>
<td class="text-center"> 
<a target="_blank" href="/dashboard/settings/profile_pic/<?php echo  $spimages2 ?>">    <img src="/dashboard/settings/profile_pic/<?php echo  $spimages2 ?>" width="40px;height:40px;"></a>
</td>
<td><?php echo  $bswebsite ; ?></td>

<?php 
// if( $userstatus==1)
// {
?>
<!-- <td>N/A</td> -->
<?php 
// }if($userstatus ==2)
// {
?>
<!-- <td><i class="fa fa-check"  style="color:black"></i></td> -->
<?php 
// }if($userstatus ==3){
?>
<!-- <td><i class="fa fa-times"  style="color:black"></i></td> -->
<?php 
// }if($userstatus==0){
?>
<!-- <td>N/A</td> -->
<?php 
// }	?>

<td class="menu-action" style="">
<!-- <button class='btn btn-primary' type='button' data-toggle="modal" data-target="#verification_code_modal" onclick='setverificationFunction("<?php echo   $username ;?>","<?= $rowid ?>","<?= $spuser_tmp['idspProfiles'] ?>","<?= $spuser_tmp['spUser_idspUser'] ?>")'>Set Verification Code</button> -->
<a  href="#"
onclick="confirm_approve('<?php echo $rowid; ?>'); return false;"
>
<button type="button"  class="btn menu-icon vd_bg-green" 
 > Approve </button></a> 
<button data-id='<?php echo $rowid ;?>' type="button" class="reject_modal btn menu-icon vd_bg-yellow" data-toggle="modal" data-target="#rejectmodal">Reject</button>
<!-- <a href="" class="btn menu-icon vd_bg-yellow">Reject</a> -->


<div id="myModal<?php echo $identityid; ?>" class="modal fade" role="dialog">
<div class="modal-dialog">

<form action="updateidremark.php" method="post" >

<input type="hidden" name="identityid" value="<?php echo $identityid; ?>">
<!-- Modal content-->
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal">&times;</button>
<h4 class="modal-title">Add Remark</h4>
</div>
<div class="modal-body">
<div class="row">
<div class="col-md-12 ">

<div class="">

<label for="">Remark</label><br>
<textarea class="" id="" name="remark" class="form-control" style="width: 100%;" rows="5" class="form-control"></textarea>

</div>

</div>

</div>

<script>
$(document).ready(function() {

$('.reject_modal').click(function(){
var id=$(this).attr('data-id');


$('#usertext').val(id);
});
});															 </script>  

</div>
<div class="modal-footer">
<button type="submit" class="btn vd_btn vd_bg-green" onclick="get_remarkdata(<?php echo $uid; ?>);" >Submit</button>
<button type="button" class="btn vd_btn vd_bg-yellow" data-dismiss="modal">Close</button>
</div>
</div>
</form>

</div>
</div>


</td>

</tr>



<?php } ?>

<?php } ?>
<?php  } ?>






<!--modal for rejected cases in page..-->
<div class="modal" tabindex="-1" role="dialog" id="rejectmodal">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title">Reject Reason</h5>
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<div class="modal-body">
<form action="processRegUser.php?action=rejected"method="post">
<input type="hidden" id="usertext"name="ids">
<textarea rows="4"cols="70" name="reject_reason" class="form-control"></textarea>

</div>
<div class="modal-footer">
<button type="submit" class="btn btn-primary">Save</button>
<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
</div>
</form>
</div>
</div>
</div>

</tbody>
</table>
</div>
</div>

<div id="Paris" class="tabcontent"style="display:none;margin-top:10px">
<div class="table-responsive"><span>Approved List</span><br><br>
<table id="example22" class="table table-striped table-bordered">
<thead>
<tr>
<th class="text-center" style="width: 50px!important;">ID</th>
<th>User Name</th>

<th>Business Name</th>
<th>Profile Name</th>
<!-- <th>Submission</th> -->
<th>Address</th>

<!-- <th>Total Profiles</th> -->
<th>License</th>
<th>Bill</th>
<th>website</th>
<th>Status</th>

</tr>
</thead>
<tbody>

<?php

$sp_sql = "SELECT * FROM spbuiseness_files where status=2";

$result1 = dbQuery($dbConn, $sp_sql);

//print_r($result1);
$i = 1;

while($row1 = mysqli_fetch_assoc($result1)) { 
//echo '<pre>';
//print_r($row1);
$id=$row1['id'];
$sp_uid=$row1['sp_uid'];
$business_name=$row1['Business_Name'];
$spaddress=$row1['Address'];
$country=$row1['Country'];
$states=$row1['State'];
$cites=$row1['City'];
$spimages1=$row1['Profiles'];
$spimages2=$row1['upload_bills'];
$bswebsite=$row1['bswebsite'];
// $counts=$row1['counts'];
$userstatus=$row1['status'];
$rowid=$row1['id'];
//query for count submission...


$sqls = "SELECT * FROM spuser WHERE idspUser =  $sp_uid  ";
//echo $sqls; 
$spusercmd=mysqli_query($dbConn, $sqls);
if($spusercmd=="")
{
$spuserrecord="";
}
else{
while($spuserrecord=mysqli_fetch_assoc($spusercmd))
{
//echo '<pre>';
//print_r($spuserrecord);
$username=$spuserrecord['spUserName'];

?>

<tr class="">

<input type="hidden" name="uid" id="Userid" value="<?php echo $uid; ?>">



<td class="text-center">
<?php echo $i++;?></td>

<td><a href="index.php?view=detail&uid=<?php echo $sp_uid;?>"><?php echo   $username ;?></a></td>


<td><?php echo $business_name ; ?></td>
<td><?php echo  $counts ; ?></td>

<td><?php echo  $spaddress; ?></td>



<td class="text-center"> 
<a target="_blank" href="/dashboard/settings/profile_pic/<?php echo  $spimages1 ?>"> <img src="/dashboard/settings/profile_pic/<?php echo  $spimages1 ?>" width="40px;height:40px;"></a>
</td>
<td class="text-center"> 
<a target="_blank" href="/dashboard/settings/profile_pic/<?php echo  $spimages2 ?>">    <img src="/dashboard/settings/profile_pic/<?php echo  $spimages2 ?>" width="40px;height:40px;"></a>
</td>
<td><?php echo  $bswebsite ; ?></td>
<td>
<?php 
$href ="processAdmin.php?action=active&status=3&id=".$id;
?>
<a onclick="Reject('<?php echo $href;?>')" class="btn menu-icon vd_bg-red" title="Reject"><i class="fa fa-times" aria-hidden="true"></i></a>
</td>
</tr>
<?php } ?>

<?php } ?>
<?php  } ?>

<!--modal for rejected cases in page..-->
<div class="modal" tabindex="-1" role="dialog" id="rejectmodal">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title">Reject Reason</h5>
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<div class="modal-body">
<form action="processRegUser.php?action=rejected"method="post">
<input type="hidden" id="usertext"name="ids">
<textarea rows="4"cols="70" name="reject_reason" class="form-control"></textarea>

</div>
<div class="modal-footer">
<button type="submit" class="btn btn-primary">Save</button>
<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
</div>
</form>
</div>
</div>
</div>

</tbody>
</table>
</div>
</div>

<div id="Tokyo" class="tabcontent"style="display:none;margin-top:10px">
<div class="table-responsive"><span>Rejected List</span><br><br>
<table id="example3" class="table table-striped table-bordered">
<thead>
<tr>
<th class="text-center" style="width: 50px!important;">ID</th>
<th>User Name</th>

<th>Business Name</th>
<!-- <th>Submission</th> -->
<th>Address</th>

<!-- <th>Total Profiles</th> -->
<th>License</th>
<th>Bill</th>
<th>website</th>
<th>Status</th>

</tr>
</thead>
<tbody>

<?php

$sp_sql = "SELECT * FROM spbuiseness_files where status=3";

$result1 = dbQuery($dbConn, $sp_sql);

//print_r($result1);
$i = 1;

while($row1 = mysqli_fetch_array($result1)) { 
  //echo '<pre>';
//print_r($row1);
$id=$row1['id'];
$sp_uid=$row1['sp_uid'];
$business_name=$row1['Business_Name'];
$spaddress=$row1['Address'];
$country=$row1['Country'];
$states=$row1['State'];
$cites=$row1['City'];
$spimages1=$row1['Profiles'];
$spimages2=$row1['upload_bills'];
$bswebsite=$row1['bswebsite'];
$counts=$row1['counts'];
$userstatus=$row1['status'];
$rowid=$row1['id'];
//query for count submission...
// $countscmd = "SELECT * FROM spbuiseness_files where sp_uid='$sp_uid'";
//  $spusercmd=mysqli_query($dbConn, $countscmd);
//  $counts=mysqli_num_rows($spusercmd);

$sqls = "SELECT * FROM spuser WHERE idspUser =  $sp_uid  ";

$spusercmd=mysqli_query($dbConn, $sqls);
if($spusercmd=="")
{
$spuserrecord="";
}
else{
while( $spuserrecord=mysqli_fetch_array($spusercmd))
{
$username=$spuserrecord['spUserName'];
$spuser_tmp = "SELECT * FROM spprofiles WHERE spUser_idspUser =    ".$spuserrecord['idspUser'];
$spuser_tmp = mysqli_query($dbConn, $spuser_tmp);
$spuser_tmp = mysqli_fetch_assoc($spuser_tmp);
?>

<tr class="">

<input type="hidden" name="uid" id="Userid" value="<?php echo $uid; ?>">



<td class="text-center">
<?php echo $i++;?></td>

<td><a href="index.php?view=detail&uid=<?php echo $sp_uid;?>"><?php echo   $username ;?></a></td>


<td><?php echo $business_name ; ?></td>
<!-- <td><?php echo  $counts; ?></td> -->

<td><?php echo  $spaddress; ?></td>



<td class="text-center"> 
<a target="_blank" href="/dashboard/settings/profile_pic/<?php echo  $spimages1 ?>"> <img src="/dashboard/settings/profile_pic/<?php echo  $spimages1 ?>" width="40px;height:40px;"></a>
</td>
<td class="text-center"> 
<a target="_blank" href="/dashboard/settings/profile_pic/<?php echo  $spimages2 ?>">    <img src="/dashboard/settings/profile_pic/<?php echo  $spimages2 ?>" width="40px;height:40px;"></a>
</td>
<td><?php echo  $bswebsite ; ?></td>
<?php 
$href ="processAdmin.php?action=active&status=2&id=".$id;
?>
<td>
<!-- <button class='btn btn-primary' type='button' data-toggle="modal" data-target="#verification_code_modal" onclick='setverificationFunction("<?php echo   $username ;?>","<?= $id ?>","<?= $spuser_tmp['idspProfiles'] ?>","<?= $spuser_tmp['spUser_idspUser'] ?>")'>Set Verification Code</button>   -->
<a onclick="Accept('<?php echo $href;?>')" class="btn menu-icon vd_bg-green" title="Accept"><i class="fa fa-check" aria-hidden="true"></i></a>
<button data-id='<?php echo $rowid ;?>' type="button" title="Reject Reason" class="reject_modal btn menu-icon vd_bg-yellow" data-toggle="modal" data-target="#rejectmoda<?php echo $id;?>"><i class="fa fa-info-circle" aria-hidden="true"></i>
</button>



<!--modal for rejected cases in page..-->
<div class="modal" tabindex="-1" role="dialog" id="rejectmoda<?php echo $id;?>">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title">Reject Reason</h5>
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<div class="modal-body">
<form action="processRegUser.php?action=rejected"method="post">
<input type="hidden" id="usertext"name="ids" value="<?php echo $id;?>" >
<textarea rows="4"cols="70" name="reject_reason" class="form-control"><?php echo $row1['reject_reason'];?> </textarea>

</div>
<div class="modal-footer">
<button type="submit" class="btn btn-primary">Save</button>
<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
</div>
</form>
</div>
</div>
</div>
</td>
</tr>



<?php } ?>

<?php } ?>
<?php  } ?>



</tbody>
</table>
</div>
</div>


<div id="Usa" class="tabcontent"style="display:none;margin-top:10px">
<div class="table-responsive"><span>Not Submitted List</span><br><br>
<table id="example23" class="table table-striped table-bordered">
<thead>
<tr>
<th class="text-center" style="width: 50px!important;">ID</th>
<th>User Name</th>
<th>Bussiness Name</th>
<th>Email</th>
<th>Phone</th>
<th>Address</th>

<!-- <th>Total Profiles</th> -->
<!--<th>License</th>
<th>ID IBill>
<th>website</th>-->
<th>Action</th>

</tr>
</thead>
<tbody>

<?php

//$sp_sql = "SELECT * FROM spbuiseness_files where status=2";

//$result1 = dbQuery($dbConn, $sp_sql);

//print_r($result1);


//while($row1 = mysqli_fetch_array($result1)) { 

/* $sp_uid=$row1['sp_uid'];
$business_name=$row1['Business_Name'];
$spaddress=$row1['Address'];
$country=$row1['Country'];
$states=$row1['State'];
$cites=$row1['City'];
$spimages1=$row1['Profiles'];
$spimages2=$row1['upload_bills'];
$bswebsite=$row1['bswebsite'];
$counts=$row1['counts'];
$userstatus=$row1['status'];*/
//$rowid=$row1['id'];
//query for count submission...


$sqls_1 = "SELECT * FROM spprofiles WHERE spProfileType_idspProfileType = 1 ";

$spusercmd_1=mysqli_query($dbConn, $sqls_1);
$i = 1;
if($spusercmd_1=="")
{
$spuserrecord_1="";
}
else{
while( $spuserrecord_1=mysqli_fetch_assoc($spusercmd_1))
{
$Business_Name = 'N/A';
$username=$spuserrecord_1['spProfileName'];
$spUser_idspUser =$spuserrecord_1['spUser_idspUser'];
$idspProfiles =$spuserrecord_1['idspProfiles']; 
//$status = "("."status = 0 OR  status = 1 OR status = 3".")";
$sp_sql_1 = "SELECT * FROM spbuiseness_files where sp_pid =  $idspProfiles "; 
// echo $sp_sql_1; 
$result_2 = dbQuery($dbConn, $sp_sql_1);
// print_r($result_2);   
$row_2 = mysqli_fetch_assoc($result_2);
// echo '<pre>';		
// print_r($row_2); 
if($row_2['status'] == 2){
continue;
} 

$Business_Name = $row_2['Business_Name'] ;

?>

<tr class="">

<input type="hidden" name="uid" id="Userid" value="<?php echo $uid; ?>">



<td class="text-center">
<?php echo $i;?></td>
<td><a href="index.php?view=detail&uid=<?php echo $sp_uid;?>"><?php echo   $username ;?></a></td> 
<td><?php  if($Business_Name != '' ){ echo $Business_Name; }else{ echo 'N/A';} ?></td>
<td><?php echo $spuserrecord_1['spProfileEmail'] ; ?></td>
<td><?php   if($spuserrecord_1['spProfilePhone'] != '0'){ echo $spuserrecord_1['spProfilePhone']; }else{ echo 'N/A';} ?></td>
<td><?php echo  $spuserrecord_1['address'] ; ?></td>
<td>
<!-- <button class='btn btn-primary' type='button' data-toggle="modal" data-target="#verification_code_modal" onclick='setverificationFunction("<?php echo   $username ;?>","<?= $idspProfiles ?>","<?= $idspProfiles ?>","<?= $spUser_idspUser ?>")'>Set Verification Code</button> -->
<?php if($Business_Name != '' ){ ?>
<a  onclick="get_remarkdata_notsub('<?php echo  $idspProfiles; ?>')" >
<button type="button"  class="btn menu-icon vd_bg-green" >Verify
</button></a>
<?php }else{?> 


<a onclick="get_remarkdata_notsub_spro('<?php echo  $idspProfiles; ?>','<?php echo  $spUser_idspUser; ?>')"> 
<button type="button"  class="btn menu-icon vd_bg-green">Verify
</button></a>

<?php } ?>
</td>

<!--<td class="text-center"> 
<a target="_blank" href="/dashboard/settings/profile_pic/<?php echo  $spimages1 ?>"> <img src="/dashboard/settings/profile_pic/<?php echo  $spimages1 ?>" width="40px;height:40px;"></a>
</td>
<td class="text-center"> 
<a target="_blank" href="/dashboard/settings/profile_pic/<?php echo  $spimages2 ?>">    <img src="/dashboard/settings/profile_pic/<?php echo  $spimages2 ?>" width="40px;height:40px;"></a>
</td>
<td><?php echo  $bswebsite ; ?></td>-->

<?php /*if( $userstatus==1)
{
?>
<td>N/A</td>
<?php 
}if($userstatus ==2)
{
?>
<td><i class="fa fa-check"  style="color:black"></i></td>
<?php 
}if($userstatus ==3){
?>
<td><i class="fa fa-times"  style="color:black"></i></td>
<?php 
}if($userstatus==0){
?>
<td>N/A</td>
<?php   
}	*/												?>


</tr>



<?php //} ?> 

<?php $i++; }  ?>
<?php  } ?>



</tbody>
</table>
</div>
</div>

</div><!-- /.box-body -->



</section>

<!------------for verification modal----------------->
<div class="modal" id="verification_code_modal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Verification Code for <strong class='verification_user_name'></strong></h4>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <p>A unique verification code has been generated for the user. Please share this code with the user to complete their business verification process.</p>
        <p>Verification Code: <strong id='genrated_code'></strong></p>

<p>Instructions for User:
<ul>
<li>Provide this code to the user.</li>
<li>The user should enter this code in their account to complete the verification.</li>
</ul>
</p>
<button type='button' class='btn btn-success' onclick='copyGenratedCode()'>Copy Code</button>
<form id='verification_form' method='post'>
  <input type='hidden' name='verification_code'>
  <input type='hidden' name='id'>
  <input type='hidden' name='idspProfiles'>
  <input type='hidden' name='spUser_idspUser'>
</form>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="submit" name='verification_form_submit_btn' class="btn btn-primary" form='verification_form'>Assign this code to <strong class='verification_user_name'></strong></button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>
<!--------------------------------------------------->

<script type="text/javascript">

function confirm_approve(rowid){

    Swal.fire({
         title: "Are you sure you want to proceed and confirm?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Yes, proceed",
        cancelButtonText: "Cancel",
        customClass: {
            confirmButton: "sweet_ok",
            cancelButton: "sweet_cancel"
        }
    }).then((result) => {
        if (result.isConfirmed) {
            // Optional: show success message before redirect
            Swal.fire({
                title: "Confirmed!",
                text: "Redirecting...",
                icon: "success",
                timer: 1200,
                showConfirmButton: false
            }).then(() => {
                // Redirect user after confirmation
                window.location.href = "<?php echo $BaseUrl.'/backofadmin/registerdUser/processRegUser.php?action=accepted&id=' ?>" + rowid;
            });
        }
    });
}
function get_approvedata(u_id){

var userid = u_id;
//alert(userid);



swal({
title: "Are you sure?",
type: "warning",
confirmButtonClass: "sweet_ok",
confirmButtonText: "Yes",
cancelButtonClass: "sweet_cancel",
cancelButtonText: "No",
showCancelButton: true,
},

function(isConfirm) {
if (isConfirm) {
$.ajax({
type: 'POST',
//  url: 'deleteshipping_add.php',

url:'Updatespdata.php',
//  data: {'status': '1','userid':userid},
//data:  'status=1&userid='+userid,

// data: info,
data:{'status': '1','userid': userid},

error: function() {
alert('Something is wrong');
},
success: function(response){ 

console.log(data);


swal({

title: "Approved Successfully!",
type: 'success',
showConfirmButton: true

},
function() {

window.location.reload();

});

}


});

} 

});

}



function get_remarkdata(u_id){

var userid = u_id;
//alert(userid);

swal({
title: "Are you sure?",
type: "warning",
confirmButtonClass: "sweet_ok",
confirmButtonText: "Yes",
cancelButtonClass: "sweet_cancel",
cancelButtonText: "No",
showCancelButton: true,
},

function(isConfirm) {
if (isConfirm) {
$.ajax({
type: 'POST',
//  url: 'deleteshipping_add.php',

url:'Updatespdata.php',
//  data: {'status': '1','userid':userid},
//data:  'status=1&userid='+userid,

// data: info,
data:{'status': '1','userid': userid},

error: function() {
alert('Something is wrong');
},
success: function(response){ 

console.log(data);


/* swal({

title: "Approved Successfully!",
type: 'success',
showConfirmButton: true

},
function() {

window.location.reload();

});*/

}


});

} 

});

}


function get_remarkdata_notsub(u_id){

var userid = u_id;
// alert(userid);

Swal.fire({
title: "Are you sure?",
type: "warning",
confirmButtonClass: "sweet_ok",
confirmButtonText: "Yes",
cancelButtonClass: "sweet_cancel",
cancelButtonText: "No",
showCancelButton: true,
},

function(isConfirm) {
if (isConfirm) {
$.ajax({
type: 'POST',
//  url: 'deleteshipping_add.php',

url:'Update_non_submitted.php',
//  data: {'status': '1','userid':userid},
//data:  'status=1&userid='+userid,

// data: info,
data:{'status': '2','tbl':'bussiness_file','userid': userid},

error: function() {
alert('Something is wrong');
},
success: function(response){ 

window.location.reload();


}


});

} 

});

}


function get_remarkdata_notsub_spro(u_id,spuid){ 
//alert(u_id);
//alert(spuid);

var userid = u_id;

// alert(userid);
 
Swal.fire({
         title: "Are you sure you want to proceed and confirm?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Yes, proceed",
        cancelButtonText: "Cancel",
        customClass: {
            confirmButton: "sweet_ok",
            cancelButton: "sweet_cancel"
        }
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type: 'POST',
                url: 'Update_non_submitted.php',
                data: {
                    'status': '2',
                    'tbl': 'spprofile',
                    'userid': userid,
                    'spuid': spuid
                },
                error: function () {
                    Swal.fire("Error", "Something went wrong!", "error");
                },
                success: function (response) {
                    Swal.fire({
                        title: "Updated!",
                        icon: "success",
                        timer: 1500,
                        showConfirmButton: false
                    }).then(() => {
                        window.location.reload();
                    });
                }
            });
        }
    });

}


</script>

<!-- <script type="text/javascript">
$('#Reject_btn').click(function() {
//alert();

swal({
title: "Are you sure?",
type: "warning",
confirmButtonClass: "sweet_ok",
confirmButtonText: "Yes",
cancelButtonClass: "sweet_cancel",
cancelButtonText: "No",
showCancelButton: true,
},

function(isConfirm) {

if (isConfirm) {

var userid = $("#Userid").val();

alert(userid);

$.ajax({
type: 'POST',
url:'Updatespdata.php',

//  data: {'status': '1','userid':userid},
data:  'status=1&userid='+userid,

success: function(response){ 

console.log(data);




/*   swal({

title: "Identity Uploaded Successfully!",
type: 'success',
showConfirmButton: true

},
function() {

window.location.reload();

});
*/


}

});
}
});



});




</script>
-->
<script type="text/javascript">
//$.fn.dataTable.ext.errMode = 'none';	

$(document).ready( function () {
var table = $('#example1').DataTable( {

"order": [[ 0, "desc" ]],
pageLength : 10,
lengthMenu: [[10, 20, 50, 100], [10, 20, 50, 100]]

} );
//$("#upload1").css({"font-weight": "bold", "font-size": "20px"});
setTimeout(function() {
$('#upload1').click(); 


//jQuery('#upload1').find('.tablinks btn btn-primary').replaceWith('.tablinks btn btn-primary active');

}, 1000);    
// $('#upload1').click();    
} );

</script>

<script type="text/javascript">

$(document).ready( function () {
var table = $('#example22').DataTable( {

"order": [[ 0, "desc" ]],
pageLength : 10,
lengthMenu: [[10, 20, 50, 100], [10, 20, 50, 100]]
} );


var table = $('#example23').DataTable( {

"order": [[ 0, "desc" ]],
pageLength : 10,
lengthMenu: [[10, 20, 50, 100], [10, 20, 50, 100]]
} );




var table3 = $('#example3').DataTable( {

"order": [[ 0, "desc" ]],
pageLength : 10,
lengthMenu: [[10, 20, 50, 100], [10, 20, 50, 100]]
} );



} );

</script>
<script src="<?php echo $baseurl?>/assets/js/sweetalert.js"></script> 
    <script>
        function setverificationFunction(name,id,idspProfiles='',spUser_idspUser=''){
          const verificationCode = generateVerificationCode();
          $('.verification_user_name').html(name);
          $('#genrated_code').html(verificationCode);
          $('#verification_form input[name=id]').val(id);
          $('#verification_form input[name=verification_code]').val(verificationCode);
          $('#verification_form input[name=idspProfiles]').val(idspProfiles);
          $('#verification_form input[name=spUser_idspUser]').val(spUser_idspUser);
        }
        
        function copyGenratedCode() {
          // Get the text field
          var copyText = $('#genrated_code').text();
          navigator.clipboard.writeText(copyText);
        }
        function generateVerificationCode() {
            const characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
            let code = '';
            for (let i = 0; i < 6; i++) {
                code += characters.charAt(Math.floor(Math.random() * characters.length));
            }
            return code;
        }
        function Reject(userId) {
        Swal.fire({
        title: 'Are you sure you want to Reject?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, Reject!'
        }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = userId;
        }
        });
        }

		function Accept(userId) {
        Swal.fire({
        title: 'Are you sure you want to Accept?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, Accept!'
        }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = userId;
        }
        });
        }
    </script>
