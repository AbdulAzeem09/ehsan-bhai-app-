<?php
	if (!defined('WEB_ROOT')) {
		exit;
	}


	$sql =  "SELECT * FROM craft_category ";
	$result  = dbQuery($dbConn, $sql);
	
	
?>
	
	<!-- Content Header (Page header) -->
	<section class="content-header top_heading">
		<h1>Craft Gallery Subcategory</h1>
	</section>
	<!-- Main content -->
	<section class="content">
        <?php
        include "add.php";
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
			
			
			

	$sql1 =  "SELECT * FROM craft_subcategory ";
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
								<th>Title</th>
								
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
										
										$sql2 =  "SELECT * FROM craft_category WHERE id = $idspCraftcategory";
										$result2  = dbQuery($dbConn, $sql2);
										$row2 = dbFetchAssoc($result2);
										echo $row2['craft_title']; 
										
										?></td>
										
										<td><?php echo $spCraftgalleryTitle; ?></td>
										<td>

                                            <a href="javascript:modifyCategory(<?php echo $idspCraftgallery;?>)" data-original-title="Edit" data-toggle="tooltip" data-placement="top" class="btn menu-icon vd_bg-yellow"> <i class="fa fa-pencil"></i> </a>
                                            <a href="javascript:deleteCategory(<?php echo $idspCraftgallery;?>)" data-original-title="Delete" data-toggle="tooltip" data-placement="top" class="btn menu-icon vd_bg-red"> <i class="fa fa-times"></i> </a>
                                            
									
												
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
		