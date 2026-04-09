<?php
	if (!defined('WEB_ROOT')) {
		exit;
	} 	
?>
	<?php include(THEME_PATH . '/tb_link.php');?>
	<!-- Content Header (Page header) -->
	<section class="content-header top_heading">
		<h1><?php echo $pageTitle; ?></h1>
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
				<div class="col-md-12">
					<div class="box box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title">Store</h3>
                            <div class="box-tools pull-right">
                                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                
                            </div>
                        </div><!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <table class="table table-striped no-margin">
                                    <tbody>
                                    	<tr>
                                            <td><a href="javascript:void(0)">Total Product Posted</a></td>
                                            <td><span class="label label-danger"><?php echo totalpost($dbConn);?></span> Postings</td>
                                        </tr>
                                        <tr>
                                            <td><a href="javascript:void(0)">Total Active Postings</a></td>
                                            <td><span class="label label-success"><?php echo totalActivePost($dbConn, -1);?></span> &nbsp;Postings</td>
                                        </tr>
                                        <tr>
                                            <td><a href="javascript:void(0)">Total In-Active Postings</a></td>
                                            <td><span class="label label-success"><?php echo totalinctivePost($dbConn, -1);?></span> &nbsp;Postings</td>
                                        </tr>
                                        <tr>
                                            <td><a href="javascript:void(0)">Total Draft Postings</a></td>
                                            <td><span class="label label-success"><?php echo totaldraftPost($dbConn, 0);?></span> &nbsp;Postings</td>
                                        </tr>
                                        <tr>
                                            <td><a href="javascript:void(0)">Total Products Sold</a></td>
                                            <td><span class="label label-info">0</span></td>
                                        </tr>
                                        
                                        <tr>
                                            <td><a href="javascript:void(0)">Today Product Sold</a></td>
                                            <td><span class="label label-info">0</span></td>
                                        </tr>
                                        <tr>
                                            <td><a href="javascript:void(0)">Today Product Posted</a></td>
                                            <td><span class="label label-warning">0</span></td>
                                        </tr>
                                                                                        
                                    </tbody>
                                </table>
                            </div><!-- /.table-responsive -->
                        </div><!-- /.box-body -->
                        
                    </div>
				</div>
			</div>
		</div>
	</section><!-- /.content -->
			