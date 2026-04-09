<?php
	if (!defined('WEB_ROOT')) {
		exit;
	}

	if (isset($_GET['pid']) && $_GET['pid'] > 0) {
		$pid = $_GET['pid'];
		$sql = "SELECT * FROM flagpost AS f INNER JOIN sppostings AS p ON f.spPosting_idspPosting = p.idspPostings  WHERE p.spProfiles_idspProfiles = $pid GROUP BY p.idspPostings";
		$result  = dbQuery($dbConn, $sql);
	}else{
		redirect('index.php?view=flaguser');
	}
	
?>
	
	<!-- Content Header (Page header) -->
	<section class="content-header top_heading">
		<h1>Flagged User</h1>
	</section>
	<!-- Main content -->
	<section class="content">
		<div class="box box-success">
			
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
			
			<div class="box-body" >
				<div class="table-responsive tbl-respon">
					<table id="example1" class="table table-bordered table-striped tbl-respon2">
						<thead>
							<tr>
								<th style="width: 80px;">ID</th>
								<th>Profile Name</th>
								<th>Posting Title</th>
								<th>Module</th>
								<th style="width: 80px;">Action</th>
							</tr>
						</thead>
						<tbody>
							<?php
							if ($result) {
								$i = 1;
								while ($row = dbFetchAssoc($result)) {
									//print_r($row); die('ddddddddddd');
									extract($row);

									?>
									<tr>
										<td class="text-center"><?php echo $i; ?></td>
										<td><?php showProfileName($dbConn, $spProfile_idspProfile); ?></td>
										<td><?php showPostTitle($dbConn, $idspPostings); ?></td>
										<td><?php showCategoryName($dbConn, $spCategories_idspCategory); ?></td>
										<td class="menu-action text-center">

                                            <a href="javascript:detail(<?php echo $spCategories_idspCategory.", ". $flag_id;?>)" data-original-title="Detail" data-toggle="tooltip" data-placement="top" class="btn menu-icon vd_bg-yellow"> <i class="fa fa-info"></i> </a>
                                   
												
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
				<!--- End Table ---------------->
		</div>
        
		
	</section><!-- /.content -->
		