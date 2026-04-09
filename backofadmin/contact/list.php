<?php
	if (!defined('WEB_ROOT')) {
		exit;
	}
	$rowsPerPage = 10;
	$sql =  "SELECT * FROM tbl_contact ORDER BY spConId DESC";
	$result     = dbQuery($dbConn, $sql);
	
	if(isset($_GET['msg'])&&($_GET['msg']=='update')){ ?>
		<div class="alert alert-success" role="alert" id="contact_update">
                              Update sucessfully!
                              </div>
		
	<?php }
	
?>
	
	<!-- Content Header (Page header) -->
	<section class="content-header top_heading">
		<span style="font-size:20px;">Contact Us view</span>
		
		<a href="index.php?view=contact_I" class="btn btn-primary" style="margin-top:-1px;margin-left:15px;">Add</a>
	</section>
	<!-- Main content -->
	<section class="content">
		<div class="box box-success">
			<div style="margin-top: 5px;">
				<?php 
				if(isset($_SESSION['errorMessage']) && isset($_SESSION['count'])){
					if($_SESSION['count'] <= 1){
						$_SESSION['count'] +=1; ?>
						<p class="alert alert-success"><?php echo $_SESSION['errorMessage'];  ?></p> <?php
						unset($_SESSION['errorMessage']);
					}
				} ?>
			</div>
			
			<div class="box-body" >
				<form method="post" action="processfeedback.php?action=muldelete">
					<input type="submit" value="Delete checked rows" class="btn btn-success" name="">
					<div class="table-responsive tbl-respon">
						<table id="example1" class="table table-bordered tbl-respon2">
							<thead>
								<tr>
									<td><input type="checkbox" id="allcb" name="allcb"/></td>
									<th class="text-center" style="width: 40px;">ID</th>
									<th >Topic</th>
									<th >Name</th>
									<th >Subject</th>
									<th >Email</th>
									<th class="text-center" style="width: 100px;" >Date</th>
									
									<th style="width: 100px;" class="text-center" >Action</th>
								</tr>
							</thead>
							<tbody>
								<?php
								if (dbNumRows($result) > 0) {
									$i = 1;
									while($row = dbFetchAssoc($result)){
										//print_r($row);
										//die('==========');
										$id_c=$row['spConId'];
										extract($row); ?>
										<tr>
											<td>
												<input type="checkbox" name="check[<?php echo $spConId; ?>]"  id="cb_<?php echo $spConId; ?>" value="<?php echo $spConId; ?>"/>
											</td>
											<td class="text-center"><?php echo $i++;?></td>
											<td><?php echo ($spConTopic == '0')?'':$spConTopic;?></td>
											<td><?php echo $spConName;?></td>
											<td><?php echo $spConSubj;?></td>
											<td><?php echo $spConEmail;?></td>
											<td class="text-center"><?php echo formatMySQLDate($spConDate, 'd-m-Y');?></td>
											
											<td class="menu-action text-center">
												<a href="javascript:detailContact(<?php echo $spConId;?>)" data-original-title="Detail" data-toggle="tooltip" data-placement="top" class="btn menu-icon vd_bg-green"> <i class="fa fa-eye"></i> </a>
	                                            <a href="javascript:replyContact(<?php echo $spConId;?>)" data-original-title="Reply" data-toggle="tooltip" data-placement="top" class="btn menu-icon vd_bg-yellow"> <i class="fa fa-envelope"></i> </a>
												
																						<a href="index.php?view=contact_E&id=<?php  echo $id_c; ?>"  class="btn menu-icon vd_bg-red"><i class="fa fa-edit"></i></a>
												
												
	                                            <a href="javascript:deleteContact(<?php echo $spConId;?>)" data-original-title="Delete" data-toggle="tooltip" data-placement="top" class="btn menu-icon vd_bg-red"> <i class="fa fa-times"></i> </a>
	                                            
												
											</td>
										</tr><?php
									}
								} ?>
								
							</tbody>
						</table>
					</div>
				</form>
			</div>

				<!--- End Table ---------------->

		</div>
		
	</section><!-- /.content -->
	<script type="text/javascript">
		$('#allcb').change(function(){
		    if($(this).prop('checked')){
		        $('tbody tr td input[type="checkbox"]').each(function(){
		            $(this).prop('checked', true);
		        });
		    }else{
		        $('tbody tr td input[type="checkbox"]').each(function(){
		            $(this).prop('checked', false);
		        });
		    }
		});
		
		setTimeout(function () {
                    $("#contact_update").hide();
                 }, 2000);
	</script>