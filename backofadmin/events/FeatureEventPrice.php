<?php
	/*error_reporting(E_ALL);
ini_set('display_errors', '1');*/

	if (!defined('WEB_ROOT')) {
		exit;
	}

  	$sql = "SELECT * FROM event_feature_plan ORDER BY id ASC";

  	$result = dbQuery($dbConn, $sql);

	  
  	
?>
	
	<!-- Content Header (Page header) -->
	<section class="content-header top_heading">
		<h1>Feature Event Price <small>[List]</small></h1>
	</section>
	<!-- Main content -->
	
	<script src="<?php echo WEB_ROOT;?>/backofadmin/js/modules/allmodule.js"></script>
	
	<section class="content">
		<div class="box box-success">
		<div class="box-header text-right">
	                   <a class="btn btn-primary" href="index.php?view=AddEventPrice"><i class="fa fa-plus"></i>Add Event Price</a>
					  


	        </div>
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
			<div class="box-body tbl-respon">
				<table id="example1" class="table table-bordered table-striped tbl-respon2">
	                <thead>
	                 	<tr>
							<th class="text-center" style="width: 80px;">Report No</th>
							<th>Price</th>
							<th>Duration</th>
							<th>Status</th>
							<th>Action</th>
						</tr>
	                </thead>
	                <tbody>
	                	<?php
					
							if ($result){
								$i = 1;
								
								while($row = dbFetchAssoc($result)) {
								
									extract($row);
									$postDate = strtotime($duration);

									if ($status == 1) {
										$status = "Active";
									}else if($status == 0){
										$status = "Inactive";
									}
									
									?>
									<tr>

										<td class="text-center"><?php echo $i;?></td>
										
										<td class="text-center"><?php echo $price; ?></td>
										<td class="text-center"><?php echo $duration; ?></td>
										<!-- <td class="text-center"><?php //echo date("d-M-Y", $postDate); ?></td> -->
										
										<td class="text-center"><?php echo $status; ?></td>

										<td class="text-center menu-action">
											
												<a href="<?php echo WEB_ROOT_ADMIN . "events/index.php?view=EditEvent&id=".$row['id']?>" data-toggle="tooltip" title="Un-Block!" class="btn menu-icon vd_bg-yellow" ><i class="fa fa-pencil" ></i></a>
												
												<a href="<?php echo WEB_ROOT_ADMIN . "events/index.php?view=DeleteEvent&id=".$row['id']?>" data-toggle="tooltip" title="Block!" class="btn menu-icon vd_bg-red"><i class="fa fa-trash" ></i></a>
												
										
											
										</td>
									</tr><?php
									$i++;
								}
							}else { ?>
								<tr>
									<td height="20">No User/ Admin Added Yet</td>
								</tr>
								<?php 
							} //end while ?>
							
	                </tbody>
	                
              	</table>
			</div><!-- /.box-body -->
			

				<!--- End Table ---------------->
	
	</section><!-- /.content -->
	<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" /> 

<!-- jQuery --> <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> 

<!-- Select2 JS --> 
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
			<script type="text/javascript">
		
		$(document).ready( function () {
  var table = $('#example1').DataTable( {

   "order": [[ 0, "desc" ]],
    pageLength : 10,
    lengthMenu: [[10, 20, 50, 100], [10, 20, 50, 100]]
  } );
  
		        
		   
} );

	</script>

		
			