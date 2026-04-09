<?php
/*ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);*/



include("../../univ/main.php");
include('../../univ/baseurl.php');
session_start();
//print_r($_SESSION); die('');
if (!isset($_SESSION['pid'])) {
$_SESSION['afterlogin'] = "store/";
include_once("../../authentication/islogin.php");
} else {
function sp_autoloader($class)
{
include '../../mlayer/' . $class . '.class.php';
}
spl_autoload_register("sp_autoloader");
//print_r($_SESSION); die('222222222222');   

?>
<!DOCTYPE html>
<html>

<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Business Account & Inventory | TheSharepage </title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.7.2/css/all.min.css"
integrity="sha512-3M00D/rn8n+2ZVXBO9Hib0GKNpkm8MSUU/e2VNthDyBYxKWG+BftNYYcuEjXlyrSO637tidzMBXfE7sQm0INUg=="
crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.12.1/datatables.min.css" />
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" type="text/css" href="css/style.css">

<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
<script type="text/javascript"
src="https://cdnjs.cloudflare.com/ajax/libs/jquery-creditcardvalidator/1.0.0/jquery.creditCardValidator.js">
</script>
<script type="text/javascript" src="<?php echo $BaseUrl; ?>/assets/js/payment.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<style>
.select2.select2-container {
width: 100% !important;
margin-left: 3px;
}

.select2.select2-container .select2-selection {
border: 1px solid #ccc;
-webkit-border-radius: 3px;
-moz-border-radius: 3px;
border-radius: 3px;
height: 34px;
margin-bottom: 15px;
outline: none !important;
transition: all .15s ease-in-out;
}

.select2.select2-container .select2-selection .select2-selection__rendered {
color: #333;
line-height: 32px;
padding-right: 33px;
}

.select2.select2-container .select2-selection .select2-selection__arrow {
background: #f8f8f8;
border-left: 1px solid #ccc;
-webkit-border-radius: 0 3px 3px 0;
-moz-border-radius: 0 3px 3px 0;
border-radius: 0 3px 3px 0;
height: 32px;
width: 33px;
}

.select2.select2-container.select2-container--open .select2-selection.select2-selection--single {
background: #f8f8f8;
}

.select2.select2-container.select2-container--open .select2-selection.select2-selection--single .select2-selection__arrow {
-webkit-border-radius: 0 3px 0 0;
-moz-border-radius: 0 3px 0 0;
border-radius: 0 3px 0 0;
}

.select2.select2-container.select2-container--open .select2-selection.select2-selection--multiple {
border: 1px solid #34495e;
}

.select2.select2-container .select2-selection--multiple {
height: auto;
min-height: 34px;
}

.select2.select2-container .select2-selection--multiple .select2-search--inline .select2-search__field {
margin-top: 0;
height: 32px;
}

.select2.select2-container .select2-selection--multiple .select2-selection__rendered {
display: block;
padding: 0 4px;
line-height: 29px;
}

.select2.select2-container .select2-selection--multiple .select2-selection__choice {
background-color: #f8f8f8;
border: 1px solid #ccc;
-webkit-border-radius: 3px;
-moz-border-radius: 3px;
border-radius: 3px;
margin: 4px 4px 0 0;
padding: 0 6px 0 22px;
height: 24px;
line-height: 24px;
font-size: 12px;
position: relative;
}

.select2.select2-container .select2-selection--multiple .select2-selection__choice .select2-selection__choice__remove {
position: absolute;
top: 0;
left: 0;
height: 22px;
width: 22px;
margin: 0;
text-align: center;
color: #e74c3c;
font-weight: bold;
font-size: 16px;
}

.select2-container .select2-dropdown {
background: transparent;
border: none;
margin-top: -5px;
}

.select2-container .select2-dropdown .select2-search {
padding: 0;
}

.select2-container .select2-dropdown .select2-search input {
outline: none !important;
border: 1px solid #34495e !important;
border-bottom: none !important;
padding: 4px 6px !important;
}

.select2-container .select2-dropdown .select2-results {
padding: 0;
}

.select2-container .select2-dropdown .select2-results ul {
background: #fff;
border: 1px solid #34495e;
}

.select2-container .select2-dropdown .select2-results ul .select2-results__option--highlighted[aria-selected] {
background-color: #3498db;
}
</style>

<body>

<?php
$userid = $_SESSION['uid'];


$c = new _orderSuccess;


$currency = $c->readcurrency($userid);
if ($currency) {
$res1 = mysqli_fetch_assoc($currency);
$curr = $res1['currency'];
//echo $curr;
//di
}

?>



<div class="container-fluid">
<div class="row flex-nowrap">
<div class="col py-3">
<div id="content_1">
<div class="row align-self-stretch">
<div class="d-flex justify-content-between mb-3">

<h4 class="float-start"> Point Of Sale</h4>



<span class="float-end">
<button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
style="height:36px;margin-right: 16px;" data-bs-target="#addhelp">HELP <i title="HELP"
></i> </button>
<a href="index.php" class="btn btn-success me-3"><i class="fas fa-tachometer-alt"></i>
Back to Dashoard</a>
<a href="<?php echo $BaseUrl; ?>/timeline/" class="btn btn-danger me-3"><i
class="fas fa-window-close"></i> Close POS</a>
</span>
</div>
<div class="alert alert-success" style="display:none" id="customer_success" role="alert">
Customer Created Successfully.
</div>

<div class="alert alert-success" style="display:none" id="product_success" role="alert">
Product Added Successfully.
</div>

<?php if ($_GET['msg'] == "nomembership") { ?>

<div class="alert alert-danger" id="no_member" role="alert">
NO Membership.
</div>
<?php } ?>
<?php if ($_GET['msg'] == "success") { ?>
<div class="alert alert-success" id="success" role="alert">
Successfully Deducted Membership.
</div>

<?php } ?>

<?php if ($_GET['msg'] == "peyment_success") { ?>
<div class="alert alert-success" id="p_success" role="alert">
Payment Successfully .
</div>

<?php } ?>



<div class="col-lg-12 mb-3">
<div class="border-3 border-primary border-top p-3 bg-light shadowBox">
<div class="mb-1">
<div class="input-group flex-nowrap">
<div class="col-2 me-1 d-flex">
<button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
style="height:36px" data-bs-target="#addcustomer"> <i
title="Add Customer" class="fas fa-plus"></i> </button>&nbsp;
<button type="button" style="height:36px" onclick="membership_fun()"
id="m_modal" class="btn btn-primary btn-sm"> <i title="Reset"
class="fa fa-history" aria-hidden="true"></i></button>



<select style="height: 36px;margin-left: 3px;" id="biller_id"
class="form-control">

<option selected>Select Biller</option>
<?php
$p = new _pos;

$result_1 = $p->read_employes($_SESSION['pid'], $_SESSION['uid']);

if ($result_1) {
$i = 1;
while ($row_1 = mysqli_fetch_assoc($result_1)) {
$id = $row['id'];
$username = $row['name'];

?>
<option value="<?php echo $row_1['id']; ?>">
<?php echo $row_1['name']; ?></option>


<?php }
} ?>


</select>
</div>






<div class="col-2 me-1 d-flex">
<select style="margin-left: 3px;" class="js-select2 control-form" onchange="fun_id_new(this.value)">
    <option value="">--Search Customer--</option>
    
    <?php
    $uid = $_SESSION['uid'];
    $p = new _pos;
    
    $urlphone = $_GET['phone']; // Corrected from $_get to $_GET
    
    $res = $p->read_search($uid);
    if ($res) {
        while ($data = mysqli_fetch_assoc($res)) {
            $selected = ($urlphone == $data['phone']) ? "selected" : ""; // Check if phone matches
    
            echo "<option value='{$data['phone']}' $selected>{$data['customer_name']} -- {$data['phone']}</option>";
        }
    }
    ?>
</select>


</div>



<div class="col-2 me-1 d-flex">
<input type="text" style="height:36px;margin-left: 3px;"
class="form-control" placeholder="Cust Ph:" aria-label="Customer Ph:"
aria-describedby="addon-wrapping" onkeyup=" fun_id()" id="phone_">
</div>

<div class="col-1 me-1 d-flex">
<input type="text" style="height:36px;margin-left: 3px;"
class="form-control" placeholder="Cust ID:" aria-label="Customer ID:"
aria-describedby="addon-wrapping" id="customer_id">
</div>

<div class="col-2 me-1 d-flex">

<input type="text" style="height:36px;margin-left: 3px;"
class="form-control" placeholder="Customer name" aria-label=""
aria-describedby="addon-wrapping" id="customer_name_">
<!-- <select class="form-control form-select js-example-basic-multiple" onchange="fun_id_e()" id="inputGroupSelect" name="customers" >
<option>Select Customer</option>
<?php $p = new _pos;


$result = $p->read_data_uid($_SESSION['uid']);

if ($result) {
//print_r($result); die();

while ($row = mysqli_fetch_assoc($result)) { ?>
<option  value="<?php echo $row['id']; ?>"><?php echo $row['customer_name']; ?></option>


<?php }
} ?> 
</select>-->
<!-- <button type="button" class="btn btn-info btn-sm text-light" data-bs-toggle="modal" data-bs-target="#customeredit"> <i class="fas fa-edit"></i> </button>-->

</div>
<div class="col-2 me-1 d-flex">
<input type="text" style="height:36px; width:220px" class="form-control"
placeholder="Email" aria-label="Customer Email"
aria-describedby="addon-wrapping" id="email_">
</div>

<div class="col-1 me-1" id="cust">

</div>



</div>
</div>
</div>
</div>
<div id="box11">



</div>
<input type="hidden" id="title_pro">
<input type="hidden" id="rand_val" value="1">
<input type="hidden" id="discount_change" value="">
<input type="hidden" id="discount_total_" value="0">
<input type="hidden" id="sub_total_1" value="0">
<input type="hidden" id="sub_total_2" value="0">
<input type="hidden" id="field_data_up" value="1">
<input type="hidden" id="Gross_net_1" value="0">
<div class="col-lg-12">
<div class="border-3 border-success border-top p-3 bg-light shadowBox">
<div class="mb-3">
<!-- <form method="post" action="#">-->
<div class="d-flex justify-content-center input-group">
<div class="col-2 me-3">
<!-- <input type="text" class="form-control" placeholder="Barcode" aria-label="Barcode" aria-describedby="addon-wrapping" id="product_id_" onkeyup="fun_product_id()"> -->



<select class="js-select2 control-form"
onchange="fun_product_id_new(this.value)">
<option value="">-- Search Product -- </option>

<?php

$res = $p->read_drop1($_SESSION['pid']);
if ($res) {
while ($data = mysqli_fetch_assoc($res)) {



?>

<option value=<?php echo $data['barcode'] ?>>
<?php echo $data['spPostingTitle'] . '  '; ?>(<?php echo $data['barcode'] ?>)
</option>


<?php
}
}

?>

</select>


</div>

<div class="col-2 me-3">
<input type="text" class="form-control" placeholder="Barcode"
aria-label="Barcode" aria-describedby="addon-wrapping" id="product_id_"
onkeyup="fun_product_id()">

</div>
<input type="hidden" id="membership_id" value="">
<div class="col-2 d-flex me-1">

<input type="text" class="form-control" placeholder="Product name"
aria-label="Product name" aria-describedby="addon-wrapping"
id="product_name_" style="height: 38px;">

<button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal"
style="height:36px; margin-left: 3px;" data-bs-target="#exampleModal2">
<i title="Create Product" class="fas fa-plus"></i> </button>
</div>
<!-- 
<div class="col-1 me-1" id="add_color">
<input type="text" class="form-control" placeholder="Color" readonly aria-label="Color" aria-describedby="addon-wrapping" id="color_">
</div>
<div class="col-1 me-1" id="add_size">
<input type="text" class="form-control" placeholder="Size" readonly aria-label="Size" aria-describedby="addon-wrapping" id="size_">
</div> -->
<div class="col-2 me-1 d-flex">
<span id="add_quantity">
<input type="text" class="form-control me-1" placeholder="Quantity"
aria-label="Quantity" aria-describedby="addon-wrapping"
id="quantity_">
</span>
<input style="display: none;" type="text" class="form-control"
placeholder="Discount" aria-label="discount"
aria-describedby="addon-wrapping" id="discount_">
<select style="display: none;" class="form-control" id="select_currency"
name="" aria-label="Default select example">
<option value="%" selected>%</option>
<option value="$">$</option>
</select>
</div>
<div class="col-1 me-1">
<input type="text" class="form-control" placeholder="Unit Price"
aria-label="Unit Price" aria-describedby="addon-wrapping" id="price_">
</div>

<div class="col-1 me-1">
<button type="submit" class="btn btn-success" title="Add to Cart"
id="add_submit" name="submit" value="Add">Add</button>
</div>


<div class="col-1 me-1" id="view">

</div>

</div>
<!-- </form>-->
</div>
</div>
</div>
<div class="col-lg-12 top-product">
<table id="example" class="table bg-light table-striped shadowBox">
<thead>
<tr>
<th>Barcode</th>
<th>Product Name</th>
<!-- <th>Color</th>
<th>Size</th> -->
<th>Quantity</th>
<th>Unit Price</th>
<!-- <th width="">Discount</th> -->
<th>T Price</th>
<th>Action</th>
</tr>
</thead>
<tbody id="append_tr">
<!--  <tr>
<td id ="td_barcode"></td>
<td>Bannana</td>
<td id ="td_color"></td>
<td id="td_size" ></td>
<td><input type="text" name="" value="" style="width: 50px;" id="td_quantity" ></td>
<td><input type="text" name="" value="" style="width: 50px;" id="td_price"></td>
<td> %<span id="td_discount"></span> </td>
<td>$<span id="td_net"></span></td>
<td><a href="#"><i class="fas fa-edit me-1"></i></a>| <a href="#" class="text-danger"> <i class="fas fa-trash"></i></a> </td>
</tr>
<tr>
<td>|||||||||||</td>
<td>Apple</td>
<td>N/A</td>
<td>1kg</td>
<td><input type="text" name="" value="1" width="50" style="width: 50px;"></td>
<td><input type="text" name="" value="$10" style="width: 50px;"></td>
<td> %5 </td>
<td>$10</td>
<td><a href="#"><i class="fas fa-edit me-1"></i></a>| <a href="#" class="text-danger"> <i class="fas fa-trash"></i></a> </td>
</tr>-->
</tbody>
</table>
</div>
</div>
<div class="row summary">
<div class="col-lg-8 d-inline-flex bg-light shadowBox">
<div class="d-flex flex-row input-group flex-nowrap">
<span class="input-group-text" id="addon-wrapping">Sub Total</span>
<input type="text" placeholder="<?php echo $curr; ?>" readonly
value="<?php echo $curr; ?>" style="width:45px;border-color:white">
<input type="text" id="sub_total_" class="form-control" placeholder="Sub Total"
aria-label="Sub Total" aria-describedby="addon-wrapping">
<span class="input-group-text" id="addon-wrapping">Discount</span>
<input type="text" placeholder="<?php echo $curr; ?>" value="<?php echo $curr; ?>"
readonly style="width:45px;border-color:white">
<input type="text" class="form-control" onmousedown="fun_discount_val()"
onkeyup="fun_discount()" id="discount_by_net" placeholder="Discount"
aria-label="Discount" aria-describedby="addon-wrapping">
<span class="input-group-text" id="addon-wrapping">Total</span>
<input type="text" placeholder="<?php echo $curr; ?>" value="<?php echo $curr; ?>"
readonly style="width:45px;border-color:white">
<input type="text" name="total" class="form-control" value="0" id="total_by_net"
placeholder="Total" aria-label="Total" aria-describedby="addon-wrapping">

<!-- <span class="input-group-text" id="addon-wrapping">Tax</span>
<input type="text" placeholder="<?php echo $curr; ?>" value="<?php echo $curr; ?>" readonly style="width:45px;border-color:white">
<input type="text" class="form-control" onmousedown="fun_tax_val()" onkeyup="fun_tax()" id="total_tax" placeholder="Tax" aria-label="Tax" aria-describedby="addon-wrapping"> -->
</div>
</div>



<div class="col-lg-2">
<select onchange="updateValue(this.value)" style="margin-left:-24px;" class="form-control">
<option value="0">No Tax</option>



<?php

$p = new _pos;

$id = $_GET['id'];

$result = $p->read_drop($id);

if ($result) {
//print_r($result); die();

while ($row2 = mysqli_fetch_assoc($result)) {



?>



<option value='<?php echo $row2["tax_value"]; ?>'><?php echo $row2["tax_type"]; ?> -
(<?php echo $row2["tax_value"] . '%'; ?>)</option>






<?php
}

}
?>
</select>
</div>
<script>
$(document).ready(function() {
$(".js-select2").select2({
closeOnSelect: false
});
$(".js-select2-multi").select2({
closeOnSelect: false
});
});
</script>


<script>
function updateValue(tax) {
var to = $('#sub_total_1').val();
var to1 = parseInt(to);

var value1 = parseInt(tax); //tax
//var sub_tot=to1+value1;
var aftertax = ((to1*value1)/100)+to1;
//$('#sub_total_1').val(aftertax);
var currency="USD";

$('#Gross_net_').text(" " + currency + " " + aftertax + ".00");

}
</script>


<div class="col-lg-2">
<span class="border border-sucess bg-light float-end tinput pe-2 shadowBox Gross_net_"
value="" id="Gross_net_"> <?php echo $curr; ?> 00</span>
</div>

<br>
<div class="col-2 bg-light ">
    <a target="_blank" style="margin-top:10px;" class="btn btn-primary" href="<?php $baseurl ?>/store/pos-dashboard/customer-list.php">View Customer List</a>
</div>

<div class="col-2 bg-light ">
    <a target="_blank" style="margin-top:10px;" class="btn btn-primary" href="<?php $baseurl ?>/store/pos-dashboard/product-list.php?key=all">View Product List</a>
</div>


<div class="col-2 bg-light ">
    <a target="_blank" style="margin-top:10px;" class="btn btn-primary" href="<?php $baseurl ?>/store/pos-dashboard/pos_sales_record.php?action=all">View Sales History</a>
</div>

<div class="col-6 bg-light ">
<input type="button" onclick=" payment_fun()"
class="btn btn-success float-end ps-5 pe-5 m-2" name="print" value="Payment">
<!-- <input type="button" class="btn btn-warning float-end ps-5 pe-5 m-2" data-bs-toggle="modal" data-bs-target="#discountModal" name="" value="Discount">
<input type="submit" class="btn btn-primary float-end ps-5 pe-5 m-2" name="" value="Hold"> -->
</div>
</div>
</div>
<div id="page"></div>
<div class="row">
<div class="col-lg-12 footer">
<span>Copyrights &copy; 2023 TheSharePage, All Reights Reserved</span>
</div>
</div>
</div>
</div>
<!-------------------------------- All Modals ----------------------------------->



<div class="modal fade" id="addhelp" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog modal-xl">
<div class="modal-content" style=" width: 500px;margin: auto;">
<div class="modal-header bg-primary text-light">
<h5 class="modal-title" id="exampleModalLabel">Help Details</h5>
<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<ul style="list-style: none;text-align: center;">
    <br>
<li><a target="blank" href="<?php echo $BaseUrl; ?>/store/pos-dashboard/brands.php">Brand List</a></li>
<li><a target="blank" href="<?php echo $BaseUrl; ?>/store/pos-dashboard/product-list.php?key=all">Product List</a></li>
<li><a target="blank" href="<?php echo $BaseUrl; ?>/store/pos-dashboard/department.php">Department List</a></li>
<li><a target="blank" href="<?php echo $BaseUrl; ?>/store/pos-dashboard/employee.php">Employee List</a></li>
<li><a target="blank" href="<?php echo $BaseUrl; ?>/store/pos-dashboard/accounts.php">Accounts List</a></li>
<li><a target="blank" href="<?php echo $BaseUrl; ?>/store/pos-dashboard/ExpenseList.php">Expense List</a></li>
<li><a target="blank" href="<?php echo $BaseUrl; ?>/store/pos-dashboard/warehouse.php">Warehouse List</a></li>
<li><a target="blank" href="<?php echo $BaseUrl; ?>/store/pos-dashboard/customer-list.php">Customer List</a></li>
<li><a target="blank" href="<?php echo $BaseUrl; ?>/store/pos-dashboard/Quotation-list.php">Quotation List</a></li>
</ul>
</div>
</div>
</div>




<?php
$urlphoneno = $_GET['phone'];

if($urlphoneno){ ?>
    <script>
    setTimeout(function(){
     fun_id_new(<?php echo $_GET['phone']; ?>);
    },500);
    </script> 
<?php }
?>










<!-- Modal Customer Details -->
<div class="modal fade" id="addcustomer" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog modal-xl">
<div class="modal-content">
<div class="modal-header bg-primary text-light">
<h5 class="modal-title" id="exampleModalLabel">Customers Details</h5>
<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
<!--<form>-->
<div class="row">
<div class="col-8">
<!--  <div class="mb-3">
<input type="text" class="form-control shadowBox" id="customerno" placeholder="Customer#" value="" required>
</div>-->
<div class="mb-3">
<input type="text" class="form-control shadowBox" id="customername"
placeholder="Customer Name" value="" required>
</div>
<div class="mb-3">
<input type="text" class="form-control shadowBox" id="customerphone"
placeholder="Customer Phone" value="" required>
<span id="custphone" class="text-danger" name="cphone"></span>
<input type="hidden" id="phonehidden">
</div>
<div class="mb-3">
<input type="text" class="form-control shadowBox" id="customeremail"
placeholder="Customer Email" value="" required>
<span id="custemail" class="text-danger" name="cemail"></span>
<input type="hidden" id="custhidden">
</div>
<!--  <div class="mb-3">
<select class="form-control form-select shadowBox" id="customertype" name="customertype">
<option value="1">Type 1</option>
<option value="2">Type 2</option>
<option value="3">Type 3</option>
</select>
</div>-->
</div>
<div class="col-4">
<div class="profile-img mb-4">
<img src="" id="preview_img" class="img-sm img-fluid img-thumbnail float-end mb-2">
<!-- <form action="" class="iima" method="post" enctype="multipart/form-data" name="fileinfo"> 
<input type="file" class="form-control shadowBox" id ="image_file" name="profile-img">
</form>-->
<input type="file" class="form-control shadowBox" id="image_file"
name="profile-img">
</div>

</div>
</div>
<div class="row">
<div class="col-12">
<div class="tab-container-one">
<ul class="nav nav-tabs mb-5" id="myTab" role="tablist">
<li class="nav-item active">
<a class="nav-link active" href="#mailing" role="tab"
aria-controls="mailing" data-bs-toggle="tab">Mailing / Preference</a>
</li>
<li class="nav-item">
<a class="nav-link" href="#pt" role="tab" aria-controls="pt"
data-bs-toggle="tab">Prices / Tax</a>
</li>
<li class="nav-item">
<a class="nav-link" href="#cpt" role="tab" aria-controls="cpt"
data-bs-toggle="tab">Credit & Payment Terms</a>
</li>
<li class="nav-item">
<a class="nav-link" href="#note" role="tab" aria-controls="note"
data-bs-toggle="tab">Note</a>
</li>
</ul>
<div class="tab-content">
<div class="tab-pane active mb-4" id="mailing" role="tabpanel"
aria-labelledby="mailing-tab">
<div class="row">
<div class="col-12 mb-4">
<input type="text" class="form-control" id="address"
placeholder="Address" required>
</div>
<div class="row">
<div class="col-md-3">
<div class="form-group">
<label for="spPostCountry_" class="lbl_2">Country</label>
<select class="form-control " name="spPostCountry"
id="spUserCountry">
<option value="">Select Country </option>
<?php





$co = new _country;
$result3 = $co->readCountry();
if ($result3 != false) {
while ($row3 = mysqli_fetch_assoc($result3)) {

$usercountry = $row3['country_id'];
?>

<option value='<?php echo $row3['country_id']; ?>'
<?php echo (isset($_SESSION['spPostCountry']) && $_SESSION['spPostCountry'] == $row3['country_id']) ? 'selected' : ''; ?>>
<?php echo $row3['country_title']; ?></option>
<?php
}
}
?>
</select>
<!-- <input type="text" class="form-control" id="spPostingCountry" name="spPostingsCountry" value="<?php echo (isset($eCountry) ? $eCountry : $country); ?>"> -->
</div>
</div>
<div class="col-md-3">
<div class="form-group">
<div class="loadUserState">
<label for="spPostingCity" class="lbl_3">State</label>
<select class="form-control spPostingsState"
name="spUserState" id="spstate">
<option>Select State</option>
<?php

// if (isset($_SESSION['spPostCountry']) && $_SESSION['spPostCountry'] > 0) {
$countryId = $usercountry;
$pr = new _state;
$result2 = $pr->readState($countryId);
if ($result2 != false) {
while ($row2 = mysqli_fetch_assoc($result2)) {

$userstate = $row2["state_id"];
?>
<option value='<?php echo $row2["state_id"]; ?>'
<?php echo (isset($_SESSION['spPostState']) && $_SESSION['spPostState'] == $row2["state_id"]) ? 'selected' : ''; ?>>
<?php echo $row2["state_title"]; ?> </option>
<?php
}
}
//  }
?>
</select>
</div>
</div>
</div>
<div class="col-md-3">
<div class="form-group">
<div class="loadCity">
<label for="spPostingCity" class="">City</label>
<select class="form-control" name="spUserCity"
id="city">
<option>Select City</option>
<?php
$stateId = $userstate;

$co = new _city;
$result3 = $co->readCity($_SESSION['spPostState']);
//echo $co->ta->sql;
if ($result3 != false) {
while ($row3 = mysqli_fetch_assoc($result3)) { ?>
<option value='<?php echo $row3['city_id']; ?>'
<?php echo (isset($_SESSION['spPostCity']) && $_SESSION['spPostCity'] == $row3['city_id']) ? 'selected' : ''; ?>>
<?php echo $row3['city_title']; ?></option> <?php
}
} ?>
</select>
</div>
</div>



</div>

<div class="col-md-3">
<div class="form-group">
<div class="">
<label for="spPostingCity" class="">Zip</label>
<input type="text" class="form-control" id="zip"
placeholder="ZIP" required>
</div>
</div>



</div>

</div>
<div class="form-group">
<div class="form-check">
<input class="form-check-input" type="checkbox" value="1"
id="customer_check" required>
<label class="form-check-label" for="invalidCheck2">Receive
Email & Newsletter</label>
</div>
</div>
</div>
</div>
<div class="tab-pane" id="pt" role="tabpanel" aria-labelledby="pt-tab">
<div class="row">
<div class="col-4 mb-4">
<input type="text" class="form-control" id="saleprice"
placeholder="Sale Price" required>
</div>
<div class="col-4 mb-4">
<input type="text" class="form-control" id="tax" placeholder="TAX"
required>
</div>
<div class="col-4 mb-4">
<input type="text" class="form-control" id="discount_in"
placeholder="Discount" required>
</div>
</div>
</div>
<div class="tab-pane" id="cpt" role="tabpanel" aria-labelledby="cpt-tab">
<div class="row">
<div class="col-6">
<div class="d-flex me-1">
<select class="form-control form-select" id="select_payment"
name="paymentterm">
<option value="1">Cash</option>
<option value="2">Credit Card</option>
<option value="3">Bank Account</option>
</select>
</div>
</div>
<div class="col-6">
<div class="d-flex me-1">
<select class="form-control form-select" id="select_credit"
name="creditterm">
<option value="cod">COD</option>
<option value="week">Week</option>
<option value="10days">10days</option>
<option value="month">month</option>
</select>
</div>
</div>
</div>
</div>
<div class="tab-pane" id="note" role="tabpanel" aria-labelledby="note-tab">
<div class="row">
<div class="col-12">
<textarea class="form-control" id="notes" rows="3"></textarea>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
<div class="modal-footer">
<button type="button" class="btn btn-secondary" id="close_"
data-bs-dismiss="modal">Close</button>
<button type="button" onclick="fun_save_customer()" id="close_" data-bs-dismiss="modal"
class="btn btn-primary">Submit</button>
</div>
<!--</form>-->
</div>
</div>
</div>


<!--- Customer Edit--->
<div class="modal fade" id="customeredit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog modal-xl">
<div class="modal-content">
<div class="modal-header bg-primary text-light">
<h5 class="modal-title" id="exampleModalLabel">Customers Details</h5>
<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
<form>
<div class="row">
<div class="col-8">
<div class="mb-3">
<input type="text" class="form-control shadowBox" id="customerno_up"
placeholder="Customer#" value="" required>
</div>
<div class="mb-3">
<input type="text" class="form-control shadowBox" id="customername_up"
placeholder="Customer Name" value="" required>
</div>
<div class="mb-3">
<input type="text" class="form-control shadowBox" id="customerphone_up"
placeholder="Customer Phone" value="" required>
</div>
<div class="mb-3">
<input type="text" class="form-control shadowBox" id="customeremail_up"
placeholder="Customer Email" value="" required>
</div>
<div class="mb-3">
<select class="form-control form-select shadowBox" id="customertype_up"
name="customertype">
<option value="1">Type 1</option>
<option value="2">Type 2</option>
<option value="3">Type 3</option>
</select>
</div>
</div>
<div class="col-4">
<div class="profile-img mb-4">
<img src="img/profile.jpg"
class="img-sm img-fluid img-thumbnail float-end mb-2">
<input type="file" class="form-control shadowBox" name="profile-img">
</div>

</div>
</div>
<div class="row">
<div class="col-12">
<div class="tab-container-one">
<ul class="nav nav-tabs mb-5" id="myTab" role="tablist">
<li class="nav-item active">
<a class="nav-link active" href="#mailing" role="tab"
aria-controls="mailing" data-bs-toggle="tab">Mailing /
Preference</a>
</li>
<li class="nav-item">
<a class="nav-link" href="#pt" role="tab" aria-controls="pt"
data-bs-toggle="tab">Prices / Tax</a>
</li>
<li class="nav-item">
<a class="nav-link" href="#cpt" role="tab" aria-controls="cpt"
data-bs-toggle="tab">Credit & Payment Terms</a>
</li>
<li class="nav-item">
<a class="nav-link" href="#note" role="tab" aria-controls="note"
data-bs-toggle="tab">Note</a>
</li>
</ul>
<div class="tab-content">
<div class="tab-pane active mb-4" id="mailing" role="tabpanel"
aria-labelledby="mailing-tab">
<div class="row">
<div class="col-12 mb-4">
<input type="text" class="form-control" id="address_up"
placeholder="Address" required>
</div>
<div class="col-4 mb-4">
<input type="text" class="form-control" id="city_up"
placeholder="City" required>
</div>
<div class="col-4 mb-4">
<input type="text" class="form-control" id="zip_up"
placeholder="ZIP" required>
</div>
<div class="col-4 mb-4">
<input type="text" class="form-control" id="country_up"
placeholder="Country" required>
</div>
<div class="form-group">
<div class="form-check">
<input class="form-check-input" type="checkbox" value=""
id="invalidCheck2_up" required>
<label class="form-check-label" for="invalidCheck2">Receive
Email & Newsletter</label>
</div>
</div>
</div>
</div>
<div class="tab-pane" id="pt" role="tabpanel" aria-labelledby="pt-tab">
<div class="row">
<div class="col-4 mb-4">
<input type="text" class="form-control" id="saleprice_up"
placeholder="Sale Price" required>
</div>
<div class="col-4 mb-4">
<input type="text" class="form-control" id="tax_up"
placeholder="TAX" required>
</div>
<div class="col-4 mb-4">
<input type="text" class="form-control" id="discount_up"
placeholder="Discount" required>
</div>
</div>
</div>
<div class="tab-pane" id="cpt" role="tabpanel" aria-labelledby="cpt-tab">
<div class="row">
<div class="col-6">
<div class="d-flex me-1">
<select class="form-control form-select"
id="select-payment_up" name="paymentterm">
<option value="1">Cash</option>
<option value="2">Credit Card</option>
<option value="3">Bank Account</option>
</select>
</div>
</div>
<div class="col-6">
<div class="d-flex me-1">
<select class="form-control form-select"
id="select-credit_up" name="creditterm">
<option value="cod">COD</option>
<option value="week">Week</option>
<option value="10days">10days</option>
<option value="month">month</option>
</select>
</div>
</div>
</div>
</div>
<div class="tab-pane" id="note" role="tabpanel" aria-labelledby="note-tab">
<div class="row">
<div class="col-12">
<textarea class="form-control" id="notes_up"
rows="3"></textarea>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
<div class="modal-footer">
<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
<button type="button" class="btn btn-primary">Update</button>
</div>
</form>
</div>
</div>
</div>
<!-- Modal Product Details -->
<div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header bg-success text-light">
<h5 class="modal-title" id="exampleModalLabel">Products Details</h5>
<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
<form>
<div class="row">
<div class="col-12 mb-3">
<input type="text" class="form-control shadowBox" id="barcode_in"
placeholder="Barcode" value="" onkeyup="checkbarcode(this.value)" required>
<span id="barcode_error" style="color: red;"></span>
<input type="hidden" value="1" id="barcode_validate">
</div>
<div class="col-12 mb-3">
<input type="text" class="form-control shadowBox" id="productname_in"
placeholder="product Name" value="" required>
</div>
<!-- <div class="col-4 mb-3">
<input type="text" class="form-control shadowBox" id="purchaseprice_in" placeholder="Purchase Price" value="" required>
</div>-->
<div class="col-6 mb-3">
<input type="text" class="form-control shadowBox" id="cost_in" placeholder="Cost"
value="" required>
</div>
<div class="col-6 mb-3">
<input type="text" class="form-control shadowBox" id="saleprice_in"
placeholder="Discount Price" value="" required>
</div>
<!--<div class="col-4 mb-3">
<input type="text" class="form-control shadowBox" id="color_in" placeholder="Color" value="" required>
</div>
<div class="col-4 mb-3">
<input type="text" class="form-control shadowBox" id="size_in" placeholder="Size" value="" required>
</div>
<div class="col-4 mb-3">
<input type="text" class="form-control shadowBox" id="tax_in" placeholder="TAX" value="" required>
</div>-->
<div class="col-12 mb-3">
<select class="form-control form-select shadowBox" id="product_cat_in"
name="product-cat">
<option value="uncategories" selected>Select Category</option>

<?php


$m = new _subcategory;
$catid = 1;
$result = $m->read($catid);

if ($result) {

while ($rows = mysqli_fetch_assoc($result)) {


?>
<option value="<?php echo ucwords(strtolower($rows['subCategoryTitle'])); ?>">
<?php echo ucwords(strtolower($rows["subCategoryTitle"])); ?></option>

<?php
}
}
?>



</select>
</div>
<!--<div class="col-6 mb-3">
<select class="form-control form-select shadowBox" id="product_sub_cat_in" name="product-sub-cat">
<option value="uncategories" selected>Select Sub Category</option>
<option value="dryFruits">Dray Fruits</option>
<option value="Fresh Fruit">Fresh Fruits</option>
<option value="Import Fruits Item">Import Fruit Items</option>
</select>
</div>-->
<div class="col-12 mb-3">
<textarea class="form-control shadowBox" id="description_in" rows="3"></textarea>
</div>
<div class="col-12 mb-3">
<input type="file" class="form-control shadowBox" id="image_product"
name="productimage">
</div>
</div>
</div>
<div class="modal-footer">
<button type="button" class="btn btn-secondary" id="close_2"
data-bs-dismiss="modal">Close</button>
<button type="button" onclick="fun_product_add()" class="btn btn-success">Submit</button>
</div>
</form>
</div>
</div>
</div>
</div>
<!-- Modal Discount Details -->
<div class="modal fade" id="discountModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog modal-sm">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title" id="exampleModalLabel">Discount</h5>
<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
<div class="row">
<div class="col-12 mb-3">
<input class="form-check-input" type="radio" name="discount" value="" id="invalidCheck2_">
Percentage
<input class="form-check-input" type="radio" name="discount" value="" id="invalidCheck2_">
Flat Discount
</div>
<div class="col-12 mb-3">
<input type="text" class="form-control shadowBox" id="percentage"
placeholder="Discount Value" value="">
</div>
<div class="form-group">
<div class="form-check">
<input class="form-check-input" type="checkbox" value="" id="invalidCheck2" required>
<label class="form-check-label" for="invalidCheck2_">Apply discount on all
products?</label>
</div>
</div>
</div>
</div>
<div class="modal-footer">
<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
<button type="button" class="btn btn-warning">Save changes</button>
</div>
</div>
</div>
</div>



<!-- Modal Discount Details -->
<div class="modal fade" id="membership_Modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog modal-sm">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title" id="exampleModalLabel">Deduct Membership</h5>
<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
<div class="row">
<input type="text" class="form-control shadowBox" id="member_ship_" placeholder="Enter no."
value="">
</div>
</div>
<div class="modal-footer">
<button type="button" class="btn btn-secondary" id="close_3" data-bs-dismiss="modal">Close</button>
<button type="button" onclick="fun_membership()" class="btn btn-warning">Save</button>
</div>
</div>
</div>
</div>

<!-- Modal Discount Details -->
<div class="modal fade" id="discountModal_1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog modal-sm">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title" id="exampleModalLabel"></h5>
<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">

<div class="row text-center" style="color:red">
<h4> Please Fill The Quantity </h4>
</div>
<!--<div class="row">
<div class="col-12 mb-3">
<input class="form-check-input" type="radio" name="discount" value="" id="invalidCheck2"> Percentage
<input class="form-check-input" type="radio" name="discount" value="" id="invalidCheck2"> Flat Discount
</div>
<div class="col-12 mb-3">
<input type="text" class="form-control shadowBox" id="percentage" placeholder="Discount Value" value="">
</div> 
<div class="form-group">                        
<div class="form-check">
<input class="form-check-input" type="checkbox" value="" id="invalidCheck2" required>
<label class="form-check-label" for="invalidCheck2">Apply discount on all products?</label>
</div>
</div>                    
</div>-->
</div>
<div class="modal-footer">
<!--<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>-->

</div>
</div>
</div>
</div>

<!-- Modal Customer -->
<div class="modal fade" id="paymentterm" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog modal-lg">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title" id="exampleModalLabel">Payment Terms</h5>
<span id="success_msg" style="color:green;margin-left: 150px; display:none;">Payment Link Sent
Successfully</span>
<span id="success_msg_otp" style="color:green;margin-left: 150px; display:none;">OTP Has Sent
Successfully</span>
<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
<div class="row ">
<!--<div class="col-6 ">
<span class="border border-sucess bg-dark text-warning float-end ps-5 pe-5 pt-2 pb-2 mb-3 shadowBox" style="width:100%">Balance:  $250.00 </span>  
<table id="example" class="table bg-light table-striped shadowBox table-responsive">
<thead>
<tr>
<th>Tender</th>
<th>Foriegn</th>
<th>Local</th>                           
</tr>
</thead>
<tbody>
<tr>
<td>Bannana</td>
<td>N/A</td>
<td>N/A</td>                           
</tr>
</tbody>
<tfoot>
<tr>
<td colspan="2">Total: $25.00</td>
<td><i class="fas fa-trash text-danger"></i></td>                          
</tr>
</tfoot>
</table>
</div>-->
<input type="hidden" id="pay_rand_no" value="<?php echo rand(111111, 999999); ?>">
<div class="col-2">
<form action="" method="POST">
<input type="hidden" name="total_d" id="total_d" value="">

</form>


</div>
<div class="col-9 text-center">
<div class="row">
<div class="col-md-7">
<div class="input-group mb-2">
<div class="input-group-text" id="btnGroupAddon2">Enter Amount</div>
<input type="text" class="form-control" id="payment_amount_"
aria-label="Input group example" aria-describedby="btnGroupAddon2">

</div>
</div>
</div>
<div class="row">
<div class="col-md-5 ">
<input type="radio" value="1" id="email_pay_link" name="peyment"
onclick="fun_mail(1);">
<label for="email_pay_link">Email Payment Link</label>
<br>
<br>
<input type="radio" value="2" id="open_pay_page" name="peyment"
onclick="peyment_d(2)" style="margin-left: 5px;">
<label for="open_pay_page">Open Payment Page</label>
<br>
<br>
<input type="radio" value="3" id="peyment_done" name="peyment"
onclick="payment_done(3)" style="margin-left: -33px;">
<label for="peyment_done"> Payment Done</label>
<br>
<br>
<input type="radio" value="4" id="html" name="peyment" onclick="peyment_opt(4)"
style="margin-left: -68px;">
<label for="html"> Send OTP</label>

<br>
<br>
<input type="radio" value="5" id="show_QR" name="peyment" onclick="QR_peyment(5)"
style="margin-left: -30px;">
<label for="show_QR"> Show QR Code</label>


<!--<button type="button" id="payment_link_btn" onclick="fun_mail();" class="btn btn-main me-2 ">Email Payment Link</button>-->


</div>
<div class="col-md-2 pull-right">
<button type="button" id="status_fun" class="btn btn-danger me-2 "
style="display:none;">Pending</button>
<button type="button" id="status_fun_1" style="display:none;"
class="btn btn-success me-2 ">Success</button>

</div>
<div class="col-md-5 pull-right">
<div id="qr">

</div>
</div>

</div>
<br>
<div class="row">
<div class="col-md-4 ">



<!--<button class="btn btn-info text-right" onclick="peyment_d()" id="peyment_d" target="blank">Open Peyment Page</button>-->
</div>
</div>


<!-- <div class="d-flex flex-wrap" role="group" aria-label="First group">
<!--<button type="button" id="" class="btn btn-outline-secondary me-2 mb-2">Cash</button>
<button type="button" class="btn btn-outline-secondary me-2 mb-2">Visa</button>
<button type="button" class="btn btn-outline-secondary me-2 mb-2">Master</button>
<button type="button" class="btn btn-outline-secondary me-2 mb-2">American Express</button>
<button type="button" class="btn btn-outline-secondary me-2 mb-2">Amex</button>
<button type="button" class="btn btn-outline-secondary me-2 mb-2">Cheque</button>
<button type="button" class="btn btn-outline-secondary me-2 mb-2">Redeem</button>
<button type="button" class="btn btn-outline-secondary me-2 mb-2">Debit Card</button>




<style>

.input-radio{
display: inline-block;
margin-right: 10px;
margin-top: 30px;
}
input[type=radio] {
display: none;
}
input[type=radio] + label {
padding: 20px;
border-radius: 40px;
border: 1px solid #ddd;

}
input[type=radio] + label:hover {
border: 1px solid red;
}
input[type=radio]:checked + label {
border: 1px solid red;
}
#m_d{
width:195%;
}
.bg_color{background-color:white;}
.butn_cancel {
color: #fff;
border-radius: 0;
font-size: 14px;
min-width: 130px;
background-color: orange;
}


