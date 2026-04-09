<?php


require_once '../library/config.php';
require_once '../library/functions.php';
error_reporting(0);
@ini_set('display_errors', 0);
	if (!defined('WEB_ROOT')) {
		exit;
	}
 	 
?>
	<?php
	$sql =  "SELECT * FROM sharepage_event_category";
	$result  = dbQuery($dbConn, $sql);
	?>
	
	<!-- Content Header (Page header) -->
	<section class="content-header top_heading ">
    <!-- <div class="d-flex justify-content-between"> -->
        <h1>Share Event Category</h1>
        <a href="javascript:addArtCat()" data-original-title="Add" data-toggle="tooltip" data-placement="top"  class="btn btn-success">Add Event Category</a>
    <!-- </div> -->
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
			} 	
			?>
			<!-- /.box-header -->
			<div class="box-body" >
				<div class="table-responsive tbl-respon">
					<table id="example1" class="table table-bordered table-striped tbl-respon2">
						<thead> 
							<tr>
								<th>ID</th>									
								<th>Category Name</th>										
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
										<td><?php echo $row['category_title']?></td>
										<td>
                                            <a href="javascript:modifyRegType(<?php echo $row['cat_id']?>)" data-original-title="Edit" data-toggle="tooltip" data-placement="top" class="btn menu-icon vd_bg-yellow"> <i class="fa fa-pencil"></i> </a>
                                            <a href="javascript:deleteRegType(<?php echo $row['cat_id']?>)" data-original-title="Delete" data-toggle="tooltip" data-placement="top" class="btn menu-icon vd_bg-red"> <i class="fa fa-times"></i> </a>
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
        
		
	</section>


<script> 
	// JavaScript Document
	//ADD
	 function addArtCat(){
		window.location.href = 'eventCategory_index.php?view=add';
	} 
	//MODIFY
	function modifyRegType(ArtCat){
		window.location.href = 'eventCategory_index.php?view=modify&id=' + ArtCat;
	}
	// //DELETE 
	function deleteRegType(ArtCat){
		if (confirm('Do You Want Delete this Event Category?')) {
			window.location.href = 'share_process_category.php?action=delete&id=' + ArtCat;
		}
	}


</script>