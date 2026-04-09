<?php
    include('../../univ/baseurl.php');
    session_start();
if(!isset($_SESSION['pid'])){ 
    $_SESSION['afterlogin']="store/";
    include_once ("../../authentication/islogin.php");
 
}else{
    function sp_autoloader($class){
      include '../../mlayer/' . $class . '.class.php';
    }
    spl_autoload_register("sp_autoloader");

    $idsopv = isset($_GET['idsopv']) ? (int)$_GET['idsopv'] : 0;

$ponv = new _spproductoptionsvalues;


if($_POST['optionvalue']!="" && $_POST['submit']=="Submit" )
	{

	$savedat =	array("idsop" => $_POST['idsop'] , "spByuerProfileId" => $_SESSION['pid'] , "spBuyeruserId"=>$_SESSION['uid'], "opton_values"=>$_POST['optionvalue']);

	$poid = $ponv->create($savedat);

	$msgtext = "<span style='color:red'>Added Successfully.</span>";

	}elseif($_POST['optionvalue']!="" && $_POST['submit']=="Update" )
	{

		$poid = $ponv->updateopvalue($_POST['idsop'],$_POST['optionvalue'],$_POST['idsopv']);

		$msgtext = "<span style='color:red'>Updated Successfully.</span>";

	}
?>
<!DOCTYPE html>
<html lang="en-US">
    
    <head>

	<link rel='stylesheet' href='https://cdn.datatables.net/1.10.9/css/jquery.dataTables.min.css'>
        <?php include('../../component/f_links.php');?>
        
        <!-- ===== INPAGE SCRIPTS====== -->
        <?php include('../../component/dashboard-link.php'); ?>
        
    </head>

    <body class="bg_gray">
    	<?php
        $header_store = "header_store";

        include_once("../../header.php");
        ?>
        <section class="main_box">
            <div class="container">
                <div class="row">

                     <div id="sidebar" class="col-md-2 hidden-xs no-padding">
                        <div class="left_grid store_left_cat">
                            <?php
                               include('left-sellermenu.php'); 
                            ?>
                        </div>
                    </div>
                    <div class="col-md-10">                        
                        
                        <?php 
                        $storeTitle = " Dashboard / Active Products";
                       
                        ?>
						
                        
                        <div class="row">



                              <div class="col-md-12">
                      <ul class="breadcrumb" style="background: white !important;  ">
                            <li><a href="<?php echo $BaseUrl.'/store/dashboard/sell_dashboard.php';?>">Seller Dashboard</a></li>
                                       <li><a href="#">Product Options Value</a></li>
                                     
                          </ul>
                            </div>


							 <div class="col-md-12">
							 <div class="">

							 <?php
							 if($msgtext!="")
								{
									echo $msgtext;
								}

								if($_GET['action']=="update" && $idsopv>0)
								{
									$singresult = $ponv->singleread($idsopv);
									 if ($singresult) {
									 $singdata = mysqli_fetch_assoc($singresult);
									 $optvalue = $singdata['opton_values'];
									 $optnameid = $singdata['idsop'];
									 }

									$actionval = "Update";
								}
								else
								 {
									$actionval = "Submit";
									$optnameid = 0;
								 }
							 ?>
							
							<form enctype="multipart/form-data" action="<?php echo $BaseUrl;?>/store/dashboard/products_option_value.php" method="post" id="sp-form-post" name="postform">

							<div class="col-md-2">
									<div class="form-group" style="float:right;margin-top: 5px;">
										<?php
						if($_GET['action']=="update" && $idsopv>0)
											{
												
											?>
											
	<input type="hidden" id="idsopv" name="idsopv" value="<?php echo $idsopv;?>">
										<?php
											}
										?>
										<label for="retailPrice" class="">Option Name :</label>
										 </div>
								</div>

								<div class="col-md-3">
									<div class="form-group">
										<select class="form-control" name="idsop" id="idsop" required>           
										 <option value="">Select Name</option>
										<?php
										  $resultopnname = $ponv->readopnname(0,0);

                                                if ($resultopnname) {
                                                   while ($resultopnnamerow = mysqli_fetch_assoc($resultopnname)) {
													?>
													<option value="<?php echo $resultopnnamerow['idsop'];?>" <?php if($optnameid==$resultopnnamerow['idsop']){ echo "selected";}?>><?php echo $resultopnnamerow['opton_name'];?></option>

													<?php

													}}
                                                      

													  ?>
											</select>
									 </div>
								</div>

								<div class="col-md-2">
									<div class="form-group" style="float:right;margin-top: 5px;">
										
										<label for="retailPrice" class="">Option Value :</label>
									 </div>
									</div>
								  
								  <div class="col-md-3">
									<div class="form-group">
										<input type="text" class="form-control spPostField" data-filter="0"  id="optionvalue" name="optionvalue" value="<?php echo $optvalue;?>" required>
										</div>
								</div>
								
								<div class="col-md-2">
									<div class="form-group">
										<button type="submit" class="btn butn_draf" style="border-radius: 20px;background-color: #1c6121;background-image: -webkit-linear-gradient(90deg,#1c6121 0,#1c6121 99%);" name="submit" value="<?php echo $actionval; ?>"> <?php echo $actionval; ?></button>

									</div>
								</div>
								</form>
							 </div>
							 </div>
							 <!--<link rel='stylesheet' href='https://cdn.datatables.net/1.10.9/css/jquery.dataTables.min.css'>-->
							 
							 
						<style type="text/css">
    .paginate_button {
  border-radius: 0 !important;
}

</style>
                         <div class="col-md-12 ">
                                <div class="">
                                    <div class="table-responsive">
                                        
			
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </section>





    	<?php 
        include('../../component/f_footer.php');
        include('../../component/f_btm_script.php'); 
        ?>
        
    </body>
	
</html>
<?php
} ?>
<!--<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>-->
<!--<script src='https://cdn.datatables.net/1.10.9/js/jquery.dataTables.min.js'></script>-->
<script src='https://cdn.datatables.net/1.10.9/js/jquery.dataTables.min.js'></script>



  <script type="text/javascript">
    $(document).ready(function() {

  var table = $('#example').DataTable({ 
        select: false,
        "columnDefs": [{
            className: "Name", 
            "targets":[0],
            "visible": false,
            "searchable":false
        }]
    });//End of create main table

  
  $('#example tbody').on( 'click','tr', function () {
   
   // alert(table.row( this ).data()[0]);

} );
});
</script>
<script>
function delete_d(postid){
	//alert(postid);
	
	  swal({
            title: "Are you sure you want to delete ?",
            type: "warning",
            confirmButtonClass: "sweet_ok",
            confirmButtonText: "Yes",
            cancelButtonClass: "sweet_cancel",
            cancelButtonText: "No",
            showCancelButton: true,
        }, function (isConfirm) {
            if (isConfirm) {
                if (postid > 0) {
                    $.post("delopvalue.php", {
                        postid: postid
                    }, function (data) {
                        window.location.reload();
                    });
                }
            }
        });
}
</script>

