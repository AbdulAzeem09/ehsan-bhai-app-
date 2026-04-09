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

$pon = new _spproductoptionsname;

if($_POST['optionname']!="" && $_POST['submit']=="Submit" )
	{

	$savedat =	array("spByuerProfileId" => $_SESSION['pid'] , "spBuyeruserId"=>$_SESSION['uid'], "opton_name"=>$_POST['optionname']);

	$poid = $pon->create($savedat);

	$msgtext = "<span style='color:red'>Added Successfully.</span>";

	}elseif($_POST['optionname']!="" && $_POST['submit']=="Update" )
	{

		$poid = $pon->updateopname($_POST['optionname'],$_POST['idsop']);

		$msgtext = "<span style='color:red'>Updated Successfully.</span>";

	}
?>
<!DOCTYPE html>
<html lang="en-US">
    
    <head>
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
                      <ul class="breadcrumb" style="background: white!important; ">
                            <li><a href="<?php echo $BaseUrl.'/store/dashboard/sell_dashboard.php';?>">Seller Dashboard</a></li>
                                       <li><a href="#">Product Options Name</a></li>
                                     
                          </ul>
                            </div>


							 <div class="col-md-12">
							 <div class="">

							 <?php
							 if($msgtext!="")
								{
									echo $msgtext;
								}

								if($_GET['action']=="update" && $_GET['idsop']>0)
								{
									$singresult = $pon->singleread($_GET['idsop']);
									 if ($singresult) {
									 $singdata = mysqli_fetch_assoc($singresult);
									 $optname = $singdata['opton_name'];
									 }

									$actionval = "Update";
								}
								else
								 {
									$actionval = "Submit";
								 }
							 ?>
							
							<form enctype="multipart/form-data" action="<?php echo $BaseUrl;?>/store/dashboard/products_option_name.php" method="post" id="sp-form-post" name="postform">
								<div class="col-md-2">
									<div class="form-group" style="float:right;margin-top: 5px;">
										<?php
											if($_GET['action']=="update" && $_GET['idsop']>0)
											{
											?>
											
											<input type="hidden" id="idsop" name="idsop" value="<?php echo $_GET['idsop'];?>">
										<?php
											}
										?>
										<label for="retailPrice" class="">Option Name :</label>
									 </div>
									</div>
								  
								  <div class="col-md-4">
									<div class="form-group">
										<input type="text" class="form-control spPostField" data-filter="0"  id="optionname" name="optionname" value="<?php echo $optname;?>" required>
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
                            <div class="col-md-12 ">
                                <div class="">
                                    <div class="table-responsive">
                                        <table class="table tbl_store_setting" >
                                            <thead>
                                                <tr>
                                                    <th class="text-center" style="width: 50px;">ID</th>
                                                    <th>Name</th>
                                                   <th class="text-center" style="width: 100px;" >Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                //$p = new _postingview;
                                             
                                                $result = $pon->read($_SESSION['uid'],$_SESSION['pid']);

                                                if ($result) {
                                                    $i = 1;
                                                    while ($row = mysqli_fetch_assoc($result)) {
                                                      
                                                       ?>
                                                       <tr>
                                                            <td class="text-center"><?php echo $row['idsop']; ?></td>
                                                            
                                                            <td><?php echo $row['opton_name']; ?></td>
                                                           

                                                            <td class="text-center">
                                                              
                                                                
                                                                <a href="<?php echo $BaseUrl.'/store/dashboard/products_option_name.php?action=update&idsop='.$row['idsop']; ?>"><img src="<?php echo $BaseUrl.'/assets/images/icon/edit.png'?>" class="img-responsive" alt="Edit" ></a>
                                                                <a href="javascript:void(0)" data-postid="<?php echo $row['idsop']; ?>" class="delopname" ><img src="<?php echo $BaseUrl.'/assets/images/icon/delete.png'?>" class="img-responsive" alt="Delete" ></a>
                                                            </td>
                                                        </tr>
                                                       <?php
                                                       $i++;
                                                    }
                                                }
                                                else{
                                                  ?>
                                                  <tr>
                                                      <td colspan="6">
                                                          <p class="text-center">No Record Found</p>
                                                      </td>
                                                  </tr>
                                                  <?php
                                                }
                                                ?>
                                                
                                            </tbody>
                                        </table>
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