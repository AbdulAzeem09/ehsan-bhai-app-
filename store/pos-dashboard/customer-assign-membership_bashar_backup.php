
<?php
/*error_reporting(E_ALL);
ini_set('display_errors', 'On');*/
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
	<style>
		.btn_back{text-decoration: none;
			background-color: #3e2048;
			color: white;
			padding: 0px 10px;
			border-radius: 2px;}
			.btn_back:hover{color: #dee2e8;}
			.quant_m{
				margin-left: 10px;
			}

		</style>
		<body>
			<div class="container-fluid">
				<div class="row flex-nowrap">

					<?php include('left_side_landing.php');?>  
					<?php
					$s=new _spuser;
					$data=$s->read_currency($_SESSION['uid']);
					$row= mysqli_fetch_assoc($data);
					$currency=$row['currency'];
	  //print_r($row);
	  //die('==');

					$p = new _pos;
					
					$result = $p->read_mem_bar_id_customer($_SESSION['uid'],$_SESSION['pid'],$_GET['postid']);  
							//print_r($result);
							//die('==');
					$total_quntity=0;	
					if ($result) {
						//$i = 1;
						while ($row = mysqli_fetch_assoc($result)) {
							//print_r($row);
					//die('======');
							$total_quntity=	$total_quntity+$row['quantity'];
						}}
					//echo $total_quntity;
					//die('==');
						$data = $p->read_barcode($_GET['postid']);
						if($data){
						//die('==');
							$row_b = mysqli_fetch_assoc($data);
					//print_r($row_b);
					//die('----');
							$barcode=$row_b['barcode'];
							$member_ship_id=$row_b['id'];

							$res2 = $p->read_member_bar($barcode); 
							if($res2 == True){

								$row_n = mysqli_fetch_assoc($res2);
								$name = $row_n['name_qty'];
								$price = $row_n['price_qty'];
						 //echo $name;
						 //echo $price;
						 //die('==');




							}
						}
						?>

						<div class="col py-3">
							<a type="button" href="<?php echo $BaseUrl?>/store/pos-dashboard/customer-list.php" class="btn_back"><i class="fa fa-arrow-left"></i> Back</a>
							
							 
				  
				  <form enctype="multipart/form-data" action="<?php echo $BaseUrl;?>/store/pos-dashboard/import_customer1.php" method="post" id="sp-form-post" name="postform" style="margin-left: 700px; margin-top: -25px; ">
<a  href= "<?php echo $BaseUrl.'/store/pos-dashboard/pos_csv/import_membeship.csv'; ?>" class="btn btn-outline-secondary mee-3"style=" padding: 2px;margin-top: -2px;margin-right:7px;">Sample CSV</a>
				   
                     <input type="file" name="file" id="file" accept= ".csv" class="" style="margin-right: -60px;">
                  <!--<a href="index.php" class="btn btn-main me-3"><i class="fas fa-file-import"></i> Import</a>-->
				  <button type="submit" class="btn btn-main mee-3" name="submit_retail" value="Upload" style="padding: 3px;
margin-top: -2px;"><i class="fas fa-file-import"></i>Import</button>
				  </form>
				 
							
							
							
							
							
							
							
							
							<div class="row p-3">
								<div class="col-md-6 border border-sucess bg-light p-3">
									<?php
									$p = new _pos;					
									$result = $p->read_dataByid($_GET['postid']);
									if ($result) {
											//$i = 1;
										$row = mysqli_fetch_assoc($result);       
											//print_r($row);
										   //die('==');  
									}		
									?>
									<?php
									$result1 = $p->read_cityName($row['spUserCity']);
									//print_r($result1);
								  // die('==');
									if ($result1) {
											//$i = 1;
										$row1 = mysqli_fetch_assoc($result1);
                                           //print_r($row);
								            //die('==');
										   
										$cityName=$row1['city_title']; 
										//echo $cityName;
										//die('======');
										
											  
									}	 
									?>
									<?php
									$result2 = $p->read_stateName($row['spUserState']);
									//print_r($result1);
								  // die('==');
									if ($result2) {
											//$i = 1;
										$row2 = mysqli_fetch_assoc($result2);
                                           //print_r($row);
								            //die('==');
										   
										$stateName=$row2['state_title']; 
										//echo $stateName;
										//die('======');
										
											  
									}	
									?>
									<?php
									$result3 = $p->read_countryName($row['spUserCountry']);
									//print_r($result1);
								  // die('==');
									if ($result3) {
											//$i = 1;
										$row3 = mysqli_fetch_assoc($result3);
                                           //print_r($row);
								            //die('==');
										   
										$countryName=$row3['country_title']; 
										//echo $countryName;
										//die('======');
										
											  
									}	
									?>
									
									
									
									<span><b>Customer Name :</b> <?php echo $row['spUserName']; ?></span><br>
									<span><b>Address Name :</b> <?php //echo $row['spUserName']; ?></span><br>
									<span><b>Phone :</b> <?php echo $row['spUserPhone']; ?></span><br>
									<span><b>Email :</b> <?php echo $row['spUserEmail']; ?></span><br>
									<span><b>City :</b> <?php echo $row1['city_title']; ?></span><br>
									<span><b>Province :</b> <?php echo $row2['state_title']; ?></span><br>
									<span><b>Country :</b> <?php echo $row3['country_title']; ?></span>
								</div>

								<div class="col-md-6 border border-sucess bg-light p-3">
									<span><b>Balance :</b> <?php echo $total_quntity;?></span><br>
									<?php if($name){?>
										<span><b>Name :</b> <?php echo $name;?></span>
									<?php }else{?>
										<span>Membership Assign</span>
									<?php } ?>
									<hr>
									<div class="row">
									<div class="col-10">
									<span><b>Subscription by Quanity</b></span>
									</div>
									<div class="col-2"><button class="form-control btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#addcustomer"style="margin-bottom:10px;"><i class="fa fa-minus"></i></button>
									</div>
									</div>
									<form action="add_cust_assign_memb.php" method="POST" id="memberForm">
										<input type="hidden" name="customer_id" value="<?php echo $_GET['postid'];?>">
										<input type="hidden" name="currency" value="<?php echo $currency;?>">
										<input type="hidden" name="current_qty" value="<?php echo $total_quntity;?>">  <input type="hidden" name="member_ship_id" value="<?php echo $member_ship_id;?>">
										<input type="hidden" name="barcode" value="<?php echo $barcode;?>">
										  
										

		<div class="row">
		<!--	<div class="col-4">
				<select name="barcode" for="barcode" class="form-control">
					  <option>Chose Membership</option>
					  <?php
					  $p = new _pos; 
			         $result_1 = $p->read_data_membership_qty($_SESSION['uid']);
			         if ($result_1) {
			         //$i = 1;
			        while ($row_1 = mysqli_fetch_assoc($result_1)){  
					  ?>
					  <option value="<?php echo $row_1['barcode']; ?>"><?php echo $row_1['name_qty']; ?></option>
					  
					 <?php }}?>
			  </select>
		  </div> -->
			<div class="col-9">
				<input type="number" class="form-control quant_m" name="quantity" placeholder="Enter Quantity" style="margin-left:-9px;">
			</div>
			<div class="col-3 btn-group">
				<input class="form-control quant_m btn btn-primary" type="submit" form="memberForm" name="quantity_btn" value="Submit">
				
			</div>
			
			<div class="col-12 mt-2" style="margin-left: -18px; margin-right:-10px">
				<textarea class="form-control quant_m" placeholder="Enter note" name="notes"></textarea> 
			</div>
			<div>
				<input type="hidden" name="event" value="add">
			</div>
		</div>
		
		<!-- <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addcustomer"> <i class="fas fa-minus"></i> </button> -->









<!--
		 		  <input class="quant_m" type="text" name="notes" placeholder="Enter note">


		  <input class="quant_m" type="number" name="quantity" placeholder="Enter Quantity">
		  
		  
		  <input class="quant_m" type="submit" name="quantity_btn" value="Submit">-->
		  
		  <!-- <button class="quant_m" type="button" style="" onclick="membership_fun()" id="m_modal" class="btn btn-primary btn-sm" > <i class="fa fa-history" aria-hidden="true"></i></button>-->
		</form>
	</div>
</div>

<div class="row">
	<!--++Member By Quantity++ -->
	<div class="col-md-6">


		<!---- modal open  --->
		<div class="modal fade" id="addcustomer" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-lg">
				<div class="modal-content" style="width:50%;margin-left: 245px;
margin-top: -28px;">
					<div class="modal-header bg-primary text-light">
						<h5 class="modal-title" id="exampleModalLabel">Deduct</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<form action="data_1.php" method="POST">
							<div class="row">
								<div class="col-12">
									<div class="mb-3">
										<!--<label for="customerno">ID</label>-->
										<input type="hidden" class="form-control shadowBox" id="customerno" placeholder="" value="<?php echo $_GET['postid'];   ?>" name="postid">

									</div>
									<div class="mb-3">
										<label for="customerno">Quantity</label>
										<input type="number" class="form-control shadowBox" id="customername" placeholder="enter a Quantity" value="" name="second">
										
									</div>
									<div class="mb-3">
										
										<textarea class="form-control shadowBox" id="customername" placeholder="note" value="" name="notes"></textarea>
										
									</div>

									<input type="hidden" name="event" value="deduct" >
									
									<input type="hidden" name="current_qty" value="<?php echo $total_quntity;   ?>" >

	<input type="hidden" name="current_barcode" value="<?php echo $barcode;   ?>" >
	<input type="hidden" name="current_member_ship_id" value="<?php echo $member_ship_id;   ?>" >
		<input type="hidden" name="currency" value="<?php echo $currency;?>">
	

								</div>

							</div>

						</div>
						<div class="modal-footer">
							<button type="submit" class="btn btn-secondary" id="close_" data-bs-dismiss="modal">Submit</button>

						</div>
					</form>
				</div>
			</div>
		</div>
		<!---  modal open end -->



	</div>
	<!--++Member By Duration++ -->
		<!--  <div class="col-md-6" style="text-align: center;">
		  <h4>Member By Duration</h4>
		  <form action="add_cust_assign_memb.php" method="POST">
		  <input type="hidden" name="customer_id_d" value="<?php echo $_GET['postid'];?>">
		  <input type="hidden" name="currency_d" value="<?php echo $currency;?>">
		  <label for="">Option2 : </label>  
		  <select name="barcode_d" for="barcode_d">
		  <option>Select Option</option>
		  <?php $p = new _pos;
                $result_2 = $p->read_data_membership_dur($_SESSION['uid']); 
               if ($result_2) {
                //$i = 1;
               while ($row_2 = mysqli_fetch_assoc($result_2)) {?>
		  <option value="<?php echo $row_2['barcode']; ?>"><?php echo $row_2['Name']; ?></option>
			   <?php }}?>
		  </select>
		  <br>
		  <br>
		  <input type="text" name="quantity_d" placeholder="Enter Euantity">
		  <br>
		  <br>
		  <input type="submit" name="quantity_btn_d" value="Submit">
		  </form> 
		</div>-->
	</div>
	<br>
	<div class="modal fade" id="membership_Modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-sm">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Deduct Membership</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<div class="row">
						<input type="text" class="form-control shadowBox" id="member_ship_" placeholder="Enter no." value="">                
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" id="close_3" data-bs-dismiss="modal">Close</button> 
					<button type="button"  onclick="fun_membership()" class="btn btn-warning">Save</button>
				</div>
			</div>
		</div>
	</div> 
	<div class="col-12">

		<table id="table_id" class="display bg-light table-striped table-responsive" data-page-length='10'>
			<thead>
				<tr>
					<!-- <th>Name</th> -->
					<th>Date</th>
                           <!--<th>Color</th>
                           	<th>Size</th>-->
                           	<th>Previous Quantity </th>
                           	<th>Quantity Refill</th>
                           	<th>Notes</th>
								<th>Action</th>
                           <!--<th>Purchase Price</th>
                           <th>Cost</th>
                           <th>Sale Price</th>-->
                           <!--<th>Action</th>-->
                        </tr>
                     </thead>
                     <tbody>
                     	<?php
                     	$p = new _pos;

                     	$result = $p->read_mem_bar_id_customer_n($_SESSION['uid'],$_SESSION['pid'],$_GET['postid']);  
							//print_r($result);
							//die('==');

                     	if ($result) {
                     		$i = 1;
                     		while ($row = mysqli_fetch_assoc($result)) {
							///print_r($row);
							//die('==');
                     			$id =	$row['barcode'];
                     			$customer_id = $row['customer_id'];
						//echo $id;
						//die('==');
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
                     				<!-- <td><?php //echo $name; ?></td> -->
                     				<td><?php echo $row['date']; ?> <?php echo $price; ?></td>
                           <!--<td>N/A</td>
                           	<td>N/A</td>-->
                           	<td><?php echo $row['current_qty']; ?></td>
                           	<td><?php echo $row['quantity']; ?></td>
                           	<td>
                           		<?php  echo $row['notes']; ?>

                           	</td>
							  	<td>
                           		<?php  echo $row['event']; ?>

                           	</td>
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
		$('#table_id').DataTable({  
			buttons: {
				buttons: [ 'copy', 'csv', 'excel' ]
			}
		});        
	});
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
					url: "delete.php",
					data: {postid:id}, 
					success: function(response){

						window.location.href = "customer-list.php";    

					}

				});
			}
		})  



	}   



