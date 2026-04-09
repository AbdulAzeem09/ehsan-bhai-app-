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
            <div class="row mb-4">
               <div class="col-12">
                  <div class="d-flex flex-row justify-content-between mb-3">
                     <h3>Edit Product</h3>
                     <div class="float-end">
                        <button type="submit" form="addProduct" class="btn btn-main float-end"><i class="fas fa-save"></i> Update</button>                       
                     </div>
                  </div>
				  
				  <?php
					$p = new _spprofiles;
					
							$result = $p->readprice_1($_GET['postid']);  
							
					if ($result) {
						$i = 1;
						while ($row = mysqli_fetch_assoc($result)) {

                        // print_r($row); 							?>
							
        
                  <form action="<?php echo $BaseUrl; ?>/store/pos-dashboard/update-product-detail.php" method="post" enctype="multipart/form-data" class="" id="addProduct">
                     <div class="row">
					  <input type="hidden" name="id" value="<?php echo $_GET['postid']; ?>">  
                        <div class="col-md-8 col-sm-12 mb-3">
                           <div class="d-flex mobile-view">                              
                              <input type="text" class="form-control shadowBox mb-3 me-2" id="itemNo" value="<?php echo $row['itemNo_in'];?>" name="itemNo_in" placeholder="Item No"  >
							 
                              <input type="datetime-local" class="form-control shadowBox mb-3 me-2"  name="date_in" id="Date" placeholder="Date" value="<?php echo $row['spPostingDate'];?>"  >
                              <div class="form-check mx-2">
							  
                                 <input class="form-check-input" type="checkbox" <?php if($row['gst_in'] == 1) { echo "checked"; }?> value="<?php echo $row['gst_in'];?>" name="gst_in"  id="gst" >
							 
							 
                                 <label class="form-check-label" for="gst">GST</label>
								 
                              </div>  
                              <div class="form-check mx-2">
							 
                                 <input class="form-check-input"  <?php if($row['pst_in'] == 1) { echo "checked"; }?> type="checkbox"  value="1" name="pst_in" id="pst" >
								 
                                 <label class="form-check-label" for="pst">PST</label>
                              </div>                              
                           </div>
                           <input type="text" class="form-control shadowBox mb-3" id="productname" name="productname_in" placeholder="Product Name" value="<?php echo $row['spPostingTitle'];?>" >
                           <div class="d-flex mobile-view">
                              <select class="form-control form-select shadowBox mb-3 me-2" id="attributes" name="attributes_in">
                                 <option value="uncategories" selected>Select attributes</option>
                                 <option value="Fruits" <?php if($row['attributes_in'] == "Fruits"){ echo "selected" ;} ?> >Color</option>
                                 <option value="Vegetables" <?php if($row['attributes_in'] == "Vegetables"){ echo "selected" ;} ?>>Size</option>
                                 <option value="General" <?php if($row['attributes_in'] == "General"){ echo "selected" ;} ?> >Weight</option>
                              </select>  
                              <input type="text" class="form-control shadowBox mb-3 me-2" id="atValue" name="atValue_in" placeholder="Set Att Value" value="<?php echo $row['atValue_in'];?>" required>

                              <select class="form-control form-select shadowBox mb-3 me-2" id="product-cat" name="product_cat_in">
							  
							   <?php

					
						$m = new _subcategory;
						$catid = 1;
						$result = $m->read($catid);

						if($result){

							while($rows = mysqli_fetch_assoc($result)){  


								?>
                                      <option   value="<?php echo ucwords(strtolower($rows['subCategoryTitle'])); ?>" <?php if($row['subcategory'] == ucwords(strtolower($rows['subCategoryTitle']))){ echo "selected" ;} ?> ><?php echo ucwords(strtolower($rows["subCategoryTitle"])); ?></option>
                                 
								<?php
							}
						}
					?>
							  
                                <!-- <option value="uncategories" selected>Select Category</option>
                                 <option value="Fruits" <?php if($row['product_cat_in'] == "Fruits"){ echo "selected" ;} ?> >Fruits</option>
                                 <option value="Vegetables" <?php if($row['product_cat_in'] == "Vegetables"){ echo "selected" ;} ?> >Vegetables</option>
                                 <option value="General" <?php if($row['product_cat_in'] == "General"){ echo "selected" ;} ?> >General</option>-->
                              </select>                        
                             <!-- <select class="form-control form-select shadowBox mb-3" id="product-sub-cat" name="product_sub_cat_in">
                                 <option value="uncategories" selected>Select Sub Category</option>
                                 <option value="dryFruits" <?php if($row['product_sub_cat_in'] == "dryFruits"){ echo "selected" ;} ?> >Dray Fruits</option>
                                 <option value="Fresh Fruit" <?php if($row['product_sub_cat_in'] == "Fresh Fruit"){ echo "selected" ;} ?> >Fresh Fruits</option>
                                 <option value="Import Fruits Item" <?php if($row['product_sub_cat_in'] == "Import Fruits Item"){ echo "selected" ;} ?> >Import Fruit Items</option>
                              </select> -->                   
                           </div> 
                           <div class="d-flex mobile-view">                              
                              <select class="form-control form-select shadowBox mb-3 me-2" id="proType" name="product_type_in">
                                 <option value="uncategories" selected>Select Product Type</option>
                                 <option value="1" <?php if($row['product_type'] == "1"){ echo "selected" ;} ?> >Type 1</option>
                                 <option value="2" <?php if($row['product_type'] == "2"){ echo "selected" ;} ?> >Type 2</option>
                                 <option value="3" <?php if($row['product_type'] == "3"){ echo "selected" ;} ?> >Type 3</option>
                              </select>    
                             <!-- <select class="form-control form-select shadowBox mb-3" id="status" name="status_in">
                                 <option value="uncategories" selected>Select Status Type</option>
                                 <option value="1 " <?php if($row['Status'] == "1"){ echo "selected" ;} ?>>Active</option>
                                 <option value="0" <?php if($row['Status'] == "0"){ echo "selected" ;} ?> >In Active</option>
                              </select>  -->                                          
                           </div> 
                           <textarea class="form-control shadowBox mb-3" id="s-description" name="s_description_in" rows="2" maxlength="300" placeholder="Short Description"><?php echo $row['s_description_in'] ?></textarea>
                           <textarea class="form-control shadowBox mb-3" id="l-description" name="l_description_in" rows="4" placeholder="Long Description"><?php echo $row['l_description_in'] ?></textarea>
                        </div>
                        <div class="col-md-4 col-sm-12 mb-3 text-center">  
                           <div class="border py-3 px-3 mb-5">
						  <!-- <img src="" class="img-sm img-fluid img-thumbnail mb-2" id= "preview_img"> -->
						  <?php
$pf = new _productpic;
					
							$result_1 = $pf->read($_GET['postid']);  
							
					if ($result_1) {
						$i = 1;
						$row_1 = mysqli_fetch_assoc($result_1); 
                              $file = $row_1['spPostingPic'];
						}
						  ?>
						  
                        <?php if($file){ ?>
                              <img src="<?php echo $BaseUrl.'/store/pos-dashboard/upload_pos/'.$file; ?>" class="img-sm img-fluid img-thumbnail mb-2" id= "preview_img" >  
						   <?php }else{ ?>
                                	<img src="<?php echo $BaseUrl.'/assets/images/icon/blank-img.png'; ?>" class="img-sm img-fluid img-thumbnail mb-2" style="height:220px" id= "preview_img" > 
						   <?php } ?>	
						   </div>                         
                           <input type="file" class="form-control shadowBox" name="productimage"  id="image_file">
						   <input type="hidden" name="hidden_file" value="<?php echo $file; ?>">  
                        </div>                        
                     </div>
                     <div class="col-12">
                        <div class="tab-container-one">
                           <ul class="nav nav-tabs" id="myTab" role="tablist">
                              <li class="nav-item active">
                                 <a class="nav-link active" href="#pirce-n-cost" role="tab" aria-controls="pirce-n-cost" data-bs-toggle="tab">Price & Cost</a>
                              </li> 
                              <li class="nav-item">
                                 <a class="nav-link" href="#vendors" role="tab" aria-controls="vendors" data-bs-toggle="tab">Vendors</a>
                              </li>
                              <li class="nav-item">
                                 <a class="nav-link" href="#barcode" role="tab" aria-controls="barcode" data-bs-toggle="tab">Barcode</a>
                              </li>
                              <li class="nav-item">
                                 <a class="nav-link" href="#note" role="tab" aria-controls="note" data-bs-toggle="tab">Note</a>
                              </li>
                           </ul>
                           <div class="tab-content">
                              <div class="tab-pane active" id="pirce-n-cost" role="tabpanel" aria-labelledby="pirce-n-cost-tab">
                                 <div class="row mobile-view">
                                    <div class="col-auto mb-3">
                                       <label class="form-check-label" for="invalidCheck2">Purchase Cost</label>
                                       <input type="text" class="form-control mb-3" id="cost" name="purchase_cost_in" placeholder="Cost" value="<?php echo $row['spPostingPrice']; ?>">
                                    </div>
                                    <div class="col-auto mb-3"> 
                                       <label class="form-check-label" for="invalidCheck2">Markup</label>                             
                                       <input type="text" class="form-control mb-3" value="<?php echo $row['markup_in']; ?>" id="markup" name="markup_in" placeholder="Markup" >
                                    </div>
                                    <div class="col-auto mb-3">   
                                       <label class="form-check-label" for="invalidCheck2">Selling Price</label>
                                       <input type="text" class="form-control mb-3" id="sellingPrice" name="sellingPrice_in" placeholder="Selling Price" value="<?php echo $row['sellingPrice_in']; ?>">
                                    </div>
                                    <div class="col-auto mb-3">   
                                       <label class="form-check-label" for="invalidCheck2">Gross Profit</label>
                                       <input type="text" class="form-control mb-3" id="grossprofit" name="grossprofit_in" placeholder="Gross Profit" value="<?php echo $row['grossprofit_in']; ?>">
                                    </div>
                                    
                                    <div class="col-auto d-flex flex-column mb-3 mt-3">
                                       <div class="form-check mx-2">
									    
                                          <input class="form-check-input" <?php if($row['retailDiscount'] == 1) { echo "checked"; }?>  type="checkbox" value="1" id="discountable" name="discountable_in" >
										
										
                                          <label class="form-check-label" for="discountable">Discountable</label>
                                       </div>                                      
                                       <div class="form-check mx-2">
									  
                                          <input class="form-check-input" <?php if($row['funcationQty_in'] == 1) { echo "checked"; }?>  type="checkbox" value="1" name="funcationQty_in" id="funcationQty" >
										 
                                          <label class="form-check-label" for="funcationQty">Fucntional Qty</label>
                                       </div>  
                                    </div>                                     
                                 </div>
                              </div>
                              <div class="tab-pane" id="vendors" role="tabpanel" aria-labelledby="vendors-tab">
                                <div class="row mobile-view">
                                 <div class="col-md-3 col-sm-12 mb-3">
                                    <label class="form-check-label" for="invalidCheck2">Price</label>
                                    <input type="text" class="form-control mb-3 me-2" id="pirce" name="pirce_in" placeholder="Price" value="<?php echo $row['pirce_in']; ?>">
                                 </div>
                                 <div class="col-md-3 col-sm-12 mb-3"> 
                                    <label class="form-control-label" for="invalidCheck2">Vendor</label>
                                    <!--<input type="text" class="form-control mb-3 me-2" id="vendor" name="vendor_in" placeholder="Vendor" value="<?php echo $row['vendor_in']; ?>">-->
					<select class="form-control form-select  mb-3 me-2" id="vendor" name="vendor_in">
                           <option selected>Select Supplier name</option>
						   <?php
					$p = new _pos;
					
							$result_1 = $p->read_supplier($_SESSION['uid']);
							
					if ($result_1) {
						$i = 1;
						while ($row_1 = mysqli_fetch_assoc($result_1)) {
							
							?>
                           <option value="<?php echo $row_1['id']; ?>" <?php if($row_1['id'] == $row['vendor_in']){ echo "selected" ;} ?> ><?php echo $row_1['customer_name']; ?></option> 
                          
						   
					<?php }} ?>
                          
                        </select>
									
                                 </div>
                                 <div class="col-md-3 col-sm-12 mb-3">   
                                    <label class="form-check-label" for="invalidCheck2">Name</label>
                                    <input type="text" class="form-control mb-3 me-2" id="name" name="name_in" placeholder="Name" value="<?php echo $row['name_in']; ?>">
                                 </div>
                                 <div class="col-md-3 col-sm-12 mb-3">   
                                    <label class="form-check-label" for="invalidCheck2">Cost</label>
                                    <input type="text" class="form-control mb-3 me-2" id="cost" name="cost_in" placeholder="Cost" value="<?php echo $row['cost_in']; ?>" >
                                 </div>
                                 <div class="col-md-4 col-sm-12 mb-3">
                                    <label class="form-check-label" for="invalidCheck2">Min ReOrder</label>
                                    <input type="text" class="form-control mb-3 me-2" id="minReorder" name="minReorder_in" placeholder="Min Reorder" value="<?php echo $row['minorderqty']; ?>"> 
                                 </div>                                      
                                 <div class="col-md-4 col-sm-12 mb-3">
                                    <label class="form-check-label" for="invalidCheck2">Last Receive Cost</label>
                                    <input type="text" class="form-control mb-3 me-2 disabled"  id="lastReceiveCost" name="lastReceiveCost_in" placeholder="Last Receive Cost" value="<?php echo $row['lastReceiveCost_in']; ?>">
                                 </div>                                      
                                 <div class="col-md-4 col-sm-12 mb-3">
                                    <label class="form-check-label" for="invalidCheck2">Last Receive Date</label>
                                    <input type="datetime-local" class="form-control mb-3 disabled"  id="lastReceiveDate" name="lastReceiveDate_in" placeholder=" Last Receive Date" value="<?php echo $row['spPostingExpDt']; ?>">
                                 </div>  
                              </div>                                                        
                           </div>
                           <div class="tab-pane" id="barcode" role="tabpanel" aria-labelledby="barcode-tab">
                              <div class="row mobile-view">
                               <div class="col-md-6 col-sm-12 mb-3">
                                  <label class="form-check-label" for="invalidCheck2">Barcode</label>
                                  <input type="text" class="form-control shadowBox mb-3 me-2" id="barcode" name="barcode_in" placeholder="Barcode" value="<?php echo $row['barcode']; ?>">
                               </div>                               
                            </div>
                         </div>
                         <div class="tab-pane" id="note" role="tabpanel" aria-labelledby="note-tab">
                           <div class="row mobile-view">
                              <div class="col-auto col-sm-12 mb-3">
                                 <label class="form-check-label" for="invalidCheck2">Note</label>
                                 <textarea class="form-control" id="notes" name="notes_in" rows="3"><?php echo $row['spPostingNotes']; ?></textarea>  
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </form>
			
					<?php }} ?>

         </div>
      </div>
      <div class="row">

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
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

<script src="js/data.js"></script>
<script src="js/custom-chart.js"></script>
<script type="text/javascript">
   $(document).ready( function () {
    var table = $('#table_id').dataTable( );

 } );
</script>
<script type="text/javascript">
   $(document).ready(function() {
     $('.js-example-basic-multiple').select2();
  });
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