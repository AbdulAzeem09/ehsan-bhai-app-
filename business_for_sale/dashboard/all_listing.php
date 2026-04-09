<?php
include('../../univ/baseurl.php');
session_start();
//print_r($_SESSION);
if(!isset($_SESSION['pid'])){ 
$_SESSION['afterlogin']="services/";
include_once ("../../authentication/islogin.php");

}else{
function sp_autoloader($class) {
include '../../mlayer/' . $class . '.class.php';
}
spl_autoload_register("sp_autoloader");

$_GET["categoryID"] = "7";
$_GET["categoryName"] = "Services";
$header_servic = "business_for_sale";
//$activePage = 8;
?>
<!DOCTYPE html>
<html lang="en-US">

<head>
<?php include('../../component/f_links.php');?>

<!-- ===== INPAGE SCRIPTS====== -->
<!-- High Charts script -->

<?php include('../../component/dashboard-link.php'); ?>
</head>

<body class="bg_gray">
<?php
include_once("../../header.php");
?>
<style>
#example_length{
margin-left: 7px;
margin-top: -23px;
margin-bottom: 10px;
}



#example_filter{
margin-bottom: -15px;
margin-top: -26px;
margin-right: 7px;

}
#example_info{
margin-left: 8px;
}
.current{
margin-bottom: 6px;
}




</style>




<section class="main_box">
<div class="container">
<div class="row">

<div id="sidebar" class="col-md-2 hidden-xs no-padding">
<div class="left_grid store_left_cat">
<?php
include('left-menu.php'); 
?>
</div>

<div class="col-md-10 ">

<?php
$bu= new _businessrating;
$bu1=$bu->read_business($_SESSION['uid'],$_SESSION['pid']);
if($bu1!=false){
$table="example";
}
else{
$table="";
}
?>
<div class="row">
<div class="col-sm-12">
<ul class="breadcrumb" style="background: white !important;  ">
<li><a href="<?php echo $BaseUrl.'/business_for_sale/dashboard/index.php';?>">Dashboard</a></li>
<li><a href="#">All Listing</a></li>

</ul>
</div>
</div>
<div class="row" >


<div class="col-sm-12" style="min-height:200px;">
<div class="table-responsive bg_white">
<table class="table table-striped table-bordered dashServ">

<tbody>


<div class="col-sm-12" style="margin-top:10px;">

<link rel='stylesheet' href='https://cdn.datatables.net/1.10.9/css/jquery.dataTables.min.css'>

<style type="text/css">
.paginate_button {
border-radius: 0 !important;
}
</style>


<!-- partial:index.partial.html -->
<table id="<?php echo $table;?>" class="display" cellspacing="0" width="100%"  >
<thead style="background-color: #56966f;">
<tr>
<th class="text-center" style="color:white;">Id</th>
<th class="text-center" style="color:white;">Id</th>
<th class="text-center" style="color:white;">Headline</th>
<th class="text-center" style="color:white;">Business Category</th>
<th class="text-center" style="color:white;">Description</th>
<th class="text-center" style="color:white;">Business Type</th>
<th class="text-center" style="color:white;">Duration (Days)</th>
<th class="text-center" style="color:white;">Price</th>
<th class="text-center" style="color:white;">Action</th>

</tr>
</thead>
<tbody>

<?php
$bu= new _businessrating;
$bu1=$bu->read_business($_SESSION['uid'],$_SESSION['pid']);
if($bu1!=false){
while($row=mysqli_fetch_assoc($bu1)){
?>
<tr>
<td class="text-center"><?php echo $row['idspbusiness'];?></td>
<td class="text-center"><?php echo $row['idspbusiness'];?></td>
<td class="text-center"><a href="<?php echo $BaseUrl?>/business_for_sale/business_detail.php?postid=<?php echo $row['idspbusiness'];?>"><?php echo $row['listing_headline'];?></a></td>
<td class="text-center">
<?php if($row['business_category']==1){echo "Manufacturing";}
else if($row['business_category']==2){echo "Hotel";}
else{echo "Website Design";}

?>
</td>

<td class="text-center" ><?php echo substr($row['description'],0,20);?></td>
<td class="text-center"><?php if($row['business_type']==1){echo "Franchise";}else{echo "Independent Sale";}?></td>
<td class="text-center"><?php echo $row['duration'];?></td>
<td class="text-center"><?php echo 'USD '.$row['price'];?></td>

<td class="text-center;" style="padding-left:30px;"> <a href="<?php echo $BaseUrl.'/business_for_sale/edit_business.php?postid='.$row['idspbusiness']; ?>"><img src="<?php echo $BaseUrl.'/assets/images/icon/edit.png'?>" class="img-responsive" alt="Edit" style="height:14px;display: initial;" ></a>
<a href="javascript:void(0)" data-postid="<?php echo $row['idspbusiness']; ?>" class="delpost" ><img src="<?php echo $BaseUrl.'/assets/images/icon/delete.png'?>" class="img-responsive" alt="Delete" style="height:14px;display: initial;"></a></td> 

</tr>
<?php



}}
else{
?>


<tr>
<td colspan="9" style="height:80px;">
<p class="text-center">No Record Found</p>
</td>
</tr>
<?php
}
?>

<!-- partial 
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>-->
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


</div>
</tbody>
</table>
</div>
</div>

</div>
</div>
</div>
</div>
</section>

<div class="space-lg"></div><br><br>

<?php 
include('../../component/f_footer.php');
include('../../component/f_btm_script.php'); 
?>

</body>
</html>
<?php
} ?>
