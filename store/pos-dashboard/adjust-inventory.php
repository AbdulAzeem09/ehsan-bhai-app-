
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
    $active = 5;
    $_GET["categoryid"] = "1";
?>


<?php
   $userid=$_SESSION['uid'];


$c= new _orderSuccess;


$currency= $c->readcurrency($userid);
if($currency){ 
$res1= mysqli_fetch_assoc($currency);
$curr=$res1['currency'];
//echo $curr;
//di
}

?>

<?php 

if(isset($_POST['submit_now'])){

$quantity = $_POST['quantity'];
$productid = $_POST['productid'];
$qty = $_POST['qty'];


$sp = new _spprofiles;  
$res_1 = $sp->readp($productid);  

//print_r($res_1); die(); 
if($res_1){
	$row_1 = mysqli_fetch_assoc($res_1); 

	$retailQuantity = $row_1['retailQuantity'];

	$newretailQuantity = $retailQuantity + $qty;

	}


	


	$data1 = array(
	              "retailQuantity" => $newretailQuantity);      
	             
	
	
	
	$pf = new _spprofiles; 
					
	$res = $pf->update_mem_qty_product($data1,$productid);    


}


?>


<?php 

if(isset($_POST['submit'])){
	
	//print_r($_POST);  die(); 
	
	$uid= $_SESSION['uid'];
	$pid= $_SESSION['pid'];
	$supplier = $_POST['supplier'];
	$vendorID = $_POST['vendorID'];
	$Email = $_POST['Email'];  
	$phone = $_POST['phone'];
	$remarks = $_POST['remarks'];
	$invDate = $_POST['invDate'];
	$ref = $_POST['ref'];
	$barcode_in = $_POST['barcode_in'];
	$products = $_POST['products'];
	$weight = $_POST['weight'];
	$size = $_POST['size'];
	$color = $_POST['color'];  
	$sqty = $_POST['sqty'];
	$qty = $_POST['qty'];
	$t_cost = $_POST['t_cost'];
	$currency = $_POST['currency'];
	
	$data = array("uid" => $uid,
	              "pid" => $pid,
	              "supplier" => $supplier,
	              "vendorID" => $vendorID,
	              "Email" => $Email,
	              "phone" => $phone,
	              "remarks" => $remarks,
	              "invDate" => $invDate,
	              "ref" => $ref,
	              "barcode_in" => $barcode_in,
	              "products" => $products,
	              "weight" => $weight,
	              "size" => $size,
	              "color" => $color,
	              "sqty" => $sqty,
	              "qty" => $qty,
	              "t_cost" => $t_cost,    
	              "currency" => $currency,    
	
	);
	
	$pf = new _pos; 
					
	$res = $pf->create_return_inv($data);    
$_SESSION['msg'] = 1;  	
}


?>


<?php 

