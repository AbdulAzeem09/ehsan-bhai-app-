<?php
	if (!defined('WEB_ROOT')) {
		exit;
	}
	$rowsPerPage = 25;

	
	$sql =	"SELECT *, COUNT(*) as my_count FROM sporder_confirm AS c INNER JOIN spprofiles AS p ON c.spProfile_idspProfile = p.idspProfiles GROUP BY spProfile_idspProfile HAVING COUNT(*) > 1";
  	$result = dbQuery($dbConn, $sql);
  	// custom pagignation
	//$result     = dbQuery($dbConn, getPagingQuery($sql, $rowsPerPage));
	//$pagingLink = getPagingLink($dbConn, $sql, $rowsPerPage);
 	
?>
	
	<!-- Content Header (Page header) -->
	<section class="content-header top_heading">
		<h1>Registered User<small>[Top Seller List]</small></h1>
	</section>
	<!-- Main content -->
	<section class="content">

		


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
			<div class="box-body tbl-respon">
				
				<div class="table-responsive">
	              	<table id="example1" class="table table-bordered table-striped tbl-respon2">
		                <thead>
		                 	<tr>
								<th class="text-center">ID</th>
								<th>Profile Name</th>
								<th style="text-align: center;">Count</th>
								
							</tr>
		                </thead>
		                <tbody>
		                	<?php
								if ($result){
									$i = 1;
									
									while($row = dbFetchAssoc($result)) {
										extract($row);
										
										?>
										<tr class="">
											<td class="text-center"><?php echo $i;?></td>
											<td><a href="javascript:void(0)"><?php echo $spProfileName;	?></a></td>
											<td style="text-align: center;"><?php echo $row['my_count']; ?></td>											
										</tr><?php
										$i++;
									}
								} //end while ?>
								
		                </tbody>
	                </div>
              	</table>
            </div><!-- /.box-body -->
			

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
			
			