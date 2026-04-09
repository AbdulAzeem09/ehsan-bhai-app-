<?php

if (!defined('WEB_ROOT')) {
exit;
}
?>
<!-- Content Header (Page header) -->
<section class="content-header">
<h1>Referral User<small>[All User List]</small></h1>
</section>
<!-- Main content -->
<section class="content">




<div class="">
<div class="box box-success">

<div class="box-body">
<div>	
<div>
<div class="table-responsive">
<table id="example1" class="table table-striped table-bordered">
<thead>
<tr>
<th class="text-center" style="width: 50px!important;">ID</th>
<th>Name</th>

<th>Email</th>
<th >Refferal Code</th>
<th >Action</th>


</tr>
</thead>
<tbody>
<?php 
$sql =	"SELECT * FROM spuser WHERE spUserLock != 1";
$result = dbQuery($dbConn, $sql);

while($row = dbFetchAssoc($result)) {
$id=$row['idspUser']; ?> 
<tr> 

<td> <?php echo $row['idspUser']; ?> </td>
<td><a href="../registerdUser/index.php?view=detail&uid=<?php echo $row['idspUser'];?>"><?php echo $row['spUserFirstName']; ?></a></td>
<td> <?php echo $row['spUserEmail']; ?> </td>
<td>
<span id="p1<?php echo $row['idspUser'];?>"><?php echo $row['userrefferalcode']; ?></span>
<i onclick="copyToClipboard('#p1<?php echo $row['idspUser'];?>')" data-placement="left" class="fa fa-clone pull-right" aria-hidden="true" data-toggle="popover"  data-content="Copied!"></i>
</td>
<td>
<a href="<?php echo WEB_ROOT_ADMIN . "registerdUser/index.php?view=referral_user_list&id=".$id ?>" data-original-title="Show Referral User" data-toggle="tooltip" data-placement="top" class="btn menu-icon vd_bg-yellow"><i class="fa fa-eye" aria-hidden="true"></i></a>
</td>



</tr>	
<?php }?>
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