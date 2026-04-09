<?php
	if (!defined('WEB_ROOT')) {
		exit;
	} 	
?>


<section class="content">
   <h3>Job Board Statistics</h3>
		<div class="container-fluid">
		
				<?php 
				 $spjobs="SELECT * FROM spjobboard AS t where sppostingvisibility = -1 and t.sppostingexpdt > curdate()";
		      	$counts=dbQuery($dbConn,$spjobs);
				$rows= $counts->num_rows;
				
				$spexpr="SELECT * FROM spjobboard AS t where t.sppostingvisibility != -3 and t.sppostingexpdt < curdate()";
		      	$counts2=dbQuery($dbConn,$spexpr);
				$rows2= $counts2->num_rows;
				
				$spdraft="SELECT * FROM spjobboard AS t where t.sppostingvisibility = 0";
		      	$counts3=dbQuery($dbConn,$spdraft);
				$rows3= $counts3->num_rows;
				
				$spall="SELECT * FROM spjobboard ";
		      	$counts4=dbQuery($dbConn,$spall);
				$rows4= $counts4->num_rows;
				 ?>
			 
			
			<div class="row bord-right-space">
				<div class="col-md-12">
					<div class="box box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title">Job Board</h3>
                            <div class="box-tools pull-right">
                                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                
                            </div>
                        </div><!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <table class="table table-striped no-margin">
                                    <tbody>
                                     <tr>
                                            <td> Total Posted jobs</td>
                                            <td><span class="label label-success"><?php echo  $rows4 ; ?></span> &nbsp;Jobs</td>
                                        </tr>
										<tr>
                                            <td> Total Active jobs</td>
                                            <td><span class="label label-success"><?php echo  $rows ; ?></span> &nbsp;Jobs</td>
                                        </tr>
										<tr>
                                            <td> Total Expire jobs</td>
                                            <td><span class="label label-success"><?php echo  $rows2 ; ?></span> &nbsp;Jobs</td>
                                        </tr>
                                          <tr>
                                            <td> Total Draft jobs</td>
                                            <td><span class="label label-success"><?php echo  $rows3 ; ?></span> &nbsp;Jobs</td>
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