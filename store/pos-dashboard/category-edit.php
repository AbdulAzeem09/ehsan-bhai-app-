
<?php

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

$G_Id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

$active = 3;
$p = new _pos;

$P_Id = isset($_POST['id']) ? (int) $_POST['id'] : 0;

$_GET["categoryid"] = "1";
$pid = $_SESSION['pid'];
$uid = $_SESSION['uid'];
//$id = $_POST['id'];

if(isset($_POST['submit'])){
  $code = $_POST['code'];
  $name = $_POST['name'];
$data= array(
  "code"=> $code,
  "name"=> $name

);
$res = $p->create_update_($data,$P_Id);  
header("Location: ExpenseCategory.php");
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
$result = $p->readExcadegory($G_Id);
if ($result) {
   $row = mysqli_fetch_assoc($result);
   }
?>
<form action="category-edit.php" method = "post">
<input type="hidden" name="id" value="<?php echo $row['id'] ?>">
<div class="mb-3">
  <label for="recipient-name" class="col-form-label">Code:</label><br>
  <div class="input-group">
    <input type="text" class="form-control" aria-label="Recipient's username" aria-describedby="basic-addon2" name="code" id="code_" value="<?php echo $row['code'] ?>" required>
    <span id="generateButton" class="input-group-text">Generate</span>
  </div>
  </div>
  <div class="mb-3">
    <label for="recipient-name" class="col-form-label">Name:</label>
    <input type="text" class="form-control" name="name" id="name" value="<?php echo $row['name'] ?>" required>
  </div>


<div class="modal-footer">
<a href="ExpenseCategory.php" class="btn btn-secondary">Back</a>
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
<script>
    function generateRandomAlphanumericString(length) {
      const characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
      const charLength = characters.length;
      let randomString = '';

      for (let i = 0; i < length; i++) {
        randomString += characters.charAt(Math.floor(Math.random() * charLength));
      }

      return randomString;
    }

    $(document).ready(function() {
      $('#generateButton').click(function() {
        const randomString = generateRandomAlphanumericString(8);
        $('#code_').val(randomString);
      });
    });
  </script>
<?php } ?>
