


<?php
include('../../univ/baseurl.php');
session_start();
if(!isset($_SESSION['pid'])){ 
$_SESSION['afterlogin']="store/";
include_once ("../../authentication/islogin.php");

}else{
function sp_autoloader($class) {
include '../../mlayer/' . $class . '.class.php';
}
spl_autoload_register("sp_autoloader");


/*if($_SESSION['ptid'] != 2 && $_SESSION['ptid'] != 5){ 
$re = new _redirect;
$location = $BaseUrl."/services/";
$re->redirect($location);
}*/
$_GET["categoryID"] = "7";
$_GET["categoryName"] = "Services";
$header_servic = "header_servic";
$activePage = 4;
?>
<!DOCTYPE html>
<html lang="en-US">

<head>
<?php include('../../component/f_links.php');?>

<!-- ===== INPAGE SCRIPTS====== -->
<!-- High Charts script -->
<script src="<?php echo $BaseUrl;?>/assets/js/highcharts.js"></script>
<!-- Morris chart -->
<link href="<?php echo $BaseUrl; ?>/assets/admin/plugins/morris/morris.css" rel="stylesheet" type="text/css" />
<?php include('../../component/dashboard-link.php'); ?>

<style type="text/css">


td,
th {
text-align: left;
padding: .5rem 1rem;
}

tbody tr:nth-child(odd) {
background-color: #ccc;
}

th {

color: #fff;
}

/* Pagination. */
.pagination {
background: #17a3af;
padding: 1rem;
margin-bottom: 1rem;
text-align: center;
display: flex;
justify-content: center;
}

#numbers {
padding: 0;
margin: 0 2rem;
list-style-type: none;
display: flex;
}

#numbers li a {
color: #fff;
padding: .5rem 1rem;
text-decoration: none;
opacity: .7;
}

#numbers li a:hover {
opacity: 1;
}

#numbers li a.active {
opacity: 1;
background: #fff;
color: #333;
}

.sweet-alert h2 {

font-size: 21px!important;
margin: 10px 0px!important;

}


.sweet-alert {

width: 441px!important;
padding: 8px!important;

}

.bcolor{
background-color: #999;
border-color: #999;
}
</style>
</head>

<body class="bg_gray">
<?php
include_once("../../header.php");
?>
<section class="main_box">
<div class="container">
<div class="row">
<?php //include('servicemoduledash.php'); ?>
<div class="sidebar col-md-2 no-padding left_service_menu" id="sidebar" >
<?php include('left-menu.php'); ?> 
</div>
<div class="col-md-10">

<div class="col-sm-12 nopadding dashboard-section" style="">
<div class="col-xs-12 nopadding dashboardbreadcrum">
<ul class="breadcrumb" style="background-color: #FFF;padding-top: 10px;padding-bottom: 15px;">
<li><a href="<?php echo $BaseUrl;?>/services/dashboard">Dashboard</a></li>
<li>Favourite Ads</li>
<!-- <li><?php echo $title;?></li> -->
<a href="<?php echo $BaseUrl.'/post-ad/services/?post';?>" class="btn post-project postproject" style="float: right;background-color: #07a2ae;color: #fff;margin-bottom: 4px;margin-top: -4px;padding-bottom: 4px;" >Post An Ad</a> 
</ul>
</div>


</div>



<!-- <div class="col-xs-12 serviceDashTop text-center">
<h1>Favourite Ads</h1>
</div> -->
<?php
if(isset($_SESSION['err']) && $_SESSION['count'] == 0){ ?>
<p class="alert alert-success error_show" style="background-color: #00a65a !important;color:#FFF!important;"><?php echo $_SESSION['err'];?></p><?php
$_SESSION['count']++;
unset($_SESSION['err']);
}
?>

<link rel='stylesheet' href='https://cdn.datatables.net/1.10.9/css/jquery.dataTables.min.css'>
<div class="row">


<div class="col-sm-12">
<div class="table-responsive bg_white">
<form action="addsortlist.php" method="POST">
<input type="submit" name="sortlist" class="btn btn-info" value="Copy to Short Listed Ads" style="margin: 10px 10px 10px 18px;">
<table id="my-table" class="table table-striped table-bordered dashServ display">
<thead>
<tr>

