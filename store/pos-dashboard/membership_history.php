

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
            <div class="row mb-4">
               <div class="col-12">
                  <h3>Membership History</h3> 
                 
                 <?php if($_GET['id']){  
					 //die('==');
					 ?>
                  <table id="table_id" class="display bg-light table-striped table-responsive" data-page-length='10'>
                     <thead>
                        <tr>
                           <th>Name</th>
                           <th>Price</th>
                           <!--<th>Color</th>
                           <th>Size</th>-->
                           <th>Quantity Left</th>
                           <th>Type</th>
						   <th>Biller Name</th>
                           <th>Date</th>
                           <!--<th>Purchase Price</th>
                           <th>Cost</th>
                           <th>Sale Price</th>-->
                           <!--<th>Action</th>--> 
                        </tr>
                     </thead>
                     <tbody>
					 <?php
					$p = new _pos;
					
							$result = $p->read_mem_bar_id($_SESSION['uid'],$_SESSION['pid'],$_GET['id']);  
							
					if ($result) {
						$i = 1;
						while ($row = mysqli_fetch_assoc($result)) {
						$id =	$row['barcode'];
						 $customer_id = $row['customer_id'];
						
						$res1 = $p->read_member_bar($id); 
              if($res1 == True){
	
                           $row_2 = mysqli_fetch_assoc($res1);
						  $name = $row_2['name_qty'];
						  $price = $row_2['price_qty'];
						 
						  
						 
						   
						   
			  }
			  
			  
			   $res2 = $p->read_peyment($customer_id); 
              if($res2 == True){
	
                           $row_3 = mysqli_fetch_assoc($res2);
						  $salesperson_id = $row_3['salesperson_id'];
						  
						$us1=$p->read_users_id($salesperson_id);
                   if($us1!=false){
		          $row_1 = mysqli_fetch_assoc($us1);
                    $user_name = ucfirst($row_1['user_name']);	 	
												  
	  }   
						   
			  }
							//echo "<pre>"; 
							//print_r($row); //die("--------------------------");
							
					?>
                        <tr>
                           <td><?php echo $name; ?></td>
                           <td><?php echo $row['currency']; ?> <?php echo $price; ?></td>
                           <!--<td>N/A</td>
                           <td>N/A</td>-->
                           <td><?php echo $row['quantity']; ?></td>
                           <td><?php echo $row['type']; ?></td>
                           <td>
						   <?php  echo $user_name; ?>
						   
						   </td>
                          <td><?php echo $row['date']; ?></td>
                          <!-- <td> %<?php echo $row['cost_in']; ?></td>
                           <td>$<?php echo $row['sellingPrice_in']; ?>.00</td>-->
                          <!-- <td>
						   <a href="<?php echo $BaseUrl.'/store/pos-dashboard/edit-product.php?postid='.$row['idspPostings']; ?>"><i class="fas fa-edit me-1"></i></a>|
					 <a onclick="deletefun(<?php echo $row['idspPostings']; ?>)" class="text-danger"> <i class="fas fa-trash"></i></a>  
						   </td>-->
                        </tr>
<?php }} ?>
                       
                     </tbody>
					 
					 
                  </table>
				  
				  <?php }else{
					  //die('==');
					  ?>
				  
				  <table id="table_id" class="display bg-light table-striped table-responsive" data-page-length='10'>
                     <thead>
                        <tr>
                           <th>Name</th>
                           <th>Price</th>
                           <!--<th>Color</th>
                           <th>Size</th>-->
                           <th>Quantity Left</th>
                           <th>Type</th>
						   <th>Biller Name</th>
                           <th>Date</th>
                           <!--<th>Purchase Price</th>
                           <th>Cost</th>
                           <th>Sale Price</th>-->
                           <!--<th>Action</th>-->
                        </tr>
                     </thead>
                     <tbody>
					 <?php
					$p = new _pos;
					
							$result = $p->read_mem_bar($_SESSION['uid'],$_SESSION['pid']);  
							
					if ($result) {
						$i = 1;
						while ($row = mysqli_fetch_assoc($result)) {
						$id =	$row['barcode'];
						 $customer_id = $row['customer_id'];
						
						$res1 = $p->read_member_bar($id); 
              if($res1 == True){
	
                           $row_2 = mysqli_fetch_assoc($res1);
						  $name = $row_2['name_qty'];
						  $price = $row_2['price_qty'];
						 
						  
						 
						   
						   
			  }
			  
			  
			   $res2 = $p->read_peyment($customer_id); 
              if($res2 == True){
	
                           $row_3 = mysqli_fetch_assoc($res2);
						  $salesperson_id = $row_3['salesperson_id'];
						  
						$us1=$p->read_users_id($salesperson_id);
                   if($us1!=false){
		          $row_1 = mysqli_fetch_assoc($us1);
                    $user_name = ucfirst($row_1['user_name']);	 	
												  
	  }   
						   
			  }
							//echo "<pre>"; 
							//print_r($row); //die("--------------------------");
							
					?>
                        <tr>
                           <td><?php echo $name; ?></td>
                           <td><?php echo $row['currency']; ?> <?php echo $price; ?></td>
                           <!--<td>N/A</td>
                           <td>N/A</td>-->
                           <td><?php echo $row['quantity']; ?></td>
                           <td><?php echo $row['type']; ?></td>
                           <td>
						   <?php  echo $user_name; ?>
						   
						   </td>
                          <td><?php echo $row['date']; ?></td>
                          <!-- <td> %<?php echo $row['cost_in']; ?></td>
                           <td>$<?php echo $row['sellingPrice_in']; ?>.00</td>-->
                          <!-- <td>
						   <a href="<?php echo $BaseUrl.'/store/pos-dashboard/edit-product.php?postid='.$row['idspPostings']; ?>"><i class="fas fa-edit me-1"></i></a>|
					 <a onclick="deletefun(<?php echo $row['idspPostings']; ?>)" class="text-danger"> <i class="fas fa-trash"></i></a>  
						   </td>-->
                        </tr>
<?php }} ?>
                       
                     </tbody>
					 
					 
                  </table>
				   <?php } ?>
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
 
</body>
</html>

<?php } ?>