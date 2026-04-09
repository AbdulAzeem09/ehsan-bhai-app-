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
if(isset($_GET['page']) && $_GET['page'] == 'subscription'){
  $pageactive = 200;
} else {
  $pageactive = 53;
}
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
section.content-header {
margin-bottom: 10px;
margin-top: -25px;
}



</style>

<div class="content">
<div class="row">

<div class="col-md-12">


<section class="content-header">
<h1>Subscription Transaction</h1>
<ol class="breadcrumb">
<li><a href="<?php echo $BaseUrl.'/dashboard';?>"><i class="fa fa-dashboard"></i> Home</a></li>
<li class="active">Subscription Transaction</li>
</ol>
</section>



<div class="box box-success">
<div class="box-header">



</div><!-- /.box-header -->
<div class="box-body">



<link rel='stylesheet' href='https://cdn.datatables.net/1.10.9/css/jquery.dataTables.min.css'>

<div class="table-responsive" style="overflow-x:hidden;">
<table class="table table-striped "  class="table table-striped table-bordered dashServ display" id="example" >
<thead>
<tr>
<th  class="text-center">Sr. No</th>
<th  class="text-center">Sr. No</th>
<th  class="text-center">Subscription Name</th>
<th  class="text-center"> Amount</th>
<th class="text-center">Transaction Number</th>
<th class="text-center">Date</th>
<th class="text-center">Expire Date</th>
<th class="text-center">Action</th>
</tr>
</thead>
<tbody>
<?php
$mb = new _spmembership;
$result = $mb->readpid_table($_SESSION['pid']);

//echo $p->ta->sql;
if ($result) {
$i = 1;
while ($row = mysqli_fetch_assoc($result)) {

$res = $mb->readmember($row["membership_id"]);
if($res != false)
{ 
$row1 = mysqli_fetch_assoc($res);

$membership_name= $row1["spMembershipName"];
}

$start=$row['createdon'];
$days=$row['duration'];

$expire=date('Y-m-d', strtotime($start.'+'.$days. 'days'));
//echo "<pre>";
//print_r($row); die("--------------------------");
?><tr>
<td></td>
<td class="text-center "><?php echo $i ;?></td>
<td class="text-center "><span class="smalldot" data-toggle="tooltip" title="<?php echo ucfirst($membership_name); ?>"><?php echo ucfirst($membership_name); ?></span></td>
<td class="text-center "><span class="smalldot"><?php if($row['amount'] == 'By Admin'){echo  ($row['amount']);} else{ echo "USD ".$row['amount']; } ?></span></td>
<td   class="text-center "><span class="smalldot" data-toggle="tooltip" title="<?php echo $row['txn_numberpid']; ?>"><?php echo $row['txn_numberpid']; ?></span></td>

<td class="text-center"> <?php echo $row['createdon']; ?> </td>
<td class="text-center"> <?php echo $expire; ?> </td>
<td>
<!-- <form method="post" action="../../membership/payment_recurring/payment.php">
<input type="hidden" name="sub_id" value="<?= $row['subscriber_id'] ?>">
<input type="hidden" name="id" value="<?= $row['id'] ?>">
<button type="submit" class="btn btn-danger" >Cancel</button>
</form> -->
<!-- <a href="delete.php?id=<?php echo $row['id'] ?>" class="btn btn-danger" >Remove</a> -->
<a  onclick="remove_member('delete.php?id=<?php echo $row['id'] ?>')" class="btn btn-danger" style="<?php if($expire < date('Y-m-d')) { echo "display:none"; }?>" > Remove</a>


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

<!--<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>-->
<!-- <script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js'></script> -->
<script src='https://cdn.datatables.net/1.10.9/js/jquery.dataTables.min.js'></script>







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
});
</script>








<script>
$(function() {
$(':checkbox').checkboxpicker();
});
</script>

<script type="text/javascript">
$(document).ready(function() {
$("body").on("click",".add-more",function(){ 
var html = $(".after-add-more").first().clone();

//  $(html).find(".change").prepend("<label for=''>&nbsp;</label><br/><a class='btn btn-danger remove'>- Remove</a>");

$(html).find(".change").html("<label for=''>&nbsp;</label><br/><a class='btn btn-danger remove'>- Remove</a>");


$(".after-add-more").last().after(html);



});

$("body").on("click",".remove",function(){ 
$(this).parents(".after-add-more").remove();
});
});