<th  class="text-center">Service Name</th>
<th class="text-center">Expiry Date</th>
<th class="text-center">Location</th>
<th class="text-center">Classified</th>
<th class="text-center">Comment</th>
<!--  <th class="text-center">Category</th> -->
<!-- <th class="text-center">Action</th> -->
</tr>
</thead>
<tbody>
<?php
$p      = new _classified;
///$pf     = new _postfield;
//$res    = $p->myposted_expire_service($_GET['categoryID'], $_SESSION['pid']);
$res = $p->event_favorite($_GET["categoryID"], $_SESSION['pid']);
//echo $p->ta->sql;
if($res != false){
while ($row = mysqli_fetch_assoc($res)) { 

// print_r($row);
//posting fields
/* $result_pf = $pf->read($row['idspPostings']);*/

$category = $row['servicecategory'];
$location = $row['spPostCity'];

//echo $pf->ta->sql."<br>";
/* if($result_pf){
$category = "";
$location = "";
while ($row2 = mysqli_fetch_assoc($result_pf)) {

if($category == ''){
if($row2['spPostFieldName'] == 'servicecategory_'){
$category = $row2['spPostFieldValue'];
}
}
if($location == ''){
if($row2['spPostFieldName'] == 'spPostCity_'){
$location = $row2['spPostFieldValue'];
}
}

}*/
$ci  = new _city;
// city name
$result4 = $ci->readCityName($location);
if($result4 != false){
$row4 = mysqli_fetch_assoc($result4);
}
?>
<tr>
<td>

<input type='checkbox' name='sort[]' value='<?php echo $row['id'] ?>' >
</form>
<!--    <?php
$pic = new _postingpic;
$res2 = $pic->read($row['idspPostings']);
if ($res2 != false) {
$rp = mysqli_fetch_assoc($res2);
$pic2 = $rp['spPostingPic'];
echo "<img alt='Posting Pic' class='img-responsive' src=' " . ($pic2) . "' >"; ?>
<?php
} else{
echo "<img alt='Posting Pic' src='../img/no.png' class='img-responsive'>"; ?>
<?php
} ?> -->
<a href="<?php echo $BaseUrl.'/services/detail.php?postid='.$row['idspPostings'];?>"><?php echo ucfirst($row['spPostingTitle']); ?></a>


</td>

<td class="text-center"><?php echo $row['spPostingExpDt']?></td>

<td class="text-center"><?php echo isset($row4['city_title'])?ucwords($row4['city_title']):''; ?></td>

<td class="text-center"><?php echo ucfirst($row['spPostSerComty']); ?></td>

<td class="text-center"><?php

if(!empty($row['comment'])){

?>

<!-- <button type="button" class="btn btn-success  btn-sm" data-toggle="modal" data-target="#viewcomment<?php echo $row['id']; ?>">View Comment</button> -->

<!-- Modal -->
<div class="modal fade" id="viewcomment<?php echo $row['id']; ?>" role="dialog">
<div class="modal-dialog">




<input type="hidden" name="id" value="<?php echo $row['id']; ?>">

<!-- Modal content-->
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal">&times;</button>
<h4 class="modal-title" style="float:left;">Comment</h4>
</div>
<div class="modal-body" style="text-align: left;">

<p><?php echo  $row['comment']; ?></p>

</div>
<div class="modal-footer">
<button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>

</div>
</div>


</div>
</div>


<button type="button" class="btn btn-success  btn-sm" data-toggle="modal" data-target="#updatecomement<?php echo $row['id']; ?>"><i class="fa fa-upload"></i></button>

<!-- Modal -->
<div class="modal fade" id="updatecomement<?php echo $row['id']; ?>" role="dialog">
<div class="modal-dialog">

<form action="addcomment.php" method="POST">    


<input type="hidden" name="id" value="<?php echo $row['id']; ?>">

<!-- Modal content-->
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal">&times;</button>
<h4 class="modal-title" style="float:left;">Update Comment</h4>
</div>
<div class="modal-body">
<textarea style="width: 100%;" name="comment" rows="5" ><?php echo  $row['comment']; ?></textarea>

</div>
<div class="modal-footer">
<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
<button type="submit" class="btn btn-info" >Submit</button>
</div>
</div>
</form>

</div>
</div>





<?php

}else{

    $href = "delete_favourit.php?id=" . $row['idspPostings'];

?>


<a type="button"   data-toggle="modal" data-target="#myModal<?php echo $row['id']; ?>"><i style="color: #428bca" title="Edit" class="fa fa-pencil"></i></a>

<a  onclick="permanentDelete('<?php echo $href; ?>')"><i title="Delete" class="fa fa-trash"></i></a>

<!-- Modal -->
<div class="modal fade" id="myModal<?php echo $row['id']; ?>" role="dialog">
<div class="modal-dialog">

<form action="addcomment.php" method="POST">	


<input type="hidden" name="id" value="<?php echo $row['id']; ?>">

<!-- Modal content-->
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal">&times;</button>
<h4 class="modal-title" style="float:left;">Add Comment</h4>
</div>
<div class="modal-body">
<textarea style="width: 100%;" name="comment" rows="5" ></textarea>

</div>
<div class="modal-footer">
<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
<button type="submit" class="btn btn-info" >Add</button>
</div>
</div>
</form>

</div>
</div>




<?php
}






?> </td>
<!-- <td class="text-center"><?php echo ucwords(strtolower($category)); ?></td> -->
<!--  <td class="text-center">
<?php
$fv = new _favorites;
$res_fv = $fv->chekFavourite($row['idspPostings'], $_SESSION['pid'], $_SESSION['uid']);
//echo $fv->ta->sql;
if($res_fv != false){ ?>
<a href="<?php echo $BaseUrl.'/services/del-fav.php?postid='.$row['idspPostings'];?>" data-postid="<?php echo $row['idspPostings'];?>" >
<span id="removetofavouriteeve"><i class="fa fa-heart"></i></span>
Unfavourite
</a><?php
//echo '<li><a data-postid="'. $_GET["postid"].'" class="remtofavorites"><img src="'.$BaseUrl.'/assets/images/icon/store/favourite.png"><span id="remtofavorites"> Unfavourite</span></a></li>';
}
?>
</td> -->
<!-- <td class="text-center"><a href="javascript:void(0)"><i class="fa fa-trash"></i></a></td> -->
</tr>

<?php
/* }*/
}
}else{  

echo "<tr><td colspan='6'><h4 style='text-align:center;'>No Favourite Ads  Found</h4></td></tr>";


} ?>


