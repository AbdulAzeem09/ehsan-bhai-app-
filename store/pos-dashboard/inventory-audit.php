
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

if(isset($_GET['action'])=='delete'){ 
	
	
	$p = new _pos;  


$postid = $_GET['id'];


$res = $p->remove_invt_audit($postid);  

$_SESSION['msg'] = 1;	
?>

<script>
window.location.href = "<?php echo $BaseUrl.'/store/pos-dashboard/inventory-audit.php'; ?>";

</script>
<?php
 
}

?>


<?php 

if(isset($_POST['update'])){ 
	
	
	//print_r($_POST); die();
	$id = $_POST['id'];
	$barcode = $_POST['barcode'];
	$product_name = $_POST['product_name'];
	$color = $_POST['color'];  
	$size = $_POST['size'];
	$quantity = $_POST['quantity'];
	$purchase_price = $_POST['purchase_price'];
	$cost = $_POST['cost'];
	
	
	$data = array(
	              "barcode" => $barcode,
	              "product_name" => $product_name,
	              "color" => $color,
	              "size" => $size,
	              "quantity" => $quantity,
	              "purchase_price" => $purchase_price,
	              "cost" => $cost,
	               
	              
	
	);
	
	$pf = new _pos; 
					
	$res = $pf->update_invt_aduit($data,$id);       
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
            <div class="row mb-4">
               <div class="col-12">
			   
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
			   
                  <h3>Inventory Auidt</h3>
                  <div class="border-3 border-primary border-top p-1 bg-light shadowBox">
                     <div class="row mobile-view mb-3">

                        <div class="col-3 mb-2">                     
                           <label>Txn From</label>                      
                           <input type="date" class="form-control" placeholder="Date" aria-label="date" aria-describedby="addon-wrapping"required >
                        </div>
                        <div class="col-3 mb-2">                      
                           <label>Txn To</label>                      
                           <input type="date" class="form-control" placeholder="Date" aria-label="date" aria-describedby="addon-wrapping" required >
                        </div>
                        <div class="col-3 mb-2">                     
                           <label>Entry From</label>                      
                           <input type="date" class="form-control" placeholder="Date" aria-label="date" aria-describedby="addon-wrapping" required >
                        </div>
                        <div class="col-3 mb-2">                      
                           <label>Entry To</label>                      
                           <input type="date" class="form-control" placeholder="Date" aria-label="date" aria-describedby="addon-wrapping" required >
                        </div>
                        <div class="col-4">                     
                           <label>Inv# From</label>                      
                           <input type="text" class="form-control" placeholder="Inv From" aria-label="InvFrom" aria-describedby="addon-wrapping" required >
                        </div>
                        <div class="col-4">                      
                           <label>Inv# To</label>                      
                           <input type="text" class="form-control" placeholder="Inv To" aria-label="Invto" aria-describedby="addon-wrapping" required >
                        </div>  
                        <div class="col-4">
                           <label>Type</label>
                           <select class="form-control mb-3 form-select js-example-basic-multiple" id="inputGroupSelect02" name="type[]" multiple="multiple" required >
                              <option value="">All</option>
                              <option value="">Receive / Return</option>
                              <option value="">Inventory Adjustment</option>
                              <option value="">Cost Adjustment</option>
                              <option value="">Physical Count</option>
                           </select>  
                        </div>                   
                        <div class="col-12 text-center">
                           <button type="button" class="btn btn-main text-light mt-4" data-bs-toggle="modal" data-bs-target="#filter">  Show </button>
                        </div>

                     </div>
                  </div>               
               </div>
            </div>
            <div class="row">
              <div class="col-12"></div>
              <table id="table_id" class="display bg-light table-striped table-responsive" data-page-length='10'>
               <thead>
                  <tr>
                     <th>Barcode</th>
                     <th>Product Name</th>
                     <th>Color</th>
                     <th>Size</th>
                     <th>Quantity</th>
                     <th>Purchase Price</th>
                     <th>Cost</th>
                     <th>Sale Price</th>
                     <th>Action</th>
                  </tr>
               </thead>
               <tbody>
			   <?php 
			   $p = new _pos;
					
							$result = $p->read_invt_audit($_SESSION['uid']);  
							
					if ($result) {
						$i = 1;
						while ($row = mysqli_fetch_assoc($result)) {
							$total = ($row['quantity']*$row['purchase_price']);
					
					  
					 ?>
			   
			   
                  <tr>
                     <td><?php echo $row['barcode']; ?></td>
                     <td><?php echo $row['product_name']; ?></td>
                     <td>
					 <?php if($row['color']==''){
					 echo 'N/A';
					 }else{ echo  $row['color']; }
					 ?>
					 </td>
                     <td>
					
					  <?php if($row['size']==''){
					 echo 'N/A';
					 }else{ echo  $row['size']; }
					 ?>
					 
					 </td>
                     <td><?php echo $row['quantity']; ?></td>
                     <td><?php echo $row['currency']; ?>&nbsp;<?php echo $row['purchase_price']; ?></td>
                     <td> <?php echo $row['currency']; ?>&nbsp;<?php echo $row['cost']; ?> </td>
                     <td><?php echo $row['currency']; ?>&nbsp;<?php echo $total; ?>.00</td>
                     <td>
					 
					 <a onclick="edit_inventory('<?php echo $row['id'];?>','<?php echo $row['barcode'];?>','<?php echo $row['product_name'];?>','<?php echo $row['color'];?>','<?php echo $row['size'];?>','<?php echo $row['quantity'];?>','<?php echo $row['purchase_price'];?>','<?php echo $row['cost'];?>')" ><i class="fas fa-edit me-1"></i></a>
					 
					 |
                     <a onclick="delete_attributes('<?php echo $BaseUrl?>/store/pos-dashboard/inventory-audit.php?id=<?php echo $row['id'];?>&action=delete')" class="text-danger"> <i class="fas fa-trash"></i></a>
					 <!--<a href="#" class="text-danger"> <i class="fas fa-trash"></i></a> </td>-->
                  </tr>
<?php }} ?>
                  <!--<tr> 
                     <td>|||||||||||</td>
                     <td>Apple</td>
                     <td>N/A</td>
                     <td>1kg</td>
                     <td>1</td>
                     <td>$10</td>
                     <td> %5 </td>
                     <td>$10.00</td>
                     <td><a href="edit-product.html"><i class="fas fa-edit me-1"></i></a>| <a href="#" class="text-danger"> <i class="fas fa-trash"></i></a> </td>
                  </tr>-->
               </tbody>
            </table>
         </div>
         <div class="row d-flex mobile-view summary">
            <div class="col-md-12 d-flex justify-content-end col-sm-12 bg-light shadowBox">          

               <div class="d-flex ">             
                <input type="button" class="btn btn-secondary ps-2 pe-2 m-2" data-bs-toggle="modal" data-bs-target="#helpModal"  value="Help">
                <input type="button" class="btn btn-success ps-5 pe-5 m-2" data-bs-toggle="modal" data-bs-target="#paymentterm" name="print" value="Print">
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


<div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Update Inventory</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
     </div>
     <div class="modal-body">
        <form action="" method="post">
		<input type="hidden"  id="id_invent" value="" name="id"> 
		
     <div class="row">
	
	 <div class="col-md-6"> <label>Barcode</label>
	 <input type="text" class="form-control mb-3  me-2" name="barcode"  id="barcode_id" placeholder="Barcode" aria-label="Barcode" aria-describedby="addon-wrapping"> 
        </div>
		
		 <div class="col-md-6"> <label>Product Name</label>
	 <input type="text" class="form-control mb-3 me-2" name="product_name" id="product_name_id" placeholder="Product Name" aria-label="Product Name" aria-describedby="addon-wrapping">
        </div>
	 </div>
	 
	  <div class="row">
	 <div class="col-md-6"><label>Color</label>
	  <input type="text" class="form-control mb-3  me-2" name="color" id="color_id" placeholder="Color" aria-label="Color" aria-describedby="addon-wrapping">  
       </div>
	 <div class="col-md-6"> <label>Size</label>
	 <input type="number" class="form-control mb-3 " name="size" id="size_id" placeholder="Size" aria-label="Size" aria-describedby="addon-wrapping">  
        </div>
	 </div>
	 
	 
	  <div class="row">
	 <div class="col-md-6"><label>Quantity</label>
	  <input type="text" class="form-control mb-3" name="quantity"  id="quantity_id" placeholder="Quantity" aria-label="Quantity" aria-describedby="addon-wrapping"> 
       </div>
	 <div class="col-md-6"> <label>Purchase Price</label>
	  <input type="text" class="form-control mb-3" name="purchase_price" id="purchase_price_id" placeholder="Purchase Price" aria-label="" aria-describedby="addon-wrapping"> 
        </div>
	 </div>
	 
	  <div class="row">
	 <div class="col-md-6"><label>Cost</label>
	<input type="text" class="form-control"  placeholder="Cost" id="cost_id" name="cost" aria-label="Cost" aria-describedby="addon-wrapping"> 
       </div>
	 <div class="col-md-6"> 
	 							  
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

<!------------------------------------------ Scripts Files ------------------------------------------>
<script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.12.1/datatables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script src="js/data.js"></script>
<script src="js/custom-chart.js"></script>
<script type="text/javascript">
   $(document).ready( function () {
    var table = $('#table_id').dataTable( );

 } );
</script>

<script src="<?php echo $baseurl?>/assets/js/sweetalert.js"></script>

<script type="text/javascript">
   $(document).ready(function() {
     $('.js-example-basic-multiple').select2();
  });
  
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
   
   function edit_inventory(a,b,c,d,e,f,g,h){
       //alert(c);  

       $("#exampleModal2").modal('show');    
       $("#id_invent").val(a);
       $("#barcode_id").val(b);
       $("#product_name_id").val(c);
       $("#color_id").val(d);
       $("#size_id").val(e);
       $("#quantity_id").val(f);
       $("#purchase_price_id").val(g);
       $("#cost_id").val(h);
     
       
       
       
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