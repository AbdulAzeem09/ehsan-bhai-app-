<?php
	if (!defined('WEB_ROOT')) {
		exit;
	} 	
?>


<section class="content">
   <h3>Event Statistics</h3>
		<div class="container-fluid">
		
				<?php 
				  $spact="SELECT * FROM spevent AS t where t.sppostingvisibility = -1 AND t.spPostingExpDt >= CURDATE()";
		      	$counts=dbQuery($dbConn,$spact);
				$rows= $counts->num_rows;
				
				$spdrapt="SELECT * FROM spevent AS t where t.sppostingvisibility = 0";
		      	$counts2=dbQuery($dbConn,$spdrapt);
				$rows2= $counts2->num_rows;
				
				$spall="SELECT * FROM spevent";
		      	$counts3=dbQuery($dbConn,$spall);
				$rows3= $counts3->num_rows;
				 ?>
			 
			
			<div class="row bord-right-space">
				<div class="col-md-12">
					<div class="box box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title">Event</h3>
                            <div class="box-tools pull-right">
                                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                
                            </div>
                        </div><!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <table class="table table-striped no-margin">
                                    <tbody>
                                     
										<tr>
                                            <td> Total Posted Event</td>
                                            <td><span class="label label-success"><?php echo  $rows3 ; ?></span> &nbsp;Jobs</td>
                                        </tr>
										<tr>
                                            <td> Total Active Event</td>
                                            <td><span class="label label-success"><?php echo  $rows ; ?></span> &nbsp;Jobs</td>
                                        </tr>
										<tr>
                                            <td> Total Draft Event</td>
                                            <td><span class="label label-success"><?php echo  $rows2 ; ?></span> &nbsp;Jobs</td>
                                        </tr>
									 
									 
                                              
										
                                    </tbody>
                                </table>
                            </div><!-- /.table-responsive -->
                        </div><!-- /.box-body -->
                        
                    </div>
				</div>
			</div>
		</div>
	</section>  