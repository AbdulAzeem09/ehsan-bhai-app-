<?php
	if (!defined('WEB_ROOT')) {
		exit;
	}
	$userId = $_SESSION['userId'];
	$sql =  "SELECT * FROM commission_payment_history ORDER BY payids DESC";
	$result  = dbQuery($dbConn, $sql);
	
	
?>
	
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1> Commisssion <small>[List]</small></h1>
		
	</section>

	<?php
			$totalsql =  "SELECT SUM(totalComm) AS value_sum  FROM commission_payment_history";
			$totalresult  = dbQuery($dbConn, $totalsql);
  		   if ($totalresult) { 
						$totalrow = dbFetchAssoc($totalresult);
				}
			?>
	   <div style="width:50%; float:right; margin-top: -25px;"><?php 
			echo "<strong>Total Commission:</strong> $".$totalrow['value_sum']; ?>
			
		</div>
	<!-- Main content -->
	<section class="content">
		<div class="box box-success">
			
			<?php 
			if(isset($_SESSION['errorMessage']) && isset($_SESSION['count'])){
				if($_SESSION['count'] <= 1){
					$_SESSION['count'] +=1; ?>
					<div class="row" id="alertmsg" style="margin: 5px 0px 0px 5px;" >
						<div style="min-height:10px;"></div>
						<div class="alert alert-<?php echo $_SESSION['data'];?>">
							<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
							<?php echo $_SESSION['errorMessage'];  ?>
						</div> 
					</div><?php
					unset($_SESSION['errorMessage']);
				}
			} ?>
			
			<div class="box-body" >
				<div class="table-responsive tbl-respon">
					<table id="example1" class="table table-bordered table-striped tbl-respon2">
						<thead>
							<tr>
								<th>ID</th>
								<th>Buyer Name</th>
								<th>Commission From</th>
								<th>Date</th>
								<th>Total Amount</th>
								<th>Commission</th>
								<th style="width: 100px;" class="text-center" >Action</th>
							</tr>
						</thead>
						<tbody>
							<?php
							if ($result) {
								$i = 1;
								while ($row = dbFetchAssoc($result)) {
									extract($row);
									$postDate = strtotime($commDate);

									
									?>
									<tr>
										<td class="text-center"><?php echo $i; ?></td>
										<td><?php 

										$usersql =  "SELECT spUserName, spUserFirstName, spUserLastName  FROM spuser where idspUser='".$spUser_idspUser."'";
										$userresult  = dbQuery($dbConn, $usersql);
										//echo $usersql;die('+++');

										if ($userresult) { 
											
											$userrow = dbFetchAssoc($userresult);
										}
										extract($userrow);
										
										echo '<a href="../registerdUser/index.php?view=detail&uid='.$spUser_idspUser.'" target="_blank"> '.$spUserFirstName." ".$spUserLastName.'</a>';

											
										?></td>
										<td><?php echo $spCommFrom; ?></td>
										<td><?php echo date("d-M-Y", $postDate); ?></td>
										<td>$<?php echo $totalAmount; ?></td>
										<td>$<?php echo $totalComm; ?></td>
										<td class="menu-action text-center">

										<a href="index.php?view=modify&payids=<?php echo $payids;?>" data-original-title="Edit" data-toggle="tooltip" data-placement="top" class="btn menu-icon vd_bg-yellow"> <i class="fa fa-pencil"></i> </a>&nbsp;
										
										<a href="processCommi.php?action=delete&payids=<?php echo $payids;?>" data-original-title="Delete" data-toggle="tooltip" data-placement="top" class="btn menu-icon vd_bg-red"> <i class="fa fa-times"></i> </a>


											
										</td>
									</tr>
									<?php
									$i++;
								}
							}
							?>
						</tbody>
					</table>
				</div>
			</div>
				<!--- End Table ---------------->
		</div>
        
		
	</section><!-- /.content -->
		<script type="text/javascript">
		
		$(document).ready( function () {
  var table = $('#example1').DataTable( {

   "order": [[ 0, "desc" ]],
    pageLength : 10,
    lengthMenu: [[10, 20, 50, 100], [10, 20, 50, 100]]
  } );
  
		        
		   
} );

	</script>
			