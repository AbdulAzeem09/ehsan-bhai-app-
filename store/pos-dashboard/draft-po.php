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
$active = 6;
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
		 <?php  if($_GET['list']== 'all'){ ?>
            <div class="row mb-4">
               <div class="col-12">
                  <h3>Draft PO List</h3>
				  <form action="<?php echo $BaseUrl; ?>/store/pos-dashboard/receive-inventory-by-po.php?filter_data=filter" method="post">
                  <div class="row justify-content-md-center">
                      <div class="col-4 mb-3">
                        <label>Select Vendor</label>
                        <select class="form-control form-select js-example-basic-multiple" id="inputGroupSelect02" name="customer">
                           <option value="">All Vendors</option>
						    <?php
					$p = new _pos;
					
							$result = $p->read_supplier($_SESSION['uid']);
							
					if ($result) {
						$i = 1;
						while ($row = mysqli_fetch_assoc($result)) {
							
							?>
                           <option value="<?php echo $row['id']; ?>"><?php echo $row['customer_name']; ?></option>
                          
						   
					<?php }} ?>
					
                          <!-- <option value="2">Dave</option>
                           <option value="3">Yusha</option>-->
                        </select>
                     </div>
                     <div class="col-2 mb-3">
                        <label>Date From</label>
                        <input type="date" class="form-control" value="" name="start_date" placeholder="Choose Date Start"  aria-describedby="addon-wrapping">
                     </div>
                     <div class="col-2 mb-3">
                        <label>Date To</label>
                        <input type="date" class="form-control" value="" name="end_date" placeholder="Choose Date End"  aria-describedby="addon-wrapping">
                     </div>
                     <div class="col-2 mb-3">
                        <button type="submit" class="btn btn-main mt-4"><i class="fas fa-filter"></i> Show</button> 
                     </div>
					 
					 
                  </div> 
				  </form>
                  <div class="info"></div>
                  <table id="table_id" class="display bg-light table-striped table-responsive" data-page-length='10'>
                   <thead>
                    <tr>
                     <th>Create Date</th>
                     <th>PO#</th>
                     <th>Qty</th>
                     <th>Price</th>
                     <!-- <th>Discount</th>
                     <th>Size</th>
                     <th>Color</th> -->
                     <th>Action</th>
                  </tr>
               </thead>
               <tbody>
			   <?php 
			   $ps = new _pos;
			   $reult = $ps->get_all_by_po();
				if($reult->num_rows > 0){
					$i=1;
					while($row1 = mysqli_fetch_assoc($reult)){
			             $result = $ps->read_supplier_id($row1['vendor_id']); 
						 if ($result) {
                                                               
                      $row_1 = mysqli_fetch_assoc($result);
					  
					 $customer_name = $row_1['customer_name'];
					  
		                     }
						?>
                  <tr>
                     <td><?php echo $row1['receive_date'];?></td>
                     
                     <td><?php echo $row1['po'];?></td>
                     <td><?php echo $row1['quantity'];?></td>
                     <td><?php echo $row1['currency'];?>&nbsp;<?php echo $row1['amount'];?></td>
                  
                     <td><a href="#"><i class="fas fa-edit me-1"></i></a>| <a href="#" class="text-danger"> <i class="fas fa-trash"></i></a></td>
                  </tr>
				<?php }} ?>
				  
                  <!--<tr>
                     <td>02-09-2022</td>
                     <td>Jhone</td>
                     <td>inv-54547</td>
                     <td>po-23456</td>
                     <td>5</td>
                     <td>$1055</td>
                     <td>20-09-2022</td>
                     <td>Adam</td>
                     <td><i class="fas fa-check text-success"></i> Received</td>
                     <!--<td>N/A</td>
                     <td>N/A</td> 
                     <td><a href="#"><i class="fas fa-edit me-1"></i></a>| <a href="#" class="text-danger"> <i class="fas fa-trash"></i></a></td>
                  </tr>-->
                  
                  
               </tbody>
            </table>
         </div>
      </div>
		 <?php } ?>
		 
		 
		 
		 <?php  if($_GET['filter_data']== 'filter'){ ?>
            <div class="row mb-4">
               <div class="col-12">
                  <h3>Draft PO List</h3>
				  <form action="<?php echo $BaseUrl; ?>/store/pos-dashboard/receive-inventory-by-po.php?filter_data=filter" method="post">
                  <div class="row justify-content-md-center">
                      <div class="col-4 mb-3">
                        <label>Select Vendor</label>
                        <select class="form-control form-select js-example-basic-multiple" id="inputGroupSelect02" name="customer">
                           <option value="">All Vendors</option>
						    <?php
					$p = new _pos;
					
							$result = $p->read_supplier($_SESSION['uid']);
							
					if ($result) {
						$i = 1;
						while ($row = mysqli_fetch_assoc($result)) {
							
							?>
                           <option value="<?php echo $row['id']; ?>" <?php if($row['id'] == $_POST['customer']){ echo 'selected';} ?> ><?php echo $row['customer_name']; ?></option>
                          
						   
					<?php }} ?>
					
                          <!-- <option value="2">Dave</option>
                           <option value="3">Yusha</option>-->
                        </select>
                     </div>
                     <div class="col-2 mb-3">
                        <label>Date From</label>
                        <input type="date" class="form-control" name="start_date" value="<?php  echo $_POST['start_date']; ?>" placeholder="Choose Date Start"  aria-describedby="addon-wrapping">
                     </div>
                     <div class="col-2 mb-3">
                        <label>Date To</label>
                        <input type="date" class="form-control" name="end_date"  value="<?php  echo $_POST['end_date']; ?>" placeholder="Choose Date End"  aria-describedby="addon-wrapping">
                     </div>
                     <div class="col-2 mb-3">
                        <button type="submit" class="btn btn-main mt-4"><i class="fas fa-filter"></i> Show</button> 
                     </div>
					 
					 <div class="col-1 mb-3">
                        <a href="receive-inventory-by-po.php?list=all"  class="btn btn-secondary mt-4">Reset</a> 
                     </div>
					 
                  </div> 
				  </form>
                  <div class="info"></div>
                  <table id="table_id" class="display bg-light table-striped table-responsive" data-page-length='10'>
                   <thead>
                    <tr>
                    <th>Create Date</th>
                     <th>PO#</th>
                     <th>Qty</th>
                     <th>Price</th>
                     <!-- <th>Discount</th>
                     <th>Size</th>
                     <th>Color</th> -->
                     <th>Action</th>
                  </tr>
               </thead>
               <tbody>
			   <?php 
			   
			   $ps = new _pos;
			   
			  $customer = $_POST['customer'];
			 $start_date =   $_POST['start_date'];
		     $end_date =  $_POST['end_date']; 
			 if($customer != '' && $start_date != '' && $end_date != '' ){
				 
			   $reult = $ps->get_all_by_po_filter($customer,$start_date,$end_date); 
			   
			 }
			 
			 elseif($customer != ''){
				 
			   $reult = $ps->get_all_by_po_customer($customer); 
			   
			 }
			 
				if($reult->num_rows > 0){
					$i=1;
					while($row1 = mysqli_fetch_assoc($reult)){
			             $result = $ps->read_supplier_id($row1['vendor_id']); 
						 if ($result) {
                                                               
                      $row_1 = mysqli_fetch_assoc($result);
					  
					 $customer_name = $row_1['customer_name'];
					  
		                     }
						?>
                  <tr>
                     <td><?php echo $row_1['receive_date'];?></td>
                     
                     <td><?php echo $row_1['po'];?></td>
                     <td><?php echo $row_1['quantity'];?></td>
                     <td><?php echo $row_1['currency'];?>&nbsp;<?php echo $row_1['amount'];?></td>
                  
                     <td><a href="#"><i class="fas fa-edit me-1"></i></a>| <a href="#" class="text-danger"> <i class="fas fa-trash"></i></a></td>
                  </tr>
				<?php }} ?>
				  
                  <!--<tr>
                     <td>02-09-2022</td>
                     <td>Jhone</td>
                     <td>inv-54547</td>
                     <td>po-23456</td>
                     <td>5</td>
                     <td>$1055</td>
                     <td>20-09-2022</td>
                     <td>Adam</td>
                     <td><i class="fas fa-check text-success"></i> Received</td>
                     <!--<td>N/A</td>
                     <td>N/A</td> 
                     <td><a href="#"><i class="fas fa-edit me-1"></i></a>| <a href="#" class="text-danger"> <i class="fas fa-trash"></i></a></td>
                  </tr>-->
                  
                  
               </tbody>
            </table>
         </div>
      </div>
		 <?php } ?>

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
</body>
</html>


<?php } ?>