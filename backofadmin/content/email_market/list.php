<?php
	if (!defined('WEB_ROOT')) {
		exit;
	}
	$userId = $_SESSION['userId'];
	$sql =  "SELECT * FROM  spcontent WHERE contPageId = 4";
	$result  = dbQuery($dbConn, $sql);
	
	
?>
	
	<!-- Content Header (Page header) -->
	<section class="content-header top_heading">
		<h1>Email Marketing</h1>
	</section>
	<!-- Main content -->
	<section class="content">
		<div class="box box-success">
			
			<!-- <div class="row">
				<div class="col-md-12 text-right">
					<div style="margin: 10px 5px 0px;">
						<button type="submit" name="btnButton"  class="btn btn-primary" onclick="addHireEmpContent()"  ><i class="fa fa-plus"></i> Add Content</button>
					</div>
				</div>
			</div>
			 -->
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
				<div class="table-responsive tbl-respon">
					<table id="example1" class="table table-bordered table-striped tbl-respon2">
						<thead>
							<tr>
								<th>Title</th>
								<th>Date</th>
								<th>Description</th>
								<th>Icon</th>
								<th style="width: 90px;">Action</th>
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
										<td><?php echo $contTitle; ?></td>
										<td class="text-center"><?php echo $contDate; ?></td>
										<td>
											<?php  echo $contDesc;  ?>
										</td>
										<td>
											<?php
											if ($contIcon != '') {
												echo "<img src='" .  WEB_ROOT . "/upload/content/".$contIcon."' alt='' width='40' height='40' />";	
											} ?>
										</td>
										<td class="menu-action text-center">

                                            <a href="javascript:modifyContnt(<?php echo $idspContent;?>)" data-original-title="Edit" data-toggle="tooltip" data-placement="top" class="btn menu-icon vd_bg-yellow"> <i class="fa fa-pencil"></i> </a>
                                            
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
		