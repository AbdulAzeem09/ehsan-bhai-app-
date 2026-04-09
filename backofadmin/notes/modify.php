<?php
	if (!defined('WEB_ROOT')) {
		exit;
	}
	$errorMessage = (isset($_GET['error']) && $_GET['error'] != '') ? $_GET['error'] : '&nbsp;';
	if(isset($_GET['noteId']) && ($_GET['noteId']) > 0){
		$noteId  = $_GET['noteId'];
	}else {
		redirect('index.php');
	}
	$sql = "SELECT * FROM tbl_notes WHERE idspNotes ='$noteId'";
	$result = dbQuery($dbConn, $sql);
	$row    = dbFetchAssoc($result);
	extract($row);
?>
	<script type="text/javascript" src="<?php echo WEB_ROOT_ADMIN; ?>fckeditor/fckeditor.js"></script>
		
	<script type="text/javascript">		
		window.onload = function(){
			// Automatically calculates the editor base path based on the _samples directory.
			// This is usefull only for these samples. A real application should use something like this:
			// oFCKeditor.BasePath = '/fckeditor/' ;	// '/fckeditor/' is the default value.
			var sBasePath = '../fckeditor/' ;
			var oFCKeditor = new FCKeditor( 'txtDesc' ) ;
			oFCKeditor.BasePath	= sBasePath ;
			oFCKeditor.ReplaceTextarea() ;
		}
	</script>
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>Sticky Notes<small>[Modify]</small></h1>
	</section>
	<!-- Main content -->
	<section class="content" >
		<div class="row">
			<div class="col-md-12">
						<!-- start any work here. -->
				<form name="frmAddMainNav" id="frmAddMainNav" method="post" action="processNotes.php?action=modify"  enctype="multipart/form-data" >
					<input type="hidden" name="hidId" id="hidId"  value="<?php echo $idspNotes;?>"/>
		            
					<div class="box box-success">
						
						<div class="" id="alertmsg" style="margin: 10px 0px 0px 5px;">
							<?php 
							if(isset($_SESSION['errorMessage']) && isset($_SESSION['count'])){
								if($_SESSION['count'] <= 1){
									$_SESSION['count'] +=1; ?>
									<div style="min-height:10px;"></div>
									<div class="alert alert-<?php echo $_SESSION['data'];?>">
										<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
										<?php echo $_SESSION['errorMessage'];  ?>
									</div> <?php
									unset($_SESSION['errorMessage']);
								}
							} ?>
						</div>
						<div class="box-body">
							<div class="row">
								
								<div class="col-md-3">
									<div class="form-group">
										<label>User Assign:</label><span class="red">*</span>
										<select class="form-control" style="margin-bottom: 20px;" name="user_id_to">
											<?php
											//showAllUsers($dbConn, $_SESSION['userId']);
											$userId = $_SESSION['userId'];
											$sql = "SELECT * FROM tbl_user WHERE user_id != $userId ";
											$result = dbQuery($dbConn, $sql);
											if(dbNumRows($result) >0 ){
												while($row = dbFetchAssoc($result)) {
													// build combo box options?>
													<option value='<?php echo $row['user_id'];?>' <?php echo ($row['user_id'] == $user_id_to)?'selected':'';?> ><?php echo ucfirst(strtolower($row['user_name']));?> </option>
													<?php
												} //end while
											}
											?>
										</select>
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group">
										<label>Task Menu:</label><span class="red">*</span>
										<select class="form-control" name="txtTaskMenu" style="margin-bottom: 20px;" value="<?php echo $spNoteMenu; ?>">
											<option <?php echo ($spNoteMenu == 'Profile Type')?'selected':'';?> >Profile Type</option>
											<option <?php echo ($spNoteMenu == 'Category')?'selected':'';?> >Category</option>
											<option <?php echo ($spNoteMenu == 'Registered Users')?'selected':'';?> >Registered Users</option>
											<option <?php echo ($spNoteMenu == 'All Profiles')?'selected':'';?> >All Profiles</option>
											<option <?php echo ($spNoteMenu == 'Module Form Setting')?'selected':'';?> >Module Form Setting</option>
											<option <?php echo ($spNoteMenu == 'All Modules')?'selected':'';?> >All Modules</option>
											<option <?php echo ($spNoteMenu == 'Admin Module')?'selected':'';?> >Admin Module</option>
											<option <?php echo ($spNoteMenu == 'All Posts')?'selected':'';?> >All Posts</option>
											<option <?php echo ($spNoteMenu == 'Sizes (Photo Gallery)')?'selected':'';?> >Sizes (Photo Gallery)</option>
											<option <?php echo ($spNoteMenu == 'Art Gallery Category')?'selected':'';?> >Art Gallery Category</option>
											<option <?php echo ($spNoteMenu == 'Company News')?'selected':'';?> >Company News</option>
											<option <?php echo ($spNoteMenu == 'Event Category')?'selected':'';?> >Event Category</option>
											<option <?php echo ($spNoteMenu == 'Entertainment Category')?'selected':'';?> >Entertainment Category</option>
											<option <?php echo ($spNoteMenu == 'Project Type(Freelance)')?'selected':'';?> >Project Type(Freelance)</option>
											<option <?php echo ($spNoteMenu == 'Groups')?'selected':'';?> >Groups</option>
											<option <?php echo ($spNoteMenu == 'Sponsor')?'selected':'';?> >Sponsor</option>
											<option <?php echo ($spNoteMenu == 'Location')?'selected':'';?> >Location</option>
											<option <?php echo ($spNoteMenu == 'All Membership')?'selected':'';?> >All Membership</option>
											<option <?php echo ($spNoteMenu == 'Membership Enquiry')?'selected':'';?> >Membership Enquiry</option>
											<option <?php echo ($spNoteMenu == 'Profile Content')?'selected':'';?> >Profile Content</option>
											<option <?php echo ($spNoteMenu == 'Job Board')?'selected':'';?> >Job Board</option>
										</select>
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group">
										<label>Short Description:</label><span class="red">*</span>
										<input type="text" name="txtShrtDesc" class="form-control" value="<?php echo $spNoteShrtDesc; ?>" />
									</div>
								</div>
								<div class="col-md-3" >
									<div class="form-group"> 
										<label>Title:</label><span class="red">*</span>
										<input type="text" name="txtTitle" id="txtTitle" class="form-control" required="required" value="<?php echo $spNotesTitle; ?>" />
									</div>
								</div>
								<div class="col-md-12 col-sm-12" >
									<div class="form-group">
										<label>Description:</label><span class="red">*</span>
										<textarea class="form-control" rows="6" name="txtDesc"><?php echo $spNotesDesc; ?></textarea>
									</div>
								</div>
								
							</div>
						</div>
						<div class="box-footer"> 
			                <input type="submit" name="btnButton" value="Update" class="btn vd_btn vd_bg-green finish" /> &nbsp;
			                <input type="button" name="btnButton" value="Back" class="btn vd_btn vd_bg-yellow" onclick="window.location.href='index.php'" /> &nbsp;
			            </div>
					</div>
					
					
				</form>
			</div>
		</div>
		
	</section><!-- /.content -->
		