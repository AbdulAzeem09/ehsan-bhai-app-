<?php
/*error_reporting(E_ALL);
ini_set('display_errors', 'On');*/
include('../../univ/baseurl.php');
session_start();

if(!isset($_SESSION['pid'])){ 
$_SESSION['afterlogin']="store/";
include_once ("../../authentication/islogin.php");

}else{
function sp_autoloader($class){
include '../../mlayer/' . $class . '.class.php';
}
spl_autoload_register("sp_autoloader");

$_GET["categoryid"] = "1";


//print_r($_SESSION); die();
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Support Details | TheSharepage - POS| TheSharepage-POS </title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
<link
rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.7.2/css/all.min.css"
integrity="sha512-3M00D/rn8n+2ZVXBO9Hib0GKNpkm8MSUU/e2VNthDyBYxKWG+BftNYYcuEjXlyrSO637tidzMBXfE7sQm0INUg=="
crossorigin="anonymous"
referrerpolicy="no-referrer"
/>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css" />
<link rel="stylesheet" type="text/css" href="css/style.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />
<style type="text/css">
.nav-tabs .nav-item.show .nav-link, .nav-tabs .slink.active, .tab-content .stab-pane.active {
color: #000;
background-color: #a1c699;
border-color: #126a00  #fff #fff;
}
.font-li{
font-weight:lighter;
}
.label_m{margin-left: 30px;}
body .modal-body {
background-color:white;
}
.ql-editor.ql-blank {
background-color: white;
}
.ql-toolbar.ql-snow {
background-color: white;
}
form i {
margin: 6px 0px 0px -23px;
padding: 0px 10px 1px 0px;
cursor: pointer;
}
</style>
</head>
<body>
<div class="container-fluid">
<div class="row flex-nowrap">

<?php include('left_side_landing.php');?>  

<div class="col">
<div class="row mb-4">

<?php if($_SESSION['msg']=="1"){  unset($_SESSION['msg']); ?>
<div class="alert alert-success" id="success" style="color:green;" role="alert"> Created
Successfully .
</div>	   

<?php } ?>

<?php if($_SESSION['msg']=="2"){ unset($_SESSION['msg']); ?>
<div class="alert alert-success" id="p_success" role="alert"> Updated
Successfully  .
</div>	   

<?php } ?> 


<?php if($_SESSION['msga']=="3"){ unset($_SESSION['msga']); ?>
<div class="alert alert-success" id="p_success" role="alert"> Delete
Successfully  .
</div>	   

<?php } ?>

<div class="col-12 p-3">
<div class="row">
<div class="col-12">
<div class="row">
<div class="col">
<div class="tab-content">
<?php if($_GET['record'] == "payment_type"){ ?>
<div class="<?php if($_GET['record'] == "payment_type"){echo 'active';} ?>" id="payment" role="tabpanel" aria-labelledby="payment-tab">

<h3 class="py-3">Payment Methods</h3>
<div class="row">
<div class="col-auto mb-3">
<form action="add_payment_type.php" method="POST">
<div class="d-flex flex-row">
<input type="text" class="form-control" name="payment_type" id="payment" placeholder="Type Payment Method" required />
<input type="submit" class="btn btn-main"  value="Add" />  
</div>
</form>
</div>
<div class="col-12 bg-gray py-3 bg-gray py-3 bg-gray py-3 bg-gray py-3">
<table id="payment_table" class="display table-respnsive bg-light py-3" data-order='[[ 1, "asc" ]]' data-page-length="10">
<thead>
<tr>
<th>ID</th>
<th>Payment Method</th>

<th>Action</th>
</tr>
</thead>
<tbody>
<?php 

$p = new _pos;
$result = $p->read_data_payment($_SESSION['uid']);
if ($result) {
$i = 1;
while ($row = mysqli_fetch_assoc($result)) {

?>
<tr>
<td><?php echo $row['id']; ?></td>
<td><?php echo $row['payment_type']; ?></td>

<td>
<a  onclick="edit_payment('<?php echo $row['id']; ?>','<?php echo $row['payment_type']; ?>')"><i class="fas fa-edit me-1"></i></a>| <a onclick="delete_payment('<?php echo $BaseUrl?>/store/pos-dashboard/delete_payment.php?id=<?php echo $row['id'];?>&action=delete')" class="text-danger"> <i class="fas fa-trash"></i></a>
</td>
</tr>                   


<?php 			


}}
?>                                               
</tbody>
</table>
</div>
</div>
</div>
<!----modal--->

<div class="modal fade" id="payment_edit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog modal-sm">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title" id="exampleModalLabel"></h5>
<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">

<div class="row text-center" ><h4> Update Payment Method </h4></div>      
<form action="update_payment_type.php" method="POST">
<div class="d-flex flex-row">
<input type="hidden"  name="id"  id="row_id">
<input type="text" class="form-control" name="payment_type" id="payment_type_" placeholder="Type Payment Method" required />
<input type="submit" class="btn btn-main"  value="update" />  
</div>
</form>
</div>
<div class="modal-footer">
<!--<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>-->

</div>
</div>
</div>
</div>

<?php } ?>

<div class="tab-pane <?php if($_GET['record'] == "membership_type"){echo 'active';} ?>" id="customermembership" role="tabpanel" aria-labelledby="customermembership-tab">
<h3 class="py-3">Customer Membership</h3>
<div class="row justify-content-md-center">
<div class="col-12 mb-3">                                                           
<div class="tab-container-one">
<ul class="nav nav-tabs" id="mysubTab" role="tablist">
<li class="nav-item sitem active">
<a class="nav-link slink active" href="#qty" role="tab" aria-controls="qty" data-bs-toggle="tab">Member By Quantity</a>
</li>
<li class="nav-item sitem">
<a class="nav-link slink" href="#member-duration" role="tab" aria-controls="member-duration" data-bs-toggle="tab">Member By Duration</a>
</li>

</ul>
<div class="tab-content">               
<div class="tab-pane stab-pane active" id="qty" role="tabpanel" aria-labelledby="qty-tab">
<form action="add_member_by_qty.php" method="POST">
<div class="row">
<div class="col-md-4 col-sm-12 d-flex flex-column"></div>
<div class="col-md-4 col-sm-12 d-flex flex-column"> 
<input type="text" class="form-control mb-3" id="payment" name="name_qty" placeholder="Name"  />

<textarea class="form-control mb-3" name="decriptioin_in" required placeholder="Type Description"></textarea>
<div class="d-flex mb-2">
<input type="number" class="form-control mb-3 me-3" id="payment" name="Qty_qty" placeholder="Qty" required  />
<input type="number" class="form-control mb-3 " id="payment" name="price_qty" placeholder="$50" onkeypress="return (event.charCode >= 48 && event.charCode <= 57) || (event.charCode >= 96 && event.charCode <= 105)" required  /> 
</div>
<input type="text" class="form-control mb-3" id="payment" name="barcode_in" placeholder="Barcode"  />
<input type="submit" name="" class="btn btn-main mb-3" value="Add" />
</div>

<div class="col-md-4 col-sm-12 d-flex flex-column"></div>
</div>
</form>
<br>
<div class="col-12 bg-gray py-3 bg-gray py-3">  
<h6>Memberships By Quantity</h6>                   
<table id="qty_table" class="display table-respnsive bg-light py-3" data-order='[[ 1, "asc" ]]' data-page-length="10">
<thead>
<tr>
<th>ID</th>
<th>Memberships</th>
<th>Type</th>
<th>Price</th>
<th>Action</th>
</tr>
</thead>
<tbody>

<?php 

$p = new _pos;
$result_1 = $p->read_data_membership_qty($_SESSION['uid']);
if ($result_1) {
$i = 1;
while ($row_1 = mysqli_fetch_assoc($result_1)) {
?>
<tr>
<td><?php echo $row_1['id']; ?></td> 
<td><?php echo $row_1['name_qty']; ?></td>
<td><?php echo $row_1['Qty_qty']; ?></td>
<td><?php echo $row_1['price_qty']; ?></td>
<td>
<a onclick="edit_mem_qty('<?php echo $row_1['id']; ?>','<?php echo $row_1['name_qty']; ?>','<?php echo $row_1['Qty_qty']; ?>','<?php echo $row_1['price_qty']; ?>','<?php echo $row_1['decription_in']; ?>','<?php echo $row_1['barcode']; ?>')" ><i class="fas fa-edit me-1"></i></a>| 

<a onclick="delete_mem_qty('<?php echo $BaseUrl?>/store/pos-dashboard/delete_mem_qty.php?id=<?php echo $row_1['id'];?>&action=delete')" class="text-danger"> <i class="fas fa-trash"></i></a>
</td>
</tr>
<?php }} ?>
</tbody>
</table>
</div>

</div>

<div class="modal fade" id="mem_qty_edit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style="left: -100px;">
<div class="modal-dialog modal-sm">
<div class="modal-content" style="width: 150%;">
<div class="modal-header">
<h4 style="margin-left: 70px;"> Update Membership Qty </h4>
<h5 class="modal-title" id="exampleModalLabel"></h5>
<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">


<form action="update_member_by_qty.php" method="POST"> 
<div class="d-flex flex-row">
<input type="hidden"  name="id"  id="qty_id">
<div class="row">

<label for="" class="control-label label_m" style="display:flex">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Name:&nbsp; 
<input type="text" class="form-control " id="name_qty_" name="name_qty" placeholder="Name" required style="width:50%" /> </label>


<label for="" class="control-label label_m" style="display:flex;margin-top: 10px;">Description:&nbsp;
<input type="text" class="form-control mb" id="description_" placeholder="Description" name="decription_in" style="width:50%" required /> </label> 


<div class="col-auto" style="margin-top: 10px;">  
<label for="" class="control-label label_m" style="display:flex">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Quantity:&nbsp;

<input type="number" class="form-control" id="Qty_qty_" name="Qty_qty" placeholder="Qty" required /> </label>
</div>

<div class="col-auto" style="margin-top: 10px;">  
<label for="" class="control-label label_m" style="display:flex">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Barcode:&nbsp;

<input type="text" class="form-control" id="barcode_id_" name="barcode_in" placeholder="Barcode" required /> </label>
</div>


<div class="col-auto d-flex" style="margin-top: 10px;">
<label for="" class="control-label label_m" style="display:flex">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Amount:&nbsp;

<input type="number" class="form-control" id="price_qty_" name="price_qty" placeholder="$50" required /> </label>

</div> 

</div>

</div>

</div>
<div class="modal-footer">
<input type="submit" name="" class="btn btn-main" value="update" />  
<!--<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>-->

</div>
</form>
</div>
</div>
</div>

<div class="tab-pane stab-pane" id="member-duration" role="tabpanel" aria-labelledby="member-duration-tab">
<form action="add_membership_by_duration.php" method="post">
<div class="row">
<div class="col-md-4 col-sm-12"> </div>
<div class="col-md-4 col-sm-12 d-flex flex-column">
<input type="text" class="form-control mb-3" id="payment" name="Name" placeholder="Name" required />                                          
<textarea class="form-control mb-3" name="description_in"id="description" placeholder="Description" required ></textarea>
<div class="d-flex">                                          
<input type="number" class="form-control mb-3 me-3" id="payment" name="dur_Qty" placeholder="Qty" required />
<select class="form-control mb-3 me-3 form-select" id="select-payment" name="paymentterm">
<option value="1">Day</option>
<option value="2">Week</option>
<option value="3">Month</option>
</select>
<input type="text" class="form-control mb-3" id="payment" name="dur_price" placeholder="$50" required />
</div>
<input type="text" class="form-control mb-3" id="payment" name="barcode_in" placeholder="Barcode"  />
<input type="submit" name="" class="btn btn-main mb-3" value="Add" />
</div>

<div class="col-md-4 col-sm-12 d-flex"></div>  
</div>                                       
</form> 
<br>


<div class="col-auto bg-gray py-3 bg-gray py-3">
<h6>Memberships By Duration</h6>
<table id="duration_table" class="display table-respnsive bg-light py-3" data-order='[[ 1, "asc" ]]' data-page-length="10">
<thead>
<tr>
<th>ID</th>
<th>Memebership</th>
<th>Type</th>
<th>Price</th>
<th>Action</th>
</tr>
</thead>
<tbody>

<?php 

$p = new _pos;
$result_1 = $p->read_data_membership_dur($_SESSION['uid']); 
if ($result_1) {
$i = 1;
while ($row_1 = mysqli_fetch_assoc($result_1)) {
?>
<tr>
<td><?php echo $row_1['id']; ?></td> 
<td><?php echo $row_1['Name']; ?></td>
<td><?php echo $row_1['dur_Qty']; ?></td>
<td><?php echo $row_1['dur_price']; ?></td>  
<td>
<a onclick="edit_mem_dur('<?php echo $row_1['id']; ?>','<?php echo $row_1['Name']; ?>','<?php echo $row_1['dur_Qty']; ?>','<?php echo $row_1['dur_price']; ?>','<?php echo $row_1['paymentterm']; ?>','<?php echo $row_1['description_in']; ?>','<?php echo $row_1['barcode']; ?>')" ><i class="fas fa-edit me-1"></i></a>| 

<a onclick="delete_mem_dur('<?php echo $BaseUrl?>/store/pos-dashboard/delete_mem_dur.php?id=<?php echo $row_1['id'];?>&action=delete')" class="text-danger"> <i class="fas fa-trash"></i></a>
</td>
</tr>
<?php }} ?>

</tbody>
</table>
</div>
</div>


<div class="modal fade" id="mem_dur_edit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog modal-sm">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title" id="exampleModalLabel"></h5>
<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">

<div class="row text-center" ><h4> Update Membership Duration </h4></div>      
<form action="update_membership_by_duration.php" method="post">
<div class="row">
<div class="row">
<input type="hidden" name="id" id="dur_id">
<div class="col-auto">                                          
<input type="text" class="form-control" id="Name_1" name="Name" placeholder="Name" required />
</div>

<div class="col-auto">                                          
<input type="text" class="form-control mb-3" name="description_in"id="description_1" placeholder="Description" required />
</div>
<div class="col-auto d-flex">                                          
<input type="number" class="form-control" id="dur_Qty_1" name="dur_Qty" placeholder="Qty" required />
<select class="form-control form-select" id="paymentterm_1" name="paymentterm">
<option value="1">Day</option>
<option value="2">Week</option>
<option value="3">Month</option>
</select>
</div>
<div class="col-auto d-flex">
<input type="text" class="form-control" id="dur_price_1" name="dur_price" placeholder="$50" required />

</div>  
<input type="text" class="form-control mb-3" id="barcode_in_1" name="barcode_in" placeholder="Barcode"  />
</div>                                       
</div>

</div>
<div class="modal-footer">
<input type="submit" name="" class="btn btn-main" value="update" />  
<!--<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>-->

</div>
</form> 
</div>
</div>
</div>


</div>
</div>                                                          
</div>
</div>
</div>
<?php if($_GET['record'] == "tax_typee"){ ?>
<div class="<?php if($_GET['record'] == "tax_typee"){echo 'active';} ?>" id="tax" role="tabpanel" aria-labelledby="tax-tab">
<h3 class="py-3">Add Tax</h3>
<div class="row">
<div class="col-auto mb-3">
<form action="add_taxes.php?action=addTax" method="POST" onsubmit="return checkadd()">
<div class="d-flex flex-row">
<input type="hidden" name="section_tax" value="section_tax">
<input type="text" class="form-control" placeholder="TAX Name" id="tax1_id" min="1" max="100" style="margin-left: 1px; width:127px" name="tax_type"  /><br>
<span id="error_1" class="text-danger"></span>
<input type="number" class="form-control" id="tax_value" placeholder="Percentage Value"  min="1" max="100" style="margin-left: 13px;width:172px" name="tax_value"  />

<input type="submit" name=""  class="btn btn-main"  style="margin-left: 13px;" value="Add" />
</div>
</form>
</div>
<div class="col-12 bg-gray py-3 bg-gray py-3">                                       
<table id="tax_table" class="display table-respnsive bg-light py-3" data-order='[[ 1, "asc" ]]' data-page-length="10">
<thead>
<tr>
<th>ID</th>
<th>Tax Type</th>
<th>Value</th>
<th>Action</th>
</tr>
</thead>
<tbody>
<?php 

$p = new _pos;
$result_1 = $p->read_data_tax($_SESSION['uid']);
if ($result_1) {
$i = 1;
while ($row_1 = mysqli_fetch_assoc($result_1)) {
?>
<tr>
<td><?php echo $row_1['id']; ?></td>
<td><?php echo $row_1['tax_type']; ?></td>
<td><?php echo $row_1['tax_value']; ?></td>
<td>
<a onclick="edit_tax('<?php echo $row_1['id']; ?>','<?php echo $row_1['tax_type']; ?>','<?php echo $row_1['tax_value']; ?>')" ><i class="fas fa-edit me-1"></i></a>| 

<a onclick="delete_tax('<?php echo $BaseUrl?>/store/pos-dashboard/delete_tax.php?id=<?php echo $row_1['id'];?>&action=addTax')" class="text-danger"> <i class="fas fa-trash"></i></a>
</td>
</tr>
<?php }} ?>

</tbody>
</table>
</div>
</div>
</div>
<?php } ?>
<!--- add import customer code here------->
<div class="tab-pane <?php if($_GET['record'] == "tax_type"){echo 'active';} ?>" id="import_customer" role="tabpanel" aria-labelledby="tax-tab">
<h3>Import Customer</h3>
<!-- add form    -->				 

<form enctype="multipart/form-data" action="<?php echo $BaseUrl;?>/store/pos-dashboard/import_customer.php" method="post" id="sp-form-post" name="postform" style="margin-top: 13px;margin-left:140px;">
<a  href= "<?php echo $BaseUrl.'/store/pos-dashboard/pos_csv/import_customer.csv'; ?>" class="btn btn-outline-secondary mee-3"style=" padding: 2px;margin-top: -2px;margin-right:7px;">Sample CSV</a>

<input type="file" name="file" id="file" accept= ".csv" class="" style="margin-right: -60px;">
<!--<a href="index.php" class="btn btn-main me-3"><i class="fas fa-file-import"></i> Import</a>-->
<button type="submit" class="btn btn-main mee-3" name="submit_retail" value="Upload" style="padding: 3px;
margin-top: -2px;"><i class="fas fa-file-import"></i>Import</button>
</form>


<!---add insert form end  -->


</div>
<!-- code end here ------->

<!--- add import customer code here------->
<div class="tab-pane <?php if($_GET['record'] == "tax_type"){echo 'active';} ?>" id="import_products" role="tabpanel" aria-labelledby="tax-tab">
<h3>Import Products</h3>
<!-- add form    -->				 




<form enctype="multipart/form-data" action="<?php echo $BaseUrl;?>/store/pos-dashboard/import-supplier.php" method="post" id="sp-form-post" name="postform">

<a  href= "<?php echo $BaseUrl.'/store/pos-dashboard/pos_csv/import_supplier.csv'; ?>" class="btn btn-outline-secondary me-3" >Sample CSV</a> 
<input type="file" name="file" id="file" accept= ".csv" class="">
<!--<a href="index.php" class="btn btn-main me-3"><i class="fas fa-file-import"></i> Import</a>-->
<button type="submit" class="btn btn-main me-3" name="submit_retail" value="Upload"><i class="fas fa-file-import"></i>Import</button>
</form>


<!---add insert form end  -->


</div>


<!--- customer List code here------->  
<div class="tab-pane <?php if($_GET['record'] == "tax_type"){echo 'active';} ?>" id="customer_list" role="tabpanel" aria-labelledby="tax-tab">
<h3>Customer List</h3>  

<form method="GET" action="edit_email_content.php"  id="form_submit">
<span>Select All</span>
<input type="checkbox" class="chk_boxes"  >
<input type="button"  value="Next" id="send_email" style="float:right;margin-bottom: 5px;">
<br>
<div class="col-12">

<table id="table_id" class="display"  data-order='[[ 0, "desc" ]]' data-page-length='25'>
<thead>
<tr>
<th>Customer ID</th>

<th>Customer Name</th>
<!--<th>Address</th>-->
<th>Phone</th>

<th>Email</th>
<!--<th>Customer Type</th>                       
<th>Action</th>--> 
</tr>
</thead>
<tbody>

<?php
$p = new _pos;

$result = $p->read_data($_SESSION['pid']);
//print_r($result);
//die('=======');
if ($result) {
$i = 1;
while ($row = mysqli_fetch_assoc($result)) {
//print_r($row);
//die('======');

$phone=$row['phone'];
//echo $phone;
//die('========');
$data_s = $p->read_cust_id($phone);
//print_r($data_s);
//die('=======');
if($data_s){
$row11 = mysqli_fetch_assoc($data_s);
$id_p=$row11['idspUser'];
//print_r($row11);
//die('======');
}
?>
<tr>

<td >


<input type="checkbox" id="customer<?php echo $row['id']; ?>" name="customer_id[]"  class="chk_boxes1" value="<?php echo $row['id']; ?>">
<label for="customer<?php echo $row['id']; ?>"> <?php echo $row['id']; ?></label>






</td>
<td ><label for="customer<?php echo $row['id']; ?>"><?php echo $row['customer_name']; ?> </label></td>
<!--  <td><?php echo $row['address']; ?></td>-->
<td><label for="customer<?php echo $row['id']; ?>"><?php echo $row['phone']; ?></label></td>

<td><label for="customer<?php echo $row['id']; ?>"><?php echo $row['email']; ?></label></td>
<!-- <td>
<?php if($row['customer_type']== 1){ ?>

<?php echo "Retail"; ?>

<?php } ?>

<?php if($row['customer_type']== 2){ ?>

<?php echo "Whole Sale"; ?>

<?php } ?>

<?php if($row['customer_type']== 3){ ?>

<?php echo "Domeste"; ?>

<?php } ?>

</td>   -->  
<!--					 
<td style="padding: 8px 6px;">
<a href="<?php echo $BaseUrl.'/store/pos-dashboard/customer-edit.php?postid='.$row['id']; ?>"><i class="fas fa-edit me-1"></i></a>|
<a onclick="deletefun(<?php echo $row['id']; ?>)" class="text-danger"> <i class="fas fa-trash"></i></a> |  
<a href="<?php echo $BaseUrl.'/store/pos-dashboard/customer-assign-membership.php?postid='.$id_p; ?>" class="text-danger"> <i class="fa fa-plus" aria-hidden="true"></i></a>  

</td>  -->
</tr> 
<?php
$i++;
$id_p=0;
}   
}
?>		


</tbody>
</table>
</form>
</div>

<script type="text/javascript">
$(document).ready( function () {
$('#table_id').DataTable({  
buttons: {
buttons: [ 'copy', 'csv', 'excel' ]
}
});        
});
</script>	  
<script>
$(document).ready( function () {	
$('.chk_boxes').click(function() {   
$('.chk_boxes1').prop('checked', this.checked);
});  
});  
</script>	  

<!---add insert form end  -->           


</div>

<!--welcome email customer list   -->

<div class="tab-pane <?php if($_GET['record'] == "tax_type"){echo 'active';} ?>" id="welcome_customer_list" role="tabpanel" aria-labelledby="tax-tab">
<h3>Wellcome Customer List</h3>  

<form method="GET" action="edit_wellcome_email.php"  id="W_form_submit">
<span>Select All</span>
<input type="checkbox" class="w_chk_boxes"  >
<input type="button"  value="Next" id="w_send_email" style="float:right;margin-bottom: 5px;">
<br>
<div class="col-12">

<table id="table_id_w" class="display"  data-order='[[ 0, "desc" ]]' data-page-length='25'>
<thead>
<tr>
<th>Customer ID</th>

<th>Customer Name</th>
<!--<th>Address</th>-->
<th>Phone</th>

<th>Email</th>
<!--<th>Customer Type</th>                       
<th>Action</th>--> 
</tr>
</thead>
<tbody>

<?php
$p = new _pos;

$result = $p->read_data($_SESSION['pid']);
//print_r($result);
//die('=======');
if ($result) {
$i = 1;
while ($row = mysqli_fetch_assoc($result)) {
//print_r($row);
//die('======');

$phone=$row['phone'];
//echo $phone;
//die('========');
$data_s = $p->read_cust_id($phone);
//print_r($data_s);
//die('=======');
if($data_s){
$row11 = mysqli_fetch_assoc($data_s);
$id_p=$row11['idspUser'];
//print_r($row11);
//die('======');
}
?>
<tr>

<td >


<input type="checkbox" id="customer1<?php echo $row['id']; ?>" name="customer_id[]"  class="w_chk_boxes1" value="<?php echo $row['id']; ?>">
<label for="customer1<?php echo $row['id']; ?>"> <?php echo $row['id']; ?></label>






</td>
<td ><label for="customer1<?php echo $row['id']; ?>"><?php echo $row['customer_name']; ?> </label></td>
<!--  <td><?php echo $row['address']; ?></td>-->
<td><label for="customer1<?php echo $row['id']; ?>"><?php echo $row['phone']; ?></label></td>

<td><label for="customer1<?php echo $row['id']; ?>"><?php echo $row['email']; ?></label></td>
<!-- <td>
<?php if($row['customer_type']== 1){ ?>

<?php echo "Retail"; ?>

<?php } ?>

<?php if($row['customer_type']== 2){ ?>

<?php echo "Whole Sale"; ?>

<?php } ?>

<?php if($row['customer_type']== 3){ ?>

<?php echo "Domeste"; ?>

<?php } ?>

</td>   -->  
<!--					 
<td style="padding: 8px 6px;">
<a href="<?php echo $BaseUrl.'/store/pos-dashboard/customer-edit.php?postid='.$row['id']; ?>"><i class="fas fa-edit me-1"></i></a>|
<a onclick="deletefun(<?php echo $row['id']; ?>)" class="text-danger"> <i class="fas fa-trash"></i></a> |  
<a href="<?php echo $BaseUrl.'/store/pos-dashboard/customer-assign-membership.php?postid='.$id_p; ?>" class="text-danger"> <i class="fa fa-plus" aria-hidden="true"></i></a>  

</td>  -->
</tr> 
<?php
$i++;
$id_p=0;
}   
}
?>		


</tbody>
</table>
</form>
</div>
<script>
function checkadd(){   
	var sub_cat = $("#tax1_id").val();

	if(sub_cat === "" ){
		$("#error_1").text("Enter  tax ");

		return false;
	
	}else{
		$("#submitadd").submit();
	}
}

</script>
<script>
$(document).ready( function () {	
$('.w_chk_boxes').click(function() {   
$('.w_chk_boxes1').prop('checked', this.checked);
});  
});  
</script>	  

<!---add insert form end  -->           


</div>
<script type="text/javascript">
$(document).ready( function () {
$('#table_id_w').DataTable({  
buttons: {
buttons: [ 'copy', 'csv', 'excel' ]
}
});        
});
</script>	 

<div class="tab-pane <?php if($_GET['record'] == "support_type"){echo 'active';} ?>" id="email_content" role="tabpanel" aria-labelledby="contacttoadmin-tab">
<h3 class="py-3">Email Content</h3>
<div class="row justify-content-md-center"> 
<div class="col-auto text-center mb-3">
<?php $us= new _pos;
$us2=$us->read_email_c($_SESSION['uid'],$_SESSION['pid']); 

if($us2){

$row1=mysqli_fetch_assoc($us2);
//print_r($row1);
//die('==');

?>

<form action="add_email_content.php" method="post" enctype="multipart/form-data">
<div class=""> 

<input type="hidden" name="id"  value="<?php echo $row1['id'];  ?>" />

<label for="spUserEmail" class="control-label" style="display:flex">1st Paragraph:
</label>
<link rel='stylesheet' href='https://cdn.quilljs.com/1.1.5/quill.snow.css'>
<textarea class="form-control mb-3" name="1paragraph" id="spPostingNotes_u" style="display:none;" required><?php echo $row1['1paragraph']; ?></textarea>

<div id="editor-container_u" style=" height: 135px;background-color: white;width: 450px; "><?php echo $row1['1paragraph']; ?></div>


<script src='https://cdn.quilljs.com/1.3.6/quill.js'></script>
<script>
var quill_u = new Quill('#editor-container_u', {
modules: {
toolbar: [
[{ header: [1, 2, false] }],
['bold', 'italic', 'underline']
]
},
theme: 'snow'  // or 'bubble'
});


quill_u.on("text-change", function() {
var editor_content_u = quill_u.container.firstChild.innerHTML ; 

document.getElementById("spPostingNotes_u").value = editor_content_u;   
///alert(editor_content_u);
});
</script>
<br>
<label for="spUserEmail" class="control-label" style="display:flex">2nd Paragraph:</label>

<textarea class="form-control mb-3" name="2paragraph" id="spPostingNotes1" style="display:none;" required><?php echo $row1['2paragraph']; ?></textarea>

<div id="editor-container1" style=" height: 135px;background-color: white;width: 450px; "><?php echo $row1['2paragraph']; ?></div>
<script>
var quill2 = new Quill('#editor-container1', {
modules: {
toolbar: [
[{ header: [1, 2, false] }],
['bold', 'italic', 'underline']
]
},
theme: 'snow'  // or 'bubble'
});


quill2.on("text-change", function() {
var editor_content2 = quill2.container.firstChild.innerHTML ;
//alert(editor_content);
document.getElementById("spPostingNotes1").value = editor_content2;
//alert(editor_content2);
});
</script>
<br>
<label for="subject" class="control-label" style="display:flex">Subject:</label>

<input type="text" name="subject" class="form-control" value="<?php echo $row1['subject']; ?>" placeholder="Enter Subject"/>

<input type="submit" style="margin-top: 10px;" name="btn_update" class="btn btn-main float-end" value="Update" />
</div>
</form>

<?php


} else{ ?>

<form action="add_email_content.php" method="post" enctype="multipart/form-data">
<div class="">
<label for="spUserEmail" class="control-label" style="display:flex">1st Paragraph:</label>
<link rel='stylesheet' href='https://cdn.quilljs.com/1.1.5/quill.snow.css'>
<textarea class="form-control mb-3" name="11paragraph" id="spPostingNotes2" style="display:none;" required></textarea>

<div id="editor-container2" style=" height: 135px;background-color: white;width: 450px; "></div>
<script src='https://cdn.quilljs.com/1.3.6/quill.js'></script>
<script>
var quill1 = new Quill('#editor-container2', {
modules: {
toolbar: [
[{ header: [1, 2, false] }],
['bold', 'italic', 'underline']
]
},
theme: 'snow'  // or 'bubble'
});


quill1.on("text-change", function() {
var editor_content1 = quill1.container.firstChild.innerHTML ;
//alert(editor_content);
document.getElementById("spPostingNotes2").value = editor_content1;
//alert(editor_content1);
});
</script> 
</label>
<label for="spUserEmail" class="control-label" style="display:flex">2nd Paragraph: 
</label>
<textarea class="form-control mb-3" name="22paragraph" id="spPostingNotes3" style="display:none;" required></textarea>

<div id="editor-container3" style=" height: 135px;background-color: white;width: 450px; "></div>
<script>
var quill = new Quill('#editor-container3', {
modules: {
toolbar: [
[{ header: [1, 2, false] }],
['bold', 'italic', 'underline']
]
},
theme: 'snow'  // or 'bubble'
});


quill.on("text-change", function() {
var editor_content = quill.container.firstChild.innerHTML ;
//alert(editor_content);
document.getElementById("spPostingNotes3").value = editor_content;
//alert(editor_content);
});

</script>
<br>
<label for="subject" class="control-label" style="display:flex">Subject:</label>

<input type="text" name="subject" class="form-control" value="" placeholder="Enter Subject"/>

<input type="Submit" style="margin-top: 10px;" name="btn_insert" id="btn_insert" class="btn btn-main float-end" value="Submit" />
</div>
</form>

<?php 
}?>


</div> 

</div>

</div>

<!-- code end here ------->

<!----- welcome email content code start   ----->

<div class="tab-pane <?php if($_GET['record'] == "support_type"){echo 'active';} ?>" id="welcome_email_content" role="tabpanel" aria-labelledby="contacttoadmin-tab">
<h3 class="py-3">Welcome Email Content</h3>
<div class="row justify-content-md-center"> 
<div class="col-auto text-center mb-3">
<?php $us= new _pos;
$wr=$us->read_Wellcomeemail_c($_SESSION['uid'],$_SESSION['pid']); 

if($wr){

$data_w=mysqli_fetch_assoc($wr);
//print_r($row1);
//die('==');

?>

<form action="add_wellcomeEmail.php" method="post" enctype="multipart/form-data">
<div class=""> 

<input type="hidden" name="id"  value="<?php echo $data_w['id'];  ?>" />

<label for="spUserEmail" class="control-label" style="display:flex">Paragraph:
</label>
<link rel='stylesheet' href='https://cdn.quilljs.com/1.1.5/quill.snow.css'>
<textarea class="form-control mb-3" name="paragraph_w1" id="spPostingNotes_w" style="display:none;" required><?php echo $data_w['paragraph']; ?></textarea>

<div id="editor-container_w" style=" height: 135px;background-color: white;width: 450px; "><?php echo $data_w['paragraph']; ?></div>


<script src='https://cdn.quilljs.com/1.3.6/quill.js'></script>
<script>
var quill = new Quill('#editor-container_w', {
modules: {
toolbar: [
[{ header: [1, 2, false] }],
['bold', 'italic', 'underline']
]
},
theme: 'snow'  // or 'bubble'
});


quill.on("text-change", function() {
var editor_content_w = quill.container.firstChild.innerHTML ;

document.getElementById("spPostingNotes_w").value = editor_content_w;
//alert(editor_content);
});
</script>

<br>
<label for="subject" class="control-label" style="display:flex">Subject:</label>

<input type="text" name="subject_w1" class="form-control" value="<?php echo $data_w['subject']; ?>" placeholder="Enter Subject"/>

<input type="submit" style="margin-top: 10px;" name="btn_update_w" class="btn btn-main float-end" value="Update" />
</div>
</form>

<?php


} else{ ?>

<form action="add_wellcomeEmail.php" method="post" enctype="multipart/form-data">
<div class="">
<label for="spUserEmail" class="control-label" style="display:flex">Paragraph:</label>
<link rel='stylesheet' href='https://cdn.quilljs.com/1.1.5/quill.snow.css'>
<textarea class="form-control mb-3" name="paragraph_w" id="spPostingNotes2_w" style="display:none;" required></textarea>

<div id="editor-container2_w" style=" height: 135px;background-color: white;width: 450px; "></div>
<script src='https://cdn.quilljs.com/1.3.6/quill.js'></script>
<script>
var quill1 = new Quill('#editor-container2_w', {
modules: {
toolbar: [
[{ header: [1, 2, false] }],
['bold', 'italic', 'underline']
]
},
theme: 'snow'  // or 'bubble'
});


quill1.on("text-change", function() {
var editor_content1_w = quill1.container.firstChild.innerHTML ;
//alert(editor_content);
document.getElementById("spPostingNotes2_w").value = editor_content1_w;
//alert(editor_content1);
});
</script> 
</label>

<br>
<label for="subject" class="control-label" style="display:flex">Subject:</label>

<input type="text" name="subject_w" class="form-control" value="" placeholder="Enter Subject"/>

<input type="Submit" style="margin-top: 10px;" name="btn_insert_w" id="btn_insert" class="btn btn-main float-end" value="Submit" />
</div>
</form>

<?php 
}?>


</div> 
<!-- <div class="col-12">
<table id="admin_table" class="display table-respnsive bg-light py-3" data-order='[[ 1, "asc" ]]' data-page-length="10">
<thead>
<tr>
<th>ID</th>
<th>Subject</th>
<th>Message</th>
<th>Date & Time</th>
<th>Status</th>
</tr>
</thead>
<tbody>
<td>1</td>
<td>Test Subject</td>
<td>Test Message</td>
<td>15-09-22 6:40PM</td>
<td>Sent</td>
</tbody>
</table>
</div> -->                                                     
</div>

</div>


<!----- welcome email contact code end   ----->

<!---tax edit modal--->
<div class="modal fade" id="tax_edit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog modal-sm">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title" id="exampleModalLabel">Update Tax</h5>
<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
<!-- <div class="row text-center" ><h4>  </h4></div>       -->
<form action="update_tax.php?action=addTax" method="POST">
<div class="d-flex row">
<input type="hidden"  name="id"  id="tax_id">
<div class="mb-4">
<label for="tax_type_" class="form-label">Tax Type</label>
<input type="text" class="form-control" id="tax_type_" placeholder="TAX Name"  name="tax_type" required /> 
</div>
<div class="mb-4">
<label for="email" class="form-label">Tax Value</label>
<input type="text" class="form-control" id="tax_value_" placeholder="TAX Value22" min="1" max="100" name="tax_value" required />
</div>
</div>
</div>
<div class="modal-footer">
<button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
<input type="submit" class="btn btn-primary"  value="update" />  
</div>
</form>
</div>
</div>
</div>

<div class="modal fade" id="pass_edit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog modal-sm">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title" id="exampleModalLabel"></h5>
<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">

<div class="row text-center" ><h4> Update Password </h4></div>      
<form action="update_password.php" method="POST">
<div class="d-flex flex-row">
<input type="hidden"  name="id"  id="paas_id">
<input type="text" class="form-control" id="userspass" placeholder="Password Value" name="password" required />
<input type="submit" class="btn btn-main"  value="update" />  
</div>
</form>
</div>
<div class="modal-footer">
<!--<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>-->

</div>
</div>
</div>
</div>
<?php 
if($_GET['record'] == "dep_type"){ ?>
<div class="<?php if($_GET['record'] == "dep_type"){echo 'active';} ?>" id="deparment" role="tabpanel" aria-labelledby="deparment-tab">
<h3 class="py-3">Add Deparment</h3>

<div class="row">
<div class="col-auto mb-3">


<form action="add_department.php" method="POST" onsubmit="return depart1()">
<span id="depcheck" style="color: red; padding: 6px 10px;"></span>
<div class="d-flex flex-row">
<input type="hidden" name="section_department" value="section_department">

<input type="text" class="form-control" id="department" name="department_in" placeholder="Type Deparment" required />
<input type="submit" name="" class="btn btn-main" value="Add" />
</div>
</form>
</div>
<div class="col-12 bg-gray py-3 bg-gray py-3">                                       
<table id="deparment_table" class="display table-respnsive bg-light py-3 table-respnsive" data-order='[[ 1, "asc" ]]' data-page-length="10">
<thead>
<tr>
<th>ID</th>
<th>Department</th>
<th>Action</th>
</tr>
</thead>
<tbody>

<?php 

$p = new _pos;
$result_2 = $p->read_data_department($_SESSION['uid']);
if ($result_2) {
$i = 1;
while ($row_2 = mysqli_fetch_assoc($result_2)) { 
?>
<tr>
<td><?php echo $row_2['id']; ?></td>
<td><?php echo $row_2['department_in']; ?></td> 

<td>
<a onclick="edit_depart('<?php echo $row_2['id']; ?>','<?php echo $row_2['department_in']; ?>')" ><i class="fas fa-edit me-1"></i></a>| 

<a onclick="delete_depart('<?php echo $BaseUrl?>/store/pos-dashboard/delete_department.php?id=<?php echo $row_2['id'];?>&action=delete')" class="text-danger"> <i class="fas fa-trash"></i></a>
</td>
</tr>
<?php }} ?>


</tbody>
</table>
</div>
</div>
</div>

<div class="modal fade" id="depart_edit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog modal-sm">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title" id="exampleModalLabel"></h5>
<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">

<div class="row text-center" ><h4> Update Deparment </h4></div>      
<form action="update_department.php" method="POST">
<div class="d-flex flex-row">
<input type="hidden"  name="id"  id="depart_id">
<input type="text" class="form-control" id="department_" name="department_in" placeholder="Type Deparment" required />

<input type="submit" class="btn btn-main"  value="update" />  
</div>
</form>
</div>
<div class="modal-footer">
<!--<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>-->

</div>
</div>
</div>
</div>



<?php } ?>



<div class="tab-pane <?php if($_GET['record'] == "cat_type"){echo 'active';} ?>" id="category" role="tabpanel" aria-labelledby="category-tab">
<h3 class="py-3">Add Category</h3>
<div class="row justify-content-md-center">
<div class="col-auto mb-3">
<form action="add_category.php" method="POST">
<div class="d-flex flex-row">
<input type="text" class="form-control" id="category" name="type_category" placeholder="Type Category" required />
<select class="form-control form-select" name="select_category">
<option selected> It is Parent </option>
<option value="Browns"> Browns</option>
<option value="Silver"> Silver</option>
<option value="Gold"> Gold</option>
<option value="Daimond"> Daimond</option>
</select>
<input type="submit" name="" class="btn btn-main" value="Add" />
</div>
</form>
</div>
<div class="col-12 bg-gray py-3 bg-gray py-3">

<table id="category_table" class="display table-respnsive bg-light py-3" data-order='[[ 1, "asc" ]]' data-page-length="10">
<thead>
<tr>
<th>ID</th>
<th>Category</th>
<th>Sub Category</th>
<th>Action</th>
</tr>
</thead>
<tbody>

<?php 

$p = new _pos;
$result_3 = $p->read_data_category($_SESSION['uid']);
if ($result_3) {
$i = 1;
while ($row_3 = mysqli_fetch_assoc($result_3)) { 
?>
<tr>
<td><?php echo $row_3['id']; ?></td>
<td><?php echo $row_3['select_category']; ?></td> 
<td><?php echo $row_3['select_sub_category']; ?></td>  

<td>
<a onclick="edit_category('<?php echo $row_3['id']; ?>','<?php echo $row_3['select_category']; ?>','<?php echo $row_3['select_sub_category']; ?>')" ><i class="fas fa-edit me-1"></i></a>| 

<a onclick="delete_category('<?php echo $BaseUrl?>/store/pos-dashboard/delete_category.php?id=<?php echo $row_3['id'];?>&action=delete')" class="text-danger"> <i class="fas fa-trash"></i></a> 
</td>
</tr>
<?php }} ?>

</tbody>
</table>
</div>
</div>
</div>


<div class="modal fade" id="category_edit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog modal-sm">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title" id="exampleModalLabel"></h5>
<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">

<div class="row text-center" ><h4> Update Category </h4></div>      
<form action="update_category.php" method="POST">   
<div class="d-flex flex-row">
<input type="hidden"  name="id"  id="cat_id">
<input type="text" class="form-control" id="type_category_" name="type_category" placeholder="Type Category" required />
<select class="form-control form-select" name="select_category" id="select_category_">
<option selected> Select Category</option>
<option value="Browns"> Browns</option>
<option value="Silver"> Silver</option>
<option value="Gold"> Gold</option>
<option value="Daimond"> Daimond</option>
</select>
<!-- <select class="form-control form-select" name="select_sub_category" id="select_sub_category_">   
<option selected> Select Sub Category</option>
<option value="1"> 1</option>
<option value="2"> 2</option>
<option value="3"> 3</option>
<option value="5"> 4</option>
</select>-->

<input type="submit" class="btn btn-main"  value="update" />  
</div>
</form>
</div>
<div class="modal-footer">
<!--<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>-->

</div>
</div>
</div>
</div>


<div class="tab-pane <?php if($_GET['record'] == "branch_type"){echo 'active';} ?>" id="branches" role="tabpanel" aria-labelledby="branches-tab">
<h3 class="py-3">Add Branches</h3>
<div class="row justify-content-md-center">
<div class="col-auto mb-3">
<form action="add_branches.php" method="POST">
<div class="d-flex flex-row">
<input type="text" class="form-control" id="branches_type" name="branches_name" placeholder="Branch Name" required />
<input type="text" class="form-control" id="branches_value" name="branches_address" placeholder="Branch Address" required />
<input type="text" class="form-control" id="branches_value" name="branches_contact" placeholder="Branch Contact" required />
<input type="submit" name="" class="btn btn-main" value="Add" />
</div>
</form>
</div>
<div class="col-12 bg-gray py-3 bg-gray py-3">

<table id="branches_table" class="display table-respnsive bg-light py-3" data-order='[[ 1, "asc" ]]' data-page-length="10">
<thead>
<tr>
<th>ID</th>
<th>Branch Name</th>
<th>Branch Address</th>
<th>Branch Contact</th>
<th>Action</th>
</tr>
</thead>
<tbody>
<?php 

$p = new _pos;
$result_3 = $p->read_data_branches($_SESSION['uid']);
if ($result_3) {
$i = 1;
while ($row_3 = mysqli_fetch_assoc($result_3)) { 
?>
<tr>
<td><?php echo $row_3['id']; ?></td>
<td><?php echo $row_3['branches_name']; ?></td> 
<td><?php echo $row_3['branches_address']; ?></td>  
<td><?php echo $row_3['branches_contact']; ?></td>  

<td>
<a onclick="edit_branches('<?php echo $row_3['id']; ?>','<?php echo $row_3['branches_name']; ?>','<?php echo $row_3['branches_address']; ?>','<?php echo $row_3['branches_contact']; ?>')" ><i class="fas fa-edit me-1"></i></a>|  

<a onclick="delete_branches('<?php echo $BaseUrl?>/store/pos-dashboard/delete_branches.php?id=<?php echo $row_3['id'];?>&action=delete')" class="text-danger"> <i class="fas fa-trash"></i></a> 
</td>
</tr>
<?php }} ?>


</tbody>
</table>
</div>
</div>
</div>


<div class="modal fade" id="branches_edit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog modal-sm">
<div class="modal-content" style="width: 201%;">
<div class="modal-header">
<h5 class="modal-title" id="exampleModalLabel"></h5>
<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">

<div class="row text-center" ><h4> Update Branches </h4></div>  

<form action="update_branches.php" method="POST">       
<div class="d-flex flex-row">
<input type="hidden"  name="id"  id="bran_id">
<input type="text" class="form-control" id="branches_name_" name="branches_name" placeholder="Branch Name" required />
<input type="text" class="form-control" id="branches_address_" name="branches_address" placeholder="Branch Address" required />
<input type="text" class="form-control" id="branches_contact_" name="branches_contact" placeholder="Branch Contact" required />
<input type="submit" class="btn btn-main"  value="update" />  
</div>
</form>
</div>
<div class="modal-footer">
<!--<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>-->

</div>
</div>
</div>
</div>



<div class="tab-pane <?php if($_GET['record'] == "users_type"){echo 'active';} ?>" id="users" role="tabpanel" aria-labelledby="users-tab">
<h3 class="py-3">Add User</h3>
<div class="row justify-content-md-center">
<div class="col-auto mb-3">
<form action="add_pos_user.php" method="post">
<div class="d-flex flex-row">
<input type="text" class="form-control" id="user_name" name="user_name" placeholder="User Name" required />
<input type="text" class="form-control" id="email" name="email" placeholder="Email Address" required />
<!--<input type="text" class="form-control" id="contact" name="contact" min="10" max="10" placeholder="User Contact" required />-->
<select class="form-control form-select js-example-basic-multiple  me-2" style="width:210px" name="contact"><option selected> Select Contact User</option>
<?php
$p = new _pos;

$result_1 = $p->read_users($_SESSION['uid']);

if ($result_1) {
$i = 1;
while ($row_1 = mysqli_fetch_assoc($result_1)) {

?>
<option value="<?php echo $row_1['id']; ?>"><?php echo $row_1['user_name']; ?></option>


<?php }} ?>

</select>  
<select class="form-control form-select" name="role" required>
<option selected> Select User Role</option>
<option value="1"> Admin</option>
<option value="2"> Manager</option>
<option value="3"> Inventory Incharge</option>
<option value="4"> Purchaser</option>
<option value="5"> Accountant</option>
<option value="6"> POS</option>
</select>
<input type="submit" name="" class="btn btn-main" value="Add" />
</div>
</form>
</div>
<div class="col-12 bg-gray py-3 bg-gray py-3">

<table id="users_table" class="display table-respnsive bg-light py-3" data-order='[[ 1, "asc" ]]' data-page-length="10">
<thead>
<tr>
<th>ID</th>
<th>User Name</th>
<th>Email</th>
<!-- <th>Contact</th>-->
<th>Role</th>
<th>Action</th>
</tr>
</thead>
<tbody>
<?php $us= new _pos;
$us1=$us->read_users($_SESSION['uid']);
if($us1!=false){
while($row=mysqli_fetch_assoc($us1)){
$id=$row['id'];
$username=$row['user_name'];
$email=$row['email'];
$contact=$row['phone'];
$role=$row['role'];
?>
<tr>
<td><?php echo $row['id'];?></td>
<td><?php echo $row['user_name'];?></td>
<td><?php echo $row['email'];?></td>
<!--<td><?php echo $row['phone'];?></td>-->
<td><?php if($row['role']==1){echo "Admin";}
if($row['role']==2){echo "Manager";}
if($row['role']==3){echo "Inventory Incharge";}
if($row['role']==4){echo "Purchaser";}
if($row['role']==5){echo "Accountant";}
if($row['role']==6){echo "POS";}
?>
</td>
<td>
<a onclick="edit_users('<?php echo $id; ?>','<?php echo $username; ?>','<?php echo $email; ?>','<?php echo $contact; ?>','<?php echo $role; ?>')" ><i class="fas fa-edit me-1"></i></a>
| 
<a class="text-danger" onclick="delete_user('<?php echo $BaseUrl?>/store/pos-dashboard/add_pos_user.php?id=<?php echo $id;?>&action=delete')"> <i class="fas fa-trash"></i></a>
</td>
</tr>
<?php }} ?>
</tbody>
</table>
</div>
</div>
</div>

<!-- Button trigger modal -->


<!-- Modal -->

<div class="modal fade" id="users_edit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog modal-sm"> 
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title" id="exampleModalLabel">Update User Details</h5>
<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
<form action="update_pos_user.php" method="post">
<label>User Name</label>
<input type="hidden" name="id" id="user_id">
<input type="text" class="form-control" id="user_name_" name="user_name" placeholder="User Name"  required />
<label>Email</label>
<input type="text" class="form-control" id="email_" name="email" placeholder="Email Address"  required />
<label>Contact User</label>
<select class="form-control form-select js-example-basic-multiple  me-2" style="width:210px" id="contact_" name="contact"><option value=""> Select Contact User</option>
<?php
$p = new _pos;

$result_1 = $p->read_users($_SESSION['uid']);

if ($result_1) {
$i = 1;
while ($row_1 = mysqli_fetch_assoc($result_1)) {

?>
<option value="<?php echo $row_1['id']; ?>"><?php echo $row_1['user_name']; ?></option>


<?php }} ?>

</select> 
<!-- <input type="text" class="form-control" id="contact_" name="contact" min="10" max="10" placeholder="User Contact"  required />-->
<label>Role</label>
<select class="form-control form-select" name="role" id="role_val_" required>  

<option value="1" <?php if($role==1){echo "Selected";}?>> Admin</option>
<option value="2" <?php if($role==2){echo "Selected";}?>> Manager</option>
<option value="3"<?php if($role==3){echo "Selected";}?>> Inventory Incharge</option>
<option value="4" <?php if($role==4){echo "Selected";}?>> Purchaser</option>
<option value="5" <?php if($role==5){echo "Selected";}?>> Accountant</option>
<option value="6" <?php if($role==6){echo "Selected";}?>> POS</option>
</select>

</div>
<div class="modal-footer">
<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
<button type="submit" class="btn btn-primary">Save changes</button>
</form>
</div>
</div>
</div>
</div>





<div class="tab-pane <?php if($_GET['record'] == "roles_type"){echo 'active';} ?>" id="roles" role="tabpanel" aria-labelledby="rolse-tab">
<h3 class="py-3">Add Role</h3>
<div class="row justify-content-md-center">
<div class="col-auto mb-3">
<form action="add_pos_role.php" method="POST">
<div class="d-flex flex-column">
<input type="text" class="form-control" id="role_type" name="role" placeholder="Role Name" required />
<div class="form-check me-2">
<input class="form-check-input" type="checkbox" value="1" name="check1" id="flexCheckDefault">
<label class="form-check-label" for="flexCheckDefault">
POS
</label>
</div>
<div class="form-check me-2">
<input class="form-check-input" type="checkbox" value="1" name="check2" id="flexCheckChecked2" >
<label class="form-check-label" for="flexCheckChecked2">
Product
</label>
</div>
<div class="form-check me-2">
<input class="form-check-input" type="checkbox" value="1" name="check3" id="flexCheckChecked3" >
<label class="form-check-label" for="flexCheckChecked3">
Customer
</label>
</div>
<div class="form-check me-2">
<input class="form-check-input" type="checkbox" value="1" name="check4" id="flexCheckChecked4">
<label class="form-check-label" for="flexCheckChecked4">
Supplier
</label>
</div>
<div class="form-check me-2">
<input class="form-check-input" type="checkbox" value="1" name="check5" id="flexCheckChecked5" >
<label class="form-check-label" for="flexCheckChecked5">
Inventory 
</label>
</div>
<div class="form-check me-2">
<input class="form-check-input" type="checkbox" value="1" name="check6" id="flexCheckChecked6" >
<label class="form-check-label" for="flexCheckChecked6">
Purchase
</label>
</div>
<div class="form-check me-2">
<input class="form-check-input" type="checkbox" value="1" name="check7" id="flexCheckChecked7" >
<label class="form-check-label" for="flexCheckChecked7">
Report
</label>
</div>
<div class="form-check me-2">
<input class="form-check-input" type="checkbox" value="1" name="check8" id="flexCheckChecked8" >
<label class="form-check-label" for="flexCheckChecked8">
Store
</label>
</div>
<div class="form-check me-2">
<input class="form-check-input" type="checkbox" value="1" name="check9" id="flexCheckChecked9" >   
<label class="form-check-label" for="flexCheckChecked9">
Settings
</label>
</div>


<input type="submit" name="" class="btn btn-main" value="Add" />
</div>
</form>
</div>
<div class="col-12 bg-gray py-3 bg-gray py-3">                        
<table id="roles_table" class="display table-respnsive bg-light py-3" data-order='[[ 1, "asc" ]]' data-page-length="10">
<thead>
<tr>
<th>ID</th>
<th>Role Name</th>
<th>Action</th>
</tr>
</thead>
<tbody>
<?php $us= new _pos;
$us1=$us->read_roles($_SESSION['uid']);
if($us1!=false){
while($row=mysqli_fetch_assoc($us1)){
$id_role=$row['id'];

$role=$row['role_name'];
?>
<tr>
<td><?php echo $id_role;?></td>
<td><?php echo $role;?></td>
<td>
<a onclick="edit_roles('<?php echo $id_role; ?>','<?php echo $role; ?>','<?php echo $row['check1']; ?>','<?php echo $row['check2']; ?>','<?php echo $row['check3']; ?>','<?php echo $row['check4']; ?>','<?php echo $row['check5']; ?>','<?php echo $row['check6']; ?>','<?php echo $row['check7']; ?>','<?php echo $row['check8']; ?>','<?php echo $row['check9']; ?>')" ><i class="fas fa-edit me-1"></i></a>
| 
<a class="text-danger" onclick="delete_role('<?php echo $BaseUrl?>/store/pos-dashboard/add_pos_role.php?id=<?php echo $id_role;?>&action=delete')"> <i class="fas fa-trash"></i></a>
</td>
</tr>
<?php }} ?>
</tbody>
</table>
</div>


</div>
<!---Role Modal-->
<div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title" id="exampleModalLabel">Update Role</h5>
<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
<form action="update_pos_role.php" method="post">

<label>Role</label>
<input type="text" class="form-control" id="role_name" name="role"  placeholder="Role Name"  required />
<input type="hidden" class="form-control" id="role_id" name="id_role"  required />

<div class="form-check me-2">
<input class="form-check-input" type="checkbox" value="1" name="check1" id="check1_">
<label class="form-check-label" for="check1_">
POS
</label>
</div>
<div class="form-check me-2">
<input class="form-check-input" type="checkbox" value="1" name="check2" id="check2_" >
<label class="form-check-label" for="check2_">
Product
</label>
</div>
<div class="form-check me-2">
<input class="form-check-input" type="checkbox" value="1" name="check3" id="check3_" >
<label class="form-check-label" for="check3_">
Customer
</label>
</div>
<div class="form-check me-2">
<input class="form-check-input" type="checkbox" value="1" name="check4" id="check4_">
<label class="form-check-label" for="check4_">
Supplier
</label>
</div>
<div class="form-check me-2">
<input class="form-check-input" type="checkbox" value="1" name="check5" id="check5_" >
<label class="form-check-label" for="check5_">
Inventory 
</label>
</div>
<div class="form-check me-2">
<input class="form-check-input" type="checkbox" value="1" name="check6" id="check6_" >
<label class="form-check-label" for="check6_">
Purchase
</label>
</div>
<div class="form-check me-2">
<input class="form-check-input" type="checkbox" value="1" name="check7" id="check7_" >
<label class="form-check-label" for="check7_">
Report
</label>
</div>
<div class="form-check me-2">
<input class="form-check-input" type="checkbox" value="1" name="check8" id="check8_" >
<label class="form-check-label" for="check8_">
Store
</label>
</div>
<div class="form-check me-2">
<input class="form-check-input" type="checkbox" value="1" name="check9" id="check9_" >   
<label class="form-check-label" for="check9_"> 
Settings
</label>
</div>

</div>
<div class="modal-footer">
<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
<button type="submit" class="btn btn-primary">Save changes</button>
</form>
</div>
</div>
</div>
</div>
</div>
<div class="tab-pane <?php if($_GET['record'] == "pass_type"){echo 'active';} ?>" id="password" role="tabpanel" aria-labelledby="password-tab">
<h3 class="py-3">Password & Security</h3>
<div class="row justify-content-md-center">
<div class="col-auto mb-3">
<h6>Master Password</h6>
<?php /*if(isset($_SESSION['pass_check']) == 1){*/
$us= new _pos;
$us2=$us->read_pos_password($_SESSION['uid']); 

if($us2){


?>
<form action="add_setting_password.php" method="post">
<div class="d-flex flex-row">
<input type="password" class="form-control" id="old_password" name="old_password_in" placeholder="Old Password" required />
<i class="bi bi-eye-slash" id="togglePassword" onclick="aaa(this.id)"></i>
<input type="password" class="form-control" id="new_password" name="new_password_in" placeholder="New Password" required />
<i class="bi bi-eye-slash" id="togglePassword2" onclick="aaa(this.id)"></i>
<input type="password" class="form-control" id="confirm_password" name="confirm_password_in" placeholder="Confirm Password" required />
<i class="bi bi-eye-slash" id="togglePassword3" onclick="aaa(this.id)"></i>
<input type="submit" name="" class="btn btn-main" value="Change" />
</div>  
</form>
<?php } else{ ?>

<form action="set_setting_password.php" method="post">
<div class="d-flex flex-row">

<input type="password" class="form-control" id="new_password" name="new_password_in" placeholder="New Password" required />
<input type="password" class="form-control" id="confirm_password" name="confirm_password_in" placeholder="Confirm Password" required />
<input type="submit" name="" class="btn btn-main" value="submit" />
</div>
</form>

<?php } ?>
</div> 
<br>
<hr>
<br>
<div class="col-auto mb-3">
<h6>Set User Password</h6>
<form action="set_user_password.php" method="post">
<div class="d-flex flex-row">
<select class="form-control form-select" name="user">
<option selected> Select User </option>
<?php $us= new _pos;
$us1=$us->read_users($_SESSION['uid']);
if($us1!=false){
while($row=mysqli_fetch_assoc($us1)){  ?>
<option value="<?php echo $row['id'];?>"><?php echo $row['user_name'];?></option>
<?php }} ?> 

</select>
<input type="password" class="form-control" id="set_password" name="set_password_in" placeholder="Set Password" required />
<input type="submit" name="" class="btn btn-main" value="Set Password" />
</div>
</form>
</div>    

<div class="col-12 bg-gray py-3 bg-gray py-3">                                       
<table id="pass_table" class="display table-respnsive bg-light py-3" data-order='[[ 1, "asc" ]]' data-page-length="10">
<thead>
<tr>
<th>ID</th>
<th>User Name</th>
<th>password</th>
<th>Action</th>
</tr>
</thead>
<tbody>
<?php 

$p5 = new _pos;
$result_paass = $p5->get_user_pass();
if ($result_paass) {

while ($row_pass = mysqli_fetch_assoc($result_paass)) {
?>
<tr>
<td><?php echo $row_pass['id']; ?></td>
<td><?php echo $row_pass['users']; ?></td>
<td><?php echo $row_pass['password']; ?></td>
<td>
<a onclick="pass_edit('<?php echo $row_pass['id']; ?>','<?php echo $row_pass['users']; ?>','<?php echo $row_pass['password']; ?>')" ><i class="fas fa-edit me-1"></i></a>| 

<a href="<?php echo $BaseUrl?>/store/pos-dashboard/update_password.php?id=<?php echo $row_pass['id'];?>&action=delete" class="text-danger"> <i class="fas fa-trash"></i></a>
</td>
</tr>
<?php }} ?>

</tbody>
</table>
</div>	 
</div>

</div>
<div class="tab-pane <?php if($_GET['record'] == "discount_type"){echo 'active';} ?>" id="discount" role="tabpanel" aria-labelledby="discount-tab">
<h3 class="py-3">Add Disount</h3>
<div class="row justify-content-md-center">
<div class="col-auto mb-3">
<form action="add_pos_discount.php" method="post">
<div class="d-flex flex-row">
<input type="text" class="form-control" id="discount_type" name="discount_type" placeholder="Discount Type" required />
<input type="text" class="form-control" id="discount_value" name="discount_value" placeholder="Discount Vale" required />
<input type="submit" name="" class="btn btn-main" value="Add" />
</div>
</form>
</div>
<div class="col-12 bg-gray py-3 bg-gray py-3">

<table id="discount_table" class="display table-respnsive bg-light py-3" data-order='[[ 1, "asc" ]]' data-page-length="10">
<thead>
<tr>
<th>ID</th>
<th>Discount Type</th>
<th>Discount Value</th>
<th>Action</th>
</tr>
</thead>
<tbody>

<?php $us= new _pos;
$us1=$us->read_discount($_SESSION['uid']);
if($us1!=false){
while($row=mysqli_fetch_assoc($us1)){
$id_discount=$row['id'];

$discount_value=$row['discount_value'];
$discount_type=$row['discount_type'];
?>
<tr>
<td><?php echo $id_discount;?></td>
<td><?php echo $discount_type;?></td>
<td><?php echo $discount_value;?></td>
<td>

<a onclick="edit_discount('<?php echo $id_discount; ?>','<?php echo $discount_type; ?>','<?php echo $discount_value; ?>')" ><i class="fas fa-edit me-1"></i></a>

| 
<a class="text-danger" onclick="delete_discount('<?php echo $BaseUrl?>/store/pos-dashboard/add_pos_discount.php?id=<?php echo $id_discount;?>&action=delete')"> <i class="fas fa-trash"></i></a>
</td>
</tr>
<?php }} ?>
</tbody>
</table>
</div>
</div>

<!---Discount Modal-->

<div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title" id="exampleModalLabel">Update Discount</h5>
<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
<form action="update_pos_discount.php" method="post">

<label>Discount Type</label>
<input type="text" class="form-control" id="discount_type_" name="discount_type" placeholder="Discount Type"  required />
<label>Discount Value</label>
<input type="text" class="form-control" id="discount_value_" name="discount_value" placeholder="Discount Vale"   required />
<input type="hidden" class="form-control" id="discount_id"  name="id_discount"  required /> 

</div>
<div class="modal-footer">
<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
<button type="submit" class="btn btn-primary">Save changes</button>
</form>
</div>
</div>
</div>
</div>

</div>

<div class="tab-pane <?php if($_GET['record'] == "contact_type"){echo 'active';} ?>" id="contacttoadmin" role="tabpanel" aria-labelledby="contacttoadmin-tab">
<h3 class="py-3">Contact To Site Admin</h3>
<div class="row justify-content-md-center"> 
<div class="col-auto text-center mb-3">
<?php $us= new _pos;
$us1=$us->read_admin($_SESSION['uid']); 

if($us1){

$row=mysqli_fetch_assoc($us1);


?>

<form action="update_contact_admin.php" method="post" enctype="multipart/form-data">
<div class=""> 

<input type="hidden" name="id" value="<?php echo $row['id']; ?>">
<input type="hidden" name="hidden_image" value="<?php echo $row['file']; ?>">
<label for="spUserEmail" class="control-label" style="display:flex">Subject:&nbsp; 
<input type="text" class="form-control mb-3" id="subject" name="subject" value="<?php echo $row['subject_type'];  ?>" placeholder="Subject Type" required /> </label>
<label for="spUserEmail" class="control-label" style="display:flex">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Body: &nbsp;			   
<textarea class="form-control mb-3" rows="6" name="message" cols="50"><?php echo $row['message'];  ?></textarea> </label>
<img src="<?php echo $BaseUrl.'/store/pos-dashboard/upload_pos/'.$row['file']; ?>" class="img-sm img-fluid img-thumbnail mb-2" id= "preview_img_11" style="max-width: 100px; border: outset; border-collapse: separate; border-spacing: 20px;"> 
<label for="spUserEmail" class="control-label" style="display:flex">Company Logo:&nbsp; 			   
<input type="file" class="form-control mb-3" style="width: 77%!important;" name="profile_img" id="image_file_11"></label>
<input type="submit" name="submit" class="btn btn-main float-end" value="Send" />
</div>
</form>

<?php


} else{ ?>

<form action="contact_admin.php" method="post" enctype="multipart/form-data">
<div class="">
<label for="spUserEmail" class="control-label" style="display:flex">Subject:&nbsp; 
<input type="text" class="form-control mb-3" id="subject" name="subject"  placeholder="Subject Type" required /></label>
<label for="spUserEmail" class="control-label" style="display:flex">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Body: &nbsp;
<textarea class="form-control mb-3" rows="6" name="message" cols="50"></textarea></label>
<img src="" class="img-sm img-fluid img-thumbnail mb-2" id= "preview_img_11">    
<label for="spUserEmail" class="control-label" style="display:flex">Company Logo:&nbsp;			   
<input type="file" class="form-control mb-3" name="profile_img" id="image_file_11">  </label> 
<input type="submit" name="submit" class="btn btn-main float-end" value="Send" />
</div>
</form>

<?php 
}?>


</div> 
<div class="col-12">
<table id="admin_table" class="display table-respnsive bg-light py-3" data-order='[[ 1, "asc" ]]' data-page-length="10">
<thead>
<tr>
<th>ID</th>
<th>Subject</th>
<th>Message</th>
<th>Date & Time</th>
<th>Status</th>
</tr>
</thead>
<tbody>
<td>1</td>
<td>Test Subject</td>
<td>Test Message</td>
<td>15-09-22 6:40PM</td>
<td>Sent</td>
</tbody>
</table>
</div>                                                      
</div>

</div>
<?php if($_GET['record'] == "support_typee"){ ?>
<div class=" <?php if($_GET['record'] == "support_typee"){echo 'active';} ?>" id="support" role="tabpanel" aria-labelledby="supoort-tab">
<?php
$sdetails = $us->get_support();
if($sdetails->num_rows > 0 ){
$sdata = mysqli_fetch_assoc($sdetails);
}
?>
<div class="row justify-content-md-center">
<div class="p-5">
<h4><?= $sdata['title']; ?></h4>
<p>
<?= $sdata['support_msg']; ?>
</p>
<h6>Call: <span class="font-li"><?= $sdata['phone']; ?></span></h6>
<h6>Email: <span class="font-li"><?= $sdata['email']; ?></span></h6>
<h6>Whatsapp: <span class="font-li"><?= $sdata['whatsapp']; ?></span></h6><br/>
</div>
<div class="row mb-3 tab-pane">
<form action="add_support_detail.php?action=addSupport" method="POST"> 
<div class="p-5">
<div class="col-md-12">
<h3>Title</h3>
<input type="text" class="form-control" name="title" id="call" value="<?= $sdata['title']; ?>" /><br/>
</div>
<div class="col-md-12">
<label><strong>Description:</strong></label><br/>
<textarea id="support" class="form-control" name="support" rows="3" cols="50"><?= $sdata['support_msg']; ?>
</textarea><br/>
</div>
<div class="col-md-12">
<label><strong>Call:</strong></label><br/>
<input type="number" class="form-control" name="call" id="call" value="<?= $sdata['phone']; ?>" /><br/>
</div>
<div class="col-md-12">
<label><strong>Email:</strong> </label><br/>
<input type="email" class="form-control" name="email" id="email" value="<?= $sdata['email']; ?>" /><br/>
</div>

<div class="col-md-12">
<label><strong>Whatsapp:</strong> </label><br/>
<input type="number" class="form-control" name="whatsapp" id="whatsapp" value="<?= $sdata['whatsapp']; ?>" /><br/><br/>
</div>


<button type="submit" value="ADD" style="float:right" class="float-right btn btn-main">Update</button>
</div>


</form>
</div>                                                       
</div>
</div>
<?php } ?>
<div class="tab-pane <?php if($_GET['record'] == "membership_type"){echo 'active';} ?>" id="assign_membership" role="tabpanel" aria-labelledby="supoort-tab">
<?php
$sdetails = $us->get_support();
if($sdetails->num_rows > 0 ){
$sdata = mysqli_fetch_assoc($sdetails);
}
?>
<div class="row justify-content-md-center">
<div class="p-5">
<h4><?= $sdata['title']; ?></h4>
<p>
<?= $sdata['support_msg']; ?>
</p>
<h6>Call: <span class="font-li"><?= $sdata['phone']; ?></span></h6>
<h6>Email: <span class="font-li"><?= $sdata['email']; ?></span></h6>
<h6>Whatsapp: <span class="font-li"><?= $sdata['whatsapp']; ?></span></h6><br/>
</div>
<div class="row mb-3">
<form action="add_support_detail.php" method="POST"> 
<div class="p-5">
<div class="col-md-12">
<h3>Title</h3>
<input type="text" class="form-control" name="title" id="call"/><br/>
</div>
<div class="col-md-12">
<label><strong>Description:</strong></label><br/>
<textarea id="support" class="form-control" name="support" rows="3" cols="50">
</textarea><br/>
</div>
<div class="col-md-12">
<label><strong>Call:</strong></label><br/>
<input type="text" class="form-control" name="call" id="call"/><br/>
</div>
<div class="col-md-12">
<label><strong>Email:</strong> </label><br/>
<input type="email" class="form-control" name="email" id="email"/><br/>
</div>

<div class="col-md-12">
<label><strong>Whatsapp:</strong> </label><br/>
<input type="text" class="form-control" name="whatsapp" id="whatsapp"/><br/><br/>
</div>
<button type="submit" value="ADD" class="float-right btn btn-main">Add</button>
</div>

</form>
</div>                                                       
</div>
</div>

</div>
</div>
</div>
</div>
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
</div>

<!------------------------------------------ Scripts Files ------------------------------------------>
<script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.12.1/datatables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script src="js/data.js"></script>
<script src="js/custom-chart.js"></script>
<script type="text/javascript">
$(document).ready(function () {
$("#payment_table").DataTable({                 
searching: false,
paging: false,     
});
$("#qty_table").DataTable({                 
searching: false,
paging: false,     
});
$("#duration_table").DataTable({                 
searching: false,
paging: false,     
});
$("#tax_table").DataTable({                 
searching: false,
paging: false,     
});
$("#pass_table").DataTable({                 
searching: false,
paging: false,     
});
$("#deparment_table").DataTable({                 
searching: false,
paging: false,     
});
$("#category_table").DataTable({                 
searching: false,
paging: false,     
});                
$("#branches_table").DataTable({                 
searching: false,
paging: false,     
});
$("#users_table").DataTable();
$("#roles_table").DataTable({                 
searching: false,
paging: false,     
});
$("#discount_table").DataTable({                 
searching: false,
paging: false,     
});
$("#admin_table").DataTable({                 
searching: false,
paging: false,     
});
});





$('#department').keyup( function() {
var department=$('#department').val();
//alert(department);
$.ajax({
url       : 'department_check.php',
type      : 'POST', 
data  : {type:department},
success   : function($data) {
//alert($data);
$('#depcheck').html($data);

}

});




});

function depart1(){
var sp54=$('#depcheck').html();
sp55= sp54.trim();
//alert(sp55);
if(sp55){
return false;
}
else{
// alert(sp54);
return true;
}
}




</script>

<script type="text/javascript">
$(document).ready(function() {
$('.js-example-basic-multiple').select2();
});
</script>

<script type="text/javascript">
$(document).ready(function () {
$('#example').DataTable();
"columnDefs": [
{ "searchable": false, "targets": 0 }
]
});

</script>

<script src="<?php echo $baseurl?>/assets/js/sweetalert.js"></script>
<script>
function delete_user(url){
//alert('jjjjjj');
Swal.fire({
title: 'Are you sure want to delete?',

icon: 'warning',
showCancelButton: true,
confirmButtonColor: '#3085d6',
cancelButtonColor: '#d33',
cancelButtonText: 'No',
confirmButtonText: 'Yes'

}).then((result) => {
if (result.isConfirmed) {
window.location = url;
}
})  

}   


function delete_role(url){
//alert('jjjjjj');
Swal.fire({
title: 'Are you sure want to delete?',

icon: 'warning',
showCancelButton: true,
confirmButtonColor: '#3085d6',
cancelButtonColor: '#d33',
cancelButtonText: 'No',
confirmButtonText: 'Yes'

}).then((result) => {
if (result.isConfirmed) {
window.location = url;
}
})  

} 


function delete_discount(url){
//alert('jjjjjj');
Swal.fire({
title: 'Are you sure want to delete?',

icon: 'warning',
showCancelButton: true,
confirmButtonColor: '#3085d6',
cancelButtonColor: '#d33',
cancelButtonText: 'No',
confirmButtonText: 'Yes'

}).then((result) => {
if (result.isConfirmed) {
window.location = url;
}
})  

} 


function edit_payment(a,b){
// alert(a);  

$("#payment_edit").modal('show');  
$("#payment_type_").val(b);
$("#row_id").val(a);
/*Swal.fire({
title: 'Are you sure want to delete?',

icon: 'warning',
showCancelButton: true,
confirmButtonColor: '#3085d6',
cancelButtonColor: '#d33',

}).then((result) => {
if (result.isConfirmed) {
window.location = url;
}
})  
*/     
}    

function edit_tax(a,b,c){
//alert(c);  

$("#tax_edit").modal('show');  
$("#tax_type_").val(b);
$("#tax_value_").val(c);  
$("#tax_id").val(a);

}

function pass_edit(a,b,c){
$("#pass_edit").modal('show');  
$("#usersname").val(b);
$("#userspass").val(c);  
$("#paas_id").val(a);
}


function edit_depart(a,b){
//alert(c);  

$("#depart_edit").modal('show');  
$("#department_").val(b);

$("#depart_id").val(a);

}

function edit_category(a,b,c){
//alert(c);  

$("#category_edit").modal('show');  
$("#select_category_").val(b);
$("#type_category_").val(c);

$("#cat_id").val(a);

}

function edit_gift(a,b,c){
//alert(c);  

$("#gift_edit").modal('show');  
$("#giftcard_type_").val(b);
$("#giftcard_value_").val(c);

$("#gift_id").val(a);  

}


function edit_branches(a,b,c,d){
//alert(c);  

$("#branches_edit").modal('show');    
$("#branches_name_").val(b);
$("#branches_address_").val(c);
$("#branches_contact_").val(d);

$("#bran_id").val(a);  

}


function edit_roles(a,b,c,d,e,f,g,h,i,j,k){
//alert(c);  

$("#exampleModal1").modal('show');    
$("#role_name").val(b);

$("#role_id").val(a);
// alert(c);

if(c == 1) {
//alert('hello');
//$('#check1_:checkbox:checked');
//$('input[name="check1"]:checked'); 
//$('#check1_').prop('checked');
//$('#check1_')[0].checked	;
$("#check1_").attr ( "checked" ,"checked" ); 
}

if(d == 1) {
//$('#check2_')[0].checked; 
$("#check2_").attr ( "checked" ,"checked" );   
}

if(e == 1) {
//$('#check3_')[0].checked; 
$("#check3_").attr ( "checked" ,"checked" ); 
}

if(f == 1) {
//$('#check4_')[0].checked; 
$("#check4_").attr ( "checked" ,"checked" ); 
}

if(g == 1) {
//$('#check5_')[0].checked; 
$("#check5_").attr ( "checked" ,"checked" ); 
}

if(h == 1) {
//$('#check6_')[0].checked; 
$("#check6_").attr ( "checked" ,"checked" ); 
}

if(i == 1) {
//$('#check7_')[0].checked; 
$("#check7_").attr ( "checked" ,"checked" ); 
}

if(j == 1) {
//$('#check8_')[0].checked; 
$("#check8_").attr ( "checked" ,"checked" ); 
}

if(k == 1) {
//$('#check9_')[0].checked; 
$("#check9_").attr ( "checked" ,"checked" ); 	
}

} 


function edit_discount(a,b,c){
//alert(c);  

$("#exampleModal2").modal('show');    
$("#discount_type_").val(b);
$("#discount_value_").val(c); 

$("#discount_id").val(a);  

} 

function edit_users(a,b,c,d,e){
//alert("hello");

$("#users_edit").modal('show'); 
$("#user_id").val(a);  		
$("#user_name_").val(b);
$("#email_").val(c); 
$("#contact_").val(d); 
$("#role_val_").val(e); 



}  

function edit_mem_qty(a,b,c,d,e,f){ 
//alert("hello");

$("#mem_qty_edit").modal('show'); 
$("#qty_id").val(a);  		
$("#name_qty_").val(b);
$("#Qty_qty_").val(c); 
$("#price_qty_").val(d); 
$("#description_").val(e); 
$("#barcode_id_").val(f); 




}  


function edit_mem_dur(a,b,c,d,e,f,g){  
//alert("hello");

$("#mem_dur_edit").modal('show'); 
$("#dur_id").val(a);  		
$("#Name_1").val(b);
$("#dur_Qty_1").val(c); 
$("#dur_price_1").val(d); 
$("#paymentterm_1").val(e);  
$("#description_1").val(f);  
$("#barcode_in_1").val(g);   




} 

function delete_payment(url){
//alert('jjjjjj');
Swal.fire({
title: 'Are you sure want to delete?',

icon: 'warning',
showCancelButton: true,
confirmButtonColor: '#3085d6',
cancelButtonColor: '#d33',
cancelButtonText: 'No',
confirmButtonText: 'Yes'

}).then((result) => {
if (result.isConfirmed) {
window.location = url;
}
})  

} 


function delete_tax(url){
//alert('jjjjjj');
Swal.fire({
title: 'Are you sure want to delete?',

icon: 'warning',
showCancelButton: true,
confirmButtonColor: '#3085d6',
cancelButtonColor: '#d33',
cancelButtonText: 'No',
confirmButtonText: 'Yes'

}).then((result) => {
if (result.isConfirmed) {
window.location = url;
}
})  

} 


function delete_depart(url){
//alert('jjjjjj');
Swal.fire({
title: 'Are you sure want to delete?',

icon: 'warning',
showCancelButton: true,
confirmButtonColor: '#3085d6',
cancelButtonColor: '#d33',
cancelButtonText: 'No',
confirmButtonText: 'Yes'

}).then((result) => {
if (result.isConfirmed) {
window.location = url;
}
})  

} 

function delete_category(url){
//alert('jjjjjj');
Swal.fire({
title: 'Are you sure want to delete?',

icon: 'warning',
showCancelButton: true,
confirmButtonColor: '#3085d6',
cancelButtonColor: '#d33',
cancelButtonText: 'No',
confirmButtonText: 'Yes'

}).then((result) => {
if (result.isConfirmed) {
window.location = url;
}
})  

}   

function delete_gift(url){
//alert('jjjjjj');
Swal.fire({
title: 'Are you sure want to delete?',

icon: 'warning',
showCancelButton: true,
confirmButtonColor: '#3085d6',
cancelButtonColor: '#d33',
cancelButtonText: 'No',
confirmButtonText: 'Yes'

}).then((result) => {
if (result.isConfirmed) {
window.location = url;
}
})  

}


function delete_branches(url){
//alert('jjjjjj');
Swal.fire({
title: 'Are you sure want to delete?',

icon: 'warning',
showCancelButton: true,
confirmButtonColor: '#3085d6',
cancelButtonColor: '#d33',
cancelButtonText: 'No',
confirmButtonText: 'Yes'

}).then((result) => {
if (result.isConfirmed) {
window.location = url;
}
})  

} 


function delete_mem_qty(url){
//alert('jjjjjj');
Swal.fire({
title: 'Are you sure want to delete?',

icon: 'warning',
showCancelButton: true,
confirmButtonColor: '#3085d6',
cancelButtonColor: '#d33',
cancelButtonText: 'No',
confirmButtonText: 'Yes'

}).then((result) => {
if (result.isConfirmed) {
window.location = url;
}
})  

} 



function delete_mem_dur(url){
//alert('jjjjjj');
Swal.fire({
title: 'Are you sure want to delete?',

icon: 'warning',
showCancelButton: true,
confirmButtonColor: '#3085d6',
cancelButtonColor: '#d33',
cancelButtonText: 'No',
confirmButtonText: 'Yes'

}).then((result) => {
if (result.isConfirmed) {
window.location = url;
}
})  

} 
</script>
<script>
function aaa(aa){
// alert(aa);
if(aa=='togglePassword'){
//alert('hello');
var togglePassword = document.querySelector("#togglePassword");
var password = document.querySelector("#old_password");
}
if(aa=='togglePassword2'){
var togglePassword = document.querySelector("#togglePassword2");
var password = document.querySelector("#new_password");
}
if(aa=='togglePassword3'){
var togglePassword = document.querySelector("#togglePassword3");
var password = document.querySelector("#confirm_password");
}


//alert(togglePassword1);
togglePassword.addEventListener("click", function () {
// toggle the type attribute
const type = password.getAttribute("type") === "password" ? "text" : "password";
password.setAttribute("type", type);

// toggle the icon
this.classList.toggle("bi-eye");
});

// prevent form submit
const form = document.querySelector("form");
form.addEventListener('submit', function (e) {
e.preventDefault();
});
}
</script>

<script>
$(document).ready(function () {
$("#send_email").click(function(){
if ($('.chk_boxes1').is(":checked"))
{
//alert('========');
$('#form_submit').submit();
}else{
alert("Please Select Customer !");
}



});
setTimeout(function () {
$("#alert_email").hide();
}, 3000);
});
</script>

<script>
$(document).ready(function () {
$("#w_send_email").click(function(){
if ($('.w_chk_boxes1').is(":checked"))
{
//alert('========');
$('#W_form_submit').submit();
}else{
alert("Please Select Customer !");
}



});
});
</script>
</body>
</html>
<?php  }?>

