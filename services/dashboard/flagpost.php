<?php
    include('../../univ/baseurl.php');
    session_start();
if(!isset($_SESSION['pid'])){ 
    $_SESSION['afterlogin']="services/";
    include_once ("../../authentication/islogin.php");
  
}else{
    function sp_autoloader($class) {
        include '../../mlayer/' . $class . '.class.php';
    }
    spl_autoload_register("sp_autoloader");

    $_GET["categoryID"] = "7";
    $_GET["categoryName"] = "Services";
    $header_servic = "header_servic";
    $activePage = 8;
?>
<!DOCTYPE html>
<html lang="en-US">
    
    <head>
        <?php include('../../component/f_links.php');?>

        <!-- ===== INPAGE SCRIPTS====== -->
        <!-- High Charts script -->
        <script src="<?php echo $BaseUrl;?>/assets/js/highcharts.js"></script>
        <!-- Morris chart -->
        <link href="<?php echo $BaseUrl; ?>/assets/admin/plugins/morris/morris.css" rel="stylesheet" type="text/css" />
        <?php include('../../component/dashboard-link.php'); ?>
    </head>

    <body class="bg_gray">
         <?php
        include_once("../../header.php");
        ?>
        <section class="main_box">
            <div class="container">
                <div class="row">
                    <div class="sidebar col-md-2 no-padding left_service_menu" id="sidebar" >
                        <?php include('left-menu.php'); ?> 
                    </div>
                    <div class="col-md-10">
                        <div class="col-xs-12 serviceDashTop text-center">
                            <h1>Flag Posts</h1>
                        </div>
                        <div class="row">


                            <div class="col-sm-12">
                                <div class="table-responsive bg_white">
                               <?php $fl= new _flagpost;
											$res= $fl->myflagPost(7,$_SESSION['pid']);

                                            if($res != false){ ?>
                                    <table class="table table-striped table-bordered dashServ">
                                        <thead>
                                            <tr>
                                                
                                                <th>Name</th>
                                                <th class="text-center">Flagged Date</th>
                                               
                                                <th class="text-center">Reason</th>
                                            
                                                <th class="text-center">Flag Name</th>
                                               <!-- <th class="text-center">Action</th>-->

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
											$catid=7;
											$fl= new _flagpost;
											$res= $fl->myflagPost(7,$_SESSION['pid']);
                                          // print_r($res);die;
										  //$p      = new _classified;
										   //$res1   = $p->myposted_service($_SESSION['pid']);
										  
                                            $i = 1;
                                            if($res != false){
                                                while ($row = mysqli_fetch_assoc($res)) { 
												//print_r($row);
												$p      = new _classified;
										   $res1   = $p->flag_name($row['spPosting_idspPosting']);
												if($res1 != false){
													while($row1=mysqli_fetch_assoc($res1)){
													//print_r($row1);
												
													
                                                    
                                                        ?>
                                                        <tr>
                                                            
<td><a href="<?php echo $BaseUrl.'/services/detail.php?postid='.$row1['idspPostings'];?>"><?php echo ucfirst($row1['spPostingTitle']); ?></a></td>
                                            <?php
												} }  ?>
                    <!-- <a href="<?php echo $BaseUrl.'/services/detail.php?postid='.$row['idspPostings'];?>"><?php echo $row['spPosting_idspPosting']; ?></a>-->
                                                            </td>
                <td class="text-center"><?php echo $row['flag_date']; ?></td>
                <td class="text-center"><?php echo $row['flag_desc']?></td>
                <td class="text-center"><?php echo $row['why_flag']; ?></td>
                                                            
                                                           
                                                        </tr>
                                            
                                                        <?php
                                                      
                                                    }
                                                }
                                                
                                             ?>
                                          

                                        </tbody>
                                      
                                    </table>
                                    <?php  }else{ ?>

                                        <table class="table table-striped table-bordered dashServ">
                                        <thead>
                                            <tr>
                                                
                                                <th>Name</th>
                                                <th class="text-center">Flagged Date</th>
                                               
                                                <th class="text-center">Reason</th>
                                            
                                                <th class="text-center">Flag Name</th>
                                               <!-- <th class="text-center">Action</th>-->

                                            </tr>
                                        </thead>
                                    </table>
                                        <?php 
                                        echo "<h4 style='text-align: center;'>No Similar Jobs Found!</h4>";


                                    } ?>
                                </div>
                                
                            </div>
                        
                        </div>
                    </div>
                </div>
            </div>
        </section>
       
        <div class="space-lg"></div>

        <?php 
        include('../../component/f_footer.php');
        include('../../component/f_btm_script.php'); 
        ?>
        <!-- notification js -->
        <script src='<?php echo $BaseUrl.'/assets/';?>js/bootstrap-notify.min.js'></script>
    </body>
</html>
<?php
} ?>
