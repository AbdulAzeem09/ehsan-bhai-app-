<?php
	if (!defined('WEB_ROOT')) {
		exit;
	}
	$rowsPerPage = 25;

	if (isset($_GET['orderby']) && $_GET['orderby'] != '') {

		$order = $_GET['orderby'];
		$sql = "SELECT * FROM spuser ORDER BY spUserRegDate $order ";
	}else if(isset($_GET['useryby']) && $_GET['useryby'] != ''){

		$userby = $_GET['useryby'];
		if ($userby == 'active') {
			$order = "ASC" ;
		}else{
			$order = "DESC"; 
		}
		$sql = "SELECT * FROM spuser ORDER BY spUserLock $order";
	}else if(isset($_GET['searchby']) && $_GET['searchby'] != ''){

		if($_GET['searchby'] == "duplicate"){
			
			$sql = "SELECT *, spuser.spUserIpLastLogin FROM spuser INNER JOIN( SELECT spUserIpLastLogin FROM spuser GROUP BY spUserIpLastLogin HAVING COUNT(idspUser) >1 )temp ON spuser.spUserIpLastLogin= temp.spUserIpLastLogin WHERE spuser.spUserIpLastLogin != '' ";
		}else{
			$sql = "SELECT *, COUNT(*) as totalpost FROM spuser AS u INNER JOIN spprofiles AS p on u.idspUser = p.spUser_idspUser INNER JOIN sppostings AS f ON p.idspProfiles = f.spProfiles_idspProfiles GROUP BY u.idspUser HAVING COUNT(*) > 1 ORDER BY totalpost DESC";
		}
	}else{
	   $sql = "SELECT * FROM spuser WHERE spUserRegDate like('%".date('Y-m-d')."%') ";
		//$sql =	"SELECT * FROM spuser ORDER BY idspUser ASC";
	}
  	
  	$result = dbQuery($dbConn, $sql);
	$countt = 0;
	if ($result){
	  $countt = mysqli_num_rows($result);
		
	}
  	// custom pagignation
	//$result     = dbQuery($dbConn, getPagingQuery($sql, $rowsPerPage));
	//$pagingLink = getPagingLink($dbConn, $sql, $rowsPerPage);
 	
