<?php
	if (!defined('WEB_ROOT')) {
		exit;
	}
	
?>
	
	<script type="text/javascript" src="<?php echo WEB_ROOT_ADMIN; ?>fckeditor/fckeditor.js"></script>

	<script type="text/javascript">		
		window.onload = function(){
			// Automatically calculates the editor base path based on the _samples directory.
			// This is usefull only for these samples. A real application should use something like this:
			// oFCKeditor.BasePath = '/fckeditor/' ;	// '/fckeditor/' is the default value.
			var sBasePath = '../../fckeditor/' ;
			var oFCKeditor = new FCKeditor( 'txtDesc' ) ;
			oFCKeditor.BasePath	= sBasePath ;
			oFCKeditor.ReplaceTextarea() ;
		}
	</script>
	<!-- Content Header (Page header) -->
	<section class="content-header top_heading">
		<h1>Add Page</h1>
	</section>
	<!-- Main content -->
	<section class="content" >
		<!-- start any work here. -->
		<form name="frmAddMainNav" id="frmAddMainNav" method="post" action="processContent.php?action=add"  enctype="multipart/form-data" onsubmit="return validate(this)">
			
			<div class="box box-success">
				<div class="box-body">
					<div class="row" id="alertmsg" style="margin: 10px 0px 0px 5px;">
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
					<div class="row">
						<div class="col-md-4 col-sm-6" style="margin-bottom:20px;">
							<label>Page Title:</label></br>
							<input type="text" name="txtTitle" id="txtTitle" class="form-control" required="required"/>
						</div>
						<div class="col-md-4 col-sm-6 m_btm_30">
							<label>Status :</label></br>
							<input type="radio" name="radStatus" id="radStatus" value="1" checked="checked" />
							<span class="txtDarkGray14">Active</span> &nbsp;
							<input type="radio" name="radStatus" id="radStatus" value="0" />
							<span class="txtDarkGray14">In Active</span>
						</div>	
						<div class="col-md-12 col-sm-12" style="margin-bottom:20px;">
							<label>Page Content:</label></br>
							<textarea class="form-control" rows="10" name="txtDesc"></textarea>
						</div>
						                    
					</div>
				</div>
				<div class="box-footer"> 
                    <input type="submit" name="btnButton" value="Save" class="btn vd_btn vd_bg-green finish" /> &nbsp;
                    <input type="button" name="btnButton" value="Back" class="btn vd_btn vd_bg-yellow" onclick="window.location.href='index.php'" /> &nbsp;
                </div>
			</div>
			
		</form>
	</section><!-- /.content -->
		