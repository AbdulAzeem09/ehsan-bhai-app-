

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
   <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
   <div class="container-fluid">
      <div class="row flex-nowrap">
	  
	  
        <?php include('left_side_landing.php');?>        
		 
		 
         <div class="col py-3">
		 <?php if($_GET['key']== 'all'){ ?>
            <div class="row mb-4">
               <div class="col-12">
			    <?php if($_SESSION['msg']=="1"){  unset($_SESSION['msg']); ?>
		<div class="alert alert-success" id="success" role="alert">Submitted Product
  Successfully .
</div>	   
			   
			   <?php } ?>
			   
			   <?php if($_SESSION['msg']=="2"){ unset($_SESSION['msg']); ?>
		<div class="alert alert-success" id="p_success" role="alert">
     Updated Product   
  Successfully . 
</div>	   
			   
			   <?php } ?> 
			   
                  <h3>Product List</h3>
                   <a href="add-product.php" class="nav-link pull-right" style="text-align: end;margin-bottom: -42px;"><button class="btn btn-main text-light" type="submit"style="margin-top: -4px;">Add Product</button>  </a>
                        <!-- <button type="submit" class="btn btn-main"> Add product </button>-->
                     				   
				  <form action="<?php echo $BaseUrl; ?>/store/pos-dashboard/product-list.php?filter_data=filter" method="post" >
                  <div class="row mobile-view mb-3">
                     <div class="col-auto">                      
                        <input type="text" class="form-control" placeholder="Keyword" value="" name="keyword" aria-label="keyword" aria-describedby="addon-wrapping">
                     </div>
                     <div class="col-auto">                      
                        <select class="form-control form-select js-example-basic-multiple mb-3 me-2" id="inputGroupSelect02" name="supplier_name">
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
                          
                        </select>
                     </div>
                     <div class="col-auto">
                        
                        <select class="form-control form-select js-example-basic-multiple mb-3 me-2" id="inputGroupSelect02" name="category_name" style="width:80%">
                           <option value="">Select by Category</option>
						    <?php

					
						$m = new _subcategory;
						$catid = 1;
						$results = $m->read($catid);

						if($results){

							while($rows = mysqli_fetch_assoc($results)){  


								?>
                                      <option   value="<?php echo ucwords(strtolower($rows['subCategoryTitle'])); ?>" ><?php echo ucwords(strtolower($rows["subCategoryTitle"])); ?></option>
                                 
								<?php
							}
						}
					?>
                          <!-- <option value="">Main</option>
                           <option value="">Food</option>
                           <option value="">Cloths</option>-->
                        </select>
                       
                     </div>
					 
                     <div class="col-auto" style="display: block ruby;">
                         <button style="margin-left: -85px;margin-top: -4px;" type="submit" class="btn btn-main text-light" data-bs-toggle="modal" data-bs-target="#filter"> <i class="fas fa-filter"></i> Filter </button>
						 
						 
					 </div>
					 
					 
					  
                   
                     
                  </div> 
				 
				  </form>
				  
                  <div class="info"></div>
                  <table id="table_id" class="display bg-light table-striped table-responsive" data-page-length='10'>
                     <thead>
                        <tr>
                           <th>Barcode</th>
                           <th>Product Name</th>
                           <!--<th>Color</th>
                           <th>Size</th>-->
                           <th>Quantity</th>
                           <th>Purchase Price</th>
                           <th>Cost</th>
                           <th>Sale Price</th>
                           <th>Action</th>
                        </tr>
                     </thead>
                     <tbody>
					 <?php
					$p = new _spprofiles;
					
							$result = $p->read_post_product_pos($_SESSION['uid'],$_SESSION['pid']);  
							
					if ($result) {
						$i = 1;
						while ($row = mysqli_fetch_assoc($result)) {
							
							//echo "<pre>"; 
							//print_r($row); //die("--------------------------");
							
					?>
                        <tr>
                           <td><?php echo $row['barcode']; ?></td>
                           <td><?php echo $row['spPostingTitle']; ?></td>
                           <!--<td>N/A</td>
                           <td>N/A</td>-->
                           <td><?php echo $row['minorderqty']; ?></td>
                           <td><?php echo $row['default_currency']; ?>&nbsp;<?php echo $row['spPostingPrice']; ?></td>
                           <td> <?php echo $row['default_currency']; ?>&nbsp;<?php echo $row['cost_in']; ?></td>
                           <td><?php echo $row['default_currency']; ?>&nbsp;<?php echo $row['sellingPrice_in']; ?>.00</td>
                           <td>
						   <a href="<?php echo $BaseUrl.'/store/pos-dashboard/edit-product.php?postid='.$row['idspPostings']; ?>"><i class="fas fa-edit me-1"></i></a>|
					 <a onclick="deletefun(<?php echo $row['idspPostings']; ?>)" class="text-danger"> <i class="fas fa-trash"></i></a>  
						   </td>
                        </tr>
<?php }} ?>
                        <!--<tr>
						
                           <td>|||||||||||</td>
                           <td>Apple</td>
                          <!-- <td>N/A</td>
                           <td>1kg</td
                           <td>1</td>
                           <td>$10</td>
                           <td> %5 </td>
                           <td>$10.00</td>
                           <td><a href="edit-product.php"><i class="fas fa-edit me-1"></i></a>| <a href="#" class="text-danger"> <i class="fas fa-trash"></i></a> </td>
                        </tr>-->
                     </tbody>
                  </table>
               </div>
            </div>
		 <?php } ?>
			<?php 
			if(isset($_GET['filter_data']) == 'filter'){?>
			
			 <div class="row mb-4">
               <div class="col-12">
                  <h3>Product List</h3>
                 <form action="<?php echo $BaseUrl; ?>/store/pos-dashboard/product-list.php?filter_data=filter" method="post" >
                  <div class="row mobile-view mb-3">
                     <div class="col-auto">                      
                        <input type="text" class="form-control" placeholder="Keyword" value="<?php echo $_POST['keyword'];?>" name="keyword" aria-label="keyword" aria-describedby="addon-wrapping">
                     </div>
                     <div class="col-auto">                      
                        <select class="form-control form-select js-example-basic-multiple mb-3 me-2" id="inputGroupSelect02" name="supplier_name">
                           <option value="">Select Supplier name</option>
						   <?php
					$p = new _pos;
					
							$result_2 = $p->read_supplier($_SESSION['uid']);
							
					if ($result_2) {
						$i = 1;
						while ($row_2 = mysqli_fetch_assoc($result_2)) {
							
							?>
                           <option value="<?php echo $row_2['id']; ?>" <?php if($row_2['id'] == $_POST['supplier_name']){ echo "selected" ;} ?> ><?php echo $row_2['customer_name']; ?></option>
                          
						   
					<?php }} ?>
                          
                        </select>
                     </div>
                     <div class="col-auto">
                        
                        <select class="form-control form-select js-example-basic-multiple mb-3 me-2" id="inputGroupSelect02" name="category_name">
                           <option value="">Select by Category</option>
						    <?php

					
						$m = new _subcategory;
						$catid = 1;
						$results = $m->read($catid);

						if($results){

							while($rows = mysqli_fetch_assoc($results)){  


								?>
                                      <option   value="<?php echo ucwords(strtolower($rows['subCategoryTitle'])); ?>" <?php if($_POST['category_name'] == ucwords(strtolower($rows['subCategoryTitle']))){ echo "selected" ;} ?> ><?php echo ucwords(strtolower($rows["subCategoryTitle"])); ?></option> 
                                 
								<?php
							}
						}
					?>
                          <!-- <option value="">Main</option>
                           <option value="">Food</option>
                           <option value="">Cloths</option>-->
                        </select>
                       
                     </div>
                     <div class="col-auto">
                         <button type="submit" class="btn btn-main text-light" data-bs-toggle="modal" data-bs-target="#filter"> <i class="fas fa-filter"></i> Filter </button>
                     </div>
					 
					 <div class="col-auto">
                        <a href="product-list.php?key=all"  class="btn btn-secondary">Reset</a>  
                     </div>
                     
                     
                  </div> 
				  </form>
				  
                  <div class="info"></div>
                  <table id="table_id" class="display bg-light table-striped table-responsive" data-page-length='10'>
                     <thead>
                        <tr>
                           <th>Barcode</th>
                           <th>Product Name</th>
                           <!--<th>Color</th>
                           <th>Size</th>-->
                           <th>Quantity</th>
                           <th>Purchase Price</th>
                           <th>Cost</th>
                           <th>Sale Price</th>
                           <th>Action</th>
                        </tr>
                     </thead>
                     <tbody>
					 <?php
					$p = new _spprofiles;
					
					 $keyword = $_POST['keyword'];
					 $supplier_name = $_POST['supplier_name'];
					 $category_name = $_POST['category_name']; 
					
					if($keyword !='' && $supplier_name !='' && $category_name !='' ){ 
					
							$result = $p->read_post_product_pos_filter($_SESSION['uid'],$_SESSION['pid'],$keyword,$supplier_name,$category_name);  
					}
					elseif($keyword !=''){  
						$result = $p->read_post_product_pos_filter_byKeyword($_SESSION['uid'],$_SESSION['pid'],$keyword); 
					}
					
					elseif($supplier_name !=''){  
						$result = $p->read_post_product_pos_filter_bySupplier($_SESSION['uid'],$_SESSION['pid'],$supplier_name); 
					}
					
					elseif($category_name !=''){  
						$result = $p->read_post_product_pos_filter_byCategory($_SESSION['uid'],$_SESSION['pid'],$category_name); 
					}
					
					if ($result) {
						$i = 1;
						while ($row = mysqli_fetch_assoc($result)) {
							
							//echo "<pre>"; 
							//print_r($row); //die("--------------------------");
							
					?>
                        <tr>
                           <td><?php echo $row['barcode']; ?></td>
                           <td><?php echo $row['spPostingTitle']; ?></td>
                           <!--<td>N/A</td>
                           <td>N/A</td>-->
                           <td><?php echo $row['minorderqty']; ?></td>
                           <td><?php echo $row['default_currency']; ?>&nbsp;<?php echo $row['spPostingPrice']; ?></td>
                           <td> <?php echo $row['default_currency']; ?>&nbsp;<?php echo $row['cost_in']; ?></td>
                           <td><?php echo $row['default_currency']; ?>&nbsp;<?php echo $row['sellingPrice_in']; ?>.00</td>
                           <td>
						   <a href="<?php echo $BaseUrl.'/store/pos-dashboard/edit-product.php?postid='.$row['idspPostings']; ?>"><i class="fas fa-edit me-1"></i></a>|
					 <a onclick="deletefun(<?php echo $row['idspPostings']; ?>)" class="text-danger"> <i class="fas fa-trash"></i></a>  
						   </td>
                        </tr>
<?php }} ?>
                        <!--<tr>
						
                           <td>|||||||||||</td>
                           <td>Apple</td>
                          <!-- <td>N/A</td>
                           <td>1kg</td
                           <td>1</td>
                           <td>$10</td>
                           <td> %5 </td>
                           <td>$10.00</td>
                           <td><a href="edit-product.php"><i class="fas fa-edit me-1"></i></a>| <a href="#" class="text-danger"> <i class="fas fa-trash"></i></a> </td>
                        </tr>-->
                     </tbody>
                  </table>
               </div>
            </div>
			
			<?php 
}
			?>
			
			

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
       var table = $('#table_id').dataTable( );

    } );
 </script>
 
 <script src="<?php echo $baseurl?>/assets/js/sweetalert.js"></script>  
<script type="text/javascript">
   function deletefun(id){ 
	
 var my_path1 = $("#my_path1").val();
   
	 Swal.fire({
      title: 'Are you sure?',
      text: "It will deleted permanently !",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
      if (result.isConfirmed) {
         $.ajax({
			type: "GET",
			url: "delete_product.php",
			data: {postid:id}, 
			success: function(response){
				
            window.location.href = "product-list.php";    
			
			}

			});
      }
    })  
	
	
	
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