<?php

/*error_reporting(E_ALL);
ini_set('display_errors', 'On');*/



//include('../../univ/baseurl.php');
session_start();

function sp_autoloader($class){
include '../../../mlayer/' . $class . '.class.php';
}
spl_autoload_register("sp_autoloader");

?>
<!DOCTYPE html>
<html>
<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <title>Business Account & Inventory | TheSharepage </title>
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.7.2/css/all.min.css" integrity="sha512-3M00D/rn8n+2ZVXBO9Hib0GKNpkm8MSUU/e2VNthDyBYxKWG+BftNYYcuEjXlyrSO637tidzMBXfE7sQm0INUg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
   <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.12.1/datatables.min.css"/>
   <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

   <link rel="stylesheet" type="text/css" href="css/style.css">
   <style>
   .btn-dark {
    color: #fff;
    background-color: #198754;
    border-color: #198754;
}
.btn-success1 {
    color: #fff;
    background-color: #ffc107;
    border-color: #ffc107;
}
.btn-warning {
    color: #fff;
    background-color: #277BC0;
    border-color: #277BC0;
}
.total{
	color: red;
    font-weight: bold;
    margin-left: 100px;
}
   
   </style>
   
   
   
</head>
<body>
   <div class="container-fluid">
      <div class="row flex-nowrap">


         <div class="col py-3">  
            <div class="row align-self-stretch">
               <div class="d-flex justify-content-between mb-3">
                  <h4 class="float-start"> Point Of Sale</h4> 
                  <span class="float-end">
                     <a href="index.html" class="btn btn-success me-3"><i class="fas fa-tachometer-alt"></i> Back to Dashoard</a>
                     <a href="index.html" class="btn btn-danger me-3"><i class="fas fa-window-close"></i> Close POS</a>
                  </span>
               </div>
               <div class="col-lg-12 bg-light mb-3">                     
                  <div class="border-3 border-primary border-top p-3">
                    <div class="mb-1">
                     <div class="input-group flex-nowrap">
                        <div class="col-2 me-1 d-flex">
                           <input type="text" class="form-control" placeholder="Sales Person" aria-label="Sales Person" aria-describedby="addon-wrapping">
                        </div>
                        <div class="col-5 me-1 d-flex">
                           <select class="form-control form-select js-example-basic-multiple" id="inputGroupSelect02" name="customers[]" onchange="getvalue(this)">
						   <option value="0" >Select Name</option>
						   <?php
//die("==");
						   
						   $p = new _pos;
															
							$result = $p->read_data($_SESSION['pid']);     
							//print_r($result);
							//die('==');
																	//echo $_SESSION['pid'];
																	//var_dump($result); die();
                                                            //echo $p->ta->sql;
                                                            
                                                while ($row = mysqli_fetch_assoc($result)) {		//print_r($row);
						   
						   ?>
                            <option value="<?php echo $row['id']; ?>"  ><?php echo $row['name']; ?></option>
																<?php } ?>
						   
                            <!--<option value="2">Dave</option>
                            <option value="3">Yusha</option>-->
                         </select>                       
                         <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal1"> <i class="fas fa-plus"></i> </button>
                      </div> 
                      <div class="col-1 me-1 d-flex">
                        <input type="text" id="cus_id"class="form-control" placeholder="Cust ID:" aria-label="Customer ID:" aria-describedby="addon-wrapping">
                     </div> 
                     <div class="col-2 me-1 d-flex">
                        <input type="text" id="phone1" class="form-control" placeholder="Cust Ph:" aria-label="Customer Ph:" aria-describedby="addon-wrapping">
						 
						
						
                     </div>                                               
                     <div class="col-2 me-1 d-flex">
                        <input type="text" id="email" class="form-control" placeholder="Email" aria-label="Customer Email" aria-describedby="addon-wrapping">
						
                     </div>                        
                  </div>
               </div>
            </div>
         </div>
         <div class="col-lg-12 bg-light">                     
            <div class="border-3 border-success border-top p-3">
               <div class="mb-3">
                  <form method="post" action="#">
                     <div class="d-flex justify-content-center input-group"> 
                        <div class="col-2 me-1">
                         <input type="text" class="form-control" placeholder="Barcode" aria-label="Barcode" aria-describedby="addon-wrapping">
                      </div>                       
                      <div class="col-4 d-flex me-1">
                        <select class="form-control form-select js-example-basic-multiple" id="select-product" name="products[]" multiple="multiple">
                         
						   <?php
