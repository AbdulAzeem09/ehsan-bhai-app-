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
		<h1>Professional Category<small>[List]</small></h1>
	</section>
	
	
		<div class="box box-success">
		<div class="box-header text-right">
	                  <a class="btn btn-primary" href="<?php echo WEB_ROOT_ADMIN . "freelancer/index.php?view=add_profeesional" ?>"><i class="fa fa-plus"></i> Add Category </a>
	                </div>
			<div class="box-body">
				
				
			
				<div class="table-responsive tbl-respon">
					<table id="example1" class="table table-bordered table-striped tbl-respon2">
                  
						<thead>
							<tr>
								
				
								<th >ID</th>
								<th > Category</th>
								<th >Action</th>
								
							</tr>
						</thead>
						<tbody>
							<?php
									$i=1;
									$pid=$_SESSION['pid'];
 $sql3 =  "SELECT * FROM masterdetails WHERE master_idmaster = '25' ORDER BY masterDetails ASC ";
                                     $result3  = dbQuery($dbConn, $sql3);
                                     //$row2 = dbFetchAssoc($result2);
                                     //print_r($aa);die('===');
								while ($row = dbFetchAssoc($result3)) {
							
									
									?>
									<tr>
										<td><?php echo $i; ?></td>
										<td><?php echo $row['masterDetails'];   ?></td>
										<td ><a href="<?php echo WEB_ROOT_ADMIN . "freelancer/index.php?view=edit_profeesional&id=".$row['idmasterDetails']?>" class="btn btn-primary">Edit</a>
										<a href="<?php echo WEB_ROOT_ADMIN . "freelancer/index.php?view=delete_profeesional&id=".$row['idmasterDetails']?>" class="btn btn-danger">Delete</a></td>
										
								
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

