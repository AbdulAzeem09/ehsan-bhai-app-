<?php


require_once '../library/config.php';
require_once '../library/functions.php';
error_reporting(0);
@ini_set('display_errors', 0);
	if (!defined('WEB_ROOT')) {
		exit;
	}
 	
?>
	<?php
	$sql =  "SELECT * FROM registration_type ";
	$result  = dbQuery($dbConn, $sql);
	
	
?>
	
	<!-- Content Header (Page header) -->
	<section class="content-header top_heading">
		<h1>Registration Type</h1>
	</section>
	<!-- Main content -->
	<section class="content">
        <!-- start any work here. -->
		<form name="frmAddMainNav" id="frmAddMainNav" method="post" action="processArtRag.php?action=add"  enctype="multipart/form-data" onsubmit="return validate(this)">
			
			<div class="box box-success">
				<div class="box-body">
					<div class="row" id="alertmsg" style="margin: 10px 0px 0px 5px;">
						<?php 
						if(isset($_SESSION['errorMessage']) && isset($_SESSION['count'])){
							if($_SESSION['count'] <= 1){
								$_SESSION['count'] +=1; ?>
								<div style="min-height:10px;"></div>
								<div class="alert alert-<?php echo $_SESSION['data'];?>">
									<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
									<?php echo $_SESSION['errorMessage'];  ?>
								</div> <?php
								unset($_SESSION['errorMessage']);
							}
						} ?>
					</div>
					<div class="row">
						
						<div class="col-md-6 col-sm-6" style="margin-bottom:20px;">
							<label>Title:</label></br>
							<input type="text" name="txtTitle" id="txtTitle" class="form-control" required="required"/>
						</div>
						<div class="col-md-6 col-sm-6" style="margin-bottom:20px;">
							<label>Register Type:</label></br>
							<select  class="form-control" required="required" id="type" name="type">
								<option>Select</option>
								<option value="event">Event</option>		
								<option value="sponsor">Sponsor</option>									
							</select>
						</div>
						<div class="col-md-6 col-sm-6" style="margin-bottom:20px;">
							<label>Price:</label></br>
							<input type="text" name="Price" id="Price" class="form-control" required="required"/>
						</div>
						
						                    
					</div>
				</div>
				<div class="box-footer"> 
                    <input type="submit" name="btnButton" value="Save" class="btn vd_btn vd_bg-green finish" /> &nbsp;
                    <input type="button" name="btnButton" value="Back" class="btn vd_btn vd_bg-yellow" onclick="window.location.href='index.php?view=registration_type'" /> &nbsp;
                </div>
			</div>
			
		</form>

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
			} 
			
			
			

	$sql1 =  "SELECT * FROM registration_type ";
	$result1  = dbQuery($dbConn, $sql1);
	
			?>
			
			<!-- /.box-header -->
			<div class="box-body" >
				<div class="table-responsive tbl-respon">
					<table id="example1" class="table table-bordered table-striped tbl-respon2">
						<thead>
							<tr>
								<th>ID</th>
								<th>Name</th>
								<th>Price</th>	
								<th>Type</th>									
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							<?php
							if ($result1) {
								$i = 1;
								while ($row = dbFetchAssoc($result1)) {
									extract($row);
									?>
									<tr>
										<td class="text-center"><?php echo $i; ?></td>
										
										<td><?php echo $row['name']?></td>
										
										<td><?php echo $row['price']?></td>

										<td><?php echo $row['type']?></td>
										<td>

                                            <a href="javascript:modifyRegType(<?php echo $row['id']?>)" data-original-title="Edit" data-toggle="tooltip" data-placement="top" class="btn menu-icon vd_bg-yellow"> <i class="fa fa-pencil"></i> </a>
                                            <a href="javascript:deleteRegType(<?php echo $row['id']?>)" data-original-title="Delete" data-toggle="tooltip" data-placement="top" class="btn menu-icon vd_bg-red"> <i class="fa fa-times"></i> </a>
                                            
									
												
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


<script>
	// JavaScript Document
	//ADD
	function addArtCat(){
		window.location.href = 'index.php?view=add';
	}
	//MODIFY
	function modifyRegType(ArtCat){
		window.location.href = 'index.php?view=modify&id=' + ArtCat;
	}
	//DELETE 
	function deleteRegType(ArtCat){
		if (confirm('Do You Want Delete this Category?')) {
			window.location.href = 'processArtCat.php?action=delete&id=' + ArtCat;
		}
	}



    function deleteclassificateCategory(subCat){



        swal({
                title: "Do You Want Delete this  Category?",
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
                    window.location.href = 'process.php?action=delete&subCat=' + subCat;
                } else {
                    // swal("Cancelled", "You canceled)", "error");
                }
            });






        /*if (confirm('Do You Want Delete this Sub Category?')) {
            window.location.href = 'processSubCategory.php?action=delete&subCat=' + subCat;
        }*/
    }
</script>