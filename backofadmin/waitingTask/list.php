<?php
	if (!defined('WEB_ROOT')) {
		exit;
	}
	$userId = $_SESSION['userId'];
	//$sql =  "SELECT * FROM tbl_notes WHERE user_id_from = $userId AND spNotesStatus = 1";
	$sql =  "SELECT * FROM tbl_notes WHERE user_id_to = $userId AND spNotesStatus = 1";
	$result  = dbQuery($dbConn, $sql);
	
	
?>
	
	<!-- Content Header (Page header) -->
	<section class="content-header ">
		<h1>Waiting Task <small>[List]</small></h1>
	</section>
	<!-- Main content -->
	<section class="content">
		<div class="box box-success">
			
			
			
			<div class="box-body" >
				<div class="table-responsive tbl-respon">
					<table id="example1" class="table table-bordered table-striped tbl-respon2">
						<thead>
							<tr>
								<th>ID</th>
								<th>Title</th>
								
								<th style="width: 80px;">Review Date</th>
								<th>Description</th>
								<th>Status</th>
								<th style="width: 60px;">Action</th>
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
										
										<td><?php echo date("d-M-Y", $postDate); ?></td>
										<td><?php 
											if(strlen($spNotesDesc) > 100){
												echo substr($spNotesDesc, 0,80)."...";
												
											}else{
												echo $spNotesDesc; 
											}
										?></td>
										<td class="bg_<?php echo $status_str;?>"><?php echo $status; ?></td>
										<td class="menu-action text-center">

											<a href="javascript:viewNotes(<?php echo $idspNotes;?>)" data-original-title="Detail" data-toggle="tooltip" data-placement="top" class="btn menu-icon vd_bg-green" ><i class="fa fa-eye"></i></a>&nbsp;
											

											
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