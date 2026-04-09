<?php


/*error_reporting(E_ALL);
ini_set('display_errors', '1');*/


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

$pageactive = 74;      
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

body {
	font-family: 'Roboto', sans-serif;
	font-size: 14px;
	line-height: 18px;
	background: #f4f4f4;
}

.list-wrapper {
	padding: 15px;
	overflow: hidden;
}

.list-item {
	border: 1px solid #EEE;
	background: #FFF;
	margin-bottom: 10px;
	padding: 10px;
	box-shadow: 0px 0px 10px 0px #EEE;
}

.list-item h4 {
	color: #FF7182;
	font-size: 18px;
	margin: 0 0 5px;	
}

.list-item p {
	margin: 0;
}

.simple-pagination ul {
	margin: 0 0 20px;
	padding: 0;
	list-style: none;
	text-align: center;
}

.simple-pagination li {
	display: inline-block;
	margin-right: 5px;
}

.simple-pagination li a,
.simple-pagination li span {
	color: #666;
	padding: 5px 10px;
	text-decoration: none;
	border: 1px solid #EEE;
	background-color: #FFF;
	box-shadow: 0px 0px 10px 0px #EEE;
}

.simple-pagination .current {
	color: #FFF;
	background-color: #e7a0ff;
	border-color:  #cf2deb;
}

.simple-pagination .prev.current,
.simple-pagination .next.current {
	background: #cf2deb;
}






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
<h2 style="margin-top: 0px!important;">Media Files</h2><h5>THESE PROMOTIONAL MATERIALS ARE FOR YOU TO DOWNLOAD OR SHARE WITH YOUR CONTACTS, TO INCREASE YOUR PASSIVE REFERRAL INCOME!
</h5>
<div class="panel with-nav-tabs panel-warning" style=" border-color: #BACCE8;">

<div class="row list-wrapper">
<?php 
$ps44 = new _pos;
$reshps44 = $ps44->shan_74(); 
while($row666=mysqli_fetch_assoc($reshps44)){
    $img=$row666['file']; 

    $media_name=$row666['media_name']; 
    $img_id=$row666['id'];
 
    $fav=new _spPoints;
$fav_exist=$fav->read_fav($img_id,$_SESSION['uid']); 
   
    ?>
<div class="col-md-4 list-item" style="padding: 25px;">
<a href="<?php echo $BaseUrl;?>/upload/<?php echo $img;?>" download><img src="<?php echo $BaseUrl;?>/upload/<?php echo $img;?>" style="border: 1px solid #978b8b; padding: 10px;" alt="Girl in a jacket" width="300" height="300" > <i class="fa fa-download" aria-hidden="true" title="Click to Download the Image" style="font-size:20px; float:right; margin-right:30px; margin-top: 10px;"></i></a>

<span class="pull-right" style=" margin: 5px 11px;">  <?php echo  $media_name; ?></span>

<?php if($fav_exist) { ?>
<!-- <a href="<?php echo $BaseUrl;?>/dashboard/add_media/unfavorite.php?id=<?php echo $img_id; ?>"><i class="fa fa-heart heart11" aria-hidden="true"   style="font-size: 20px; margin-left: 220px;" data-toggle="tooltip" title="Remove To Favorite"></i>

</a> --></div>
<?php } else{ ?>
    

    <!-- <a href="<?php echo $BaseUrl;?>/dashboard/add_media/favorite.php?id=<?php echo $img_id; ?>"><i class="fa fa-heart-o heart11" aria-hidden="true"  style="font-size: 20px; margin-left: 220px;" data-toggle="tooltip" title="Add To My Favorite"></i>
 
</a> --></div>

<?php 
}


 }

?>
</div>
<div id="pagination-container"></div>
<div class="panel-body">
<div class="tab-content">
<!--<div class="tab-pane fade in active" id="tab1warning">  

<link rel='stylesheet' href='https://cdn.datatables.net/1.10.9/css/jquery.dataTables.min.css'>

<style type="text/css">
.paginate_button {
border-radius: 0 !important;
}
</style>

<div class="col-md-12 no-padding">
<span style="text-align:center;"><h4>SpPoint</h4></span>
<div class="table-responsive">
<table class="table tbl_store_setting display" id="example1" cellspacing="0" width="100%" >
<thead>
<tr>

<th></th>          
<th>Id</th>
<th>SpPoints</th>
<th>Amount</th>
<th>Comments</th>
<th>Transaction Date</th>
</tr>
</thead>
<tbody>

<?php


$objpoint = new _spPoints;
$result=$objpoint->readpoint_all($_SESSION['uid']);
//echo $_SESSION['pid'].'====55';
//print_r($result);die('==');
if($result !=false){ 
$i=1;
while($row222=mysqli_fetch_assoc($result)){
$amount=$row222['pointAmount']/100;

//print_r($row222);
//die('kkkkk');

?>
<tr>
<td>


</td>
<td><?php echo $i; ?></td>
<td><?php echo $row222['pointAmount'] ?></td>
<td><?php echo 'USD '.$amount ?></td>

<td><?php echo $row222['spPointComment'] ?></td>
<td><?php echo $row222['pointDate'] ?></td>

</tr>
<?php
$i++;

}}


?>
</tbody>
</table>
</div>
</div>
</div>-->
<!--<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>-->
<!-- <script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js'></script> -->
<script src='https://cdn.datatables.net/1.10.9/js/jquery.dataTables.min.js'></script>

<script type="text/javascript">
$(document).ready(function() {

var table = $('#example1').DataTable({ 
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




















</body> 
</html>
<?php
} ?>


<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/simplePagination.js/1.6/jquery.simplePagination.js"></script>
<script>
    // jQuery Plugin: http://flaviusmatis.github.io/simplePagination.js/

var items = $(".list-wrapper .list-item");
    var numItems = items.length;
    var perPage = 6;

    items.slice(perPage).hide();

    $('#pagination-container').pagination({
        items: numItems,
        itemsOnPage: perPage,
        prevText: "&laquo;",
        nextText: "&raquo;",
        onPageClick: function (pageNumber) {
            var showFrom = perPage * (pageNumber - 1);
            var showTo = showFrom + perPage;
            items.hide().slice(showFrom, showTo).show();
        }
    });
</script>