</tbody>
</table>


<div class="pagination">
<ol id="numbers"></ol>
</div>
</div>
</div>

</div>
</div>
</div>
</div>
</section>


<div class="space-lg"></div>

<?php 
include('../../component/f_footer.php');
include('../../component/f_btm_script.php'); 
?>
<!-- notification js -->
<script src='<?php echo $BaseUrl.'/assets/';?>js/bootstrap-notify.min.js'></script>
</body>
</html>
<?php
} ?>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script> -->


<!-- <script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js'></script> -->
<script src='https://cdn.datatables.net/1.10.9/js/jquery.dataTables.min.js'></script>


<script  type="text/javascript">
$(function() {
const rowsPerPage = 13;
const rows = $('#my-table tbody tr');
const rowsCount = rows.length;
const pageCount = Math.ceil(rowsCount / rowsPerPage); // avoid decimals
const numbers = $('#numbers');

// Generate the pagination.
for (var i = 0; i < pageCount; i++) {
numbers.append('<li><a href="#">' + (i+1) + '</a></li>');
}

// Mark the first page link as active.
$('#numbers li:first-child a').addClass('active');

// Display the first set of rows.
displayRows(1);

// On pagination click.
$('#numbers li a').click(function(e) {
var $this = $(this);

e.preventDefault();

// Remove the active class from the links.
$('#numbers li a').removeClass('active');

// Add the active class to the current link.
$this.addClass('active');

// Show the rows corresponding to the clicked page ID.
displayRows($this.text());
});

// Function that displays rows for a specific page.
function displayRows(index) {
var start = (index - 1) * rowsPerPage;
var end = start + rowsPerPage;

// Hide all rows.
rows.hide();

// Show the proper rows for this page.
rows.slice(start, end).show();
}
});


</script>
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
});
});

</script>
<script src="<?php echo $baseurl?>/assets/js/sweetalert.js"></script> 
    <script>
        function permanentDelete(hrefid) {
        Swal.fire({
        title: 'Are You Sure You Want to Delete?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, Delete!'
        }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = hrefid;
        }
        });
        }
    </script>
