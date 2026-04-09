<?php
	if (!defined('WEB_ROOT')) {
		exit;
	}
	$rowsPerPage = 25;
  	$sql		=	"SELECT * FROM sppostings WHERE spCategories_idspCategory = 2 ORDER BY idspPostings DESC";
  	$result = dbQuery($dbConn, $sql);
  	// custom pagignation
	//$result     = dbQuery($dbConn, getPagingQuery($sql, $rowsPerPage));
	//$pagingLink = getPagingLink($dbConn, $sql, $rowsPerPage);
 	
?>
	
	<!-- Content Header (Page header) -->
	<section class="content-header top_heading">
		<h1>Job Board<small>[List]</small></h1>
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
							<th class="text-center" style="width: 80px;">Report No</th>
							<th>Image</th>
							<th>Title</th>
							<th>Posted Date</th>
							<th>Account Name</th>
							<th>Profile Name</th>
							<th>Block Reason</th>
							
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
									$postDate = strtotime($spPostingDate);

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
										<td>
											<?php
											$sql2 = "SELECT * FROM spPostingPics WHERE spPostings_idspPostings = $idspPostings";
											$result2 = dbQuery($dbConn, $sql2);
											if ($result2 AND dbNumRows($result2) > 0) {
												$row2 = dbFetchAssoc($result2);
												$picture = $row2['spPostingPic'];
                                                echo "<img alt='Posting Pic' class='img-responsive' src=' " . ($picture) . "' style='width:40px;height: 40px;' >";
											}
                                            ?>
										</td>
										<td><a href="javascript:postDetail(<?php echo $idspPostings; ?>)"><?php echo $spPostingTitle;	?></a></td>
										<td class="text-center"><?php echo date("d-M-Y", $postDate); ?></td>
										<td><?php echo showAcountNameProfile($dbConn, $spProfiles_idspProfiles); ?></td>
										<td><?php showProfileName($dbConn, $spProfiles_idspProfiles); ?></td>
										
                                               <!----------dumy-------->
								             <td class="text-center"><?php  $status; 
												       if ($status=="Block") {
												                         	?>
		  <a href="" data-toggle="modal" data-target="#myModal<?php echo $idspPostings;?>"><i class="fa fa-eye" ></i></a>										    
											                                        	
											  <!-- Trigger the modal with a button -->
											  

											
											  	  <!-- Modal -->
											  <div class="modal fade" id="myModal<?php echo $idspPostings;?>" role="dialog">
											    <div class="modal-dialog modal-md">
											      <div class="modal-content">
											        <div class="modal-header " style="background-color:#00a65a;">
											         
											          <h2 class="modal-title" >Block Reason</h2>
											        </div>
											        
											        <div class="modal-body text-left " style="background-color: #eee;">
                                                        <?php 
                                                          $sql3=	"SELECT * FROM spposting_block WHERE spPostings_idspPostings = $idspPostings  ";
											$result3 = dbQuery($dbConn, $sql3);
											  	 $row3 = dbFetchAssoc($result3);
											  ?>
											    <label>Blocked Date :</label>
											         <?php 

											       $date= $row3['date'];

                                                     $origDate = "$date";
 
                                              $newDate = date("d/m/yy  H:i A", strtotime($origDate));
                                                             echo $newDate; 

                                                             

											         ?>
											         <br>


											         <label>Blocked By :</label> <?php 

											  

											   //admin name select query//




											     $sql3=	"SELECT * FROM spposting_block WHERE spPostings_idspPostings = $idspPostings  ";
											$result3 = dbQuery($dbConn, $sql3);
											  	 $row3 = dbFetchAssoc($result3);
											  

											   

											  	$sql4=	"SELECT * FROM tbl_user WHERE user_id = ".$row3['admin_id']." ";
											  
											$result4 = dbQuery($dbConn, $sql4);
											  	 $row4 = dbFetchAssoc($result4);
											  	
											echo $row4['user_name'];
											         ?>
											     <br>
											     
											         <label>Blocked Reason :</label>
											         <?php 

											    echo $row3['spBlockPostNotes'];

											         ?>

											        </div>
											        <div class="modal-footer">
											          <button type="button" class="btn btn-default vd_bg-yellow" data-dismiss="modal" 
											>Close</button>
											        </div>
											      </div>
											    </div>
											  </div>
											                                        	<?php

											                                        }else{
											                                        	echo $status;
											                                        }
											                                         
																				    ?></td>	

																				    <!---------->


										<td class="text-center"><?php echo $status; ?></td>

										<td class="text-center menu-action">
											<?php
											if ($status == 'Block') {
												?>
												<a href="javascript:postUnBlock(<?php echo $idspPostings; ?>)" data-toggle="tooltip" title="Un-Block!" class="btn menu-icon vd_bg-green" ><i class="fa fa-ban" ></i></a>
												<?php
											}else{
												?>
												<a href="javascript:postBlock(<?php echo $idspPostings; ?>)" data-toggle="tooltip" title="Block!" class="btn menu-icon vd_bg-red" ><i class="fa fa-ban" ></i></a>
												<?php
											}
											?>
											<!-- show all detail of that user -->
											<a href="javascript:postDetail(<?php echo $idspPostings; ?>)" data-toggle="tooltip" title="Info"  class="btn menu-icon vd_bg-yellow" ><i class="fa fa-info"></i></a>&nbsp; 
											<!-- <a href="javascript:deletePost(<?php echo $idspPostings; ?>)"><i class="fa fa-trash"></i></a> -->
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
	<script type="text/javascript">
		
		$(document).ready( function () {
  var table = $('#example1').DataTable( {

   "order": [[ 0, "desc" ]],
    pageLength : 10,
    lengthMenu: [[10, 20, 50, 100], [10, 20, 50, 100]]
  } );
  
		        
		   
} );

	</script>	
		
			
			