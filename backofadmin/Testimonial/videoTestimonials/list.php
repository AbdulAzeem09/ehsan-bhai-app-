<?php
	if (!defined('WEB_ROOT')) {
		exit;
	}
	if (!isset($_SESSION['username']) || $_SESSION['username'] == ''){
		redirect( WEB_ROOT_ADMIN . 'login.php');
	 }
	$res_data = selectQ("SELECT * from spvideotestimonial", "i","");
	
?>
	
	<!-- Content Header (Page header) -->
	<section class="content-header top_heading">
		<h1>Video Testimonial</h1>
	</section>
	<!-- Main content -->
	<section class="content">
		<div class="box box-success">
			
			
			<div class="box-header text-right">
              	<button type="button" name="btnButton" class="btn btn-primary"  onclick="addlokingJobContent()"><i class="fa fa-plus"></i> Add Testimonial</button>
            </div><!-- /.box-header -->
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
								<th>Id</th>
                                <th>Name</th>
                                <th>Designation</th>
                                <th>Image</th>
								<th style="width: 390px;">Youtube Url</th>
								<th style="width: 110px;">Action</th>
							</tr>
						</thead>
						<tbody>
							<?php
							if ($res_data) {
								$i = 1;
								foreach ($res_data as $row) {
									extract($row);
									?>
									<tr>
										<td class="text-center"><?php echo $i; ?></td>
										<td>
											<?php  echo $row['name'];  ?>
										</td>
                                        <td>
											<?php  echo $row['designation'];  ?>
										</td>
                                        <td>
										<img width="100" height="100" src="<?php echo $row['image']; ?>">
										</td>
										
                                        <td>
											<?php  echo $row['youtubeUrl'];  ?>
										</td>
										<td class="menu-action text-center">
											<a href="javascript:modifyContnt(<?php echo $row['id'];?>)" data-original-title="Edit" data-toggle="tooltip" data-placement="top" class="btn menu-icon vd_bg-yellow"> <i class="fa fa-pencil"></i> </a>
											<a href="processContent.php?action=delete&&conId=<?php echo $row['id'];?>" data-original-title="Delete" data-toggle="tooltip" data-placement="top" class="btn menu-icon vd_bg-red"><i class="fa fa-trash"></i></a>

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