if(isset($_POST['update'])){ 
	
	//print_r($_POST);  die(); 
	
	$uid= $_SESSION['uid'];
	$pid= $_SESSION['pid'];
	$invt_id = $_POST['invt_id'];
	$supplier = $_POST['supplier'];
	$vendorID = $_POST['vendorID'];
	$Email = $_POST['Email'];  
	$phone = $_POST['phone'];
	$remarks = $_POST['remarks'];
	$invDate = $_POST['invDate'];
	$ref = $_POST['ref'];
	$barcode_in = $_POST['barcode_in'];
	$products = $_POST['products'];
	$weight = $_POST['weight'];
	$size = $_POST['size'];
	$color = $_POST['color'];  
	$sqty = $_POST['sqty'];
	$qty = $_POST['qty'];
	$t_cost = $_POST['t_cost'];
	$currency = $_POST['currency'];
	
	$data = array(
	              "supplier" => $supplier,
	              "vendorID" => $vendorID,
	              "Email" => $Email,
	              "phone" => $phone,
	              "remarks" => $remarks,
	              "invDate" => $invDate,
	              "ref" => $ref,
	              "barcode_in" => $barcode_in,
	              "products" => $products,
	              "weight" => $weight,
	              "size" => $size,
	              "color" => $color,
	              "sqty" => $sqty,
	              "qty" => $qty,
	              "t_cost" => $t_cost,    
	              
	
	);
	
	$pf = new _pos; 
					
	$res = $pf->update_return_inv($data,$invt_id);      
	$_SESSION['msg'] = 2;  
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
   <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
   <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
   <div class="container-fluid">
      <div class="row flex-nowrap">
	  
	  
         <?php include('left_side_landing.php');?>   
		 
		 
         <div class="col py-3">
          <div class="row align-self-stretch">
            <div class="d-flex justify-content-between border-bottom mb-3">
			
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
			
               <h4 class="float-start"> Adjust Inventory</h4>               
            </div>
			 <form method="post" action="">
            <!--<div class="col-12 mb-3"> 
               <div class="border-3 border-primary border-top p-1 bg-light shadowBox">
                  <div class="mb-1">
                     <div class="input-group d-flex mobile-view">                        
                        <div class="col-md-6 col-sm-12 pe-2">
                           <select class="form-control mb-3 form-select js-example-basic-multiple" id="inputGroupSelect02" name="supplier" required >
						    <option value="">Select Supplier name</option>
						    <?php
					$p = new _pos;
					
							$result_1 = $p->read_supplier($_SESSION['uid']);
							
					if ($result_1) {
						$i = 1;
						while ($row_1 = mysqli_fetch_assoc($result_1)) {
							
							?>
                           <option value="<?php echo $row_1['id']; ?>"><?php echo $row_1['customer_name']; ?></option>
                          
						   
					<?php }} ?>
					
                             <!-- <option value="1">Jhone</option>
                              <option value="2">Dave</option>
                              <option value="3">Yusha</option>-->
                         <!-- </select>   
                           <div class="d-flex">
						    <input type="hidden"  value="<?php echo $curr; ?>"  name="currency">
                              <input type="text" class="form-control mb-3 mt-3 me-2" name="vendorID" placeholder="Vendor ID" aria-label="vendorID" aria-describedby="addon-wrapping" required >                                                   
                              <input type="text" class="form-control mb-3 mt-3 me-2" name="Email" placeholder="Email" aria-label="Email" aria-describedby="addon-wrapping" required >                                                   
                              <input type="text" class="form-control mb-3 mt-3" name="phone" placeholder="Phone" aria-label="phone" aria-describedby="addon-wrapping" required >      
                           </div>                                             
                        </div>
                        <div class="col-md-6 col-sm-12">
                           <div class="d-flex">
                              <input type="text" class="form-control mb-3 me-2" name="remarks" placeholder="Remarks" aria-label="remarks" aria-describedby="addon-wrapping" required >

                              <input type="date" class="form-control mb-3 disabled" name="invDate"  placeholder="Invice Date" aria-label="invDate:" aria-describedby="addon-wrapping" required > 
                           </div>  
                           <input type="text" class="form-control mb-3" placeholder="Ref" name="ref" aria-label="ref" aria-describedby="addon-wrapping" required >                            
                        </div>                                                      
                     </div>
                  </div>
               </div>
            </div>-->
            <div class="col-lg-12">
               <div class="border-3 border-success border-top p-3 bg-orange shadowBox">
                  <div class="">
                  	<input type="hidden" id="quantity_" name="quantity" value= "" >
                  	<input type="hidden" id="product_id_" name="productid" value="">  
                    
                        <div class="d-flex justify-content-center input-group">
                           <div class="col-md-1 col-sm-12">
                            <input type="text" class="form-control" onkeyup="fun_barcode()" placeholder="Barcode" id="barcode_1" name="barcode_in" aria-label="Barcode" aria-describedby="addon-wrapping" required >
                           </div>
                           <!--<div class="col-md-3 col-sm-12">
						    <input type="text" class="form-control"  placeholder="Product" id="product_" name="products" aria-label="Product" aria-describedby="addon-wrapping" required >
                              <!--<select class="form-control me-2 form-select js-example-basic-multiple" id="select-product" name="products">
                                 <option value="1">Banna</option>
                                 <option value="2">Apple</option>
                                 <option value="3">Water Bottle</option>
                              </select>-->
                           <!--</div>-->
                           <div class="col-md-1 col-sm-12" id="add_color">
                             <!--<select class="form-control me-2 form-select js-example-basic-multiple" id="select-color" name="Color">
                              <option selected>Color</option>
                              <option value="2">Black</option>
                              <option value="3">Red</option>
                           </select>-->
						    <input type="text" class="form-control" placeholder="Color" readonly aria-label="Color" aria-describedby="addon-wrapping" id="color_">
                        </div>
                        <!--<div class="col-md-1 col-sm-12">
                           <select class="form-control me-2 form-select js-example-basic-multiple" id="select-weight" name="weight" required >
                              <option >Weight</option>
                              <option value="500g">500g</option>
                              <option value="1kg">1kg</option>
                              <option value="5kg">5kg</option>
                           </select>
                        </div>  -->   
                        <div class="col-md-1 col-sm-12" id="add_size"> 
                          <!-- <select class="form-control me-2 form-select js-example-basic-multiple" id="select-size" name="size">
                              <option selected>Size</option>
                              <option value="2">Small</option>
                              <option value="3">Medium</option>
                              <option value="3">Large</option>
                           </select>-->  
						   <input type="text" class="form-control" placeholder="Size" readonly aria-label="Size" aria-describedby="addon-wrapping" id="size_">
                        </div>                          
                        <div class="col-md-1 col-sm-12">
                           <input type="number" class="form-control me-2" name="sqty" readonly placeholder="Stock Qty" aria-label="sqty" aria-describedby="addon-wrapping" style="padding: 7px 0px 5px 5px;" >  
                        </div>                         
                        <div class="col-md-1 col-sm-12">
                           <input type="number" class="form-control me-2" placeholder="Qty" name="qty" aria-label="qty" aria-describedby="addon-wrapping" required >
                        </div>
                        <div class="col-md-1 col-sm-12">
                           <!--<input type="text" class="form-control me-2" placeholder="T Cost"  name="t_cost" aria-label="T Cost" aria-describedby="addon-wrapping" required >-->  
                        </div>
                        <div class="col-1 float-end">
                           <button type="submit" class="btn btn-success" name="submit_now" data-bs-toggle="modal" data-bs-target="#productdata"> Add</button>
                        </div>                            
                     </div>
                  
               </div>
            </div>
         </div>
		 </form>  
         <div class="col-lg-12 top-product">
            <div style="overflow-x:auto;"></div>
            <table id="example" class="table bg-light table-striped shadowBox">
               <thead>
                  <tr>
                     <th>Barcode</th>
                     <th>Product Name</th>
                     <th>Color</th>
                     <th>Weight</th>
                     <th>Size</th>
                     <th>Stock Qty</th>
                     <th>Qty</th>
                     <th>T Cost</th>                        
                     <th>Action</th>
                  </tr>
               </thead>
               <tbody>
			   
			   <?php 
			   $p = new _pos;
					
							$result = $p->read_return_inv($_SESSION['uid']);  
							
					if ($result) {
						$i = 1;
						while ($row = mysqli_fetch_assoc($result)) {
							//$total = ($row['qty']*$row['t_cost']); 
					
					
					 ?>
			   
                  <tr>
                     <td><?php echo $row['barcode_in']; ?></td>
                     <td><?php echo $row['products']; ?></td>
                     <td>
					 <?php if($row['color'] == ''){
						 echo 'N/A';
					 } else{ echo $row['color'];}
					 ?>
					 
					 </td>
                     <td><?php echo $row['weight']; ?></td>
                     <td>
					 
					 <?php
					 if($row['size'] == ''){
						 echo 'N/A';
					 } else{ echo $row['size'];}  
					 
					 ?>
					 
					 
					 
					 </td>
                     <td><?php echo $row['sqty']; ?></td>
                     <td><?php echo $row['qty']; ?></td>
                     <td><?php echo $row['currency']; ?>&nbsp;<?php echo $row['t_cost']; ?></td>                       
                     <td>
					 
					 <a onclick="edit_inventory('<?php echo $row['id']; ?>','<?php echo $row['supplier']; ?>','<?php echo $row['vendorID']; ?>','<?php echo $row['Email']; ?>','<?php echo $row['phone']; ?>','<?php echo $row['remarks']; ?>','<?php echo $row['invDate']; ?>','<?php echo $row['ref']; ?>','<?php echo $row['barcode_in']; ?>','<?php echo $row['products']; ?>','<?php echo $row['weight']; ?>','<?php echo $row['size']; ?>','<?php echo $row['color']; ?>','<?php echo $row['sqty']; ?>','<?php echo $row['qty']; ?>','<?php echo $row['t_cost']; ?>')" ><i class="fas fa-edit me-1"></i></a>  | 
					 
					<a onclick="delete_attributes('<?php echo $BaseUrl?>/store/pos-dashboard/delete_return_inv.php?id=<?php echo $row['id'];?>&action=delete')" class="text-danger"> <i class="fas fa-trash"></i></a>    

					 </td>
                  </tr>
				  <?php }}	 ?>
                 <!-- <tr>  
                     <td>|||||||||||</td>
                     <td>Apple</td>
                     <td>N/A</td>
                     <td>1kg</td>
                     <td>Small</td>
                     <td>12</td>
                     <td>2</td>
                     <td> $60 </td>     

                     <td><a href="#"><i class="fas fa-edit me-1"></i></a>| <a href="#" class="text-danger"> <i class="fas fa-trash"></i></a> </td>
                  </tr>-->
               </tbody>
            </table>
         </div>
      </div>
      <div class="row d-flex mobile-view summary">
         <div class="col-md-12 d-flex justify-content-between col-sm-12 bg-light shadowBox">          
            <div class="d-flex ">
               <span class="input-group-text mb-3 mt-2" id="addon-wrapping">Total</span>
               <input type="text" class="disabled mb-3 mt-2" readonly aria-label="Total" aria-describedby="addon-wrapping">

            </div>
            <div class="d-flex" style="padding: 1px 2px; margin-bottom: 6px;">             
              <input type="button" class="btn btn-secondary ps-2 pe-2 m-2" data-bs-toggle="modal" data-bs-target="#helpModal"  value="Help">
              <input type="submit" class="btn btn-primary ps-5 pe-5 m-2" name="" value="Hold">
              <input type="button" class="btn btn-success ps-5 pe-5 m-2" data-bs-toggle="modal" data-bs-target="#paymentterm" name="print" value="Post">
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
<!-------------------------------- All Modals ----------------------------------->
<!-- Modal Payment -->

<div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Update Inventory</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
     </div>
     <div class="modal-body">
        <form action="" method="post">
		<input type="hidden"  id="id_invent" value="" name="invt_id"> 
		
     <div class="row">
	 <div class="col-md-4"><label>Supplier</label>
	 <select class="form-control mb-3 form-select "  name="supplier" id="supplier_in_">
	 
	  <option value="">Select Supplier name</option>
						    <?php
					$p = new _pos;
					
							$result_1 = $p->read_supplier($_SESSION['uid']);
							
					if ($result_1) {
						$i = 1;
						while ($row_1 = mysqli_fetch_assoc($result_1)) {
							
							?>
                           <option value="<?php echo $row_1['id']; ?>"><?php echo $row_1['customer_name']; ?></option>
                          
						   
					<?php }} ?>
                             <!-- <option value="1">Jhone</option>
                              <option value="2">Dave</option>
                              <option value="3">Yusha</option>--> 
                           </select>
       </div> 
	 <div class="col-md-4"> <label>Vendor ID</label>
	 <input type="text" class="form-control mb-3  me-2" name="vendorID"  id="vender_id_in_" placeholder="Vendor ID" aria-label="vendorID" aria-describedby="addon-wrapping"> 
        </div>
		
		 <div class="col-md-4"> <label>Remarks</label>
	 <input type="text" class="form-control mb-3 me-2" name="remarks" id="remarks_" placeholder="Remarks" aria-label="remarks" aria-describedby="addon-wrapping">
        </div>
	 </div>
	 
	  <div class="row">
	 <div class="col-md-6"><label>Email</label>
	  <input type="text" class="form-control mb-3  me-2" name="Email" id="email_in_" placeholder="Email" aria-label="Email" aria-describedby="addon-wrapping">  
       </div>
	 <div class="col-md-6"> <label>Phone</label>
	 <input type="number" class="form-control mb-3 " name="phone" id="phone_in_" placeholder="Phone" aria-label="phone" aria-describedby="addon-wrapping">  
        </div>
	 </div>
	 
	 
	  <div class="row">
	 <div class="col-md-6"><label>Invice Date</label>
	  <input type="date" class="form-control mb-3" name="invDate"  id="invDate_in_" placeholder="Invice Date" aria-label="invDate:" aria-describedby="addon-wrapping"> 
       </div>
	 <div class="col-md-6"> <label>Ref</label>
	  <input type="text" class="form-control mb-3" name="ref" id="ref_in_" placeholder="Ref" aria-label="ref" aria-describedby="addon-wrapping"> 
        </div>
	 </div>
	 
	  <div class="row">
	 <div class="col-md-6"><label>Barcode</label>
	<input type="text" class="form-control" onkeyup="fun_barcode_1()" placeholder="Barcode" id="barcode_2" name="barcode_in" aria-label="Barcode" aria-describedby="addon-wrapping">
       </div>
	 <div class="col-md-6"> <label>Product</label>
	  <!-- <select class="form-control me-2 mb-3 form-select " id="select_product_" name="products_in">
                                 <option value="1">Banna</option>
                                 <option value="2">Apple</option>
                                 <option value="3">Water Bottle</option>  
                              </select>-->

<input type="text" class="form-control"  placeholder="Product" id="product_1" name="products" aria-label="Product" aria-describedby="addon-wrapping">							  
        </div>
	 </div>
	 
	  <div class="row">
	 <div class="col-md-6"><label>Color</label>
	  <!--<select class="form-control me-2 mb-3 form-select " id="select_color_" name="Color_in">
                                 <option selected>Color</option>
                                 <option value="1">Black</option>
                                 <option value="2">Red</option>
                              </select>-->
	<input type="text" class="form-control" placeholder="Color" name="color"  aria-label="Color" aria-describedby="addon-wrapping" id="color_1">
       </div>
	 <div class="col-md-6"> <label>Size</label>
	<!-- <select class="form-control me-2 form-select mb-3 " id="select_size_" name="size_in">
                                 <option selected>Size</option>
                                 <option value="1">Small</option>
                                 <option value="2">Medium</option>
                                 <option value="3">Large</option>
                              </select>-->
							  
		<input type="text" class="form-control" placeholder="Size" name="size"  aria-label="Size" aria-describedby="addon-wrapping" id="size_1">  			  
        </div>
	 </div>
	 
	  <div class="row">
	 <div class="col-md-6"><label>Qty</label>
	  <input type="number" class="form-control me-2" id="qty_1" placeholder="Qty" name="qty" aria-label="qty" aria-describedby="addon-wrapping">
       </div>
	 <div class="col-md-6"> <label>Stock Qty</label>
	 <input type="number" class="form-control me-2" id="sqty_1" name="sqty" placeholder="Stock Qty" aria-label="sqty" aria-describedby="addon-wrapping">
        </div>
	 </div>
	 
	  <div class="row">
	 <div class="col-md-6"><label>Total Cost</label>
	  <input type="text" class="form-control me-2" placeholder="T Cost"  id="t_cost_1" name="t_cost" aria-label="T Cost" aria-describedby="addon-wrapping">
       </div>
	 <div class="col-md-6"> <label>Weight</label>
	  <select class="form-control me-2 form-select " id="select_weight_" name="weight">
                              <option >Weight</option>
                              <option value="500g">500g</option>
                              <option value="1kg">1kg</option>
                              <option value="5kg">5kg</option>
                           </select>
        </div>
	 </div>
	 
	 
	 
	
         
        
         

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" name="update" class="btn btn-primary">Update</button>
     </form>
  </div>
</div>
</div>
</div>


<div class="modal fade" id="paymentterm" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-lg">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">General Ledger</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
         </div>
         <div class="modal-body">
            <div class="row">
             <div class="col-md-6 col-sm-12">
               <label>Select Account</label>
               <select class="form-control me-2 form-select" id="select-acount" name="acounts">
                  <option value="1">Select Accnount</option>
                  <option value="2">Inventory</option>
                  <option value="3">Pettry Cash</option>
               </select>
            </div> 
            <div class="col-md-3 col-sm-12">
               <label class=""> Credit</label>
               <input type="text" class="form-control mb-3 me-2" placeholder="Credit" aria-label="credit" aria-describedby="addon-wrapping">
            </div>     
            <div class="col-md-3 col-sm-12">
               <label class=""> Debit</label>
               <input type="text" class="form-control mb-3 me-2" placeholder="Debit" aria-label="debit" aria-describedby="addon-wrapping">
            </div>         
         </div>
      </div>
      <div class="modal-footer">

         <div class="d-flex me-1">
            <label class="mt-2 me-2">Total</label>
            <input type="text" class="form-control disabled" name="" value="">
         </div>

         <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
         <button type="button" class="btn btn-success">OK</button>
      </div>
   </div>
</div>
</div>     
<!-- Modal Help -->
<div class="modal fade" id="helpModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-lg">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="helpM">Help Option</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
         </div>
         <div class="modal-body">
            <div class="row">
               <div class="col-6">
                  <div class="d-flex flex-wrap" role="group" aria-label="First group">
                     <button type="button" class="btn btn-outline-secondary me-2 mb-2">Item List</button>
                     <button type="button" class="btn btn-outline-secondary me-2 mb-2">Item Stock History</button>
                     <button type="button" class="btn btn-outline-secondary me-2 mb-2">Item Sales History</button>
                     <button type="button" class="btn btn-outline-secondary me-2 mb-2">Customer List </button>
                     <button type="button" class="btn btn-outline-secondary me-2 mb-2">Customer Sales Hisoty </button>
                     <button type="button" class="btn btn-outline-secondary me-2 mb-2">Customer Transation History</button>
                     <button type="button" class="btn btn-outline-secondary me-2 mb-2">Item Search By Serial#</button>
                     <button type="button" class="btn btn-outline-secondary me-2 mb-2">Item Search By Tack#</button>
                     <button type="button" class="btn btn-outline-secondary me-2 mb-2">Gift Card History</button>
                     <button type="button" class="btn btn-outline-secondary me-2 mb-2">Debit Card</button>
                  </div>
               </div>
               <div class="col-6">
                  <img src="img/help.jpg" class="img-fluid">
               </div>
            </div>
         </div>
         <div class="modal-footer">                  
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
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

<script type="text/javascript" src="js/custom-chart.js"></script>     
<script type="text/javascript">
   $(document).ready(function () {
    $('#example').DataTable();
    "columnDefs": [
    { "searchable": false, "targets": 0 }
    ]
 });

</script>
 <script src="<?php echo $baseurl?>/assets/js/sweetalert.js"></script>
<script type="text/javascript">
   $(document).ready(function() {
     $('.js-example-basic-multiple').select2();
  });
  
  
  
   function fun_barcode(){
			  
			   var barcode_id = $('#barcode_1').val();
			
			 var tbl = "spproduct";   
			
			 $.ajax({
url: 'read_data_id.php',     
type: 'post',
data: {'barcode_id':barcode_id,tbl:tbl},    
 dataType: "JSON",

success: function(response){
	//alert(response.price);
	//console.log(response); 

	//alert(response.retailQuantity);     
	$('#price_').val(response.price);
	$('#membership_id').val(response.category); 
	$('#product_id_').val(response.proid);     
	$('#title_pro').val(response.title);
	$('#product_').val(response.title); 
	$('#add_size').html(response.size); 
	$('#add_color').html(response.color); 
	$('#quantity_').html(response.retailQuantity);     
	
	
	
	
	
}

});
		 }
		 
		  function delete_attributes(url){
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
   
   function edit_inventory(a,b,c,d,e,f,g,h,i,j,k,l,m,n,o,p){
       //alert(c);  

       $("#exampleModal2").modal('show');    
       $("#id_invent").val(a);
       $("#supplier_in_").val(b);
       $("#vender_id_in_").val(c);
       $("#email_in_").val(d);
       $("#phone_in_").val(e);
       $("#remarks_").val(f);
       $("#invDate_in_").val(g);
       $("#ref_in_").val(h);
       $("#barcode_2").val(i);
       $("#product_1").val(j);
	  if(m==''){
		 $("#color_1").val('N/A'); 
	  }else{
		  $("#color_1").val(m);
	  }
       
	  // alert(m);
       $("#select_weight_").val(k);
       $("#size_1").val(l);
       $("#qty_1").val(n);
       $("#sqty_1").val(o);
       $("#t_cost_1").val(p);
       
       
       
    } 
  
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