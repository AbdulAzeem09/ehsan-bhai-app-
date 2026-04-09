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
   <div class="container-fluid" >
      <div class="row flex-nowrap">
	  
	  
	 
         <div class="col py-3">
            <div class="row mb-4" > 
             			
               <div class="col-12" id="content_1">
			  
				 <table id="table_id" class="display" data-page-length='10'>
                   <thead>
                    <tr>
                     <th>Name</th>
                     <th>Phone</th>
                     <th>Date</th>
                     <th>Total Of Price</th>
                     <th>Total Discount</th>
                     <th>Total By Net</th>
                     <th>Total Tax</th>
                     <th>Total Amount</th>
                     
                  </tr>
               </thead>
               <tbody>
			   
			    <?php
				
				
				
					$p = new _pos;
					
							
							
					$start_date = $_POST['start_date'];
	$end_date = $_POST['end_date'];  
	$paymentterm_1 = $_POST['paymentterm_1'];  
	$paymentterm_2 = $_POST['paymentterm_2'];  
	$print_cost = $_POST['print_cost'];  
	
	$result_2 = $p->read_pos_customer_by_date_1($start_date,$end_date); 
                        if($result_2){						 

						 While($sdata = mysqli_fetch_assoc($result_2)){
							
						$customer_id = $sdata['customer_id'];
					  $result_3 = $p->cust_name($customer_id);
                        if($result_3){						 

						 $data = mysqli_fetch_assoc($result_3);
						 
						$customername = $data['customer_name'];
						$phone = $data['phone'];    
						 
						}	
					?>
                  <tr>
                     <td>
					 <?php echo $customername;  ?>
					
					 </td>
                     <td><?php echo $phone; ?></td> 
                     <td><?php echo $sdata['date']; ?></td>
                     <td><?php echo $sdata['currency']; ?>&nbsp;<?php echo $sdata['sub_total']; ?></td>
                     <td><?php echo $sdata['currency']; ?>&nbsp;<?php echo $sdata['discount_by_net'] ; ?> </td>
                     <td><?php echo $sdata['currency']; ?>&nbsp;<?php echo $sdata['total_by_net']; ?></td>
                     <td><?php echo $sdata['currency']; ?>&nbsp;<?php echo $sdata['total_tax']; ?></td>
                     <td><?php echo $sdata['currency']; ?>&nbsp;<?php echo $sdata['Gross_net']; ?></td>
                     
                     
                   
					 

                  </tr>
					<?php  }} ?>
                 
                 
               </tbody>
            </table>
				
				
		
			
			
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.2/jspdf.debug.js"></script> 
<script src="js/data.js"></script>
<script src="js/custom-chart.js"></script>
<script type="text/javascript">
   $(document).ready( function () {
    var table = $('#table_id').dataTable( );
	 
	    /* var doc = new jsPDF('l', 'pt', "a4");    
									var specialElementHandlers = { 
										'#editor': function (element, renderer) { 
											return true; 
										} 
									};
									
										doc.fromHTML($('#content_1').html(), 15, 15, {  
											'width':190, 
												'elementHandlers': specialElementHandlers 
										}); 
								    doc.save('sample-page.pdf'); */
    
  } );
  
  
  
  
  function filter_fun(){
	  var phone = $('#phone_').val();
	  alert(phone); 
	  
  }
  
  
 
		// alert('hello');
	               

	 
</script>



</body>
</html>

<?php } ?>