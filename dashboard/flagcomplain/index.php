<?php


//error_reporting(E_ALL);
//ini_set('display_errors', '1');


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

$pageactive = 21;
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

div:where(.swal2-container).swal2-center>.swal2-popup {
    height: 297px;
    font-size: 15px;
}



.dataTables_filter	{
margin-bottom:3px;
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

<!-- breadcrumb -->
<!--   <section class="content-header">
<h1>My Selling Product</h1>
<ol class="breadcrumb">
<li><a href="<?php echo $BaseUrl.'/dashboard';?>"><i class="fa fa-dashboard"></i> Home</a></li>
<li class="active">My Selling Product</li>
</ol>
</section>-->



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
<div class="col-md-12 ">

<div class="row">




<div class="col-md-12 ">
<div class="panel with-nav-tabs panel-warning" style=" border-color: #BACCE8;">
<div class="panel-heading" style="padding: 0px!important;background-color: #BACCE8;
border-color: #BACCE8;">
<ul class="nav nav-tabs">
<li class="active " style="background-color:#FF8787;color:black; font-weight:bold"><a href="#tab1warning" style="color:black;" data-toggle="tab">Store</a></li>
<li style="background-color:#9CFF2E;"><a href="#tab2warning"  style="color:black; font-weight:bold"data-toggle="tab">Real-Estate</a></li>
<li style="background-color:orange;"><a href="#tab3warning" style="color:black; font-weight:bold"data-toggle="tab">Art and Craft</a></li>
<li style="background-color:#9ED5C5;color:white"><a href="#tab4warning" style="color:black; font-weight:bold"data-toggle="tab">Videos</a></li>
<li style="background-color:#FFA1CF;"><a href="#tab5warning" style="color:black; font-weight:bold"data-toggle="tab">Services</a></li>
<li style="background-color:#2192FF;"><a href="#tab6warning" style="color:black; font-weight:bold;padding-right: 6px;padding-left: 5px;"data-toggle="tab"> Business for Sale</a></li>  




<li style="background-color:#f3d43d;"><a href="#tab7warning" style="color:black; font-weight:bold"data-toggle="tab"> Job Board</a></li> 
<li style="background-color:#e5ef53;"><a href="#tab8warning" style="color:black; font-weight:bold"data-toggle="tab"> Freelancer</a></li> 
<li style="background-color:#c7d0d9;"><a href="#tab9warning" style="color:black; font-weight:bold"data-toggle="tab"> Event</a></li> 
<li style="background-color:#f5d989;"><a href="#tab10warning" style="color:black; font-weight:bold"data-toggle="tab"> Training</a></li> 



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
<span style="text-align:center;"><h4>Store</h4></span>
<div class="table-responsive">
<table class="table tbl_store_setting display" id="example1" cellspacing="0" width="100%" >
<thead style="background-color:black">
<tr>


<th>Id</th>
<th>Name</th>
<th>Product Title</th>
<th>Flagged Date</th>
<th>Reason</th>
<th>Flag Name</th>
<th>Action</th>

</tr>
</thead>
<tbody>

<?php


$objflag = new _flagpost;
$resultflaf=$objflag->readflag($_SESSION['pid'], 1);
if($resultflaf !=false){ 
while($row222=mysqli_fetch_assoc($resultflaf)){
//print_r($row222);
//die('kkkkk');

?>
<tr>

<td><?php echo $row222['flag_id'] ?></td>
<td><?php 
$result = $row222['spProfile_idspProfile'];


$objpro = new _spprofiles;


$resultp88=$objpro->readname($result);
$row88=mysqli_fetch_assoc($resultp88);



//die('kkkkk');


?>

<a href="<?php echo $BaseUrl.'/friends/?profileid='.$result;?>"><?php echo $row88['spProfileName']; ?></a>
</td>
<?php

$obj = new _spprofiles;

$real11 = $obj->realflagdata($row222['spPosting_idspPosting']); 
if($real11!=false){
$row4 = mysqli_fetch_assoc($real11);
}

$result1 = $obj->readp($row222['spPosting_idspPosting']);
if($result1!=false){
$row3=mysqli_fetch_assoc($result1);
}

// print_r($row3);



?>

<td><a href="<?php echo $BaseUrl.'/retail/detail.php?catid=1&postid='.$row3['idspPostings'];  ?>"> <?php echo $row3['spPostingTitle'];   ?></a></td>




<td><?php echo $row222['flag_date'] ?></td>
<td><?php echo $row222['why_flag'] ?></td>
<td><?php echo $row222['flag_desc'] ?></td>

<td><a class="btn btn-danger btn-border-radius" onclick="permanentDelete('<?php echo $row222['flag_id'];?>')" >Delete</a></td>
</tr>
<?php

}}


?>
</tbody>
</table>
</div>
</div>
</div>
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<!-- <script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js'></script> -->


<script type="text/javascript">

$(document).ready( function () {
var table = $('#example1').DataTable( {

"order": [[ 0, "desc" ]],
pageLength : 10,
lengthMenu: [[10, 20, 50, 100], [10, 20, 50, 100]]
} );



} );

</script>


<div class="tab-pane fade " id="tab2warning">


<link rel='stylesheet' href='https://cdn.datatables.net/1.10.9/css/jquery.dataTables.min.css'>

<style type="text/css">
.paginate_button {
border-radius: 0 !important;
}
</style>
<div class="col-sm-12 no-padding">
<span style="text-align:center;"><h4>Real-Estate</h4></span>
<div class="">
<div class="table-responsive">


<table class="table tbl_store_setting " id="example2" cellspacing="0" width="100%" >
<thead style="background-color:black">
<tr>

<th>Id</th>
<th>Id</th>
<th>Name</th>

<th>Flagged Date</th>
<th>Reason</th>
<th>Flag Name</th>
<th>post title</th>
<th>Action</th>
</tr>
</thead>

<tbody>

<?php
$v = new _flagpost;
$res = $v->readflag($_SESSION['pid'] , 3 ); 
if($res != false){  
while ($row = mysqli_fetch_assoc($res)) {
//print_r($row222);
//die('kkkkk');

?>
<tr>
<td>


</td>
<td><?php echo $row['flag_id'] ?></td>


<td><?php 
$result = $row['spProfile_idspProfile'];


$objpro = new _spprofiles;
$resultp88=$objpro->readname($result);
$row88=mysqli_fetch_assoc($resultp88);
?>
<a href="<?php echo $BaseUrl.'/friends/?profileid='.$result;?>"><?php echo $row88['spProfileName']; ?></a>





</td>	
<td><?php echo $row['flag_date'] ?></td>
<td><?php echo $row['why_flag'] ?></td>
<td><?php echo $row['flag_desc'] ?></td>

<td>
<?php  
$obj = new _spprofiles;

$real11 = $obj->realflagdata($row['spPosting_idspPosting']); 
if($real11!=false){
$row4 = mysqli_fetch_assoc($real11);

$postid=$row['spPosting_idspPosting'];
?>
<a href="<?php echo $BaseUrl.'/real-estate/room-detail.php?postid='.$postid;?>"><?php echo $row4['spPostingTitle'] ?></a>
<?php }else{
echo "Product/Post Removed";
} ?>

</td>
<td><a class="btn btn-danger btn-border-radius" onclick="permanentDelete('<?php echo $row['flag_id'];?>')" >Delete</a></td>
</tr>
<?php

}}


?>
</tbody>
</table>
</div>
</div>
</div>


<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<!-- <script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js'></script> -->


<script type="text/javascript">
$(document).ready(function() {

var table = $('#example2').DataTable({ 
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

</div>
<div class="tab-pane fade " id="tab3warning">


<link rel='stylesheet' href='https://cdn.datatables.net/1.10.9/css/jquery.dataTables.min.css'>

<style type="text/css">
.paginate_button {
border-radius: 0 !important;
}
</style>
<div class="col-sm-12 no-padding">
<span style="text-align:center;"><h4>Art and Craft</h4></span>
<div class="">
<div class="table-responsive">


<table class="table tbl_store_setting display" id="example3" cellspacing="0" width="100%" >
<thead style="background-color:black">
<tr>

<th>Id</th>
<th>Id</th>
<th>Name</th>
<th>Flagged Date</th>
<th>Reason</th>
<th>Flag Name</th>
<th>post title</th>
<th>Action</th>
</tr>


</thead>


<tbody>

<?php 
$objflag = new _flagpost;

$resultflaf=$objflag->readflag($_SESSION['pid'],13);
//die('==gghhhhhg====');
//var_dump($resultflaf);
if($resultflaf !=false){
while($row222=mysqli_fetch_assoc($resultflaf)){
$result = $row222['spProfile_idspProfile'];
//print_r($row222);
//die('kkkkk');

?>
<tr>
<td>


</td>
<td><?php echo $row222['flag_id'] ?></td>


<td><?php 



$objpro = new _spprofiles;
$resultp88=$objpro->readname($result);
//var_dump($resultp88);
$row88=mysqli_fetch_assoc($resultp88);
?>
<a href="<?php echo $BaseUrl.'/friends/?profileid='.$result;?>"><?php echo $row88['spProfileName']; ?></a>

</td>	
<td><?php echo $row222['flag_date'] ?></td>
<td><?php echo $row222['why_flag'] ?></td>
<td><?php echo $row222['flag_desc'] ?></td>

<td>
<?php  
$obj = new _spprofiles;

$artcraft11 = $obj->artcraftflagdata($row222['spPosting_idspPosting']); 
if($artcraft11!=false){
$row_art = mysqli_fetch_assoc($artcraft11);

$postid=$row222['spPosting_idspPosting'];
?>
<a href="<?php echo $BaseUrl.'/artandcraft/detail.php?postid='.$postid;?>"><?php echo $row_art['spPostingTitle'] ?></a>

<?php }else{ echo "Prudoct/Post Removed"; } ?>

</td>
<td><a class="btn btn-danger btn-border-radius" onclick="permanentDelete('<?php echo $row222['flag_id'];?>')" >Delete</a></td>
</tr>
<?php

}
}


?>
</tbody>
</table>
</div>
</div>
</div>


<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<!-- <script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js'></script> -->


<script type="text/javascript">
$(document).ready(function() {

var table = $('#example3').DataTable({ 
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

</div>

<div class="tab-pane fade " id="tab4warning">


<link rel='stylesheet' href='https://cdn.datatables.net/1.10.9/css/jquery.dataTables.min.css'>

<style type="text/css">
.paginate_button {
border-radius: 0 !important;
}
</style>
<div class="col-sm-12 no-padding">
<span style="text-align:center;"><h4>Videos</h4></span>
<div class="">
<div class="table-responsive">


<table class="table tbl_store_setting display" id="example4" cellspacing="0" width="100%" >
<thead style="background-color:black">
<tr>

<th>Id</th>
<th>Id</th>
<th>Name</th>
<th>Flagged Date</th>
<th>Reason</th>
<th>Flag Name</th>
<th>post title</th>
<th>Action</th>
</tr>


</thead>


<tbody>

<?php
$v = new _flagpost;
$res = $v->readflag($_SESSION['pid'] , 10 ); 
if($res != false){  
while ($row = mysqli_fetch_assoc($res)) {
//print_r($row222);
//die('kkkkk');

?>
<tr>
<td>


</td>
<td><?php echo $row['flag_id'] ?></td>


<td><?php 
$result = $row['spProfile_idspProfile'];


$objpro = new _spprofiles;
$resultp88=$objpro->readname($result);
$row88=mysqli_fetch_assoc($resultp88);
?>
<a href="<?php echo $BaseUrl.'/friends/?profileid='.$result;?>"><?php echo $row88['spProfileName']; ?></a>





</td>	
<td><?php echo $row['flag_date'] ?></td>
<td><?php echo $row['why_flag'] ?></td>
<td><?php echo $row['flag_desc'] ?></td>
<td>
<?php  
$obj = new _spprofiles;

$video11 = $obj->videoflagdata($row['spPosting_idspPosting']); 
if($video11!=false){
$row99 = mysqli_fetch_assoc($video11);

$postid=$row['spPosting_idspPosting'];
?>
<a href="<?php echo $BaseUrl.'/videos/watch.php?video_id='.$postid;?>"><?php echo $row99['video_title'] ?></a>
<?php }else{ echo "Prudoct/Post Removed"; } ?>

</td>
<td><a class="btn btn-danger btn-border-radius" onclick="permanentDelete('<?php echo $row['flag_id'];?>')" >Delete</a></td>
</tr>
<?php

}}


?>
</tbody>
</table>
</div>
</div>
</div>


<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<!-- <script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js'></script> -->


<script type="text/javascript">
$(document).ready(function() {

var table = $('#example4').DataTable({ 
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

</div>


<div class="tab-pane fade " id="tab5warning">


<link rel='stylesheet' href='https://cdn.datatables.net/1.10.9/css/jquery.dataTables.min.css'>

<style type="text/css">
.paginate_button {
border-radius: 0 !important;
}
</style>
<div class="col-sm-12 no-padding">
<span style="text-align:center;"><h4>Services</h4></span>
<div class="">
<div class="table-responsive">


<table class="table tbl_store_setting display" id="example7" cellspacing="0" width="100%" >
<thead style="background-color:black">
<tr>


<th class="text-center">ID</th>
<th class="text-center">Name</th>
<th class="text-center">Flagged Date</th>

<th class="text-center">Reason</th>

<th class="text-center">Flag Name</th>
<th>post title</th>
<th>Action</th>
</tr>


</thead>


<tbody>


<?php
$catid=7;
$fl= new _flagpost;
$res= $fl->myflagPost(7,$_SESSION['pid']);
// print_r($res);die;
$p      = new _classified;

$i = 1;
if($res != false){
while ($row = mysqli_fetch_assoc($res)) { 
?>
<tr>

<td>
<?php 

$res1   = $p->myposted_service($_SESSION['pid']);

if($res1 != false){
$row1=mysqli_fetch_assoc($res1);



?>

<a href="<?php echo $BaseUrl.'/services/detail.php?postid='.$row1['idspPostings'];?>"><?php echo ucfirst($row1['spPostingTitle']); ?></a>
<?php

}
?>

</td>
<td><a href="<?php echo $BaseUrl.'/services/detail.php?postid='.$row['idspPostings'];?>"><?php echo $row['spPosting_idspPosting']; ?></a>
</td>
<td class="text-center"><?php echo $row['flag_date']; ?></td>
<td class="text-center"><?php echo $row['flag_desc']?></td>
<td class="text-center"><?php echo $row['why_flag']; ?></td>
taser
<td>
<?php  
$obj = new _spprofiles;

$service11 = $obj->servicesflagdata($row['spPosting_idspPosting']); 
if($service11!=false){
$row_ser = mysqli_fetch_assoc($service11);

$postid=$row['spPosting_idspPosting'];
?>
<a href="<?php echo $BaseUrl.'/services/detail.php?postid='.$postid;?>"><?php echo $row_ser['spPostingTitle'] ?></a>
<?php }else{ echo "Prudoct/Post Removed"; } ?>


</td>
<td><a class="btn btn-danger btn-border-radius" onclick="permanentDelete('<?php echo $row['flag_id'];?>')" >Delete</a></td>

</tr>

<?php

}
}
?>


</tbody>
</table>
</div>
</div>
</div>


<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<!-- <script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js'></script> -->


<script type="text/javascript">
$(document).ready(function() {

var table = $('#example7').DataTable({ 
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

</div>

<div class="tab-pane fade " id="tab6warning">

<link rel='stylesheet' href='https://cdn.datatables.net/1.10.9/css/jquery.dataTables.min.css'>

<style type="text/css">
.paginate_button {
border-radius: 0 !important;
}
</style>
<div class="col-sm-12 no-padding">
<span style="text-align:center;"><h4>Business for Sales</h4></span>
<div class="">
<div class="table-responsive">


<table class="table tbl_store_setting display" id="example8" cellspacing="0" width="100%" >
<thead style="background-color:black">
<tr>
<th class="text-center">ID</th>
<th class="text-center">ID</th>
<!-- <th class="text-center">Name</th> -->
<th class="text-center">Flagged Date</th>
<th class="text-center">Reason</th>
<th class="text-center">Flag Name</th>
<th class="text-center">post title</th>
<th>Action</th>
</tr>
</thead>


<tbody>


<?php
$catid=20;
$fl= new _flagpost;
$res_b= $fl->myflagPost_b(20,$_SESSION['pid']);
//print_r($res_b);die('===');


$i = 1;
if($res_b != false){
while ($row_b = mysqli_fetch_assoc($res_b)){
//print_r($row_b);
//die('==');
$postid=$row_b['spPosting_idspPosting'];
//echo $postid;
//die('===');
?>
<tr>


<?php 
$p = new _businessrating;						
$res1_b= $p->myposted_service_b($postid);
// print_r($res1_b);
//die('==');

if($res1_b){

$row1_b=mysqli_fetch_assoc($res1_b);
//print_r($row1_b);
//die('==');
}

?>
<td class="text-center"> 		
<?php echo $postid; ?>
</td>      
<td class="text-center"> 		
<?php echo $postid; ?>
</td>
<?php


?>

<!-- <td><a href="<?php echo $BaseUrl.'/business_for_sale/business_detail.php?postid='.$row_b['idspbusiness'];?>"><?php echo ucfirst($row1_b['listing_headline']); ?></a>
</td> -->
<td class="text-center"><?php echo $row_b['flag_date']; ?></td>
<td class="text-center"><?php echo $row_b['flag_desc']?></td>
<td class="text-center"><?php echo $row_b['why_flag']; ?></td>


<td>
<?php  
$obj = new _spprofiles;

$business11 = $obj->businessflagdata($row_b['spPosting_idspPosting']); 
if($business11!=false){
$row_bus = mysqli_fetch_assoc($business11);

$postid= $row_b['spPosting_idspPosting'];
?>
<a href="<?php echo $BaseUrl.'/business_for_sale/business_detail.php?postid='.$postid;?>"><?php echo $row_bus['listing_headline'] ?></a>
<?php }else{ echo "Prudoct/Post Removed"; } ?>

</td>
<td><a class="btn btn-danger btn-border-radius" onclick="permanentDelete('<?php echo $row_b['flag_id'];?>')" >Delete</a></td>
</tr>

<?php

}
}
?>


</tbody>
</table>
</div>
</div>
</div>


<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<!-- <script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js'></script> -->


<script type="text/javascript">
$(document).ready(function() {

var table = $('#example8').DataTable({ 
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

</div>


<div class="tab-pane fade " id="tab7warning">

<link rel='stylesheet' href='https://cdn.datatables.net/1.10.9/css/jquery.dataTables.min.css'>

<style type="text/css">
.paginate_button {
border-radius: 0 !important;
}
</style>
<div class="col-sm-12 no-padding">
<span style="text-align:center;"><h4>Job Board</h4></span>
<div class="">
<div class="table-responsive">


<table class="table tbl_store_setting display" id="example9" cellspacing="0" width="100%" >
<thead style="background-color:black">
<tr>
<th class="text-center">ID</th>
<th class="text-center">ID</th>
<!-- <th class="text-center">Name</th> -->
<th class="text-center">Flagged Date</th>
<th class="text-center">Reason</th>
<th class="text-center">Flag Name</th>
<th class="text-center">post title</th>
<th>Action</th>
</tr>
</thead>


<tbody>


<?php
$catid=20;
$fl= new _flagpost;
$res_b= $fl->myflagPost_jobbard(2,$_SESSION['pid']);
//print_r($res_b);die('===');


$i = 1;
if($res_b != false){
while ($row_b = mysqli_fetch_assoc($res_b)){
//print_r($row_b);
//die('==');
$postid=$row_b['spPosting_idspPosting'];
//echo $postid;
//die('===');
?>
<tr>


<?php 
$p = new _businessrating;						
$res1_b= $p->myposted_service_b($postid);
// print_r($res1_b);
//die('==');

if($res1_b){

$row1_b=mysqli_fetch_assoc($res1_b);
//print_r($row1_b);
//die('==');
}

?>
<td class="text-center"> 		
<?php echo $postid; ?>
</td>      
<td class="text-center"> 		
<?php echo $postid; ?>
</td>
<?php


?>

<!-- <td><a href="<?php echo $BaseUrl.'/job-board/dashboard/applicant.php?postid='.$postid;?>"><?php echo ucfirst($row1_b['listing_headline']); ?></a>
</td> -->
<td class="text-center"><?php echo $row_b['flag_date']; ?></td>
<td class="text-center"><?php echo $row_b['flag_desc']?></td>
<td class="text-center"><?php echo $row_b['why_flag']; ?></td>


<td>
<?php  
$obj = new _spprofiles;

$jobboard11 = $obj->jobboardflagdata($row_b['spPosting_idspPosting']); 
if($jobboard11!=false){
$row_job = mysqli_fetch_assoc($jobboard11);

$postid= $row_b['spPosting_idspPosting'];
?>
<a href="<?php echo $BaseUrl.'/job-board/job-detail.php?postid='.$postid;?>"><?php echo $row_job['spPostingTitle'] ?></a>
<?php }else{ echo "Prudoct/Post Removed"; } ?>

</td>
<td><a class="btn btn-danger btn-border-radius" onclick="permanentDelete('<?php echo $row_b['flag_id'];?>')" >Delete</a></td>
</tr>

<?php

}
}
?>


</tbody>
</table>
</div>
</div>
</div>


<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<!-- <script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js'></script> -->


<script type="text/javascript">
$(document).ready(function() {

var table = $('#example9').DataTable({ 
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

</div>

<div class="tab-pane fade " id="tab8warning">

<link rel='stylesheet' href='https://cdn.datatables.net/1.10.9/css/jquery.dataTables.min.css'>

<style type="text/css">
.paginate_button {
border-radius: 0 !important;
}
</style>
<div class="col-sm-12 no-padding">
<span style="text-align:center;"><h4>Freelancer</h4></span>
<div class="">
<div class="table-responsive">


<table class="table tbl_store_setting display" id="example10" cellspacing="0" width="100%" >
<thead style="background-color:black">
<tr>
<th class="text-center">ID</th>
<th class="text-center">ID</th>
<!-- <th class="text-center">Name</th> -->
<th class="text-center">Flagged Date</th>
<th class="text-center">Reason</th>
<th class="text-center">Flag Name</th>
<th class="text-center">post title</th>
<th>Action</th>
</tr>
</thead>


<tbody>


<?php
$catid=20;
$fl= new _flagpost;
$res_b= $fl->myflagPost_frelance(5,$_SESSION['pid']);
//print_r($res_b);die('===');


$i = 1;
if($res_b != false){
while ($row_b = mysqli_fetch_assoc($res_b)){
//print_r($row_b);
//die('==');
$postid=$row_b['spPosting_idspPosting'];
//echo $postid;
//die('===');
?>
<tr>


<?php 
$p = new _businessrating;						
$res1_b= $p->myposted_service_b($postid);
// print_r($res1_b);
//die('==');

if($res1_b){

$row1_b=mysqli_fetch_assoc($res1_b);
//print_r($row1_b);
//die('==');
}

?>
<td class="text-center"> 		
<?php echo $postid; ?>
</td>      
<td class="text-center"> 		
<?php echo $postid; ?>
</td>
<?php


?>
<!-- 
<td><a href="<?php echo $BaseUrl.'/freelancer/project-detail.php?project='.$postid;?>"><?php echo ucfirst($row1_b['listing_headline']); ?></a>
</td> -->
<td class="text-center"><?php echo $row_b['flag_date']; ?></td>
<td class="text-center"><?php echo $row_b['flag_desc']?></td>
<td class="text-center"><?php echo $row_b['why_flag']; ?></td>


<td>
<?php  
$obj = new _spprofiles;

$freelancer11 = $obj->freelancerflagdata($row_b['spPosting_idspPosting']); 
if($freelancer11!=false){
$row_freelancer = mysqli_fetch_assoc($freelancer11);

$postid= $row_b['spPosting_idspPosting'];
?>
<a href="<?php echo $BaseUrl.'/freelancer/project-detail.php?project='.$postid;?>"><?php echo $row_freelancer['spPostingTitle'] ?></a>
<?php }else{ echo "Prudoct/Post Removed"; } ?>

</td>

<td><a class="btn btn-danger btn-border-radius" onclick="permanentDelete('<?php echo $row_b['flag_id'];?>')" >Delete</a></td>
</tr>

<?php

}
}
?>


</tbody>
</table>
</div>
</div>
</div>


<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<!-- <script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js'></script> -->


<script type="text/javascript">
$(document).ready(function() {

var table = $('#example10').DataTable({ 
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

</div>			


<div class="tab-pane fade " id="tab9warning">

<link rel='stylesheet' href='https://cdn.datatables.net/1.10.9/css/jquery.dataTables.min.css'>

<style type="text/css">
.paginate_button {
border-radius: 0 !important;
}
</style>
<div class="col-sm-12 no-padding">
<span style="text-align:center;"><h4>Event</h4></span>
<div class="">
<div class="table-responsive">


<table class="table tbl_store_setting display" id="example11" cellspacing="0" width="100%" >
<thead style="background-color:black">
<tr>
<th class="text-center">ID</th>
<th class="text-center">ID</th>
<!-- <th class="text-center">Name</th> -->
<th class="text-center">Flagged Date</th>
<th class="text-center">Reason</th>
<th class="text-center">Flag Name</th>
<th class="text-center">post title</th>
<th>Action</th>
</tr>
</thead>


<tbody>


<?php
$catid=20;
$fl= new _flagpost;
$res_b= $fl->myflagPost_event(9,$_SESSION['pid']);
//print_r($res_b);die('===');


$i = 1;
if($res_b != false){
while ($row_b = mysqli_fetch_assoc($res_b)){
//print_r($row_b);
//die('==');
$postid=$row_b['spPosting_idspPosting'];
//echo $postid;
//die('===');
?>
<tr>


<?php 
$p = new _businessrating;						
$res1_b= $p->myposted_service_b($postid);
// print_r($res1_b);
//die('==');

if($res1_b){

$row1_b=mysqli_fetch_assoc($res1_b);
//print_r($row1_b);
//die('==');
}

?>
<td class="text-center"> 		
<?php echo $postid; ?>
</td>      
<td class="text-center"> 		
<?php echo $postid; ?>
</td>
<?php


?>

<!-- <td><a href="<?php echo $BaseUrl.'/events/event-detail.php?postid='.$postid;?>"><?php echo ucfirst($row1_b['listing_headline']); ?></a>
</td> -->
<td class="text-center"><?php echo $row_b['flag_date']; ?></td>
<td class="text-center"><?php echo $row_b['flag_desc']?></td>
<td class="text-center"><?php echo $row_b['why_flag']; ?></td>


<td>
<?php  
$obj = new _spprofiles;

$event11 = $obj->eventflagdata($row_b['spPosting_idspPosting']); 
if($event11!=false){
$row_event = mysqli_fetch_assoc($event11);

$postid= $row_b['spPosting_idspPosting'];
?>
<a href="<?php echo $BaseUrl.'/events/event-detail.php?postid='.$postid;?>"><?php echo $row_event['spPostingTitle'] ?></a>
<?php }else{ echo "Prudoct/Post Removed"; } ?>

</td>
<td><a class="btn btn-danger btn-border-radius" onclick="permanentDelete('<?php echo $row_b['flag_id'];?>')" >Delete</a></td>
</tr>

<?php

}
}
?>


</tbody>
</table>
</div>
</div>
</div>


<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<!-- <script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js'></script> -->


<script type="text/javascript">
$(document).ready(function() {

var table = $('#example11').DataTable({ 
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

</div>



<div class="tab-pane fade " id="tab10warning">

<link rel='stylesheet' href='https://cdn.datatables.net/1.10.9/css/jquery.dataTables.min.css'>

<style type="text/css">
.paginate_button {
border-radius: 0 !important;
}
</style>
<div class="col-sm-12 no-padding">
<span style="text-align:center;"><h4>Training</h4></span>
<div class="">
<div class="table-responsive">


<table class="table tbl_store_setting display" id="example12" cellspacing="0" width="100%" >
<thead style="background-color:black">
<tr>
<th class="text-center">ID</th>
<th class="text-center">ID</th>
<!-- <th class="text-center">Name</th> -->
<th class="text-center">Flagged Date</th>
<th class="text-center">Reason</th>
<th class="text-center">Flag Name</th>
<th class="text-center">post title</th>
<th>Action</th>
</tr>
</thead>


<tbody>


<?php
$catid=20;
$fl= new _flagpost;
$res_b= $fl->myflagPost_training(8,$_SESSION['pid']);
//print_r($res_b);die('===');


$i = 1;
if($res_b != false){
while ($row_b = mysqli_fetch_assoc($res_b)){
//print_r($row_b);
//die('==');
$postid=$row_b['spPosting_idspPosting'];
//echo $postid;
//die('===');
?>
<tr>


<?php 
$p = new _businessrating;						
$res1_b= $p->myposted_service_b($postid);
// print_r($res1_b);
//die('==');

if($res1_b){

$row1_b=mysqli_fetch_assoc($res1_b);
//print_r($row1_b);
//die('==');
}

?>
<td class="text-center"> 		
<?php echo $postid; ?>
</td>      
<td class="text-center"> 		
<?php echo $postid; ?>
</td>
<?php


?>

<!-- <td>
<a href="<?php echo $BaseUrl.'/trainings/detail.php?postid='.$postid;?>"><?php echo ucfirst($row1_b['listing_headline']); ?></a>
</td> -->
<td class="text-center"><?php echo $row_b['flag_date']; ?></td>
<td class="text-center"><?php echo $row_b['flag_desc']?></td>
<td class="text-center"><?php echo $row_b['why_flag']; ?></td>


<td>
<?php  
$obj = new _spprofiles;

$training11 = $obj->trainingflagdata($row_b['spPosting_idspPosting']); 
if($training11!=false){
$row_training = mysqli_fetch_assoc($training11);

$postid= $row_b['spPosting_idspPosting'];
?>
<a href="<?php echo $BaseUrl.'/trainings/detail.php?postid='.$postid;?>"><?php echo $row_training['spPostingTitle'] ?></a>
<?php }else{ echo "Prudoct/Post Removed"; } ?>

</td>
<td><a class="btn btn-danger btn-border-radius" onclick="permanentDelete('<?php echo $row_b['flag_id'];?>')" >Delete</a></td>
</tr>

<?php

}
}
?>


</tbody>
</table>
</div>
</div>
</div>


<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<!-- <script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js'></script> -->


<script type="text/javascript">
$(document).ready(function() {

var table = $('#example12').DataTable({ 
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

</div>






</div>
</div>
</div>
</div>



















<!-- new design -->
<!--  <div class="col-md-12 ">
<div class="store_detailcenter_1 bg_white">
<div class="row">
<div class="col-md-4">
<h3 class="eventcapitalize">My Order History</h3>
</div>

</div>

<?php   $p = new _orderSuccess;
$or = new _order; 
$result = $p->readmyOrder($_SESSION['pid']);
//   echo $p->ta->sql;
// print_r($result);

if ($result) {
$i = 1;
while ($row = mysqli_fetch_assoc($result)) {
extract($row);
$dt = new DateTime($payment_date);


$result2 = $or->readOrderTxn($txn_id, $_SESSION['pid']);



// echo $or->ta->sql;
if ($result2) {

while ($row2 = mysqli_fetch_assoc($result2)) {

// print_r($row2);


$buyerprofilid = $row2['spByuerProfileId'];

$sellerprofilid = $row2['spSellerProfileId'];
$sellpostid = $row2["idspPostings"];

$idspOrder = $row2["idspOrder"];



$spOrderQty = $row2['spOrderQty'];

$sp = new _spprofiles;

$spbuyresult  = $sp->read($buyerprofilid);
if($spbuyresult != false)
{
$buyrow = mysqli_fetch_assoc($spbuyresult);
$buyername = $buyrow["spProfileName"];



}



$pp = new _productpic;  

$sellpic = $pp->read($sellpostid);
// echo $pp->ta->sql;
if($sellpic != false){

$sellrowpic = mysqli_fetch_assoc($sellpic);

$sellProductimg   = $sellrowpic['spPostingPic'];



}         

?>

<div class="row">
<div class="col-md-12" style="margin-top: 15px;">
<div class="panel with-nav-tabs panel-info">
<div class="panel-heading" style="padding: 22px 10px;">
<ul class="nav nav-tabs">
<div class="col-md-3">
<li class="active">Order Placed  <br>
<?php echo $dt->format('d-M-Y'); ?></li>
</div>

<div class="col-md-3">
<li>TOTAL <br>
<?php echo'$'. $amount; ?>
</li>
</div>

<div class="col-md-3">
<li class="eventcapitalize">SHIP TO  <br>
<?php echo $buyername;?></li>
</div>

<div class="col-md-3">
<li>ORDER <?php echo $txn_id; ?><br>

</div>


</ul>
</div>
<div class="panel-body">
<div class="tab-content">
<div class="row" style="margin-top: 30px;margin-bottom: 20px;">
<div class="col-md-8">


<div class="col-md-4"> 
<?php  
if ($sellProductimg) {
echo "<img alt='Posting Pic' class='img-responsive' src=' " . ($sellProductimg) . "' style='height: 130px;' >";

}else{
echo "<img alt='Posting Pic' src='../../assets/images/blank-img/no-store.png' class='img-responsive' style='height: 130px;'>";
}



?>
</div>
<div class="col-md-8">

</div>
</div>

<div class="col-md-4">
<a href="<?php echo $BaseUrl.'/store/dashboard/my_orderhistory.php';?>" class="btn btntrackorder">Order Detail</a>



<a href="<?php echo $BaseUrl.'/store/dashboard/invoice.php?order='.$cid?>" class="btn btnwithorder">Invoice</a>

</div>
</div>   


</div>
</div>
</div>
</div>
</div>

<?php

}
}
}
}else{  ?>

<center><div style='min-height: 300px; font-size: 16px; padding-top: 100px;' >No Record Found</div></center>



<?php }  ?>



</div>   
</div> -->

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

<!--<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
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
<button type="button" class="btn btn-danger btn-border-radius" data-dismiss="modal" style="background-color: orange; color:white;">Close</button>
<input type="submit" class="btn btn-submit  addprofile db_btn db_primarybtn btn-border-radius" name="submit" value="Update">
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


<div class="container">

<!-- Trigger the modal with a button -->
<!-- <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Open Modal</button> -->

<!-- Modal -->
<div class="modal fade" id="myModal" role="dialog">
<div class="modal-dialog">

<!-- Modal content-->
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal">&times;</button>
<h4 class="modal-title">Transaction Details</h4>
</div>
<ul style=font-size:20px;>
<!--li>Username :<span id="Username" >Username</span></li-->
<li>Bank Name : <span id="Bank" >Username</span></li>
<li>Amount : <span id="Amount" >Username</span></li>
<li>Bank code : <span id="Bank_code" >Username</span></li>
<li>Branch no. : <span id="Branch_no" >Username</span></li>
<li>A/C no. : <span id="Acountno" >Username</span></li>
<li>IFSC code : <span id="IFSC_code" >Username</span></li>
<li>Requested Date : <span id="Date" >Username</span></li>
<!--<li>Status : <span id="Status" >Username</span></li> -->

</ul>

<div class="modal-footer">
<button type="button" class="btn btn-danger btn-border-radius" data-dismiss="modal">Close</button>
</div>
</div>

</div>
</div>

</div>
<script>





$(document).ready(function() {
$(".alert2").click(function(event) {
var  username = $(this).attr("data-username");
var  bank = $(this).attr("data-bank");
var  Amount = $(this).attr("data-Amount");
var  bank_code = $(this).attr("bank_code");
var  Branch_number = $(this).attr("Branch_number");
var  Acountno = $(this).attr("acountno");
var  IFSC_code = $(this).attr("IFSC_code");
var  Date = $(this).attr("Date");
//var  status = $(this).attr("status");





$("#Username").html(username);
$("#Bank").html(bank);
$("#Amount").html(Amount);
$("#Bank_code").html(bank_code);
$("#Branch_no").html(Branch_number);
$("#Acountno").html(Acountno);
$("#IFSC_code").html(IFSC_code);
$("#Date").html(Date);
//$("#Status").html(status);


});
});
</script>
<script src='<?php echo $baseurl?>/assets/js/sweetalert.js'></script>
<script>
function permanentDelete(userId) {

Swal.fire({
title: 'Are You Sure You Want to Delete?',
text: "",
icon: 'warning',
showCancelButton: true,
confirmButtonColor: '#3085d6',
cancelButtonColor: '#d33',
cancelButtonText: 'No',
confirmButtonText: 'Yes'
}).then((result) => {
if (result.isConfirmed) {
window.location.href = 'delete.php?flid=' +userId;
} 
});
}
</script>
