 
<?php 
 //ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);

 include('../../univ/baseurl.php');
    session_start();
	//print_r($_SESSION); die('');
if(!isset($_SESSION['pid'])){ 
    //$_SESSION['afterlogin']="store/";
	
    //include_once ("../../authentication/check.php");
	//include '../../authentication/check.php';
  //print_r($_SESSION); die('1111111111');
  
 // header("$BaseUrl;/login.php");
}else{
    function sp_autoloader($class){
      include '../../mlayer/' . $class . '.class.php';
    }
    spl_autoload_register("sp_autoloader");
//print_r($_SESSION); die('222222222222');

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
               <div class="col-lg-12 mb-3">
                  <div class="border-3 border-primary border-top p-3 bg-light shadowBox">
                     <div class="mb-1">
                        <div class="input-group flex-nowrap">
                           <div class="col-2 me-1 d-flex">
				 <button type="button" style="display:none" id="m_modal" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#membership_Modal"> <i class="fas fa-plus"></i> </button>     
                              <input type="text" class="form-control" placeholder="Sales Person" aria-label="Sales Person" aria-describedby="addon-wrapping">
                           </div>
						   
						    <div class="col-2 me-1 d-flex">
                              <input type="text" class="form-control" placeholder="Cust Ph:" aria-label="Customer Ph:" aria-describedby="addon-wrapping" onkeyup=" fun_id()" id="phone_">    
                           </div>
                          
                           <div class="col-1 me-1 d-flex">
                              <input type="text" class="form-control" placeholder="Cust ID:" aria-label="Customer ID:" aria-describedby="addon-wrapping" id ="customer_id">
                           </div>
						   
                           <div class="col-4 me-1 d-flex">
						   
						   <input type="text" class="form-control" placeholder="Customer name" aria-label="" aria-describedby="addon-wrapping" id="customer_name_">
                             <!-- <select class="form-control form-select js-example-basic-multiple" onchange="fun_id_e()" id="inputGroupSelect" name="customers" >
							  <option>Select Customer</option>
							  <?php $p = new _pos; 
							 
							 							
	                             $result = $p->read_data_uid($_SESSION['uid']);

                                           if ($result) {
											   //print_r($result); die();
                                                            
                                while ($row = mysqli_fetch_assoc($result)) {								 ?>
                                 <option  value="<?php echo $row['id']; ?>"><?php echo $row['customer_name']; ?></option>
                                
								 
										   <?php }} ?> 
                              </select>-->
                              <button type="button" class="btn btn-info btn-sm text-light" data-bs-toggle="modal" data-bs-target="#customeredit"> <i class="fas fa-edit"></i> </button>
                              <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addcustomer"> <i class="fas fa-plus"></i> </button>                              
                           </div>
                           <div class="col-3 me-1 d-flex">
                              <input type="text" class="form-control" placeholder="Email" aria-label="Customer Email" aria-describedby="addon-wrapping"id="email_">
                           </div>
						   
                        </div>
                     </div>
                  </div>
               </div>
			   <input type="hidden" id="title_pro">
			   <input type="hidden" id="rand_val" value="1">
			   <input type="hidden" id="discount_change" value="" >
			   <input type="hidden" id="discount_total_" value="0" >
			   <input type="hidden" id="sub_total_1" value="0" >
               <div class="col-lg-12">
                  <div class="border-3 border-success border-top p-3 bg-light shadowBox">
                     <div class="mb-3">
                       <!-- <form method="post" action="#">-->
                           <div class="d-flex justify-content-center input-group"> 
                              <div class="col-1 me-1">
                                 <input type="text" class="form-control" placeholder="Barcode" aria-label="Barcode" aria-describedby="addon-wrapping" id="product_id_" onkeyup="fun_product_id()"> 
                              </div>
                              <div class="col-4 d-flex me-1">
							  
							  <input type="text" class="form-control" placeholder="Product name" aria-label="Product name" aria-describedby="addon-wrapping" id="product_name_">
                                <!-- <select class="form-control form-select js-example-basic-multiple" id="select_product" onchange="fun_product_id_()" name="products">
								 <option>Select Product</option> 
								  <?php $sp = new _spprofiles; 
							 
												 //echo $_SESSION['uid']."hello";				
	                             $result_1 = $sp->read_post_product($_SESSION['uid']);

                                           if ($result_1) {
											   //print_r($result); die();
                                                            
                                while ($row_1 = mysqli_fetch_assoc($result_1)) {								 ?>
                                 <option  value="<?php echo $row_1['idspPostings']; ?>"><?php echo $row_1['spPostingTitle']; ?></option>
                                
								 
										   <?php }} ?> 
                                    
                                 </select>-->
                                 <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal2"> <i class="fas fa-plus"></i> </button>  
                              </div>
							     
                              <div class="col-1 me-1" id="add_color">
                                 <input type="text" class="form-control" placeholder="Color" readonly aria-label="Color" aria-describedby="addon-wrapping" id="color_">
                              </div>
                              <div class="col-1 me-1" id="add_size">
                                 <input type="text" class="form-control" placeholder="Size" readonly aria-label="Size" aria-describedby="addon-wrapping" id="size_">
                              </div>
                              <div class="col-2 me-1 d-flex">
                                 <input type="text" class="form-control me-1" placeholder="Quantity" aria-label="Quantity" aria-describedby="addon-wrapping" id="quantity_">                              
                                 <input type="text" class="form-control" placeholder="Discount" aria-label="discount" aria-describedby="addon-wrapping" id="discount_">
                                 <select class="form-control" id="select_currency" name="" aria-label="Default select example">
                                    <option value="%" selected>%</option>
                                    <option value="$">$</option>                                    
                                 </select>                                 
                              </div>
                              <div class="col-1 me-1"> 
                                 <input type="text" class="form-control" placeholder="Unit Price" aria-label="Unit Price" aria-describedby="addon-wrapping" id="price_"> 
                              </div>
							  
                              <div class="col-1 me-1">
                                 <button type="submit" class="btn btn-success" id="add_submit" name="submit" value="Add">Add</button>
                              </div>
                           </div>
                       <!-- </form>-->
                     </div>
                  </div>
               </div>
               <div class="col-lg-12 top-product">
                  <table id="example" class="table bg-light table-striped shadowBox">
                     <thead>
                        <tr>
                           <th>Barcode</th>
                           <th>Product Name</th>
                           <th>Color</th>
                           <th>Size</th>
                           <th>Quantity</th>
                           <th>Unit Price</th>
                           <th width="">Discount</th>
                           <th>T Price</th>
                           <th>Action</th>
                        </tr>
                     </thead>
                     <tbody id ="append_tr">
                      <!--  <tr>
                           <td id ="td_barcode"></td>
                           <td>Bannana</td>
                           <td id ="td_color"></td>
                           <td id="td_size" ></td>
                           <td><input type="text" name="" value="" style="width: 50px;" id="td_quantity" ></td>
                           <td><input type="text" name="" value="" style="width: 50px;" id="td_price"></td>
                           <td> %<span id="td_discount"></span> </td>
                           <td>$<span id="td_net"></span></td>
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
                        </tr>-->
                     </tbody>
                  </table>
               </div>
            </div>
            <div class="row summary">
               <div class="col-lg-6 d-inline-flex bg-light shadowBox">
                  <div class="d-flex flex-row input-group flex-nowrap">                   
                     <span class="input-group-text" id="addon-wrapping">Sub Total</span>
                     <input type="text" id="sub_total_" class="form-control" placeholder="Sub Total" aria-label="Sub Total" aria-describedby="addon-wrapping"> 
                     <span class="input-group-text" id="addon-wrapping">Discount</span>
                     <input type="text" class="form-control" onkeyup="fun_discount()" id="discount_by_net" placeholder="Discount" aria-label="Discount" aria-describedby="addon-wrapping"> 
                     <span class="input-group-text" id="addon-wrapping">Total</span>
                     <input type="text" class="form-control" value="0" id="total_by_net" placeholder="Total" aria-label="Total" aria-describedby="addon-wrapping"> 
                     <span class="input-group-text" id="addon-wrapping">Tax</span>
                     <input type="text"  class="form-control" onkeyup="fun_tax()" id ="total_tax" placeholder="Tax" aria-label="Tax" aria-describedby="addon-wrapping"> 
                  </div>
               </div>
               <div class="col-lg-6">    
               <span class="border border-sucess bg-light float-end tinput pe-2 shadowBox" id="Gross_net_">Total:  $00</span>                            
               </div>
               <div class="col-12 bg-light shadowBox">
                  <input type="button" class="btn btn-success float-end ps-5 pe-5 m-2" data-bs-toggle="modal" data-bs-target="#paymentterm" name="print" value="Payment">
                  <input type="button" class="btn btn-warning float-end ps-5 pe-5 m-2" data-bs-toggle="modal" data-bs-target="#discountModal" name="" value="Discount">
                  <input type="submit" class="btn btn-primary float-end ps-5 pe-5 m-2" name="" value="Hold">
               </div>
            </div>
            <div class="row">
               <div class="col-lg-12 footer">                     
                  <span>Copyrights &copy; 2022 TheSharePage, All Reights Reserved</span>                    
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
                  <!--<form>-->
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
                              <img src="" id ="preview_img"  class="img-sm img-fluid img-thumbnail float-end mb-2"> 
							 <!-- <form action="" class="iima" method="post" enctype="multipart/form-data" name="fileinfo"> 
								<input type="file" class="form-control shadowBox" id ="image_file" name="profile-img">
								</form>-->
                              <input type="file" class="form-control shadowBox" id ="image_file" name="profile-img">    
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
                                             <input class="form-check-input" type="checkbox" value="1" id="customer_check" required>
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
                                          <input type="text" class="form-control" id="discount_in" placeholder="Discount" required>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="tab-pane" id="cpt" role="tabpanel" aria-labelledby="cpt-tab">
                                    <div class="row">
                                       <div class="col-6">
                                          <div class="d-flex me-1">
                                             <select class="form-control form-select" id="select_payment" name="paymentterm">
                                                <option value="1">Cash</option>
                                                <option value="2">Credit Card</option>
                                                <option value="3">Bank Account</option>
                                             </select>
                                          </div>
                                       </div>
                                       <div class="col-6">
                                          <div class="d-flex me-1">
                                             <select class="form-control form-select" id="select_credit" name="creditterm">
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
                  <button type="button" class="btn btn-secondary" id="close_" data-bs-dismiss="modal">Close</button>
                  <button type="button" onclick="fun_save_customer()" class="btn btn-primary">Save changes</button>   
               </div>
               <!--</form>-->
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
                              <input type="text" class="form-control shadowBox" id="customerno_up" placeholder="Customer#" value="" required>
                           </div>
                           <div class="mb-3">
                              <input type="text" class="form-control shadowBox" id="customername_up" placeholder="Customer Name" value="" required>
                           </div>
                           <div class="mb-3">
                              <input type="text" class="form-control shadowBox" id="customerphone_up" placeholder="Customer Phone" value="" required>
                           </div>
                           <div class="mb-3">
                              <input type="text" class="form-control shadowBox" id="customeremail_up" placeholder="Customer Email" value="" required>
                           </div>                           
                           <div class="mb-3">
                              <select class="form-control form-select shadowBox" id="customertype_up" name="customertype">
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
                                          <input type="text" class="form-control" id="address_up" placeholder="Address" required>
                                       </div>
                                       <div class="col-4 mb-4">
                                          <input type="text" class="form-control" id="city_up" placeholder="City" required>
                                       </div>
                                       <div class="col-4 mb-4">
                                          <input type="text" class="form-control" id="zip_up" placeholder="ZIP" required>
                                       </div>
                                       <div class="col-4 mb-4">
                                          <input type="text" class="form-control" id="country_up" placeholder="Country" required>
                                       </div>
                                       <div class="form-group">
                                          <div class="form-check">
                                             <input class="form-check-input" type="checkbox" value="" id="invalidCheck2_up" required>
                                             <label class="form-check-label" for="invalidCheck2">Receive Email & Newsletter</label>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="tab-pane" id="pt" role="tabpanel" aria-labelledby="pt-tab">
                                    <div class="row">
                                       <div class="col-4 mb-4">
                                          <input type="text" class="form-control" id="saleprice_up" placeholder="Sale Price" required>
                                       </div>
                                       <div class="col-4 mb-4">
                                          <input type="text" class="form-control" id="tax_up" placeholder="TAX" required>
                                       </div>
                                       <div class="col-4 mb-4">
                                          <input type="text" class="form-control" id="discount_up" placeholder="Discount" required>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="tab-pane" id="cpt" role="tabpanel" aria-labelledby="cpt-tab">
                                    <div class="row">
                                       <div class="col-6">
                                          <div class="d-flex me-1">
                                             <select class="form-control form-select" id="select-payment_up" name="paymentterm">
                                                <option value="1">Cash</option>
                                                <option value="2">Credit Card</option>
                                                <option value="3">Bank Account</option>
                                             </select>
                                          </div>
                                       </div>
                                       <div class="col-6">
                                          <div class="d-flex me-1">
                                             <select class="form-control form-select" id="select-credit_up" name="creditterm">
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
                                          <textarea class="form-control" id="notes_up" rows="3"></textarea>
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
      <div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                           <input type="text" class="form-control shadowBox" id="barcode_in" placeholder="Barcode" value="" required>
                        </div>
                        <div class="col-12 mb-3">
                           <input type="text" class="form-control shadowBox" id="productname_in" placeholder="product Name" value="" required>
                        </div>
                       <!-- <div class="col-4 mb-3">
                           <input type="text" class="form-control shadowBox" id="purchaseprice_in" placeholder="Purchase Price" value="" required>
                        </div>-->
                        <div class="col-6 mb-3">
                           <input type="text" class="form-control shadowBox" id="cost_in" placeholder="Cost" value="" required>
                        </div>
                        <div class="col-6 mb-3">
                           <input type="text" class="form-control shadowBox" id="saleprice_in" placeholder="Discount Price" value="" required>
                        </div>
                        <!--<div class="col-4 mb-3">
                           <input type="text" class="form-control shadowBox" id="color_in" placeholder="Color" value="" required>
                        </div>
                        <div class="col-4 mb-3">
                           <input type="text" class="form-control shadowBox" id="size_in" placeholder="Size" value="" required>
                        </div>
                        <div class="col-4 mb-3">
                           <input type="text" class="form-control shadowBox" id="tax_in" placeholder="TAX" value="" required>
                        </div>-->
                        <div class="col-12 mb-3">
                           <select class="form-control form-select shadowBox" id="product_cat_in" name="product-cat">
                              <option value="uncategories" selected>Select Category</option>
                              <option value="Fruits">Fruits</option>
                              <option value="Vegetables">Vegetables</option>
                              <option value="General">General</option>
                           </select>
                        </div>                        
                        <!--<div class="col-6 mb-3">
                            <select class="form-control form-select shadowBox" id="product_sub_cat_in" name="product-sub-cat">
                              <option value="uncategories" selected>Select Sub Category</option>
                              <option value="dryFruits">Dray Fruits</option>
                              <option value="Fresh Fruit">Fresh Fruits</option>
                              <option value="Import Fruits Item">Import Fruit Items</option>
                           </select>
                        </div>-->
                        <div class="col-12 mb-3">
                           <textarea class="form-control shadowBox" id="description_in" rows="3"></textarea>
                        </div>
                        <div class="col-12 mb-3">                           
                           <input type="file" class="form-control shadowBox" id="image_product" name="productimage">
                        </div>
                     </div>
                  </div>
               <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" id="close_2" data-bs-dismiss="modal">Close</button>    
                  <button type="button" onclick="fun_product_add()" class="btn btn-success">Save changes</button>
               </div>
               </form>
               </div>
            </div>
         </div>
      </div>
      <!-- Modal Discount Details -->
      <div class="modal fade" id="discountModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
         <div class="modal-dialog modal-sm">
            <div class="modal-content">
               <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Discount</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
               </div>
               <div class="modal-body">
                  <div class="row">
                     <div class="col-12 mb-3">
                        <input class="form-check-input" type="radio" name="discount" value="" id="invalidCheck2_"> Percentage
                        <input class="form-check-input" type="radio" name="discount" value="" id="invalidCheck2_"> Flat Discount
                     </div>
                     <div class="col-12 mb-3">
                        <input type="text" class="form-control shadowBox" id="percentage" placeholder="Discount Value" value="">
                     </div> 
                     <div class="form-group">                        
                        <div class="form-check">
                           <input class="form-check-input" type="checkbox" value="" id="invalidCheck2" required>
                           <label class="form-check-label" for="invalidCheck2_">Apply discount on all products?</label>
                        </div>
                     </div>                    
                  </div>
               </div>
               <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  <button type="button" class="btn btn-warning">Save changes</button>
               </div>
            </div>
         </div>
      </div>
	  
	  
	  
	   <!-- Modal Discount Details -->
      <div class="modal fade" id="membership_Modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
         <div class="modal-dialog modal-sm">
            <div class="modal-content">
               <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Add Membership</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
               </div>
               <div class="modal-body">
                  <div class="row">
                       <input type="text" class="form-control shadowBox" id="member_ship_" placeholder="Enter no." value="">                
                  </div>
               </div>
               <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" id="close_3" data-bs-dismiss="modal">Close</button> 
                  <button type="button"  onclick="fun_membership()" class="btn btn-warning">Save changes</button>
               </div>
            </div>
         </div>
      </div>
	  
	      <!-- Modal Discount Details -->
      <div class="modal fade" id="discountModal_1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
         <div class="modal-dialog modal-sm">
            <div class="modal-content">
               <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel"></h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
               </div>
               <div class="modal-body">
			   
			   <div class="row text-center" style="color:red"><h4> Please Fill The Quantity </h4></div>      
                  <!--<div class="row">
                     <div class="col-12 mb-3">
                        <input class="form-check-input" type="radio" name="discount" value="" id="invalidCheck2"> Percentage
                        <input class="form-check-input" type="radio" name="discount" value="" id="invalidCheck2"> Flat Discount
                     </div>
                     <div class="col-12 mb-3">
                        <input type="text" class="form-control shadowBox" id="percentage" placeholder="Discount Value" value="">
                     </div> 
                     <div class="form-group">                        
                        <div class="form-check">
                           <input class="form-check-input" type="checkbox" value="" id="invalidCheck2" required>
                           <label class="form-check-label" for="invalidCheck2">Apply discount on all products?</label>
                        </div>
                     </div>                    
                  </div>-->
               </div>
               <div class="modal-footer">
                  <!--<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>-->
                 
               </div>
            </div>
         </div>
      </div>
	  
      <!-- Modal Customer -->
      <div class="modal fade" id="paymentterm" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
         <div class="modal-dialog modal-lg">
            <div class="modal-content">
               <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Payment Terms</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
               </div>
               <div class="modal-body">
                  <div class="row">
                     <div class="col-6 ">
                          <span class="border border-sucess bg-dark text-warning float-end ps-5 pe-5 pt-2 pb-2 mb-3 shadowBox" style="width:100%">Balance:  $250.00 </span>  
                          <table id="example" class="table bg-light table-striped shadowBox table-responsive">
                     <thead>
                        <tr>
                           <th>Tender</th>
                           <th>Foriegn</th>
                           <th>Local</th>                           
                        </tr>
                     </thead>
                     <tbody>
                        <tr>
                           <td>Bannana</td>
                           <td>N/A</td>
                           <td>N/A</td>                           
                        </tr>
                     </tbody>
                     <tfoot>
                        <tr>
                           <td colspan="2">Total: $25.00</td>
                           <td><i class="fas fa-trash text-danger"></i></td>                          
                        </tr>
                     </tfoot>
                  </table>
                     </div>
                     <div class="col-6 text-center">
                        <div class="input-group mb-3">
                         <div class="input-group-text" id="btnGroupAddon2">Enter Amount</div>
                         <input type="text" class="form-control" aria-label="Input group example" aria-describedby="btnGroupAddon2">
                         </div>               

                         <div class="d-flex flex-wrap" role="group" aria-label="First group">
                           <button type="button" class="btn btn-outline-secondary me-2 mb-2">Cash</button>
                           <button type="button" class="btn btn-outline-secondary me-2 mb-2">Visa</button>
                           <button type="button" class="btn btn-outline-secondary me-2 mb-2">Master</button>
                           <button type="button" class="btn btn-outline-secondary me-2 mb-2">American Express</button>
                           <button type="button" class="btn btn-outline-secondary me-2 mb-2">Amex</button>
                           <button type="button" class="btn btn-outline-secondary me-2 mb-2">Cheque</button>
                           <button type="button" class="btn btn-outline-secondary me-2 mb-2">Redeem</button>
                           <button type="button" class="btn btn-outline-secondary me-2 mb-2">Debit Card</button>
                        </div>
                     </div>                     
                  </div>
               </div>
               <div class="modal-footer">
                  <div class="">
                        <div class="d-flex me-1">
                           <div class="form-group">
                              <div class="form-check me-3">
                                 <input class="form-check-input" type="checkbox" value="" id="invalidCheck2" required>
                                 <label class="form-check-label" for="invalidCheck2">Print Invoice</label>
                              </div>
                           </div>
                           <div class="form-group me-3">
                              <div class="form-check">
                                 <input class="form-check-input" type="checkbox" value="" id="invalidCheck2" required>
                                 <label class="form-check-label" for="invalidCheck2">Email</label>
                              </div>
                           </div>
                           <div class="form-group me-3">
                              <div class="form-check">
                                 <input class="form-check-input" type="checkbox" value="" id="invalidCheck2" required>
                                 <label class="form-check-label" for="invalidCheck2">To Screen</label>
                              </div>
                           </div>
                        </div>
                  </div>
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  <button type="button" class="btn btn-success">OK</button>
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
      <script type="text/javascript">
         $(document).ready(function () {
          $('#example').DataTable();
          "columnDefs": [
          { "searchable": false, "targets": 0 }
          ]
         });
         
      </script>
      <script type="text/javascript">
         $(document).ready(function() {
          $('.js-example-basic-multiple').select2();
		  
		  $('#add_submit').click(function(){
			  
			// alert('hello');
			
            	var barcode = $('#product_id_').val();	
           		
            	var quantity = $('#quantity_').val();
				if(quantity != ""){
					quantity = quantity;
				}else{ 
				
				$("#discountModal_1").modal('show');  
					return false;
				}
            	var title_pro = $('#title_pro').val();
             		
            	var discount = $('#discount_').val(); 
                   $('#discount_change').val(discount);				
                //alert(discount);				
            	var select_currency = $('#select_currency').val();		 
            	var price = $('#price_').val();
              				
            	var size = $('#size_').val();
                   if(size != ""){
					   size =size;
				   }else{
					   size='N/A';
				   }					   
            	var color = $('#color_').val();	
                 if(color != ""){
					   color =color;
				   }else{
					   color='N/A';
				   }	
				//alert(select_currency);
				
				if(select_currency == "%"){
					if(discount != ""){
					   discount_new = discount+select_currency;
					}else{
						discount_new = 'N/A';
					}
					 var total_price = quantity*price;	
                     var total_gross= (total_price*discount)/100;
                     var net =  (total_price -  total_gross);  
				}else{
					if(discount != ""){
					   discount_new = discount+select_currency;
					}else{
						discount_new = 'N/A'; 
					}

					var total_price = quantity*price;	
                   //var total_gross= (total_price*discount)/100;
                   var net =  (total_price -  discount); 
					
				}
                				
              var rand_val = $('#rand_val').val();
			  //alert(rand_val);
			  
			 var record_add = '<tr id = "id'+rand_val+'" ><td>'+barcode+'</td><td>'+title_pro+'</td><td>'+color+'</td><td>'+size+'</td><td><input type="text" onkeyup="fun_quantity('+rand_val+')" id="qun'+rand_val+'" name="" value="'+quantity+'" width="50" style="width: 50px;"></td><td><input id="pri'+rand_val+'" onkeyup="fun_price('+rand_val+')" type="text" name="" value="'+price+'" style="width: 50px;"></td><td id="dis'+rand_val+'" value="'+discount+'">'+discount_new+' </td><td id="net'+rand_val+'" value="'+net+'" >'+net+'</td> <td> <a href="#" onclick="fun_record('+rand_val+')" class="text-danger"> <i class="fas fa-trash"></i></a> </td></tr>'; 
                   
  //alert(record_add);		
			$('#append_tr').append(record_add);
			//alert(rand_val);
			
			var iNum = parseInt(rand_val);
			
			 var sub_to = parseInt(document.getElementById('net'+iNum).getAttribute('value'));        
			 //alert(sub_to);   
			  
             var sub_total = $('#sub_total_1').val();	
                   sub_total= parseInt(sub_total);	 		  
			var   sub_tot = sub_total + sub_to ;
			  //alert(sub_tot);   
			$('#sub_total_').val(sub_tot);     
			$('#sub_total_1').val(sub_tot);     
			
			
			var sub_total = $('#sub_total_1').val();	
                   sub_total= parseInt(sub_total);	
			
			
			 /*var sub_discount = parseInt(document.getElementById('dis'+iNum).getAttribute('value'));
			// alert(sub_discount);
			 var discount_total_ = $('#discount_total_').val();	
                   discount_total =  parseInt(discount_total_);	
				   var net_discount = discount_total + sub_discount;
				   //alert(net_discount);
				   $('#discount_by_net').val(net_discount);     
			       $('#discount_total_').val(net_discount);  */ 

            /*var sub_total_2 = $('#sub_total_1').val();	
                   sub_total_2= parseInt(sub_total_2);	
            				   
			
             var discount_total_2 = $('#discount_total_').val();	
                   discount_total_2 =  parseInt(discount_total_2);
                var total_1_net =  (sub_total_2*discount_total_2)/100;	
                	var	total_12_net = (sub_total_2-total_1_net);    
                	 $('#total_by_net').val(total_12_net);*/ 				
			//var sub_total += sub_to;   
			//$('#sub_total_').val(sub_total); 
			//sub_total = sub_total+
			
			
           var  rand_val_1 = iNum+1;
		   $('#rand_val').val(rand_val_1); 
             //alert(rand_val_1);	 		 
           			 
 			 $('#product_id_').val(''); 
 			 $('#product_name_').val(''); 
			 $('#color_').val('');
             $('#size_').val('');
             $('#quantity_').val('');
			 $('#price_').val('');
			 $('#discount_').val('');
			 $('#discount_change').val();
			 
				
			
		  });
		 
         });
		 
		 function fun_id(id){
			 var id = $('#phone_').val();
			var b =  id.length;
			if(b<12){
				//alert(b);
				 var phone = $('#phone_').val();
				
			}else{
				alert('number should be in 10 digit');
				return false;
			}
			 var tbl = "customer";
			 $.ajax({
url: 'read_data_id.php', 
type: 'post',
data: {'phone':phone,tbl:tbl},    
 dataType: "JSON",

success: function(response){
	//alert(response.email); 
	$('#email_').val(response.email);
	$('#customer_name_').val(response.customer_name);
	$('#customer_id').val(response.id);  
	$('#m_modal').css("display","block");

	
}

});


		 }
		 
		 
		  function fun_product_id(){
			  
			   var barcode_id = $('#product_id_').val();
			//var b =  id.length;
			//if(b<12){
				//alert(b);
				// var phone = $('#product_id_').val();
				
			//}else{
				///alert('number should be in 10 digit');
				//return false;
			//}
			  
			// var id = $('#select_product').val();
			 var tbl = "product";
			//alert(id);
			 $.ajax({
url: 'read_data_id.php',  
type: 'post',
data: {'barcode_id':barcode_id,tbl:tbl},   
 dataType: "JSON",

success: function(response){
	//alert(response.price);
	//console.log(response); 
	$('#price_').val(response.price);
	$('#product_id_').val(response.id);
	$('#title_pro').val(response.title);
	$('#product_name_').val(response.title); 
	$('#add_size').html(response.size); 
	$('#add_color').html(response.color);
	
	
	
	
}

});
		 }
		 
		 
		 function fun_record(id){
			 
			 //alert(id);
			 $('#id'+id).hide();
			 
		 }
		 
		  function fun_quantity(id){
			 
			 //alert(id);
			var quan =  $('#qun'+id).val();
			var price_1 =  $('#pri'+id).val();
			var discnt = $('#discount_change').val();
			//var net_new = quan*
			
			var total_price = quan*price_1;	
                     var total_gross= (total_price*discnt)/100;
                     var net_new =  (total_price -  total_gross); 
                     $('#net'+id).text(net_new); 					 
			  
		 } 
		 
		 
		 function fun_price(id){
			 
			 //alert(id);
			var quan =  $('#qun'+id).val();
			var price_1 =  $('#pri'+id).val();
			var discnt = $('#discount_change').val();
			//var net_new = quan*
			
			var total_price = quan*price_1;	
                     var total_gross= (total_price*discnt)/100;
                     var net_new =  (total_price -  total_gross); 
                     $('#net'+id).text(net_new); 	 				 
			  
		 } 
		 
		 
		 function fun_discount(id){
			 
			

    
            var sub_total_2 = $('#sub_total_1').val();	
                   sub_total_2= parseInt(sub_total_2);	
            				   
			
             var discount_total_2 = $('#discount_by_net').val();	 
                   discount_total_2 =  parseInt(discount_total_2);

               // var total_1_net =  (sub_total_2*discount_total_2)/100;
                   if(Number.isNaN(discount_total_2)){	
                     $('#total_by_net').val(sub_total_2);	 			   
                	$('#Gross_net_').text("Total: $"+sub_total_2+".00");   
					
				  } else{ 
				  
				  var	total_12_net = (sub_total_2-discount_total_2);  
                 					
                	 $('#total_by_net').val(total_12_net); 	 				 
                	 $('#Gross_net_').text("Total: $"+total_12_net+".00"); 
				  
				  } 
				 
              /*var total_tax = $('#total_tax').val();	
                   total_tax = parseInt(total_tax);	
				   
             var total_by_net_1 = $('#total_by_net').val();	
                   total_by_net_1 = parseInt(total_by_net_1);*/	
			 
				/*var amount_total =  total_tax+ total_by_net_1; 
				alert(amount_total);
				$('#Gross_net_').Text("Total: $"+amount_total); */ 
		 } 
		 
		 function fun_tax(id){
			 var total_tax = $('#total_tax').val();	
                   total_tax = parseInt(total_tax);	
				   
             var total_by_net_1 = $('#total_by_net').val();	
                   total_by_net_1 = parseInt(total_by_net_1);
			 if(Number.isNaN(total_tax)){
				   $('#Gross_net_').text("Total: $"+total_by_net_1+".00");  
			 } else{
				
				var amount_total =  total_tax+ total_by_net_1; 
				//alert(amount_total);
				$('#Gross_net_').text("Total: $"+amount_total+".00");
			 }
		 }
		
      </script>
	  <script>
	  
	    function fun_save_customer(){  
          // alert('hello');	
          //var formData = new FormData(); 
         // formData.append('file', $('#image_file').files[0]); 		  
		  //console.log("form data "+formData);
		  //alert(formData); 
		   var data_field = new FormData();
            data_field.append('fill',$('#image_file')[0].files[0]); 
            
          var customerno = $('#customerno').val();
		 
		   var customername = $('#customername').val();
		   var customerphone = $('#customerphone').val();
		   var customeremail = $('#customeremail').val();
		   var customertype = $('#customertype').val();
		   var address = $('#address').val();
		   var city = $('#city').val();
		   var zip = $('#zip').val();
		   var Country = $('#Country').val();
		   var customer_check = $('#customer_check').val();
		   var saleprice = $('#saleprice').val();
		   var tax = $('#tax').val();
		   var discount_ = $('#discount_in').val();
		   var select_payment = $('#select_payment').val();
		  var select_credit = $('#select_credit').val();
		  var notes = $('#notes').val(); 
              data_field.append('customerno',customerno); 		  
              data_field.append('customername',customername); 		  
              data_field.append('customerphone',customerphone); 		  
              data_field.append('customeremail',customeremail); 		  
              data_field.append('customertype',customertype); 		  
              data_field.append('address',address); 		  
              data_field.append('city',city); 		  
              data_field.append('zip',zip); 		  
              data_field.append('Country',Country); 		  
              data_field.append('customer_check',customer_check); 		  
              data_field.append('saleprice',saleprice); 		  
              data_field.append('tax',tax); 		  
              data_field.append('discount_',discount_); 		  
              data_field.append('select_payment',select_payment); 		  
              data_field.append('select_credit',select_credit); 		  
              data_field.append('notes',notes); 		  
          
             $.ajax({
url: 'insert_customer.php',  
type: 'post',
processData: false,
contentType: false,
data: data_field ,    
  
 
success: function(response){
	$('#close_').click(); 
}

});
          		  
		  }
	  </script>
	  
	  <script>
	  
	    function fun_product_add(){  
         
		
		// alert('hello123');
		 var data_formate = new FormData();
            data_formate.append('feat_img',$('#image_product')[0].files[0]);  
          var barcode_in = $('#barcode_in').val();
		   var productname_in = $('#productname_in').val();
		   var purchaseprice_in = $('#purchaseprice_in').val();
		   var cost_in = $('#cost_in').val();
		   var saleprice_in = $('#saleprice_in').val();
		   var color_in = $('#color_in').val();
		   var tax_in = $('#tax_in').val();
		   var product_cat_in = $('#product_cat_in').val();
		   var product_sub_cat_in = $('#product_sub_cat_in').val();
		   var description_in = $('#description_in').val();
		   data_formate.append('barcode_in',barcode_in); 
		   data_formate.append('productname_in',productname_in); 
		   data_formate.append('purchaseprice_in',purchaseprice_in); 
		   data_formate.append('purchaseprice_in',purchaseprice_in); 
		   data_formate.append('cost_in',cost_in); 
		   data_formate.append('saleprice_in',saleprice_in); 
		   data_formate.append('color_in',color_in); 
		   data_formate.append('tax_in',tax_in); 
		   data_formate.append('product_cat_in',product_cat_in); 
		   data_formate.append('product_sub_cat_in',product_sub_cat_in); 
		   data_formate.append('description_in',description_in); 
		  
		   

            $.ajax({
url: 'add_product.php',  
type: 'post',
processData: false,
contentType: false,
data: data_formate ,  
 
success: function(response){ 
	$('#close_2').click();       
}

});
          		  
		  }
	  </script>
	  
	  <script>
	  function fun_membership(){
		  
		  //alert("hello");  
		   var member_ship_ = $('#member_ship_').val();
		    var customer_id = $('#customer_id').val();
			var tbl = "membership";
			 $.ajax({
					url: 'read_data_id.php',  
					type: 'post',
					
					data: {member_ship_:member_ship_,customer_id:customer_id,tbl:tbl} ,    
					 
					success: function(response){ 
						$('#close_3').click();         
					}

					});
	  }
	  
	  
	  </script>
	  
	  <script>
	  image_file.onchange = evt => {
  const [file] = image_file.files
  if (file) {
    preview_img.src = URL.createObjectURL(file) 
  }
}
	  </script>
   </body>
</html>
<?php } ?>