</style>







<div class="input-radio"><input type="radio"  id="Cash" name="payment_method" value="Cash" ><label for="Cash">Cash</label></div>

<div class="input-radio"> <input type="radio"  id="Visa" name="payment_method" value="Visa"  ><label for="Visa">Visa</label></div>

<div class="input-radio"><input type="radio"  id="Master"  name="payment_method"  value="Master" ><label for="Master">Master</label></div>

<div class="input-radio"> <input type="radio"  id="American_Express"  name="payment_method" value="American Express" ><label for="American_Express">American Express</label></div>

<div class="input-radio"><input type="radio" id="Amex" name="payment_method" value="Amex" ><label for="Amex">Amex</label></div>

<div class="input-radio"><input type="radio"  id="Cheque"  name="payment_method" value="Cheque" ><label for="Cheque">Cheque</label></div>

<div class="input-radio"> <input type="radio" id="Redeem" name="payment_method" value="Redeem" ><label for="Redeem">Redeem</label></div>

<div class="input-radio"><input type="radio"  id="Debit_Card" name="payment_method" value="Debit Card" ><label for="Debit_Card">Debit Card</label></div> 


</div>-->


<style>
:root {
--main-second: #3e2048;
--ylight: #c2e6ed;
--glight: #C3DBBE;
}
</style>
</div>
</div>

