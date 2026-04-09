<?php
	if (!defined('WEB_ROOT')) {
		exit;
	}


	$sql =  "SELECT * FROM spcategories WHERE spCategoryStatus != '-7' ";
	$result  = dbQuery($dbConn, $sql);
	
	
?>
	
	<!-- Content Header (Page header) -->
	<section class="content-header ">
		<h1>Main Category<small>[List]</small></h1>
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
										<th>Title</th>
										<th>Folder Name</th>
										<th>Image</th>
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
												<td class="text-center"><?php echo $idspCategory; ?></td>
												<td><?php echo $spCategoryName; ?></td>
												<td><?php echo $spCategoryFolder; ?></td>
												<td>
													<?php
													if ($spCategoryImage != '') {
														echo "<img src='" .  WEB_ROOT . "/upload/category/".$spCategoryImage."' alt='' width='40' height='40' />";	
													}
													?>
												</td>
												<td>
													<?php
													if ($spCategoryStatus == 1) {
														echo "Active";
													}else{
														echo "In Active";
													}
													?>
												</td>
												<td class="menu-action text-center">
													<a href="<?php $_SERVER["DOCUMENT_ROOT"]?>/backofadmin/mainCategory/index.php?view=modify&catId=<?php echo $idspCategory; ?>" data-original-title="Edit" data-toggle="tooltip" data-placement="top" class="btn menu-icon vd_bg-yellow"> <i class="fa fa-pencil"></i> </a>
	                                                <a href="<?php $_SERVER["DOCUMENT_ROOT"]?>/backofadmin/mainCategory/index.php?view=deletes&catId=<?php echo $idspCategory; ?>" data-original-title="Delete" data-toggle="tooltip" data-placement="top" class="btn menu-icon vd_bg-red"> <i class="fa fa-times"></i> </a>
	                                                
													
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
