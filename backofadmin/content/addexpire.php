<?php
if (!defined('WEB_ROOT')) {
		exit;
	}


	$sql =  "SELECT * FROM `expire_date`";
	$result  = dbQuery($dbConn, $sql);
	$row = mysqli_fetch_array($result);

if(isset($_POST['exdate'])){
	$id = $_POST['id'];
	$exdate = $_POST['exdate'];
	$sql =  "UPDATE `expire_date` SET `expiredate`= '$exdate' WHERE id=$id";
	//echo "UPDATE `expire_date` SET `expiredate`= '$exdate' WHERE id=$id"; die();
	$result  = dbQuery($dbConn, $sql);
}
?>
<!-- Content Header (Page header) -->
	<section class="row content-header top_heading">
		<div class="col-md-10">
			<h1>Expire Page</h1>
		</div>
		<div id="demo" class="col-md-2 float-right">
  		</div>
	</section>
	<!-- Main content -->
<section class="content">
	
		<!-- start any work here. -->
		<form method="post" >
			<div class="box box-success">
				<div class="box-body">
					<div class="row">
						<div class="col-md-3 col-sm-6">
							<div class="form-group"> 
								<label>Expire Date:<span class="red">*</span></label>
								<input type="hidden" id="id" name="id" value="<?php echo $row['id']; ?>">
								<input type="number" id="exdate" name="exdate" class="form-control" value="<?php echo $row['expiredate']; ?>">
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
<script>
function loadDoc() {
	var exdate = document.getElementById('exdate').value;
	var formData = new FormData();
	formData.append('id', '<?php echo $row['id']; ?>');
	formData.append('exdate', exdate);
	
  const xhttp = new XMLHttpRequest();
  xhttp.onload = function() {
    document.getElementById("demo").innerHTML = 
		'<div style="width: 164px;" class="alert alert-success" role="alert">Change Successful</div>';
  }
  xhttp.open("POST", "expire.php");
  xhttp.send(formData);
}
</script>