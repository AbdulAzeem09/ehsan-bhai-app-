
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


//print_r($_SESSION); die();
?>





<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>Business Account & Inventory | TheSharepage</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" />
        <link
            rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.7.2/css/all.min.css"
            integrity="sha512-3M00D/rn8n+2ZVXBO9Hib0GKNpkm8MSUU/e2VNthDyBYxKWG+BftNYYcuEjXlyrSO637tidzMBXfE7sQm0INUg=="
            crossorigin="anonymous"
            referrerpolicy="no-referrer"
            />
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css" />
        <link rel="stylesheet" type="text/css" href="css/style.css" />
        <style type="text/css">
            .nav-tabs .nav-item.show .nav-link, .nav-tabs .slink.active, .tab-content .stab-pane.active {
            color: #000;
            background-color: #a1c699;
            border-color: #126a00  #fff #fff;
            }
        </style>
    </head>
    <body>
        <div class="container-fluid">
        <div class="row flex-nowrap">
		
		
		 <?php include('left_side_landing.php');?>    
          
			
			
			
            <div class="col py-3">
                <div class="row mb-4">
                    <div class="col-12 p-3">
                        <div class="d-flex justify-content-between border-bottom pb-2 mb-3">
                            <h4 class="float-start">Stock Movement Reports</h4>
                        </div>
                        <div class="row">
                            <div class="col-6 ">
                                 <div class="row justify-content-md-center border-top border-warning p-3">
                                    <div class="col-auto ">
                                        <div class="d-flex">
                                            <div class="mb-1" >
                                                <label class="form-label">Category From</label><br>
                                                <select class="form-control form-select js-example-basic-multiple  me-2" style="width:210px" name=" ">
												
												<?php

					
						$m = new _subcategory;
						$catid = 1;
						$result = $m->read($catid);

						if($result){

							while($rows = mysqli_fetch_assoc($result)){  


								?>
                                      <option   value="<?php echo ucwords(strtolower($rows['subCategoryTitle'])); ?>" ><?php echo ucwords(strtolower($rows["subCategoryTitle"])); ?></option>
                                 
								<?php
							}
						}
					?>
					
                                                    <!--<option value="1">1- Food</option>
                                                    <option value="2">2- Personal Care</option>
                                                    <option value="3">3- Home Use</option>-->
                                                </select>
                                            </div>
                                            <div class="mb-1" style="margin-left:9px">
                                                <label class="form-label">Category To</label><br>
                                                <select class="form-control  form-select js-example-basic-multiple" style="width:210px" name=" ">
												<?php

					
						$m = new _subcategory;
						$catid = 1;
						$result = $m->read($catid);

						if($result){

							while($rows = mysqli_fetch_assoc($result)){  


								?>
                                      <option   value="<?php echo ucwords(strtolower($rows['subCategoryTitle'])); ?>" ><?php echo ucwords(strtolower($rows["subCategoryTitle"])); ?></option>
                                 
								<?php
							}
						}
					?>
												
                                                   <!-- <option value="1">1- Food</option>
                                                    <option value="2">2- Personal Care</option>
                                                    <option value="3">3- Home Use</option>-->
                                                </select>
                                            </div>
                                        </div>
                                       <!-- <div class="d-flex">
                                            <div class="mb-1">
                                                <label class="form-label">Sub Category From</label>
                                                <select class="form-control form-select  me-2" style="width:210px" name=" ">
                                                    <option value="1">1- Food</option>
                                                    <option value="2">2- Personal Care</option>
                                                    <option value="3">3- Home Use</option>
                                                </select>
                                            </div>
                                            <div class="mb-1">
                                                <label class="form-label">Sub Category To</label>
                                                <select class="form-control   form-select " style="width:210px" name=" ">
                                                    <option value="1">1- Food</option>
                                                    <option value="2">2- Personal Care</option>
                                                    <option value="3">3- Home Use</option>
                                                </select>
                                            </div>
                                        </div>-->
                                        <div class="d-flex">
                                            <div class="mb-1" >
                                                <label class="form-label">Vendor From</label><br>
                                                <select class="form-control form-select js-example-basic-multiple  me-2" style="width:210px" name=" ">
												 <?php
					$p = new _pos;
					
							$result_1 = $p->read_supplier($_SESSION['uid']);
							
					if ($result_1) {
						$i = 1;
						while ($row_1 = mysqli_fetch_assoc($result_1)) {
							
							?>
                           <option value="<?php echo $row_1['id']; ?>"><?php echo $row_1['customer_name']; ?></option>
                          
						   
					<?php }} ?>
                                                    <!--<option value="1">1- Jhone</option>
                                                    <option value="2">2- Malik</option>
                                                    <option value="3">3- Adam</option>-->
                                                </select>
                                            </div>
                                            <div class="mb-1" style="margin-left:9px">
                                                <label class="form-label">Vendor To</label><br>
                                                <select class="form-control  form-select js-example-basic-multiple " style="width:210px" name=" ">
												 <?php
					$p = new _pos;
					
							$result_1 = $p->read_supplier($_SESSION['uid']);
							
					if ($result_1) {
						$i = 1;
						while ($row_1 = mysqli_fetch_assoc($result_1)) {
							
							?>
                           <option value="<?php echo $row_1['id']; ?>"><?php echo $row_1['customer_name']; ?></option>
                          
						   
					<?php }} ?>
                                                    <!--<option value="1">1- Jhone</option>
                                                    <option value="2">2- Malik</option>
                                                    <option value="3">3- Adam</option>-->
                                                </select>
                                            </div>
                                        </div>
                                        <div class="d-flex">
                                            <div class="mb-1">
                                                <label class="form-label">Item# From</label><br>
                                                <select class="form-control form-select js-example-basic-multiple  me-2" style="width:210px" name=" ">
												 <?php
					$pf = new _spprofiles;
					
							$result_1 = $pf->read_post_product($_SESSION['uid']);
							
					if ($result_1) {
						$i = 1;
						while ($row_1 = mysqli_fetch_assoc($result_1)) {
							
							?>
                           <option value="<?php echo $row_1['idspPostings ']; ?>"><?php echo $row_1['spPostingTitle']; ?></option>
                          
						   
					<?php }} ?>
                                                   <!-- <option value="1">1- apple</option>
                                                    <option value="2">2- milk</option>
                                                    <option value="3">3- lipstic</option>-->
                                                </select>
                                            </div>
                                            <div class="mb-1" style="margin-left:9px">
                                                <label class="form-label">Item# To</label><br>
                                                <select class="form-control  form-select js-example-basic-multiple " style="width:210px" name=" ">
												
												 <?php
					$pf = new _spprofiles;
					
							$result_1 = $pf->read_post_product($_SESSION['uid']);
							
					if ($result_1) {
						$i = 1;
						while ($row_1 = mysqli_fetch_assoc($result_1)) {
							
							?>
                           <option value="<?php echo $row_1['idspPostings ']; ?>"><?php echo $row_1['spPostingTitle']; ?></option>
                          
						   
					<?php }} ?>
												
                                                    <!--<option value="1">1- apple</option>
                                                    <option value="2">2- milk</option>
                                                    <option value="3">3- lipstic</option>-->
                                                </select>
                                            </div>
                                        </div>
                                       <div class="d-flex">
                                            <div class="mb-1">
                                                <label class="form-label">SalesPerson From</label><br>
                                                <!--<input type="text" class="form-control" required />-->
												 <select class="form-control form-select js-example-basic-multiple  me-2" style="width:210px" name=" ">
												 <?php
					$p = new _pos;
					
							$result_1 = $p->read_users($_SESSION['uid']);
							
					if ($result_1) {
						$i = 1;
						while ($row_1 = mysqli_fetch_assoc($result_1)) {
							
							?>
                           <option value="<?php echo $row_1['id']; ?>"><?php echo $row_1['user_name']; ?></option>
                          
						   
					<?php }} ?>
                                                    
                                                </select>
												
                                            </div>
                                            <div class="mb-1" style="margin-left:9px">
                                                <label class="form-label">SalesPerson To</label><br>
                                                <!--<input type="text" class="form-control" required />-->
												 <select class="form-control form-select js-example-basic-multiple  me-2" style="width:210px" name=" ">
												 <?php
					$p = new _pos;
					
							$result_1 = $p->read_users($_SESSION['uid']);
							
					if ($result_1) {
						$i = 1;
						while ($row_1 = mysqli_fetch_assoc($result_1)) {
							
							?>
                           <option value="<?php echo $row_1['id']; ?>"><?php echo $row_1['user_name']; ?></option>
                          
						   
					<?php }} ?>  

                                                </select>
                                            </div>
                                        </div>
                                        <button class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#attributesSelect"> Select Attribute</button>                                              
                                    </div>
                                </div>
                                <div class="row justify-content-md-center border-top border-warning p-3">
                                    <div class="col-auto ">  
                                        <div class="form-check form-check-inline">
                                          <input class="form-check-input" type="radio" id="inlineCheckbox1" name="base" value="saleAmount">
                                          <label class="form-check-label" for="inlineCheckbox1">Sales Amount</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                          <input class="form-check-input" type="radio" id="inlineCheckbox2" name="base"  value="qtySold">
                                          <label class="form-check-label" for="inlineCheckbox2">Qty Sold</label>
                                        </div>
                                        <div class="d-flex">
                                            <div class="mb-1">
                                                <label class="form-label">Item Sold</label>
                                                <select class="form-control form-select  me-2" style="width:210px" name=" ">
                                                    <option value="1">>=</option>
                                                    <option value="2"><=</option>
                                                </select>
                                            </div>
                                            <div class="mb-1">
                                                <label class="form-label">Category To</label>
                                                <select class="form-control   form-select " style="width:210px" name=" ">
                                                    <option value="1">0</option>
                                                    <option value="2">100</option>
                                                    <option value="3">1000</option>
                                                </select>
                                            </div>
                                        </div>                               
                                        <div class="d-flex">
                                            <div class="mb-3 me-2">
                                                <label class="form-label">Period From</label>
                                                <input type="date" style="width:210px;" class="form-control" required />
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Period To</label>
                                                <input type="date" style="width:210px;" class="form-control" required />
                                            </div>
                                        </div>  
                                    </div>
                                </div>                                
                            </div> 
                            <div class="col-6 border-top border-warning p-2">
                                <div class="row">
                                    <div class="col-6 ">  
                                        <div class="form-check form-check-inline">
                                          <input class="form-check-input" type="radio" id="detailCheckbox1" name="detailType" value="saleAmount">
                                          <label class="form-check-label" for="detailCheckbox1">Detail</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                          <input class="form-check-input" type="radio" id="summaryCheckbox2" name="detailType"  value="qtySold">
                                          <label class="form-check-label" for="summaryCheckbox2">Summary</label>
                                        </div>                                
                                        <div class="mb-3">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="ket_check" value="" required>
                                                <label class="form-check-label" for="ket_check">Qty Sold incl Kit Sold</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value=""  id="services_check" required>
                                                <label class="form-check-label" for="services_check">Incl Kit & Services Item</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="" id="sold_check" required>
                                                <label class="form-check-label" for="sold_check">Print Kit Sold</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="" id="supperess_check" required>
                                                <label class="form-check-label" for="supperess_check">Supperess Item with Sales & Stock</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="" id="cost_check" required>
                                                <label class="form-check-label" for="cost_check">Supperess Cost</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="" id="print_check" required>
                                                <label class="form-check-label" for="print_check">Print Cost</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="break_check" value="" required>
                                                <label class="form-check-label" for="break_check">Page Break Between Each Sorting</label>
                                            </div>
                                        </div>                                            
                                    </div>
                                    <div class="col-3">
                                        <div class="form-check">
                                          <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="option1" checked>
                                          <label class="form-check-label" for="exampleRadios1">
                                            On Hand
                                          </label>
                                        </div>
                                        <div class="form-check">
                                          <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios2" value="option2">
                                          <label class="form-check-label" for="exampleRadios2">
                                            Cut-off Date
                                          </label>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-check form-check-inline">
                                          <input class="form-check-input" type="checkbox" id="active_Checkbox1" name="detailType" value="saleAmount">
                                          <label class="form-check-label" for="active_Checkbox1">Active</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                          <input class="form-check-input" type="checkbox" id="discount_Checkbox1" name="detailType"  value="qtySold">
                                          <label class="form-check-label" for="discount_Checkbox1">Discountine</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                          <input class="form-check-input" type="checkbox" id="dormant_Checkbox1" name="detailType"  value="qtySold">
                                          <label class="form-check-label" for="dormant_Checkbox1">Dormant</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                          <input class="form-check-input" type="checkbox" id="future_Checkbox1" name="detailType"  value="qtySold">
                                          <label class="form-check-label" for="future_Checkbox1">Future</label>
                                        </div>
                                    </div>
                                    <div class="col-6 border-top border-5">
                                        <div class="form-check">
                                          <input class="form-check-input" type="radio" name="exampleRadios" id="category_Radios1" value="option1" checked>
                                          <label class="form-check-label" for="category_Radios1">
                                            Category/Subcategory
                                          </label>
                                        </div>
                                        <div class="form-check">
                                          <input class="form-check-input" type="radio" name="exampleRadios" id="vendor_Radios1" value="option2">
                                          <label class="form-check-label" for="vendor_Radios1">
                                            Vendor
                                          </label>
                                        </div>
                                        <div class="form-check">
                                          <input class="form-check-input" type="radio" name="exampleRadios" id="iteam_Radios1" value="option2">
                                          <label class="form-check-label" for="iteam_Radios1">
                                            Item
                                          </label>
                                        </div>
                                    </div>
                                    <div class="col-6 border-top border-5">
                                        <div class="form-check">
                                          <input class="form-check-input" type="radio" name="exampleRadios" id="description_Radios1" value="option1" checked>
                                          <label class="form-check-label" for="description_Radios1">
                                            Item Description
                                          </label>
                                        </div>
                                        <div class="form-check">
                                          <input class="form-check-input" type="radio" name="exampleRadios" id="iitaem_Radios1" value="option2">
                                          <label class="form-check-label" for="iitaem_Radios1">
                                           Item#
                                          </label>
                                        </div>
                                        <div class="form-check">
                                          <input class="form-check-input" type="radio" name="exampleRadios" id="sale_Radios1" value="option2">
                                          <label class="form-check-label" for="sale_Radios1">
                                           Net Sale
                                          </label>
                                        </div>
                                        <div class="form-check">
                                          <input class="form-check-input" type="radio" name="exampleRadios" id="price_Radios1" value="option2">
                                          <label class="form-check-label" for="price_Radios1">
                                           Unit Price
                                          </label>
                                        </div>
                                        <div class="form-check">
                                          <input class="form-check-input" type="radio" name="exampleRadios" id="price_Radios2" value="option2">
                                          <label class="form-check-label" for="price_Radios2">
                                           Price $
                                          </label>
                                        </div>
                                        <div class="form-check">
                                          <input class="form-check-input" type="radio" name="exampleRadios" id="price_Radios3" value="option2">
                                          <label class="form-check-label" for="price_Radios3">
                                           Price%
                                          </label>
                                        </div>
                                        <div class="form-check">
                                          <input class="form-check-input" type="radio" name="exampleRadios" id="sold_Radios3" value="option2">
                                          <label class="form-check-label" for="sold_Radios3">
                                           Qty Sold
                                          </label>
                                        </div>
                                        <div class="form-check">
                                          <input class="form-check-input" type="radio" name="exampleRadios" id="category_Radios3" value="option2">
                                          <label class="form-check-label" for="category_Radios3">
                                           Category/Subcategory
                                          </label>
                                        </div>
                                        <div class="form-check">
                                          <input class="form-check-input" type="radio" name="exampleRadios" id="vendor_Radios3" value="option2">
                                          <label class="form-check-label" for="vendor_Radios3">  
                                           Vendor
                                          </label>
                                        </div>
                                    </div>
                                </div>
                                <button class="btn btn-main float-end"><i class="fas fa-print"></i> Print</button>
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
        
        <!-- Modal Attributes Details -->
      <div class="modal fade" id="attributesSelect" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
         <div class="modal-dialog"> <!-- modal-xl -->
            <div class="modal-content">
               <div class="modal-header bg-success text-light">
                  <h5 class="modal-title" id="exampleModalLabel">Attribute List</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
               </div>
               <div class="modal-body">
                 
               </div>
               <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  <button type="button" class="btn btn-success">Save changes</button>
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
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    
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
            });
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
     
    </body>
</html>

<?php } ?>