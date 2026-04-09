<?php
	if (!defined('WEB_ROOT')) {
		exit;
	}
	$userId = $_SESSION['userId'];
	$sql =  "SELECT * FROM  spadminstorebanner  AS t where modulename = 'store'";

	$result  = dbQuery($dbConn, $sql);
	
	
?>
	
	<!-- Content Header (Page header) -->
	<section class="content-header top_heading">
		<h1>Upload Store Banner</h1>
	</section>
	<!-- Main content -->
	<section class="content">
		<div class="box box-success">
			
			
			<div class="box-header text-right">
              	<button type="button" name="btnButton" class="btn btn-primary"  onclick="add()"><i class="fa fa-plus"></i> Upload Store Banner</button>
            </div><!-- /.box-header -->
			
			
			
		 	<div class="box-body" >
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
								<th class="text-center">Id</th>
								<th>Module</th>
								<th>Banner</th>
<!-- 								<th>Content</th> -->
								<th style="width: 90px;" class="text-center">Action</th>
							</tr>
						</thead>
						<tbody>
							<?php

							//print_r($result);

							if ($result) {
								$i = 1;
								while ($row = dbFetchAssoc($result)) {
								//	extract($row);
									 $imageURL = 'images/'.$row["image"];
									?>
									<tr>
										<td class="text-center"><?php echo $i; ?></td>
										<td><?php echo $row["modulename"]; ?></td>
										
									<td>
								<img src="<?php echo $imageURL; ?>"  alt="" width="80px" height="80px"/>

										</td> 
										
										<td class="menu-action text-center">

                                          <!--   <a href="javascript:modify(<?php echo $pc_id;?>)" data-original-title="Edit" data-toggle="tooltip" data-placement="top" class="btn menu-icon vd_bg-yellow"> <i class="fa fa-pencil"></i> </a>
 -->
                                      <!--    <a href="javascript:deletee(<?php echo $row["id"];?>)" data-original-title="Delete" data-toggle="tooltip" data-placement="top" class="btn menu-icon vd_bg-red"> <i class="fa fa-times"></i> </a> -->

                        <a href="javascript:deletee(<?php echo $row["id"];?>)" data-original-title="Delete" data-toggle="tooltip" data-placement="top" class="btn menu-icon vd_bg-red"><i class="fa fa-trash"></i></a>
                                            									
											
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
		