</div>
<div class="modal-footer">
<div class="">
<div class="d-flex me-1">
<div class="form-group">
<div class="form-check me-3">
<input class="form-check-input" type="checkbox" value="" name="print_invoice"
id="print_invoice_" required>
<label class="form-check-label" for="invalidCheck2">Print Invoice</label>
</div>
</div>
<div class="form-group me-3">
<div class="form-check">
<input class="form-check-input" type="checkbox" value="" id="invalidCheck2"
required>
<label class="form-check-label" for="invalidCheck2">Email</label>
</div>
</div>
<div class="form-group me-3">
<div class="form-check">
<input class="form-check-input" type="checkbox" value="" id="invalidCheck2"
required>
<label class="form-check-label" for="invalidCheck2">To Screen</label>
</div>
</div>
</div>
</div>
<button type="button" class="btn btn-secondary" id="close_4" data-bs-dismiss="modal">Close</button>
<button type="button" onclick="final_payment()" class="btn btn-success">OK</button>
</div>
</div>
</div>
</div>


<!------------------------------------------ Scripts Files ------------------------------------------>
<script src="<?php echo $baseurl?>/assets/js/sweetalert.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"
integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA=="
crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"
integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"
integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous">
</script>
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.12.1/datatables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"
integrity="sha512-ElRFoEQdI5Ht6kZvyzXhYG9NqjtkmlkfYk0wr6wHxU9JEHakS7UJZNeml5ALk+8IKlU6jDgMabC3vkumRokgJA=="
crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script type="text/javascript" src="js/custom-chart.js"></script>
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
function peyment_d(peyment_type) {
/*var pr = $('#total_d').attr("value");
//alert(hv);
window.location.replace('<?php echo $BaseUrl; ?>/store/pos-dashboard/peyment.php?price='+pr);*/

//alert(type);


var rand_val = $('#rand_val').val();
var rand_val = parseInt(rand_val);
rand_val = rand_val - 1;
//alert(rand_val);
var customer_id = $('#customer_id').val();
var payment_amount = $('#payment_amount_').val();

//alert(payment_amount); 

var value1 = $('#sub_total_2').val();

var type_payment = $("input[type='radio'][name='payment_method']:checked").val();
//alert(type_payment);

if (type_payment == undefined) {
//alert('==');
type_payment = " ";

}
//alert(type_payment);

//alert(print_invoice);

var sub_total = $('#sub_total_1').val();
var discount_by_net = $('#discount_by_net').val();
var total_by_net = $('#total_by_net').val();
var total_tax = $('#total_tax').val();
var Gross_net = $('#Gross_net_1').val();
var pay_rand_no = $('#pay_rand_no').val();
var email = $('#email_').val();
var email = $('#email_').val();
var phone = $('#phone_').val();
//alert(phone);
var currency = "<?php echo $curr; ?>";
//alert(currency); 
var biller_id = $('#biller_id').val();



$.ajax({
url: 'add_pos_customer_id.php',
type: 'post',

data: {
customer_id: customer_id,
sub_total: sub_total,
discount_by_net: discount_by_net,
total_by_net: total_by_net,
total_tax: total_tax,
Gross_net: Gross_net,
payment_amount: payment_amount,
type_payment: type_payment,
pay_rand_no: pay_rand_no,
peyment_type: peyment_type,
phone_number: phone,
currency: currency,
biller_id: biller_id,
without_tax: value1

},

success: function(cid) {
var id = cid.trim();;

//alert(id);
window.open('<?php echo $BaseUrl; ?>/store/pos-dashboard/peyment.php?id=' + id, "_blank");

/*window.location.replace('<?php echo $BaseUrl; ?>/store/pos-dashboard/peyment.php?id='+id);*/

$.ajax({
url: 'send_mail_by_id.php',
type: 'post',

data: {
email: email,
customer_id: customer_id,
pay_rand_no: pay_rand_no
},

success: function(response) {
//$('#close_3').click(); 
$('#status_fun').show();
$('#success_msg').show();
document.getElementById("payment_link_btn").disabled = true;
}

});

var id = cid.trim();

for (let i = rand_val; i != 0; i--) {
// alert("hello");


var barcode = document.getElementById('bar' + i).getAttribute('value');
var product_name = document.getElementById('pro_title' + i).getAttribute('value');
var color = document.getElementById('color' + i).getAttribute('value');
var size = document.getElementById('size' + i).getAttribute('value');
var quantity = document.getElementById('qun' + i).getAttribute('value');
var unit_price = document.getElementById('pri' + i).getAttribute('value');
var discount = document.getElementById('dis' + i).getAttribute('value');
var total_price = document.getElementById('net' + i).getAttribute('value');
var customer_id = cid;
var customer_id = $('#customer_id').val();
var membership_id = $('#membership_id').val();

// alert(Gross_net);  

$.ajax({
url: 'add_pos_detail.php',
type: 'post',

data: {
barcode: barcode,
product_name: product_name,
color: color,
size: size,
quantity: quantity,
unit_price: unit_price,
discount: discount,
total_price: total_price,
customer_id: id,
membership_id: membership_id,
customerr_user_id: customer_id,

currency: currency

},

success: function(response) {
//$('#close_4').click();   


//window.location.href = "history_sales.php?id="+cid; 

}

});



}


}

});


}

