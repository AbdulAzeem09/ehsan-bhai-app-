 <?php
	if (!defined('WEB_ROOT')) {
		exit;
	} 	
?>

<section class="content">
   <h3>Real Estate Statistics</h3>
		<div class="container-fluid">
		
				<?php 
				 $spactive="SELECT * FROM sprealstate AS t where t.sppostingvisibility = -1 and t.sppostingpropstatus = 'active' and t.sppostlisting = 'sell'";
		      	$counts=dbQuery($dbConn,$spactive);
				$rows= $counts->num_rows;
				
				 $spdraft="SELECT * FROM sprealstate AS t where t.sppostingvisibility = 0";
		      	$counts2=dbQuery($dbConn,$spdraft);
				$rows2= $counts2->num_rows;
				
				$spall="SELECT * FROM sprealstate";
		      	$counts3=dbQuery($dbConn,$spall);
				$rows3= $counts3->num_rows;
				 ?>
			 
			
			<div class="row bord-right-space">
				<div class="col-md-12">
					<div class="box box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title">Real Estate</h3>
                            <div class="box-tools pull-right">
                                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                
                            </div>
                        </div><!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <table class="table table-striped no-margin">
                                    <tbody>
									
									<tr>
                                            <td> Total Posted Real Estate </td>
                                            <td><span class="label label-success"><?php echo  $rows3 ; ?></span> &nbsp;Real Estate </td>
                                        </tr>
                                     <tr>
                                            <td> Total Active Real Estate </td>
                                            <td><span class="label label-success"><?php echo  $rows ; ?></span> &nbsp;Real Estate </td>
                                        </tr>
										
										<tr>
                                            <td> Total Draft Real Estate </td>
                                            <td><span class="label label-success"><?php echo  $rows2 ; ?></span> &nbsp;Real Estate </td>
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