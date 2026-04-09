<?php
	if (!defined('WEB_ROOT')) {
		exit;
	}
	$errorMessage = (isset($_GET['error']) && $_GET['error'] != '') ? $_GET['error'] : '&nbsp;';

	if (isset($_GET['id']) && $_GET['id'] > 0) {
		$id = $_GET['id'];
	} else {
		// redirect to index.php if page id is not present
		redirect('index.php');
	}

	// get Page info
	//$sql 	= 	"SELECT * FROM spgroup WHERE idspGroup = $id";
	$sql = "SELECT * FROM spuser AS u INNER JOIN spprofiles AS p ON u.idspUser = p.spUser_idspUser INNER JOIN spprofiles_has_spgroup AS d ON p.idspProfiles = d.spProfiles_idspProfiles INNER JOIN spgroup AS g ON d.spGroup_idspGroup = g.idspGroup WHERE d.spProfileIsAdmin = 0 AND g.idspGroup = $id ";
	$result = 	 dbQuery($dbConn, $sql) ;
	$row    = 	 dbFetchAssoc($result);
	extract($row);

?> 
	<section class="content-header top_heading">
		<h1>Group Detail</h1>
	</section>
	<!-- Main content -->
	<section class="content" >
		
		<div class="box box-success">
			<div class="box-body">			
				<?php 
				if(isset($_SESSION['errorMessage']) && isset($_SESSION['count'])){
					if($_SESSION['count'] <= 1){
						$_SESSION['count'] +=1; ?>
						<div class="row" id="alertmsg" style="margin: 10px 0px 0px 5px;">
							<div class="alert alert-<?php echo $_SESSION['data'];?>">
								<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
								<?php echo $_SESSION['errorMessage'];  ?>
							</div> 
						</div><?php
						unset($_SESSION['errorMessage']);
					}
				} ?>
				<div class="row">
					<div class="col-md-12">
						<div class="table-responsive">
							<table class="table table-bordered">
								<tbody>
									<tr>
										<td><strong>Creater Name / Profile Name:</strong></td>
										<td><?php echo $spUserName; ?></td>
									
										<td><strong>Group Name:</strong></td>
										<td><?php echo $spGroupName; ?></td>

										<td><strong>Total Members:</strong></td>
										<td><?php echo showgroupmember($dbConn, $idspGroup); ?> Members</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
					
				</div>
				<div class="row">
					<div class="col-md-offset-2 col-md-8" >
						<?php
						if (isset($spgroupimage) && $spgroupimage != '') {
						 	echo "<img class='img-responsive' src=' " . ($spgroupimage) . "' style='margin-bottom:15px;' >";
						} 
						?>
					</div>	
				</div>
				<div class="row">
					<div class="col-md-12 col-sm-12 detailPage" style="margin-bottom:20px;">
						<h3><?php echo $spGroupName; ?></h3>
						
						<p><?php echo $spGroupAbout; ?></p>
					</div>
				</div>
			</div>
			<div class="box-footer"> 
            
	            <input type="button" name="btnButton" value="Back" class="btn vd_btn vd_bg-yellow" onclick="window.location.href='index.php'" /> &nbsp;
	        </div>
		</div>
		
		
	</section><!-- /.content -->
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	