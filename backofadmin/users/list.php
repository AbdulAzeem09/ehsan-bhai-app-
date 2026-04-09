<?php
	if (!defined('WEB_ROOT')) {
		exit;
	}
	$rowsPerPage = 200;
  	$sql		=	"SELECT * FROM tbl_user WHERE user_status != -7";

	$result     = dbQuery($dbConn, getPagingQuery($sql, $rowsPerPage));
	$pagingLink = getPagingLink($dbConn, $sql, $rowsPerPage);
 	
?>
	<!-- Content Header (Page header) -->
	<section class="content-header">
          <h1>Users <small>[List]</small></h1>
    </section>
	
	<!-- Main content -->
	<section class="content">
		<div class="row">
			<div class="col-md-12">
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
					<div class="box-header text-right">
						<button id="deletemulti" type="button" name="btnButton" class="btn btn-danger" ><i class="fa fa-times"></i> Delete</button>
	                  	<button type="button" name="btnButton" class="btn btn-primary"  onclick="addUser()"><i class="fa fa-plus"></i> Add New User</button>
	                </div><!-- /.box-header -->
					
					
					<div class="box-body">
						<div class="table-responsive">
							<table id="example1" class="table table-bordered">
								<thead>
									<tr>
										<th style="width: 50px;">ID</th>
										<th>User Level</th>
										<th>User Name</th>
										<th>Reg DATE</th>
										<th>Last Login</th>
										<th style="width: 45px;">Image</th>
										<th>Status</th>
										<th class="text-center" style="min-width: 80px;">Action <input id="allselect" type="checkbox" name="allselect"></th>
									</tr>
								</thead>
								<tbody>
									<?php
									if ($result){
										$i = 1;
										while($row = dbFetchAssoc($result)) {

											extract($row);
											// print_r($row); exit();
									
											if ($user_status == 1) {
												$status = "Active";	
											} else {
												$status = "In-Active";	
											} ?>
											<tr>
												<td><?php echo $user_id;?></td>
												
												<td><?php 
													$user_level=$row['user_level'];													$sql5="SELECT * FROM `staff` WHERE id = $user_level";
																																	$result5= dbQuery($dbConn,$sql5);																$row5 = dbFetchAssoc($result5);			
												echo $row5['role_name'];  ?></td>
												<td><?php echo $user_name; ?></td>
												<td><?php echo formatMySQLDate($user_regdate,'d-m-Y H:i:s') ; ?></td>
												<td><?php echo formatMySQLDate($user_last_login,'d-m-Y H:i:s'); ?></td>
												<td>
													<?php
													if ($user_img != '') {
														echo "<img src='" .  WEB_ROOT . "/upload/user/".$user_img."' alt='Active' width='40' height='40' />";	
													} else {
														echo "<img src='" .  WEB_ROOT . "/upload/blank.png' alt='Inactive'  width='40' height='40' />";	
													} ?>
												</td>
												<td><?php echo $status; ?></td>
												<td class="menu-action text-center">

	                                                <a href="javascript:modifyUser(<?php echo $user_id; ?>)" data-original-title="Edit" data-toggle="tooltip" data-placement="top" class="btn menu-icon vd_bg-yellow"> <i class="fa fa-pencil"></i> </a>
	                                                <a href="javascript:deleteUser(<?php echo $user_id; ?>)" data-original-title="Delete" data-toggle="tooltip" data-placement="top" class="btn menu-icon vd_bg-red"> <i class="fa fa-times"></i> </a>
	                                                
													<?php
													if ($user_status == 1) {
														?>
														<a href="javascript:deactive(<?php echo $user_id; ?>)" data-original-title="De-active" data-toggle="tooltip" data-placement="top" class="btn menu-icon vd_bg-blue" ><i class="fa fa-ban"></i></a>
														<input type="checkbox" class="sdelete" name="sdelete[]" id="sdelete" value="<?php echo $user_id; ?>">
														<?php
													}else{
														?>
														<a href="javascript:activate(<?php echo $user_id; ?>)" data-original-title="Activate" data-toggle="tooltip" data-placement="top" class="btn menu-icon vd_bg-blue" ><i class="fa fa-unlock"></i></a>
														<input type="checkbox" class="sdelete" name="sdelete[]" id="sdelete" value="<?php echo $user_id; ?>">
														<?php
													}
													?>

													
																										
												</td>
											</tr><?php
										}
									} ?>
									
								</tbody>
							</table>
						</div>
					</div>
						<!--- End Table ---------------->
				</div>
			</div>
		</div>
		
		
		
		
	</section><!-- /.content -->
	<script type="text/javascript">
		
		$(document).ready( function () {
  var table = $('#example1').DataTable( {

   "order": [[ 0, "desc" ]],
    pageLength : 10,
    lengthMenu: [[10,20, 50, 100], [10,20, 50, 100]]
  } );
  
		        
		   
} );
	</script>	
		
<script type="text/javascript">
		$(document).ready(function(){

			$('#allselect').click(function(){
				
				if($('input[name="allselect"]').is(':checked'))
				{
					$(".sdelete").prop('checked', true);
				}else{
					
				  $(".sdelete").prop('checked', false);
				}
			})

			$('#deletemulti').click(function(){
				var val = [];
		        $('.sdelete:checked').each(function(i){
		          val[i] = $(this).val();
		        });
		             	swal({
						  title: "Do You Want Delete this All?",
						  /*text: "You Want to Logout!",*/
						  type: "warning",
						  confirmButtonClass: "sweet_ok",
						  confirmButtonText: "Yes, Delete!",
						  cancelButtonClass: "sweet_cancel",
						  cancelButtonText: "Cancel",
						  showCancelButton: true,
						},
						function(isConfirm) {
							if (isConfirm){
								$.ajax({
						           type: "POST",
						           url:"deleteMultiple.php",
						           data: {deleteuser:val}, // serializes the form's elements.
						           success: function(data)
						           {
						               window.location.href = 'index.php';
						           }
						         });
							}
						  
						});
			})
		})
	</script>