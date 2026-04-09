<?php
	$view = (isset($_GET['view']) && $_GET['view'] != '') ? $_GET['view'] : '';
	$id = (isset($_GET['id']) && $_GET['id'] != '') ? $_GET['id'] : '';


	if (!defined('WEB_ROOT')) {
		exit;
	}


	$sql =  "SELECT * FROM tbl_dollar ORDER BY dollar_id DESC ";
	$result  = dbQuery($dbConn, $sql);

	$hidId = "";
	$txtPoint_v = "";
	if(isset($_GET['id']) && $_GET['id'] !=''){
		$sql2 =  "SELECT * FROM tbl_dollar WHERE dollar_id=".$id." ";
		$result2  = dbQuery($dbConn, $sql2);
		$row2 = dbFetchAssoc($result2);
		$hidId = $row2['dollar_id'];
		$txtPoint_v = $row2['dollar_point'];
	}
	
	
	
	
?>
	<style type="text/css">
	input{
		width: 80px;
	}
	.table-responsive {
    min-height: .01%;
    overflow-x: unset !important;
	}
	
</style>
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>Dollar<small>[List]</small></h1>
	</section>
	<!-- Main content -->
	<section class="content">
		<div class="box box-success">
			<!-- <div class="box-header">
				<?php if(isset($view) && $view =='modify'){  ?>
					<form method="post" action="process.php?action=modify">
				<?php }else{  ?>
					<form method="post" action="process.php?action=add">
				<?php } ?>
				
					<div class="row">
						<div class="col-md-2">
							<div class="form-group">
								<label>Dollar</label>
								<input type="text" readonly="" class="form-control" name="txtDollar" value="1" >
								<input type="hidden" class="form-control" name="hidId" value="<?php echo $hidId; ?>" >
							</div>
						</div>
						<div class="col-md-2">
							<div class="form-group">
								<label>Points</label><span class="red">*</span>
								<input type="text" class="form-control" name="txtPoint" value="<?php echo $txtPoint_v; ?>" maxlength="40" id="txtTitle" >
							</div>
							<span id=text_error  class="red"></span>

						</div>
						<div class="col-md-2">
							<div class="form-group">
								<label>&nbsp;</label><br>
								<input type="submit" class="btn btn-primary" name="btnSubmit" value="Save" id="add" >
							</div>
						</div>
					</div>
				</form>
			</div> -->
			<form method="post" action="process.php?action=edit">
			<div class="box-body">
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
				
			
				<div class="table-responsive tbl-respon">
					<table class="table table-bordered table-striped text-center" id="example1">
						<thead>
							<tr>
								
								<th class="text-center">Dollar</th>
								<th class="text-center">Point</th>
								<!-- <th class="text-center">Action</th> -->
								<th class="text-center">Action</th>
								
							</tr>
						</thead>
						<tbody>
							<?php
							if ($result) {
								$i = 1;
								while ($row = dbFetchAssoc($result)) {

									extract($row);
									?>
									<tr>
										
										<td><input type="text" readonly="" name="txtDollar" value="<?php echo "$".$dollar_amt; ?>" ></td>
										<td>
											<input type="hidden" name="hidId" value="<?php echo $dollar_id; ?>" >
											<input type="text" name="txtPoint" value="<?php echo $dollar_point; ?>" maxlength="40" id="txtTitle" >


											</td>
										<!-- <td><a href="javascript:modify(<?php echo $dollar_id; ?>)" data-original-title="Edit" data-toggle="tooltip" data-placement="top" class="btn menu-icon vd_bg-yellow"> <i class="fa fa-pencil"></i> </a></td> -->
									<!----	<td><?php echo formatMySQLDate($start_date, 'd-M-Y'); ?></td>
										<td><input style="background-color: green !important;" type="submit" class="btn btn-primary" name="btnSubmit" value="Save" id="add" ></td>--->
									<td><input style="background-color: blue !important;" type="submit" class="btn btn-primary" name="btnSubmit" value="Update"  ></td>
										<!-- <td><?php 
											//if ($end_date == '0000-00-00 00:00:00') {
												# code...
											//  echo formatMySQLDate($end_date, 'd-M-Y'); 

											//}else{
											//	echo formatMySQLDate($end_date, 'd-M-Y'); 
											//}
											
										?></td> -->
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
			</form>
				<!--- End Table ---------------->
		</div>
        
		
	</section><!-- /.content -->

	<script type="text/javascript">  /*js start*/
        	
           $( document ).ready(function() {
                $("#add").on("click", function(){


                var txtIndusrtyType = $("#txtTitle").val();


                             	  var flag=0;
      
       if (txtIndusrtyType!="")
       {
       var strArr = new Array();
       strArr = txtIndusrtyType.split("");

       if(strArr[0]==" ") // this is the the key part. you can do whatever you want here!
       {
       flag=1;
       }


       }
                	if(txtIndusrtyType == ""){
                     		

                     	$("#text_error").text("Please Enter Points.");
                     	return false;

                     } else if(flag == 1){
                     	$("#text_error").text("Space not allowed.");
                     	return false;

                     }else{
                        
                         $("#frmAddMainNav").submit();
                     }

                 });
           });

        </script>	<!-----js end------->
        <script type="text/javascript">
		
		$(document).ready( function () {
  var table = $('#example1').DataTable( {

   "order": [[ 0, "desc" ]],
    pageLength : 10,
    searching: false, paging: false, info: false,"ordering": false,
    lengthMenu: [[10, 20, 50, 100], [10, 20, 50, 100]]
  } );
  
	
		   
} );

	</script>	
		
		