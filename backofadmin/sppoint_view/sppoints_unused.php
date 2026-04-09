<?php

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
		<h1>Sp Points Unused <small>[List]</small></h1>
	</section>
	
	
		<div class="box box-success">
			<div class="box-body">
				
				
			
				<div class="table-responsive tbl-respon">
					<table id="example1" class="table table-bordered table-striped tbl-respon2">
                  
						<thead>
							<tr>
								<th >User Id</th>
								<th >Transaction Date</th>
								<th >Percentage</th>
								<th >Amount</th>
								<th >Balance</th>	
							</tr>
						</thead>
						<tbody>
							<?php
                                $sql =  "SELECT * FROM sppoints ";
                                     $result2  = dbQuery($dbConn, $sql);
                        
								while ($row = dbFetchAssoc($result2)) {
								
							
									?>
									<tr>
										<td><a href="../registerdUser/index.php?view=detail&uid=<?php echo $row['spUser_idspUser'];?>"><?php showspUserName($dbConn, $row['spUser_idspUser']); ?></a></td>
										<td><?php echo $row['pointDate'];   ?></td>
										<td><?php echo $row['pointPercentage']; ?></td>
										<td>USD <?php echo $row['pointAmount'];   ?></td>
										<td>USD <?php echo $row['pointBalance'];   ?>
									</tr>
									<?php
									
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