</script>
<script type="text/javascript">
$(document).ready(function(){
$(document).on("click",".disable-btn",function() {
var dataId = $(this).attr("data-id");

var work = $(this).attr("data-work");
//alert(work);
if(work=='deactive'){
swal({
title: "Do You Want Deactive this Listing?",
/*text: "You Want to Logout!",*/
type: "warning",
confirmButtonClass: "sweet_ok",
confirmButtonText: "Yes, Deactive!",
cancelButtonClass: "sweet_cancel",
cancelButtonText: "Cancel",
showCancelButton: true,
},
function(isConfirm) {
if (isConfirm) {
window.location.href = '/dashboard/portfolio/delete_port.php?id=' +dataId+'&work='+work;
} 
});

}	
if(work=='delete'){
swal({
title: "Do You Want Delete this Listing?",
/*text: "You Want to Logout!",*/
type: "warning",
confirmButtonClass: "sweet_ok",
confirmButtonText: "Yes, Delete!",
cancelButtonClass: "sweet_cancel",
cancelButtonText: "Cancel",
showCancelButton: true,
},
function(isConfirm) {
if (isConfirm) {
window.location.href = '/dashboard/portfolio/delete_port.php?id=' +dataId+'&work='+work;
} 
});
}	

// alert(dataId);
});
});

// function deactiveProp(propId){ 
//     swal({
//           title: "Do You Want Delete this User?",
//           /*text: "You Want to Logout!",*/
//           type: "warning",
//           confirmButtonClass: "sweet_ok",
//           confirmButtonText: "Yes, Delete!",
//           cancelButtonClass: "sweet_cancel",
//           cancelButtonText: "Cancel",
//           showCancelButton: true,
//         },
//     function(isConfirm) {
//       if (isConfirm) {
//        window.location.href = <?php //echo $BaseUrl.'/real-estate/dashboard/deactivate_post.php?postid='?> + propId;
//       } 
//     });
// }
</script>





<form enctype="multipart/form-data" action="deactivate_port.php" method ="post" >		
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
<h2 class="modal-title" id="UpdatePort">Update Portfolio</h2>
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<div class="modal-body">
<div class="after-add-more">
<div class="row">
<div class="col-md-12">                                
<div class="form-group">
<label class="control-label">Title:</label>
<input maxlength="200" type="text" class="form-control" placeholder="Enter Title" name="spPortname" id="spPortname" />
<input type="hidden" name="portfolio_id" id="portfolio_id" value="">
</div>
</div>
</div>
<div class="row">
<div class="col-md-12">                                
<div class="form-group">
<label class="control-label">Weblink:</label>
<input maxlength="200" type="text" class="form-control" placeholder="Enter Weblink" name="spWeblink"  id="spWeblink"/>
</div>
</div>
</div>
<div class="row">
<div class="col-md-12" id="yourAddresRemove" >
<div class="form-group">
<label for="spProfileAbout" class="control-label">Portfolio Item Description:</label>
<textarea class="form-control" rows="3" name="spPortdes" id="spPortdesf" ></textarea>
</div>	
</div>
</div>

<div class="row">
<div class="col-md-12">
<div class="form-group">
<label class="control-label">Upload File:</label>
<input type="file" class="form-control" name="spPortimg" id="spPortimg"  accept=" image/* " style="display:block;" >
</div>
</div></div>


<br>
</div>
</div>
<div class="modal-footer">
<button type="button" class="btn btn-secondary" data-dismiss="modal" style="background-color: orange; color:white;">Close</button>
<input type="submit" class="btn btn-submit  addprofile db_btn db_primarybtn " name="submit" value="Update">
<!--<button type="button" class="btn btn-primary">Save changes</button>-->
</div>
</div>
</div>
</div>
</form>	



</body> 
</html>
<?php
} ?>



<script>
$( document ).ready(function() {
$(".update-portfolio").on("click", function (event) {

var id = $(this).attr('data-id');
var title = $(this).attr('data-title');
var des = $(this).attr('data-des');
var weblink = $(this).attr('data-weblink');

$("#spPortname").val(title);
$("#spPortdesf").val(des);
$("#portfolio_id").val(id);
$("#spWeblink").val(weblink);



});

});

</script>


<script>
function remove_member(ida){

    swal({
                         
						  title: "Are you sure you want to delete ?",
icon: 'warning',
showCancelButton: true,
confirmButtonColor: '#3085d6',
confirmButtonText: 'Yes',
cancelButtonColor: '#FF0000',
cancelButtonText: 'No',

						},
						  function(isConfirm) {
                  if (isConfirm) {
                   window.location.href =ida;
                  } 
                });

}

</script>
