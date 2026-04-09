<?php
	if (!defined('WEB_ROOT')) {
		exit;
	}
	$rowsPerPage = 25;

/*	if (isset($_GET['orderby']) && $_GET['orderby'] != '') {

		$order = $_GET['orderby'];
		$sql = "SELECT * FROM spuser ORDER BY spUserRegDate $order ";
	}else if(isset($_GET['useryby']) && $_GET['useryby'] != ''){

		$userby = $_GET['useryby'];
		if ($userby == 'active') {
			$order = "ASC" ;
		}else{
			$order = "DESC"; 
		}
		$sql = "SELECT * FROM spuser ORDER BY spUserLock $order";
	}else if(isset($_GET['searchby']) && $_GET['searchby'] != ''){

		if($_GET['searchby'] == "duplicate"){
			
			$sql = "SELECT *, spuser.spUserIpLastLogin FROM spuser INNER JOIN( SELECT spUserIpLastLogin FROM spuser GROUP BY spUserIpLastLogin HAVING COUNT(idspUser) >1 )temp ON spuser.spUserIpLastLogin= temp.spUserIpLastLogin WHERE spuser.spUserIpLastLogin != '' ";
		}else{
			$sql = "SELECT *, COUNT(*) as totalpost FROM spuser AS u INNER JOIN spprofiles AS p on u.idspUser = p.spUser_idspUser INNER JOIN sppostings AS f ON p.idspProfiles = f.spProfiles_idspProfiles GROUP BY u.idspUser HAVING COUNT(*) > 1 ORDER BY totalpost DESC";
		}
	}else{
		$sql = "SELECT * FROM spuser WHERE spUserRegDate like('%".date('Y-m-d')."%') ";
		//$sql =	"SELECT * FROM spuser WHERE  ORDER BY idspUser DESC";
	}*/
  	
  	$sql = "SELECT * FROM withdraw_amount";

  	$result = dbQuery($dbConn, $sql);
  	// custom pagignation
	//$result     = dbQuery($dbConn, getPagingQuery($sql, $rowsPerPage));
	//$pagingLink = getPagingLink($dbConn, $sql, $rowsPerPage);
 	
