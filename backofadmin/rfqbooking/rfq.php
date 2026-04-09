<?php
error_reporting(0);
@ini_set('display_errors', 0);
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
  	
  	$sql = "SELECT * FROM quotation_transection";

  	$result = dbQuery($dbConn, $sql);
  	// custom pagignation
	//$result     = dbQuery($dbConn, getPagingQuery($sql, $rowsPerPage));
	//$pagingLink = getPagingLink($dbConn, $sql, $rowsPerPage);
 	
?>

		<!-- Content Header (Page header) -->
		<section class="content-header">
			<h1>Private RFQ Order<small>[RFQ]</small></h1>
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
									<th>Transection Id</th>
									<th>Product Name</th>
									
									<th >Order Date</th>
									<th>Amount Paid</th>
									<th>Quantity</th>
									<th>Ship To</th>
									<th>Sold By</th>
									<!-- <th>Action</th> -->
									
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
                         //idspQuotation
                
											
					$sql2 = "SELECT * FROM spquotationrfq AS t inner join spproduct as p on t.spPostings_idspPostings = p.idspPostings where idspQuotation = '$idspQuotation'";

  	                                  //echo $sql2;   die('++1');

  	                                         $result2 = dbQuery($dbConn, $sql2);

  	                                         $row2 = dbFetchAssoc($result2);
  	                                       //  print_r($row2);

  	                                       //  $buyerprofilid = $row['buyer_pid'];

                                              //$sellerprofilid = $row2['spSellerProfileId'];

                                //buyerdata
                                $sql3 = "SELECT * FROM spprofiles where idspProfiles = $buyer_pid";
                                $result3 = dbQuery($dbConn, $sql3);

  	                                         $row3 = dbFetchAssoc($result3);

  	                                        
                                            //sellerdata  
  	                                          $sql4 = "SELECT * FROM spprofiles where idspProfiles = $sell_idquotation";
                                $result4 = dbQuery($dbConn, $sql4);

  	                                         $row4 = dbFetchAssoc($result4);



											$payDate = strtotime($payment_date);
											
											
											?>
											<tr class="<?php echo ($spUserLock == 1)?'lockedwind':'';?>">
												<td class="text-center"><?php echo $i++;?></td>
												<td><!-- <a href="javascript:userDetail(<?php echo $idspUser; ?>)"><?php echo $txn_id;	?></a> --><?php echo $txn_id;	?></td>
												
												<?php
												if (isset($_GET['searchby']) && $_GET['searchby'] == "posted") {
													echo "<td>".$totalpost."</td>";
												}
												?>
												<!-- <td><?php echo $spUserCountryCode.$spUserPhone; ?></td> -->
												<!-- <td><?php echo $spUserEmail; ?></td> -->
												
												<td class="text-center"><?php echo $row2['spPostingTitle'];?></td>
												<td class="text-center"><?php echo date("Y-m-d H:i:A",strtotime($payment_date));?></td>
												<!-- <td> -->
												<!-- 	<?php
													if($spUserCountry > 0 && $spUserCountry != ''){
														CountryName($dbConn, $spUserCountry);
													} ?> -->
														
												<!-- </td> -->
												<td><?php echo '$'.$payment_gross; ?></td>
												<td class="text-center"><?php echo $row2['spQuotationTotalQty']; ?></td>
												<td><?php echo $row3['spProfileName']; ?></td>
												
												<td class="text-center menu-action" style="">
													<?php echo $row4['spProfileName']; ?>
                                            		<!-- <?php
													if ($spUserLock == 1) { ?>
														<a href="javascript:userunlock(<?php echo $idspUser;?>)" data-original-title="Un-lock" data-toggle="tooltip" data-placement="top" class="btn menu-icon vd_bg-green"><i class="fa fa-unlock"></i></a>&nbsp; <?php
													}else{ ?>
														<a href="javascript:userlock(<?php echo $idspUser;?>)" data-original-title="Block" data-toggle="tooltip" data-placement="top" class="btn menu-icon vd_bg-green"><i class="fa fa-lock"></i></a>&nbsp; <?php
													}
													?>
                                                    
                                                    
                                                    <a href="javascript:userDetail(<?php echo $idspUser; ?>)" data-original-title="Detail" data-toggle="tooltip" data-placement="top" class="btn menu-icon vd_bg-yellow"><i class="fa fa-info"></i></a>
													<a href="javascript:deleteRegUser(<?php echo $idspUser; ?>)" data-original-title="Delete" data-toggle="tooltip" data-placement="top" class="btn menu-icon vd_bg-red"><i class="fa fa-trash"></i></a> -->
                                                </td>
                                              <!--  <td>

                                                	 <?php if(!empty($remark)){  ?>


                                                            <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#viewModal<?php echo $cid; ?>">View Remark</button>

                                                              <div class="modal fade" id="viewModal<?php echo $cid; ?>" role="dialog">
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

  <div class="modal fade" id="myModal<?php echo $id; ?>" role="dialog">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h3 class="modal-title">Remark</h3>
        </div>
        <form action="transprocess.php?action=addremark" method="post">
        <div class="modal-body">
        
        <div class="row">
        	<div class="col-md-12">
		        <div class="">
		              <label for="comment">Remark:</label><br>
		              <textarea class="" name="remark" rows="5" id="remark" style="width: 100%;"></textarea>
		              <input type="hidden" name="trans_id" value="<?php echo $id; ?>">

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
												 -->
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
		
		$(document).ready( function () {
  var table = $('#example1').DataTable( {

   "order": [[ 0, "desc" ]],
    pageLength : 10,
    lengthMenu: [[10, 20, 50, 100], [10, 20, 50, 100, ]]
  } );
  
		        
		   
} );

	</script>	
			