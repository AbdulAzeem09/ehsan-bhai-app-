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
		<h1>VIP Friend<small>[List]</small></h1>
	</section>
	<!-- Main content -->
	<section class="content">
		<div class="box box-success">
        <form action ="" method="post">
			<div class="box-body">
				
				
			
				<div class="table-responsive tbl-respon">
				<div class="col-md-3 padding-y-sm mt-2 ">
                        <div class="row mb-4 ">
                          <div class="col-md-12" class="form-control">
                              <select name="commission" id="warehouse" class="form-control" onchange="suggest_warehouse(this.value)">
                                    <option value="0">Select User</option>
									  <?php 
										 $sql =  "SELECT * FROM spuser ORDER BY `idspUser` DESC";
										 //echo $sql;die('=====');
										 $result  = dbQuery($dbConn, $sql);
										 while ($row = dbFetchAssoc($result)) {
											//print_r($row );
									
									  ?>
                                    <option value="<?php echo $row['idspUser'];?>"><?php echo $row['spUserName'];?>(<?php  echo $row['spUserEmail']; ?>)</option>
                                     <?php }
									  
									  ?>
                                 </select> 
                          </div>
                        </div>
                      </div>
					
				</div>
			</div><br>
            <button class="pull-right btn btn-warning" type="submit" name="submit_module" style="margin-top: 15px;">Add</button> 
            </form>
				<!--- End Table ---------------->
		</div>
        
		
	</section><!-- /.content -->

	<section class="content">
		<div class="box box-success">
			<div class="box-body">
				
				
			
				<div class="table-responsive tbl-respon">
					<table id="example1" class="table table-bordered table-striped tbl-respon2">
                  
						<thead>
							<tr>
								
								<th>id</th>
								<th >User Name</th>
								<th >Action</th>
								
							</tr>
						</thead>
						<tbody>
							<?php
							if ($result) {
								$i = 1;
                                $sql =  "SELECT * FROM vip_commission ORDER BY `id` asc";
                                     $result2  = dbQuery($dbConn, $sql);
                                     //$row2 = dbFetchAssoc($result2);
                                     //print_r($aa);die('===');
                                   $i=1;
								while ($row = dbFetchAssoc($result2)) {
									$ids=$row['id'];
									$rr =  "SELECT * FROM spuser WHERE idspUser=$row[user_id]";
                                     $get_row  = dbQuery($dbConn, $rr);
									 $user_name = dbFetchAssoc($get_row)
							
									?>
									<tr>
									<td><?php echo $i; ?></td>
										<td><?php echo $user_name['spUserName']; ?></td>
										<td>
											
							
										
<a  class="btn btn-danger" href="<?php $_SERVER["DOCUMENT_ROOT"]?>/backofadmin/friend_commission/index.php?view=delete&id=<?php echo $ids; ?>">delete</a></td>

									
										
								
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
	<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
  $("#warehouse").select2({
      selectOnClose: true
  
  });</script>

<script type="text/javascript">
		
		$(document).ready( function () {
  var table = $('#example1').DataTable( {

   "order": [[ 0, "desc" ]],
    pageLength : 10,
    lengthMenu: [[10, 20, 50, 100], [10, 20, 50, 100]]
  } );
  
		        
		   
} );


