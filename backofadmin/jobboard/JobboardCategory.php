<?php
	if (!defined('WEB_ROOT')) {
		exit;
	}

?>
	
	<!-- Content Header (Page header) -->
	<section class="content-header top_heading">
		<h1>Job-Board Category <small>[List]</small></h1>
	</section>
	<!-- Main content -->
	<section class="content">
        <?php
       include "AddJobBoard.php";
        ?>
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
								<th>Category</th>								
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							<?php
				$sql1 =  "SELECT * FROM `subcategory` WHERE subCategoryStatus != '-7' AND `spCategories_idspCategory` = '2' ORDER BY `idsubCategory` ASC";
							$result1  = dbQuery($dbConn, $sql1);
							if ($result1) {
								$i = 1;
								while ($row = dbFetchAssoc($result1)) {
									extract($row);
									?>
									<tr>
										<td class="text-center"><?php echo $i; ?></td>
										
										<td><?php echo $row['subCategoryTitle']; ?></td>
										<td>
										
                                            <a href="<?php $_SERVER["DOCUMENT_ROOT"]?>/backofadmin/jobboard/index.php?view=EditJobBoard&id=<?php echo $row['idsubCategory'];?>" data-original-title="Edit" data-toggle="tooltip" data-placement="top" class="btn menu-icon vd_bg-yellow"> <i class="fa fa-pencil"></i> </a>
                                            <a href="<?php $_SERVER["DOCUMENT_ROOT"]?>/backofadmin/jobboard/index.php?view=DeleteJobBoard&id=<?php echo $row['idsubCategory'];?>" data-original-title="Delete" data-toggle="tooltip" data-placement="top" class="btn menu-icon vd_bg-red"> <i class="fa fa-times"></i> </a>
                                            
									
												
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