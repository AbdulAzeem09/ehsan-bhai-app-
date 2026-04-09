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

    $_GET["categoryid"] = "1";
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
        
        $activePage = 1;
        //this is for store header
        $header_store = "header_store";

        include_once("../../header.php");
        ?>
    
 <section class="main_box">
            <div class="container">
                <div class="row">
				
				 <div id="sidebar" class="col-md-2 hidden-xs no-padding">
                        <div class="left_grid store_left_cat">
                            <?php
                               include('left-posmenu.php'); 
                            ?>
                        </div>
                    </div>
					<!--<a href="<?php echo $BaseUrl.'/store/pos_dashboard1/add_customer.php'; ?>" class="btn btn-primary pull-right">Add Customer</a>-->
					 <div class="col-md-10" style="margin-top: 13px;">
					 
					    <div class="row ">
                            <div class="col-md-12">

                                    <ul class="breadcrumb" style="background-color: #fff;font-size: 20px; text-align: center;">
                                      <li><a href="#" style=" color: #0B241E;">POS Dashboard</a></li>
                                     
                                   
                                    </ul>
								<!--	<?php if($_SESSION['ptid']==1){?>
	<a href="<?php echo $BaseUrl.'/store/pos_dashboard1/index.php'; ?>" class="pull-right" style=" color: #0B241E; margin-top: -57px;
    margin-right: 19px;"><b style=" font-size: 23px;">Switch To POS</b></a>
									<?php } ?>-->
                                </div>


                             <!--    <div class="text-right" style="margin-top: -10px;">

                                    



                                    
                                    <ul class="dualDash"   style="float:left!important;">
                                        <li><a href="<?php echo $BaseUrl.'/store/dashboard/sell_dashboard.php'; ?>" class="<?php echo ($activePage == 21)?'active':''?>">Seller Dashboard</a></li>
                                        <li><a href="<?php echo $BaseUrl.'/store/dashboard/';?>" class="<?php echo ($activePage == 1)?'active':''?>">Buyer Dashboard</a></li>
                                    </ul>


                                 
                                    
                                   
                                    
                                </div>
                            </div> -->

                             <!--   <div class="col-md-12">
								 <ul class="breadcrumb" style="padding-bottom: 0px;font-size: 20px; padding: 4px 0px; list-style: none;background: none !important;  margin-bottom: 8px;">
                            <li><a href="<?php echo $BaseUrl.'/store/dashboard/';?>">Buyer Dashboard</a></li>

                         <li><a href="#">Quotation List</a></li>
                                     
                          </ul>
                            </div> -->
                            <div class="col-md-3">
                                <div class="small-box bg-green">
                                    <div class="inner">
                                        <?php
										 $st= new _spuser;
									$st1=$st->readdatabybuyerid($_SESSION['uid']);
									if($st1!=false){
									$stt=mysqli_fetch_assoc($st1);
									$account_status=$stt['deactivate_status'];
									}
                                      $p = new _pos;

                                        $result = $p->read_data($_SESSION['pid']);
										//echo $result;
										//echo $account_status;
										//die('==');
										
										if(($account_status!=1) && $result){
										
                                            echo "<h3>".$result->num_rows."</h3>";
                                        }else{
                                            echo "<h3>0</h3>";
                                        }
                                        ?>
                                        <p>Customer Table</p>
                                    </div>
                                    <div class="icon">
                                        <i class="fa fa-ellipsis-v"></i>
                                    </div>
                                    <a href="<?php echo $BaseUrl.'/store/pos_dashboard1/customer.php'?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="small-box bg-aqua">
                                    <div class="inner">
									
                                       <?php    $pv = new _pos_vendor;

                                        $status = $pv->read_data($_SESSION['pid']);
			 if($account_status!=1 && $status){
                                               
                                            echo "<h3>".$status->num_rows."</h3>";
			 }else{
                                            echo "<h3>0</h3>";
                                        } ?>
										
                                      <p>Vendor Table</p>
                                    </div>
                                    <div class="icon">
                                        <i class="fa fa-usd"></i>
                                    </div>
                                    <a href="<?php echo $BaseUrl.'/store/pos_dashboard1/vendor.php';?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="small-box bg-yellow">
                                    <div class="inner">
                                    <?php    $pi = new _pos_inventory;

                                        $result_e = $pi->read_data($_SESSION['pid']);
												if($account_status!=1 && $result_e){

                                            echo "<h3>".$result_e->num_rows."</h3>";
												}else{
                                            echo "<h3>0</h3>";
                                        } ?>

                                  
                                      <p>Inventory Table</p>
                                    </div>
                                    <div class="icon">
                                        <i class="fa fa-product-hunt"></i>
                                    </div>
                                    <a href="<?php echo $BaseUrl.'/store/pos_dashboard1/inventory.php';?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="small-box bg-red">
                                    <div class="inner">
                                        <?php
                                         $po = new _pos_po;

                                        $result_f = $po->read_data($_SESSION['pid']);

                                       // print_r($result_f);
									   if(($account_status!=1)&& $result_f){
                                       
                                            echo "<h3>".$result_f->num_rows."</h3>";
									   }else{
                                            echo "<h3>0</h3>";
                                        }
                                        ?>
                                        <p>PO Table</p>
                                    </div>
                                    <div class="icon">
                                        <i class="fa fa-thumbs-o-up"></i>
                                    </div>
                                    <a href="<?php echo $BaseUrl.'/store/pos_dashboard1/po.php';?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
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
        // <!-- ========DASHBOARD FOOTER CHARTS====== -->
        include('../../component/dash_btm_script.php');
        ?>
    </body>
</html>
<?php
}
?>