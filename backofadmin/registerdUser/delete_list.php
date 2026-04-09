<?php

if (!defined('WEB_ROOT')) {
exit;
}
?>

<!-- Content Header (Page header) -->
<section class="content-header">
<h1>Deleted User<small>[All User List]</small></h1>
</section>
<!-- Main content -->
<section class="content">




<div class="">
<div class="box box-success">

<div class="box-body">



<div class="table-responsive">
<table id="example1" class="table table-striped table-bordered">
<thead>
<tr>
<th class="text-center" style="width: 50px!important;">ID</th>
<th>Name</th>

<?php
if (isset($_GET['searchby']) && $_GET['searchby'] == "posted") {
echo "<th>Total Post</th>";
}
?>
<th>Phone</th>
<th>Email</th>

<th >Email Verified</th>
<th>Phone Verified</th>

<th>Buisness Verified</th>
<th>Country</th>
<th>User Ip</th>
<th>Total Profiles</th>
<th>Registration Date</th>


<th class="text-center" style="min-width: 80px;">Action </th>
</tr>
</thead>
<tbody>
<?php
$sql="SELECT * FROM `spdeleted_user`";
$result = dbQuery($dbConn, $sql);

if ($result){
if (isset($_GET['page']) && $_GET['page'] > 1) {
$i = 25 * ($_GET['page'] - 1) + 1;
}else{
$i = 1;
}
if($result !="false"){
while($row = dbFetchAssoc($result)) {
extract($row);
$postDate = strtotime($spUserRegDate);


//echo "<pre>";
//print_r($row);

?>
<tr class="<?php echo ($spUserLock == 1)?'lockedwind':'';?>">
<td class="text-center"><?php echo $i++;?></td>
<td><a href="javascript:userDetail(<?php echo $idspUser; ?>)"><?php echo $spUserFirstName.' '.$spUserLastName;	?></a></td>

<?php
if (isset($_GET['searchby']) && $_GET['searchby'] == "posted") {
echo "<td>".$totalpost."</td>";
}
?>
<td><?php echo $spUserCountryCode.$spUserPhone; ?></td>
<td><?php echo $spUserEmail; ?></td>

<td class="text-center"><?php echo ($is_email_verify == 1)?'&#10004;':'&#10008;';?></td>

<td class="text-center"><?php echo ($is_phone_verify == 1)?'&#10004;':'&#10008;';?></td>

<td><?php

$sql1= "SELECT * FROM spbuiseness_files WHERE sp_uid=".$idspUser." ORDER BY `spbuiseness_files`.`id` DESC LIMIT 1";
$result11 = dbQuery($dbConn, $sql1);

if($result11->num_rows !="0"){	  
$row1 = dbFetchAssoc($result11);
$status =($row1['status']);
if($status == 2 ){
echo 'Accepted';
}
if($status == 1 ){
echo 'Pending';
}
if($status == 3 ){
echo 'Rejected';
}

}
else{
echo "Not Submitted";
}

?></td>


<td>
<?php
if($spUserCountry > 0 && $spUserCountry != ''){
CountryName($dbConn, $spUserCountry);
} ?>

</td>

<td><?php echo $spUserIpLastLogin; ?></td>
<td class="text-center"><?php totalUserProfile($dbConn, $idspUser);?></td>
<td class="text-center"><?php echo $spUserRegDate;?></td>

<td class="text-center menu-action" style="width: 120px !important;">

<!-- <?php
if ($spUserLock == 1) { ?>
<a href="javascript:userunlock(<?php echo $idspUser;?>)" data-original-title="Un-lock" data-toggle="tooltip" data-placement="top" class="btn menu-icon vd_bg-green"><i class="fa fa-unlock"></i></a>&nbsp; <?php
}else{ ?>
<a href="javascript:userlock(<?php echo $idspUser;?>)" data-original-title="Block" data-toggle="tooltip" data-placement="top" class="btn menu-icon vd_bg-green"><i class="fa fa-lock"></i></a>&nbsp; <?php
}
?> -->


<a href="javascript:userReactive(<?php echo $idspUser; ?>)" data-original-title="Reactive" data-toggle="tooltip" data-placement="top" class="btn menu-icon vd_bg-green">✔</a>

<a href="javascript:permanentDelete(<?php echo $idspUser; ?>)" data-original-title="Permanent Delete" data-toggle="tooltip" data-placement="top" class="btn menu-icon vd_bg-red"><i class="fa fa-trash"></i></a>

</td>

</tr><?php
}
}
}else { ?>

<?php 
} //end while ?>

</tbody>
</div>
</table>
</div><!-- /.box-body -->

</div>
<!--- End Table ---------------->
</div>



</section><!-- /.content -->
<script type="text/javascript">
$(document).ready( function () {
var table = $('#example1').DataTable( {
"order": [[ 0, "desc" ]],
pageLength : 10,
lengthMenu: [[10, 20, 50, 100], [10, 20, 50, 100]]
});
});

</script>
<script type="text/javascript">
$(document).ready(function(){

$('#allselect').click(function(){

if($('input[name="allselect"]').is(':checked'))
{
$(".sdelete").prop('checked', true);
}else{

$(".sdelete").prop('checked', false);
}
})

$('#deletemulti').click(function(){
var val = [];
$('.sdelete:checked').each(function(i){
val[i] = $(this).val();
});
if(val==""){
swal("Please Choose A User To Delete");
return false;

}


swal({
title: "Do You Want To Delete The Selected ?",
/*text: "You Want to Logout!",*/
type: "warning",
confirmButtonClass: "sweet_ok",
confirmButtonText: "Yes, Delete!",
cancelButtonClass: "sweet_cancel",
cancelButtonText: "Cancel",
showCancelButton: true,
},
function(isConfirm) {
if (isConfirm){
$.ajax({
type: "POST",
url:"deleteMultiple.php",
data: {deleteuser:val}, // serializes the form's elements.
success: function(data)
{
window.location.href = 'index.php';
}
});
}

});
})
})
</script>
