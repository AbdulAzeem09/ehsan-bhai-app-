<?php
	if (!defined('WEB_ROOT')) {
		exit;
	}

	$sql =  "SELECT * FROM rss_data WHERE rss_status != '2' ";
	$result  = dbQuery($dbConn, $sql);
	
	
?>
	
	<!-- Content Header (Page header) -->
	<section class="content-header ">
		<h1>RSS Feed<small>[List]</small></h1>
	</section>
	<!-- Main content -->

	<section class="content">

        <?php
        include "add.php";
        ?>

		<div class="box box-success">

			<div class="box-body">
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
					
					<div class="" >
						<div class="table-responsive ">
							<table id="example1" class="table table-bordered table-striped ">
								<thead>
									<tr>
										<th class="text-center" style="width: 80px;">ID</th>
										<th>Website Name</th>
										<th>Website Link</th>
										<th>Country</th>
										<th>Category</th>
										<th>Status</th>
										<th class="text-center">Action</th>
									</tr>
								</thead>
								<tbody>
									<?php
									if ($result) {
										$i = 1;
										while ($row = dbFetchAssoc($result)) {
											extract($row);
											?>
											<tr>
												<td class="text-center"><?php echo $rss_id; ?></td>
												<td><?php echo $website_name; ?></td>
												<td><?php echo $website_link; ?></td>
												<td>
													<?php 
														$sql     = "SELECT * FROM tbl_country WHERE country_id = '$country';";
														$result3 = dbQuery($dbConn, $sql);

                            $sqlr = "SELECT * FROM rss_data WHERE rss_id = '$rss_id';";
                            $result5 = dbQuery($dbConn, $sqlr);
                            $fetch_row = mysqli_fetch_array($result5);
                            
														if ($result3 != false) {
															$row3 = mysqli_fetch_assoc($result3);
                            
                              if($fetch_row['country'] == '0' || $fetch_row['country'] == 0)
                              {
                                echo 'World';
                              }
                              else {
															echo $row3['country_title']; 
                            }
														}
                            
													?>
														
												</td>
												<td>
													<?php 
														$sql     = "SELECT * FROM news_categories WHERE id = '$category';";
														$result4 = dbQuery($dbConn, $sql);
														if ($result4 != false) {
															$row4 = mysqli_fetch_assoc($result4);
															echo $row4['name']; 
														}
													?>
												<td>Active
													<?php
													// if ($rss_status == 1) {
													// 	echo "Active";
													// }else{
													// 	echo "In Active";
													// }
													?>
												</td>
												<td class="menu-action text-center">
													<a href="javascript:modifyRecord(<?php echo $rss_id; ?>)" data-original-title="Edit" data-toggle="tooltip" data-placement="top" class="btn menu-icon vd_bg-yellow"> <i class="fa fa-pencil"></i> </a>
	                                                <a href="javascript:deleteRecord(<?php echo $rss_id; ?>)" data-original-title="Delete" data-toggle="tooltip" data-placement="top" class="btn menu-icon vd_bg-red"> <i class="fa fa-times"></i> </a>
	                                                
													
												</td>
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
			</div>
			
				<!--- End Table ---------------->
		</div>
        
		
	</section><!-- /.content -->
	<script type="text/javascript">
		
		$(document).ready( function () {
  var table = $('#example1').DataTable( {

   "order": [[ 0, "desc" ]],
    pageLength : 10,
    lengthMenu: [[10, 20, 50, 100], [10, 20, 50, 100,]]
  } );
  
		        
		   
} );

	</script>