//die("==");
						  $p = new _pos_inventory;
															
	                                                                $result = $p->read_data($_SESSION['pid']);
																	//echo $_SESSION['pid'];
																	//var_dump($result); die();
                                                            //echo $p->ta->sql;
                                                            
                                                                while ($row = mysqli_fetch_assoc($result)) {		//print_r($row);
						   
						   ?>
                            <option value="<?php echo $row['iteam'] ?>"  ><?php echo $row['iteam']; ?></option>
																<?php } ?>
                        </select>                       
                        <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal2"> <i class="fas fa-plus"></i> </button>  
                   </div>                       
                   <div class="col-1 me-1">
                     <input type="text" class="form-control" placeholder="Color" readonly aria-label="Color" aria-describedby="addon-wrapping">
                  </div>                       
                  <div class="col-1 me-1">
                     <input type="text" class="form-control" placeholder="Size" readonly aria-label="Size" aria-describedby="addon-wrapping">
                  </div>                       
                  <div class="col-1 me-1">
                     <input type="text" class="form-control" placeholder="Quantity" aria-label="Quantity" aria-describedby="addon-wrapping">
                  </div>                       
                  <div class="col-1 me-1"> 
                     <input type="text" class="form-control" placeholder="Unit Price" aria-label="Unit Price" aria-describedby="addon-wrapping">
                  </div>                       
                  <div class="col-1 me-1">
                     <input type="submit" class="btn btn-success" name="submit" value="Add">
                  </div>

               </div>
            </form>
         </div>
      </div>
   </div>
   <div class="col-lg-12 bg-light top-product">   
    <table id="example" class="table table-striped">
     <thead>
      <tr>
       <th>Barcode</th>
       <th>Product Name</th>
       <th>Color</th>
       <th>Size</th>
       <th>Quantity</th>
       <th>Unit Price</th>
       <th width="60">Dicount</th>
       <th>T Price</th>
       <th>Action</th>
    </tr>
 </thead>
 <tbody>
   <tr>
    <td>|||||||||||</td>
    <td>Bannana</td>
    <td>N/A</td>
    <td>N/A</td>
    <td><input type="text" name="" value="12" style="width: 50px;"></td>
    <td><input type="text" name="" value="$5" style="width: 50px;"></td>
    <td> %5 </td>
    <td>$60.00</td>
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
 </tr>


</tbody>                 
</table>
</div>              
</div>
<div class="row bg-light summary">            
   <div class="col-lg-6 d-inline-flex bg-light ">  
      <div class="d-flex flex-row input-group flex-nowrap">                   
         <span class="input-group-text" id="addon-wrapping">Sub Total</span>
         <input type="text" class="form-control" placeholder="Sub Total" aria-label="Sub Total" aria-describedby="addon-wrapping"> 
         <span class="input-group-text" id="addon-wrapping">Discount</span>
         <input type="text" class="form-control" placeholder="Discount" aria-label="Discount" aria-describedby="addon-wrapping"> 
         <span class="input-group-text" id="addon-wrapping">Total</span>
         <input type="text" class="form-control" placeholder="Total" aria-label="Total" aria-describedby="addon-wrapping"> 
         <span class="input-group-text" id="addon-wrapping">Tax</span>
         <input type="text" class="form-control" placeholder="Tax" aria-label="Tax" aria-describedby="addon-wrapping"> 
      </div>               
   </div>
<div class="col-lg-2"></div>
   <div class="col-lg-4">  
  <span class="total">TOTAL</span>   
      <input type="text" value="$250.00" class="border-sucess float-end tinput pe-5" name="">               
   </div>
   <div class="col-12 bg-light">
      <input type="submit" class="btn btn-dark float-end ps-5 pe-5 m-2" name="print" value="Payment">
      <input type="submit" class="btn btn-success1 float-end ps-5 pe-5 m-2" data-bs-toggle="modal" data-bs-target="#exampleModal2" name="" value="Discount">
      <input type="submit" class="btn btn-warning float-end ps-5 pe-5 m-2" name="" value="Hold">
   </div>
</div>
<div class="row">
   <div class="col-lg-12 footer">                     
      <span>Copyrights &copy; 2022 TheSharePage, All Reights Reserved</span>                    
   </div>
</div>
</div>
</div>

<!-- Modal Sales Person -->
<div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Sales Person</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
     </div>
     <div class="modal-body">
        ...
     </div>
     <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
     </div>
  </div>
</div>
</div>
<!-- Modal Customer -->
<div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Customer Details</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
     </div>
     <div class="modal-body">
        ...
     </div>
     <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
     </div>
  </div>
</div>
</div>
<!-- Modal Customer -->
<div class="modal fade" id="discount" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Customer Details</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
     </div>
     <div class="modal-body">
        ...
     </div>
     <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
     </div>
  </div>
</div>
</div>
<!------------------------------------------ Scripts Files ------------------------------------------>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.12.1/datatables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js" integrity="sha512-ElRFoEQdI5Ht6kZvyzXhYG9NqjtkmlkfYk0wr6wHxU9JEHakS7UJZNeml5ALk+8IKlU6jDgMabC3vkumRokgJA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> 
<script type="text/javascript" src="js/custom-chart.js"></script>
<script>
function getvalue(selectObject) {
  var value = selectObject.value;  
  //alert(value);
  $.ajax({
url: 'readdata.php', 
type: 'post',
  dataType: "JSON",
data: {'id':value},

success:function(response){
	//alert(response.email);
	//alert(response.id);
	$("#phone1").val(response.phone);
	$("#email").val(response.email);
	$("#cus_id").val(response.id);
}
});
}


</script>


     
<script type="text/javascript">
   $(document).ready(function () {
    $('#example').DataTable();
    "columnDefs" [
    { "searchable": false, "targets": 0 }
    ]
 });
   
</script>
<script type="text/javascript">
   $(document).ready(function() {
    $('.js-example-basic-multiple').select2();
 });
</script>
</body>
</html>