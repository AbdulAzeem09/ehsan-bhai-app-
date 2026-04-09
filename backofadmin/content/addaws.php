<?php
if (!defined('WEB_ROOT')) {
		exit;
	}


	$sql =  "SELECT * FROM `aws_s3_key`";
	$result  = dbQuery($dbConn, $sql);
	$row = mysqli_fetch_array($result);


if(isset($_POST['key_name'])){
	$id = $_POST['id'];
	
	$key_name = $_POST['key_name'];
	$secret_name = $_POST['secret_name'];
	
	$sql =  "UPDATE `aws_s3_key` SET `key_name`= '$key_name',`secret_name`= '$secret_name' WHERE id=$id";
	//echo $sql; die;
	$result  = dbQuery($dbConn, $sql);
}
   
if(isset($_POST['region_name'])){
	$id = $_POST['id'];
	
	$region_name = $_POST['region_name'];
	$bucketName = $_POST['bucketName'];
	
	$sql =  "UPDATE `aws_s3` SET `region_name`= '$region_name',`bucketName`= '$bucketName' WHERE id=$id";
	//echo $sql; die;
	$result  = dbQuery($dbConn, $sql);
}
?>  


<!-- Content Header (Page header) -->
	<section class="row content-header top_heading">
		<div class="col-md-10">
			<h1>Aws S-3</h1>    
		</div>                                             
		<div id="demo" class="col-md-2 float-right">
  		</div>
	</section>
	<!-- Main content -->
<div class="row">	
<section class="content col-md-4">
	
		<!-- start any work here. -->
		<form method="post" >
			<div class="box box-success">
				<div class="box-body">
					<div class="row">
						<div class="col-md-12 col-sm-12">
							<div class="form-group"> 
								<label>Key:<span class="red">*</span></label>
								<input type="hidden" id="id" name="id" value="<?php echo $row['id']; ?>">
								<input type="text" id="key_name" class="form-control" value="<?php echo $row['key_name']; ?>" required>
							</div>
							<div class="form-group"> 
								<label>Secret:<span class="red">*</span></label>
								<input type="text" id="secret_name" class="form-control" value="<?php echo $row['secret_name']; ?>" required>
							</div>
						</div> 
					</div>
				</div>
				<div class="box-footer"> 
					
<input onclick="loadDoc()" type="button" value="Save" name="btnButtonsave" class="btn vd_btn vd_bg-green"> &nbsp;

<a href="/backofadmin" class="btn vd_btn vd_bg-yellow">Back</a> &nbsp;

            	</div>
			</div>

		</form>
	</section>
	
	
	
<section class="content col-md-8">
	
		<!-- start any work here. -->
		<form method="post" >
			<div class="box box-success">
				<div class="box-body">
					<div class="row">
						<div class="col-md-2">
							<div class="form-group"> 
								<label>Module:<span class="red">*</span></label>
							</div>
						</div> 
						<div class="col-md-4">
							<div class="form-group"> 
								<label>Bucket:<span class="red">*</span></label>
							</div>
						</div> 
						<div class="col-md-4">
							<div class="form-group"> 
								<label>Region:<span class="red">*</span></label>
							</div>
						</div> 
						<div class="col-md-2">
							<div class="form-group" style="margin-top: 27px;"> 					
							</div>
						</div> 
					</div>
					<?php
					
												
								$sql1 =  "SELECT * FROM `aws_s3`";
								$result1  = dbQuery($dbConn, $sql1);
								while($val = mysqli_fetch_array($result1)){									
					?>
					<div class="row">
						<div class="col-md-2">
							<div class="form-group"> 
								<div><?php echo $val['module_name']; ?></div>
							</div>
						</div> 
						<div class="col-md-4">
							<div class="form-group"> 
								<input type="text" id="bucketName<?php echo $val['id']; ?>" class="form-control" value="<?php echo $val['bucketName']; ?>" required>
							</div>
						</div> 
						<div class="col-md-4">
							<div class="form-group"> 
								<input type="text" id="region_name<?php echo $val['id']; ?>" class="form-control" value="<?php echo $val['region_name']; ?>" required>
							</div>
						</div> 
						<div class="col-md-2">
							<div class="form-group" > 					
									<input onclick="loadDocagain(<?php echo $val['id']; ?>)" type="button" value="Save" name="btnButtonsave" class="btn btn-success">
							</div>
						</div> 
					</div>
								<?php } ?>
				</div>
				
			</div>

		</form>
	</section>
</div>
	
	
	
<script>
function loadDoc() {
	var key_name =document.getElementById("key_name").value;
	var secret_name =document.getElementById("secret_name").value;

	
	var formData = new FormData();
	formData.append('id', '<?php echo $row['id']; ?>');
	
	formData.append('key_name', key_name);
	formData.append('secret_name', secret_name);
	
  const xhttp = new XMLHttpRequest();
  xhttp.onload = function() {
    document.getElementById("demo").innerHTML = 
		'<div style="width: 164px;" class="alert alert-success" role="alert">Change Successful</div>';
  }
  xhttp.open("POST", "aws-s3.php");
  xhttp.send(formData);
}

function loadDocagain(id) {
	var region_name =document.getElementById("region_name"+id).value;
	var bucketName =document.getElementById("bucketName"+id).value;

	
	var formData = new FormData();
	formData.append('id', id);
	
	formData.append('region_name', region_name);
	formData.append('bucketName', bucketName);
	
  const xhttp = new XMLHttpRequest();
  xhttp.onload = function() {
    document.getElementById("demo").innerHTML = 
		'<div style="width: 164px;" class="alert alert-success" role="alert">Change Successful</div>';
  }
  xhttp.open("POST", "aws-s3.php");
  xhttp.send(formData);
}




</script>