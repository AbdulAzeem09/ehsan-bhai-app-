<?php
	if (!defined('WEB_ROOT')) {
		exit;
	}


    $sql =  "SELECT * FROM spuser ORDER BY `idspUser` DESC";
    //echo $sql;die('=====');
    $result  = dbQuery($dbConn, $sql);
	
	
?>

<?php 
	$user='';
if(isset($_POST['submit_module'])){
	//print_r($_POST['checkbox']);//die('=====');
    //$del="DELETE FROM vip_commission" ;

	$user=$_POST['commission'];
   $aa= "INSERT INTO vip_commission (user_id) VALUES ($user)";
   //echo $aa;die('=====');
   $result4  = dbQuery($dbConn,$aa);
   

}



?>
<style>
	.content {
    min-height: 150px!important;
	}
	.select2 {
		width: 400px!important;
	}
    
	</style>
	 <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>Purchase Package<small>[List]</small></h1>
	</section>
	
	
		<div class="box box-success">
			<div class="box-body">
				
				
			
				<div class="table-responsive tbl-respon">
					<table id="example1" class="table table-bordered table-striped tbl-respon2">
                  
						<thead>
							<tr>
								
								<th>id</th>
								<th >User Name</th>
								<th >email</th>
								<th >Package Name</th>
								<th >Package Amount</th>
								<th >Package Duration</th>
								<th >Date of Purchase</th>
								
							</tr>
						</thead>
						<tbody>
							<?php
							if ($result) {
								$i = 1;
                                $sql =  "SELECT * FROM sppackage_transaction ORDER BY `id` asc";
                                     $result2  = dbQuery($dbConn, $sql);
                                     //$row2 = dbFetchAssoc($result2);
                                     //print_r($aa);die('===');
                                   $i=1;
								while ($row = dbFetchAssoc($result2)) {
							
									$rr =  "SELECT * FROM spuser WHERE idspUser=$row[uid]";
                                     $get_row  = dbQuery($dbConn, $rr);
									 $user_name = dbFetchAssoc($get_row);

									 $pak =  "SELECT * FROM tbl_package WHERE id=$row[membership_id]";
                                     $get_row_1  = dbQuery($dbConn, $pak);
									 $package = dbFetchAssoc($get_row_1)
							
									?>
									<tr>
									<td><?php echo $i; ?></td>
										<td><?php echo $user_name['spUserName']; ?></td>
										<td><?php echo $user_name['spUserEmail'];   ?></td>
										<td><?php echo $package['pack_name'];   ?></td>
										<td><?php echo 'USD '.$package['pack_amount'];   ?></td>
										<td><?php echo $package['pack_duration'];   ?></td>
										<td><?php echo $row['createdon'];   ?></td>
											
							
								
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
        
		
	</section>




<script type="text/javascript">
		
		$(document).ready( function () {
  var table = $('#example1').DataTable( {

   "order": [[ 0, "desc" ]],
    pageLength : 10,
    lengthMenu: [[10, 20, 50, 100], [10, 20, 50, 100]]
  } );
  
		        
		   
} );
</script>

