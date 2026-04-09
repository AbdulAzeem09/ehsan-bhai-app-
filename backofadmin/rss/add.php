<?php
if (!defined('WEB_ROOT')) {
    exit;
}
function sp_autoloader($class)
{
    include '../mlayer/' . $class . '.class.php';
}
?>
	<!-- Content Header (Page header) -->

	<!-- Main content -->
	<section class="content" >
		<!-- start any work here. -->
		<form name="frmAddMainNav" id="frmAddMainNav" method="post" action="processRSS.php?action=add"  enctype="multipart/form-data" onsubmit="return validate(this)">
			<input type="hidden" name="rss_status" id="rss_status" value="1" />
			<div class="box box-success">
				<div class="box-body">
					<div class="" id="alertmsg" style="margin: 10px 0px 0px 5px;">
						<?php
							if (isset($_SESSION['errorMessage']) && isset($_SESSION['count'])) {
							    if ($_SESSION['count'] <= 1) {
							        $_SESSION['count'] += 1;?>
									<div style="min-height:10px;"></div>
									<div class="alert alert-<?php echo $_SESSION['data']; ?>">
										<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
										<?php echo $_SESSION['errorMessage']; ?>
									</div> 
									<?php 
									unset($_SESSION['errorMessage']); 
								}
							} ?>
					</div>
					<div class="row">

						<div class="col-md-3 col-sm-6" >
							<div class="form-group">
								<label>Website Name:</label><span class="red">*</span>
								<input type="text" name="website_name" id="website_name" onkeyup="clearerror();" class="form-control" />
								<span id="website_name_error"  class="red"></span>
							</div>
						</div>
						<div class="col-md-3 col-sm-6" >
							<div class="form-group">
								<label>Wesite Link:</label><span class="red">*</span>
								<input type="text" name="website_link" id="website_link" onkeyup="clearerror();" class="form-control" />
								<span id="website_link_error"  class="red"></span>
							</div>
						</div>
						<div class="col-md-3 col-sm-6">
	                         <div class="form-group">
							     <label for="pwd" class="lbl_7">Country</label>

	                             <select id="spUserCountry" class="form-control" name="country" >
	                                <option value="">Select Country</option>
	                                <?php
										$sql     = "SELECT * FROM tbl_country;";
										$result3 = dbQuery($dbConn, $sql);
										if ($result3 != false) {
										    while ($row3 = mysqli_fetch_assoc($result3)) {
										        ?>
	                                        <option value='<?php echo $row3['country_id']; ?>'><?php echo $row3['country_title']; ?></option>
	                                        <?php
											}
										}
									?>
	                            </select>
	                        </div>
	                    </div>
						<div class="col-md-3 col-sm-6">
                             <div class="form-group">
							     <label for="cat" class="lbl_7">Category<span class="red">* <span class="spUserCountry erormsg"></span></span></label>

                                 <select id="category" class="form-control" name="category" >
                                    <option value="">Select Category</option>
                                    <?php
										$sql     = "SELECT * FROM news_categories;";
										$result3 = dbQuery($dbConn, $sql);
										if ($result3 != false) {
										    while ($row3 = mysqli_fetch_assoc($result3)) {
										        ?>
                                            <option value='<?php echo $row3['id']; ?>'><?php echo $row3['name']; ?></option>
                                            <?php
											}
										}
									?>
                                </select>
                                <span id="category_error"  class="red"></span>
                            </div>
                        </div>

					</div>
				</div>
				<div class="box-footer">
	                <input type="submit" id="add" name="btnButton" value="Add" class="btn vd_btn vd_bg-green finish" /> &nbsp;
	                <input type="button" name="btnButton" value="Back" class="btn vd_btn vd_bg-yellow" onclick="window.location.href='index.php'" /> &nbsp;
	            </div>
			</div>


		</form>
	</section><!-- /.content -->

  <script type="text/javascript">
  	function clearerror(){
  		var website_name = $("#website_name").val();
  		var website_link = $("#website_link").val();

  		var flag=0;
  		if (website_name!=""){
  			var strArr = new Array();
  			strArr = website_name.split("");

	       if(strArr[0]==" ") {
	       	flag=1;
	       }

	   	}

	   var flag2=0;

	   	if (website_link!="")
	   	{
		   	var strArr = new Array();
		   	strArr = website_link.split("");

	       	if(strArr[0]==" ") // this is the the key part. you can do whatever you want here!
	       	{
	       		flag2=1;
	       	}


	   	}

	   	if(website_name != "" && flag != 1 ){
	   		$("#website_name_error").text("");
	   	}


	   	if(website_link!= ""){
	   		$("#website_link_error").text("");
	   	}
	}


	$( document ).ready(function() {
		$("#add").on("click", function(){

			var website_name = $("#website_name").val();
			var website_link = $("#website_link").val();
			var category = $("#category").val();

			var flag=0;

			if (website_name!="")
			{
				var strArr = new Array();
				strArr = website_name.split("");

		       	if(strArr[0]==" ") // this is the the key part. you can do whatever you want here!
		       	{
		       		flag=1;
		       	}

	        }

	       	var flag2=0;

	       	if (website_link!="")
	       	{
		       	var strArr = new Array();
		       	strArr = website_link.split("");

		       	if(strArr[0]==" ") // this is the the key part. you can do whatever you want here!
		       	{
		       		flag2=1;
		       	}

		    }

	       if(website_name == "" && website_link == "" && category == "" || flag == 1 || flag2 == 1){
	       	if(flag == 1){
	       		$("#website_name_error").text("Space not allowed.");
	       		return false;

	       	}
	       	if(flag2 == 1){
	       		$("#website_link_error").text("Space not allowed.");
	       		return false;

	       	}

	       	$("#website_link_error").text("Please Enter Website Link.");
	       	$("#website_name_error").text("Please Enter Website Name.");
	       	$("#category_error").text("Please Select Category.");
	       	return false;

	       }else if(website_name != "" && website_link == "" && category == ""){

	       		$("#website_link_error").text("Please Enter Website Link.");
	       		$("#website_name_error").text("");
	       		$("#category_error").text("Please Select Category.");

	       		return false;

	       }else if(website_name == "" && website_link != "" && category == ""){
	       		$("#website_link_error").text("");
	       		$("#website_name_error").text("Please Enter Website Name.");
	       		$("#category_error").text("Please Select Category.");

	       		return false;

	       }else if(website_name == "" && website_link == "" && category != ""){

	       	$("#website_link_error").text("Please Enter Website Link.");
	       	$("#website_name_error").text("Please Enter Website Name.");
	       	$("#category_error").text("");
	       	return false;

	       }else if(website_name == ""){
	       		$("#website_name_error").text("Please Enter Website Name.");

	       	return false;

	       }else if(website_link == ""){

	       		$("#website_link_error").text("Please Enter Website Link.");

	       	return false;

	       }else if(category == ""){

	       		$("#category_error").text("Please Select Category.");

	       	return false;

	       }

	       else if(flag == 1){
	       		$("#website_name_error").text("Space not allowed.");
	       		return false;
	       }
	       else if(flag2 == 1){
	       		$("#website_link_error").text("Space not allowed.");
	       		return false;
	       }
	       else{

	       	$("#frmAddMainNav").submit();
	       }

	   });
	});

        </script>
