<?php
	if (!defined('WEB_ROOT')) {
		exit;
	}


	$sql =  "SELECT * FROM nft_category";
	$result  = dbQuery($dbConn, $sql);
	
	
?>
	
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>NFT Category<small>[List]</small></h1>
	</section>
	<!-- Main content -->
	<section class="content">
		<div class="box box-success">
			<div class="box-header text-right">
				<a href="<?php $_SERVER["DOCUMENT_ROOT"]?>/backofadmin/nft/index.php?view=add" name="btnButton"  class="btn btn-primary"   ><i class="fa fa-plus"></i> Add</a>
					
			</div>
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
				
			
				<div class="table-responsive tbl-respon">
					<table id="example1" class="table table-bordered table-striped tbl-respon2">
						<thead>
							<tr>
								<th class="text-center" style="width: 80px;">ID</th>
								<th>Title</th>
								<th style="width: 80px;">Action</th>
							</tr>
						</thead>
						<tbody>
							<?php
							if ($result) {
								$i = 1;
								while ($row = dbFetchAssoc($result)) {
							
									?>
									<tr>
										<td class="text-center"><?php echo $i; ?></td>
										<td><?php echo $row['name']; ?></td>
										
										<td class="menu-action text-center">
											<!--<a href="<?php $_SERVER["DOCUMENT_ROOT"]?>/backofadmin/nft/index.php?view=edit&id=<?php echo base64_encode($row['id']); ?>" data-original-title="Edit" data-toggle="tooltip" data-placement="top" class="btn menu-icon vd_bg-yellow"> <i class="fa fa-pencil"></i> </a>-->
											
											<a href="index.php?view=edit&id=<?php echo $row['id']; ?>" data-original-title="Update" data-toggle="tooltip" data-placement="top" class="btn menu-icon vd_bg-yellow"><i class="fa fa-pencil"></i>  </a>
	                                       <!-- <a href="<?php $_SERVER["DOCUMENT_ROOT"]?>/backofadmin/nft/process.php?action=delete&id=<?php echo base64_encode($row['id']); ?>" data-original-title="Delete" data-toggle="tooltip" data-placement="top" class="btn menu-icon vd_bg-red"> <i class="fa fa-times"></i> </a>-->
											
											<a href="javascript:delete_nft(<?php echo $row['id']; ?>)" data-original-title="delete" data-toggle="tooltip" data-placement="top" class="btn menu-icon vd_bg-red"> <i class="fa fa-times"></i> </a>
	                                               
												
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
		