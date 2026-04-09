<?php



//die('====================');
	if (!defined('WEB_ROOT')) {
		exit;
	}


  
	
	
?>


<style>
	.content {
    min-height: 150px!important;
	}
	.select2 {
		width: 400px!important;
	}
    
	</style>
	 <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>Redeemed Request<small>[List]</small></h1>
	</section>
	
	
		<div class="box box-success">
			<div class="box-body">
				
				
			
				<div class="table-responsive tbl-respon">
					<table id="example1" class="table table-bordered table-striped tbl-respon2">
                  
						<thead>
							<tr>
								
								<th>id</th>
								<th >User Name</th>
								<th >Email</th>
								<th >Amount</th>
                                <th >Status</th>
								<th >Requested Date</th>
                                <th >Acton Date</th>
								
								<th >Action</th>
								
							</tr>
						</thead>
						<tbody>
							<?php
						
								$i = 1;
                                $sql =  "SELECT * FROM sppoint_withdraw WHERE status = 0 ORDER BY `id` desc";
                                     $result2  = dbQuery($dbConn, $sql);
                                     //$row2 = dbFetchAssoc($result2);
                                     //print_r($aa);die('===');
                                   $i=1;
								while ($row = dbFetchAssoc($result2)) {
                                    $id=$row['id'];
							
									$rr =  "SELECT * FROM spuser WHERE idspUser=$row[uid]";
                                     $get_row  = dbQuery($dbConn, $rr);
									 $user_name = dbFetchAssoc($get_row);
							
									?>
									<tr>
									<td><?php echo $i; ?></td>
										
										<td><a href="../registerdUser/index.php?view=detail&uid=<?php echo $row['uid'];?>"><?php echo $user_name['spUserName'];?></a></td>
										<td><?php echo $user_name['spUserEmail'];   ?></td>
										<td><?php echo $row['withdraw_amount'];   ?></td>
										<td><?php  if($row['status']==1){echo '<span style="color:green;">Accepted</span>';}else{echo '<span style="color:red;">Pending</span>';}   ?></td>
										<td><?php echo $row['request_date'];   ?></td>
                                        <td> <?php echo $row['action_date'];   ?></td>
                                        <td>
                                            <?php if($row['status']==0) {?>
                                        <a class="btn btn-primary" href="/backofadmin/sppoint_withdraw/index.php?view=approve&id=<?php echo $id;?>">Approve</a>
                                        <?php } 
                                         else {
                                            echo '----';
                                         }
                                            ?>
                                           
                                             

                                       </td>
											
							
								
									</tr>
									<?php
									$i++;
								}
						
							?>
						</tbody>
                       

                      
					</table>
				</div>
			</div>
				<!--- End Table ---------------->
		</div>
        
		
	</section>




<script type="text/javascript">
		
		$(document).ready( function () {
  var table = $('#example1').DataTable( {

   "order": [[ 0, "desc" ]],
    pageLength : 10,
    lengthMenu: [[10, 20, 50, 100], [10, 20, 50, 100]]
  } );
  
		        
		   
} );
</script>

