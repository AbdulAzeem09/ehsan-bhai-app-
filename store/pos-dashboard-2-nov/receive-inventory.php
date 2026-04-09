
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
  Successfully Added.
</div>	   
			   
			   <?php } ?>
			   
			   <?php if($_SESSION['msg']=="2"){ unset($_SESSION['msg']); ?>
		<div class="alert alert-success" id="p_success" role="alert">
     Successfully updated .
</div>	   
			   
			   <?php } ?> 
			
               <h4 class="float-start"> Receive Inventory</h4>               
            </div>
			 <form method="post" action="add_detail_inventory.php">
            <div class="col-12 mb-3">
               <div class="border-3 border-primary border-top p-1 bg-light shadowBox">
                  <div class="mb-1">
                     <div class="input-group d-flex mobile-view">   
                      <input type="hidden"  name= "currency" value="<?php echo $curr; ?>"  >                     
                        <div class="col-md-6 col-sm-12 pe-2">
                           <select class="form-control mb-3 form-select js-example-basic-multiple" id="inputGroupSelect02" name="supplier_in" required >
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
						   
						   
                              <!--<option value="1">Jhone</option>
                              <option value="2">Dave</option>
                              <option value="3">Yusha</option>-->
                           </select>  
                           <div class="d-flex">
                              <input type="text" class="form-control mb-3 mt-3 me-2" required name="vender_id_in" placeholder="Vendor ID" aria-label="vendorID" aria-describedby="addon-wrapping">                                                   
                              <input type="text" class="form-control mb-3 mt-3 me-2" required name="email_in" placeholder="Email" aria-label="Email" aria-describedby="addon-wrapping">                                                   
                              <input type="number" class="form-control mb-3 mt-3" required name="phone_in" placeholder="Phone" aria-label="phone" aria-describedby="addon-wrapping">      
                           </div>                                             
                        </div>
                        <div class="col-md-6 col-sm-12">
                           <div class="d-flex">
                                <input type="text" class="form-control mb-3 me-2"  name="poNo_in" placeholder="PO#" aria-label="poNo" aria-describedby="addon-wrapping" required >

                              <input type="text" class="form-control mb-3 me-2" name="invNo_in" placeholder="Invoice#" aria-label="invNo" aria-describedby="addon-wrapping" required >

                              <input type="date" class="form-control mb-3" name="invDate_in" placeholder="Invice Date" aria-label="invDate:" aria-describedby="addon-wrapping" required > 
                           </div>  
                           <input type="text" class="form-control mb-3" name="ref_in" placeholder="Ref" aria-label="ref" aria-describedby="addon-wrapping" required >                          
                        </div>                                                      
                     </div>
                  </div>
               </div>
            </div>
            <div class="col-lg-12">
               <div class="border-3 border-success border-top p-3 bg-orange shadowBox">
                  <div class="">
                    
                        <div class="d-flex justify-content-center input-group">
                           <div class="col-md-1 col-sm-12">
                              <input type="text" class="form-control me-2" name="Barcode_in" id="Barcode_" placeholder="Barcode" aria-label="Barcode" aria-describedby="addon-wrapping" required >
                           </div>
                           <div class="col-md-2 col-sm-12">
                              <select class="form-control me-2 form-select js-example-basic-multiple" id="select_product" name="products_in" required >
                                 <option value="1">Banna</option>
                                 <option value="2">Apple</option>
                                 <option value="3">Water Bottle</option>  
                              </select>
                           </div>
                           <div class="col-md-1 col-sm-12" >
                               <select class="form-control me-2 form-select js-example-basic-multiple" id="select_color" name="Color_in" required >
                                 <option selected>Color</option>
                                 <option value="1">Black</option>
                                 <option value="2">Red</option>
                              </select>
                           </div>
                           <div class="col-md-1 col-sm-12">
                              <select class="form-control me-2 form-select js-example-basic-multiple" id="select-_ize_" name="size_in" required >
                                 <option selected>Size</option>
                                 <option value="1">Small</option>
                                 <option value="2">Medium</option>
                                 <option value="3">Large</option>
                              </select>
                           </div>                           
                           <div class="col-md-1 col-sm-12">
                              <input type="text" class="form-control me-2" name="qty_in" id="qty_in" placeholder="Qty" aria-label="qty" aria-describedby="addon-wrapping" required >
                           </div>
                           <div class="col-md-1 col-sm-12">
                              <input type="text" class="form-control me-2" name="cost_in" id="cost_in"placeholder="Cost" aria-label="cost" aria-describedby="addon-wrapping" required >
                           </div>
                           <div class="col-md-1 col-sm-12">
                              <input type="text" class="form-control me-2" name="t_cast" id="t_cast" placeholder="T Cost" aria-label="T Cost" aria-describedby="addon-wrapping" required >
                           </div>
                           <div class="col-md-1 col-sm-12">
                              <input type="text" class="form-control me-2"  name="markup_in" id="markup_in" placeholder="Markup %" aria-label="markup" aria-describedby="addon-wrapping" required >
                           </div>
                           <div class="col-md-1 col-sm-12">
                              <input type="text" class="form-control me-2" name="gp_in" id="gp_in" placeholder="GP %" aria-label="gp" aria-describedby="addon-wrapping" required >
                           </div>
                           <div class="col-md-1 col-sm-12">
                              <input type="text" class="form-control me-2" name="price_in" id="price_in" placeholder="Price" aria-label="price" aria-describedby="addon-wrapping" required> 
                           </div>
                           <div class="col-md-1 col-sm-12">
                              <div class="form-check ms-2 mt-2">
                                 <input class="form-check-input" type="checkbox" value="1" name="gst_in" id="gst_in" >
                                 <label class="form-check-label" for="invalidCheck2">GST</label>
                              </div>
                           </div>
                           <div class="col-auto float-end">
                              <button type="submit" class="btn btn-success mt-2" data-bs-toggle="modal" data-bs-target="#productdata"> Add</button>
                           </div>                            
                        </div>
                     </form>
                  </div>
               </div>
            </div>
			
			
            <div class="col-lg-12 top-product">
               <div style="overflow-x:auto;"></div>
               <table id="example" class="table bg-light table-striped shadowBox">
                  <thead>
                     <tr>
                        <th>Barcode</th>
                        <th>Product Name</th>
                        <th>Color</th>
                        <th>Size</th>
                        <th>Quantity</th>
                        <th>Cost</th>
                        <th>T Cost</th>
                        <th>Mark up%</th>
                        <th>GP%</th>
                        <th>Price</th>
                        <th>Action</th>
                     </tr>
                  </thead>
                  <tbody>
				  
				  <?php
					$p = new _pos;
					
							$result = $p->read_data_inventory($_SESSION['uid']);    
							
					if ($result) {
						$i = 1;
						while ($row = mysqli_fetch_assoc($result)) {
							
							
							
							?>
                     <tr>
                        <td><?php echo $row['Barcode_in']; ?></td>
                        <td>
						
						<?php 
						if($row['products_in']== 1){
							echo "Banna";
						}
						
						if($row['products_in']== 2){
							echo "Apple";
						}
						if($row['products_in']== 3){
							echo "Water Bottle";
						}
						
						
						?>
						
						
						</td>
                        <td>
						<?php 
						if($row['Color_in']!= ""){
						if($row['Color_in']== 1){
							echo "Black";
						}
						if($row['Color_in']== 2){
							echo "Red";
						}}
						else{
							echo "N/A";
						}
						
						?>
						
						</td>
                        <td>
						<?php 
						if($row['size_in']!= ""){
						if($row['size_in']== 1){
							echo "Small";
						}
						if($row['size_in']== 2){
							echo "Medium";
						}
						if($row['size_in']== 3){  
							echo "Large";
						}}
						else{
							echo "N/A";
						}
						
						?>
						</td>
                        <td><?php echo $row['qty_in']; ?></td>
                        <td><?php echo $row['currency']; ?>&nbsp;<?php echo $row['cost_in']; ?></td>
                        <td> <?php echo $row['currency']; ?>&nbsp;<?php echo $row['t_cast']; ?> </td>
                        <td> <?php echo $row['markup_in']; ?> </td>
                        <td> <?php echo $row['gp_in']; ?> </td>
                        <td><?php echo $row['currency']; ?>&nbsp;<?php echo $row['price_in']; ?>.00</td>
                        <td>
						<a onclick="edit_inventory('<?php echo $row['id']; ?>','<?php echo $row['products_in']; ?>','<?php echo $row['Color_in']; ?>','<?php echo $row['size_in']; ?>','<?php echo $row['qty_in']; ?>','<?php echo $row['cost_in']; ?>','<?php echo $row['t_cast']; ?>','<?php echo $row['markup_in']; ?>','<?php echo $row['gp_in']; ?>','<?php echo $row['price_in']; ?>','<?php echo $row['gst_in']; ?>','<?php echo $row['Barcode_in']; ?>','<?php echo $row['supplier_in']; ?>','<?php echo $row['vender_id_in']; ?>','<?php echo $row['email_in']; ?>','<?php echo $row['phone_in']; ?>','<?php echo $row['poNo_in']; ?>','<?php echo $row['invNo_in']; ?>','<?php echo $row['invDate_in']; ?>','<?php echo $row['ref_in']; ?>')" ><i class="fas fa-edit me-1"></i></a>   
						|
						
						<a onclick="delete_inventory('<?php echo $BaseUrl?>/store/pos-dashboard/delete_inventory.php?id=<?php echo $row['id'];?>&action=delete')" class="text-danger"> <i class="fas fa-trash"></i></a>
						
						<!--<a href="#" class="text-danger"> <i class="fas fa-trash"></i></a> -->
						</td>
                     </tr>
					<?php }} ?>
                    <!-- <tr>
                        <td>|||||||||||</td>
                        <td>Apple</td>
                        <td>N/A</td>
                        <td>1kg</td>
                        <td>12</td>
                        <td>$5</td>
                        <td> $60 </td>
                        <td> 5 </td>
                        <td> 7 </td>
                        <td>$10</td>
                        <td><a href="#"><i class="fas fa-edit me-1"></i></a>| <a href="#" class="text-danger"> <i class="fas fa-trash"></i></a> </td>
                     </tr>-->
                  </tbody>
               </table>
            </div>
         </div>
		 
	<!---modal of inventory --->	  
 


