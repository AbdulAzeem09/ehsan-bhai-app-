
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


<?php 

if(isset($_POST['submit'])){
	
	//print_r($_POST);  die();
	
	$uid= $_SESSION['uid'];
	$pid= $_SESSION['pid'];
	$barcode_in = $_POST['barcode_in'];
	$products = $_POST['products'];
	$current_location = $_POST['current_location'];  
	$Location = $_POST['Location'];
	$qty = $_POST['qty'];
	$unit_price_in = $_POST['unit_price_in'];
	
	$data = array("uid" => $uid,
	              "pid" => $pid,
	              "barcode_in" => $barcode_in,
	              "products" => $products,
	              "Location" => $Location,
	              "qty" => $qty,
	              "current_location" => $current_location,
	              "unit_price_in" => $unit_price_in,
	
	);
	
	$pf = new _pos; 
					
	$res = $pf->create_unpost_inv($data);    
	$_SESSION['msg'] = 1;
}


?>


<?php 

if(isset($_POST['update'])){
	
	//print_r($_POST);  die();
	
	$uid= $_SESSION['uid'];
	$pid= $_SESSION['pid'];
	$id = $_POST['id'];
	$barcode_in = $_POST['barcode_in'];
	$products = $_POST['products'];
	$current_location = $_POST['current_location'];  
	$Location = $_POST['Location'];
	$qty = $_POST['qty'];
	$unit_price_in = $_POST['unit_price_in'];
	
	$data = array(
	             "barcode_in" => $barcode_in,
	              "products" => $products,
	              "Location" => $Location,
	              "qty" => $qty,
	              "current_location" => $current_location,
	              "unit_price_in" => $unit_price_in,
	
	); 
	
	$pf = new _pos;
					
	$res = $pf->update_unpost_inv($data,$id);      
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
       
		 
		  <input type="hidden" id="rand_val" value="1">
		 
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
			   
			
               <h4 class="float-start">Unposted Inventory</h4>               
            </div>
            <div class="col-lg-12">
               <div class="border-3 border-success border-top p-3 bg-light shadowBox">
                  <div class="mb-3">
                     <form method="post" action="">
                        <div class="d-flex justify-content-center input-group">
                           <div class="col-1 me-1">
                              <input type="text" class="form-control" onkeyup="fun_barcode()" placeholder="Barcode" id="barcode_1" name="barcode_in" aria-label="Barcode" aria-describedby="addon-wrapping" required >
                           </div>
                           <div class="col-3 d-flex me-1">
                             <!-- <select class="form-control form-select js-example-basic-multiple" id="select-product" name="products">
                                 <option value="Banna">Banna</option>
                                 <option value="Apple">Apple</option>
                                 <option value="Water Bottle">Water Bottle</option>
                              </select> -->
							  <input type="text" class="form-control"  placeholder="Product" id="product_" name="products" aria-label="Product" aria-describedby="addon-wrapping" required >
                           </div>
                           <div class="col-1 me-1">
                             <input type="text" class="form-control"  name="current_location" id="current_location_1" placeholder="Current Location" aria-label="location" aria-describedby="addon-wrapping" required >        
                           </div>
                           <div class="col-2 me-1">
						    <!--<input type="text" class="form-control"  name="Location" id="Location_1" placeholder="Location" aria-label="location" aria-describedby="addon-wrapping">-->   
                            <select class="form-control form-select js-example-basic-multiple" id="select-Location" name="Location" required >
                                 <option value="">Select Country </option>
                                <!-- <option value="CA">CA</option>
                                 <option value="US">US</option>
                                 <option value="UAE">UAE</option>-->  
								 
								  <?php
																			
																			
																				
																						
																													
									$co = new _country;
								$result3 = $co->readCountry();
										if($result3 != false){
							while ($row3 = mysqli_fetch_assoc($result3)) {
																				
																 $usercountry = $row3['country_id'];
																			?>

                                        <option value='<?php echo $row3['country_id'];?>' <?php echo (isset($_SESSION['spPostCountry']) && $_SESSION['spPostCountry'] == $row3['country_id'])?'selected':''; ?>><?php echo $row3['country_title'];?></option>
                                        <?php
																			}
																			}
																			?>
                              </select>
                           </div>
                           <div class="col-2 me-1 d-flex">
                              <input type="text" class="form-control me-1" placeholder="Qty" id="qty_1" name="qty" aria-label="qty_in" aria-describedby="addon-wrapping">                                                              
                           </div>
                           <div class="col-1 me-1"> 
                              <input type="text" class="form-control" name="unit_price_in" placeholder="Unit Price" aria-label="Unit Price" aria-describedby="addon-wrapping">
                           </div>
                           <div class="col-1 me-1">
                              <input type="submit" class="btn btn-success"  name="submit" value="Add">
                           </div>
                        </div>
						
						
                    </form>
                  </div>
               </div>
            </div>
            <div class="col-lg-12 top-product">
               <table id="example" class="table bg-light table-striped shadowBox">
                  <thead>
                     <tr>
                        <th>Barcode</th>
                        <th>Product Name</th>
                        <th>Current Location</th>
                        <!--<th>New Location</th>-->
                       <th>Quantity</th>
                       <th>Unit Price</th>
                        <th>T Price</th>
                        <th>Action</th>
                     </tr>
                  </thead>
                  <tbody id="append_tr"> 
				  
				  <?php 
			   $p = new _pos;
					
							$result = $p->read_unpost_inv($_SESSION['uid']);  
							
					if ($result) {
						$i = 1;
						while ($row = mysqli_fetch_assoc($result)) {
							$total = ($row['qty']*$row['unit_price_in']);
					
							
					 ?>
                     <tr>
                        <td><?php echo $row['barcode_in']; ?></td>
                        <td><?php echo $row['products']; ?></td>
                        <td><?php echo $row['current_location']; ?></td>
                       <!-- <td><?php echo $row['Location']; ?></td>-->
                        <td><?php echo $row['qty']; ?></td>
                        <td>$<?php echo $row['unit_price_in']; ?></td>
                        <td>$<?php echo $total; ?>.00</td>
                        <td>
						<!--<a href="#"><i class="fas fa-edit me-1"></i></a>| <a href="#" class="text-danger"> <i class="fas fa-trash"></i></a>-->
                      <a  onclick="edit_attributes('<?php echo $row['id']; ?>','<?php echo $row['barcode_in']; ?>','<?php echo $row['products']; ?>','<?php echo $row['current_location']; ?>','<?php echo $row['Location']; ?>','<?php echo $row['qty']; ?>','<?php echo $row['unit_price_in']; ?>')"><i class="fas fa-edit me-1"></i></a>| 
					  
					  <a onclick="delete_attributes('<?php echo $BaseUrl?>/store/pos-dashboard/delete_unpost_inv.php?id=<?php echo $row['id'];?>&action=delete')" class="text-danger"> <i class="fas fa-trash"></i></a>      
						</td>
                     </tr> 
                   <?php }} ?>	     				 
                  </tbody>
               </table>
            </div>
         </div>
         <div class="row summary" style="right:0;">           
            <div class="col-12 bg-light shadowBox">                 
               <input type="button" class="btn btn-main float-end ps-5 pe-5 m-2" name="update" value="Transfer">
               <input type="submit" class="btn btn-primary float-end ps-5 pe-5 m-2" name="" value="Hold">
               <input type="button" class="btn btn-secondary float-end ps-2 pe-2 m-2" data-bs-toggle="modal" data-bs-target="#helpModal"  value="Help">
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
 
 
 
 
      <!-- Modal Customer Details -->
      <div class="modal fade" id="addcustomer" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                              <input type="text" class="form-control shadowBox" id="customerno" placeholder="Customer#" value="" required>
                           </div>
                           <div class="mb-3">
                              <input type="text" class="form-control shadowBox" id="customername" placeholder="Customer Name" value="" required>
                           </div>
                           <div class="mb-3">
                              <input type="text" class="form-control shadowBox" id="customerphone" placeholder="Customer Phone" value="" required>
                           </div>
                           <div class="mb-3">
                              <input type="text" class="form-control shadowBox" id="customeremail" placeholder="Customer Email" value="" required>
                           </div>
                          <div class="mb-3">
                              <select class="form-control form-select shadowBox" id="customertype" name="customertype">
                                 <option value="1">Type 1</option>
                                 <option value="2">Type 2</option>
                                 <option value="3">Type 3</option>
                              </select>
                           </div>
                        </div>
                        <div class="col-4">
                           <div class="profile-img mb-4">
                              <img src="img/profile.jpg" class="img-sm img-fluid img-thumbnail float-end mb-2">
                              <input type="file" class="form-control shadowBox" name="profile-img">
                           </div>
                           
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-12">
                           <div class="tab-container-one">
                              <ul class="nav nav-tabs mb-5" id="myTab" role="tablist">
                                 <li class="nav-item active">
                                    <a class="nav-link active" href="#mailing" role="tab" aria-controls="mailing" data-bs-toggle="tab">Mailing / Preference</a>
                                 </li>
                                 <li class="nav-item">
                                    <a class="nav-link" href="#pt" role="tab" aria-controls="pt" data-bs-toggle="tab">Prices / Tax</a>
                                 </li>
                                 <li class="nav-item">
                                    <a class="nav-link" href="#cpt" role="tab" aria-controls="cpt" data-bs-toggle="tab">Credit & Payment Terms</a>
                                 </li>
                                 <li class="nav-item">
                                    <a class="nav-link" href="#note" role="tab" aria-controls="note" data-bs-toggle="tab">Note</a>
                                 </li>
                              </ul>
                              <div class="tab-content">
                                 <div class="tab-pane active mb-4" id="mailing" role="tabpanel" aria-labelledby="mailing-tab">
                                    <div class="row">
                                       <div class="col-12 mb-4">                              
                                          <input type="text" class="form-control" id="address" placeholder="Address" required>
                                       </div>
                                       <div class="col-4 mb-4">
                                          <input type="text" class="form-control" id="city" placeholder="City" required>
                                       </div>
                                       <div class="col-4 mb-4">
                                          <input type="text" class="form-control" id="zip" placeholder="ZIP" required>
                                       </div>
                                       <div class="col-4 mb-4">
                                          <input type="text" class="form-control" id="country" placeholder="Country" required>
                                       </div>
                                       <div class="form-group">
                                          <div class="form-check">
                                             <input class="form-check-input" type="checkbox" value="" id="invalidCheck2" required>
                                             <label class="form-check-label" for="invalidCheck2">Receive Email & Newsletter</label>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="tab-pane" id="pt" role="tabpanel" aria-labelledby="pt-tab">
                                    <div class="row">
                                       <div class="col-4 mb-4">
                                          <input type="text" class="form-control" id="saleprice" placeholder="Sale Price" required>
                                       </div>
                                       <div class="col-4 mb-4">
                                          <input type="text" class="form-control" id="tax" placeholder="TAX" required>
                                       </div>
                                       <div class="col-4 mb-4">
                                          <input type="text" class="form-control" id="discount" placeholder="Discount" required>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="tab-pane" id="cpt" role="tabpanel" aria-labelledby="cpt-tab">
                                    <div class="row">
                                       <div class="col-6">
                                          <div class="d-flex me-1">
                                             <select class="form-control form-select" id="select-payment" name="paymentterm">
                                                <option value="1">Cash</option>
                                                <option value="2">Credit Card</option>
                                                <option value="3">Bank Account</option>
                                             </select>
                                          </div>
                                       </div>
                                       <div class="col-6">
                                          <div class="d-flex me-1">
                                             <select class="form-control form-select" id="select-credit" name="creditterm">
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
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  <button type="button" class="btn btn-primary">Save changes</button>
               </div>
               </form>
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
                              <input type="text" class="form-control shadowBox" id="customerno" placeholder="Customer#" value="" required>
                           </div>
                           <div class="mb-3">
                              <input type="text" class="form-control shadowBox" id="customername" placeholder="Customer Name" value="" required>
                           </div>
                           <div class="mb-3">
                              <input type="text" class="form-control shadowBox" id="customerphone" placeholder="Customer Phone" value="" required>
                           </div>
                           <div class="mb-3">
                              <input type="text" class="form-control shadowBox" id="customeremail" placeholder="Customer Email" value="" required>
                           </div>                           
                           <div class="mb-3">
                              <select class="form-control form-select shadowBox" id="customertype" name="customertype">
                                 <option value="1">Type 1</option>
                                 <option value="2">Type 2</option>
                                 <option value="3">Type 3</option>
                              </select>
                           </div>
                        </div>
                        <div class="col-4">
                           <div class="profile-img mb-4">
                              <img src="img/profile.jpg" class="img-sm img-fluid img-thumbnail float-end mb-2">
                              <input type="file" class="form-control shadowBox" name="profile-img">
                           </div>
                           
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-12">
                           <div class="tab-container-one">
                              <ul class="nav nav-tabs mb-5" id="myTab" role="tablist">
                                 <li class="nav-item active">
                                    <a class="nav-link active" href="#mailing" role="tab" aria-controls="mailing" data-bs-toggle="tab">Mailing / Preference</a>
                                 </li>
                                 <li class="nav-item">
                                    <a class="nav-link" href="#pt" role="tab" aria-controls="pt" data-bs-toggle="tab">Prices / Tax</a>
                                 </li>
                                 <li class="nav-item">
                                    <a class="nav-link" href="#cpt" role="tab" aria-controls="cpt" data-bs-toggle="tab">Credit & Payment Terms</a>
                                 </li>
                                 <li class="nav-item">
                                    <a class="nav-link" href="#note" role="tab" aria-controls="note" data-bs-toggle="tab">Note</a>
                                 </li>
                              </ul>
                              <div class="tab-content">
                                 <div class="tab-pane active mb-4" id="mailing" role="tabpanel" aria-labelledby="mailing-tab">
                                    <div class="row">
                                       <div class="col-12 mb-4">                              
                                          <input type="text" class="form-control" id="address" placeholder="Address" required>
                                       </div>
                                       <div class="col-4 mb-4">
                                          <input type="text" class="form-control" id="city" placeholder="City" required>
                                       </div>
                                       <div class="col-4 mb-4">
                                          <input type="text" class="form-control" id="zip" placeholder="ZIP" required>
                                       </div>
                                       <div class="col-4 mb-4">
                                          <input type="text" class="form-control" id="country" placeholder="Country" required>
                                       </div>
                                       <div class="form-group">
                                          <div class="form-check">
                                             <input class="form-check-input" type="checkbox" value="" id="invalidCheck2" required>
                                             <label class="form-check-label" for="invalidCheck2">Receive Email & Newsletter</label>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="tab-pane" id="pt" role="tabpanel" aria-labelledby="pt-tab">
                                    <div class="row">
                                       <div class="col-4 mb-4">
                                          <input type="text" class="form-control" id="saleprice" placeholder="Sale Price" required>
                                       </div>
                                       <div class="col-4 mb-4">
                                          <input type="text" class="form-control" id="tax" placeholder="TAX" required>
                                       </div>
                                       <div class="col-4 mb-4">
                                          <input type="text" class="form-control" id="discount" placeholder="Discount" required>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="tab-pane" id="cpt" role="tabpanel" aria-labelledby="cpt-tab">
                                    <div class="row">
                                       <div class="col-6">
                                          <div class="d-flex me-1">
                                             <select class="form-control form-select" id="select-payment" name="paymentterm">
                                                <option value="1">Cash</option>
                                                <option value="2">Credit Card</option>
                                                <option value="3">Bank Account</option>
                                             </select>
                                          </div>
                                       </div>
                                       <div class="col-6">
                                          <div class="d-flex me-1">
                                             <select class="form-control form-select" id="select-credit" name="creditterm">
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
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  <button type="button" class="btn btn-primary">Update</button>
               </div>
               </form>
            </div>
         </div>
      </div>
      <!-- Modal Product Details -->
      <div class="modal fade" id="productdata" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                           <input type="text" class="form-control shadowBox" id="barcode" placeholder="Barcode" value="" required>
                        </div>
                        <div class="col-12 mb-3">
                           <input type="text" class="form-control shadowBox" id="productname" placeholder="product Name" value="" required>
                        </div>
                        <div class="col-4 mb-3">
                           <input type="text" class="form-control shadowBox" id="purchaseprice" placeholder="Purchase Price" value="" required>
                        </div>
                        <div class="col-4 mb-3">
                           <input type="text" class="form-control shadowBox" id="cost" placeholder="Cost" value="" required>
                        </div>
                        <div class="col-4 mb-3">
                           <input type="text" class="form-control shadowBox" id="saleprice" placeholder="Sale Price" value="" required>
                        </div>
                        <div class="col-4 mb-3">
                           <input type="text" class="form-control shadowBox" id="color" placeholder="Color" value="" required>
                        </div>
                        <div class="col-4 mb-3">
                           <input type="text" class="form-control shadowBox" id="size" placeholder="Size" value="" required>
                        </div>
                        <div class="col-4 mb-3">
                           <input type="text" class="form-control shadowBox" id="tax" placeholder="TAX" value="" required>
                        </div>
                        <div class="col-6 mb-3">
                           <select class="form-control form-select shadowBox" id="product-cat" name="product-cat">
                              <option value="uncategories" selected>Select Category</option>
                              <option value="Fruits">Fruits</option>
                              <option value="Vegetables">Vegetables</option>
                              <option value="General">General</option>
                           </select>
                        </div>                        
                        <div class="col-6 mb-3">
                            <select class="form-control form-select shadowBox" id="product-sub-cat" name="product-sub-cat">
                              <option value="uncategories" selected>Select Sub Category</option>
                              <option value="dryFruits">Dray Fruits</option>
                              <option value="Fresh Fruit">Fresh Fruits</option>
                              <option value="Import Fruits Item">Import Fruit Items</option>
                           </select>
                        </div>
                        <div class="col-12 mb-3">
                           <textarea class="form-control shadowBox" id="description" rows="3"></textarea>
                        </div>
                        <div class="col-12 mb-3">                           
                           <input type="file" class="form-control shadowBox" name="productimage">
                        </div>
                     </div>
                  </div>
               <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  <button type="button" class="btn btn-success">Save changes</button>
               </div>
               </form>
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
	  
	  
	  <div class="modal fade" id="editAttribute" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-lg">
   <form action ="" method="post">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="helpM">Edit Transfer Inventory</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
         </div>
         <div class="modal-body">
           <!-- <div class="row d-flex">
               <div class="col-auto mobile-view mb-3">
			   <input type="hidden" name="id" id="post_id">
                 <!-- <input type="text" class="form-control mb-3 me-2" placeholder="Attribute Name" aria-label="attributeName" aria-describedby="addon-wrapping"> 
                    <select class="form-control form-select shadowBox mb-3 me-2" id="attributeName_id" name="attributeName_in">
                                 <option value="uncategories" selected>Select attributes</option>
                                 <option value="1">Color</option>
                                 <option value="2">Size</option>
                                 
                              </select>						  
               </div>
               <div class="col-auto mobile-view mb-3">
                 <input type="text" class="form-control mb-3 me-2" id="attributeValue_id" name="attributeValue_in" placeholder="Attribute Value" aria-label="attributeValue" aria-describedby="addon-wrapping">                         
              </div>         
              <div class="col-auto mobile-view mb-3">

              </div>                     
           </div>-->
		   
		   <div class="row">
		   <input type="hidden" name="id" id="post_id">
                           <div class="col-md-2 me-1">
                              <input type="text" class="form-control" placeholder="Barcode" id="barcode_in_"name="barcode_in" aria-label="Barcode" aria-describedby="addon-wrapping">
                           </div>
                           <div class="col-md-3  mb-2 me-1">
						     <input type="text" class="form-control"  placeholder="Product" id="product_up" name="products" aria-label="Product" aria-describedby="addon-wrapping">
                             <!-- <select class="form-control form-select " id="select_product_" name="products">
                                 <option value="Banna">Banna</option>
                                 <option value="Apple">Apple</option>
                                 <option value="Water Bottle">Water Bottle</option>
                              </select> -->
                           </div>
                           <div class="col-md-2 me-1">
                             <input type="text" class="form-control"  name="current_location" id="current_location_" placeholder="Current Location" aria-label="location" aria-describedby="addon-wrapping">        
                           </div>
                           <div class="col-md-3 ">
                             <select class="form-control  form-select  " id="select_Location_" name="Location">
                                 <option >Select Country</option>
                                 <!--<option value="CA">CA</option>
                                 <option value="US">US</option>
                                 <option value="UAE">UAE</option>-->
								 
								 <?php
																												
									$co = new _country;
								$result3 = $co->readCountry();
										if($result3 != false){
							while ($row3 = mysqli_fetch_assoc($result3)) {
																				
																 $usercountry = $row['country'];
																			?>

                                        <option value='<?php echo $row3['country_id'];?>' <?php echo ( $row['country'] == $row3['country_id'])?'selected':''; ?>><?php echo $row3['country_title'];?></option>
                                        <?php
																			}
																			}
																			?>
								 
								 
                              </select>
                           </div>
                           <div class="col-md-2 me-1 ">
                              <input type="text" class="form-control me-1" placeholder="Qty" id="qty_" name="qty" aria-label="qty_in" aria-describedby="addon-wrapping">                                                              
                           </div>
                           <div class="col-md-2 me-1"> 
                              <input type="text" class="form-control" name="unit_price_in" id="unit_price_in_" placeholder="Unit Price" aria-label="Unit Price" aria-describedby="addon-wrapping">
                           </div>
                          
                        </div>
		   
		   
        </div>
        <div class="modal-footer">  
         <button type="button" class="btn btn-secondary mb-3" data-bs-dismiss="modal">Close</button>
         <button type="submit" name="update" class="btn btn-main mb-3 me-2"><i class="fas fa-save"></i> Update</button>                

      </div>
   </div>
   </form> 
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
		   $('.js-example-basic-multiple_1').select2();
		  
		   $('#add_submit').click(function(){
			   
			    var barcode_id = $('#barcode_1').val();
			    var product = $('#product_').val();
			    var current_location = $('#current_location_1').val();
			    var Location = $('#Location_1').val();
			    var qty = $('#qty_1').val();
				
				var rand_val = $('#rand_val').val();
				
			var record_add = '<tr id = "id'+rand_val+'" ><td>'+barcode_id+'</td><td>'+product+'</td><td>'+current_location+'</td><td>'+Location+'</td><td>'+qty+'</td><td><a href="#"><i class="fas fa-edit me-1"></i></a>| <a  onclick="fun_record('+rand_val+')" href="#" class="text-danger"> <i class="fas fa-trash"></i></a></td></tr>';
				
				$('#append_tr').append(record_add);
				
				var iNum = parseInt(rand_val);
				 var  rand_val_1 = iNum+1;
		   $('#rand_val').val(rand_val_1);

            $('#barcode_1').val(''); 
 			 $('#product_').val(''); 
			 $('#current_location_1').val('');
             $('#Location_1').val('');
             $('#qty_1').val(''); 
			
			 
		   });
		  
         });
		 
		 
	  function edit_attributes(a,b,c,d,e,f,g){
       // alert(a);  

       $("#editAttribute").modal('show');  
	    $("#post_id").val(a);
       $("#barcode_in_").val(b);
       $("#product_up").val(c);  
       $("#current_location_").val(d);
       $("#select_Location_").val(e);
       $("#qty_").val(f);
       $("#unit_price_in_").val(g); 
      
      
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
   
   
    function fun_barcode(){
			  
			   var barcode_id = $('#barcode_1').val();
			
			 var tbl = "product";
			
			 $.ajax({
url: 'read_data_inventory.php',  
type: 'post',
data: {'barcode_id':barcode_id,tbl:tbl},   
 dataType: "JSON",

success: function(response){
	//alert(response.price);
	//console.log(response); 
	$('#product_').val(response.products);
	/*$('#current_location_1').val(response.current_location); 
	$('#qty_1').val(response.qty); 
	$('#Location_1').val(response.Location); */ 
	
	
	
	
	
}

});
		 }
		 
		 function fun_record(id){
			 
			 $('#id'+id).hide(); 
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