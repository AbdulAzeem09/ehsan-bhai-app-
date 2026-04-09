<?php
	if (!defined('WEB_ROOT')) {
		exit;
	}
	
	$sql =  "SELECT * FROM spprofiletype";
	$result     = dbQuery($dbConn, $sql);
	
	
?>
	
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>Profile Type<small>[List]</small></h1>
	</section>
	<!-- Main content -->
	<section class="content">
        <?php
        include "profileType/add.php";
        ?>
		<div class="box box-success">
			<div class="box-body">
				<div class="">
					<div class="col-md-6">
						<p style=""><strong style="color: #F00;">Note:</strong> Please do not change any current profile type.</p>
					</div>

				</div>
			</div>
			<div class="box-body">
				<?php 
				if(isset($_SESSION['errorMessage']) && isset($_SESSION['count'])){
					if($_SESSION['count'] <= 1){
						$_SESSION['count'] +=1; ?>
						<div class="row" id="alertmsg" style="margin: 5px 0px 0px 5px;" >
							<div style="min-height:10px;"></div>
							<div class="alert alert-<?php echo $_SESSION['data'];?>">
								<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
								<?php echo $_SESSION['errorMessage'];  ?>
							</div> 
						</div><?php
						unset($_SESSION['errorMessage']);
					}
				} ?>
			
				<div class="table-responsive" style="overflow-x:hidden;">
					<table id="example1" class="table table-bordered table-striped tbl-respon2">
						<thead>
							<tr>
								<th class="text-center" style="width: 80px;" >Id</th>
								<th class="text-center">Title</th>
								<th class="text-center" >icon</th>
								<!-- <th>Action</th> -->
							</tr>
						</thead>
						<tbody>
							<?php
							if (dbNumRows($result) > 0) {
								$i = 1;
								while($row = dbFetchAssoc($result)){
									extract($row);
									 ?>
									<tr>
										<td class="text-center"><?php echo $idspProfileType;?></td>
										<td class="text-center"><?php echo $spProfileTypeName;?></td>
										<td class="text-center"><i class="<?php echo $spprofiletypeicon; ?>"></i></td>
										
										<!-- <td class="text-center">
											
											 <a href="javascript:modifyProfileType(<?php echo $idspProfileType;?>)">
												<i class="fa fa-edit"></i>&nbsp;
											</a> 
											
											<a href="javascript:deleteProfileType(<?php echo $idspProfileType;?>)">
												<i class="fa fa-trash"></i>
											</a>
									
										</td> -->
									</tr>


									<?php
									$i++;
								}
							} ?>
							
						</tbody>
					</table>
				</div>
			</div>
				<!--- End Table ---------------->
		</div>
        
		
	</section><!-- /.content -->
		<script type="text/javascript">
		
		$(document).ready( function () {
  var table = $('#example1').DataTable( {

   "order": [[ 0, "desc" ]],
    pageLength : 10,
    lengthMenu: [[10, 20, 50, 100], [10, 20, 50, 100]]
  } );
  
		        
		   
} );

	</script>	