<div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Update Inventory</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
     </div>
     <div class="modal-body">
        <form action="update_detail_inventory.php" method="post">
		<input type="hidden"  id="id_invent" value="" name="invt_id"> 
		
     <div class="row">
	 <div class="col-md-6"><label>Supplier</label>
	 <select class="form-control mb-3 form-select "  name="supplier_in" id="supplier_in_">
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
	 
                            <!--  <option value="1">Jhone</option>
                              <option value="2">Dave</option>
                              <option value="3">Yusha</option>-->
                           </select>
       </div>
	 <div class="col-md-6"> <label>Vendor ID</label>
	 <input type="text" class="form-control mb-3  me-2" name="vender_id_in"  id="vender_id_in_" placeholder="Vendor ID" aria-label="vendorID" aria-describedby="addon-wrapping"> 
        </div>
	 </div>
	 
	  <div class="row">
	 <div class="col-md-6"><label>Email</label>
	  <input type="text" class="form-control mb-3  me-2" name="email_in" id="email_in_" placeholder="Email" aria-label="Email" aria-describedby="addon-wrapping">  
       </div>
	 <div class="col-md-6"> <label>Phone</label>
	 <input type="number" class="form-control mb-3 " name="phone_in" id="phone_in_" placeholder="Phone" aria-label="phone" aria-describedby="addon-wrapping"> 
        </div>
	 </div>
	 
	  <div class="row">
	 <div class="col-md-6"><label>PO#</label>
	 <input type="text" class="form-control mb-3 me-2"  name="poNo_in" id="poNo_in_" placeholder="PO#" aria-label="poNo" aria-describedby="addon-wrapping">
       </div>
	 <div class="col-md-6"> <label>Invoice#</label>
	 <input type="text" class="form-control mb-3 me-2" name="invNo_in" id="invNo_in_" placeholder="Invoice#" aria-label="invNo" aria-describedby="addon-wrapping">
        </div>
	 </div>
	 
	  <div class="row">
	 <div class="col-md-6"><label>Invice Date</label>
	  <input type="date" class="form-control mb-3" name="invDate_in"  id="invDate_in_" placeholder="Invice Date" aria-label="invDate:" aria-describedby="addon-wrapping"> 
       </div>
	 <div class="col-md-6"> <label>Ref</label>
	  <input type="text" class="form-control mb-3" name="ref_in" id="ref_in_" placeholder="Ref" aria-label="ref" aria-describedby="addon-wrapping"> 
        </div>
	 </div>
	 
	  <div class="row">
	 <div class="col-md-6"><label>Barcode</label>
	 <input type="text" class="form-control me-2" name="Barcode_in" id="Barcode_in" placeholder="Barcode" aria-label="Barcode" aria-describedby="addon-wrapping">
       </div>
	 <div class="col-md-6"> <label>Product</label>
	   <select class="form-control me-2 mb-3 form-select " id="select_product_" name="products_in">
                                 <option value="1">Banna</option>
                                 <option value="2">Apple</option>
                                 <option value="3">Water Bottle</option>  
                              </select>  
        </div>
	 </div>
	 
	  <div class="row">
	 <div class="col-md-6"><label>Color</label>
	  <select class="form-control me-2 mb-3 form-select " id="select_color_" name="Color_in">
                                 <option selected>Color</option>
                                 <option value="1">Black</option>
                                 <option value="2">Red</option>
                              </select>
       </div>
	 <div class="col-md-6"> <label>Size</label>
	 <select class="form-control me-2 form-select mb-3 " id="select_size_" name="size_in">
                                 <option selected>Size</option>
                                 <option value="1">Small</option>
                                 <option value="2">Medium</option>
                                 <option value="3">Large</option>
                              </select>
        </div>
	 </div>
	 
	  <div class="row">
	 <div class="col-md-6"><label>Qty</label>
	  <input type="text" class="form-control mb-3 me-2" name="qty_in" id="qty_in_" placeholder="Qty" aria-label="qty" aria-describedby="addon-wrapping">
       </div>
	 <div class="col-md-6"> <label>Cost</label>
	 <input type="text" class="form-control mb-3 me-2" name="cost_in" id="cost_in_"placeholder="Cost" aria-label="cost" aria-describedby="addon-wrapping">
        </div>
	 </div>
	 
	  <div class="row">
	 <div class="col-md-6"><label>Total Cost</label>
	 <input type="text" class="form-control mb-3 me-2" name="t_cast" id="t_cast_" placeholder="T Cost" aria-label="T Cost" aria-describedby="addon-wrapping">
       </div>
	 <div class="col-md-6"> <label>Markup %</label>
	  <input type="text" class="form-control mb-3 me-2"  name="markup_in" id="markup_in_" placeholder="Markup %" aria-label="markup" aria-describedby="addon-wrapping">
        </div>
	 </div>
	 
	  <div class="row">
	 <div class="col-md-6"><label>GP %</label>
	 <input type="text" class="form-control mb-3 me-2" name="gp_in" id="gp_in_" placeholder="GP %" aria-label="gp" aria-describedby="addon-wrapping">
       </div>
	 <div class="col-md-6"> <label>Price</label>
	  <input type="text" class="form-control mb-3 me-2" name="price_in" id="price_in_" placeholder="Price" aria-label="price" aria-describedby="addon-wrapping">
        </div>
	 </div>
	 
	  <div class="row">
	 <div class="col-md-6">
	 <input class="form-check-input mb-3 " type="checkbox" value="1" name="gst_in" id="gst_in_" >
	  <label class="form-check-label" for="invalidCheck2">GST</label>
       </div>
	 
	 </div>
         
        
         

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Update</button>
     </form>
  </div>
