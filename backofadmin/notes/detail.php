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
?> 
	<section class="content-header">
		<h1>Sticky Notes<small>[Detail]</small></h1>
	</section>
	<!-- Main content -->
	<section class="content" >
		
		<div class="box box-success">
							
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
			<div class="box-body">
				<div class="row">										
					<div class="col-md-12 col-sm-12 detailPage" style="margin-bottom:20px;">
						<h3><?php echo $spNotesTitle; ?></h3>
						<br>
						<p style="margin-bottom: 0px;">Task Module: <strong><?php echo $spNoteMenu;?></strong></p>
						<p style="margin-bottom: 0px;">Short Description: <strong><?php echo $spNoteShrtDesc;?></strong></p>
						<p><?php echo wordwrap($spNotesDesc,60,"<br>\n"); ?></p>
						<!-- <?php echo wordwrap($value->message,40,"<br>\n");  ?> -->
					</div>
				
				</div>
			</div>
			

			
		</div>
		<div class="box">
			<div class="box-body">
				<div class="direct-chat direct-chat-warning">
		
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
						                <span class='direct-chat-timestamp pull-left'>
						                	<?php echo formatMySQLDate($row2['commentDate'],'d M Y h:i'); ?> 



						                	</span>


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
		        </div><!--/.direct-chat-messages-->

		        
			</div>
			<form class="comentFrom" method="POST" action="processNotes.php?action=comment" >
				<div class="box-body">
					<div class="">
						<label>Comments</label><span class="red">*</span>
						<textarea class="form-control" name="txtComent" rows="4" placeholder="Comments" required=""></textarea>
						<input type="hidden" name="txtUserId" value="<?php echo $_SESSION['userId']; ?>">
						<input type="hidden" name="txtNoteId" value="<?php echo $_GET['noteId']?>">
			
						
					</div>
					
				</div>
				<div class="box-footer"> 
                    <input type="submit" name="btnSubmit" value="Save" class="btn vd_btn vd_bg-green finish" /> &nbsp;
                    <input type="button" name="btnCanlce" value="Back" class="btn vd_btn vd_bg-red" onclick="window.location.href='index.php'" /> &nbsp;

                    
					<input type="button" name="" value="Modify" class="btn vd_btn vd_bg-yellow" onclick="window.location.href='index.php?view=modify&noteId=<?php echo $idspNotes;?>'" />
                </div>
				
			</form>
		</div>		
	</section><!-- /.content -->
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	