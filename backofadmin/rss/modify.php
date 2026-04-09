<?php
	if (!defined('WEB_ROOT')) {
		exit;
	}
	$errorMessage = (isset($_GET['error']) && $_GET['error'] != '') ? $_GET['error'] : '&nbsp;';

	if(isset($_GET['rss_id']) && ($_GET['rss_id']) > 0){
		$rss_id  = $_GET['rss_id'];
	}else {
		redirect('index.php');
	}
	$sql = "SELECT * FROM rss_data WHERE rss_id ='$rss_id'";
	$result = dbQuery($dbConn, $sql);
	$row    = dbFetchAssoc($result);
	extract($row);
?>
<?php

	?>	
	
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>Category<small>[Modify]</small></h1>
	</section>
	<!-- Main content -->
	<section class="content" >
		<!-- start any work here. -->
		<form name="frmcategory" id="frmcategory" method="post" action="processRSS.php?action=modify"  enctype="multipart/form-data">
			<input type="hidden" name="hidId" id="hidId"  value="<?php echo $rss_id;?>"/>
            
			<div class="box box-success">
				<div class="box-body">
					<div class="" id="alertmsg" >
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
						
						<div class="col-md-3 col-sm-6" >
							<div class="form-group">
								<label>Website Name:</label><span class="red">*</span>
								<input type="text" name="website_name" id="website_name" value="<?php echo $website_name;?>" class="form-control" />
								<span id="website_name_error"  class="red"></span>
							</div>
						</div>
						<div class="col-md-3 col-sm-6" >
								<div class="form-group">
								<label>Wesite Link:</label><span class="red">*</span>
								<input type="text" name="website_link" id="website_link" class="form-control" value="<?php echo $website_link;?>" />
								 <span id="website_link_error"  class="red"></span>
							</div>
						</div>

						<div class="col-md-3 col-sm-6">
                            <div class="form-group">
								<label for="pwd" class="lbl_7">Country</span></span></label>
									<!-- <select id="spUserCountry" class="form-control" name="country" > -->
									<select class="form-control" name="country" >
                                    <option value="">Select Country</option>
									<?php
                                    $sql =  "SELECT * FROM tbl_country;";
							        $result3  = dbQuery($dbConn, $sql);
                                    if($result3 != false){
                                    while ($row3 = mysqli_fetch_assoc($result3)) {
                                    ?>
								
									
                                    <option value='<?php echo $row3['country_id'];?>' <?php echo $country == $row3['country_id'] ?'selected':''; ?>>
                                    <?php echo $row3['country_title'];?>
                                </option>
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
						 <select id="cat" class="form-control" name="category" >
                         <option value="">Select Category</option>
                         <?php
                         $sql =  "SELECT * FROM news_categories;";
						 $result3  = dbQuery($dbConn, $sql);
                        if($result3 != false){
                        while ($row3 = mysqli_fetch_assoc($result3)) {
                        ?>
                        
						<option value='<?php echo $row3['id'];?>' <?php echo $category == $row3['id'] ?'selected':''; ?>>
                                    <?php echo $row3['name'];?>
                                </option>
                        <?php
						}
                         }
                          ?>
                         </select>
                         <span id="category_error"  class="red"></span>
                        </div>
                        </div>		
						
					</div>
				<div class="box-footer"> 
	                <input type="button" id="add" name="btnButton" value="Update" class="btn vd_btn vd_bg-green finish" /> &nbsp;
	                <input type="button" name="btnButton" value="Back" class="btn vd_btn vd_bg-yellow" onclick="window.location.href='index.php'" /> &nbsp;
	            </div>
			</div>
			
			

		</form>
	</section><!-- /.content -->
  <script type="text/javascript">
        	
           $( document ).ready(function() {
                $("#add").on("click", function(){


                	var website_name = $("#website_name").val();
                	var website_link = $("#website_link").val();
                	var category = $("#category").val();

                if(website_name == "" && website_link == "" && category == ""){
                     	$("#website_name_error").text("Please Enter Website Name.");
                     	$("#website_link_error").text("Please Enter Website Link.");
                     	$("#category_error").text("Please Select Category.");
                     	return false;

                     }else if(website_name != "" && website_link == ""&& category == ""){
                     		
                     	$("#website_name_error").text("");
                     	$("#website_link_error").text("Please Enter Website Link.");
                     	$("#category_error").text("Please Select Category.");
                     	return false;

                     }else if(website_name == "" && website_link != "" && category == ""){
                     		
                     	$("#website_name_error").text("Please Enter Website Name.");
                     	$("#website_link_error").text("");
                     	$("#category_error").text("Please Select Category.");

                     	return false;

                     }else if(website_name == "" && website_link == "" && category != ""){
                     		
                     	$("#website_name_error").text("Please Enter Website Name.");
                     	$("#website_link_error").text("Please Enter Website Link.");
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
			       else{
                        
                         $("#frmcategory").submit();
                     }

                 });
           });

        </script>	