</div>
</div>
</div>
		 
         <div class="row d-flex mobile-view summary">
            <div class="col-md-12 col-sm-12 bg-light shadowBox">
               <div class="row">

                  <div class="col-2">
                     <span class="input-group-text" id="addon-wrapping">On Hand Quantity</span>
                     <input type="text" class="disabled" readonly aria-label="On Hand Quantity" aria-describedby="addon-wrapping">
                  </div>                                   
                  <div class="col-2">
                     <span class="input-group-text" id="addon-wrapping">On Order Quantity</span>
                     <input type="text" class="disabled" readonly aria-label="On Order Quantity" aria-describedby="addon-wrapping">                  
                  </div>
                  <div class="col-2">
                     <span class="input-group-text" id="addon-wrapping">Sub Total</span>
                     <input type="text" class="disabled" readonly aria-label="Sub Total" aria-describedby="addon-wrapping"> 
                  </div>
                  <div class="col-2">
                     <span class="input-group-text" id="addon-wrapping">Discount</span>
                     <input type="text" class="disabled" readonly aria-label="Discount" aria-describedby="addon-wrapping"> 
                  </div>
                  <div class="col-2">
                     <span class="input-group-text" id="addon-wrapping">Total</span>
                     <input type="text" class="disabled" readonly aria-label="Total" aria-describedby="addon-wrapping"> 
                  </div>
                  <div class="col-2">
                     <span class="input-group-text" id="addon-wrapping">Tax</span>
                     <input type="text" class="disabled" readonly  aria-label="Tax" aria-describedby="addon-wrapping"> 
                  </div>

               </div>
            </div>            
            <div class="col-12 bg-light shadowBox">                 
               <input type="button" class="btn btn-success float-end ps-5 pe-5 m-2" data-bs-toggle="modal" data-bs-target="#paymentterm" name="print" value="Post">
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
 
 
 function delete_inventory(url){
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
   
   function edit_inventory(a,b,c,d,e,f,g,h,i,j,k,l,m,n,o,p,q,r,s,t){
       //alert(c);  

       $("#exampleModal2").modal('show');    
       $("#id_invent").val(a);
       $("#select_product_").val(b);
       $("#select_color_").val(c);
       $("#select_size_").val(d);
       $("#qty_in_").val(e);
       $("#cost_in_").val(f);
       $("#t_cast_").val(g);
       $("#markup_in_").val(h);
       $("#gp_in_").val(i);
       $("#price_in_").val(j);
	   if( k == 1){
		 $("#gst_in_").attr ( "checked" ,"checked" );   
	   }
      
       $("#Barcode_in").val(l);
	  // alert(m);
       $("#supplier_in_").val(m);
       $("#vender_id_in_").val(n);
       $("#email_in_").val(o);
       $("#phone_in_").val(p);
       $("#poNo_in_").val(q);
       $("#invNo_in_").val(r);
       $("#invDate_in_").val(s);
       $("#ref_in_").val(t);
       
       
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