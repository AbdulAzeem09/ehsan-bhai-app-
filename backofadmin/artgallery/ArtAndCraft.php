<?php
	if (!defined('WEB_ROOT')) {
		exit;
	}
	$rowsPerPage = 25;
	if(isset($_GET['pid'])){
		$pid = $_GET['pid'];
		$sql="SELECT * FROM sppostingsartcraft WHERE spProfiles_idspProfiles = $pid ORDER BY idspPostings ASC";
		}else{
  	$sql="SELECT * FROM sppostingsartcraft ORDER BY idspPostings DESC";
		}
  	$result = dbQuery($dbConn, $sql);
  	// custom pagignation
	//$result     = dbQuery($dbConn, getPagingQuery($sql, $rowsPerPage));
	//$pagingLink = getPagingLink($dbConn, $sql, $rowsPerPage);
 	
?>
	
	<!-- Content Header (Page header) -->
	<section class="content-header top_heading">
		<h1>Art And Craft <small> [List] </small> </h1>
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
							<th class="text-center" style="width: 80px;">Report No</th>
							<th>Title</th>
							<th>Posted Date</th>
							<th>Price</th>
							<th>Profile Name</th>											
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

									if ($spPostingVisibility == -1) {
										$status = "Active";
									}else if($spPostingVisibility == 0){
										$status = "Draft";
									}else if($spPostingVisibility == 1){
										$status = "Block";
									}
									//$status = "<img src='" .  WEB_ROOT_TEMPLATE . "/images/icon/active.png' alt='Active' width='24' height='24' />";
									?>
									<tr>

										<td class="text-center"><?php echo $i;?></td>
										
										<td><?php echo $spPostingTitle;	?></td>
										<td class="text-center"><?php echo date("d-M-Y", $postDate); ?></td>
										<td><?php echo $defaltcurrency.' '. $spPostingPrice ?></td>
										<td><?php showProfileName($dbConn, $spProfiles_idspProfiles); ?></td>
																			          
										<td class="text-center"><?php echo $status; ?></td>

										<td class="text-center menu-action">
										
											<!-- show all detail of that user -->
											<a href="<?php echo $BaseUrl; ?>/artandcraft/detail.php?postid=<?php echo $idspPostings; ?>" data-toggle="tooltip" title="Detail!" class="btn menu-icon vd_bg-blue"><i class="fa fa-info"></i></a>&nbsp; 									

										</td>
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
			