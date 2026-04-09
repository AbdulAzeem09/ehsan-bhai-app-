<?php
	if (!defined('WEB_ROOT')) {
		exit;
	}
	$errorMessage = (isset($_GET['error']) && $_GET['error'] != '') ? $_GET['error'] : '&nbsp;';

	if(isset($_GET['subCat']) && ($_GET['subCat']) > 0){
		$subCat  = $_GET['subCat'];
	}else {
		redirect('index.php');
	}
	$sql = "SELECT * FROM subcategory WHERE idsubCategory ='$subCat'";
	$result = dbQuery($dbConn, $sql);
	$row    = dbFetchAssoc($result);
	extract($row);
?>
	
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>All Category <small>[Modify]</small></h1>
	</section>
	<!-- Main content -->
	<section class="content" >
		<!-- start any work here. -->
		<form name="frmAddMainNav" id="frmAddMainNav" method="post" action="processSubCategory.php?action=modify"  enctype="multipart/form-data" >
			<input type="hidden" name="hidId" id="hidId"  value="<?php echo $subCat;?>"/>
            
			<div class="box box-success">
				<div class="box-body">
					<div class="" id="alertmsg" style="margin: 10px 0px 0px 5px;">
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
						<div class="col-md-4 col-sm-6" >
							<div class="form-group">
								<label>Category:</label><span class="red">*</span>
								<select class="form-control" name="txtCategory" id="txtCategory">

									<option value="0">Select Category</option>
									option
									<?php 
									$sql2 = "SELECT * FROM spcategories WHERE spCategoryStatus = 1";
									$result2 = dbQuery($dbConn, $sql2);
									while($row2 = dbFetchAssoc($result2)) {
										// build combo box options
										?>
										<option value="<?php echo $row2['idspCategory']; ?>" <?php echo ($spCategories_idspCategory == $row2['idspCategory'])?'selected':''; ?> ><?php echo ucwords($row2['spCategoryName']); ?></option>
										<?php
										//echo  "<option value='".$row['idspCategory']."' ".." >" . ucwords($row['spCategoryName']) . "</option>\r\n";
									} //end while	
									?>
								</select>
								<span id=cat_error  class="red"></span>
							</div>
						</div>
						<div class="col-md-4 col-sm-6" >
							<div class="form-group">
								<label>Sub Category:</label><span class="red">*</span>
								<input type="text" name="txtSubCategory" id="txtSubCategory" class="form-control" required="required" value="<?php echo ucfirst(strtolower($subCategoryTitle));?>" />
								<span id=subcat_error  class="red"></span>
							</div>
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

                var selectPoint = $("#txtCategory").val();
                    var txtIndusrtyType = $("#txtSubCategory").val();
                         //var txtPercent = $("#txtPercent").val(); 


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

                    
         /*         if(selectPoint == "0"){
                            

                        $("#select_error").text("Please Select Point type.");
                        return false;

                     }else if(txtIndusrtyType == ""){
                            

                        $("#text_error").text("Please Enter Title.");
                        return false;

                     }*/ if(selectPoint == "0" && txtIndusrtyType == "" ){
                            

                        $("#cat_error").text("Please Select Category.");
                        

                            $("#subcat_error").text("Please Enter Sub Category.");
                             // $("#percent_error").text("Please Enter Percentage.");
                        
                        return false;

                     }
                    else if(selectPoint != "0" && txtIndusrtyType == ""  ){
                            

                        $("#cat_error").text("");
                        $("#subcat_error").text("Please Enter Sub Category.");
                              //$("#percent_error").text("Please Enter Percentage.");

                        return false;

                     }
                     
                     else if(flag == 1){
                        $("#subcat_error").text("Space not allowed.");
                        return false;

                     }
                     else{
                        
                         $("#frmAddMainNav").submit();
                         return true;
                     }

                 });
           });

        </script>   