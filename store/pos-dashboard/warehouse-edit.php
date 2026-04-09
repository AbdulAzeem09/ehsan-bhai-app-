
<?php
// error_reporting(E_ALL);
// ini_set('display_errors', '1');


include('../../univ/baseurl.php');
session_start();
$_SESSION['msg']= 2;

if(!isset($_SESSION['pid'])){ 
$_SESSION['afterlogin']="store/";

include_once ("../../authentication/islogin.php");

}else{
function sp_autoloader($class){
include '../../mlayer/' . $class . '.class.php';
}
spl_autoload_register("sp_autoloader");
$active = 3;
$G_Id = isset($_GET['id']) ? (int) $_GET['id'] : 0;
$p = new _pos;
//$id = $_GET["id"];
$pid = $_SESSION['pid'];
$uid = $_SESSION['uid'];
if(isset($_POST['submit'])){
  $warehouse = $_POST['warehouse'];
$data= array(
  "warehouse"=> $warehouse
);
$res = $p->update_warehouse_($data,$G_Id);  
header("Location: warehouse.php");
}


?>




<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Business Account & Inventory | TheSharepage </title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.7.2/css/all.min.css" integrity="sha512-3M00D/rn8n+2ZVXBO9Hib0GKNpkm8MSUU/e2VNthDyBYxKWG+BftNYYcuEjXlyrSO637tidzMBXfE7sQm0INUg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">
<link rel="stylesheet" type="text/css" href="css/style.css">
<link rel="stylesheet" href="https://cdn.rawgit.com/t4t5/sweetalert/v0.2.0/lib/sweet-alert.css">
<style>
.me-3 {
padding-left:0px;
padding-right:0px;
margin-right: 14rem !important;
margin-bottom: 3px;
}

</style>
</head>
<body>
<div class="container-fluid">
<div class="row flex-nowrap">

<?php include('left_side_landing.php');?>  
<div class="col py-3">
<div class="row mb-4">
<div class="d-flex justify-content-between border-bottom mb-3"> 


<h3>Edit List</h3>
<!-- <button type="button" class="btn btn-main mb-3" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo"><span class="d-none d-sm-inline">Add Department</span></button> -->

</div>

<div class="col-6">
<?php 
$p = new _pos;
//$id=$_GET['id'];
$result = $p->readwarehouse($G_Id);
if ($result) {
   $row = mysqli_fetch_assoc($result);
   }
?>
  <form action="warehouse-edit.php?id=<?php echo $G_Id; ?>" method="post">
  <div class="mb-3">
  <label for="recipient-name" class="col-form-label">House:</label>
  <input type="text" class="form-control" name="warehouse" id="warehouse" value="<?php echo $row['warehouse']; ?>" required>
  </div>

  
  <div class="modal-footer">
  <a href="warehouse.php" class="btn btn-secondary">Back</a>
  <button type="submit" class="btn btn-primary" name="submit">Update</button>
  </form>
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
</body>
</html>

<?php } ?>
