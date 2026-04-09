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
		<h1>Auction<small>[List]</small></h1>
	</section>
	
	
		<div class="box box-success">
			<div class="box-body">
				
				
			
				<div class="table-responsive tbl-respon">
					<table id="example1" class="table table-bordered table-striped tbl-respon2">
                  
						<thead>
							<tr>
								
								<th>Id</th>
								<th >Product Name</th>
								<th >Expiry Date</th>
                                <th >Price</th>
								<th >Discounted Price</th>
                                <th >Posting Date</th>
								
								<th >Action</th>
								
							</tr>
						</thead>
						<tbody>
							<?php
						
								$i = 1;
                                $sql =  "SELECT * FROM `spproduct` WHERE `sellType` = 'auction'";
                                     $result2  = dbQuery($dbConn, $sql);
                                     //$row2 = dbFetchAssoc($result2);
                                     //print_r($aa);die('===');
                                   $i=1;
								   while ($row = dbFetchAssoc($result2)) {

									?>
									<tr>
									<td><?php echo $i; ?></td>
										
										<td><?php echo $row['spPostingTitle'];   ?></td>
										<td><?php echo $row['spPostingExpDt'];   ?></td>
										
										<td><?php echo '$'.$row['spPostingPrice'];   ?></td>
                                        <td> <?php echo '$'.$row['discounted_price'];   ?></td>
                                        <td> <?php echo $row['spPostingDate'];   ?></td>
                                        <td><a class="btn btn-primary" href="https://dev.thesharepage.com/store/detail.php?postid=<?php echo $row['idspPostings']; ?>">View</a></td>

								
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

