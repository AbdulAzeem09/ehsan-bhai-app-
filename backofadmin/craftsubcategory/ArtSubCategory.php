<?php
	if (!defined('WEB_ROOT')) {
		exit;
	}

	$catid = 13;

	$sql ="SELECT * FROM `art_category` ORDER BY `spArtgalleryTitle` ASC";
	
	$result  = dbQuery($dbConn, $sql);
	
	
?>
	
	<!-- Content Header (Page header) -->
	<section class="content-header top_heading">
		<h1>Art&Craft SubCategory</h1>
	</section>
	<!-- Main content -->
	<section class="content">
        <?php
        include "AddArtSubCategory.php";
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
			
			
			

	$sql1 =  "SELECT * FROM `art_subcategory` ORDER BY `idspArtgallery` DESC";
	$result1  = dbQuery($dbConn, $sql1);
	
			?>
			
			<!-- /.box-header -->
			<div class="box-body" >
				<div class="table-responsive tbl-respon">
					<table id="example1" class="table table-bordered table-striped tbl-respon2">
						<thead>
							<tr>
								<th>ID</th>
								<th>Category</th>
								<th>Sub Category</th>
								
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							<?php
							if ($result1) {
								$i = 1;
								while ($row = dbFetchAssoc($result1)) {
									extract($row);
									?>
									<tr>
										<td class="text-center"><?php echo $i; ?></td>
										
										<td><?php 
										$idsubCategory = $row['idspArtcategory'];
										
									$sql2 = "SELECT * FROM `art_category` WHERE `idspArtgallery` = $idsubCategory ";

										$result2  = dbQuery($dbConn, $sql2);
										$row2 = dbFetchAssoc($result2);
										echo $row2['spArtgalleryTitle']; 
										
										?></td>
										
										<td><?php echo $row['spArtgalleryTitle']; ?></td>
										<td>
										
                                            <a href="<?php $_SERVER["DOCUMENT_ROOT"]?>/backofadmin/craftsubcategory/index.php?view=ArtSubCategoryEdit&id=<?php echo $row['idspArtgallery'];?>" data-original-title="Edit" data-toggle="tooltip" data-placement="top" class="btn menu-icon vd_bg-yellow"> <i class="fa fa-pencil"></i> </a>

                                            <a href="<?php $_SERVER["DOCUMENT_ROOT"]?>/backofadmin/craftsubcategory/index.php?view=ArtSubCategoryDelete&id=<?php echo $row['idspArtgallery'];?>" data-original-title="Delete" data-toggle="tooltip" data-placement="top" class="btn menu-icon vd_bg-red"> <i class="fa fa-times"></i> </a>
                                            
									
												
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

   "order": [[ 0, "asc" ]],
    pageLength : 10,
    lengthMenu: [[10, 20, 50, 100], [10, 20, 50, 100]]
  } );
  
		        
		   
} );

	</script>		