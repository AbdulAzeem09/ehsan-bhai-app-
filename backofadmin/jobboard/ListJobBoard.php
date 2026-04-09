<?php
	if (!defined('WEB_ROOT')) {
		exit;
	}
	$rowsPerPage = 25;
	if(isset($_GET['pid'])){
	$pid = $_GET['pid'];
	$sql="SELECT * FROM spjobboard WHERE spProfiles_idspProfiles = $pid ORDER BY idspPostings ASC";
	}else{
  	$sql="SELECT * FROM spjobboard ORDER BY idspPostings ASC";
	}
  	$result = dbQuery($dbConn, $sql);
  	// custom pagignation
	//$result     = dbQuery($dbConn, getPagingQuery($sql, $rowsPerPage));
	//$pagingLink = getPagingLink($dbConn, $sql, $rowsPerPage);
 	
?>
	
	<!-- Content Header (Page header) -->
	<section class="content-header top_heading">
		<h1>Job Board<small>[List]</small></h1>
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
				<table id="example1" class="table table-bordered table-striped tbl-respon2">
	                <thead>
	                 	<tr>
						 <th>ID</th>
						<th style="width: 30.531px !important;">Job Title</th>
						<th style="width: 34.531px !important;">Job Notes</th>
						<th>Date Expiry</th>
						<th>Date Posted</th>
						<th>Account Name</th>
						<th>Status</th>
						<th>Action</th>
						</tr>
	                </thead>
	                <tbody>
	                	<?php
							if ($result){
								$i = 1;
								
								while($row = dbFetchAssoc($result)) {
									extract($row);
									$postDate = strtotime($spPostingDate);
									$spExpDt = strtotime($spPostingExpDt);
									if ($spPostingVisibility == -1) {
										$status = "Active";
									}else if($spPostingVisibility == 0){
										$status = "Draft";
									}else if($spPostingVisibility == 1){
										$status = "Block";
									}
									?>
									<tr>

										<td class="text-center"><?php echo $i;?></td>
										<td class="text-center"><?php echo $spPostingTitle; ?></td>
										<td class="text-center"><?php echo $spPostingNotes; ?></td>
										<td class="text-center"><?php echo date("d-M-Y", $spExpDt); ?></td>
										<td class="text-center"><?php echo date("d-M-Y", $postDate); ?></td>					
										<td><?php echo showAcountNameProfile($dbConn, $spProfiles_idspProfiles); ?></td>				
										<td class="text-center"><?php echo $status; ?></td>
										<td class="text-center"><a href="<?php echo $BaseUrl; ?>/job-board/job-detail.php?postid=<?php echo $idspPostings; ?>" data-toggle="tooltip" title="Info"  class="btn menu-icon vd_bg-yellow" ><i class="fa fa-info"></i></a></td>

									</tr><?php
									$i++;
								}
							}else { ?>
								<tr>
									<td height="20">No User/ Admin Added Yet</td>
								</tr>
								<?php 
							} //end while ?>
							
	                </tbody>
	                
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
		
			
			