function QR_peyment(peyment_type) {
/*var pr = $('#total_d').attr("value");
//alert(hv);
window.location.replace('<?php echo $BaseUrl; ?>/store/pos-dashboard/peyment.php?price='+pr);*/

//alert(type);


var rand_val = $('#rand_val').val();
var rand_val = parseInt(rand_val);
rand_val = rand_val - 1;
//alert(rand_val);
var customer_id = $('#customer_id').val();
var payment_amount = $('#payment_amount_').val();

//alert(payment_amount); 
var value1 = $('#sub_total_2').val();

var type_payment = $("input[type='radio'][name='payment_method']:checked").val();
//alert(type_payment);

if (type_payment == undefined) {
//alert('==');
type_payment = " ";

}
//alert(type_payment);

//alert(print_invoice);

var sub_total = $('#sub_total_1').val();
var discount_by_net = $('#discount_by_net').val();
var total_by_net = $('#total_by_net').val();
var total_tax = $('#total_tax').val();
var Gross_net = $('#Gross_net_1').val();
var pay_rand_no = $('#pay_rand_no').val();
var email = $('#email_').val();
var email = $('#email_').val();
var phone = $('#phone_').val();
//alert(phone);
var currency = "<?php echo $curr; ?>";
//alert(currency); 

$.ajax({
url: 'add_pos_customer_id.php',
type: 'post',

data: {
customer_id: customer_id,
sub_total: sub_total,
discount_by_net: discount_by_net,
total_by_net: total_by_net,
total_tax: total_tax,
Gross_net: Gross_net,
payment_amount: payment_amount,
type_payment: type_payment,
pay_rand_no: pay_rand_no,
peyment_type: peyment_type,
phone_number: phone,
currency: currency,
without_tax: value1

},

success: function(cid) {
var id = cid.trim();

$("#qr").html(
'<img src="https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=https://dev.thesharepage.com/store/pos-dashboard/qr_peyment.php?id=' +
id + '" title="Link to thesharepage.com" />');
//alert(id);
//window.open('<?php echo $BaseUrl; ?>/store/pos-dashboard/peyment.php?id=' + id, "_blank");

/*window.location.replace('<?php echo $BaseUrl; ?>/store/pos-dashboard/peyment.php?id='+id);*/

$.ajax({
url: 'send_mail_by_id.php',
type: 'post',

data: {
email: email,
customer_id: customer_id,
pay_rand_no: pay_rand_no
},

success: function(response) {
//$('#close_3').click(); 
$('#status_fun').show();
$('#success_msg').show();
document.getElementById("payment_link_btn").disabled = true;
}

});

var id = cid.trim();

for (let i = rand_val; i != 0; i--) {
// alert("hello");


var barcode = document.getElementById('bar' + i).getAttribute('value');
var product_name = document.getElementById('pro_title' + i).getAttribute('value');
var color = document.getElementById('color' + i).getAttribute('value');
var size = document.getElementById('size' + i).getAttribute('value');
var quantity = document.getElementById('qun' + i).getAttribute('value');
var unit_price = document.getElementById('pri' + i).getAttribute('value');
var discount = document.getElementById('dis' + i).getAttribute('value');
var total_price = document.getElementById('net' + i).getAttribute('value');
var customer_id = cid;
var customer_id = $('#customer_id').val();
var membership_id = $('#membership_id').val();

// alert(Gross_net);  

$.ajax({
url: 'add_pos_detail.php',
type: 'post',

data: {
barcode: barcode,
product_name: product_name,
color: color,
size: size,
quantity: quantity,
unit_price: unit_price,
discount: discount,
total_price: total_price,
customer_id: id,
membership_id: membership_id,
customerr_user_id: customer_id,

currency: currency

},

success: function(response) {
//$('#close_4').click();   


//window.location.href = "history_sales.php?id="+cid; 

}

});



}


}

});


}