?>

		<!-- Content Header (Page header) -->
		<section class="content-header">
			<h1>Registered User<small>[Today Registered User List]</small></h1>
		</section>
		<!-- Main content -->
		<section class="content">

		


		<div class="">
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
				<div class="box-body">
					<div class="row">
						<!--<div class="col-md-2">
							<div class="form-group"> 
								<label>Sorted By Date</label>
								<select class="form-control" id="sortBy">
									<option value="ASC" <?php echo (isset($_GET['orderby']) && $_GET['orderby'] == 'ASC')?'selected':''; ?> >ASC</option>
									<option value="DESC" <?php echo (isset($_GET['orderby']) && $_GET['orderby'] == 'DESC')?'selected':''; ?> >DESC</option>
								</select>
							</div>
						</div>
						<!--<div class="col-md-2">
							<div class="form-group"> 
								<label>User</label>
								<select class="form-control" id="userBy">
									<option value="active" <?php echo (isset($_GET['useryby']) && $_GET['useryby'] == 'active')?'selected':''; ?> >Active</option>
									<option value="inactive" <?php echo (isset($_GET['useryby']) && $_GET['useryby'] == 'inactive')?'selected':''; ?> >In-active</option>
								</select>
							</div>
						</div>-->
						<!--<div class="col-md-2">
							<div class="form-group"> 
								<label>Search By</label>
								<select class="form-control" id="searchBy">
									<option value="0">Search By</option>
									<option value="duplicate" <?php echo (isset($_GET['searchby']) && $_GET['searchby'] == 'duplicate')?'selected':''; ?>  >Duplicate Ip</option>
									<option value="posted" <?php echo (isset($_GET['searchby']) && $_GET['searchby'] == 'posted')?'selected':''; ?>  >Most Posted</option>
								</select>
							</div>
						</div> -->
						<div class="col-md-2 pull-right">
						<label><h2 style="font-size: 27px;">Total Users: <?php echo $countt; ?></h2></label>
						</div>
					</div>
					
					<div class="table-responsive">
		              	<table id="example1" class="table table-striped table-bordered">
			                <thead>
			                 	<tr>
									<th class="text-center" style="width: 50px!important;">ID</th>
									<th>Name</th>
									
									<?php
									if (isset($_GET['searchby']) && $_GET['searchby'] == "posted") {
										echo "<th>Total Post</th>";
									}
									?>
									<th>Phone</th>
									<th>Email</th>
									
									<th >Email Verified</th>
									<th>Phone Verified</th>
									<th>Country</th>
									<th>User Ip</th>
									<th>Total Profiles</th>
									
									<th class="text-center" style="min-width: 80px;">Action</th>
								</tr>
			                </thead>
			                <tbody>
			                	<?php
									if ($result){
										if (isset($_GET['page']) && $_GET['page'] > 1) {
											$i = 25 * ($_GET['page'] - 1) + 1;
										}else{
											$i = 1;
										}
										
										while($row = dbFetchAssoc($result)) {
											extract($row);
											$postDate = strtotime($spUserRegDate);
											
											
											?>
											<tr class="<?php echo ($spUserLock == 1)?'lockedwind':'';?>">
												<td class="text-center"><?php echo $i++;?></td>
												<td><a href="javascript:userDetail(<?php echo $idspUser; ?>)"><?php echo $spUserFirstName.' '.$spUserLastName;	?></a></td>
												
												<?php
												if (isset($_GET['searchby']) && $_GET['searchby'] == "posted") {
													echo "<td>".$totalpost."</td>";
												}
												?>
												<td><?php echo $spUserCountryCode.$spUserPhone; ?></td>
												<td><?php echo $spUserEmail; ?></td>
												
												<td class="text-center"><?php echo ($is_email_verify == 1)?'&#10004;':'&#10008;';?></td>
												<td class="text-center"><?php echo ($is_phone_verify == 1)?'&#10004;':'&#10008;';?></td>
												<td>
													<?php
													if($spUserCountry > 0 && $spUserCountry != ''){
														CountryName($dbConn, $spUserCountry);
													} ?>
														
												</td>
												<td><?php echo $spUserIpLastLogin; ?></td>
												<td class="text-center"><?php totalUserProfile($dbConn, $idspUser);?></td>
												
												<td class="text-center menu-action" style="">
                                            		<?php
													if ($spUserLock == 1) { ?>
														<a href="javascript:userunlock(<?php echo $idspUser;?>)" data-original-title="Un-lock" data-toggle="tooltip" data-placement="top" class="btn menu-icon vd_bg-green"><i class="fa fa-unlock"></i></a>&nbsp; <?php
													}else{ ?>
														<a href="javascript:userlock(<?php echo $idspUser;?>)" data-original-title="Block" data-toggle="tooltip" data-placement="top" class="btn menu-icon vd_bg-green"><i class="fa fa-lock"></i></a>&nbsp; <?php
													}
													?>
                                                    
                                                    
                                                    <a href="javascript:userDetail(<?php echo $idspUser; ?>)" data-original-title="Detail" data-toggle="tooltip" data-placement="top" class="btn menu-icon vd_bg-yellow"><i class="fa fa-info"></i></a>
													<a href="javascript:deleteRegUser(<?php echo $idspUser; ?>)" data-original-title="Delete" data-toggle="tooltip" data-placement="top" class="btn menu-icon vd_bg-red"><i class="fa fa-trash"></i></a>
                                                </td>
												
											</tr><?php
										}
									}else { ?>
										
										<?php 
									} //end while ?>
									
			                </tbody>
		                </div>
	              	</table>
	            </div><!-- /.box-body -->
				
	        </div>
				<!--- End Table ---------------->
		</div>
		
		
		
	</section><!-- /.content -->
	<script type="text/javascript">
		
		$(document).ready( function () {
  var table = $('#example1').DataTable( {

   "order": [[ 0, "desc" ]],
    pageLength : 10,
    lengthMenu: [[10, 20, 50, 100], [10, 20, 50, 100, ]]
  } );
  
		        
		   
} );

	</script>	
			