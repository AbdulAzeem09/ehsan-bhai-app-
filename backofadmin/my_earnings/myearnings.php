<?php 
	if (!defined('WEB_ROOT')) {
		exit;
	}


	$sql =  "SELECT * FROM spmembership_transaction ";
	$result  = dbQuery($dbConn, $sql);
	
	
?>
	
	<!-- Content Header (Page header) -->
	<section class="content-header top_heading">
		<h1>Membership Transaction<small>[List]</small></h1>
	</section>
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
								<th style="width: 80px;">Sr. No</th>
								<th>Name</th>
								<th>Memebership Name</th>
								<th>Amount</th>
								<th>Transaction Number</th>
								<th>Date</th>
								
							</tr>
						</thead>
						<tbody>
							<?php
							if ($result) {
								$i = 1;
								while ($row = dbFetchAssoc($result)) {
									extract($row);
									//print_r($row);
									//$postDate = strtotime($spenquiry_date);
									
									//$res = $mb->readmember($row["membership_id"]);
									$sql1 =  "SELECT * FROM `spmembership` WHERE idspMembership = " .$row['membership_id'] ;
									//echo $sql1;
	                                  $result1  = dbQuery($dbConn, $sql1);
	
			                                                   if($result1) 
		                                                             	{ 
			                                                         $row1 = dbFetchAssoc($result1);
																	// print_r($row1);
		                                                                   		$membership_name= $row1["spMembershipName"];
		                                                                    	}
																				
																				
																				$sql2 =  "SELECT * FROM `spprofiles` WHERE idspProfiles = " .$row['pid'] ;
									//echo $sql1;
	                                  $result2  = dbQuery($dbConn, $sql2);
	
			                                                   if($result2) 
		                                                             	{ 
			                                                         $row2 = dbFetchAssoc($result2);
																	// print_r($row1);
		                                                                   		$spProfileName = $row2["spProfileName"];
		                                                                    	}
									?>
									<tr>
										<td class="text-center"><?php echo $i; ?></td>
										<td><a href="/friends/?profileid=<?php echo $row['pid']; ?>"><?php echo $spProfileName;?></a></td>
										<td class="text-center "><span class="smalldot"><?php echo ucfirst($membership_name); ?></span></td>
										<td class="text-center "><span class="smalldot"><?php echo ($row['amount']); ?></span></td>
                                        <td   class="text-center "><span class="smalldot"><?php echo $row['txn_numberpid']; ?></span></td>
                                                           
								      <td class="text-center"> <?php echo $row['createdon']; ?> </td>
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
		