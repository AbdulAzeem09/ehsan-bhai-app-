<?php
	if (!defined('WEB_ROOT')) {
		exit;
	}
	$userId = $_SESSION['userId'];
	$sql =  "SELECT * FROM tbl_notes WHERE user_id_from = $userId AND spNotesStatus != '-7' ORDER BY idspNotes  DESC";
	$result  = dbQuery($dbConn, $sql);
	
	
?>
	<?php include(THEME_PATH . '/tb_link.php');?>
	<!-- Content Header (Page header) -->
	
<style>
.swal2-popup { 
font-size: small !important;
}
 </style>
	<section class="content-header">
		<h1>Sticky Notes<small>[List]</small></h1>
	</section>
	<!-- Main content -->
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="box box-success">
					<div class="box-header text-right">
	                  	<button type="button" name="btnButton" class="btn btn-primary"  onclick="addNotes()"><i class="fa fa-plus"></i> Add Notes</button>
	                </div><!-- /.box-header -->
					
					
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
						<div class="table-responsive ">
							<table id="example1" class="table table-bordered table-striped ">
								<thead>
									<tr>
										<th >ID</th>
										<th>Title</th>
										<th>Assigned To</th>
										<th style="width: 80px;">Date</th>
										<th>Menu Note</th>
										<th>Short Descripiton</th>
										<th>Status</th>
										<th style="width: 100px;">Action</th>
									</tr>
								</thead>
								<tbody>
									<?php
									if ($result) {
										$i = 1;
										while ($row = dbFetchAssoc($result)) {
											extract($row);
											$postDate = strtotime($spNotesDate);

											if ($spNotesStatus == 0) {
											 	$status = "Pending";
											}else if($spNotesStatus == 1){
												$status = "Cross Check";
											}else if($spNotesStatus == -1){
												$status = "Working";
											}else{
												$status = "Completed";
											} 

											$status_str = str_replace(' ', '', $status);
											?>
											<tr>
												<td class="text-center"><?php echo $idspNotes; ?></td>
												<td><?php echo $spNotesTitle; ?></td>
												<td><?php showUserName($dbConn, $user_id_to); ?></td>
												<td><?php echo date("d-M-Y", $postDate); ?></td>
												<td><?php echo $spNoteMenu;?></td>
												<td><?php echo $spNoteShrtDesc; ?></td>
												<td class="bg_<?php echo $status_str;?>"><?php echo $status; ?></td>
												<td class="menu-action text-center">
												<?php
													if ($spNotesStatus == 1) {
														?>
														<a onclick="permanentDelete(<?php echo $idspNotes; ?>)" data-original-title="Approved" data-toggle="tooltip" data-placement="top" class="btn menu-icon vd_bg-green" ><i class="fa fa-check"></i></a>&nbsp;
														
														<a href="javascript:rejNotes(<?php echo $idspNotes;?>)" data-original-title="Rejected" data-toggle="tooltip" data-placement="top" class="btn menu-icon vd_bg-red" ><i class="fa fa-ban"></i></a>&nbsp;
														<?php
													}
													if ($spNotesStatus != 2) {
														?>
														<a href="javascript:modifyNotes(<?php echo $idspNotes;?>)" data-original-title="Edit" data-toggle="tooltip" data-placement="top" class="btn menu-icon vd_bg-yellow" ><i class="fa fa-edit"></i></a>&nbsp;
														<?php
													}
													?>
													<a href="javascript:viewNotes(<?php echo $idspNotes;?>)" data-original-title="Detail" data-toggle="tooltip" data-placement="top" class="btn menu-icon vd_bg-blue" ><i class="fa fa-eye"></i></a>&nbsp;
													<a href="javascript:deleteNotes(<?php echo $idspNotes;?>)" data-original-title="Delete" data-toggle="tooltip" data-placement="top" class="btn menu-icon vd_bg-red" ><i class="fa fa-trash"></i></a>
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
<script src="<?php echo $baseurl?>/assets/js/sweetalert.js"></script> 
    <script>
        function permanentDelete(userId) {
        Swal.fire({
        title: 'Are You Sure You Want to Approved?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, Approved!'
        }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = 'processNotes.php?action=approve&noteId=' + userId;
        }
        });
        }
    </script>