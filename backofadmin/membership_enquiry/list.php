<?php
	if (!defined('WEB_ROOT')) {
		exit;
	}


	$sql =  "SELECT * FROM spenquiry ORDER By idspenquiry DESC";
	$result  = dbQuery($dbConn, $sql);
	
	
?>
	
	<!-- Content Header (Page header) -->
	<section class="content-header top_heading">
		<h1>Membership Enquiries<small>[List]</small></h1>
	</section>
	<!-- Main content -->
	<section class="content">
		<div class="box box-success">
			
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
			
			<div class="box-body" >
				<div class="table-responsive tbl-respon">
					<table id="example1" class="table table-bordered table-striped tbl-respon2">
						<thead>
							<tr>
								<th style="width: 80px;">Report No</th>
								<th>Company Name</th>
								<th>Company Size</th>
								<th>Name</th>
								<th>City</th>
								<th>Telephone</th>
								<th>Email</th>
								<th>Date</th>
							</tr>
						</thead>
						<tbody>
							<?php
							if ($result) {
								$i = 1;
								while ($row = dbFetchAssoc($result)) {
									extract($row);
									$postDate = strtotime($spenquiry_date);
									?>
									<tr>
										<td class="text-center"><?php echo $i; ?></td>
										<td><?php echo $spenquiryCompanyName; ?></td>
										<td><?php echo $spenquiryCompanySize; ?></td>
										<td><?php echo $spenquiryFirstName." ".$spenquiryLastName; ?></td>
										<td><?php echo $spenquiryCity; ?></td>
										<td><?php echo $spenquiryTel ; ?></td>
										<td><?php echo $spenquiryEmail ; ?></td>
										<td><?php echo date("d-M-Y", $postDate); ?></td>
									</tr>
									<?php
									$i++;
								}
							}
							?>
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
		