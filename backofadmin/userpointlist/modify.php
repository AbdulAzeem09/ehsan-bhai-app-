<?php
	if (!defined('WEB_ROOT')) {
		exit;
	}
	$errorMessage = (isset($_GET['error']) && $_GET['error'] != '') ? $_GET['error'] : '&nbsp;';

	if(isset($_GET['idspPoint']) && ($_GET['idspPoint']) > 0){
		$idspPoint  = $_GET['idspPoint'];
	}else {
		redirect('index.php');
	}
	$sql = "SELECT * FROM spuserpoints WHERE idspPoint ='$idspPoint'";
	$result = dbQuery($dbConn, $sql);
	$row    = dbFetchAssoc($result);
	extract($row);
?>
	
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>Commisssion <small>[Modify]</small></h1>
	</section>
	<!-- Main content -->
	<section class="content" >
		<!-- start any work here. -->
		<form name="frmAddMainNav" id="frmAddMainNav" method="post" action="processPoints.php?action=modify"  enctype="multipart/form-data" >
			<input type="hidden" name="hidId" id="hidId"  value="<?php echo $idspPoint;?>"/>
            
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
								<label>Total:</label><span class="red">*</span>
								<input type="text" name="totalamt" id="totalamt" class="form-control" required="required" readonly value="<?php echo $totalAmount;?>" />
								<span id=cat_error  class="red"></span>
							</div>
						</div>
						<div class="col-md-4 col-sm-6" >
							<div class="form-group">
								<label>Points:</label><span class="red">*</span>
								<input type="text" name="totalPoint" id="totalPoint" class="form-control" required="required" value="<?php echo $totalPoints;?>" />
								<span id="totalPoint_error"  class="red"></span>
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

                
                var totalpoint = $("#totalPoint").val();
 

			 if(totalpoint == "" ){
               
				 $("#totalPoint_error").text("Please Enter Points.");                          
                        
                        return false;

                     }
             if(isNaN(totalpoint)){
                            

                        $("#totalPoint_error").text("Only Number in Points");

                        return false;

                     }
                     
                    
                        
                         $("#frmAddMainNav").submit();
                         return true;
                     
                 });
           });

        </script>   