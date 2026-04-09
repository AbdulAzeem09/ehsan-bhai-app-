<?php
	if (!defined('WEB_ROOT')) {
		exit;
	}
	$errorMessage = (isset($_GET['error']) && $_GET['error'] != '') ? $_GET['error'] : '&nbsp;';

	if (isset($_GET['noteId']) && $_GET['noteId'] > 0) {
		$noteId = $_GET['noteId'];
	} else {
		// redirect to index.php if page id is not present
		redirect('index.php');
	}

	// get Page info
	$sql 	= 	"SELECT * FROM tbl_notes WHERE idspNotes = $noteId";
	$result = 	 dbQuery($dbConn, $sql) ;
	$row    = 	 dbFetchAssoc($result);
	extract($row);

	if ($_SESSION['userId'] == $user_id_to ) {
		// UPDATE TASK WHICH IS READ
		$sql2 = "UPDATE tbl_notes SET spNotesRead = 1, spNotesReviewDate = NOW() WHERE idspNotes = $noteId";
		$result = dbQuery($dbConn, $sql2);
	}


?> 
	<section class="content-header">
		<h1>My Task<small>[Detail]</small></h1>
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
					<div class="col-md-6">
						<div class="table-responsive">
							<table class="table table-bordered">
								<tbody>
									<tr>
										<td style="width: 150px;"><strong>Assigned To:</strong></td>
										<td><?php showUserName($dbConn, $user_id_to); ?></td>
									</tr>
									<tr>
										<td><strong>Assigned By:</strong></td>
										<td><?php showUserName($dbConn, $user_id_from); ?></td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
					<div class="col-md-6">
						<div class="table-responsive">
							<table class="table table-bordered">
								<tbody>
									<tr>
										<td style="width: 150px;"><strong>Assigned Date:</strong></td>
										<td><?php echo formatMySQLDate($spNotesDate, "d-M-Y"); ?></td>
									</tr>
									<tr>
										<td><strong>Review Date:</strong></td>
										<td>
											<?php 
											if ($spNotesReviewDate == "0000-00-00 00:00:00") {
												echo "Not Review";
											}else{
												echo formatMySQLDate($spNotesReviewDate,"d-M-Y");
											}
											?>
											
										</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>
				<div class="row">										
					<div class="col-md-12 col-sm-12 detailPage" style="margin-bottom:20px;">
						<h3><?php echo $spNotesTitle; ?></h3>
						<p><?php echo $spNotesDesc; ?></p>
					</div>
				
				</div>
			</div>
			<div style="min-height: 20px;"></div>
		</div>
		<div class="box">
			<div class="direct-chat direct-chat-warning">
				<div class="box-body">
					<?php 
						$sql2 = "SELECT * FROM tbl_notes_comment WHERE idspNotes = $noteId";
						$result2 = dbQuery($dbConn, $sql2);
						if($result2){
							while ($row2 = dbFetchAssoc($result2)) {
								if ($_SESSION['userId'] == $row2['user_id']) {
									?>
									<!-- Message to the right -->
						            <div class="direct-chat-msg right">
						              	<div class='direct-chat-info clearfix'>
							                <span class='direct-chat-name pull-right'><?php showUserName($dbConn, $row2['user_id']); ?></span>
							                <span class='direct-chat-timestamp pull-left'><?php echo formatMySQLDate($row2['commentDate'],'d M Y h:i'); ?></span>
						              	</div><!-- /.direct-chat-info -->
						              	<?php
						              	$userImg = getUserComentImg($dbConn, $row2['user_id']);
										if ($userImg != '') {
											echo "<img src='" .  WEB_ROOT . "/upload/user/".$userImg."' class='direct-chat-img' alt='Active' />";	
										} else {
											echo "<img src='" .  WEB_ROOT . "/upload/blank.png' class='direct-chat-img' alt='Inactive' />";	
										} ?>
						              	<div class="direct-chat-text">
						                	<?php echo $row2['commentDetail'];?>
						              	</div><!-- /.direct-chat-text -->
						            </div><!-- /.direct-chat-msg -->
									<?php
								}else{
									?>
									<div class="direct-chat-msg">
						              	<div class='direct-chat-info clearfix'>
							                <span class='direct-chat-name pull-left'><?php showUserName($dbConn, $row2['user_id']); ?></span>
							                <span class='direct-chat-timestamp pull-right'><?php echo formatMySQLDate($row2['commentDate'],'d M Y h:i'); ?></span>
						              	</div><!-- /.direct-chat-info -->
						              	<?php
						              	$userImg = getUserComentImg($dbConn, $row2['user_id']);
										if ($userImg != '') {
											echo "<img src='" .  WEB_ROOT . "/upload/user/".$userImg."' class='direct-chat-img' alt='Active' />";	
										} else {
											echo "<img src='" .  WEB_ROOT . "/upload/blank.png' class='direct-chat-img' alt='Inactive' />";	
										} ?>
						              	<div class="direct-chat-text">
						                	<?php echo $row2['commentDetail'];?>
						              	</div><!-- /.direct-chat-text -->
						            </div><!-- /.direct-chat-msg -->
									<?php
								}
							}
						}
						?>
				</div>
				
	        </div><!--/.direct-chat-messages-->

	        <form class="comentFrom" method="POST" action="processMyTask.php?action=comment" >
				<div class="">
					<div class="box-body">
						<label>Comments</label>
						<textarea class="form-control" name="txtComent" rows="4" placeholder="Comments" required=""></textarea>
						<input type="hidden" name="txtUserId" value="<?php echo $_SESSION['userId']; ?>">
						<input type="hidden" name="txtNoteId" value="<?php echo $_GET['noteId']?>">
						
					</div>
					<div class="box-footer">
						<input type="submit" name="btnSubmit" value="Save" class="btn vd_btn vd_bg-green finish"  />
						<input type="button" name="btnCanlce" value="Back" class="btn vd_btn vd_bg-yellow" style="width: 100px;display: inline;" onclick="window.location.href='index.php'" />
					</div>
				</div>
			</form>
		</div>
	</section><!-- /.content -->
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	