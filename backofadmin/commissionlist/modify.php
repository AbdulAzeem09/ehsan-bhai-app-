<?php
	if (!defined('WEB_ROOT')) {
		exit;
	}
	$errorMessage = (isset($_GET['error']) && $_GET['error'] != '') ? $_GET['error'] : '&nbsp;';

	if(isset($_GET['payids']) && ($_GET['payids']) > 0){
		$payids  = $_GET['payids'];
	}else {
		redirect('index.php');
	}
	$sql = "SELECT * FROM commission_payment_history WHERE payids ='$payids'";
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
		<form name="frmAddMainNav" id="frmAddMainNav" method="post" action="processCommi.php?action=modify"  enctype="multipart/form-data" >
			<input type="hidden" name="hidId" id="hidId"  value="<?php echo $payids;?>"/>
            
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
								<label>Commission:</label><span class="red">*</span>
								<input type="text" name="commiAmt" id="commiAmt" class="form-control" required="required" value="<?php echo $totalComm;?>" />
								<span id="commiAmt_error"  class="red"></span>
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

                
                var commiAmt = $("#commiAmt").val();
 

			 if(commiAmt == "" ){
               
				 $("#commiAmt_error").text("Please Enter Commission Amount.");                          
                        
                        return false;

                     }
             if(isNaN(commiAmt)){
                            

                        $("#commiAmt_error").text("Only Number in Commission Amount");

                        return false;

                     }
                     
                    
                        
                         $("#frmAddMainNav").submit();
                         return true;
                     
                 });
           });

        </script>   