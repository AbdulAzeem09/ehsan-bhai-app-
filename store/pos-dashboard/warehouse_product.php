<?php 
/*error_reporting(E_ALL);
ini_set('display_errors', 'On');*/

include('../../univ/baseurl.php');
session_start();
if(!isset($_SESSION['pid'])){ 
$_SESSION['afterlogin']="dashboard/";
include_once ("../../authentication/islogin.php");

}else{
function sp_autoloader($class) {
include '../../mlayer/' . $class . '.class.php';
}
spl_autoload_register("sp_autoloader");
$active = 7;

$pid = $_SESSION['pid'];
$uid = $_SESSION['uid'];
?>



<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Categories List | TheSharepage - POS  </title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.7.2/css/all.min.css" integrity="sha512-3M00D/rn8n+2ZVXBO9Hib0GKNpkm8MSUU/e2VNthDyBYxKWG+BftNYYcuEjXlyrSO637tidzMBXfE7sQm0INUg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">
<link rel="stylesheet" type="text/css" href="css/style.css">
<style>




</style>
</head>
<body>
<div class="container-fluid">
<div class="row flex-nowrap">
<?php include('left_side_landing.php');?>  
<div class="col py-3">
<div class="row mb-4">
<div class="col-12">

<?php if($_SESSION['msg']=="1"){  unset($_SESSION['msg']); ?>
<div class="alert alert-success" id="success" role="alert">
Successfully Submitted.
</div>	   

<?php } ?>

<?php if($_SESSION['msg']=="2"){ unset($_SESSION['msg']); ?>
<div class="alert alert-success" id="p_success" role="alert">
Successfully updated .
</div>	   

<?php } ?> 




<?php if($_SESSION['msg']=="3"){ unset($_SESSION['msg']); ?>
<div class="alert alert-success" id="p_success" role="alert">
Delete Successfully .
</div>	   

<?php } ?> 
<h3>Warehouse Product</h3><br>
<!--<form action="add_product_category.php?action=add" method="post" id="submitadd">
<div class="row d-flex">

<div class="col-auto mobile-view mb-3">
<input type="text" class="form-control" id="sub_cat" name="sub_cat" placeholder="Category Name" aria-label="Category" aria-describedby="addon-wrapping" required>
<span id="error_1" class="text-danger"></span>
</div>  
<!-- <div class="col-auto">
<select class="form-control form-select js-example-basic-multiple" id="inputGroupSelect02" name="main_cat">
<option value="">Is This Parent</option>
<option value="Fruits">Fruits</option>
<option value="Vegetables">Vegetables</option>
</select> 
<span id="error_2" class="text-danger"></span>
</div>

<div class="col-auto">
<button type="button" class="btn btn-main" onclick="checkadd()"> <i class="fas fa-plus"></i> Category</button> 
</div>

</div> 
</form>--->
<div class="info"></div>
<table id="table_id" class="display"  data-order='[[ 0, "desc" ]]' data-page-length='25'>
<thead>
<tr>
<th>ID</th>

<th>Warehouse</th>                    
<th>Product Counts</th>
<th>View Store</th>
</tr>
</thead>
<tbody>
<?php 
$p = new _pos;
$result = $p->read_warehouse($pid, $uid);
if ($result) {
$i = 1;
while ($row = mysqli_fetch_assoc($result)) {
?>
<tr>
<td><?php echo $i++ ; ?></td>

<td><?php echo $row['warehouse']; ?></td>   
<td><?php 
$id=$row['id'];
$warehouse= $p->warehouse1_read($id);
if($warehouse){
echo $warehouse->num_rows;
}else{
echo "0";
}

?></td>   

<td> 
<a href="warehouse_product_view.php?key=all&&warehouse_id=<?php echo $row['id'] ?>" class=" btn btn-danger"> View</a>  

</td>   
                 
<!---<td style="padding: 8px 6px;">
<a href="<?php echo $BaseUrl.'/store/pos-dashboard/warehouse-edit.php?id='.$row['id'];?>" class="btn btn-main"><i class="fas fa-edit"></i></a>
<a onclick="deletefun(<?php echo $row['id']; ?>)" class=" btn btn-danger"> <i class="fas fa-trash"></i></a>
</td>  --->
</tr> 
<?php 
} }
?>			
</tbody>
</table>

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

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title" id="exampleModalLabel">Edit Categories</h5>
<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<form action="add_product_category.php?action=edit" method="post">
<div class="modal-body">
<input type="text" id="subcat" class="form-control" name="subcat" value="" >
<input type="hidden" id="catid" class="form-control" name="catid" value="" >
<!--<select name="categoriesedit">
<option value="">Is This Parent</option>
<option value="Fruits">Fruits</option>
<option value="Vegetables">Vegetables</option>
</select>-->
</div>
<div class="modal-footer">
<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
<button type="submit" class="btn btn-main">Update</button>
</div>
</form>
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
<script src="<?php echo $baseurl?>/assets/js/sweetalert.js"></script>  
<script type="text/javascript">
function checkadd(){   
var sub_cat = $("#sub_cat").val();
var inputGroupSelect02 = $("#inputGroupSelect02").val();
if(sub_cat == false){
$("#error_1").text("Enter  category name.");
}else if(inputGroupSelect02 == ""){
$("#error_2").text("Select category name.");
}else{
$("#submitadd").submit();
}
}

function checkdel(url){
Swal.fire({

title: "Are You Sure You Want to Delete?",
icon: 'warning',
showCancelButton: true,
confirmButtonColor: '#3085d6',
cancelButtonText: 'No',
cancelButtonColor: '#d33',
confirmButtonText: 'Yes'
}).then((result) => {
if (result.isConfirmed) {
window.location.href = url;    
}
}) 
}

function appendedit(main,sub,catid){
$("#subcat").val(sub);
$("#catid").val(catid);
$("select[name=categoriesedit] option[value="+main+"]").attr('selected','selected');
}
$(document).ready( function () {
var table = $('#table_id').dataTable( );
} );
</script>

<script>
setTimeout(function () {
$("#success").hide();
}, 5000);
setTimeout(function () {
$("#no_member").hide();
}, 5000);
setTimeout(function () {
$("#p_success").hide();
}, 5000);

</script>  

</body>
</html>

<?php } ?>