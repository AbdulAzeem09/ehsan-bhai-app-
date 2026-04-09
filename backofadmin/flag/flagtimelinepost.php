<?php
	if (!defined('WEB_ROOT')) {
		exit;
	}
	 
?>
	
	<!-- Content Header (Page header) -->
	<section class="content-header top_heading">
		<h1>Flag Post<small>[Timeline]</small></h1>
	</section>
	<!-- Main content -->
	<section class="content">


		<div class="box box-success">
			
		              <?php 
						if(isset($_SESSION['errorMessage']) && isset($_SESSION['count'])){
							if($_SESSION['count'] <= 1){
								$_SESSION['count'] +=1; ?>
								<div class="space"></div>
								<p class="alert alert-success"><?php echo $_SESSION['errorMessage'];  ?></p> <?php
								unset($_SESSION['errorMessage']);
							}
						} 

					   ?>


          	<section class="content">

    <ul class="nav nav-tabs md-tabs" id="myTabMD" role="tablist">
  <li class="nav-item active">
    <a class="nav-link active" id="home-tab-md" data-toggle="tab" href="#home-md" role="tab" aria-controls="home-md"
      aria-selected="true">Active Flag Post</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="profile-tab-md" data-toggle="tab" href="#profile-md" role="tab" aria-controls="profile-md"
      aria-selected="false">Deactive Flag Post</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="contact-tab-md" data-toggle="tab" href="#contact-md" role="tab" aria-controls="contact-md"
      aria-selected="false">Flagged  Post</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="contact-tab-md" data-toggle="tab" href="#flager_p" role="tab" aria-controls="flager_p"
      aria-selected="false">Flagger Profiles</a>
  </li>
