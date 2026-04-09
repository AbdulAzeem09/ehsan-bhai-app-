<?php
	if (!defined('WEB_ROOT')) {
		exit;
	}
	$userId = $_SESSION['userId'];
	
$sql =  "SELECT * FROM  store_faq WHERE module = 'store'";
	$result  = dbQuery($dbConn, $sql);

	
	
?>
	
	<!-- Content Header (Page header) -->
	<section class="content-header top_heading">
		<h1>FAQ Page</h1>
	</section>
	<!-- Main content -->
	<section class="content">
		<div class="box box-success">
			
			
			<div class="box-header text-right">
	                  	<button type="button" name="btnButton" class="btn btn-primary"  onclick="addProfileContent()"><i class="fa fa-plus"></i> Add FAQ</button>
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
								<th>Question</th>
								<th>Answer</th>
								
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
										<td class="text-center"><?php echo $i; ?></td>
										<td>
											<?php  echo  $spfaq_question;  ?>
										</td>

										<td>
											<?php  echo  $spfaq_answer;  ?>
										</td>

								
										<td class="menu-action text-center">

                                       <a href="javascript:modifyfaq(<?php echo $id;?>)" data-original-title="Edit" data-toggle="tooltip" data-placement="top" class="btn menu-icon vd_bg-yellow"> <i class="fa fa-pencil"></i> </a>

                                         <a href="javascript:deletee(<?php echo $id;?>)" data-original-title="Delete" data-toggle="tooltip" data-placement="top" class="btn menu-icon vd_bg-red"><i class="fa fa-trash"></i></a>
                                            											
											
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
		