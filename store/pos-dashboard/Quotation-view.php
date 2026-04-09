<?php

// ini_set('display_errors', '1');
// ini_set('display_startup_errors', '1');

include('../../univ/baseurl.php');
session_start();

if (!isset($_SESSION['pid'])) {
$_SESSION['afterlogin'] = "store/";

include_once("../../authentication/islogin.php");
} else {
function sp_autoloader($class)
{
include '../../mlayer/' . $class . '.class.php';
}
spl_autoload_register("sp_autoloader");

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

$active = 5;

$p = new _pos;
$pid = $_SESSION['pid'];
$uid = $_SESSION['uid'];

?>




<!DOCTYPE html>
<html>

<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Quotation Details | TheSharepage-POS </title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.7.2/css/all.min.css" integrity="sha512-3M00D/rn8n+2ZVXBO9Hib0GKNpkm8MSUU/e2VNthDyBYxKWG+BftNYYcuEjXlyrSO637tidzMBXfE7sQm0INUg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">
<link rel="stylesheet" type="text/css" href="css/style.css">
<link rel="stylesheet" href="https://cdn.rawgit.com/t4t5/sweetalert/v0.2.0/lib/sweet-alert.css">
<style>
.me-3 {
padding-left: 0px;
padding-right: 0px;
margin-right: 14rem !important;
margin-bottom: 3px;
}
</style>
</head>

<body>










<div class="container-fluid">
<div class="row flex-nowrap">

<?php include('left_side_landing.php'); ?>
<div class="col py-3">
<div class="row mb-4">
<div class="d-flex justify-content-between border-bottom mb-3">
<h3>Quotation Details</h3>






<a href="Quotation-add.php" class="btn btn-main mb-3"><span class="d-none d-sm-inline"><i class="fas fa-plus"></i> Add Quotation</span></a>
</div>

<div class="col-12">






<?php
$p = new _pos;



$result1 = $p->read_user($_SESSION['uid']);
if($result1){
$currency = mysqli_fetch_assoc($result);

}

$result = $p->read_pos1($id);  

if ($result) {

$row = mysqli_fetch_assoc($result);





echo 'Date :'.$row['quotation_date']; 
echo '<br>';



$customer_id =  $row['quotation_customer']; 
$result_customer = $p->read_pos_customer1($customer_id); 


if($result_customer != false ){
$row2 = mysqli_fetch_assoc($result_customer);
$customername=$row2['customer_name']; 

}
else {
$customername="";
}



$warehouse_id =  $row['quotation_warehouse']; 
$result_warehouse = $p->read_pos_werehouse1($warehouse_id); 



if($result_warehouse != false ){

$row3 = mysqli_fetch_assoc($result_warehouse);
$warehousename=$row3['warehouse']; 

}
else {
$warehousename="";
}




echo 'Customer Name :'.$customername; 

echo '<br>';
echo 'WareHouse :'.$warehousename;
echo '<br>';
echo '<br>';


}
?>










<table id="table_id" class="display" data-order='[[ 0, "desc" ]]' data-page-length='25'>
<thead>
<tr>

<th>Id</th>
<th>Product Name </th>
<th>Product Price</th>
<th>Quantity  </th>
<th>Sub Total  </th>

</tr>
</thead>
<tbody>




<?php


$p = new _pos;

$result3 = $p->read3($id); 
$subtotalall=0;
if($result3){
while ($row3 = mysqli_fetch_assoc($result3)) {
?>
<tr>
<td><?php echo $row3['id']; ?></td>
<td>
<?php
$product_id =  $row3['product_id']; 
$result_customer = $p->read_product1($product_id); 
$result_customer = $p->read_product1($product_id); 
if($result_customer){
$row2 = mysqli_fetch_assoc($result_customer);
}
echo $row2['spPostingTitle'];
?>
</td>
<td>
<?php
$price=$row2['pirce_in'];
$curr=$currency['currency'];
echo $curr. " ".$price;
?>
</td>
<td>
<?php 
$qut=$row3['product_qty'];
echo $qut; 
?>
</td>
<td><?php echo $curr . " " . ($price * $qut); ?></td>
</tr>   
<?php  
$sum = $price * $qut;
$subtotalall = $subtotalall + $sum;
} }?>                           
</tbody>
</table>
</div>
</div>


<div class="row">
<div class="col-lg-8 "></div>
<div class="col-lg-4 ">


<td><?php echo 'Sub Total : '. $curr . " " . ($subtotalall); ?></td><br>

<td> <?php echo 'Discount : ' . $curr . " " . $row['quotation_discount']; ?></td><br>


<td> <?php echo 'Grandtotal : ' . $curr . " " . $row['quotation_grandtotal']; ?></td>



</div>
</div>






<div class="row">
<div class="col-lg-12 footer">
<span>Copyrights &copy; 2022 TheSharePage, All Reights Reserved</span>
</div>
</div>
</div>
</div>
</div>











<script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.12.1/datatables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

<script src="js/data.js"></script>
<script src="js/custom-chart.js"></script>
<script type="text/javascript">
$(document).ready(function() {
$('#table_id').DataTable({
buttons: {
buttons: ['copy', 'csv', 'excel']
}
});
});
</script>
<script src="<?php echo $baseurl?>/assets/js/sweetalert.js"></script>
<script type="text/javascript">
function deletefun(id) {
Swal.fire({
title: 'Are You Sure You Want to Delete?',
icon: 'warning',
showCancelButton: true,
confirmButtonColor: '#3085d6',
cancelButtonColor: '#d33',
confirmButtonText: 'Yes, Delete!'
}).then((result) => {
if (result.isConfirmed) {
window.location.href = "ExpenseList.php?delid=" + id;

}
});

}
</script>
<script>
setTimeout(function() {
$("#success").hide();
}, 5000);
setTimeout(function() {
$("#no_member").hide();
}, 5000);
setTimeout(function() {
$("#p_success").hide();
}, 5000);
</script>

<script>
<?php
if (isset($_SESSION['conf'])) {
unset($_SESSION['conf']);
?>
Swal.fire({
title: 'File uploaded successfully',
});
// swal('File uploaded successfully');

<?php   }
?>
</script>

</body>

</html>

<?php } ?>
