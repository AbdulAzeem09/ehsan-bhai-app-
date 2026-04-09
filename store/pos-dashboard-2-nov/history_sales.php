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
		 <div id="content_1">   
            <div class="row mb-4">
               <div class="col-12">
                 <h3>Billing Details</h3>
                  <!--<div class="row">
                     <div class="col-2 mb-3">
                        <input type="text" class="form-control" placeholder="Cust ID:" aria-label="Customer ID:" aria-describedby="addon-wrapping">
                     </div>
                     <div class="col-4">
                        <select class="form-control form-select js-example-basic-multiple" id="inputGroupSelect02" name="customer">
                           <option value="1">Jhone</option>
                           <option value="2">Dave</option>
                           <option value="3">Yusha</option>
                        </select>
                     </div>
                     <div class="col-2">
                        <input type="date" class="form-control" placeholder="Choose Date Start"  aria-describedby="addon-wrapping">
                     </div>
                     <div class="col-2">
                        <input type="date" class="form-control" placeholder="Choose Date End"  aria-describedby="addon-wrapping">
                     </div>
                     <div class="col-2">
                        <button type="button" class="btn btn-main"> Show Sales</button> 
                     </div>
                  </div> -->
				  
				  <div class="p-3">
				   <?php
				
				
				
					$p = new _pos;
					        if($_GET['id'] != " "){
								$id = $_GET['id'];
							$result_1 = $p->read_pos_customerid($id);
							}
							 if(isset($_GET['print']) == "invoice"){   
								 $code_id = $_GET['code_id'];
								 $result_1=$p->read_pos_customer_rand_no($code_id);    
								 
							 }
							
					if ($result_1) {
						
						$row_1 = mysqli_fetch_assoc($result_1);
						//print_r($row_1); die('-----------------');
						$customer_id = $row_1['customer_id'];
						$discount_by_net =   $row_1['discount_by_net'];							
                          $total_by_net =   $row_1['total_by_net'];							
                          $total_tax =   $row_1['total_tax'];							
                          $Gross_net =   $row_1['Gross_net'];							
                          $sub_total =   $row_1['sub_total'];	 	
                          $payment_amount =   $row_1['payment_amount'];	 	
                          //$type_payment =   $row_1['type_payment'];	

                          if($row_1['type_payment'] == 1){
							 $type_payment = 'Email Payment Link' ;
						  }	

						  if($row_1['type_payment'] == 2){
							  $type_payment = 'Open Payment Page' ;
						  }	
						  
						  if($row_1['type_payment'] == 3){
							  $type_payment = 'Payment Done' ;
						  }	
						  
						  if($row_1['type_payment'] == 4){
							  $type_payment = ' Send OTP' ; 
						  }	
                          $currency =   $row_1['currency'];	 	
						
                         $result_2 = $p->cust_name($customer_id);
                        if($result_2){						 

						 $sdata = mysqli_fetch_assoc($result_2);
						  $customername= $sdata['spUserName'];
						 $phone= $sdata['spUserPhone'];
						 $email=$sdata['spUserEmail'];
						 $address=$sdata['spUserAddress'];

						 
						}	
					}	 //print_r($data); die('---------'); 
					?>
				  
				  
				<h4><?= $customername; ?></h4>
               <h6>Phone: <span class="font-li"><?= $phone; ?></span></h6>
                <h6>Email: <span class="font-li"><?= $email ?></span></h6>
                <h6>Address: <span class="font-li"><?= $address ?></span></h6><br/>
            </div>
			
                  <div class="info"></div>
                  <table id="table_id" class="display" data-page-length='10'>
                   <thead>
                    <tr>
                     <th>Barcode</th>
                     <th>Product Name</th>
                     <th>Color</th>
                     <th>Size</th>
                     <th>Qty</th>
                     <th>Unit Price</th>
                     <th>Discount</th>
                     <th>Total Price</th> 
                     
                     
                    <!-- <th>Action</th>-->
                  </tr>
               </thead>
               <tbody>
			   
			    <?php
				
				
				
					$p = new _pos;
					
					  if($_GET['id'] != " "){
					
					$id = $_GET['id'];
							$result = $p->read_pos_customer_id($id);
							
					  }
					  
					   if(isset($_GET['print']) == "invoice"){   
		$result = $p->read_pos_customer_id($customer_id); 
					   }
							
					if ($result) {
						$i = 1;
						while ($row = mysqli_fetch_assoc($result)) {
							
							//print_r($row); die('------'); 
							$barcode = $row['barcode'];
                          	$sp = new _spprofiles;  
                            $res_1 = $sp->readprice_barcode($barcode); 
                             if($res_1){
	                         $row_1 = mysqli_fetch_assoc($res_1); 
							 $id = $row_1['idspPostings'];
							 }
								
							
					?>
                  <tr>
                     <td><?php echo $row['barcode']; ?></td>
                     <td>
					 <a href="<?php echo $BaseUrl;?>/store/detail.php?postid=<?php echo $id; ?>" >
					 <?php echo $row['product_name']; ?>
					 </td>
					 </a>
                     <td><?php echo ($row['color'] != "null")? $row['color'] : "N/A"; ?></td>
                     <td><?php echo ($row['size'] != "null")? $row['size'] : "N/A" ; ?> </td>
                     <td><?php echo $row['quantity']; ?></td>
                     <td><?php  echo $currency ;?>&nbsp;<?php echo $row['unit_price']; ?></td>
                     <td><?php echo $row['discount']; ?>%</td>
                     <td><?php  echo $currency ;?>&nbsp;<?php echo $row['total_price']; ?></td>
                     
                     <!--<td><a href="#"><i class="fas fa-edit me-1"></i></a>| <a href="#" class="text-danger"> <i class="fas fa-trash"></i></a></td>-->
                  </tr>
				 <?php }} ?>
                 <!-- <tr>
                     <td>02-09-2022</td>
                     <td>inv-012346</td>
                     <td>apples</td>
                     <td>Lorem ipsum dolor sit amet, </td>
                     <td>5</td>
                     <td>$12</td>
                     <td>$15</td>
                     <td>%5</td>
                     
                     <!--<td><a href="#"><i class="fas fa-edit me-1"></i></a>| <a href="#" class="text-danger"> <i class="fas fa-trash"></i></a></td>-->
                  </tr>
                 
               </tbody>
            </table>
			<div class="p-3" style="display:flex">
				
               <h6 style="margin:15px">Total Of Price: <span class="font-li"><?php  echo $currency ;?>&nbsp;<?= $sub_total; ?></span></h6> 
               <h6 style="margin:15px">Total Discount: <span class="font-li"><?php  echo $currency ;?>&nbsp;<?= $discount_by_net; ?></span></h6>
                <h6 style="margin:15px" >Total By Net: <span class="font-li"><?php  echo $currency ;?>&nbsp;<?= $total_by_net; ?></span></h6>
                <h6 style="margin:15px" >Total Tax: <span class="font-li"><?php  echo $currency ;?>&nbsp;<?= $total_tax; ?></span></h6>
                <h6 style="margin:15px" >Total Amount: <span class="font-li"><?php  echo $currency ;?>&nbsp;<?= $Gross_net; ?></span></h6> 
                <h6 style="margin:15px" >Payment Amount: <span class="font-li"><?php  echo $currency ;?>&nbsp;<?= $payment_amount; ?></span></h6> 
                <h6 style="margin:15px" >Payment Type: <span class="font-li"><?= $type_payment; ?></span></h6><br/>  
            </div>
			
         </div>
      </div>
</div><div id="page"></div> 
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
 <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.2/jspdf.debug.js"></script>    
<script type="text/javascript">
   $(document).ready( function () {
     var table = $('#table_id').dataTable( );
	 
	 
	 var invoice = "<?php echo $_GET['print'] ?>"
	 //alert(invoice);
	 
	 if(invoice == "invoice"){
		// alert('hello');
	                var doc = new jsPDF('l', 'pt', "a4");    
									var specialElementHandlers = { 
										'#editor': function (element, renderer) { 
											return true; 
										} 
									};
									
										doc.fromHTML($('#content_1').html(), 15, 15, {  
											'width':190, 
												'elementHandlers': specialElementHandlers 
										}); 
								    doc.save('sample-page.pdf'); 

	 }									
    
  } );
  
  
							
									
						
  
</script>
</body>
</html>

<?php } ?>