<?php
error_reporting(0);
@ini_set('display_errors', 0);


	if (!defined('WEB_ROOT')) {
		exit;
	}
	$rowsPerPage = 25;
	
  	$sql		=	"SELECT * FROM milestone AS t inner join payment_milestone as d on t.id = d.post_id order by t.id  DESC";
  	$result = dbQuery($dbConn, $sql);
  	// custom pagignation
	//$result     = dbQuery($dbConn, getPagingQuery($sql, $rowsPerPage));
	//$pagingLink = getPagingLink($dbConn, $sql, $rowsPerPage);
 	
?>
	
	<!-- Content Header (Page header) -->
	<section class="content-header ">
		<h1>Freelancer<small>[Payment]</small></h1>
	</section>
	<!-- Main content -->
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
							<th class="text-center" style="width: 80px;">ID</th>
							<!-- <th>Image</th> -->
							<!-- <th>Title</th> -->
						<th>Posted Date</th>
							<th>Project by</th>
							<th>Hired</th>
							<th>Amount</th>
						

							
							<th>Status</th>
							
						</tr>
	                </thead>
	                <tbody>
	                	<?php
							if ($result){
								$i = 1;
								
								while($row = dbFetchAssoc($result)) {

								/*	print_r($row);*/
									extract($row);
									$postDate = strtotime($row['created']);

									if ($spPostingVisibility == -1) {
										$status = "Active";
									}else if($spPostingVisibility == 0){
										$status = "Draft";
									}else if($spPostingVisibility == 1){
										$status = "Block";
									}
									//$status = "<img src='" .  WEB_ROOT_TEMPLATE . "/images/icon/active.png' alt='Active' width='24' height='24' />";
									?>
									<tr>

										<td class="text-center"><?php echo $i;?></td>
										<!-- <td>
											<?php
                                             if($row['hired'] == 1){

                                             	$project_by = showAcountNameProfile($dbConn, $row['bussiness_profile_id']);

												
                                                            echo "<p>"."Project by ".$project_by ."</p>";

                                                        }

											?>
										</td> -->
										
										<td class="text-center"><?php echo date("d-M-Y", $postDate); ?></td>
										<td><?php echo showAcountNameProfile($dbConn, $row['bussiness_profile_id']); ?></td>
										<td><?php showProfileName($dbConn, $row['freelancer_profileid']); ?></td>
                                            <!----------dumy-------->

                                          <td class="text-center"><?php echo $row['amount'];?></td>	
									                      <!---------------->
								






										<td class="text-center"><?php if($row['request_status'] == 0){


                                                      

                                                           echo "Pending";
                                                      
                                                       }elseif ($row['request_status'] == 1) {
                                                           
                                                           echo "Released";
                                                           ?>
                                                        
                                                   
                                                       <?php
                                                       
                                                       }elseif ($row['request_status'] == 2) {
                                                           
                                                           echo "cancelled";

                                                       }
                                                      ?></td>

										<!-- <td class="text-center menu-action">
											<?php
											if ($status == 'Block') {
												?>
												<a href="javascript:postUnBlock(<?php echo $idspPostings; ?>)" data-toggle="tooltip" title="Un-Block!" class="btn menu-icon vd_bg-green" ><i class="fa fa-ban" ></i></a>
												<?php
											}else{
												?>
												<a href="javascript:postBlock(<?php echo $idspPostings; ?>)" data-toggle="tooltip" title="Block!" class="btn menu-icon vd_bg-red"><i class="fa fa-ban" ></i></a>
												<?php
											}
											?>
											
											<a href="javascript:postDetail(<?php echo $idspPostings; ?>)" data-toggle="tooltip" title="Detail" class="btn menu-icon vd_bg-yellow"><i class="fa fa-info"></i></a>&nbsp; 
											
										</td> -->
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
	<script type="text/javascript">
		
		$(document).ready( function () {
  var table = $('#example1').DataTable( {

   "order": [[ 0, "desc" ]],
    pageLength : 10,
    lengthMenu: [[10, 20, 50, 100], [10, 20, 50, 100]]
  } );
  
		        
		   
} );

	</script>	
		
			