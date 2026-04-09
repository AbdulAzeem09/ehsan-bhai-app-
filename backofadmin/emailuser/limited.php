<?php
	if (!defined('WEB_ROOT')) {
		exit;
	}
	$rowsPerPage = 10;
  	$sql		=	"SELECT * FROM tbl_user";

	$result     = dbQuery($dbConn, getPagingQuery($sql, $rowsPerPage));
	$pagingLink = getPagingLink($dbConn, $sql, $rowsPerPage);
 	
?>
	<?php include(THEME_PATH . '/tb_link.php');?>
	<!-- Content Header (Page header) -->
	<section class="content-header top_heading">
		<h1>Send Email</h1>
	</section>
	<!-- Main content -->
	<section class="content">
		<div class="container-fluid">
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
			
			<div class="row bord-right-space" >

	            <div class="col-md-3">
	              
	              	<div class="box box-solid">
		                <div class="box-header with-border">
		                  	<h3 class="box-title">Sent Email To</h3>
		                  	<div class='box-tools'>
		                    	<button class='btn btn-box-tool' data-widget='collapse'><i class='fa fa-minus'></i></button>
		                  	</div>
		                </div>
		                <div class="box-body no-padding">
		                  	<ul class="nav nav-pills nav-stacked">		                    
			                    <li><a href="index.php?view=list"><i class="fa fa-envelope-o"></i> All Profiles</a></li>
			                    <li class="active"><a href="index.php?view=limited"><i class="fa fa-envelope-o"></i> Specific Profiles</a></li>
		                  	</ul>
		                </div><!-- /.box-body -->
	              	</div><!-- /. box -->
	              
	          	</div>
				<div class="col-md-9">
					<div class="box box-primary">
						<form action="process.php?action=sendspecefic" method="post" enctype="multipart/form-data" name="frmAddAdmin" id="frmAddAdmin" >
			                <div class="box-header with-border">
			                  	<h3 class="box-title">Compose Email To Specific Profiles</h3>
			                </div><!-- /.box-header -->
			                <div class="box-body">
			                  	<div class="form-group">
			                    	<input class="form-control" name="txtEmail" placeholder="To:"/>
			                  	</div>
			                  	<div class="form-group">
			                    	<input class="form-control" name="txtSubject" placeholder="Subject:"/>
			                  	</div>
			                  	<div class="form-group">
				                    <textarea id="compose-textarea" name="txtMessage" class="form-control" style="height: 300px">
				                      	<h1><u>Heading Of Message</u></h1>
				                      	<h4>Subheading</h4>
				                      	<p>Type Your Content for Email</p>
				                      
				                      	<p>Thank,</p>
				                      	<p>TheSharePage</p>
				                    </textarea>
			                  	</div>
			                  	
			                </div><!-- /.box-body -->
			                <div class="box-footer">
			                  	<div class="pull-right">
				                    <button type="submit" class="btn btn-primary"><i class="fa fa-envelope-o"></i> Send Email</button>
			                  	</div>
			                  	
			                </div><!-- /.box-footer -->
			            </form>
		            </div><!-- /. box -->
				</div>
			</div><!--- End Table ---------------->
		</div>		
	</section><!-- /.content -->
			