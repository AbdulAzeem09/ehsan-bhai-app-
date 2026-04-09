<?php
	if (!defined('WEB_ROOT')) {
		exit;
	}
	$errorMessage = (isset($_GET['error']) && $_GET['error'] != '') ? $_GET['error'] : '&nbsp;';

	if(isset($_GET['id']) && ($_GET['id']) > 0){
		$id  = $_GET['id'];
	}else {
		//redirect('index.php');
	}
	$sql = "SELECT * FROM group_category WHERE id ='$id'";
	$result = dbQuery($dbConn, $sql);
	$row    = dbFetchAssoc($result);
	extract($row);
?>
	
	<!-- Content Header (Page header) -->
	<sec
	tion class="content-header">
		<h1>Group
            Category<small>[Modify]</small></h1>
	</section>
	<!-- Main content -->
	<section class="content" >
		<!-- start any work here. -->
 <form name="frmAddMainNav" id="frmAddMainNav" method="post" action="processGroup.php?action=modify" enctype="multipart/form-data" onsubmit="return validate(this)">
      <input type="hidden" name="hidId" id="hidId"  value="<?php echo $id;?>"/>
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
            
            <div class="col-md-4 col-sm-6" >
              <div class="form-group">
                <label>Title:</label><span class="red">*</span>
                <input type="text"  maxlength="40" name="group_n" id="txtTitle" value="<?php echo $row['group_category_name'];?>" class="form-control" / >
                <span id=cat_error  class="red"></span>

            </div>
            
            </div>
           
            <div class="col-md-4 col-sm-6">
              <div class="form-group">
                <label>Icon:</label><span class="red">*</span>
                                                <input type="file" name="group_i" id="txtImage" accept='image/*' /> <?php echo $row['group_category_icon'];?> 

              
                <span id=subcat_error  class="red"></span>
                
              </div>
            </div>  
            
                                
          </div>
        </div>
        <div class="box-footer"> 
                  <input type="submit" id="add" name="btnButton" value="Add" class="btn vd_btn vd_bg-green finish" /> &nbsp;
                  <input type="button" name="btnButton" value="Back" class="btn vd_btn vd_bg-yellow" onclick="window.location.href='index.php?view=groups_c'" /> &nbsp;
              </div>
      </div>
      
      
    </form>
	</section><!-- /.content -->
  
    <script type="text/javascript">
            
           $( document ).ready(function() {
                $("#add").on("click", function(){

                var txtIndusrtyType = $("#txtTitle").val();
                    var selectPoint = $("#txtImage").val();
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

                     }*/ if(selectPoint == "" && txtIndusrtyType == "" ){
                            

                        $("#cat_error").text("Please Enter Title.");
                        

                            $("#subcat_error").text("Please Select Icon.");
                             // $("#percent_error").text("Please Enter Percentage.");
                        
                        return false;

                     }
                    else if(selectPoint != "" && txtIndusrtyType == ""  ){
                            

                        $("#cat_error").text("");
                        $("#subcat_error").text("Please Select Icon.");
                              //$("#percent_error").text("Please Enter Percentage.");

                        return false;

                     }
                     
                     else if(flag == 1){
                        $("#cat_error").text("Space not allowed.");
                        return false;

                     }
                     else{
                        
                         $("#frmAddMainNav").submit();
                         return true;
                     }

                 });
           });

        </script>   