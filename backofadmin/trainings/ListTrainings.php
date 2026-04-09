<?php
	if (!defined('WEB_ROOT')) {
		exit;
	}
	$rowsPerPage = 25;
	if(isset($_GET['pid'])){
		$pid = $_GET['pid'];
		$sql="SELECT * FROM sptraining WHERE spProfiles_idspProfiles = $pid";
		}else{
  		$sql="SELECT * FROM sptraining ";
		}
  	$result = dbQuery($dbConn, $sql);
  	// custom pagignation
	//$result     = dbQuery($dbConn, getPagingQuery($sql, $rowsPerPage));
	//$pagingLink = getPagingLink($dbConn, $sql, $rowsPerPage);
 	
?>
	
	<!-- Content Header (Page header) -->
	<section class="content-header top_heading">
		<h1>Trainings <small>[List]</small></h1>
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
							<th>Category</th>																				<th>Price</th>
							<th>Company</th>
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
									
									?>
									<tr>

										<td class="text-center"><?php echo $i;?></td>
									
										<td><?php echo $spPostingTitle;	?></td>																		
										<td><?php echo $trainingcategory; ?> </td>
										
										<td><?php
									 $discountedPrice = $spPostingPrice - ($spPostingPrice* ($txtDiscount/100));
										echo $default_currency.' '.$discountedPrice; ?> </td>
										<td><?php echo $spPostingCompany; ?>
									<!-- <td class="text-center"><?php echo $status; ?></td> -->

										<td class="text-center menu-action">
																																<a href="<?php echo $BaseUrl; ?>/trainings/detail.php?postid=<?php echo $id; ?>" data-toggle="tooltip" title="Detail!" class="btn menu-icon vd_bg-blue"><i class="fa fa-info"></i></a>&nbsp; 
																						
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
    lengthMenu: [[10, 20, 50, 100, -1], [10, 20, 50, 100, ]]
  } );
  
		        
		   
} );

	</script>	
			