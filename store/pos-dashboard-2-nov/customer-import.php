<?php
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
</head>
<body>
   <div class="container-fluid">
      <div class="row flex-nowrap">
	  
	  <?php include('left_side_landing.php');?>  
         
         <div class="col py-3">
            <div class="row mb-4">
               <div class="d-flex justify-content-between border-bottom mb-3">
                  <h3>Customer's Import</h3>
                  <span class="float-end">
                     <input type="file" name="" class="">
                  <a href="index.php" class="btn btn-main me-3"><i class="fas fa-file-import"></i> Import</a>
                  </span>
                  
               </div>
               <div class="col-12">
                  
                  <table id="table_id" class="display"  data-order='[[ 1, "asc" ]]' data-page-length='25'>
                    <thead>
                      <tr>
                        <th>Customer ID</th>
                        <th>Customer Name</th>
                        <th>Address</th>
                        <th>Phone</th>
                        <th>Mobile</th>
                        <th>Email</th>
                        <th>Customer Type</th>                        
                        <th>Action</th>
                     </tr>
                  </thead>
                  <tbody>
                   <tr>
                     <td>#123</td>
                     <td>Jhone</td>
                     <td>Abc Street Lorem ipsum dolor sit amet, </td>
                     <td>+123456789</td>
                     <td>+123456789</td>
                     <td>customer@gmail.com</td>
                     <td>Retail</td>                     
                     <td><a href="customer-edit.php"><i class="fas fa-edit me-1"></i></a>| <a href="#" class="text-danger"> <i class="fas fa-trash"></i></a></td>
                  </tr> 
                  <tr>
                     <td>#124</td>
                     <td>Mark</td>
                     <td>Abc Street Lorem ipsum dolor sit amet, </td>
                     <td>+987654</td>
                     <td>+987654</td>
                     <td>1customer@gmail.com</td>
                     <td>whole Sale</td>                     
                     <td><a href="customer-edit.php"><i class="fas fa-edit me-1"></i></a>| <a href="#" class="text-danger"> <i class="fas fa-trash"></i></a></td>
                  </tr>                        
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
<!------------------------------------------ Scripts Files ------------------------------------------>
<script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.12.1/datatables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

<script src="js/data.js"></script>
<script src="js/custom-chart.js"></script>
<script type="text/javascript">
   $(document).ready( function () {
     $('#table_id').DataTable({  
   buttons: {
        buttons: [ 'copy', 'csv', 'excel' ]
    }
     });        
   });
</script>
</body>
</html>

<?php } ?>