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
		<h1>Sticky Notes <small>[Detail]</small></h1>
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
							<p><?php echo $spNotesDesc; ?></p>
						</div>
					
					</div>
				</div>
				

				<div class="box-footer">
					<input type="button" name="btnCanlce" value="Back" class="btn vd_btn vd_bg-yellow" onclick="window.location.href='index.php'" />
				</div>
			</div>
			
		
	</section><!-- /.content -->
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	