?>

		<!-- Content Header (Page header) -->
		<section class="content-header">
			<!-- <h1>Withdraw<small>[Event]</small></h1> -->
			<h1>Withdraw</h1>
		</section>
		<!-- Main content -->
		<section class="content">

	

		<div class="">
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
				<div class="box-body">

					
					<div class="table-responsive">
		              	<table id="example1" class="table table-striped table-bordered">
			                <thead>
			                 	<tr>
									<th class="text-center" style="width: 50px!important;">ID</th>
									<!-- <th>Ticket ID</th> -->
									
									<?php
									if (isset($_GET['searchby']) && $_GET['searchby'] == "posted") {
										echo "<th>Total Post</th>";
									}
									?>
									<th>User Name</th>
									<th>Amount Requested</th>
									<th >Bank Name</th>
									<th>Account No</th>
									<th>IFSC CODE</th>
									<th>Comment</th>
									<th>User Name(Bank)</th>
									<th>Requested on</th>
									<th>Action</th>
									
									
									<!-- <th class="text-center" style="min-width: 80px;">Action</th> -->
								</tr>
			                </thead>
			                <tbody>
			                	<?php
									if ($result){
										if (isset($_GET['page']) && $_GET['page'] > 1) {
											$i = 25 * ($_GET['page'] - 1) + 1;
										}else{
											$i = 1;
										}
										
										while($row = dbFetchAssoc($result)) {
											extract($row);
											
											$sql2 = "SELECT * FROM spbankdetail where uid = $userid";

  	                                         $result2 = dbQuery($dbConn, $sql2);

  	                                         $row2 = dbFetchAssoc($result2);
  	                                        // print_r($row2);

  	                                        // print_r($result2);

											@$payDate = strtotime($payment_date);
											
											$idspUser = $row['userid'];				
                                             
                                            $id = $row['id'];

                                            $status = $row['withdrawstatus'];
                                             //echo $status;

											?>



											<tr class="<?php echo ($spUserLock == 1)?'lockedwind':'';?>">
												<td class="text-center"><?php echo $i++;?></td>
												<td><!-- <a href="javascript:userDetail(<?php echo $idspUser; ?>)"><?php echo $txn_id;	?></a> --><a href="javascript:userDetail(<?php echo $idspUser; ?>)"><?php showProfileName($dbConn, $profile_id); ?></a></td>
												
												
												<!-- <td><?php echo $spUserCountryCode.$spUserPhone; ?></td> -->
												<!-- <td><?php echo $spUserEmail; ?></td> -->
												
												<td ><?php echo '$'.$withdraw_amount;?></td>
												<td class="text-center"><?php echo @$row2['spBankname'];?></td>

												<td><?php echo @$row2['spAccountname']; ?></td>
												<td class="text-center"><?php echo @$row2['spBankcode']; ?></td>
												<td><?php echo $comment; ?></td>
												
												<td class="text-center menu-action" style="">
													<?php echo @$row2['spBankusername']; ?>
                                            	
                                                </td>
                                                <td>

                                                	<?php echo date("Y-m-d H:i:A",strtotime($created));?>

                
                                                        
                                                </td>

                                                <td>

                                                	<?php if(!empty($remark)){  ?>


                                                            <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#viewModal<?php echo $id; ?>">View Remark</button>

                                                              <div class="modal fade" id="viewModal<?php echo $id; ?>" role="dialog">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h3 class="modal-title">Remark</h3>
        </div>

        <div class="modal-body">
        
        <div class="row">
        	<div class="col-md-12">
		        <div class="">
		            
		            <p><?php echo $remark ?></p>

		         </div>
           </div>
        </div>


        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
          
        </div>

      </div>
    </div>
  </div>


                                                	<?php }else{  ?>


                                                	 <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#myModal<?php echo $id; ?>">Remark</button>

  <!-- Modal -->
  <div class="modal fade" id="myModal<?php echo $id; ?>" role="dialog">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h3 class="modal-title">Remark</h3>
        </div>
        <form action="withdraw.php?action=addremark" method="post">
        <div class="modal-body">
        
        <div class="row">
        	<div class="col-md-12">
		        <div class="">
		              <label for="comment">Remark:</label><br>
		              <textarea class="" name="remark" rows="5" id="remark" style="width: 100%;"></textarea>
		              <input type="hidden" name="withdraw_id" value="<?php echo $id; ?>">

		         </div>
           </div>
        </div>


        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-success" >Submit</button>
        </div>
        </form>
      </div>
    </div>
  </div>

<?php }  ?>
                                                        
                                                </td>

                                                <td>

<select id="Statusdropdown" name="Status" size="1"  class="btn btn-info btn-sm" style="background-color: #008d4c; border-color: #008d4c; " >
             <option value="" style="display:none">Status</option> 
                <option value="0" <?php if($status == '0') echo "selected"; ?>>Pending</option>
                <option value="1" <?php if($status == '1') echo "selected"; ?>>Completed</option>
        </select>

<input name="field1" type="hidden" id="withdrawuserid" value="<?php echo $idspUser; ?>"/>
<!-- 
                        <div class="dropdown open">
                        	 <button type="button" class="btn btn-info btn-sm" style="background-color: #008d4c; border-color: #008d4c;">Status<span class="caret" style="margin-left: 6px;"></span></button>
                     
                        <ul class="dropdown-menu sp-profile-det" style="padding-left: 10px; padding-bottom: 5px; padding-top: 5px;">
                  <li>
                   <a href="" class="btn btn-info btn-sm" data-toggle="modal" data-target="#mycamUpload" style="margin: 3px 0;">Pending</a>
					
				  </li>
                  <li>
                <a href="javascript:void(0)" class="btn btn-primary uplodcam db_btn db_primarybtn" data-toggle="modal" data-target="#myimageUpload" style="margin: 6px 0; min-width: 174px;">Complete</a>
					
				
                
                 </li>
                                                                        
                        </ul>
                    </div> -->
                                                	</td>
												
											</tr><?php
										}
									}else { ?>
										
										<?php 
									} //end while ?>
									
			                </tbody>
		                </div>
	              	</table>
	            </div><!-- /.box-body -->
				
	        </div>
				<!--- End Table ---------------->
		</div>
		
		
		
	</section><!-- /.content -->
	
<script type="text/javascript">
//function get_approvedata(id){

 $(document).ready(function() {
  $('#Statusdropdown').on('change', function() {

  //	alert();
    //lert($('#discount').val());
 

 var Statusdropdown=$('#Statusdropdown').val();


var sid = $("#withdrawuserid").val();
 
//alert(sid);

//alert(Statusdropdown);

swal({
			title: "Are you sure?",
			type: "warning",
			confirmButtonClass: "sweet_ok",
			confirmButtonText: "Yes",
			cancelButtonClass: "sweet_cancel",
			cancelButtonText: "No",
			showCancelButton: true,
		},

      function(isConfirm) {
        if (isConfirm) {
          $.ajax({
          	 type: 'POST',
           //  url: 'deleteshipping_add.php',

              url:'withdraw.php',
      //  data: {'status': '1','userid':userid},
        //data:  'status=1&userid='+userid,
      
            // data: info,
            data:{'status': Statusdropdown,'sid': sid},

             error: function() {
                alert('Something is wrong');
             },
               success: function(response){ 

                       // console.log(data);


                                 swal({

                                  title: "Status Changed!",
                                  type: 'success',
                                  showConfirmButton: true

                                },
                             function() {

                                        window.location.reload();

                                  });

   }


          });
        
    } 
       
      });


  });
});



		
		$(document).ready( function () {
  var table = $('#example1').DataTable( {

   "order": [[ 0, "desc" ]],
    pageLength : 10,
    lengthMenu: [[10, 20, 50, 100], [10, 20, 50, 100, ]]
  } );
  
		        
		   
} );

	</script>	
			