function peyment_opt(peyment_type) {
/*var pr = $('#total_d').attr("value");
//alert(hv);
window.location.replace('<?php echo $BaseUrl; ?>/store/pos-dashboard/peyment.php?price='+pr);*/

//alert(type);


var rand_val = $('#rand_val').val();
var rand_val = parseInt(rand_val);
rand_val = rand_val - 1;
//alert(rand_val);
var customer_id = $('#customer_id').val();
var payment_amount = $('#payment_amount_').val();

//alert(payment_amount); 
var value1 = $('#sub_total_2').val();

var type_payment = $("input[type='radio'][name='payment_method']:checked").val();
//alert(type_payment);

if (type_payment == undefined) {
//alert('==');
type_payment = " ";

}
//alert(type_payment);

//alert(print_invoice);

var sub_total = $('#sub_total_1').val();
var discount_by_net = $('#discount_by_net').val();
var total_by_net = $('#total_by_net').val();
var total_tax = $('#total_tax').val();
var Gross_net = $('#Gross_net_1').val();
var pay_rand_no = $('#pay_rand_no').val();
var email = $('#email_').val();
var email = $('#email_').val();
var phone = $('#phone_').val();

var currency = "<?php echo $curr; ?>";
//alert(currency); 

$.ajax({
url: 'add_pos_customer_id.php',
type: 'post',

data: {
customer_id: customer_id,
sub_total: sub_total,
discount_by_net: discount_by_net,
total_by_net: total_by_net,
total_tax: total_tax,
Gross_net: Gross_net,
payment_amount: payment_amount,
type_payment: type_payment,
pay_rand_no: pay_rand_no,
peyment_type: peyment_type,
phone_number: phone,
currency: currency,
without_tax: value1

},

success: function(cid) {
var id = cid.trim();;

//alert(id);
window.open('<?php echo $BaseUrl; ?>/store/pos-dashboard/payment_otp.php?id=' + id,
"_blank");

/*window.location.replace('<?php echo $BaseUrl; ?>/store/pos-dashboard/peyment.php?id='+id);*/

$.ajax({
url: 'send_mail_by_id_code.php',
type: 'post',

data: {
email: email,
customer_id: customer_id,
pay_rand_no: pay_rand_no
},

success: function(response) {
//$('#close_3').click(); 
$('#status_fun').show();
$('#success_msg_otp').show();
document.getElementById("payment_link_btn").disabled = true;
}

});

var id = cid.trim();

for (let i = rand_val; i != 0; i--) {
// alert("hello");


var barcode = document.getElementById('bar' + i).getAttribute('value');
var product_name = document.getElementById('pro_title' + i).getAttribute('value');
var color = document.getElementById('color' + i).getAttribute('value');
var size = document.getElementById('size' + i).getAttribute('value');
var quantity = document.getElementById('qun' + i).getAttribute('value');
var unit_price = document.getElementById('pri' + i).getAttribute('value');
var discount = document.getElementById('dis' + i).getAttribute('value');
var total_price = document.getElementById('net' + i).getAttribute('value');
var customer_id = cid;
var customer_id = $('#customer_id').val();
var membership_id = $('#membership_id').val();

// alert(Gross_net);  

$.ajax({
url: 'add_pos_detail.php',
type: 'post',

data: {
barcode: barcode,
product_name: product_name,
color: color,
size: size,
quantity: quantity,
unit_price: unit_price,
discount: discount,
total_price: total_price,
customer_id: id,
membership_id: membership_id,
customerr_user_id: customer_id,

currency: currency

},

success: function(response) {
//$('#close_4').click();   


//window.location.href = "history_sales.php?id="+cid; 

}

});



}


}

});


}


