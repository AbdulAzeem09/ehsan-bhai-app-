<?php
	if (!defined('WEB_ROOT')) {
		exit;
	}
	$userId = $_SESSION['userId'];
	$sql =  "SELECT * FROM  rfqflag  AS t where spCategory_idspCategory = 1 AND flag_status = 0"; 

	$result  = dbQuery($dbConn, $sql);
	
	
?>

<section class="content-header top_heading">
		<h1>RFQ Flag</h1>
	</section>
	<!-- Main content -->
	<section class="content">
		<div class="box box-success">
			
			<!-- <?php 
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
			} ?> -->
			
			<div class="box-body" >
				<div class="table-responsive tbl-respon">
					<table id="example1" class="table table-bordered table-striped tbl-respon2">
						<thead>
							<tr>
								<th>ID</th>
								<th>Why Flag</th>
								<th>Description</th>
								<th>Post Title</th>
								<th>Flager Name</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							<?php
							if ($result) {
								$i = 1;
								while ($row = dbFetchAssoc($result)) {
									extract($row);

		$sql1 =  "SELECT * FROM  rfq  AS t where idspRfq = ".$spPosting_idspPosting;
 
     // echo $sql1;
	                      $result1  = dbQuery($dbConn, $sql1);

	                      $row1 = dbFetchAssoc($result1);
	                    //echo "<pre>";
	                     //print_r($row);

	                     $sql2 =  "SELECT * FROM  spprofiles  AS t where idspprofiles  = ".$spProfile_idspProfile;

	                       $result2  = dbQuery($dbConn, $sql2);

	                      $row2 = dbFetchAssoc($result2);
						 // print_r($row2);
	                  //  echo "<pre>";
	                    // print_r($row2['spUser_idspUser']);
 
								
                               @$idspUser = $row2['spUser_idspUser'];
								
								
                               @$spProfileName = $row2['spProfileName'];
                               
								


									?>
									<tr>
										<td class="text-center"><?php echo $i; ?></td>
										<td><?php echo $why_flag; ?></td>
										<td><?php echo $flag_desc;?></td>
										<td style="text-transform: capitalize;">
											<?php echo $row1['rfqTitle'];?>
											 
											
										</td>
										<td  style="text-transform: capitalize;">
											

											<a href="javascript:userDetail(<?php echo $idspUser; ?>)"><?php echo $spProfileName?></a>
										</td>
										<td class="menu-action text-center">

                                            <a href="javascript:detail(<?php echo $id;?>)" data-original-title="Detail" data-toggle="tooltip" data-placement="top" class="btn menu-icon vd_bg-yellow"> <i class="fa fa-info"></i> </a>

                                         <!--  <a href="<?php echo WEB_ROOT_ADMIN . "flag/rfqflag" ?>" data-original-title="Detail" data-toggle="tooltip" data-placement="top" class="btn menu-icon vd_bg-yellow"> <i class="fa fa-info"></i> </a> -->
                                            	
										</td>
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