<?php
if (!defined('WEB_ROOT')) {
exit;
}



//print_r($sp_sql);		
$errorMessage = (isset($_SESSION['errorMessage']) && $_SESSION['errorMessage'] != '') ? $_SESSION['errorMessage'] : '&nbsp;';


?>


<section class="content-header">
<h1>Registered User<small>[Verify Account]</small></h1>
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



<div class="table-responsive">
<table id="example1" class="table table-striped table-bordered">
<thead>
<tr>
<th class="text-center" style="width: 50px!important;">ID</th>
<th>Name</th>

<th>Phone</th>
<th>Email</th>

<th>Email Verified</th>
<th>Phone Verified</th>


<!-- <th>Total Profiles</th> -->
<th>ID Image1</th>
<th>ID Image2</th>
<th class="text-center" style="min-width: 80px;">Action</th>
</tr>
</thead>
<tbody>

<?php

$sp_sql = "SELECT * FROM useridentity  ";

$result1 = dbQuery($dbConn, $sp_sql);

//print_r($result1);
$i = 1;

while($row1 = dbFetchAssoc($result1)) { 

//print_r($row1);

$uid=$row1['uid'];	

$idsp_image=$row1['idimage'];
$idsp_image2=$row1['upload_spfile'];
$status =$row1['status'];

$uid=$row1['uid'];

$identityid = $row1['id'];


$sql = "SELECT * FROM spuser WHERE idspUser = $uid  ";

//$sql =	"SELECT * FROM spuser WHERE  ORDER BY idspUser DESC";
$result = dbQuery($dbConn, $sql); 
while($row = dbFetchAssoc($result)) {

/*echo "<pre>";
print_r($row['idspUser']);*/

$idspUser=$row['idspUser'];

$spUserFirstName=$row['spUserFirstName'];

$spUserLastName=$row['spUserLastName'];

$spUserCountryCode=$row['spUserCountryCode'];

$spUserPhone=$row['spUserPhone'];

$spUserEmail=$row['spUserEmail'];

$is_email_verify=$row['is_email_verify'];

$sp_Userphoneverified=$row['is_phone_verify']; ?>

<tr class="">

<input type="hidden" name="uid" id="Userid" value="<?php echo $uid; ?>">



<td class="text-center">
<?php echo $i++;?></td>

<td><a href="javascript:userDetail(<?php echo $idspUser; ?>)"><?php echo $spUserFirstName.' '.$spUserLastName;	?></a></td>


<td><?php echo $spUserCountryCode.$spUserPhone; ?></td>

<td><?php echo $spUserEmail; ?></td>

<td class="text-center"><?php echo ($is_email_verify == 1)?'&#10004;':'&#10008;';?></td>
<td class="text-center"><?php echo ($sp_Userphoneverified == 1)?'&#10004;':'&#10008;';?></td>

<?php if($idsp_image==""){
?>
<td><img src="https://t3.ftcdn.net/jpg/04/34/72/82/240_F_434728286_OWQQvAFoXZLdGHlObozsolNeuSxhpr84.jpg"height="40px;width:40px"></td>
<?php 
} 
else {
?>
<td><?php echo "<img src='/upload/user/user_id/".$idsp_image."' alt='image' width='40' height='40' />";?></td>

<?php
}?>
<?php 
if($idsp_image2==""){
?>
<td><img src="https://t3.ftcdn.net/jpg/04/34/72/82/240_F_434728286_OWQQvAFoXZLdGHlObozsolNeuSxhpr84.jpg"height="40px;width:40px"></td>
<?php 
}else {
?>
<td><?php echo "<img src='/upload/user/user_id/".$idsp_image2."' alt='image' width='40' height='40' />";?></td>
<?php
} ?>




<td class="menu-action" style="">

<?php if($row1['status']==1){ ?>

	<button type="button" id="Approve_btn" class="btn menu-icon vd_bg-green">

Approved
</button>
<?php 
} 
else { ?>


<button type="button" id="Approve_btn" class="btn menu-icon vd_bg-blue" onclick="get_approvedata(<?php echo $uid; ?>);" style="padding: 6px 16px !important;">

Approve
</button>

<?php 
} ?>


<?php if($row1['status']==2){ ?>

<button type="button" class="btn menu-icon vd_bg-yellow" style="padding: 6px 15px !important;" data-toggle="modal" data-target="">Rejected</button>
<?php 
}else{ ?>

<button type="button" class="btn menu-icon vd_bg-red" style="padding: 6px 22px !important;" data-toggle="modal" data-target="#myModal<?php echo $identityid; ?>">Reject</button>

<?php } ?>

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
<textarea class="" id="" name="remark" style="width: 100%;" rows="5"></textarea>

</div>

</div>

</div>



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

</tbody>
</div>
</table>
</div><!-- /.box-body -->



</section>



<script type="text/javascript">
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

$(document).ready( function () {
var table = $('#example1').DataTable( {

"order": [[ 0, "desc" ]],
pageLength : 10,
lengthMenu: [[10, 20, 50, 100], [10, 20, 50, 100]]
} );



} );

</script>
