<style>
  .swal-button-container{
    margin-right: 190px;
  }
</style>
</head>
<?php
  include "../../fontawesome.css";
 $result = selectQ("select * from newsletter_unsubscribe","s","");

?>

<!-- Content Header (Page header) -->
<section class="content-header">
<h1>NEWSLETTER<small>[UnSubscribe List]</small></h1>
</section>
<!-- Main content -->
<section class="content">
<?php
// include "add.php";
?>
<div class="box box-success">

<div class="box-body">

<div class="table-responsive" style="overflow-x:hidden;">
<table id="example1" class="table table-bordered table-striped tbl-respon2">
<thead>
<tr>
<th class="text-center" style="width: 80px;" >Id</th>
<th class="text-center">Template Name</th>
<th class="text-center">User Name</th>
<th class="text-center">Email</th>
<th class="text-center">Date Time</th>
<!-- <th class="text-center" >Action</th> -->
</tr>
</thead>
<tbody>
<?php

$i = 1;

foreach($result as $row){
  $id = $row['id'];

  // Get All Data In spnewsletter_template table using temp_id bases
 $temp_id=$row['template_id'];
 $tempdata = selectQ("select * from spnewsletter_template where id=?","s",[$temp_id],"one");

 // Get All Data In spuser table using user_id bases and email
 if($row['user_id']!=="0")
 {
	  $user_id=$row['user_id'];
	  $useriddata = selectQ("select * from spuser where idspUser=?","s",[$user_id],"one");
	  $user_name=$useriddata['spUserName'];
 }
 else
 {
	 $email=$row['email'];
	 $useremaildata = selectQ("select * from spuser where spUserEmail=?","s",[$email],"one");
	 $user_name=$useremaildata['spUserName'];
 }
?>
<tr>
<td class="text-center"><?php echo $i;?></td>
<td class="text-center"><?php echo $tempdata['newsletter_title'];?></td>
<td class="text-center"><?php echo $user_name;?></td>
<td class="text-center"><?php echo $row['email'];?></td>
<td class="text-center"><?php echo $row['date_time'];?></td>

</tr>


<?php
$i++;
}
?>

</tbody>
</table>
</div>
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
} );



} );

</script> 