</ul>
<div class="tab-content card pt-5" id="myTabContentMD">
  <div class="tab-pane fade active in" id="home-md" role="tabpanel" aria-labelledby="home-tab-md">
   
			<div class="box-body" >
				<div class="table-responsive tbl-respon">
					<table id="example1" class="table table-bordered table-striped tbl-respon2">
						<thead>
							<tr>
								<th>ID</th>
								<th>Post Id</th>
								<th>Posted By</th>
								 <th>Description</th> 
								<!--<th>Flag Count</th>-->
								<th>Activate Time</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							<?php
							// echo $spPosting_idspPosting;
							
							$sql =  "SELECT *,COUNT(*) as Count FROM flagtimelinepost  INNER JOIN sppostings ON flagtimelinepost.spPosting_idspPosting=sppostings.idspPostings  GROUP BY
  flagtimelinepost.spPosting_idspPosting";
		                    $result  = dbQuery($dbConn, $sql);
							if ($result) {
								$i = 1;
								while ($row = dbFetchAssoc($result)) {
                                    //echo"<pre>";
                                   //echo"<pre>";
									//print_r($row);
									extract($row);
									?>
									<tr>
										<td class="text-center"><?php echo $i; ?></td>
										<td><?php echo"<a href='index.php?view=postdetail&postid=".$spPosting_idspPosting."&flagid=".$flag_id."' target='_blank'>".$spPosting_idspPosting."</a>"; ?></td>
										<!--<td><a href="../registerdUser/index.php?view=singleprofile&uid=<?php echo $flagpostuserid."&pid=".$flagpostprofileid; ?>" target="_blank"><?php showProfileName($dbConn, $flagpostprofileid); echo " ("; showspUserName($dbConn, $flagpostuserid); echo " )" ;?> </a></td>-->
										
										<td><a href="../registerdUser/index.php?view=singleprofile&uid=<?php echo $flagpostuserid."&pid=".$flagpostprofileid; ?>" target="_blank"><?php echo $row['spPostingTitle'];?></a></td>
										<td>
										<?php 

                                          if(!empty($spPostingNotes)){

                                                     echo $spPostingNotes; 
                                                 
                                                 }else{

                                                 	echo "--";
                                                 } 
										         
										?>
											
										</td>
										<!--<td>
											<?php 
										//	echo $Count;
											?>
										</td>-->
										<td>
											<?php 
                                               if($active_time != "0000-00-00 00:00:00"){
                                                
                                                $datetime = new DateTime($active_time);
                                                $datetime->setTimezone(new DateTimeZone('Asia/Calcutta'));
                                                $act_date =   $datetime->format('Y-m-d h:i:s');
                                                    echo $act_date;
                                                
                                                }else{
                                                	
                                                	echo "--";
                                                }

											//echo $active_time 

											?>
										</td>
										<td class="menu-action text-center">
                                            <?php if($flag_status == 0){ ?>
											
											<!--<a href="javascript:deactivepost(<?php echo $spPosting_idspPosting; ?>)" data-toggle="tooltip" title="" class="btn menu-icon vd_bg-red" data-original-title="Deactive This Post"><i class="fa fa-ban"></i></a>-->
											
											
											<?php  $catid= "time"; ?>
											<a href="javascript:void(0);" class="deactive-btn" data-work="deactive" data-Id="<?php echo  $spPosting_idspPosting ;?>" data-catid = "<?php  echo $catid; ?>"  class="btn menu-icon vd_bg-red" style ="background-color:#f85d2c; border-radius:4px;"><i style="color: white;" class="fa fa-ban disable-btn" data-disableId=""></i></a> 
											
											<?php }else{ ?>
											
											<a href="javascript:activepost(<?php echo $spPosting_idspPosting; ?>)" data-toggle="tooltip" title="" class="btn menu-icon vd_bg-green" data-original-title="Active This Post"><i class="fa fa-unlock"></i></a>

											<?php } ?>

                                             <!--  <a href="javascript:deletetimelineflag(<?php echo $flag_id ; ?>)" data-original-title="Delete" data-toggle="tooltip" data-placement="top" class="btn menu-icon vd_bg-red"> <i class="fa fa-times"></i> </a>-->
											   
											   <a href="javascript:void(0);" class="disable-btn" data-work="delete" data-Id="<?php echo $spPosting_idspPosting ; ?>" data-catid = " time "  class="btn menu-icon vd_bg-red" style ="background-color:red; border-radius:4px;"><i style="color: white;" class="fa fa-times disable-btn" data-disableId=""></i></a> 

                                                <!-- <a href="javascript:postdetail(<?php echo $spPosting_idspPosting ; ?>,<?php echo $flag_id ; ?>)" data-original-title="See Post" data-toggle="tooltip" data-placement="top" class="btn menu-icon vd_bg-red"> <i class="fa fa-info"></i> </a>-->
												
												<?php  $name= 22; ?>
										<a href="javascript:detail(<?php echo $name.', '.$spPosting_idspPosting;?>)" data-original-title="Detail" data-toggle="tooltip" data-placement="top" class="btn menu-icon vd_bg-yellow" name="time"> <i class="fa fa-info"></i> </a>
                                            
                                            	
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
  </div>
  <div class="tab-pane fade" id="profile-md" role="tabpanel" aria-labelledby="profile-tab-md">
    	<div class="box-body" >
				<div class="table-responsive tbl-respon">
					<table id="flaged_deactive" class="table table-bordered table-striped tbl-respon2">
						<thead>
							<tr>
								<th>ID</th>
								<th>Post Id</th>
								<th>Posted By</th>
								<th>Description</th>
								<th>Flag Count</th>
								<th>Deactive Time</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$sql2 =  "SELECT *,COUNT(*) as Count FROM flagtimelinepost  INNER JOIN sppostings ON flagtimelinepost.spPosting_idspPosting=sppostings.idspPostings where flagtimelinepost.flag_status=1 GROUP BY flagtimelinepost.spPosting_idspPosting";
		                    $result2  = dbQuery($dbConn, $sql2);
							
							if ($result2) {
								$i = 1;
								while ($row2 = dbFetchAssoc($result2)) {
									//extract($row2);
									
									?>
									<tr>
										<td class="text-center"><?php echo $i; ?></td>
										<td><?php echo"<a href='index.php?view=postdetail&postid=".$row2['spPosting_idspPosting']."&flagid=".$row2['flag_id']."' target='_blank'>".$row2['spPosting_idspPosting']."</a>"; ?></td>
										<td><a href="../registerdUser/index.php?view=singleprofile&uid=<?php echo $row2['flagpostuserid']."&pid=".$row2['flagpostprofileid']; ?>" target="_blank"><?php showProfileName($dbConn, $row2['flagpostprofileid']); echo " ("; showspUserName($dbConn, $row2['flagpostuserid']); echo " )" ;?></a></td>
										<td><?php 
										    
										    if(!empty($row2['spPostingNotes'])){

                                                 echo $row2['spPostingNotes']; 
										    
										    }else{

										         echo "--";
										    }
                      
										?></td>
										<td>
											<?php echo $row2['Count']; ?>
										</td>
										<td>

											<?php
											/*date_default_timezone_set('UTC');
											$date = new DateTime($row2['deactive_time']);

                                         $created= $date->format('D M d H:i:s O Y');
                                         echo $created;*/
                                          //$datetime->format('Y-m-d h:i:s (e)');

                                              if( $row2['deactive_time'] != "0000-00-00 00:00:00"){
                                                   
                                                    $datetime = new DateTime($row2['deactive_time']);
                                                $datetime->setTimezone(new DateTimeZone('Asia/Calcutta'));
                                                 $deact_date =   $datetime->format('Y-m-d h:i:s');
                                                    echo $deact_date;
                                              }else{
                                              	echo "--";
                                              }
											 

                                         

											  ?>
										</td>
										<td class="menu-action text-center">
                                            <?php if($row2['flag_status'] == 0){ ?>
											<a href="javascript:deactivepost(<?php echo $row2['spPosting_idspPosting']; ?>)" data-toggle="tooltip" title="" class="btn menu-icon vd_bg-red" data-original-title="Deactive This Post"><i class="fa fa-ban"></i></a>
											<?php }else{ ?>
											<a href="javascript:activepost(<?php echo $row2['spPosting_idspPosting']; ?>)" data-toggle="tooltip" title="" class="btn menu-icon vd_bg-green" data-original-title="Active This Post"><i class="fa fa-unlock"></i></a>

											<?php } ?>

                                               <a href="javascript:deletetimelineflag(<?php echo $row2['flag_id'] ; ?>)" data-original-title="Delete" data-toggle="tooltip" data-placement="top" class="btn menu-icon vd_bg-red"> <i class="fa fa-times"></i> </a>

                                                 <a href="javascript:postdetail(<?php echo $row2['spPosting_idspPosting'] ; ?>,<?php echo $row2['flag_id'] ; ?>)" data-original-title="See Post" data-toggle="tooltip" data-placement="top" class="btn menu-icon vd_bg-red"> <i class="fa fa-info"></i> </a>
										
                                            </a>
                                            	
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
  </div>
  <div class="tab-pane fade" id="contact-md" role="tabpanel" aria-labelledby="contact-tab-md">
      	<div class="box-body" >
				<div class="table-responsive tbl-respon">
					<table id="flaged_table" class="table table-bordered table-striped tbl-respon2">
						<thead>
							<tr>
								<th>ID</th>
								<th>Flagged Post id</th>
								<th>Profile Name</th>
								<!-- <th>Description</th> -->
								<th>Flag Count</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$sql3 =  "SELECT *,COUNT(*) as Count FROM flagtimelinepost  INNER JOIN sppostings ON flagtimelinepost.spPosting_idspPosting=sppostings.idspPostings GROUP BY flagtimelinepost.flagpostprofileid";
		                    $result3  = dbQuery($dbConn, $sql3);
							
							if ($result3) {
								$i = 1;
								while ($row3 = dbFetchAssoc($result3)) {
									//extract($row2);

									//print_r($row3);
									?>
									<tr>
										<td class="text-center"><?php echo $i; ?></td>
										<td><?php echo"<a href='index.php?view=postdetail&postid=".$row3['spPosting_idspPosting']."&flagid=".$row3['flag_id']."'  target='_blank'>".$row3['spPosting_idspPosting']."</a>"; ?></td>
										<td><a href="../registerdUser/index.php?view=singleprofile&uid=<?php echo $row3['flagpostuserid']."&pid=".$row3['flagpostprofileid']; ?>" target="_blank"><?php showProfileName($dbConn, $row3['flagpostprofileid']); echo " ("; showspUserName($dbConn, $row3['flagpostuserid']); echo " )" ;?></a></td>
										<!-- <td><?php echo $row3['spPostingNotes']; ?></td> -->
										<td>
											<?php echo $row3['Count']; ?>
										</td>
									    <td class="menu-action text-center">
                                    	<?php 
													if ($row3['spUserLockstatus'] == 1) { ?>
														<a href="javascript:userunlock(<?php echo $row3['flagpostuserid'];?>)" data-original-title="Un-lock" data-toggle="tooltip" data-placement="top" class="btn menu-icon vd_bg-green"><i class="fa fa-unlock"></i></a>&nbsp; <?php
													}else{ ?>
														<a href="javascript:userlock(<?php echo $row3['flagpostuserid'];?>)" data-original-title="Block" data-toggle="tooltip" data-placement="top" class="btn menu-icon vd_bg-green"><i class="fa fa-lock"></i></a>&nbsp; <?php
													}
													?>
                                                    
                                                    
                                                  <!--   <a href="javascript:userDetail(<?php echo $row3['userid']; ?>)" data-original-title="Detail" data-toggle="tooltip" data-placement="top" class="btn menu-icon vd_bg-yellow"><i class="fa fa-info"></i></a> -->
												<!-- 	<a href="javascript:deleteRegUser(<?php echo $row3['flagpostprofileid']; ?>)" data-original-title="Delete" data-toggle="tooltip" data-placement="top" class="btn menu-icon vd_bg-red"><i class="fa fa-trash"></i></a> -->

                                            <a href="javascript:void(0)" data-toggle="modal" data-target="#sendwarning<?php echo $row3['spProfile_idspProfile']; ?>"  class="btn menu-icon vd_bg-red"> <i class="fa fa-warning" data-original-title="Send Warning" data-toggle="tooltip" data-placement="top" ></i> </a>

                                            <!--  <button type="button" class="btn btn-info" >Send Warning</button> -->

                                             <div class="modal fade" id="sendwarning<?php echo $row3['spPosting_idspPosting']; ?>" role="dialog">
											    <div class="modal-dialog">
											    
											      <!-- Modal content-->
											      <div class="modal-content bradius-15" style="text-align: left;">

											        <div class="modal-header">
											          <div class="col-md-12">
											            <button type="button" class="close" data-dismiss="modal">&times;</button>
											            <h4 class="modal-title">Send Warning</h4>
											          </div>
											        </div>
											        <div class="modal-body">
                                                     <div class="col-md-12">
											         
													     <label for="comment">Message:</label>
													     <br>
														 <textarea class="" style="Width:100%;" rows="5" id="Warning"></textarea>
													 
													</div>
											        </div>
											        <div class="modal-footer">
											        	<div class="col-md-12">
											          <button type="button" class="btn vd_btn vd_bg-green finish" data-dismiss="modal">Close</button>

											          <button type="button" class="btn vd_btn vd_bg-yellow">Send</button>
											      </div>


											        </div>
											      </div>
											      
											    </div>
											 </div>



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
  </div>


 <div class="tab-pane fade" id="flager_p" role="tabpanel" aria-labelledby="contact-tab-md">
          	<div class="box-body" >
				<div class="table-responsive tbl-respon">
					<table id="flaged_table" class="table table-bordered table-striped tbl-respon2">
						<thead>
							<tr>
								<th style="width: 1px;">ID</th>
								<!-- <th>Flagger profile id</th> -->
								<th>Profile Name</th>
								<!-- <th>Description</th> -->
								<th>Flag Count</th>
								<!-- <th>Action</th> -->
							</tr>
						</thead>
						<tbody>
							<?php
							$sql4 =  "SELECT *,COUNT(*) as Count FROM flagtimelinepost  INNER JOIN sppostings ON flagtimelinepost.spPosting_idspPosting=sppostings.idspPostings  GROUP BY flagtimelinepost.spProfile_idspProfile";
		                    $result4  = dbQuery($dbConn, $sql4);
							
							if($result4){
								$i = 1;
								while ($row4 = dbFetchAssoc($result4)) {
									//extract($row2);
									?>
									<tr>
										<td class="text-center"><?php echo $i; ?></td>

										<!-- <td><?php echo"<a href='$BaseUrl/backofadmin/registerdUser/index.php?view=detail&uid=".$row4['userid']."'  target='_blank'>".$row4['spProfile_idspProfile']."</a>"; ?></td> -->
										<td><a href="../registerdUser/index.php?view=singleprofile&uid=<?php echo $row4['userid']."&pid=".$row4['spProfile_idspProfile']; ?>" target="_blank"><?php showProfileName($dbConn, $row4['spProfile_idspProfile']); echo " ("; showspUserName($dbConn, $row4['userid']); echo " )" ;?></a></td>
										<!-- <td><?php echo $row3['spPostingNotes']; ?></td> -->
										<td>
											<?php echo $row4['Count']; ?>
										</td>
                                    <!--     <td>	<?php 
													if ($row3['spUserLockstatus'] == 1) { ?>
														<a href="javascript:userunlock(<?php echo $row3['flagpostuserid'];?>)" data-original-title="Un-lock" data-toggle="tooltip" data-placement="top" class="btn menu-icon vd_bg-green"><i class="fa fa-unlock"></i></a>&nbsp; <?php
													}else{ ?>
														<a href="javascript:userlock(<?php echo $row3['flagpostuserid'];?>)" data-original-title="Block" data-toggle="tooltip" data-placement="top" class="btn menu-icon vd_bg-green"><i class="fa fa-lock"></i></a>&nbsp; <?php
													}
													?>
										</td> -->




									<!-- 	<td class="menu-action text-center">
                                            <?php if($row3['flag_status'] == 0){ ?>
											<a href="javascript:deactivepost(<?php echo $row3['spPosting_idspPosting']; ?>)" data-toggle="tooltip" title="" class="btn menu-icon vd_bg-red" data-original-title="Deactive This Post"><i class="fa fa-ban"></i></a>
											<?php }else{ ?>
											<a href="javascript:activepost(<?php echo $row3['spPosting_idspPosting']; ?>)" data-toggle="tooltip" title="" class="btn menu-icon vd_bg-green" data-original-title="Active This Post"><i class="fa fa-unlock"></i></a>

											<?php } ?>

                                               <a href="javascript:deletetimelineflag(<?php echo $row3['flag_id'] ; ?>)" data-original-title="Delete" data-toggle="tooltip" data-placement="top" class="btn menu-icon vd_bg-red"> <i class="fa fa-times"></i> </a>

                                                 <a href="javascript:postdetail(<?php echo $row3['spPosting_idspPosting'] ; ?>,<?php echo $row3['flag_id'] ; ?>)" data-original-title="See Post" data-toggle="tooltip" data-placement="top" class="btn menu-icon vd_bg-red"> <i class="fa fa-info"></i> </a>
                                            </a>
										</td> -->
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

   
  </div>



</div>







				<!--- End Table ---------------->
		</div>
        
		
	</section><!-- /.content -->
<script type="text/javascript">
    
    $(document).ready( function () {
  var table = $('#example1,#flaged_deactive,#flaged_table').DataTable( {

   "order": [[ 0, "desc" ]],
    pageLength : 10,
    lengthMenu: [[10, 20, 50, 100], [10, 20, 50, 100,]]
  } );
  
  /* var table = $('#example2').DataTable( {

   "order": [[ 0, "desc" ]],
    pageLength : 10,
    lengthMenu: [[10, 20, 50, 100], [10, 20, 50, 100,]]
  } );      */    
       
} );

  </script>
  
  		<script type="text/javascript">
            $(document).ready(function(){
                $(document).on("click",".disable-btn",function() {
                    var dataId = $(this).attr("data-id");
					  var cat_id = $(this).attr("data-catId");
                    var work = $(this).attr("data-work");
					//alert(work);
					if(work=='deactive'){
						swal({
						  title: "Do You Want Deactive this Listing?",
						  /*text: "You Want to Logout!",*/
						  type: "warning",
						  confirmButtonClass: "sweet_ok",
						  confirmButtonText: "Yes, Deactive!",
						  cancelButtonClass: "sweet_cancel",
						  cancelButtonText: "Cancel",
						  showCancelButton: true,
						},
						                function(isConfirm) {
                  if (isConfirm) {
                   window.location.href = '/dashboard/portfolio/delete_port.php?id=' +dataId+'&work='+work;
                  } 
                });
						
					}	
					if(work=='delete'){
                    swal({
                      title: "Do You Want Delete this Listing?",
                      /*text: "You Want to Logout!",*/
                      type: "warning",
                      confirmButtonClass: "sweet_ok",
                      confirmButtonText: "Yes, Delete!",
                      cancelButtonClass: "sweet_cancel",
                      cancelButtonText: "Cancel",
                      showCancelButton: true,
                    },
			 function(isConfirm) {
                  if (isConfirm) {
                   window.location.href = 'deleteflag.php?id=' +dataId+'&work='+work+'&cat_id='+cat_id;
                  } 
                });
					}	

                    // alert(dataId);
                });
            });
            
            
        </script>
		
		
				<script type="text/javascript">
            $(document).ready(function(){
                $(document).on("click",".deactive-btn",function() {
                    var dataId = $(this).attr("data-id");
					  var cat_id = $(this).attr("data-catId");
                    var work = $(this).attr("data-work");
					//alert(work);
					if(work=='deactive'){
						swal({
						  title: "Do You Want Deactive this Listing?",
						  /*text: "You Want to Logout!",*/
						  type: "warning",
						  confirmButtonClass: "sweet_ok",
						  confirmButtonText: "Yes, Deactive!",
						  cancelButtonClass: "sweet_cancel",
						  cancelButtonText: "Cancel",
						  showCancelButton: true,
						},
						                function(isConfirm) {
                  if (isConfirm) {
                   window.location.href = '/backofadmin/flag/deactivepost.php?id=' +dataId+'&work='+work+'&catId='+cat_id;
                  } 
                });
						
					}	
				

                    // alert(dataId);
                });
            });
            
            
        </script>