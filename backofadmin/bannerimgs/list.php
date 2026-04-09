<?php
	if (!defined('WEB_ROOT')) {
		exit;
	}

	
	$sql =  "SELECT * FROM events_imgs WHERE isActive = 1 ";
	$result  = dbQuery($dbConn, $sql);
?>
	
	<!-- Content Header (Page header) -->
	<section class="content-header top_heading">
		<h1>Event Banner Images</h1>
	</section>
	<!-- Main content -->
	<section class="content">
        <?php
        include "add.php";
        ?>
		<div class="box box-success">
			
			<?php 
			if(isset($_SESSION['errorMessage']) ){
		 ?>
					<div class="row" id="alertmsg" style="margin: 5px 0px 0px 5px;" >
						<div style="min-height:10px;"></div>
						<div class="alert alert-danger">
							<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
							<?php echo $_SESSION['errorMessage'];  ?>
						</div> 
					</div><?php
					unset($_SESSION['errorMessage']);
			}
			?>
			
			<!-- /.box-header -->
			<div class="box-body" >
				<div class="table-responsive tbl-respon">
					<table id="example1" class="table table-bordered table-striped tbl-respon2">
						<thead>
							<tr>
								<th style="width: 80px;">ID</th>
								<th>Title</th>
								
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
										<td><img src="uploads/<?php echo $eventImg; ?>" style="width:50px;height:auto;"></td>
										<td class="menu-action text-center">

                                            <a data-toggle="modal" data-target="#exampleModal<?php echo $eventImgId; ?>" class="btn menu-icon vd_bg-red"> <i class="fa fa-times"></i> </a>
                                            
										
										</td>
									</tr>
							<div class="modal fade" id="exampleModal<?php echo $eventImgId; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Delete Bannner Image ?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Are you sure you want to delete this Banner Image?
      </div>
      <div class="modal-footer">
        <button  type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <a href="uploadImage.php?deleteImg=<?php echo $eventImgId; ?>"  class="btn btn-danger">Delete</a>
      </div>
    </div>
  </div>
</div>
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
        
		<!-- Modal -->


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
		