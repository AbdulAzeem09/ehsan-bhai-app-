 <?php
	if (!defined('WEB_ROOT')) {
		exit;
	} 	
?>

<section class="content">
   <h3>Freelancer Statistics</h3>
		<div class="container-fluid">
			<div>
				<?php 
				$spall="select*from  spfreelancer";
				$counts=dbQuery($dbConn,$spall);
				$rows= $counts->num_rows; 
				
				$spactive="SELECT * FROM spfreelancer AS t where idsppostings not in (select spposting_idsppostings from freelance_project_status) and sppostingvisibility=-1 AND complete_status = 0";
				$counts=dbQuery($dbConn,$spactive);
				$rows2= $counts->num_rows;
				
				$spdraft="SELECT * FROM spfreelancer AS t where sppostingvisibility= 0;";
				$counts=dbQuery($dbConn,$spdraft);
				$rows3= $counts->num_rows;
				
				$spcom="SELECT * FROM spfreelancer AS t where complete_status != 0;";
				$counts=dbQuery($dbConn,$spcom);
				$rows4= $counts->num_rows;
				 ?>
			</div>
			
			<div class="row bord-right-space" >
				<div class="col-md-12">
					<div class="box box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title">Freelancer</h3>
                            <div class="box-tools pull-right">
                                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                
                            </div>
                        </div><!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <table class="table table-striped no-margin">
                                    <tbody>
                                    	<tr>
                                            <td> Total Product Posted</td>
                                            <td><span class="label label-danger"><?php echo $rows; ?></span> Postings</td>
                                        </tr>
										<tr>
                                            <td> Total Active Postings</td>
                                            <td><span class="label label-success"><?php echo  $rows2 ; ?></span> &nbsp;Postings</td>
                                        </tr>
                                            <tr>
                                            <td> Total Draft Postings</td>
                                            <td><span class="label label-success"><?php echo  $rows3;?></span> &nbsp;Postings</td>
                                        </tr> 
<tr>
                                            <td> Total Complete Projects</td>
                                            <td><span class="label label-warning"><?php echo $rows4; ?></span>&nbsp;Projects</td>
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