<?php
	/*error_reporting(E_ALL);
ini_set('display_errors', '1');*/

	if (!defined('WEB_ROOT')) {
		exit;
	}
	$rowsPerPage = 25;
	if(isset($_GET['pid'])){
		$pid = $_GET['pid'];
		$sql="SELECT * FROM spevent WHERE spProfiles_idspProfiles = $pid ORDER BY idspPostings ASC";
		}else{
  	$sql="SELECT * FROM spevent ORDER BY idspPostings DESC";
		}
  	
  	$result = dbQuery($dbConn, $sql);
  	
?>
	
	<!-- Content Header (Page header) -->
	<section class="content-header top_heading">
		<h1>Events <small> [List] </small></h1>
	</section>
	<!-- Main content -->
	
	<script src="<?php echo WEB_ROOT;?>/backofadmin/js/modules/allmodule.js"></script>
	
	<section class="content">
		<div class="box box-success">
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
							<th>Title</th>
							<th>Price</th>
							<th>Category</th>
							<th>Posting Date</th>
							<th>Start Time</th>
							<th>End Time</th>
							<th>Status</th>
							<th>Action</th>
						</tr>
	                </thead>
	                <tbody>
	                	<?php
						//print_r($result);
							if ($result){
								$i = 1;
								
								while($row = dbFetchAssoc($result)) {
								//print_r($row);
									extract($row);
									$postingDate = strtotime($spPostingStartDate);
									$timeFormat = 'h:i A'; // format the time as "12-hour:minutes AM/PM"
									$startTime = strtotime($spPostingStartTime);
									$endTime = strtotime($spPostingEndTime);
									if ($spPostingVisibility == -1) {
										$status = "Active";
									}else if($spPostingVisibility == 0){
										$status = "Draft";
									}else if($spPostingVisibility == 1){
										$status = "Block";
									}
									
									?>
									<tr>

										<td class="text-center"><?php echo $i;?></td>
										<td><?php echo substr($spPostingTitle,0,10).'...';	?></a></td>
										
										<td class="text-center">
										<?php 
			$sql1="SELECT * FROM `spevent_type_price` WHERE `event_id` = '$idspPostings' ";
			$result2 = dbQuery($dbConn, $sql1);
			$row2 = dbFetchAssoc($result2);
			$eventprice=$row2['event_price'];
			
			?>	
										
										
										
										<?php echo ($eventprice > 0) ? $currency . ' ' . $eventprice : 'Free'; ?></td>
										<td class="text-center"><?php echo $eventcategory; ?></td>
										<td class="text-center"><?php echo date("d-M-Y", $postingDate); ?></td>
										<td class="text-center"><?php echo date($timeFormat, $startTime); ?></td>
										<td class="text-center"><?php echo date($timeFormat, $$endTime) ; ?></td>

										<td class="text-center"><?php echo $status; ?></td>

										<td class="text-center menu-action">
											<a href="<?php echo $BaseUrl; ?>/events/event-detail.php?postid=<?php echo $idspPostings; ?>" data-toggle="tooltip" title="Detail" class="btn menu-icon vd_bg-yellow" ><i class="fa fa-info"></i></a> 
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
		</div>
		
		
		
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

		
			