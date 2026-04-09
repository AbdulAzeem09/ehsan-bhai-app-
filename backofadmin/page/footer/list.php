<?php
	if (!defined('WEB_ROOT')) {
		exit;
	}
	$userId = $_SESSION['userId'];
	$sql =  "SELECT * FROM  tbl_page AS t INNER JOIN tbl_foot_heading AS p ON t.fh_id = p.fh_id";
	$result  = dbQuery($dbConn, $sql);
	
	
?>
	
	<!-- Content Header (Page header) -->
	<section class="content-header top_heading">
		<h1>Footer Pages</h1>
	</section>
	<!-- Main content -->
	<section class="content">
		<div class="box box-success">
			
			
			<div class="box-header text-right">
              	<button type="button" name="btnButton" class="btn btn-primary"  onclick="add()"><i class="fa fa-plus"></i> Add Footer Page</button>
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
								<th style="width: 80px;">Id</th>
								<th>Foot Title</th>
								<th>Title</th>
								<th>Date</th>
								<th>Status</th>
								<th style="width: 90px;text-align: center;">Action</th>
							</tr>
						</thead>
						<tbody>
							<?php
							if ($result) {
								$i = 1;
								while ($row = dbFetchAssoc($result)) {
									extract($row);
									if ($status == 1) {
										$status_new = "Active";	
									} else {
										$status_new = "In-active";	
									}
									?>
									<tr>
										<td class="text-center"><?php echo $i; ?></td>
										<td><?php echo $fh_title; ?></td>
										<td><?php echo $page_title;  ?></td>
										<td><?php echo $page_date;  ?></td>
										<td><?php echo $status_new; ?></td>
										<td class="menu-action text-center">

                                            <a href="javascript:modify(<?php echo $page_id;?>)" data-original-title="Edit" data-toggle="tooltip" data-placement="top" class="btn menu-icon vd_bg-yellow"> <i class="fa fa-pencil"></i> </a>
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
		