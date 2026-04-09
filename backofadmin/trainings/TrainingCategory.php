<?php
	if (!defined('WEB_ROOT')) {
		exit;
	}
	//$rowsPerPage = 25;
	
 	
?>
	
	<!-- Content Header (Page header) -->
	<section class="content-header top_heading">
		<h1>Trainings Category <small>[List]</small></h1>
	</section>
	<!-- Main content -->
	<section class="content">
		<?php
        include "AddTrainingCat.php";
        ?>
		<div class="box box-success">
			<div>
				<?php 
				if(isset($_SESSION['errorMessage']) && isset($_SESSION['count'])){
					if($_SESSION['count'] <= 1){
						$_SESSION['count'] +=1; ?>
						<div class="space"></div>
						<p class="alert alert-success"><?php echo $_SESSION['errorMessage'];  ?></p> <?php
						unset($_SESSION['errorMessage']);
					}
				} ?>
			</div>
			<div class="box-body tbl-respon">
				<table id="example1" class="table table-bordered table-striped tbl-respon2">
	                <thead>
	                 	<tr>
							<th class="text-center" style="width: 80px;">Report No</th>
							<th class="text-center">Category</th>
							<th class="text-center">Action</th>
						</tr>
	                </thead>
	                <tbody>
	                	<?php
						$catiId = 8;
						$sql =	"SELECT * FROM subcategory WHERE subCategoryStatus != '-7' AND spCategories_idspCategory= $catiId ORDER BY `idsubCategory` ASC";
						$result = dbQuery($dbConn, $sql);
							if ($result){
								$i = 1;
								
								while($row = dbFetchAssoc($result)) {
									extract($row);
									
									?>
									<tr>

									<td class="text-center"><?php echo $i;?></td>
										
									<td class="text-center"><?php echo $subCategoryTitle; ?></td>

										<td class="text-center menu-action">
											
												<a href="<?php $_SERVER["DOCUMENT_ROOT"]?>/backofadmin/trainings/index.php?view=CategoryEdit&id=<?php echo $idsubCategory ;?>" data-toggle="tooltip" title="Edit!" class="btn menu-icon vd_bg-green" ><i class="fa fa-pencil" aria-hidden="true"></i></a>											
												<a href="<?php $_SERVER["DOCUMENT_ROOT"]?>/backofadmin/trainings/index.php?view=CategoryDelete&id=<?php echo $idsubCategory ;?>" data-toggle="tooltip" title="Delete!" class="btn menu-icon vd_bg-red" ><i class="fa fa-trash" aria-hidden="true"></i>
</a>
										</td>
									</tr><?php
									$i++;
								}
							}else { ?>
								<tr>
									<td height="20">No User/ Admin Added Yet</td>
								</tr>
								<?php 
							} //end while ?>
							
	                </tbody>
	                
              	</table>
			</div><!-- /.box-body -->
			

				<!--- End Table ---------------->
		</div>
		
		
		
	</section><!-- /.content -->
	<script type="text/javascript">
		
		$(document).ready( function () {
  var table = $('#example1').DataTable( {

   "order": [[ 0, "desc" ]],
    pageLength : 10,
    lengthMenu: [[10, 20, 50, 100, -1], [10, 20, 50, 100, ]]
  } );
  
		        
		   
} );

	</script>	
			