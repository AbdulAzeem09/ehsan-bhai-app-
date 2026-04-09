<?php 
if (!defined('WEB_ROOT')) {
		exit;
	}
	
   // print_r($_SESSION);
	
	if(isset($_POST['submit'])){
		
		//print_r($_POST); 
		date_default_timezone_set('Asia/Kolkata');

           $date=date("Y-m-d h:i:s");
		$txtTitle = $_POST['txtTitle'];
	$txtDuration = $_POST['txtDuration'];
	  
	$txtAmount = $_POST['txtAmount'];
	$txtstatus = $_POST['status'];
    $txtdescription = $_POST['txtdescription'];
    $txtdescription = $_POST['txtdescription'];
    $id1=$_GET['id'];
	
	//$sql3 = "INSERT INTO  tbl_package (pack_name, pack_amount, pack_duration, pack_description,pack_status,created_date ) VALUES ('$txtTitle','$txtAmount','$txtDuration','$txtdescription','$txtstatus','$date')";

 $sql3="UPDATE tbl_package SET pack_name ='$txtTitle', pack_amount = '$txtAmount', pack_duration='$txtDuration',pack_description='$txtdescription' ,pack_status='$txtstatus' , created_date='$date' WHERE id=$id1";
	//echo $sql3; die("------------");
   // echo $sql3;
	$result3  = dbQuery($dbConn, $sql3);

    redirect("index.php?view=package");
		
	}
      $id=$_GET['id'];
    $sql =  "SELECT * FROM tbl_package WHERE id=$id";
    $result2  = dbQuery($dbConn, $sql);
    $row = dbFetchAssoc($result2)


?> 
<style>
	#mceu_19{
		display: none!important;
	}
	#eg-editor_ifr{
		height: 200px!important;
	}
</style>

<!-- Content Header (Page header) -->
	<section class="content-header top_heading">
		<h1>Add Package</h1>
	</section>
	<!-- Main content -->
	<section class="content" >
		<!-- start any work here. -->
		<form action=" " method="post" enctype="multipart/form-data" >
		
			<div class="box box-success">
				<div class="box-body">
					<div class="row mg_btm_30">
						
						<div class="col-md-4 col-sm-4 mg_btm_30">
							<div class="form-group">
								<label>Package Name:</label>
								<input type="text" name="txtTitle" id="txtTitle" class="form-control" required="required" value="<?php echo $row['pack_name'];  ?>" />
							</div>
							
						</div>
					
						<div class="col-md-4 col-sm-4 mg_btm_30">
							<div class="form-group">
								<label>Package Duration:</label>
								<input type="text" name="txtDuration" id="txtDuration" class="form-control" required="required" value="<?php echo $row['pack_duration'];  ?>" />
							</div>
						</div> 
						
						<div class="col-md-4 col-sm-4 mg_btm_30">
							<div class="form-group">
								<label>Amount</label>
								<input type="text" name="txtAmount" id="txtAmount" class="form-control" required="required" value="<?php echo $row['pack_amount'];  ?>" />
							</div>
						</div> 
                        
                        <div class="col-md-12 col-sm-4 mg_btm_30">
							<div class="form-group">
								<label>Description</label>
								<textarea  class="form-control c-with-editor" id ="eg-editor" name="txtdescription" rows="" cols="" ><?php echo $row['pack_description'];  ?></textarea>

								<!--<input type="text" name="txtdescription" id="txtdescription" class="form-control" required="required" value="<?php echo $row['pack_description'];  ?>"/>-->
							</div>
							
						</div>

                        <div class="col-md-4 col-sm-4 mg_btm_30">
							<div class="form-group">
								<label>Status</label><br>
                                <input type="radio" id="active" name="status" value="1" <?php if($row['pack_status']==1){ echo 'checked';} ?>>
                              <label for="html">Active</label>
                            <input type="radio" id="inactive" name="status" value="0" <?php if($row['pack_status']==0){ echo 'checked';} ?>>
                               <label for="css">Inactive</label><br>
							</div>
							
						</div>

						
							
					</div>
				</div>
				<div class="box-footer"> 
                    <input type="submit" name="submit" value="Update" class="btn vd_btn vd_bg-blue finish" /> &nbsp;
                   <!-- <input type="button" name="btnButton" value="Back" class="btn vd_btn vd_bg-yellow" onclick="window.location.href='index.php'" /> &nbsp;-->
                </div>
			</div>
			
		</form>

	</section><!-- /.content -->

	<script src="https://design.sleekr.id/assets/scripts/main.js"></script>
<script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>      

<script type="text/javascript">
	tinymce.init({ selector:'.c-with-editor', skin: "lightgray",  height: 100, menubar: false, statusbar: false, plugins: ['advlist autosave lists hr spellchecker nonbreaking'], toolbar: [ 'bold italic underline | alignleft aligncenter alignright alignjustify | styleselect | numlist bullist |' ], });  
</script>

