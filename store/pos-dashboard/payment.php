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
<title>Payment Methods | TheSharepage-POS</title>
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

<div class="col py-3">
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


<?php if($_SESSION['msg']=="3"){ unset($_SESSION['msg']); ?>
<div class="alert alert-success" id="p_success" role="alert"> Delete
Successfully  .
</div>	   

<?php } ?>


<div class="col-12">

<div class="row">
<div class="col-12">
<div class="row">
<div class="col">
<div class="tab-content">
<div class="active" id="payment" role="tabpanel" aria-labelledby="payment-tab">

<h3 class="py-3">Payment Methods</h3>
<div class="row">
<div class="col-auto mb-3">
<form action="add_payment_type.php?action=addPay" method="POST">
<div class="d-flex flex-row">
<input type="text" class="form-control" name="payment_type" id="payment" placeholder="Type Payment Method" required />
<input type="submit" class="btn btn-main" style="margin-left: 12px;" value="Add" />  
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
<a  onclick="edit_payment('<?php echo $row['id']; ?>','<?php echo $row['payment_type']; ?>')"><i class="fas fa-edit me-1"></i></a>| <a onclick="delete_payment('<?php echo $BaseUrl?>/store/pos-dashboard/delete_payment.php?id=<?php echo $row['id'];?>&action=deletePay')" class="text-danger"> <i class="fas fa-trash"></i></a>
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
<div class="row text-center" ><h5> Update Payment Method </h5></div>      
<h5 class="modal-title" id="exampleModalLabel"></h5>
<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">


<form action="update_payment_type.php?action=updatePay" method="POST">
<div class="d-flex flex-row">
<input type="hidden"  name="id"  id="row_id">
<input type="text" class="form-control" name="payment_type" id="payment_type_" placeholder="Type Payment Method" required />

</div>

</div>
<div class="modal-footer">
<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
<input type="submit" class="btn btn-main"  value="Update" />  
</div>
</form>
</div>
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


<!--- customer List code here------->  

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
cancelButtonText: 'No',
cancelButtonColor: '#d33',
confirmButtonText: 'Yes',

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

