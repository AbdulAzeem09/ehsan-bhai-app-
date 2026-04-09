<?php
	if (!defined('WEB_ROOT')) {
		exit;
	}
	$errorMessage = (isset($_GET['error']) && $_GET['error'] != '') ? $_GET['error'] : '&nbsp;';

	if(isset($_GET['framType']) && ($_GET['framType']) > 0){
		$framType  = $_GET['framType'];
	}else {
		redirect('index.php');
	}
	$sql = "SELECT * FROM frame_type WHERE idspFrameType ='$framType'";
	$result = dbQuery($dbConn, $sql);
	$row    = dbFetchAssoc($result);
	extract($row);
?>
	
	<!-- Content Header (Page header) -->
	<section class="content-header top_heading">
		<h1>Frame Type<small>[Modify]</small></h1>
	</section>
	<!-- Main content -->
	<section class="content" >
		<!-- start any work here. -->
		<form name="frmAddMainNav" id="frmAddMainNav" method="post" action="processFrameType.php?action=modify"  enctype="multipart/form-data" onsubmit="return validate(this)">
			<input type="hidden" name="hidId" id="hidId"  value="<?php echo $framType;?>"/>
            
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
							<label>Title:</label><span class="red">*</span></br>
							<input type="text" name="txtTitle" id="txtTitle" class="form-control" maxlength="40" value="<?php echo $spFrameTitle;?>" />
							<span id=text_error  class="red"></span>
						</div>
						
					</div>
				</div>
				<div class="box-footer"> 
                    <input type="submit" name="btnButton" id="add" value="Update" class="btn vd_btn vd_bg-green finish" /> &nbsp;
                    <input type="button" name="btnButton" value="Back" class="btn vd_btn vd_bg-yellow" onclick="window.location.href='index.php'" /> &nbsp;
                </div>
			</div>
			
		</form>
	</section><!-- /.content -->
		<script type="text/javascript">
        	
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
                     		

                     	$("#text_error").text("Please Enter Title.");
                     	return false;

                     }
                     else if(flag == 1){
                     	$("#text_error").text("Space not allowed.");
                     	return false;

                     }
                     else{
                        
                         $("#frmAddMainNav").submit();
                     }

                 });
           });

        </script>	