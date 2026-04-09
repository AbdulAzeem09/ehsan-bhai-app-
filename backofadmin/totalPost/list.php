<?php
	if (!defined('WEB_ROOT')) {
		exit;
	}
	$rowsPerPage = 25;
	$sql = "SELECT * FROM sppostings AS s INNER JOIN spprofiles AS p ON s.spProfiles_idspProfiles = p.idspProfiles WHERE spPostingVisibility = -1 ORDER BY idspPostings DESC ";
  	//$sql		=	"SELECT * FROM sppostings WHERE spPostingVisibility = -1 ORDER BY idspPostings DESC";
  	$result = dbQuery($dbConn, $sql);
  	// custom pagignation
	//$result     = dbQuery($dbConn, getPagingQuery($sql, $rowsPerPage));
	//$pagingLink = getPagingLink($dbConn, $sql, $rowsPerPage);
 	
?>
	
	<!-- Content Header (Page header) -->
	<section class="content-header top_heading">
		<h1>All Active Posts<small>[List]</small></h1>
	</section>
	<!-- Main content -->
	<section class="content">

		


		<div class="box box-success">
			
			<div class="box-body tbl-respon">
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
              	<table id="example1" class="table table-bordered table-striped tbl-respon2">
	                <thead>
	                 	<tr>
							<th class="text-center">Sr.No</th>
							<th>Title</th>
							<th>Phone</th>
							<th>Email</th>
							<th>Country</th>
							

							
							<th>Action</th>
						</tr>
	                </thead>
	                <tbody>
	                	<?php
							if ($result){
								$i = 1;
								
								while($row = dbFetchAssoc($result)) {
									extract($row);
									
									?>
									<tr>
										<td class="text-center"><?php echo $i;?></td>
                                             <td> <a href="<?php echo  $BaseUrl.'/publicpost/post_comment_details.php?postid='.$idspPostings.'&loadcom';?>"><?php echo $spPostingTitle;	?></a></td>
										<td><?php echo $spProfilePhone; ?></td>
										<td><?php echo $spProfileEmail; ?></td>
										<td>
	                                        <?php
	                                        if($spPostingsCountry > 0 && $spPostingsCountry != ''){
	                                            CountryName($dbConn, $spPostingsCountry);
	                                        } ?>
	                                    </td>
										
										

										<td class="menu-action text-center">

											<a href="javascript:deletePost(<?php echo $idspPostings; ?>)" data-original-title="Delete" data-toggle="tooltip" data-placement="top" class="btn menu-icon vd_bg-red"><i class="fa fa-trash"></i></a>
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
			
			