function edit_tax() {
//alert('===');  

$("#tax_edit").modal('show');


}
</script>



<script type="text/javascript">
/* $(document).ready(function () {
$('#example').DataTable();
"columnDefs": [
{ "searchable": false, "targets": 0 }
]
});*/
</script>
<script type="text/javascript">
$(document).ready(function() {
$('.js-example-basic-multiple').select2();

$('#add_submit').click(function() {

//alert('hello');
var currency = "<?php echo $curr; ?>";
var barcode = $('#product_id_').val();

var quantity = $('#quantity_').val();

if (quantity == undefined) {

$("#discountModal_1").modal('show');
return false;
}

if (quantity != "") {
quantity = quantity;
} else {

$("#discountModal_1").modal('show');
return false;
}
var title_pro = $('#title_pro').val();

var discount = $('#discount_').val();
$('#discount_change').val(discount);
//alert(discount);				
var select_currency = $('#select_currency').val();
var price = $('#price_').val();

var size = $('#size_').val();
if (size != "") {
size = size;
} else {
size = 'N/A';
}
var color = $('#color_').val();
if (color != "") {
color = color;
} else {
color = 'N/A';
}
//alert(select_currency);

if (select_currency == "%") {
if (discount != "") {
discount_new = discount + select_currency;
} else {
discount_new = 'N/A';
}
var total_price = quantity * price;
var total_gross = (total_price * discount) / 100;
var net = (total_price - total_gross);
} else {
if (discount != "") {
discount_new = discount + select_currency;
} else {
discount_new = 'N/A';
}

var total_price = quantity * price;
//var total_gross= (total_price*discount)/100;
var net = (total_price - discount);

}




var rand_val = $('#rand_val').val();
//alert(rand_val);

var record_add = '<tr id = "id' + rand_val + '" ><td id="bar' + rand_val + '" value="' +
barcode + '" >' + barcode + '</td ><td id="pro_title' + rand_val + '" value="' +
title_pro + '" >' + title_pro + '</td><td><input type="text" onkeyup="fun_quantity(' +
rand_val + ')" id="qun' + rand_val + '" name="" value="' + quantity +
'" width="50" style="width: 50px;"></td><td><input id="pri' + rand_val +
'" onkeyup="fun_price(' + rand_val + ')" type="text" name="" value="' + price +
'" style="width: 50px;"></td><td id="net' + rand_val + '" value="' + net + '" >' +
currency + '  ' + net + '</td> <td> <a href="#" onclick="fun_record(' + rand_val +
')" class="text-danger"> <i class="fas fa-trash"></i></a> </td></tr>';

//alert(record_add);		
$('#append_tr').append(record_add);
//alert(rand_val);

var iNum = parseInt(rand_val);

var sub_to = parseInt(document.getElementById('net' + iNum).getAttribute('value'));
//alert(sub_to);   

var sub_total = $('#sub_total_1').val();
sub_total = parseInt(sub_total);
var sub_tot = sub_total + sub_to;
//alert(sub_tot);   
$('#sub_total_').val(sub_tot);
$('#sub_total_1').val(sub_tot);
$('#sub_total_2').val(sub_tot);
$('#Gross_net_').text("Total: " + currency + " " + sub_tot + ".00");
$('#payment_amount_').val(sub_tot);
$('#discount_by_net').val('0');
$('#total_tax').val('0');

var sub_total = $('#sub_total_1').val();
sub_total = parseInt(sub_total);





var rand_val_1 = iNum + 1;
$('#rand_val').val(rand_val_1);
//alert(rand_val_1);	 		 

$('#product_id_').val('');
$('#product_name_').val('');
$('#color_').val('');
$('#size_').val('');
$('#quantity_').val('');
$('#price_').val('');
$('#discount_').val('');
$('#discount_change').val();



});

});


function fun_id_new(id) {
//alert(id);
var id = id;
var b = id.length;
var phone = id;
//if(b<12){
//alert(b);
//   var phone = $('#phone_').val();

//}else{
//alert('number should be in 10 digit');
//  return false;
//}
var tbl = "pos_customer";
$.ajax({
url: 'read_data_id.php',
type: 'post',
data: {
'phone': phone,
tbl: tbl
},
dataType: "JSON",

success: function(response) {

var customer_id = response.id;
$('#phone_').val(phone);
//$('#customer_id').val(response.id);
$('#customer_id').val(response.posid);
//alert(response.id);
//alert(response.email);  
$('#email_').val(response.email);
$('#cust').html('<a target="_blank"href="<?php echo $BaseUrl ?>/store/pos-dashboard/customer-edit.php?postid='+response.posid +'" class="btn btn-success fa fa-eye"> View</a>');

//https://dev.thesharepage.com/store/pos-dashboard/customer-edit.php?postid=customer_id

var linkHTML = '<a href="/store/pos-dashboard/customer-edit.php?postid=' + customer_id +
'" class="form-control fa fa-eye"> View</a>';
$('#plus').html(linkHTML);
$('#customer_name_').val(response.customer_name);
$('#m_modal').css("display", "block");
var tbl = "pos_membership_barcode";
$.ajax({
url: 'read_data_id.php',
type: 'post',
data: {
'id': response.id,
tbl: tbl
},
dataType: "JSON",

success: function(data) {
//alert(data.quantity);
//alert(data.msg);
if (data.quantity != '') {
//$('#box11_').text("Membership left:" + data.quantity);
} else {
//$('#box11').text("membership not assign");

}

}

});

}


});
}





function fun_id(id) {
var id = $('#phone_').val();
var b = id.length;
var phone = $('#phone_').val();
//if(b<12){
//alert(b);
//	 var phone = $('#phone_').val();

//}else{
//alert('number should be in 10 digit');
//	return false;
//}
var tbl = "spuser";
$.ajax({
url: 'read_data_id.php',
type: 'post',
data: {
'phone': phone,
tbl: tbl
},
dataType: "JSON",

success: function(response) {

var customer_id = response.id;

$('#customer_id').val(response.id);
//alert(response.id);
//alert(response.email);  
$('#email_').val(response.email);

//https://dev.thesharepage.com/store/pos-dashboard/customer-edit.php?postid=customer_id

var linkHTML = '<a href="/store/pos-dashboard/customer-edit.php?postid=' + customer_id +
'" class="form-control fa fa-eye"> View</a>';
$('#plus').html(linkHTML);
$('#customer_name_').val(response.customer_name);
$('#m_modal').css("display", "block");
var tbl = "pos_membership_barcode";
$.ajax({
url: 'read_data_id.php',
type: 'post',
data: {
'id': response.id,
tbl: tbl
},
dataType: "JSON",

success: function(data) {
//alert(data.quantity);
//alert(data.msg);
if (data.quantity != '') {
$('#box11_').text("Membership left:" + data.quantity);
} else {
$('#box11').text("membership not assign");

}

}

});

}


});
}



