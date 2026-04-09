<?php
if (!defined('WEB_ROOT')) {
exit;
}
$rowsPerPage = 25;



$order =$_GET['id'];
$sql = "SELECT * FROM spuser where idspUser= $order";

$result = dbQuery($dbConn, $sql);

if ($result){
		
			$i = 1;
		
		if($result !="false"){
		$row = dbFetchAssoc($result);
			extract($row);
		
			$ref_code=$row['userrefferalcode'];

?>

<!-- Content Header (Page header) -->
<section class="content-header">
<h1>User From <b><?php echo $row['spUserName'];?></b> Referral Code</h1>
</section>
<!-- Main content -->
<section class="content">




<div class="">
<div class="box box-success">

<div class="box-body">
<div>


<div class="space"></div>
								

</div>
<div>


<div class="space"></div>
							

</div>



<div class="table-responsive">
<table id="example1" class="table table-striped table-bordered">
<thead>
<tr>
	<th class="text-center" style="width: 50px!important;">ID</th>
	<th class="text-center">Name</th>
	
	
	
	<th class="text-center">Email</th>
	
	
	
	
	<th class="text-center">Registration On</th>
	
	<th class="text-center">Profile Count</th>
	
</tr>
</thead>
<tbody>
<?php

	
$sql1= 	"SELECT * FROM spuser where refferalcodeused = '$ref_code' ORDER BY idspUser ASC ";	
//echo $sql1;
$result1 = dbQuery($dbConn, $sql1);
if($result1){
while($rrr=dbFetchAssoc($result1)){
$spuser_id=$rrr['idspUser'];
$sql2= "SELECT * FROM spproduct where spuser_idspuser = $spuser_id  ";

$result2 = dbQuery($dbConn, $sql2);
if($result2!=false){
$r2=$result2->num_rows;
}
$sql74= "SELECT * FROM spprofiles where spUser_idspUser = $spuser_id  ";
$result74 = dbQuery($dbConn, $sql74);
$count=$result74->num_rows;

// $sql3= "SELECT * FROM spfreelancer where spuser_idspuser = $spuser_id  ";
// $result3 = dbQuery($dbConn, $sql3);
// if($result3!=false){
// $r3=$result3->num_rows;
// }
// $sql4= "SELECT * FROM spjobboard where spuser_idspuser = $spuser_id  ";
// $result4 = dbQuery($dbConn, $sql4);
// if($result4!=false){
// $r4=$result4->num_rows;
// }
// $sql5= "SELECT * FROM sprealstate where spuser_idspuser = $spuser_id  ";
// $result5 = dbQuery($dbConn, $sql5);
// if($result5!=false){
// $r5=$result5->num_rows;
// }
// $sql6= "SELECT * FROM sppostingsartcraft where spuser_idspuser = $spuser_id  ";
// $result6 = dbQuery($dbConn, $sql6);
// if($result6!=false){
// $r6=$result6->num_rows;
// }
// $count= $r2+$r3+$r4+$r5+$r6;

			//$postDate = strtotime($spUserRegDate);
			
			//echo "<pre>";
			//print_r($row);
			
			?>
			<tr>
				<td class="text-center"><?php echo $i++;?></td>
				<td class="text-center"><a href="javascript:userDetail(<?php echo $spuser_id; ?>)"><?php echo $rrr['spUserName']; ?></a></td>
				
				
				
				<td class="text-center"><?php echo $rrr['spUserEmail']; ?></td>
				
				<!--<td class="text-center"><?php echo ($is_email_verify == 1)?'&#10004;':'&#10008;';?></td>-->
				
				<!--<td class="text-center"><?php echo ($is_phone_verify == 1)?'&#10004;':'&#10008;';?></td>-->
				
				<!--<td><?php
				
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
						
				</td>-->
				
				<!--<td><?php echo $spUserIpLastLogin; ?></td>
				<td class="text-center"><?php totalUserProfile($dbConn, $idspUser);?></td>-->
				<td class="text-center"><?php echo $rrr['spUserRegDate'];?></td>
				<td class="text-center"><?php echo $count;?></td>
				
				<!--<td class="text-center menu-action" style="width: 120px !important;">
					<?php
					if ($spUserLock == 1) { ?>
						<a href="javascript:userunlock(<?php echo $idspUser;?>)" data-original-title="Un-lock" data-toggle="tooltip" data-placement="top" class="btn menu-icon vd_bg-green"><i class="fa fa-unlock"></i></a>&nbsp; <?php
					}else{ ?>
						<a href="javascript:userlock(<?php echo $idspUser;?>)" data-original-title="Block" data-toggle="tooltip" data-placement="top" class="btn menu-icon vd_bg-green"><i class="fa fa-lock"></i></a>&nbsp; <?php
					}
					?>
					
					
					<a href="javascript:userDetail(<?php echo $idspUser; ?>)" data-original-title="Detail" data-toggle="tooltip" data-placement="top" class="btn menu-icon vd_bg-yellow"><i class="fa fa-info"></i></a>
				
					<a href="javascript:deleteRegUser(<?php echo $idspUser; ?>)" data-original-title="Delete" data-toggle="tooltip" data-placement="top" class="btn menu-icon vd_bg-red"><i class="fa fa-trash"></i></a>

					<input type="checkbox" class="sdelete" name="sdelete[]" id="sdelete" value="<?php echo $idspUser; ?>">
				</td>-->
				
			</tr><?php
		}}
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
"order": [[ 0, "asc" ]],
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
swal({
title: "Do You Want Delete this All?",
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
