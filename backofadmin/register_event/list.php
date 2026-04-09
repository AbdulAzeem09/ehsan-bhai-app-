<?php

error_reporting(0);
@ini_set('display_errors', 0);
	if (!defined('WEB_ROOT')) {
		exit;
	}
	$rowsPerPage = 25;
  	
  	$sql = "SELECT * FROM register_event";

  	$result = dbQuery($dbConn, $sql);
  	
 	
?>

		<!-- Content Header (Page header) -->
		<section class="content-header">
			<h1>Register<small>[Event]</small></h1>
		</section>
		<!-- Main content -->
		<section class="content">

		


		<div class="">
			<div class="box box-success">
				<div>
					<?php 
					if(isset($_SESSION['errorMessage']) && isset($_SESSION['count'])){
						if($_SESSION['count'] <= 1){
							$_SESSION['count'] +=1; ?>
							<div class="space"></div>
							<p class="alert alert-success"><?php echo $_SESSION['errorMessage'];  ?></p> <?php
							unset($_SESSION['errorMessage']);
						}
					} ?>
				</div>
				<div class="box-body">

					
					<div class="table-responsive">
		              	<table id="example1" class="table table-striped table-bordered">
			                <thead>
			                 	<tr>
									<th class="text-center" style="width: 50px!important;">ID</th>
									<th>Transection Id</th>
									<th>Event Name</th>	
									<th>Event Packages</th>									
									<th>Booking Date</th>
									<th>Amount Paid</th>
									<th>Buyer Name</th>
									<th>Status</th>
									<!-- <th>Action</th> -->
									
									<!-- <th class="text-center" style="min-width: 80px;">Action</th> -->
								</tr>
			                </thead>
			                <tbody>
			                	<?php
									if ($result){
										if (isset($_GET['page']) && $_GET['page'] > 1) {
											$i = 25 * ($_GET['page'] - 1) + 1;
										}else{
											$i = 1;
										}
										
										while($row = dbFetchAssoc($result)) {
											extract($row);	
											if(isset($row['registration_type'])){										
												$package = json_decode($row['registration_type']);
												print
												$package_srt = '';
												foreach ($package as $value) {
													$package_srt .=  $value->reg_name.' : '.$value->price.' X '.$value->quantity.'<br>';
												}
											}else{
												$package_srt = '';
											}
											?>
											<tr class="<?php echo ($spUserLock == 1)?'lockedwind':'';?>">
												<td class="text-center"><?php echo $i++;?></td>
												<td><?php echo $row['transactions_id'];?></td>		
												<td class="text-center"><?php echo $row['event_id'];?></td>
												<td class="text-center"><?php echo $package_srt;?></td>
												<td class="text-center"><?php echo date("Y-m-d H:i:A",strtotime($row['created']));?></td>												
												<td><?php echo '$'.number_format($row['ticket_price'], 2); ?></td>
												<td><?php echo $row['fistname'];?> <?php echo $row['lastname'];?></td>												
												<td class="text-center"><?php echo $row['pyament_status'];?></td>
												<!-- <td class="text-center menu-action" style="">
													<?php showProfileName($dbConn, $sellid); ?>

                                             </td> -->
                                  
												
											</tr><?php
										}
									}else { ?>
										
										<?php }  ?>
									
			                </tbody>
		                </div>
	              	</table>
	            </div><!-- /.box-body -->
				
	        </div>
				<!--- End Table ---------------->
		</div>
		
		
		
	</section><!-- /.content -->
	<script type="text/javascript">
		
		$(document).ready( function () {
  var table = $('#example1').DataTable( {

   "order": [[ 0, "desc" ]],
    pageLength : 10,
    lengthMenu: [[10, 20, 50, 100], [10, 20, 50, 100, ]]
  } );
  
		        
		   
} );

	</script>	
			