function fun_product_id_new(valuebar) {
var barcode_id = valuebar;
var phone = $('#product_id_').val();
//var b =  id.length;
//if(b<12){
//alert(b);
// var phone = $('#product_id_').val();

//}else{
///alert('number should be in 10 digit');
//return false;
//} 

// var id = $('#select_product').val();
var tbl = "spproduct";
//alert(id);
$.ajax({
url: 'read_data_id.php',
type: 'post',
data: {
'barcode_id': barcode_id,
tbl: tbl
},
dataType: "JSON",

success: function(response) {
//alert(response.price);
//console.log(response); 
$('#price_').val(response.price);
$('#membership_id').val(response.category);
// $('#product_id_').val(response.id);
$('#product_id_').val(response.proid);
$('#title_pro').val(response.title);
$('#product_name_').val(response.title);
$('#add_size').html(response.size);
$('#add_color').html(response.color);
$('#add_quantity').html(response.quantity);
$('#quantity_').val('1');
$('#view').html('<a target="_blank"href="<?php echo $BaseUrl ?>/store/pos-dashboard/edit-product.php?postid='+response.proid +'" class="btn btn-success fa fa-eye"> Product</a>');





}

});
}





function fun_product_id() {

var barcode_id = $('#product_id_').val();
var phone = $('#product_id_').val();
//var b =  id.length;
//if(b<12){
//alert(b); 
// var phone = $('#product_id_').val();

//}else{
///alert('number should be in 10 digit');
//return false;
//} 

// var id = $('#select_product').val();
var tbl = "spproduct";
//alert(id);
$.ajax({
url: 'read_data_id.php',
type: 'post',
data: {
'barcode_id': barcode_id,
tbl: tbl
},
dataType: "JSON",

success: function(response) {
//alert(response.price);
//console.log(response); 
$('#price_').val(response.price);
$('#membership_id').val(response.category);
$('#product_id_').val(response.id);
$('#title_pro').val(response.title);
$('#product_name_').val(response.title);
$('#add_size').html(response.size);
$('#add_color').html(response.color);
$('#add_quantity').html(response.quantity);
$('#quantity_').val('1');




}

});
}


function fun_record(id) {

//alert(id);


var currency = "<?php echo $curr; ?>";

var sub_to = parseInt(document.getElementById('net' + id).getAttribute('value'));
//alert(sub_to);   

var sub_total = $('#sub_total_').val();
sub_total = parseInt(sub_total);
var sub_tot = sub_total - sub_to;
//alert(sub_tot);   
$('#sub_total_').val(sub_tot);
$('#sub_total_1').val(sub_tot);
//alert(sub_tot);

$('#Gross_net_').text("Total: " + currency + " " + sub_tot + ".00");
$('#payment_amount_').val(sub_tot);
$('#discount_by_net').val('0');
$('#total_tax').val('0');
$('#total_by_net').val('0');


//$('#id'+id).hide();

}


function payment_fun() {


//alert('hello');
var phone = $('#phone_').val();
//var product_id = $('#product_id_').val();
if (phone != "") {
$("#paymentterm").modal('show');
} else {
//alert("Please Fill the Contact Number And Barcode");  
Swal.fire('Please Fill the Customer Details')
}

}

function membership_fun() {

//alert('hello');
var phone = $('#phone_').val();
//var product_id = $('#product_id_').val();  
if (phone != "") {
var id = $('#customer_id').val();
//alert(id);
window.location.replace('<?php echo $BaseUrl ?>/store/pos-dashboard/membership_history.php?id=' + id + '');
//$("#membership_Modal").modal('show'); 
} else {
alert("Please Fill the Contact Number  ");
}


}

function fun_quantity(id) {

var sub_to_old = parseInt(document.getElementById('net' + id).getAttribute('value'));


var quan = $('#qun' + id).val();
var price_1 = $('#pri' + id).val();
var discnt = $('#discount_change').val();
//var net_new = quan*
var total_price = quan * price_1;
var total_gross = (total_price * discnt) / 100;
var net_new = (total_price - total_gross);
$('#net' + id).text(net_new);


var sub_total = $('#sub_total_1').val();
var sub_total1 = sub_total - sub_to_old;
var sub_tot = sub_total1 + net_new;
var sub_tot1 = sub_total1 + total_price;
$('#Gross_net_').text('Total: USD ' + sub_tot1);
$('#sub_total_').val(sub_tot1);
$('#sub_total_1').val(sub_tot1);
//  alert(sub_tot1);
//  alert(total_price);
}


function fun_price(id) {

//alert(id);
var quan = $('#qun' + id).val();
var price_1 = $('#pri' + id).val();
var discnt = $('#discount_change').val();
//var net_new = quan*

var total_price = quan * price_1;
var total_gross = (total_price * discnt) / 100;
var net_new = (total_price - total_gross);
$('#net' + id).text(net_new);
// $('#Gross_net_').text('Total: USD ' + net_new); 	
// $('#sub_total_').val(net_new);
}


function fun_discount(id) {



var currency = "<?php echo $curr; ?>";
var sub_total_2 = $('#sub_total_1').val();
sub_total_2 = parseInt(sub_total_2);


var discount_total_2 = $('#discount_by_net').val();
discount_total_2 = parseInt(discount_total_2);

// var total_1_net =  (sub_total_2*discount_total_2)/100;
if (Number.isNaN(discount_total_2)) {
//alert(sub_total_2);					   
$('#total_by_net').val(sub_total_2);
$('#total_d').val(sub_total_2);
$('#Gross_net_').text("Total: " + currency + " " + sub_total_2 + ".00");
$('#Gross_net_1').val(sub_total_2);
$('#payment_amount_').val(sub_total_2);

} else {

var total_12_net = (sub_total_2 - discount_total_2);
//alert(total_12_net);		
$('#total_by_net').val(total_12_net);
$('#total_d').val(total_12_net);
$('#Gross_net_').text("Total: " + currency + " " + total_12_net + ".00");
$('#Gross_net_1').val(total_12_net);
$('#payment_amount_').val(total_12_net);

}

/*var total_tax = $('#total_tax').val();	
total_tax = parseInt(total_tax);	

var total_by_net_1 = $('#total_by_net').val();	
total_by_net_1 = parseInt(total_by_net_1);*/

/*var amount_total =  total_tax+ total_by_net_1; 
alert(amount_total);
$('#Gross_net_').Text("Total: $"+amount_total); */
}

function fun_tax(id) {
var currency = "<?php echo $curr; ?>";
var total_tax = $('#total_tax').val();
total_tax = parseInt(total_tax);

var total_by_net_1 = $('#total_by_net').val();
total_by_net_1 = parseInt(total_by_net_1);
if (Number.isNaN(total_tax)) {
$('#Gross_net_').text("Total: " + currency + " " + total_by_net_1 + ".00");
$('#Gross_net_1').val(total_by_net_1);
$('#payment_amount_').val(total_by_net_1);
} else {

var amount_total = total_tax + total_by_net_1;
//alert(amount_total);
$('#Gross_net_').text("Total: " + currency + " " + amount_total + ".00");
$('#Gross_net_1').val(amount_total);
$('#payment_amount_').val(amount_total);
}
}
</script>
<script>
function fun_save_customer() {
// alert('hello');	
//var formData = new FormData(); 
// formData.append('file', $('#image_file').files[0]); 		  
//console.log("form data "+formData);
//alert(formData); 
var data_field = new FormData();
data_field.append('fill', $('#image_file')[0].files[0]);

var customerno = $('#customername').val();

var customername = $('#customername').val();
var customerphone = $('#customerphone').val();
var customeremail = $('#customeremail').val();
var customertype = $('#customertype').val();
var address = $('#address').val();
//var city = $('#city').val();
var zip = $('#zip').val();
var Country = $('#spUserCountry').val();
var city = $('#spUserCity').val();
//var Country = $('#Country_11').val();
var customer_check = $('#customer_check').val();
var saleprice = $('#saleprice').val();
var tax = $('#tax').val();
var discount_ = $('#discount_in').val();
var select_payment = $('#select_payment').val();
var select_credit = $('#select_credit').val();
var notes = $('#notes').val();
data_field.append('customerno', customerno);
data_field.append('customername', customername);
data_field.append('customerphone', customerphone);
data_field.append('customeremail', customeremail);
data_field.append('customertype', customertype);
data_field.append('address', address);
data_field.append('city', city);
data_field.append('zip', zip);
data_field.append('Country', Country);
data_field.append('customer_check', customer_check);
data_field.append('saleprice', saleprice);
data_field.append('tax', tax);
data_field.append('discount_', discount_);
data_field.append('select_payment', select_payment);
data_field.append('select_credit', select_credit);
data_field.append('notes', notes);

$.ajax({
url: 'insert_customer.php',
type: 'post',
processData: false,
contentType: false,
data: data_field,


success: function(response) {
$('#close_').click();
$('#customer_success').show();
$('#customer_success').fadeOut(3000);
}

});

}
</script>

<script>
function fun_product_add() {

var aa = $("#barcode_validate").val();

if (aa == 2) {

return false;
}
// alert('hello123');
var data_formate = new FormData();
data_formate.append('feat_img', $('#image_product')[0].files[0]);
var barcode_in = $('#barcode_in').val();
var productname_in = $('#productname_in').val();
var purchaseprice_in = $('#purchaseprice_in').val();
var cost_in = $('#cost_in').val();
var saleprice_in = $('#saleprice_in').val();
var color_in = $('#color_in').val();
var tax_in = $('#tax_in').val();
var product_cat_in = $('#product_cat_in').val();
var product_sub_cat_in = $('#product_sub_cat_in').val();
var description_in = $('#description_in').val();
data_formate.append('barcode_in', barcode_in);
data_formate.append('productname_in', productname_in);
data_formate.append('purchaseprice_in', purchaseprice_in);
data_formate.append('purchaseprice_in', purchaseprice_in);
data_formate.append('cost_in', cost_in);
data_formate.append('saleprice_in', saleprice_in);
data_formate.append('color_in', color_in);
data_formate.append('tax_in', tax_in);
data_formate.append('product_cat_in', product_cat_in);
data_formate.append('product_sub_cat_in', product_sub_cat_in);
data_formate.append('description_in', description_in);



$.ajax({
url: 'add_product.php',
type: 'post',
processData: false,
contentType: false,
data: data_formate,

success: function(response) {
$('#close_2').click();
$('#product_success').show();
$('#product_success').fadeOut(3000);
}

});

}


