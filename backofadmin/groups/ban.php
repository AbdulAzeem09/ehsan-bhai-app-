<?php
	if (!defined('WEB_ROOT')) {
		exit;
	}


	//$sql =  "SELECT * FROM spgroup ";
	$sql = "SELECT * FROM spuser AS u INNER JOIN spprofiles AS p ON u.idspUser = p.spUser_idspUser INNER JOIN spprofiles_has_spgroup AS d ON p.idspProfiles = d.spProfiles_idspProfiles INNER JOIN spgroup AS g ON d.spGroup_idspGroup = g.idspGroup WHERE d.spProfileIsAdmin = 0 AND spgroupstatus = 1";
	$result  = dbQuery($dbConn, $sql);
	
	
?>
	
	<!-- Content Header (Page header) -->
	<section class="content-header top_heading">
		<h1>Banned Groups</h1>
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
								<th>ID</th>
								<th>Creater Name / Profile Name</th>
								<th>Group Name</th>
								<th class="text-center">Total Members</th>
								<!-- <th>Creation Date</th> -->
								<!-- <th>About Group</th> -->
								<th>Image</th>
								<th>Action</th>
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
										<td class="text-center"><?php echo $i; ?></td>
										<td><a href="javascript:detailGroup(<?php echo $idspGroup;?>)"><?php echo $spProfileName; ?></a></td>
										<td><?php echo $spGroupName; ?></td>
										<td class="text-center">
											<?php
											echo showgroupmember($dbConn, $idspGroup);
											?>
										</td>
										<!-- <td></td> -->
										<!-- <td><?php echo $spGroupAbout;?></td> -->
										<td><?php
										if (isset($spgroupimage) && $spgroupimage != '') {
										 	echo "<img class='' src=' " . ($spgroupimage) . "' style='width: 100px;' >";
										} ?></td>
										<td class="menu-action text-center">
											<?php
											if($spgroupstatus == 1){
												?>
												<a href="javascript:unlockGroup(<?php echo $idspGroup;?>)" data-toggle="tooltip" title="Active This Group" class="btn menu-icon vd_bg-green" ><i class="fa fa-unlock"></i></a>
												<?php
											}else{
												?>
												<a href="javascript:banGroup(<?php echo $idspGroup;?>)" data-toggle="tooltip" title="Ban This Group" class="btn menu-icon vd_bg-red" ><i class="fa fa-ban"></i></a>
												<?php
											}
											?>
											<a href="javascript:detailGroup(<?php echo $idspGroup;?>)" data-original-title="Detail" data-toggle="tooltip" data-placement="top" class="btn menu-icon vd_bg-yellow"> <i class="fa fa-info"></i> </a>
                                            <a href="javascript:deleteGroup(<?php echo $idspGroup;?>)" data-original-title="Delete" data-toggle="tooltip" data-placement="top" class="btn menu-icon vd_bg-red"> <i class="fa fa-times"></i> </a>
                                            
											
												
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
		<script type="text/javascript">
		
		$(document).ready( function () {
  var table = $('#example1').DataTable( {

   "order": [[ 0, "desc" ]],
    pageLength : 10,
    lengthMenu: [[10, 20, 50, 100], [10, 20, 50, 100]]
  } );
  
		        
		   
} );

	</script>	
		