</script>


<script>
	function fun_membership(){

		  //alert("hello");  
		  var member_ship_ = $('#member_ship_').val();
		   // var customer_id = $('#customer_id').val();
		   var tbl = "membership";
		   $.ajax({
		   	url: 'read_data_id.php',  
		   	type: 'post',

		   	data: {member_ship_:member_ship_,tbl:tbl} ,    

		   	success: function(response){ 
		   		if(response == 1){
						//$('#close_3').click(); 
						location.replace("<?php echo $BaseUrl.'/store/pos-dashboard/pos.php?msg=success'; ?>");
					} 
					if(response == 2){
						location.replace("<?php echo $BaseUrl.'/store/pos-dashboard/pos.php?msg=nomembership'; ?>"); 
					}	
					
				}

			});
		}
		function membership_fun(){

			 //alert('hello');
			 var phone = $('#phone_').val();
			//var product_id = $('#product_id_').val();  
			if(phone != "" ){ 
				var id = $('#customer_id').val();
		 //alert(id);
		 //window.location.replace('<?php echo $BaseUrl?>/store/pos-dashboard/membership_history.php?id='+id+'');
		 $("#membership_Modal").modal('show'); 
		}else{
			alert("Please Fill the Contact Number  ");
		} 


	}

</script>


</body>
</html>

<?php } ?>