//function final_payment(){
function fun_mail(peyment_type) {
//alert('===');
var rand_val = $('#rand_val').val();

//alert(membership_id);	 
var rand_val = parseInt(rand_val);
rand_val = rand_val - 1;
//alert(rand_val);
var customer_id = $('#customer_id').val();
var payment_amount = $('#payment_amount_').val();


//alert(payment_amount); 
var value1 = $('#sub_total_2').val();

var type_payment = $("input[type='radio'][name='payment_method']:checked").val();
//alert(type_payment); 


//alert(print_invoice);

var sub_total = $('#sub_total_1').val();
var discount_by_net = $('#discount_by_net').val();
var total_by_net = $('#total_by_net').val();
var total_tax = $('#total_tax').val();
var Gross_net = $('#Gross_net_1').val();
var pay_rand_no = $('#pay_rand_no').val();
var email = $('#email_').val();
var currency = "<?php echo $curr; ?>";
//alert(currency); 

$.ajax({
url: 'add_pos_customer_id.php',
type: 'post',

data: {
customer_id: customer_id,
sub_total: sub_total,
discount_by_net: discount_by_net,
total_by_net: total_by_net,
total_tax: total_tax,
Gross_net: Gross_net,
payment_amount: payment_amount,
type_payment: type_payment,
pay_rand_no: pay_rand_no,
peyment_type: peyment_type,
currency: currency,
without_tax: value1

},

success: function(cid) {



$.ajax({
url: 'send_mail_by_id.php',
type: 'post',

data: {
email: email,
customer_id: customer_id,
pay_rand_no: pay_rand_no
},

success: function(response) {
//$('#close_3').click(); 
$('#status_fun').show();
$('#success_msg').show();
document.getElementById("payment_link_btn").disabled = true;
}

});

var id = cid.trim();
//alert(id);
//alert(cid);

for (let i = rand_val; i != 0; i--) {
// alert("hello");


var barcode = document.getElementById('bar' + i).getAttribute('value');
var product_name = document.getElementById('pro_title' + i).getAttribute('value');
var color = document.getElementById('color' + i).getAttribute('value');
var size = document.getElementById('size' + i).getAttribute('value');
var quantity = document.getElementById('qun' + i).getAttribute('value');
var unit_price = document.getElementById('pri' + i).getAttribute('value');
var discount = document.getElementById('dis' + i).getAttribute('value');
var total_price = document.getElementById('net' + i).getAttribute('value');
var customer_id = cid;
var customer_id = $('#customer_id').val();
var membership_id = $('#membership_id').val();

// alert(Gross_net);  

$.ajax({
url: 'add_pos_detail.php',
type: 'post',

data: {
barcode: barcode,
product_name: product_name,
color: color,
size: size,
quantity: quantity,
unit_price: unit_price,
discount: discount,
total_price: total_price,
customer_id: customer_id,
membership_id: membership_id,
customerr_user_id: customer_id,

currency: currency

},

success: function(response) {
//$('#close_4').click();   


//window.location.href = "history_sales.php?id="+cid; 

}

});



}


}

});





}




function payment_done(peyment_type) {
//alert('===');
var rand_val = $('#rand_val').val();

//alert(membership_id);	 
var rand_val = parseInt(rand_val);
rand_val = rand_val - 1;
//alert(rand_val);
var customer_id = $('#customer_id').val();
var payment_amount = $('#payment_amount_').val();

//alert(payment_amount); 

var type_payment = $("input[type='radio'][name='payment_method']:checked").val();
//alert(type_payment); 
var value1 = $('#sub_total_2').val();


//alert(print_invoice);

var sub_total = $('#sub_total_1').val();
var discount_by_net = $('#discount_by_net').val();
var total_by_net = $('#total_by_net').val();
var total_tax = $('#total_tax').val();
var Gross_net = $('#Gross_net_1').val();
var pay_rand_no = $('#pay_rand_no').val();
var email = $('#email_').val();
var phone = $('#phone_').val();

var currency = "<?php echo $curr; ?>";
//alert(currency); 

$.ajax({
url: 'add_pos_customer_id.php',
type: 'post',

data: {
customer_id: customer_id,
sub_total: sub_total,
discount_by_net: discount_by_net,
total_by_net: total_by_net,
total_tax: total_tax,
Gross_net: Gross_net,
payment_amount: payment_amount,
type_payment: type_payment,
pay_rand_no: pay_rand_no,
peyment_type: peyment_type,
phone_number: phone,
currency: currency,
without_tax: value1

},

success: function(cid) {





var id = cid.trim();
//alert(id);
//alert(cid);

for (let i = rand_val; i != 0; i--) {
// alert("hello");


var barcode = document.getElementById('bar' + i).getAttribute('value');
var product_name = document.getElementById('pro_title' + i).getAttribute('value');
var color = document.getElementById('color' + i).getAttribute('value');
var size = document.getElementById('size' + i).getAttribute('value');
var quantity = document.getElementById('qun' + i).getAttribute('value');
var unit_price = document.getElementById('pri' + i).getAttribute('value');
var discount = document.getElementById('dis' + i).getAttribute('value');
var total_price = document.getElementById('net' + i).getAttribute('value');
//var customer_id = cid;
var customer_id = $('#customer_id').val();
var membership_id = $('#membership_id').val();

// alert(Gross_net);  

$.ajax({
url: 'add_pos_detail.php',
type: 'post',

data: {
barcode: barcode,
product_name: product_name,
color: color,
size: size,
quantity: quantity,
unit_price: unit_price,
discount: discount,
total_price: total_price,
customer_id: id,
membership_id: membership_id,
customerr_user_id: customer_id,
currency: currency

},

success: function(response) {
//$('#close_4').click();   


//window.location.href = "history_sales.php?id="+cid; 

}

});



}


}

});





}
</script>

<script>
function fun_membership() {

//alert("hello");  
var member_ship_ = $('#member_ship_').val();
// var customer_id = $('#customer_id').val();
var tbl = "membership";
$.ajax({
url: 'read_data_id.php',
type: 'post',

data: {
member_ship_: member_ship_,
tbl: tbl
},

success: function(response) {
if (response == 1) {
//$('#close_3').click(); 
location.replace(
"<?php echo $BaseUrl . '/store/pos-dashboard/pos.php?msg=success'; ?>");
}
if (response == 2) {
location.replace(
"<?php echo $BaseUrl . '/store/pos-dashboard/pos.php?msg=nomembership'; ?>");
}

}

});
}
</script>

<script>
//setTimeout(function() {
//$('#status_fun').click();

timer = setInterval(function() {
$('#status_fun').click();
// alert("5 seconds are up");
var pay_rand_no = $('#pay_rand_no').val();
$.ajax({
url: 'status_payment.php',
type: 'post',

data: {
pay_rand_no: pay_rand_no
},

success: function(response) {
//$('#close_4').click();  
//alert(response);	
if (response == 1) {
$('#status_fun_1').show();
$('#status_fun').hide();
}
}

});


}, 10000);

//alert('hello');

//   }, 2000);

$(document).ready(function() {

$("#spUserCountry").on("change", function() {
var a = $("#spUserCountry").val();
$.post("../loadUserState.php", {
countryId: a
}, function(r) {
// alert(r);
$(".loadUserState").html(r);
});
});



});

$(document).ready(function() {

$("#spUserCountry").on("change", function() {
var a = $("#spUserCountry").val();
$.post("../loadUserState.php", {
countryId: a
}, function(r) {
// alert(r);
$(".loadUserState").html(r);
});
});



});
</script>

<script>
function final_payment() {


var pay_rand_no = $('#pay_rand_no').val();
var print_invoice = document.getElementById("print_invoice_").checked;


$.ajax({
url: 'seen_seller_by_id.php',
type: 'post',

data: {
pay_rand_no: pay_rand_no
},

success: function(response) {
if (print_invoice == true) {

window.location.replace("history_sales.php?print=invoice&code_id=" + pay_rand_no);
}
//$('#close_4').click(); 
location.replace(
"<?php echo $BaseUrl . '/store/pos-dashboard/pos.php?msg=peyment_success'; ?>");

}

});

var con = $('#custhidden').val();
var connn = $('#phonehidden').val();
if (con == 2 && connn == 2) {
$('#addcustomer').submit()
} else if (con == 1) {
//alert('This Email Already Registered !');
swal('This Email Already Registered !');
} else if (connn == 3) {
swal('This Phone Already Registered !');
}



}

function fun_discount_val() {

$('#discount_by_net').val('');
}


function fun_tax_val() {

$('#total_tax').val('');
}
</script>

<script>
image_file.onchange = evt => {
const [file] = image_file.files
if (file) {
preview_img.src = URL.createObjectURL(file)
}
}
</script>
<script>
function checkbarcode(code) {


$.ajax({
url: 'check_barcode.php',
type: 'post',
dataType: "JSON",
data: {
'code': code
},
success: function(response) {
if (response == 1) {
$("#barcode_error").text('Barcode unavailable.');
$("#barcode_validate").val(2);
} else {
$("#barcode_error").text("Barcode available");
$("#barcode_validate").val(1);
}
}
});


}



$(document).ready(function() {
$("#customeremail").keyup(function() {
var email = $("#customeremail").val();
$.ajax({
url: 'dataInsertByAjax.php',
type: 'post',
data: {
email1: email
},
success: function(response) {
const WithoutSpaces = response.replace(/\s+/g, '');
if (WithoutSpaces == "1") {
$('#custemail').html('Customer Already Created');
} else {
$('#custemail').html('Customer Available');
}
$('#custhidden').val(WithoutSpaces);
}

});
});

$("#customerphone").keyup(function() {
var phone = $("#customerphone").val();
$.ajax({
url: 'dataInsertByAjax.php',
type: 'post',
data: {
phone1: phone
},
success: function(response) {
const WithoutSpaces = response.replace(/\s+/g, '');
//alert(WithoutSpaces);
if (WithoutSpaces == "3") {
$('#custphone').html('Customer Already Created');
} else {
$('#custphone').html('Customer Available');
}
$('#phonehidden').val(WithoutSpaces);
}

});
});


});
</script>





</body>

</html>
<?php } ?>